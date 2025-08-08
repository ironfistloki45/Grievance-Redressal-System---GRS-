<?php

// Replace these values with your actual database connection details
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

// SQL query to fetch data from the database
$sql = "SELECT * FROM complaintslist";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    // Fetch data row by row
    while($row = $result->fetch_assoc()) {
        // Append each row to the data array
        $data[] = $row;
    }
    // Convert data array to JSON format
    echo json_encode($data);
} else {
    // If no rows found, return an empty array
    echo "[]";
}

// Close connection
$conn->close();

?>
