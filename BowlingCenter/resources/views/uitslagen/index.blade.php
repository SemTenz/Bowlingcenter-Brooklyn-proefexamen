@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form method="get" action="{{ route('uitslagen.index') }}">
            @csrf
            <label for="datum">Datum:</label>
            <input type="date" id="datum" name="datum" value="{{ request()->input('datum') }}">
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
                @forelse ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->user ? $reservation->user->firstname : '-' }}</td>
                        <td>{{ $reservation->user ? $reservation->user->infix : '-' }}</td>
                        <td>{{ $reservation->user ? $reservation->user->lastname : '-' }}</td>
                        <td>{{ $reservation->score }}</td>
                        <td>{{ $reservation->date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Geen reserveringen gevonden voor de geselecteerde datum.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
