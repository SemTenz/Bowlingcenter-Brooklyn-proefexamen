<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'time',
        'people',
        'phoneNumber',
        'name',
        'options_id',
        'users_id',
        'employee_id',
    ];
}
