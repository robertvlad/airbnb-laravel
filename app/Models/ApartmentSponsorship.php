<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sponsorship;
use App\Models\Apartment;

class ApartmentSponsorship extends Model
{
    use HasFactory;

    protected $table = 'apartment_sponsorship'; // Nome della tabella ponte nel tuo database

    // Definizione della relazione Many-to-One con il modello Sponsorship
    public function sponsorship()
    {
        return $this->belongsTo(Sponsorship::class, 'sponsorship_id', 'id');
    }

    // Definizione della relazione Many-to-One con il modello Apartment
    public function apartment()
    {
        return $this->belongsTo(Apartment::class, 'apartment_id', 'id');
    }
}
