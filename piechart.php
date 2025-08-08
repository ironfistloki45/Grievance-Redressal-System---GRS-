<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "karilokesh1234@";
$dbname = "hostel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data
$sql = "SELECT status, COUNT(*) as count FROM your_table GROUP BY status";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
$conn->close();
?>
