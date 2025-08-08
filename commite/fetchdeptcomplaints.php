<?php
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root";
$password = "karilokesh1234@";
$database = "complaints";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = isset($_GET['type']) ? $_GET['type'] : ''; // Check if 'type' parameter is set

if ($type !== '') {
    // Fetch complaints based on type
    $sql = "SELECT complaintid, dept,type, category, description, date ,status FROM department WHERE type = '$type'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $complaints = array();
        while($row = $result->fetch_assoc()) {
            $complaints[] = $row;
        }
        echo json_encode($complaints);
    } else {
        echo json_encode(array()); // Return empty array if no complaints found
    }
} else {
    echo "Text is required."; // Return error message if 'type' parameter is not provided
}

// Close connection
$conn->close();
?>
