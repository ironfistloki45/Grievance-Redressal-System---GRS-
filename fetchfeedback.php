<?php
header("Access-Control-Allow-Origin: *");

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "karilokesh1234@";
$database = "hostel";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get complaint ID from GET request
$complaintId = $_GET['complaintid'];

// Prepare SQL statement
$sql = "SELECT * FROM feedback WHERE complaintid = '$complaintId' ";

// Execute SQL query
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Initialize an array to store feedback data
$feedbackData = array();

// Fetch all rows from the result and add them to the feedback data array
while($row = $result->fetch_assoc()) {
    $feedbackData[] = $row;
}

// Encode the feedback data array as JSON and output it
echo json_encode($feedbackData);

// Close the database connection
$conn->close();
?>
