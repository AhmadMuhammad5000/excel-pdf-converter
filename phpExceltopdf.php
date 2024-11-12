<?php 
require_once "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once "database/db.php";
require_once "session.php";

// Function to convert Excel to PDF
function convertExcelToPdf($excelFile) {
    // Ensure the output directory exists
    $destinationDir = __DIR__ . "/pdf/";  // Absolute path for output directory
    if (!is_dir($destinationDir)) {
        mkdir($destinationDir, 0777, true); // Create directory if it doesn't exist
    }
    
    // Define the absolute path for the output PDF file
    $destination = $destinationDir . pathinfo($excelFile, PATHINFO_FILENAME) . ".pdf";

    // Load Excel file
    $inputFilePath = __DIR__ . "/upload/" . $excelFile;  // Absolute path for input file
    $reader = new Xlsx();
    $spreadsheet = $reader->load($inputFilePath);

    // Create TCPDF instance
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Ahmad');
    $pdf->SetTitle('Excel to PDF Conversion');
    $pdf->SetSubject('Converted PDF');

    // Set default header and footer
    $pdf->setHeaderData('', 0, 'Excel to PDF', '');
    $pdf->setFooterData();

    // Set header and footer fonts
    $pdf->setHeaderFont(['helvetica', '', 10]);
    $pdf->setFooterFont(['helvetica', '', 8]);

    // Set default font
    $pdf->SetFont('helvetica', '', 10);

    // Add a page
    $pdf->AddPage();

    // Get active sheet data as array
    $data = $spreadsheet->getActiveSheet()->toArray();

    // Write data to PDF
    foreach ($data as $row) {
        foreach ($row as $cell) {
            $pdf->Cell(40, 10, $cell, 1);
        }
        $pdf->Ln();
    }

    // Output PDF to specified path
    $pdf->Output($destination, 'F');

    // Set headers for download
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=" . basename($destination));
    readfile($destination);
    exit; // Ensure the script stops after download
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["convert"])) {
    if (!empty($_FILES['excel'])) {
        $excelFile = $_FILES["excel"]["name"];
        $ext = pathinfo($excelFile, PATHINFO_EXTENSION);
        $acceptableExt = ["xlsx", "xls"];
        
        if (in_array($ext, $acceptableExt)) {
            $path = __DIR__ . "/upload/" . basename($conn->real_escape_string($excelFile));  // Use absolute path
            $tmp_name = $_FILES['excel']['tmp_name'];

            // Check if the Excel file is uploaded to the upload folder
            if (move_uploaded_file($tmp_name, $path)) {
                // Execute file conversion
                convertExcelToPdf($excelFile);
            } else {
                echo '<script>alert("File upload failed!");</script>';
            }
        } else {
            echo '<script>alert("Only .xlsx, .xls files are required!");</script>';
        }
    } else {
        echo '<script>alert("Please upload a file to convert!");</script>';
    }
}
?>
