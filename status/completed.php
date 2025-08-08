<?php
// Establish database connection
header("Access-Control-Allow-Origin: *");

// Connect to the 'hostel' database
$hostel_conn = new mysqli('localhost', 'root', 'karilokesh1234@', 'hostel');

// Connect to the 'complaints' database
$complaints_conn = new mysqli('localhost', 'root', 'karilokesh1234@', 'complaints');

// Check connection for 'hostel' database
if ($hostel_conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $hostel_conn->connect_error;
    exit();
}

// Check connection for 'complaints' database
if ($complaints_conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $complaints_conn->connect_error;
    exit();
}

// Fetch data based on entered text
$text = $_GET['text']; // Assuming text is passed as a query parameter
$text = $hostel_conn->real_escape_string($text); // Sanitize input

if (empty($text)) {
    echo "Text is required.";
    exit();
}

// Query 'hostel' database for complaints
$hostel_sql = "SELECT complaintid, type, category, description, date FROM complaintslist WHERE regno = '$text'AND status='Completed'";
$hostel_result = $hostel_conn->query($hostel_sql);

if (!$hostel_result) {
    echo "Error: " . $hostel_sql . "<br>" . $hostel_conn->error;
    exit();
}

// Query 'complaints' database for complaints
$complaints_sql = "SELECT complaintid, type, category, description, date FROM department WHERE regno = '$text' AND status='Completed'";
$complaints_result = $complaints_conn->query($complaints_sql);

if (!$complaints_result) {
    echo "Error: " . $complaints_sql . "<br>" . $complaints_conn->error;
    exit();
}

// Combine results from both databases
$data = array();
while ($row = $hostel_result->fetch_assoc()) {
    $data[] = $row;
}

while ($row = $complaints_result->fetch_assoc()) {
    $data[] = $row;
}

// Return combined data as JSON
echo json_encode($data);

// Close connections
$hostel_conn->close();
$complaints_conn->close();
?>
