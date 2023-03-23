<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;
use Illuminate\Support\Str;

class Optional extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon', 'slug'];

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }

    public function apartments(){
        return $this->belongsToMany(Apartment::class);
    }

}
