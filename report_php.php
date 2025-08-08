<?php
// Database connection parameters
$servername = "localhost";
$username = "username";
$password = "password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM your_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store results in an array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    // Output data as JSON
    echo json_encode($data);
} else {
    echo "No data found";
}

// Close connection
$conn->close();
?>
