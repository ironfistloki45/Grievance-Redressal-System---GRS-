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
    $regNo = $_POST['regno'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];

    // SQL query to check if user already exists
    $checkQuery = "SELECT * FROM userdetails WHERE regno='$regNo'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // User already exists
        echo "exists";
    } else {
        // User does not exist, insert into table
        $sql = "INSERT INTO userdetails (regno, username, email, password, contact) VALUES ('$regNo', '$username', '$email', '$password', '$contact')";

        // Execute SQL query
        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }
    }
}

// Close connection
$conn->close();
?>
