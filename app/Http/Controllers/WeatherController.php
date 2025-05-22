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
        $city = $request->query('city', '');
        $weatherData = [];
        $error = null;
        if (!empty($city)) {
            try {
                $weatherData = $this->apiService->getWeatherByCity($city);
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
