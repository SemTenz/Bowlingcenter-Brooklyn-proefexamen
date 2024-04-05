<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bowlingworld Brooklyn</title>

    <!-- Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Galindo&family=Eras+Demi+ITC&display=swap');

        body {
            font-family: 'Eras Demi ITC', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
            background: url('/img/background.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            position: relative;
        }

        h1 {
            font-family: 'Galindo', cursive;
            color: #FFE500;
            text-align: center;
            margin-top: 50px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background-color: rgba(20, 29, 50, 0.9); /* Adjusted for transparency */
            color: #fff;
            padding: 20px;
            border-bottom: 2px solid #0e1626;
            text-align: center;
        }

        nav a,
        .auth-links a,
        .logout-button {
            margin: 0 10px;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            background-color: #F56AC6;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: inline-block; /* Ensure buttons are inline */
            min-width: 120px; /* Set minimum width for buttons */
            text-align: center; /* Center text within buttons */
        }

        nav a:hover,
        .auth-links a:hover,
        .logout-button:hover {
            background-color: #d443b6;
        }

        main {
            padding: 20px 0;
            text-align: center;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px 0;
            background-color: rgba(20, 29, 50, 0.9); /* Adjusted for transparency */
            color: #fff;
            text-align: center;
            border-top: 2px solid #0e1626;
        }

        footer p {
            margin: 0;
        }

        .auth-links {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .auth-links a {
            margin: 0 10px;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            background-color: #F56AC6;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: inline-block; /* Ensure buttons are inline */
            min-width: 120px; /* Set minimum width for buttons */
            text-align: center; /* Center text within buttons */
        }

        .auth-links a:hover {
            background-color: #d443b6;
        }

        section {
            margin-bottom: 20px;
        }

        section h2 {
            color: #FFE500;
        }

        section p {
            color: #ddd; /* Adjusted for better readability */
            margin: 10px 0;
            background-color: #0e1626;
            padding: 10px;
            border-radius: 5px;
        }

        /* Custom style for logout button */
        .logout-button {
            font-family: 'Eras Demi ITC', sans-serif;
            font-size: medium;
            margin: 0 10px;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            background-color: #F56AC6;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: inline-block; /* Ensure buttons are inline */
            min-width: 120px; /* Set minimum width for buttons */
            text-align: center; /* Center text within buttons */
        }

        .logout-button:hover {
            background-color: #d443b6;
            cursor: pointer;
        }

    </style>
</head>
<body>
<header>
    <h1>Bowlingworld Brooklyn</h1>
    <nav>
        <a href="/" class="btn">Home</a>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn">Mijn Dashboard</a>
                <x-nav-link :href="route('reservations.create')" :active="request()->routeIs('reservations.create')" class="btn">
                    {{ __('Reserveringen') }}
                </x-nav-link>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn logout-button">Uitloggen</button>
                </form>
            @else
                <div class="auth-links">
                    <a href="{{ route('login') }}" class="btn">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn">Registreren</a>
                    @endif
                </div>
            @endauth
        @endif
    </nav>
</header>



    <main>
        <section>
            <h2>Welcome to Bowlingworld Brooklyn</h2>
            <p>Discover the thrill of strikes and spares! Find the best bowling alleys, join leagues, and explore bowling tips.</p>
        </section>

        <section>
            <h2>Tarieven</h2>
            <p>Maandag t/m donderdag: € 24,00 per uur per baan</p>
            <p>Vrijdag t/m zondag van 14:00 tot 18:00: € 28,00 per uur per baan</p>
            <p>Vrijdag t/m zondag na 18:00 uur: € 33,50 per uur per baan</p>
        </section>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Bowlingworld Brooklyn. All rights reserved.</p>
    </footer>
</body>
</html>
