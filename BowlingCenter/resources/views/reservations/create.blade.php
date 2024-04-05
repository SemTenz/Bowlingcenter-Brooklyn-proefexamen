@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Reservation</h1>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="text" name="date" id="date" class="form-control" placeholder="Enter Date">
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="text" name="time" id="time" class="form-control" placeholder="Enter Time">
            </div>
            <div class="form-group">
                <label for="people">Hoeveel personen</label>
                <input type="text" name="people" id="people" class="form-control" placeholder="Enter Number of People" max="8">               
            </div>

            <button type="submit" class="btn btn-primary">Create Reservation</button>
        </form>
    </div>
@endsection
