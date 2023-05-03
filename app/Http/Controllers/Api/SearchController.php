<?php

namespace App\Http\Controllers\Api;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class SearchController extends Controller
{

    public function search(Request $request)
    {

        $query = Apartment::query();


        // Filtrare per indirizzo
        if ($request->has('address')) {
            $address = $request->input('address');
            if (!empty($address)) {
                $coordinates = $this->getCoordinates($address);
            $query->whereRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) < ?', [
                    $coordinates['latitude'],
                    $coordinates['longitude'],
                    $coordinates['latitude'],
                    $request->input('distance', 100) / 1000,
                ]);
            }
        }

        // Filtrare per numero di letti
        if ($request->has('bed_n') && !empty($request->input('bed_n'))) {
            $query->where('bed_n', '>=', $request->input('bed_n'));
        }

        // Filtrare per numero di camere
        if ($request->has('room_n') && !empty($request->input('room_n'))) {
            $query->where('room_n', '>=', $request->input('room_n'));
        }

        // Filtrare per optionals
        if ($request->has('optionals') && !empty($request->input('optionals'))) {
            $options = $request->input('optionals');
            $query->whereHas('optionals', function ($q) use ($options) {
                $q->whereIn('name', $options);
            });
        }
        
        $apartments = $query
        ->leftJoin('apartment_sponsorship', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
        ->orderByRaw('CASE WHEN apartment_sponsorship.id IS NULL THEN 1 ELSE 0 END')
        ->get();
        return response()->json($apartments);
    }

    // private function getCoordinates($address)
    // {
    //     // Creo un'istanza del client GuzzleHttp
    //     $client = new \GuzzleHttp\Client([
    //         'verify' => false
    //     ]);

    //     // Eseguo una richiesta GET all'API di TomTom per ottenere le coordinate geografiche dell'indirizzo
        
    //     $response = $client->get('https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json', [
    //         'query' => [
    //             'key' => '186r2iPLXxGSFMemhylqjC36urDbgOV2', // chiave API di TomTom
    //         ],  
    //         ]);



    //     // Decodifico la risposta JSON e recupera le coordinate geografiche
    //     $geocode_data = json_decode($response->getBody(), true);
    //     $longitude = $geocode_data['results'][0]['position']['lon'];
    //     $latitude = $geocode_data['results'][0]['position']['lat'];

    //     return compact('latitude', 'longitude');
    // }

    private function getCoordinates($address)
    {
        // Creo un'istanza del client GuzzleHttp
        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        // Verifico se l'indirizzo è vuoto o non valido
        if (empty($address) || !is_string($address)) {
            throw new \Exception('Indirizzo non valido');
        }

        // Eseguo una richiesta GET all'API di TomTom per ottenere le coordinate geografiche dell'indirizzo
        $response = $client->get('https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json', [
            'query' => [
                'key' => '186r2iPLXxGSFMemhylqjC36urDbgOV2', // chiave API di TomTom
            ],
        ]);

        // Verifico se la richiesta ha avuto successo
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Errore durante l\'accesso all\'API di TomTom');
        }

        // Decodifico la risposta JSON e recupera le coordinate geografiche
        $geocode_data = json_decode($response->getBody(), true);
        if (!isset($geocode_data['results']) || empty($geocode_data['results'])) {
            throw new \Exception('Indirizzo non trovato');
        }
        $longitude = $geocode_data['results'][0]['position']['lon'];
        $latitude = $geocode_data['results'][0]['position']['lat'];

        return compact('latitude', 'longitude');
    }

    

}