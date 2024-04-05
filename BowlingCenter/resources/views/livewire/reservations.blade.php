<div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Number of People</th>
                <th>Phone Number</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time }}</td>
                    <td>{{ $reservation->people }}</td>
                    <td>{{ $reservation->phoneNumber }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
