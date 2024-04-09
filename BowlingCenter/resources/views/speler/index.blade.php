<style type="text/css">
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .custom-table th,
    .custom-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #dee2e6;
    }

    .custom-table thead th {
        background-color: #343a40;
        color: #fff;
        border-color: #454d55;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .custom-table tbody tr:hover {
        background-color: #e2e6ea;
    }

    .custom-table .action-btn {
        padding: 6px 12px;
    }
</style>

@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <h3 class="text-center mb-4">Overzicht Spelers</h3>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table custom-table mx-auto">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Naam</th>
                                <th class="text-center">Aantal Punten</th>
                                <th class="text-center">Reservering ID</th>
                                <th class="text-center">Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->user ? $reservation->user->firstname : '-' }}
                                        {{ $reservation->user ? $reservation->user->infix : '' }}
                                        {{ $reservation->user ? $reservation->user->lastname : '-' }}</td>
                                    <td>{{ $scores->where('reservation_id', $reservation->id)->first()->score }}</td>
                                    <td>{{ $reservation->id }}</td>
                                    <td>
                                        <a href="{{ route('speler.edit', $reservation->id) }}"
                                            class="btn btn-sm btn-primary action-btn">Wijzigen</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
