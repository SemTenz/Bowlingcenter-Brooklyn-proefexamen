@extends('layouts.app')

@section('content')
    <style>
        .custom-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .custom-form .card-header {
            background-color: #3490dc;
            font-size: 24px;
            color: black;
            font-weight: bold;
            text-align: center;
            padding: 15px 0;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .custom-form .card-body {
            padding: 30px 0;
        }

        .custom-form label {
            font-weight: bold;
            color: black;
        }

        .custom-form .form-control {
            border-radius: 5px;
        }

        .custom-form .btn-primary {
            background-color: #3490dc;
            border-color: #3490dc;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .custom-form .btn-primary:hover {
            background-color: #277fb8;
            border-color: #277fb8;
        }

        .custom-form .invalid-feedback {
            color: red;
            font-weight: bold;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom-form">
                    <div class="card-header">
                        {{ __('Score toevoegen aan Reservering') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('scores.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="users_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('User ID') }}</label>

                                <div class="col-md-6">
                                    <select id="users_id" class="form-control @error('users_id') is-invalid @enderror"
                                        name="users_id" required autocomplete="users_id">
                                        <option value="" disabled selected>Selecteer een gebruiker</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->id }}</option>
                                        @endforeach
                                    </select>
                                    @error('users_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="score"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Score') }}</label>

                                <div class="col-md-6">
                                    <input id="score" type="number"
                                        class="form-control @error('score') is-invalid @enderror" name="score"
                                        value="{{ old('score') }}" required autocomplete="score">

                                    @error('score')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reservation_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Reservation ID') }}</label>

                                <div class="col-md-6">
                                    <select id="reservation_id"
                                        class="form-control @error('reservation_id') is-invalid @enderror"
                                        name="reservation_id" required autocomplete="reservation_id">
                                        <option value="" disabled selected>Selecteer een reservering</option>
                                        @foreach ($reservations as $reservation)
                                            <option value="{{ $reservation->id }}">{{ $reservation->id }}</option>
                                        @endforeach
                                    </select>
                                    @error('reservation_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Score') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
