<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Validator;


class ApartmentController extends Controller
{
    public function index(){

        $apartments = Apartment::with('sponsorships', 'optionals')
        ->leftJoin('apartment_sponsorship', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
        ->orderByRaw('CASE WHEN apartment_sponsorship.id IS NULL THEN 1 ELSE 0 END')
        ->paginate(9);

        return response()->json([
            'success' => true,
            'results' => $apartments,
        ]);
    }

    public function show($slug){
        $apartment = Apartment::with('sponsorships', 'optionals')->where('slug', $slug)->first();

        if($apartment){
            return response()->json([
                'success' => true,
                'results' => $apartment
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'error' => 'Nessun appartamento tovato'
            ]);
        }
    }
}
