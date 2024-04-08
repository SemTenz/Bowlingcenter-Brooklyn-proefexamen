<form method="post" action="{{ route('spelers.update', $speler->id) }}">
    @csrf
    @method('PATCH')

    <!-- Voeg hier de velden toe om de gegevens van de speler te bewerken -->
    <label for="score">Aantal Punten:</label>
    <input type="number" id="score" name="score" value="{{ $speler->score }}">

    <!-- Voeg hier een knop toe om het formulier te verzenden -->
    <button type="submit">Wijzigen</button>
</form>
