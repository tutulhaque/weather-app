<?php

namespace App\Http\Controllers;

use App\Services\CallApiService;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected CallApiService $apiService;
    public function __construct(CallApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        $city = $request->query('city', ''); // Default to empty string
        $weatherData = []; // Initialize empty array
        $error = null; // No error initially

        if (!empty($city)) {
            try {
                $weatherData = $this->apiService->getWeatherByCity($city); // Assuming method is named getWeatherByCity
                if (empty($weatherData) || isset($weatherData['cod']) && $weatherData['cod'] !== 200) {
                    $error = 'City not found or API error.';
                }
            } catch (\Exception $e) {
                $error = 'Error fetching weather data: ' . $e->getMessage();
            }
        }

        return view('weather', [
            'city' => $city,
            'weatherData' => $weatherData,
            'error' => $error,
        ]);
    }
}
