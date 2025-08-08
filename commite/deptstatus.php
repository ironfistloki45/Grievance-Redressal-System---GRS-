<?php
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root";
$password = "karilokesh1234@";
$database = "complaints";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Retrieve complaint ID from the query parameter
$complaintId = $_GET['complaintid'];

// Update status in the database (Replace 'complaintslist' with your actual table name)
$query = "UPDATE department SET status = 'Viewed by Committee' WHERE complaintid = '$complaintId'";

// Execute the query
if ($conn->query($query) === TRUE) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
