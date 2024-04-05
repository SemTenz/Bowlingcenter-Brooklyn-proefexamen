<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    public function index()
    {
        return view('scores.index');
    }

    public function create()
    {
        return view('scores.create');
    }

    public function store(Request $request)
    {
        // Valideer de invoer
        $request->validate([
            'users_id' => 'required|exists:users,id',
            'score' => 'required|integer',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        // Maak een nieuwe score aan
        $score = new Score();
        $score->users_id = $request->users_id;
        $score->score = $request->score;
        $score->reservation_id = $request->reservation_id;
        $score->save();

        // Stuur de gebruiker door naar de pagina met de details van de toegevoegde score
        return redirect()->route('scores.show', $score)->with('success', 'Score toegevoegd!');
    }

    public function show(Score $score)
    {
        return view('scores.show', compact('score'));
    }
}
