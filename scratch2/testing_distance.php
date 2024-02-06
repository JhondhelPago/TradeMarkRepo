<?php
// Replace OPENROUTESERVICE_API_KEY with your OpenRouteService API key
$openRouteServiceApiKey = '5b3ce3597851110001cf62482d63e1d674184ffeaf70166c4c846223';

// Replace OPENCAGE_API_KEY with your OpenCage Geocoding API key
$openCageApiKey = '88accf2c52d04a86bfecfacfcac45fbe';

// Replace originCity, originCountry, destinationCity, destinationCountry with your city and country names
$originCity = 'Malabon';
$originCountry = 'Philippines';
$destinationCity = 'Taguig';
$destinationCountry = 'Philippines';

// Function to get coordinates using OpenCage Geocoding API
function getCoordinates($city, $country, $apiKey) {
    $cityCountry = urlencode($city . ', ' . $country);
    $geocodingUrl = "https://api.opencagedata.com/geocode/v1/json?q=$cityCountry&key=$apiKey";
    $response = file_get_contents($geocodingUrl);
    $data = json_decode($response, true);
    return [
        'lat' => $data['results'][0]['geometry']['lat'],
        'lng' => $data['results'][0]['geometry']['lng']
    ];
}

// Get coordinates for origin and destination
$originCoordinates = getCoordinates($originCity, $originCountry, $openCageApiKey);
$destinationCoordinates = getCoordinates($destinationCity, $destinationCountry, $openCageApiKey);

// Build the OpenRouteService API request URL
$requestUrl = "https://api.openrouteservice.org/v2/directions/driving-car?api_key=$openRouteServiceApiKey&start=${originCoordinates['lng']},${originCoordinates['lat']}&end=${destinationCoordinates['lng']},${destinationCoordinates['lat']}";

// Make the API request
$response = file_get_contents($requestUrl);

// Decode the JSON response
$data = json_decode($response, true);

// Check if the request was successful
if (isset($data['features'][0]['properties']['segments'][0]['distance'])) {
    // Extract distance information
    $distance = $data['features'][0]['properties']['segments'][0]['distance'];
    $duration = $data['features'][0]['properties']['segments'][0]['duration'];

    // Output the distance
    echo "Distance: $distance meters\n";
    echo "Duration: $duration duration\n";
} else {
    // Handle API error
    echo "Error: Unable to retrieve distance\n";
}
?>