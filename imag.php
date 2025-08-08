<?php
header("Access-Control-Allow-Origin: *");
// Check if the image name parameter is provided
    $imageName = $_GET['imageName'];

    // Set the image path based on your file structure
    $imagePath = 'C:/xampp/htdocs/upload/uploads/' . $imageName;

    // Check if the image file exists
    if (file_exists($imagePath)) {
        // Set the content type header to image/jpeg (change according to your image type)
        header('Content-Type: image/png');

        // Output the image content
        readfile($imagePath);
    } else {
        // If the image file doesn't exist, return a 404 error
        http_response_code(404);
        echo 'Image not found';
    }

?>
