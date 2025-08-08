<?php
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root";
$password = "karilokesh1234@";
$database = "users";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $regno = $_POST['regno'];
        $contact = $_POST['contact'];

        $stmt = $conn->prepare("SELECT * FROM userdetails WHERE regno = ? AND contact = ?");
        $stmt->bind_param("ss", $regno, $contact);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "success";
        } else {
            http_response_code(400);
        }
    }
}

$conn->close();
?>
