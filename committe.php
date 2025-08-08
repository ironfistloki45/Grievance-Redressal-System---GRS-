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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the user exists in the userdetails table
    $sql_userdetails = "SELECT * FROM committe WHERE id = '$username' AND password = '$password'";
    $result_userdetails = $conn->query($sql_userdetails);

    if ($result_userdetails->num_rows > 0) {
        echo 'success';
    } else {
        echo 'failure';
    }

    // Close the database connection
    $conn->close();
}
?>
