<?php

namespace App\Http\Controllers;

use App\Models\Options;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $options = Options::all();
        $reservations = Reservation::orderByDesc('date')->get();
        return view('reservations.index', compact('reservations', 'options'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d|after_or_equal:today', // Toegevoegde regel
            'totalhours' => 'nullable|integer|max:4',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'lane_number' => 'nullable|integer|min:1|max:8',
            'adults' => 'nullable|integer',
            'children' => 'nullable|integer|max:4',
            'phone_number' => 'nullable|string|regex:/^\+?[0-9]{8,}$/',
            'menu' => 'nullable|integer',
            'user_id' => 'nullable|integer',
            'employee_id' => 'nullable|integer',
        ]);

        // Validatie voor baan 7 en 8
        if ($validated['children'] > 0 && ($validated['lane_number'] <7 )) {
            return redirect()->back()->withInput()->with('error', 'Alleen baan 7 en 8 zijn beschikbaar voor reserveringen met kinderen.');
        }

        $reservation = new Reservation($validated);
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'start_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $currentTime = now();
                    $selectedTime = \Carbon\Carbon::parse($value);
                    
                    // Controleer of de starttijd na 14:00 uur is
                    if ($selectedTime->lt($currentTime->setTime(14, 0))) {
                        return $fail('U kunt pas na 14:00 uur reserveren.');
                    }
                    
                    // Controleer of het zaterdag is en of de starttijd voor 24:00 uur is
                    if ($selectedTime->dayOfWeek === \Carbon\Carbon::SATURDAY && $selectedTime->gt($currentTime->setTime(23, 59))) {
                        return $fail('Op zaterdag kunt u tot 24:00 uur reserveren.');
                    }
                    
                    // Controleer of de starttijd niet na 22:00 uur is (behalve op zaterdag)
                    if ($selectedTime->gt($currentTime->setTime(22, 0)) && $selectedTime->dayOfWeek !== \Carbon\Carbon::SATURDAY) {
                        return $fail('U kunt alleen tot 22:00 uur reserveren.');
                    }
                },
            ],
            'totalhours' => 'nullable|integer|max:10',
            'lane_number' => 'nullable|integer|min:1|max:8',
            'adults' => 'nullable|integer',
            'children' => 'nullable|integer|max:4',
            'phone_number' => 'nullable|string|regex:/^\+?[0-9]{8,}$/',
            'menu' => 'nullable|integer',
            'user_id' => 'nullable|integer',
            'employee_id' => 'nullable|integer',
        ]);

        $start = \Carbon\Carbon::parse($validated['start_time']);
        $end = $start->copy()->addHours(intval($validated['totalhours']));

        // Voeg de eindtijd toe aan de validatie
        $validated['end_time'] = $end->format('H:i');

        // Controleer het tijdsbereik op de beschikbaarheid van de bowlingbaan
        $existingReservation = Reservation::where('lane_number', $validated['lane_number'])
            ->where('date', $validated['date'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']]);
            })
            ->where('id', '!=', $reservation->id)
            ->first();

        if ($existingReservation) {
            return redirect()->back()->withInput()->with('error', 'De geselecteerde bowlingbaan is al bezet voor dit tijdsbereik.');
        }

        // Als alles in orde is, update de reservering
        $reservation->update($validated);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully!');
    }
}
