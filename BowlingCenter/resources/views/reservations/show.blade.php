@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservation Details</h1>
        <p><strong>Date:</strong> {{ $reservation->date }}</p>
        <!-- Add details for time, number of people, phone number, etc. -->
        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary">Edit Reservation</a>
        <!-- Add delete button if necessary -->
    </div>
@endsection
