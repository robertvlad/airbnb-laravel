<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Optional;

class OptionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $optionals = config('optionals');

        foreach ($optionals as $optional) {
            $newOptional = new Optional();
            $newOptional->name = $optional['name'];
            $newOptional->icon = $optional['icon'];
            $newOptional->slug = Optional::generateSlug($newOptional->name);
            $newOptional->save();
        }
    }
}
