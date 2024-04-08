<div class="container-fluid bg-light py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="get" action="{{ route('uitslagen.index') }}">
                @csrf
                <div class="form-group row justify-content-center">
                    <label for="datum" class="col-md-2 col-form-label text-md-right">Datum:</label>
                    <div class="col-md-4">
                        <input type="date" id="datum" name="datum" value="{{ request()->input('datum') }}"
                            class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Toon</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive rounded bg-white shadow">
                <table class="table custom-table mx-auto">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Voornaam</th>
                            <th class="text-center">Tussenvoegsel</th>
                            <th class="text-center">Achternaam</th>
                            <th class="text-center">Aantal Punten</th>
                            <th class="text-center">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td class="text-center">{{ $reservation->user ? $reservation->user->firstname : '-' }}
                                </td>
                                <td class="text-center">{{ $reservation->user ? $reservation->user->infix : '-' }}</td>
                                <td class="text-center">{{ $reservation->user ? $reservation->user->lastname : '-' }}
                                </td>
                                <td class="text-center">
                                    {{ $scores->where('reservation_id', $reservation->id)->first()->score }}</td>
                                <td class="text-center">{{ $reservation->date }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Geen reserveringen gevonden voor de geselecteerde
                                    datum.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection