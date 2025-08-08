<?php
header("Access-Control-Allow-Origin: *");

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "karilokesh1234@";
$database = "hostel";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch counts
$totalComplaintsQuery = "SELECT COUNT(*) AS total_complaints FROM complaintslist WHERE status = 'Registred'";
$processingComplaintsQuery = "SELECT COUNT(*) AS processing_complaints FROM complaintslist WHERE status = 'Viewed by Committee'";
$solvedComplaintsQuery = "SELECT COUNT(*) AS solved_complaints FROM complaintslist WHERE status = 'completed'";

$totalComplaintsResult = $conn->query($totalComplaintsQuery);
$processingComplaintsResult = $conn->query($processingComplaintsQuery);
$solvedComplaintsResult = $conn->query($solvedComplaintsQuery);

// Check if queries were successful
if ($totalComplaintsResult && $processingComplaintsResult && $solvedComplaintsResult) {
    // Fetch counts
    $totalComplaintsCount = $totalComplaintsResult->fetch_assoc()["total_complaints"];
    $processingComplaintsCount = $processingComplaintsResult->fetch_assoc()["processing_complaints"];
    $solvedComplaintsCount = $solvedComplaintsResult->fetch_assoc()["solved_complaints"];

    // Close connections
    $totalComplaintsResult->close();
    $processingComplaintsResult->close();
    $solvedComplaintsResult->close();
    
    // Close connection
    $conn->close();

    // Calculate the total count
    $totalCount = $totalComplaintsCount + $processingComplaintsCount + $solvedComplaintsCount;

    // Return counts as JSON
    echo json_encode([
        'status' => ['Registered', 'Viewed by Committee', 'Completed'],
        'counts' => [$totalComplaintsCount, $processingComplaintsCount, $solvedComplaintsCount],
        'totalCount' => $totalCount,
    ]);
} else {
    echo "Error: " . $conn->error;
}
?>
