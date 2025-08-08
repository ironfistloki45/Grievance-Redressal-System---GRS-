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

// Get data from POST request
$complaintId = $_POST['complaintid'];
$text = $_POST['text'];

// SQL query to insert data into another table
$sql = "INSERT INTO feedback (complaintid, feedback) VALUES ('$complaintId', '$text')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
