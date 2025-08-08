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

// Query to fetch complaints data
$query = "SELECT complaintid, category, description FROM complaintslist";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Fetch complaints data
    $complaints = array();
    while ($row = $result->fetch_assoc()) {
        $complaints[] = $row;
    }

    // Close connection
    $conn->close();

    // Return complaints data as JSON
    echo json_encode($complaints);
} else {
    echo "No complaints found";
}

?>
