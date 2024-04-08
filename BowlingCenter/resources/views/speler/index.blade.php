@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Overzicht Spelers</h3>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Aantal Punten</th>
                    <th>Reservering ID</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->user ? $reservation->user->firstname : '-' }}
                            {{ $reservation->user ? $reservation->user->infix : '-' }}
                            {{ $reservation->user ? $reservation->user->lastname : '-' }}</td>
                        <td>{{ $reservation->score }}</td>
                        <td>{{ $reservation->id }}</td>
                        <td>
                            <a href="{{ route('speler.edit', $reservation->id) }}" class="btn btn-primary">Wijzigen</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
