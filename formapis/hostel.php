<?php
header("Access-Control-Allow-Origin: *");

// Assuming you have already established a connection to your MySQL database
// Replace 'localhost', 'root', 'password', and 'hostel' with your actual database credentials
$mysqli = new mysqli('localhost', 'root', 'karilokesh1234@', 'hostel');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Fetch form data
$regNo = $_POST['regNo'];
$complaintType = $_POST['complaintType'];
$category = $_POST['category'];
$description = $_POST['description'];
$complaintSequence = $_POST['complaintSequence'];
// Prepare and bind SQL statement
$stmt = $mysqli->prepare("INSERT INTO complaintslist (complaintid, regno, type, category, description, date,status) VALUES (?, ?, ?, ?, ?, NOW(),'Registred')");
$stmt->bind_param("sssss", $complaintSequence, $regNo, $complaintType, $category, $description);

// Execute SQL statement
if ($stmt->execute()) {
    echo "Success"; // Send success response
} else {
    echo "Failed"; // Send failure response
}

// Close statement and connection
$stmt->close();
$mysqli->close();
?>
