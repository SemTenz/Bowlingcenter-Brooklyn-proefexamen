<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\usertype;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'date' => 'required'
        ]);
        $reservation = new Reservation([
            'date' => $request->get('date'),
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

        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'people' => 'required',
            'phoneNumber' => 'required',
            'name' => 'nullable',
            'options_id' => 'required',
            'users_id' => 'required',
            'employee_id' => 'nullable',


        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully!');
    }
}
