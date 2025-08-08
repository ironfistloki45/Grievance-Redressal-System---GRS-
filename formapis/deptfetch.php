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
} else {
    // Get the complaint type from the request parameters
    $complaintType = $_GET['complaintType'];

    // Query to get the count of complaints based on the complaint type
    $sql = "SELECT COUNT(*) AS count FROM department WHERE type = '$complaintType'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $row = $result->fetch_assoc();
        echo $row["count"];
    } else {
        echo "0"; // If no complaints found, return 0
    }
}

$conn->close();
?>
