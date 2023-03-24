<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;

use App\Models\Apartment;
use App\Models\Optional;
use App\Models\Sponsorship;
use App\Models\Image;
use App\Models\Message;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();
        return vieW('admin.apartments.index', compact('apartments'));
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

        if ($request->hasFile('cover_img')) {
            $path = Storage::disk('public')->put('cover_img', $request->cover_img);
            $form_data['cover_img'] = $path;
        }

        $newApartment->fill($form_data);
        $newApartment->save();
        

        if ($request->has('optionals')) {
            $newApartment->optionals()->attach($request->optionals);
        }

        if ($request->has('sponsorships')) {
            $newApartment->sponsorships()->attach($request->sponsorships);
        }

        return redirect()->route('admin.apartments.index')->with('message', 'Appartamento aggiunto correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
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

        $slug = Apartment::generateSlug($request->title, '-');

        $form_data['slug'] = $slug;

        if ($request->has('cover_img')) {
            if ($apartment->cover_img) {
                Storage::delete($apartment->cover_img);
            }

            $path = Storage::disk('public')->put('cover_img', $request->cover_img);

            $form_data['cover_img'] = $path;
        }

        $apartment->update($form_data);

        if ($request->has('optionals')) {
            $apartment->optionals()->sync($request->optionals);
        }

        return redirect()->route('admin.apartments.index')->with('message', $apartment->title . ' è stato correttamente aggiornato');
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

        return redirect()->route('admin.apartments.index')->with('message', 'Appartamento cancellato correttamente');
    }
}
