<?php
// Establish connection to MySQL database
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "karilokesh1234@"; // Replace with your MySQL password
$database = "users"; // Replace with your MySQL database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get complaint ID from query parameter
$text = $_GET['complaintid'];

// Prepare and execute SQL query
$query = "SELECT filename FROM image WHERE complaintid = '$text'";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Fetch data and store filenames in array
$list = array();
while ($row = $result->fetch_assoc()) {
    // Extract filename part and add to the list without quotes
    $filename = $row['filename'];
    $filenameParts = explode(':', $filename); // Split by colon
    $list[] = end($filenameParts); // Get the last part (filename) without quotes
}

// Close statement and connection
$stmt->close();
$conn->close();

// Encode array as JSON and output
echo json_encode($list);
?>
