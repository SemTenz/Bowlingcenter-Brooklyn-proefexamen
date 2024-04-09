@extends('layouts.app')

@section('content')
    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
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

        .custom-btn {
            padding: 10px 20px;
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container-fluid bg-light py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="get" action="{{ route('uitslagen.index') }}">
                    @csrf
                    <div class="form-group row align-items-center justify-content-center">
                        <label for="datum" class="col-md-2 col-form-label text-md-right">Datum:</label>
                        <div class="col-md-3">
                            <input type="date" id="datum" name="datum" value="{{ request()->input('datum') }}"
                                class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary custom-btn">Toon</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive rounded bg-white shadow">
                    <table class="table custom-table mx-auto">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Voornaam</th>
                                <th class="text-center">Tussenvoegsel</th>
                                <th class="text-center">Achternaam</th>
                                <th class="text-center">Aantal Punten</th>
                                <th class="text-center">Datum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reservations as $reservation)
                                <tr>
                                    <td class="text-center">{{ $reservation->user ? $reservation->user->firstname : '-' }}
                                    </td>
                                    <td class="text-center">{{ $reservation->user ? $reservation->user->infix : '-' }}</td>
                                    <td class="text-center">{{ $reservation->user ? $reservation->user->lastname : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ optional($scores->where('reservation_id', $reservation->id)->first())->score ?? '-' }}
                                    </td>

                                    <td class="text-center">{{ $reservation->date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Geen reserveringen gevonden voor de geselecteerde
                                        datum.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
