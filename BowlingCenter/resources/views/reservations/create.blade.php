@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .reservation-form {
        margin-bottom: 20px;
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
        box-sizing: border-box;
    }


    .radio-group label {
        display: inline-block;
        margin-right: 15px;
        padding: 8px 15px;
        border-radius: 20px;
        border: 1px solid #ccc;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .radio-group label:hover {
        background-color: #f0f0f0;
    }

    input[type="radio"]:checked + label {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
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
                <input type="number" name="totalhours" id="totalhours" class="form-control" min="1" max="4" required>
            </div>
            <div class="form-group">
                <label for="start_time">Start tijd:</label>
                <input type="time" name="start_time" id="start_time" class="form-control">
            </div>
            <div class="form-group">
                <input type="hidden" name="end_time" id="end_time" class="form-control" readonly>
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
            var laneNumberInput = parseInt(document.getElementById('lane_number').value);
            var laneError = document.getElementById('lane-error');

            if (childrenInput > 0 && (laneNumberInput < 7 || laneNumberInput > 8)) {
                laneError.textContent = 'Alleen baan 7 en 8 zijn beschikbaar voor reserveringen met kinderen.';
                event.preventDefault(); // Voorkom dat het formulier wordt verzonden
            } else {
                laneError.textContent = ''; // Wis de foutmelding als alles in orde is
            }
        });

        // Vul de eindtijd automatisch in op basis van de begintijd en het totale aantal uren
        document.getElementById('start_time').addEventListener('change', function() {
            var startTime = this.value;
            var totalHours = document.getElementById('totalhours').value;
            var start = new Date("January 1, 2000 " + startTime);
            start.setHours(start.getHours() + parseInt(totalHours));
            var endHours = start.getHours().toString().padStart(2, '0');
            var endMinutes = start.getMinutes().toString().padStart(2, '0');
            var endTime = endHours + ':' + endMinutes;
            document.getElementById('end_time').value = endTime;
        });
    });
</script>
@endsection
