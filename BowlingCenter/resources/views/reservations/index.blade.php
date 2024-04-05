@extends('layouts.app')
<x-app-layout>
    @section('content')
    <div class="container">
        <h1>My Reservations</h1>
        <livewire:reservations />
    </div>
    @endsection

</x-app-layout>