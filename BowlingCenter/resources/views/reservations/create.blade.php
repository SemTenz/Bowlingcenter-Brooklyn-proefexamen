@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Reservation</h1>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" class="form-control" placeholder="Enter Date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" name="time" id="time" class="form-control" placeholder="Enter Time" required>
            </div>
            <div class="form-group">
                <label for="people">Number of People:</label>
                <input type="number" name="people" id="people" class="form-control" placeholder="Enter Number of People" min="1" max="8" required>               
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="menu">Menu Options:</label><br>
                <input type="radio" name="menu" value="1" required> Menu A<br>
                <input type="radio" name="menu" value="2" required> Menu B<br>
                <input type="radio" name="menu" value="3" required> Menu C<br>
            </div>
            
            <button type="submit" class="btn btn-primary">Create Reservation</button>
        </form> 

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Create Reservation</button>
        </form>
    </div>
@endsection
