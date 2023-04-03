<?php

use GuzzleHttp\Client;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ApartmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/apartments/{slug}', [ApartmentController::class, 'show']);
Route::get('/search', [SearchController::class, 'search']);

Route::post('/messages', [MessageController::class, 'store']);

// Route::get('/geocode/{address}', function(Request $request, $address) {
//     try {
//         $client = new \GuzzleHttp\Client([
//             'verify' => false
//         ]);
//         $response = $client->request('GET', 'https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json', [
//             'query' => [
//                 'key' => '186r2iPLXxGSFMemhylqjC36urDbgOV2'
//             ]
//         ]);
//         $result = json_decode($response->getBody(), true);
//         $lat = $result['results'][0]['position']['lat'];
//         $lon = $result['results'][0]['position']['lon'];
//         return response()->json([
//             'lat' => $lat,
//             'lon' => $lon
//         ]);
//     } catch (\Exception $e) {
//         return response()->json([
//             'error' => $e->getMessage()
//         ], 500);
//     }
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('/userdata', [UserController::class, 'index']);
// }); 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // Route::get('/userdata', [UserController::class, 'index']);
    return $request->user();
});
