<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'usertype_id',
    ];
    protected $table = 'employees';
    public function usertype()
    {
        return $this->belongsTo(usertype::class);
    }
}
