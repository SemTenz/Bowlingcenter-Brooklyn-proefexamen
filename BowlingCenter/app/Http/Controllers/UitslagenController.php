<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Uitslag;

class UitslagenController extends Controller
{
    public function index()
    {
        // Controleer of de gebruiker is ingelogd
        if (Auth::check()) {
            // Haal de ingelogde gebruiker op
            $user = Auth::user();

            // Haal alle reserveringen op van de ingelogde gebruiker
            $reservations = Reservation::where('users_id', $user->id)->get();

            // Stuur de reserveringen naar de weergave
            return view('uitslagen.index', compact('reservations'));
        } else {
            // Gebruiker is niet ingelogd, doorverwijzen naar inlogpagina of andere actie
            return redirect()->route('login');
        }
        // Haal de uitslagen op en sorteer aflopend op aantalpunten
        $uitslagen = Uitslag::orderByDesc('aantalpunten')->get();

        // Stuur de uitslagen naar de weergave
        return view('uitslagen.index', compact('uitslagen'));
    }


    public function show(Request $request)
    {
        // Verwerk de formuliervelden hier
    }
}
