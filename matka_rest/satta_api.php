<?php
// satta_api.php

// Define the API endpoint and credentials
$url = "https://matkaapi.com/api/market_api.php";
$domain_key = "2cba6ab53f715a42594be3c2fb385ba7";
$api_key = "674ac29a5ac47";
$domain = "stakeye.com";

// Data to be sent in the POST request
$postData = [
    "domain" => $domain,
    "api_key" => $api_key,
    "domain_key" => $domain_key,
    "gali" => "all", // Change to specific "gali Name" if required
    "old" => true    // Set to true if old results are needed
];

// Initialize cURL
$ch = curl_init();

// cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Accept: application/json"
]);

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    curl_close($ch);
    exit;
}

// Close cURL
curl_close($ch);

// Decode and display the response
$responseData = json_decode($response, true);

if ($responseData && isset($responseData['status']) && $responseData['status'] === true) {
    echo "<h2>API Response:</h2>";
    echo "<pre>";
    print_r($responseData);
    echo "</pre>";
} else {
    echo "<h2>API Error:</h2>";
    echo "<pre>";
    print_r($responseData);
    echo "</pre>";
}
?>
