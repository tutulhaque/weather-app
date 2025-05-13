<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">

        <h1>Weather App</h1>

        <label class="label" for="city">Enter city name</label>

        <form method="get" action="{{ route('weather') }}">

            <input type="text" name="city" class="input" placeholder="e.g., London" id="city"
                autocomplete="off" value="{{ $city }}" />

            <button type="submit" class="btn btn-default">Get Weather</button>

        </form>
    </div>
    <div class="container">
        @if ($error)
            <div class="alert" style="color: var(--accent-1); margin-top: 1em;">

                {{ $error }}

            </div>
        @elseif (!empty($weatherData))
            <h2>Weather in {{ $weatherData['name'] }}</h2>
            <p><strong>Temperature:</strong> {{ $weatherData['main']['temp'] }} °C</p>
            <p><strong>Humidity:</strong> {{ $weatherData['main']['humidity'] }}%</p>
            <p><strong>Conditions:</strong> {{ $weatherData['weather'][0]['description'] }}</p>
            <p><strong>Wind:</strong> {{ $weatherData['wind']['speed'] }} m/s</p>
        @endif
    </div>
</body>

</html>
