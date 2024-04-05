@extends('layouts.app')
<x-app-layout>
    @section('content')
    <div class="container">
        <h1>My Reservations</h1>

        <table>
            <th>datum en tijd </th>
            <th>naam </th>
            <th>aantal personen</th>
            <th>telefoonnummer </th>

            <th>extra optie</th>


            @foreach ($reservations as $reservation)
            <td>{{$reservation->reservation}}</td>
            <tr>

                <td>{{ $reservation->date }} {{ $reservation->time }}</td>
                <td>{{ $reservation->name }}</td>
                <td>{{ $reservation->people }}</td>
                <td>{{ $reservation->phoneNumber }}</td>

                @if ($reservation->options_id >= 1)
                <td>{{ $reservation->options_id }}</td>
                @else
                <td>niet van toepassing</td>
                @endif
                <td><a href="{{ route('reservations.edit', $reservation->id) }}">Edit</a></td>
                <td>
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endsection

</x-app-layout>