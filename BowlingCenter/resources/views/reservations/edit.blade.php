@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Reservation</h1>
        <!-- Form for editing a reservation -->
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="text" name="date" id="date" class="form-control" value="{{ $reservation->date }}">
            </div>
            <!-- Add fields for time, number of people, phone number, etc. -->
            <button type="submit" class="btn btn-primary">Update Reservation</button>
        </form>
    </div>
@endsection
