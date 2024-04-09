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
        'user_id',
        'employee_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

