<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['apartment_id', 'message', 'user_mail'];

    public function apartments()
    {
        return $this->belongsTo(Apartment::class);
    }

}
