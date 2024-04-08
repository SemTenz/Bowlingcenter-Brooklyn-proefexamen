@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Overzicht Uitslagen</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Voeg hier eventuele navigatielinks toe -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <form method="post" action="{{ route('uitslagen.index') }}">
            @csrf
            <label for="datum">Datum:</label>
            <input type="date" id="datum" name="datum">

            <button type="submit" class="btn btn-primary">Toon</button>
        </form>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Voornaam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Aantal Punten</th>
                    <th>Datum</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->user ? $reservation->user->firstname : '-' }}</td>
                        <td>{{ $reservation->user ? $reservation->user->infix : '-' }}</td>
                        <td>{{ $reservation->user ? $reservation->user->lastname : '-' }}</td>
                        <td>{{ $reservation->score }}</td>
                        <td>{{ $reservation->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
