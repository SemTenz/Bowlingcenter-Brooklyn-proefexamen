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
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="reservation-form">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST" id="reservation-form">
            @csrf
            <div class="form-group">
                <label for="name">Naam:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="date">Datum:</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="totalhours">Aantal uren:</label>
                <input type="number" name="totalhours" id="totalhours" class="form-control" min="1" required>
            </div>
            <div class="form-group">
                <label for="start_time">Start tijd:</label>
                <input type="time" name="start_time" id="start_time" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_time">Eind Tijd:</label>
                <input type="time" name="end_time" id="end_time" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lane_number">Baannummer:</label>
                <select name="lane_number" id="lane_number" class="form-control" required>
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="adults">Volwassenen:</label>
                <input type="number" name="adults" id="adults" class="form-control" min="1" required>
            </div>
            <div class="form-group">
                <label for="children">Kinderen:</label>
                <input type="number" name="children" id="children" class="form-control" min="0" required>
                <span id="children-message" class="text-danger"></span> <!-- Melding voor kinderen en baannummer -->
            </div>
            <div class="form-group">
                <label for="phone_number">Telefoonnummer:</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="menu">Pakket:</label><br>
                <input type="radio" name="menu" value="1" required> Snackpakketbasis<br>
                <input type="radio" name="menu" value="2" required> Snackpakketluxe<br>
                <input type="radio" name="menu" value="3" required> Kinderpartij<br>
                <input type="radio" name="menu" value="4" required> Vrijgezellenfeest<br>
            </div>
            <button type="submit" class="btn btn-primary">Reserveer</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('reservation-form').addEventListener('submit', function(event) {
            var childrenInput = parseInt(document.getElementById('children').value);
            var laneNumberSelect = document.getElementById('lane_number');
            var selectedLane = parseInt(laneNumberSelect.value);
            var childrenMessage = document.getElementById('children-message');

            // Controleer of kinderen zijn geselecteerd maar geen baan 7 of 8 is gekozen
            if (childrenInput > 0 && (selectedLane < 7 || selectedLane > 8)) {
                event.preventDefault(); // Voorkom dat het formulier wordt verzonden
                childrenMessage.textContent = 'Alleen baan 7 en 8 zijn beschikbaar voor reserveringen met kinderen.';
            } else {
                childrenMessage.textContent = ''; // Wis de melding als de selectie geldig is
            }
        });
    });
</script>
@endsection
