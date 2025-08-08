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
    // Get the data from POST request
    $regNo = $_POST['regNo'];
    $complaintType = $_POST['complaintType'];
    $department = $_POST['department'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $complaintSequence = $_POST['complaintSequence'];

    // Prepare SQL statement to insert data into the database
    $sql_insert = "INSERT INTO department (complaintid, regno, dept, type, category, description, date, status) VALUES ('$complaintSequence', '$regNo', '$department', '$complaintType', '$category', '$description', NOW(), 'Registered')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Complaint registered successfully";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$conn->close();
?>
