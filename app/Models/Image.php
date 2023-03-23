<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

    public function apartments(){
        return $this->belongsTo(Apartment::class);
    }
}
