@extends('layouts.app')

@section('content')
    <style>
        .custom-form-group {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .custom-label {
            font-weight: bold;
            color: black;
            margin-right: 10px;
        }

        .custom-input {
            flex: 1;
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ced4da;
        }

        .custom-button {
            padding: 10px 20px;
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .custom-button:hover {
            background-color: #0056b3;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
    </style>

    <div class="container-fluid bg-light py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="get" action="{{ route('uitslagen.index') . '?' . time() }}">
                    @csrf
                    <div class="custom-form-group">
                        <label for="datum" class="custom-label">Datum:</label>
                        <input type="date" id="datum" name="datum" value="{{ request()->input('datum') }}"
                            class="custom-input">
                        <button type="submit" class="custom-button">Toon</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead class="thead-dark">
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
                                    <td>
                                        {{ optional($scores->where('reservation_id', $reservation->id)->first())->score ?? '-' }}
                                    </td>
                                    <td>{{ $reservation->date }}</td>
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
    <script>
        // JavaScript om de geselecteerde datum te wissen bij vernieuwen van de pagina
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('dateForm');
            const dateInput = document.getElementById('datum');

            // Controleer of er een datum is geselecteerd bij het laden van de pagina
            if (dateInput.value) {
                // Wis de geselecteerde datum om terug te keren naar de standaardweergave
                dateInput.value = '';
                // Verzend het formulier automatisch om de standaardweergave te laden
                form.submit();
            }
        });
    </script>
@endsection
