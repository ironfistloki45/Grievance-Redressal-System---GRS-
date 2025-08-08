<?php
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root";
$password = "karilokesh1234@";
$database = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $regno = $_POST['regno'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];

    // SQL query to update password for the user with the given regno and contact
    $sql = "UPDATE userdetails SET password='$password' WHERE regno='$regno' AND contact='$contact'";

    // Executing SQL query
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

// Close connection
$conn->close();
?>
