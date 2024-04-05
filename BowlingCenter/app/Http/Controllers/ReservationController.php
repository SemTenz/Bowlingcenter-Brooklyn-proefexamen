<?php

namespace App\Http\Controllers;

use App\Models\Options;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\usertype;

class ReservationController extends Controller
{
    public function index()
    {

        $options = Options::all();
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations', 'options'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'date_format:Y-m-d',
            'time' => 'date_format:H:i',
            'people' => 'integer',
            'phone' => 'numeric|min:1000000|max:1000000000000',
            'name' => 'nullable',
            'menu' => 'integer|nullable',
            'user_id' => 'integer|nullable',
            'employee_id' => 'nullable',
        ]);


        $reservation = new Reservation([
            'date' => $validated['date'],
            'time' => $validated['time'],
            'people' => $validated['people'],
            'phoneNumber' => $validated['phone'],
            'name' => $validated['name'],
            'options_id' => $validated['menu'],
            'users_id' => $validated['user_id'],
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
            'date' => 'date_format:Y-m-d',
            'time' => 'date_format:H:i',
            'people' => 'integer',
            'phone' => 'numeric|min:6|max:19',
            'name' => 'nullable',
            'menu' => 'integer|nullable',
            'user_id' => 'integer|nullable',
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
