<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'date',
        'totalhours',
        'start_time',
        'end_time',
        'lane_number',
        'adults',
        'children',
        'phone_number',
        'menu',
        'users_id',
        'employee_id',
    ];
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

