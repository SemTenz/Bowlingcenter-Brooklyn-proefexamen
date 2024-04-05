@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Reservation</h1>
        <!-- Form for creating a reservation -->
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="text" name="date" id="date" class="form-control" placeholder="Enter Date">
            </div>
            <!-- Add fields for time, number of people, phone number, etc. -->
            <button type="submit" class="btn btn-primary">Create Reservation</button>
        </form>
    </div>
@endsection
