<?php
header("Access-Control-Allow-Origin: *");

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "karilokesh1234@";
$database = "complaints";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values sent from Flutter app
$dropdownValue1 = $_POST['dropdown1'] ?? '';
$dateValue = $_POST['date'] ?? '';
$predefinedValue = $_POST['predefined'] ?? '';
$dept = $_POST['dept'] ?? '';
$dateValue2 = $_POST['date1'] ?? '';

// Construct SQL query based on the received values
if ($dropdownValue1 == 'All') {
    $sql = "SELECT * FROM department WHERE date BETWEEN '$dateValue' AND '$dateValue2' AND type = '$predefinedValue' AND dept='$dept'";
} else {
    $sql = "SELECT * FROM department WHERE status = '$dropdownValue1' AND date BETWEEN '$dateValue' AND '$dateValue2' AND type = '$predefinedValue' AND dept='$dept'";
}

// Execute query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an array to store fetched data
    $data = array();
    
    // Fetch data and add it to the array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    // Encode the array as JSON and echo it
    echo json_encode($data);
} else {
    echo json_encode("no results");
}

$conn->close();
?>
