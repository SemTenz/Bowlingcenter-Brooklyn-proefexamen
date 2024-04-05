<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\usertype;

class medewerkercontroller extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.medewerkers.index', compact('users'));
    }
}
