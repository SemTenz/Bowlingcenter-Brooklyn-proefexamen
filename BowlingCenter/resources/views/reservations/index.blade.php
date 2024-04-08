<head>
    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include jQuery UI library -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<style>
    .alert {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .reservation-table {
        width: 100%;
        border-collapse: collapse;
    }

    .reservation-table th,
    .reservation-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .reservation-table th {
        background-color: #f2f2f2;
    }

    .btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>


@extends('layouts.app')

<x-app-layout>
    @section('content')
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('deleted'))
            <div class="alert alert-danger">
                {{ session('deleted') }}
            </div>
        @endif
        
        <div class="container">
            <h1>My Reservations</h1>

            <table class="reservation-table">
                <thead>
                    <tr>
                        <th>
                            <a href="#" class="sort-link" data-sort-by="date">
                                <input type="text" id="datepicker" style="display: none;">
                                datum en tijd <i class="fa fa-calendar"></i>
                            </a>
                        </th>
                        <th>naam</th>
                        <th>aantal personen</th>
                        <th>telefoonnummer</th>
                        <th>extra optie</th>
                        <th>Bewerken</th>
                        <th>Verwijderen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->date }} {{ $reservation->time }}</td>
                            <td>{{ $reservation->name }}</td>
                            <td>{{ $reservation->people }}</td>
                            <td>{{ $reservation->phoneNumber }}</td>
                            <td>
                                @if ($reservation->options_id >= 1)
                                    {{ $reservation->options_id }}
                                @else
                                    niet van toepassing
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary">Wijzigen</a>
                            </td>
                            <td>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            $(document).ready(function() {
                const sortLinks = document.querySelectorAll(".sort-link");

                sortLinks.forEach(function(link) {
                    link.addEventListener("click", function(e) {
                        e.preventDefault();
                        const sortBy = this.getAttribute("data-sort-by");

                        // Initialize datepicker
                        $("#datepicker").datepicker({
                            onSelect: function(selectedDate) {
                                sortTable(sortBy, selectedDate);
                            }
                        }).datepicker("show");
                    });
                });

                function sortTable(sortBy, selectedDate) {
                    const table = document.querySelector(".reservation-table");
                    const tbody = table.querySelector("tbody");
                    const rows = Array.from(tbody.querySelectorAll("tr"));

                    rows.sort(function(rowA, rowB) {
                        const cellA = rowA.querySelector("td:nth-child(" + (getColumnIndex(sortBy) + 1) + ")");
                        const cellB = rowB.querySelector("td:nth-child(" + (getColumnIndex(sortBy) + 1) + ")");

                        if (sortBy === 'date') {
                            return new Date(cellB.textContent) - new Date(cellA.textContent);
                        } else {
                            return cellA.textContent.localeCompare(cellB.textContent);
                        }
                    });

                    tbody.innerHTML = "";
                    rows.forEach(function(row) {
                        tbody.appendChild(row);
                    });

                    // Close datepicker
                    $("#datepicker").datepicker("hide");
                }

                function getColumnIndex(columnName) {
                    const tableHead = document.querySelector(".reservation-table thead");
                    const headers = Array.from(tableHead.querySelectorAll("th"));
                    return headers.findIndex(header => header.textContent.trim() === columnName);
                }
            });
        </script>
    @endsection
</x-app-layout>
