<!-- resources/views/scores/sparesoftware.blade.php -->

@extends('layouts.app') <!-- You might need to adjust the layout name -->

@section('content')
    <h1>Add Score</h1>

    <form method="POST" action="{{ route('sparesoftware.scores.store') }}">
        @csrf

        <label for="users_id">User ID:</label>
        <input type="text" id="users_id" name="users_id" required>
        <br>

        <label for="score">Score:</label>
        <input type="number" id="score" name="score" required>
        <br>

        <label for="reservation_id">Reservation ID:</label>
        <input type="text" id="reservation_id" name="reservation_id" required>
        <br>

        <button type="submit">Add Score</button>
    </form>
@endsection
