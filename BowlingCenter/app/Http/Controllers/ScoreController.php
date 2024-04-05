<?php
// app/Http/Controllers/ScoreController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\User;
use App\Models\Reservation;

class ScoreController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'score' => 'required|integer',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        // Create a new score
        $score = new Score();
        $score->users_id = $request->users_id;
        $score->score = $request->score;
        $score->reservation_id = $request->reservation_id;
        $score->save();

        // Redirect to a success page or return a response
        return redirect()->route('dashboard')->with('success', 'Score toegevoegd!');
    }
    public function index()
    {
        return view('scores.sparesoftware');
    }
}
