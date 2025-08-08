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
$sql = "SELECT complaintid,type,category,description,date FROM complaintslist WHERE complaintid = '$complaintId'";

// Execute SQL query
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch row from the result
    $complaintData = $result->fetch_assoc();
    
    // Encode the complaint data as JSON and output it
    echo json_encode($complaintData);
} else {
    // If no complaint is found for the complaint ID, return an empty object
    echo json_encode(new stdClass());
}

// Close the database connection
$conn->close();
?>
