<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usertype extends Model
{
    use HasFactory;

    protected $fillable = [
        'usertype',
    ];

    protected $table = 'usertypes';

    public function Users()
    {
        return $this->hasMany(User::class, 'usertype');
    }
}
