@extends('layouts.app')

@section('content')
    <style>
        .custom-card {
            margin-top: 50px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .custom-card-header {
            background-color: #3490dc;
            color: white;
            font-size: 34px;
            font-weight: bold;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .custom-label {
            color: black;
            font-weight: bold;
        }

        .custom-form-control {
            border-radius: 5px;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom-card">
                    <div class="card-header custom-card-header">
                        Score Details
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="users_id" class="col-md-4 col-form-label text-md-right custom-label">User
                                    ID</label>

                                <div class="col-md-6">
                                    <input id="users_id" type="text" class="form-control custom-form-control"
                                        value="{{ $score->users_id }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="score"
                                    class="col-md-4 col-form-label text-md-right custom-label">Score</label>

                                <div class="col-md-6">
                                    <input id="score" type="number" class="form-control custom-form-control"
                                        value="{{ $score->score }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reservation_id"
                                    class="col-md-4 col-form-label text-md-right custom-label">Reservation ID</label>

                                <div class="col-md-6">
                                    <input id="reservation_id" type="text" class="form-control custom-form-control"
                                        value="{{ $score->reservation_id }}" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
