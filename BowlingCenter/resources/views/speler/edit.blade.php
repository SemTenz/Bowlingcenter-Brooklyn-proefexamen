<style type="text/css">
    .custom-card {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .custom-header {
        background-color: #343a40;
        color: #fff;
        border-radius: 5px 5px 0 0;
        padding: 15px 20px;
    }

    .custom-body {
        padding: 20px;
    }

    .custom-alert {
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
    }

    .custom-label {
        font-weight: bold;
    }

    .custom-input {
        border: 1px solid #dee2e6;
        border-radius: 3px;
        padding: 8px;
        width: 100%;
    }

    .custom-btn {
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }

    .custom-btn:hover {
        background-color: #0056b3;
    }
</style>

@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom-card">
                    <div class="card-header custom-header">
                        <h2 class="mb-0">Uitslag wijzigen</h2>
                    </div>
                    <div class="card-body custom-body">
                        @if ($errors->any())
                            <div class="alert alert-danger custom-alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{ route('speler.update', $reservation->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="score" class="custom-label">Aantal punten:</label>
                                <input type="number" class="form-control custom-input" id="score" name="score"
                                    value="{{ $score->score }}" min="1" max="300">
                            </div>
                            <button type="submit" class="btn btn-primary custom-btn">Wijzigen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
