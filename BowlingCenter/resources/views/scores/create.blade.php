@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"
                        style="background-color: #3490dc; font-size:24px; color: black; font-weight: bold;">
                        {{ __('Score toevoegen aan Reservering') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('scores.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="users_id" class="col-md-4 col-form-label text-md-right"
                                    style="color: black; font-weight: bold;">{{ __('User ID') }}</label>

                                <div class="col-md-6">
                                    <input id="users_id" type="text"
                                        class="form-control  @error('users_id') is-invalid @enderror" name="users_id"
                                        value="{{ old('users_id') }}" required autocomplete="users_id" autofocus>

                                    @error('users_id')
                                        <span class="invalid-feedback" role="alert"style="color: red; font-weight: bold;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="score" class="col-md-4 col-form-label text-md-right"
                                    style="color: black; font-weight: bold;">{{ __('Score') }}</label>

                                <div class="col-md-6">
                                    <input id="score" type="number"
                                        class="form-control @error('score') is-invalid @enderror" name="score"
                                        value="{{ old('score') }}" required autocomplete="score">

                                    @error('score')
                                        <span class="invalid-feedback" role="alert" style="color: red; font-weight: bold;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reservation_id" class="col-md-4 col-form-label text-md-right"
                                    style="color: black; font-weight: bold;">{{ __('Reservation ID') }}</label>

                                <div class="col-md-6">
                                    <input id="reservation_id" type="text"
                                        class="form-control @error('reservation_id') is-invalid @enderror"
                                        name="reservation_id" value="{{ old('reservation_id') }}" required
                                        autocomplete="reservation_id">

                                    @error('reservation_id')
                                        <span class="invalid-feedback" role="alert" style="color: red;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary"
                                        style="background-color: #3490dc; border-color: #3490dc; font-weight: bold;">
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
