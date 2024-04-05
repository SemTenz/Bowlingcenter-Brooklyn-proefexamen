<style>
    .reservation-form {
        max-width: 400px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    input[type="time"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .alert {
        background-color: #f2dede;
        color: #a94442;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    </style/ @extends('layouts.app') @section('content') <div class="container"><form action="{{ route('reservations.store') }}" method="POST">@csrf <div class="form-group"><label for="date">Date:</label><input type="date" name="date" id="date" class="form-control" placeholder="Enter Date" required value="$"></div><div class="form-group"><label for="time">Time:</label><input type="time" name="time" id="time" class="form-control" placeholder="Enter Time" required></div><div class="form-group"><label for="people">Number of People:</label><input type="number" name="people" id="people" class="form-control" placeholder="Enter Number of People" min="1" max="8" required></div><div class="form-group"><label for="phone">Phone Number:</label><input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number" required></div><div class="form-group"><label for="name">Name:</label><input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"></div><div class="form-group"><label for="menu">Menu Options:</label><br><input type="radio" name="menu" value="1">snackpakket<br><input type="radio" name="menu" value="2">kinderpartij<br><input type="radio" name="menu" value="3">vrijgezellenfeest<br></div><div>@if(auth()->check()) <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">@endif </div>@if ($errors->any()) <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error) <li> {
            {
            $error
        }
    }

    </li>@endforeach </ul></div>@endif <button type="submit" class="btn btn-primary">Create Reservation</button></form></div>@endsection