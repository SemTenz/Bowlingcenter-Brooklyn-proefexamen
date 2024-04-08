<style>
    .alert {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .reservation-table {
        width: 100%;
        border-collapse: collapse;
    }

    .reservation-table th,
    .reservation-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .reservation-table th {
        background-color: #f2f2f2;
    }

    .btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>
@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif
    
    <div class="container">
        <h1>My Reservations</h1>

        <table class="reservation-table">
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Naam</th>
                    <th>Telefoonnummer</th>
                    <th>Start Tijd</th>
                    <th>Eind Tijd</th>
                    <th>Baan nummer</th>
                    <th>Volwassenen</th>
                    <th>Kinderen</th>
                    <th>Gekozen pakket</th>
                    <th>Aanpassen</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->date }} {{ $reservation->start_time}} - {{ $reservation->end_time }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->phone_number }}</td>
                        <td>{{ $reservation->start_time }}</td>
                        <td>{{ $reservation->end_time }}</td>
                        <td>{{ $reservation->lane_number }}</td>
                        <td>{{ $reservation->adults }}</td>
                        <td>{{ $reservation->children }}</td>

                        <td>
                            @if ($reservation->menu == 1)
                                Snackpakketbasis
                            @elseif ($reservation->menu == 2)
                                Snackpakketluxe
                            @elseif ($reservation->menu == 3)
                                Kinderpartij
                            @elseif ($reservation->menu == 4)
                                Vrijgezellenfeest
                            @else
                                Not Applicable
                            @endif
                        </td>
                        
                        <td><a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
