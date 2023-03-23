<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config('apartments');

        foreach ($apartments as $apartment) {
            $newApartment = new Apartment();
            $newApartment->title = $apartment['title'];
            $newApartment->description = $apartment['description'];
            $newApartment->room_n = $apartment['room_n'];
            $newApartment->bed_n = $apartment['bed_n'];
            $newApartment->bath_n = $apartment['bath_n'];
            $newApartment->square_meters = $apartment['square_meters'];
            $newApartment->visible = $apartment['visible'];
            $newApartment->address = $apartment['address'];
            $newApartment->latitude = $apartment['latitude'];
            $newApartment->longitude = $apartment['longitude'];
            $newApartment->cover_img = $apartment['cover_img'];
            $newApartment->slug = Apartment::generateSlug($newApartment->title);
            $newApartment->save();
        }
    }
}