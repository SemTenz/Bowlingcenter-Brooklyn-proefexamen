@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"
                        style="background-color: #3490dc; color: black; font-size:34px; font-weight: bold;">
                        Score Details
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="users_id" class="col-md-4 col-form-label text-md-right"
                                    style="color: black; font-weight: bold;">User ID</label>

                                <div class="col-md-6">
                                    <input id="users_id" type="text" class="form-control" value="{{ $score->users_id }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="score" class="col-md-4 col-form-label text-md-right"
                                    style="color: black; font-weight: bold;">Score</label>

                                <div class="col-md-6">
                                    <input id="score" type="number" class="form-control" value="{{ $score->score }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reservation_id" class="col-md-4 col-form-label text-md-right"
                                    style="color: black; font-weight: bold;">Reservation ID</label>

                                <div class="col-md-6">
                                    <input id="reservation_id" type="text" class="form-control"
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
