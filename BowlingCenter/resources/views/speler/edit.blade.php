@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Uitslag wijzigen</h2>
        <form method="post" action="{{ route('speler.update', $reservation->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="score">Aantal punten:</label>
                <input type="text" class="form-control" id="score" name="score" value="{{ $reservation->score }}">
            </div>
            <button type="submit" class="btn btn-primary">Wijzigen</button>
        </form>
    </div>
@endsection
