<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Score;

class SpelersController extends Controller
{
    public function index()
    {
        // Haal alle reserveringen op   
        $reservations = Reservation::all();
        $scores = Score::all();

        // Stuur de reserveringen en scores naar de weergave
        return view('speler.index', compact('reservations', 'scores'));
    }

    public function edit($id)
    {
        // Zoek de reservering op basis van het opgegeven ID
        $reservation = Reservation::findOrFail($id);

        // Stuur de gevonden reservering naar de weergave voor het bewerken
        return view('speler.edit', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        // Valideer de invoer van het formulier
        $request->validate([
            'score' => 'required|integer', // Zorg ervoor dat een geldig score wordt ingediend
        ]);

        try {
            // Zoek de reservering op basis van het opgegeven ID
            $reservation = Reservation::findOrFail($id);

            // Update het aantal punten van de reservering
            $reservation->update([
                'score' => $request->score,
            ]);

            // Toon een bevestigingsbericht
            return redirect()->route('speler.index')->with('success', 'Aantal punten is gewijzigd.');
        } catch (\Exception $e) {
            // Als er een fout optreedt, toon dan een foutmelding
            return redirect()->route('speler.index')->with('error', 'Er is een fout opgetreden bij het wijzigen van de aantal punten.');
        }
    }
}
