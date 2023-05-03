<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Image;
use App\Models\Message;
use App\Models\Optional;
use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use GuzzleHttp\Client;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $id = Auth::user()->getId();
        }
        $apartments = Apartment::all();
        $sponsorships = Sponsorship::all();
        return view('admin.apartments.index', compact('apartments', 'id', 'sponsorships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $optionals = Optional::all();
        $sponsorships = Sponsorship::all();
        return view('admin.apartments.create', compact('optionals', 'sponsorships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        $form_data = $request->validated();
        $slug = Apartment::generateSlug($request->title);

        // aggiungo una coppia chiave valore all'array $data
        $form_data['slug'] = $slug;
        $newApartment = new Apartment();

        //id utente 
        if (Auth::check()) {
            $id = Auth::user()->getId();
            $form_data['user_id'] = $id;
        } else {
            $form_data['user_id'] = null;
        }

        if ($request->hasFile('cover_img')) {
            $path = Storage::disk('public')->put('cover_img', $request->cover_img);
            $form_data['cover_img'] = $path;
        }
        // Recupero l'indirizzo dall'array di dati
        $address = $form_data['address'];

        // Creo un'istanza del client GuzzleHttp
        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        try {

            // Eseguo una richiesta GET all'API di TomTom per ottenere le coordinate geografiche dell'indirizzo
            $response = $client->get('https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json', [
                'query' => [
                    'key' => '186r2iPLXxGSFMemhylqjC36urDbgOV2', // chiave API di TomTom
                ],
            ]);

            // Decodifico la risposta JSON e recupera le coordinate geografiche
            $geocode_data = json_decode($response->getBody(), true);
            $longitude = $geocode_data['results'][0]['position']['lon'] ?? null;
            $latitude = $geocode_data['results'][0]['position']['lat'] ?? null;

            if ($longitude && $latitude) {
                // Aggiungo le coordinate geografiche all'array di dati
                $form_data['longitude'] = $longitude;
                $form_data['latitude'] = $latitude;

                $newApartment->fill($form_data);

                $newApartment->save();


                if ($request->has('optionals')) {
                    $newApartment->optionals()->attach($request->optionals);
                }

                if ($request->has('sponsorships')) {
                    $newApartment->sponsorships()->attach($request->sponsorships);
                }

                return redirect()->route('admin.apartments.index')->with('message', 'Apartment Created Correctly');
            } else {
                return redirect()->route('admin.apartments.create')->with('message', 'Your address is incorrect');
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {

            // Se si verifica un'eccezione nella richiesta, restituisci un errore con il messaggio dell'eccezione
            return redirect()->route('admin.apartments.create')->with('message', 'Your address is incorrect');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $sponsorships = Sponsorship::all();
        $optionals = Optional::all();
        return view('admin.apartments.show', compact('apartment', 'sponsorships', 'optionals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $optionals = Optional::all();
        $sponsorships = Sponsorship::all();
        return view('admin.apartments.edit', compact('apartment', 'optionals', 'sponsorships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentRequest  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $form_data = $request->validated();

        if ($request->hasFile('cover_img')) {
            if ($apartment->cover_img) {
                Storage::delete($apartment->cover_img);
            }

            $path = Storage::disk('public')->put('cover_img', $request->cover_img);

            $form_data['cover_img'] = $path;
        }

        // Recupero l'indirizzo dall'array di dati
        $address = $form_data['address'];

        // Creo un'istanza del client GuzzleHttp
        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        try {

            // Eseguo una richiesta GET all'API di TomTom per ottenere le coordinate geografiche dell'indirizzo
            $response = $client->get('https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json', [
                'query' => [
                    'key' => '186r2iPLXxGSFMemhylqjC36urDbgOV2', // chiave API di TomTom
                ],
            ]);

            // Decodifico la risposta JSON e recupera le coordinate geografiche
            $geocode_data = json_decode($response->getBody(), true);
            $longitude = $geocode_data['results'][0]['position']['lon'] ?? null;
            $latitude = $geocode_data['results'][0]['position']['lat'] ?? null;

            if ($longitude && $latitude) {
                // Aggiungo le coordinate geografiche all'array di dati
                $form_data['longitude'] = $longitude;
                $form_data['latitude'] = $latitude;

                $apartment->update($form_data);

                if ($request->has('optionals')) {
                    $apartment->optionals()->sync($request->optionals);
                }

                if ($request->has('sponsorships')) {
                    $apartment->sponsorships()->sync($request->sponsorships);
                }

                return redirect()->route('admin.apartments.show',  ['apartment' => $apartment['slug']])->with('message', 'Appartment Updated Correctly');
            } else {
                return redirect()->route('admin.apartments.edit',  ['apartment' => $apartment['slug']])->with('message', 'Your address is incorrect');
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {

            // Se si verifica un'eccezione nella richiesta, restituisci un errore con il messaggio dell'eccezione
            return redirect()->route('admin.apartments.edit',  ['apartment' => $apartment['slug']])->with('message', 'Your address is incorrect');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {

        $apartment->optionals()->sync([]);

        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('message', 'Appartment Deleted');
    }
}
