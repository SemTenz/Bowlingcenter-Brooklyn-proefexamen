<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uitslagen extends Model
{
    protected $fillable = ['users_id', 'score', 'reservation_id'];

    // Definieer de relatie met de gebruiker
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Definieer de relatie met de reservering
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
