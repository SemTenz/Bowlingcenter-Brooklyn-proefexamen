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
            'date' => 'required|date_format:Y-m-d',
            'totalhours' => 'nullable|integer',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'lane_number' => 'nullable|integer|min:1|max:8',
            'adults' => 'nullable|integer',
            'children' => 'nullable|integer',
            'phone_number' => 'nullable|string',
            'menu' => 'nullable|integer',
            'user_id' => 'nullable|integer',
            'employee_id' => 'nullable|integer',
        ]);

        // Validatie voor baan 7 en 8
        if ($validated['children'] > 0 && ($validated['lane_number'] <7 )){
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
            'date' => 'required|date_format:Y-m-d',
            'totalhours' => 'nullable|integer',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'lane_number' => 'nullable|integer|min:1|max:8',
            'adults' => 'nullable|integer',
            'children' => 'nullable|integer',
            'phone_number' => 'nullable|string',
            'menu' => 'nullable|integer',
            'user_id' => 'nullable|integer',
            'employee_id' => 'nullable|integer',
        ]);

        // Validatie voor baan 7 en 8
        if ($validated['children'] > 0 && ($validated['lane_number'] < 7)) {
            return redirect()->back()->withInput()->with('error', 'Alleen baan 7 en 8 zijn beschikbaar voor reserveringen met kinderen.');
        }

        if ($validated['date'] < date('Y-m-d')) {
            return redirect()->back()->with('error', 'You cannot update a reservation in the past!');
        }

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
