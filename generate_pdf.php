<?php
require __DIR__.'/vendor/autoload.php'; // Include Composer's autoloader

use Dompdf\Dompdf;

// Function to generate the PDF content
function generatePDFContent() {
    ob_start(); // Start output buffering
    ?>
    <html>
    <head>
        <title>Sample PDF Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            h1 {
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 8px;
                border-bottom: 1px solid #ddd;
            }
        </style>
    </head>
    <body>
        <h1>Sample PDF Report</h1>
        <table>
            <thead>
                <tr>
                    <th>Complaint ID</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sample complaint description 1</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Sample complaint description 2</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </body>
    </html>
    <?php
    $html = ob_get_clean(); // Get the buffered output and clean the buffer
    return $html;
}

// Function to generate PDF and return it as response
function generatePDF() {
    // Create a new DOMPDF instance
    $dompdf = new Dompdf();
    $dompdf->loadHtml(generatePDFContent()); // Load HTML content

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF (generate the PDF)
    $dompdf->render();

    // Output PDF as string
    $pdfContent = $dompdf->output();

    // Send PDF as response to the client
    header('Content-Type: application/pdf');
    header('Content-Length: ' . strlen($pdfContent));
    header('Content-Disposition: inline; filename="report.pdf"');
    echo $pdfContent;
    exit;
}

// Call the function to generate and output the PDF
generatePDF();
?>
