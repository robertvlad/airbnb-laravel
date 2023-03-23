<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'user_mail', 'name', 'surname'];

    public function apartments(){
        return $this->belongsTo(Apartment::class);
    }

}
