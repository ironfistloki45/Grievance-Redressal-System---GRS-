<?php
header("Access-Control-Allow-Origin: *");

// Database connection parameters for the first database
$servername1 = "localhost";
$username1 = "root";
$password1 = "karilokesh1234@";
$database1 = "complaints";

// Database connection parameters for the second database
$servername2 = "localhost";
$username2 = "root";
$password2 = "karilokesh1234@";
$database2 = "hostel";

// Create connection to the first database
$conn1 = new mysqli($servername1, $username1, $password1, $database1);

// Create connection to the second database
$conn2 = new mysqli($servername2, $username2, $password2, $database2);

// Check connection to the first database
if ($conn1->connect_error) {
    die("Connection to first database failed: " . $conn1->connect_error);
}

// Check connection to the second database
if ($conn2->connect_error) {
    die("Connection to second database failed: " . $conn2->connect_error);
}

// Query to fetch counts from the first database
$totalComplaintsQuery1 = "SELECT COUNT(*) AS total_complaints FROM department";
$processingComplaintsQuery1 = "SELECT COUNT(*) AS processing_complaints FROM department WHERE status = 'Viewed by Committee'";
$solvedComplaintsQuery1 = "SELECT COUNT(*) AS solved_complaints FROM department WHERE status = 'completed'";

// Query to fetch counts from the second database
$totalComplaintsQuery2 = "SELECT COUNT(*) AS total_complaints FROM complaintslist";
$processingComplaintsQuery2 = "SELECT COUNT(*) AS processing_complaints FROM complaintslist WHERE status = 'Viewed by Committee'";
$solvedComplaintsQuery2 = "SELECT COUNT(*) AS solved_complaints FROM complaintslist WHERE status = 'completed'";

// Execute queries for the first database
$totalComplaintsResult1 = $conn1->query($totalComplaintsQuery1);
$processingComplaintsResult1 = $conn1->query($processingComplaintsQuery1);
$solvedComplaintsResult1 = $conn1->query($solvedComplaintsQuery1);

// Execute queries for the second database
$totalComplaintsResult2 = $conn2->query($totalComplaintsQuery2);
$processingComplaintsResult2 = $conn2->query($processingComplaintsQuery2);
$solvedComplaintsResult2 = $conn2->query($solvedComplaintsQuery2);

// Check if queries for the first database were successful
if (!$totalComplaintsResult1 || !$processingComplaintsResult1 || !$solvedComplaintsResult1) {
    die("Error fetching counts from the first database: " . $conn1->error);
}

// Check if queries for the second database were successful
if (!$totalComplaintsResult2 || !$processingComplaintsResult2 || !$solvedComplaintsResult2) {
    die("Error fetching counts from the second database: " . $conn2->error);
}

// Fetch counts from the first database
$row = $totalComplaintsResult1->fetch_assoc();
$totalComplaintsCount1 = $row['total_complaints'];
$row = $processingComplaintsResult1->fetch_assoc();
$processingComplaintsCount1 = $row['processing_complaints'];
$row = $solvedComplaintsResult1->fetch_assoc();
$solvedComplaintsCount1 = $row['solved_complaints'];

// Fetch counts from the second database
$row = $totalComplaintsResult2->fetch_assoc();
$totalComplaintsCount2 = $row['total_complaints'];
$row = $processingComplaintsResult2->fetch_assoc();
$processingComplaintsCount2 = $row['processing_complaints'];
$row = $solvedComplaintsResult2->fetch_assoc();
$solvedComplaintsCount2 = $row['solved_complaints'];

// Close result sets and connections
$totalComplaintsResult1->close();
$processingComplaintsResult1->close();
$solvedComplaintsResult1->close();
$totalComplaintsResult2->close();
$processingComplaintsResult2->close();
$solvedComplaintsResult2->close();
$conn1->close();
$conn2->close();

// Calculate total counts by adding counts from both databases
$total_total = $totalComplaintsCount1 + $totalComplaintsCount2;
$processing_total = $processingComplaintsCount1 + $processingComplaintsCount2;
$solved_total = $solvedComplaintsCount1 + $solvedComplaintsCount2;

// Return only the summed counts for each category
echo json_encode([
    'total_total' => $total_total,
    'processing_total' => $processing_total,
    'solved_total' => $solved_total,
]);
?>
