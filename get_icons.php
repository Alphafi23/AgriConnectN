<?php
// Specify the path to the JSON file
$jsonFilePath = 'status_icon.json';

// Read the file contents
$jsonData = file_get_contents($jsonFilePath);

// Check if the file was read successfully
if ($jsonData === false) {
    // Handle the error, maybe set a default JSON response
    $jsonData = json_encode(["error" => "Unable to read icon data"]);
}

// Set the content type to JSON
header('Content-Type: application/json');

// Echo the JSON data
echo $jsonData;
?>
