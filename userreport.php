<?php
header("Access-Control-Allow-Origin: *");

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "karilokesh1234@";
$database = "hostel";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values sent from Flutter app
$dropdownValue1 = $_POST['dropdown1'] ?? '';
$dropdownValue2 = $_POST['dropdown2'] ?? '';
$dateValue = $_POST['date'] ?? '';
$predefinedValue = $_POST['predefined'] ?? '';
$dateValue2 = $_POST['date1'] ?? '';

// Construct SQL query based on the received values
if ($dropdownValue1 == 'All' && $dropdownValue2 == 'All') {
    $sql = "SELECT * FROM complaintslist WHERE date BETWEEN '$dateValue' AND '$dateValue2' AND regno = '$predefinedValue'";
}else if($dropdownValue2 == 'All' && $dropdownValue1 != 'All') {
        $sql = "SELECT * FROM complaintslist WHERE date BETWEEN '$dateValue' AND '$dateValue2' AND regno = '$predefinedValue' AND status='$dropdownValue1'";
    } 
    else if($dropdownValue2 != 'All' && $dropdownValue1 == 'All') {
        $sql = "SELECT * FROM complaintslist WHERE date BETWEEN '$dateValue' AND '$dateValue2' AND regno = '$predefinedValue' AND type='$dropdownValue2'";
    } 
 else {
    $sql = "SELECT * FROM complaintslist WHERE status = '$dropdownValue1' AND date BETWEEN '$dateValue' AND '$dateValue2' AND type = '$dropdownValue2' AND regno = '$predefinedValue' ";
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
