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

<x-app-layout>
    
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
                        <th>datum en tijd</th>
                        <th>naam</th>
                        <th>aantal personen</th>
                        <th>telefoonnummer</th>
                        <th>extra optie</th>
                        <th>Bewerken</th>
                        <th>Verwijderen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->date }} {{ $reservation->time }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->people }}</td>
                        <td>{{ $reservation->phoneNumber }}</td>

                        <td>
                            @if ($reservation->options_id >= 1)
                                {{ $reservation->options_id }}
                            @else
                                niet van toepassing
                            @endif
                        </td>
                        
                        <td><a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</x-app-layout>
