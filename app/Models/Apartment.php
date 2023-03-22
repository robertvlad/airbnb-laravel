<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable =  ['title', 'slug', 'description', 'room_n', 'bed_n', 'bath_n', 'square_meters', 'visible', 'address', 'latitude', 'longitude', 'cover_image'];
}
