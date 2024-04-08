<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Uitslagen;
use Illuminate\Support\Carbon;
use App\Models\Score;


class UitslagenController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::all();
        $scores = Score::all();
        // Controleer of de gebruiker is ingelogd
        if (Auth::check()) {
            // Haal de ingelogde gebruiker op
            $user = Auth::user();

            // Haal alle reserveringen op van de ingelogde gebruiker
            $query = Reservation::query()->where('users_id', $user->id);

            // Voeg een datumfilter toe als er een datum is ingediend via het formulier
            if ($request->has('datum')) {
                $datum = Carbon::parse($request->input('datum'))->toDateString();
                // dd($datum); // Voeg deze regel toe om de waarde van $datum te controleren
                $query->whereDate('date', $datum);
            }

            // Haal de reserveringen op basis van de query
            $reservations = $query->get();

            // Stuur de reserveringen naar de weergave
            return view('uitslagen.index', compact('reservations', 'scores'));
        } else {
            // Gebruiker is niet ingelogd, doorverwijzen naar inlogpagina of andere actie
            return redirect()->route('login');
        }
    }



    public function store(Request $request)
    {
        // Valideer de invoer van het formulier
        $request->validate([
            'datum' => 'nullable|date', // Zorg ervoor dat de datum optioneel is en een geldig datumformaat heeft
        ]);

        // Als er een datum is ingediend, redirect dan naar de indexpagina met de datum als query parameter
        if ($request->has('datum')) {
            return redirect()->route('uitslagen.index', ['datum' => $request->input('datum')]);
        }

        // Als er geen datum is ingediend, redirect dan naar de indexpagina zonder query parameters
        return redirect()->route('uitslagen.index');
    }




    public function show($id)
    {
        // Zoek de uitslag op basis van het opgegeven ID
        $uitslag = Uitslagen::find($id);

        // Controleer of de uitslag bestaat
        if (!$uitslag) {
            // Als de uitslag niet bestaat, redirect met een foutmelding
            return redirect()->route('uitslagen.index')->with('error', 'Uitslag niet gevonden.');
        }

        // Stuur de gevonden uitslag naar de weergave
        return view('uitslagen.show', compact('uitslag'));
    }
}
