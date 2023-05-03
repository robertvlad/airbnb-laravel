<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Optional;
use App\Models\Message;
use App\Models\User;
use App\Models\Sponsorship;
use App\Models\Image;
use App\Models\View;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable =  ['user_id', 'title', 'slug', 'description', 'room_n', 'bed_n', 'bath_n', 'square_meters', 'visible', 'address', 'latitude', 'longitude', 'cover_img'];

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function optionals()
    {
        return $this->belongsToMany(Optional::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function sponsorship()
    {
        return $this->hasOne(ApartmentSponsorship::class, 'apartment_id', 'id');
    }

}
