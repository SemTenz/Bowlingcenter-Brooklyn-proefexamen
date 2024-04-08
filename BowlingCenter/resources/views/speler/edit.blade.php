@extends('layouts.app')

@section('content')
    <style>
        .card {
            width: 100%;
            border-collapse: collapse;
        }

        .card th,
        .card td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .card thead th {
            background-color: #343a40;
            color: #fff;
            border-color: #454d55;
        }

        .card tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .card tbody tr:hover {
            background-color: #e2e6ea;
        }

        .card .action-btn {
            padding: 4px 8px;
        }
    </style>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Uitslag wijzigen</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('speler.update', $reservation->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="score">Aantal punten:</label>
                                <input type="text" class="form-control" id="score" name="score"
                                    value="{{ $reservation->score }}">
                            </div>
                            <button type="submit" class="btn btn-primary action-btn">Wijzigen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
