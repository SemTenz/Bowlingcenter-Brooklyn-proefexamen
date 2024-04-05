<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\usertype;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('id', auth()->id())->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'nullable',
            'time' => 'nullable',
            'people' => 'nullable',

        ]);
        $reservation = new Reservation([
            'date' => $validated['date'],
            'time' => $validated['time'],
            'people' => $validated['people'],

            'user_id' => auth()->id(),
        ]);

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
            'date' => 'nullable',
            'time' => 'nullable',
            'people' => 'nullable',
            'phoneNumber' => 'nullable',
            'name' => 'nullable',
            'options_id' => 'nullable',
            'users_id' => 'nullable',
            'employee_id' => 'nullable',
        ]);

        $reservation->fill($validated)->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
    }


    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully!');
    }
}
