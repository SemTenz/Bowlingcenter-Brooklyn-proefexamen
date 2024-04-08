@extends('layouts.app')

@section('content')
<style>
    .reservation-form {
        max-width: 400px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    input[type="time"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .alert {
        background-color: #f2dede;
        color: #a94442;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <div class="reservation-form">
        <h1>Edit Reservation</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" id="reservation-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Naam:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $reservation->name }}">
            </div>
            <div class="form-group">
                <label for="date">Datum:</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $reservation->date }}" required>
            </div>

            <div class="form-group">
                <label for="totalhours">Totaal aantal uren:</label>
                <input type="number" name="totalhours" id="totalhours" class="form-control" value="{{ $reservation->totalhours }}" min="1" required>
            </div>

            <div class="form-group">
                <label for="start_time">Start tijd:</label>
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $reservation->start_time }}" required>
            </div>

            <div class="form-group">
                <label for="end_time">Eind tijd:</label>
                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $reservation->end_time }}" required>
            </div>

            <div class="form-group">
                <label for="lane_number">Baan nummer:</label>
                <input type="number" name="lane_number" id="lane_number" class="form-control" value="{{ $reservation->lane_number }}" min="1" max="8" required>
                <span id="lane-error" class="text-danger"></span> <!-- Melding voor baan nummer en kinderen -->
            </div>

            <div class="form-group">
                <label for="adults">Volwassenen:</label>
                <input type="number" name="adults" id="adults" class="form-control" value="{{ $reservation->adults }}" min="1" required>
            </div>

            <div class="form-group">
                <label for="children">Kinderen:</label>
                <input type="number" name="children" id="children" class="form-control" value="{{ $reservation->children }}" min="0" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Telefoonnummer:</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $reservation->phone_number }}" required>
            </div>

            <div class="form-group">
                <label for="menu">Gekozen pakket:</label><br>
                <input type="radio" name="menu" value="1" {{ $reservation->menu == 1 ? 'checked' : '' }} required> Snackpakketbasis<br>
                <input type="radio" name="menu" value="2" {{ $reservation->menu == 2 ? 'checked' : '' }} required> Snackpakketluxe<br>
                <input type="radio" name="menu" value="3" {{ $reservation->menu == 3 ? 'checked' : '' }} required> Kinderpartij<br>
                <input type="radio" name="menu" value="4" {{ $reservation->menu == 4 ? 'checked' : '' }} required> Vrijgezellenfeest<br>
            </div>

            @if(auth()->check())
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @endif

            <button type="submit" class="btn btn-primary">Update Reservation</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('reservation-form').addEventListener('submit', function(event) {
            var childrenInput = parseInt(document.getElementById('children').value);
            var laneNumberInput = parseInt(document.getElementById('lane_number').value);
            var laneError = document.getElementById('lane-error');

            if (childrenInput > 0 && (laneNumberInput < 7 || laneNumberInput > 8)) {
                laneError.textContent = 'Alleen baan 7 en 8 zijn beschikbaar voor reserveringen met kinderen.';
                event.preventDefault(); // Voorkom dat het formulier wordt verzonden
            } else {
                laneError.textContent = ''; // Wis de foutmelding als alles in orde is
            }
        });
    });
</script>
@endsection
