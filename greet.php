<?php
// Requirement: Set the JSON header
header('Content-Type: application/json');

// Requirement: Read input from $_GET
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name'];
    
    // Create a personalized message
    $response = [
        "status" => "success",
        "message" => "Hello, " . $name . "! Keep up the great work on your internship."
    ];
} else {
    // Fallback if no name is provided
    $response = [
        "status" => "error",
        "message" => "Name parameter is missing. Try adding ?name=Sam to the URL."
    ];
}

// Requirement: Return data
echo json_encode($response);
?>

