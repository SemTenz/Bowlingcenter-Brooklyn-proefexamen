<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\User;
use App\Models\Reservation;

class ScoreController extends Controller
{
    public function index()
    {
        return view('scores.index');
    }

    public function create()
    {
        // Haal alle gebruikers op die een reservering hebben geplaatst
        $users = User::whereHas('reservations')->get();

        // Haal alle reserveringen op
        $reservations = Reservation::all();

        return view('scores.create', compact('users', 'reservations'));
    }

    public function store(Request $request)
    {
        // Valideer de invoer
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'score' => 'required|integer',
            'reservation_id' => 'required|exists:reservations,id|unique:scores,reservation_id', // unieke score voor reservering
        ]);

        // Maak een nieuwe score aan
        $score = new Score();
        $score->users_id = $request->users_id;
        $score->score = $request->score;
        $score->reservation_id = $request->reservation_id;
        $score->save();

        // Stuur de gebruiker door naar de pagina met de details van de toegevoegde score
        return view('scores.show', compact('score'));
    }
}
