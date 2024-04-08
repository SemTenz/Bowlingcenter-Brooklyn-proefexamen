<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
    }

    .reservation-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .reservation-table th,
    .reservation-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .reservation-table th {
        background-color: #f0f0f0;
    }

    .reservation-table td:last-child {
        text-align: center;
    }

    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
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

        <form method="get" action="{{ route('reservations.index') }}">
            @csrf
            <div class="form-group row justify-content-center">
                <label for="datum" class="col-md-2 col-form-label text-md-right">Datum:</label>
                <div class="col-md-4">
                    <input type="date" id="datum" name="datum" value="{{ request()->input('datum') }}"
                        class="form-control">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Toon</button>
                </div>
            </div>
        </form>

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
                    <th>Aanpassen / Verwijderen</th> <!-- Cell for Edit / Delete buttons -->
                </tr>
            </thead>
            <tbody>
                @if ($reservations->isEmpty())
                    <tr>
                        <td colspan="10">Er zijn geen reserveringen gevonden.</td> <!-- Colspan 10 for single cell -->
                    </tr>
                @else
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
                            
                            <td>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary">Edit</a>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
