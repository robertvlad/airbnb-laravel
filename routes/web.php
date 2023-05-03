<?php

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Models\ApartmentSponsorship;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guest\SearchController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SponsorshipController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//pagamenti

Route::get('/admin/payments', function () {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->ClientToken()->generate();

    return view('admin.sponsorships', ['token' => $token]);
})->middleware(['auth', 'verified']);

Route::post('/admin/checkout', function (Request $request) {

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;
    
    // Ottengo i dati dal request
    $apartmentId = $request->input('apartment_id');
    $price = $request->input('price');
    // Trovo il record di Sponsorship corrispondente al prezzo
    $sponsorshipData = Sponsorship::where('price', $price)->first();

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    // if ($result->success) {
        $transaction = $result->transaction;

        //Salvo il nuovo record nel db

        if ($sponsorshipData) {
            // Creo un'istanza di ApartmentSponsorship utilizzando il modello ApartmentSponsorship
            $apartmentSponsorship = new ApartmentSponsorship();
        
            // Assegnare apartment_id e sponsorship_id ai relativi campi nel modello ApartmentSponsorship
            $apartmentSponsorship->apartment_id = $apartmentId;
            $apartmentSponsorship->sponsorship_id = $sponsorshipData->id;
        
            // Salvare il modello ApartmentSponsorship nel database
            $apartmentSponsorship->save();
        }

        return back()->with('success_message', 'Transaction successful');
    // } else {
    //     $errorString = "";

    //     foreach ($result->errors->deepAll() as $error) {
    //         $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    //     }
    //     return back()->withErrors('An error occurred: ' . $result->message);
    // }
})->middleware(['auth', 'verified']);


Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/apartments', ApartmentController::class)->parameters(['apartments' => 'apartment:slug']);
        Route::resource('/messages', MessageController::class)->parameters(['messages' => 'message:id']);
        Route::resource('/sponsorships', SponsorshipController::class);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
