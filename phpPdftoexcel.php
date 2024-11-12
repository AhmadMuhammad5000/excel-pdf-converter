<?php 

require_once "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Smalot\PdfParser\Parser;

require_once "database/db.php";
require_once "session.php";

// Function to convert PDF to Excel
function convertPdfToExcel($pdfFile) {
    $destination = "excel/" . pathinfo($pdfFile, PATHINFO_FILENAME) . ".xlsx"; // Fix destination path

    // Parse/Read the PDF file
    $pdfParser = new Parser();
    $pdf = $pdfParser->parseFile("upload/" . $pdfFile); // Provide correct file path

    // Create Spreadsheet instance
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet(); 

    // Extract text from PDF
    $text = $pdf->getText();

    // Split text into rows by newline
    $rows = explode("\n", $text);

    // Populate Excel sheet with PDF data
    $rowNumber = 1; // Track row number in Excel sheet
    foreach ($rows as $row) {
        $columns = explode(" ", $row); // Split by space instead of empty string
        $sheet->fromArray($columns, NULL, "A$rowNumber");
        $rowNumber++;
    }

    // Write to Excel file
    $writer = new Xlsx($spreadsheet);
    $writer->save($destination);

    // Set headers for download
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=" . basename($destination));
    readfile($destination);
    exit; // Ensure script stops after download
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["convert"])) {
    if (!empty($_FILES['pdf'])) {
        $pdfFile = $_FILES["pdf"]["name"];
        $ext = pathinfo($pdfFile, PATHINFO_EXTENSION);
        $acceptableExt = ["pdf"];
        
        if (in_array($ext, $acceptableExt)) {
            $path = "upload/" . basename($conn->real_escape_string($pdfFile));
            $tmp_name = $_FILES['pdf']['tmp_name'];

            // Check if the PDF is uploaded to the upload folder           
            if (move_uploaded_file($tmp_name, $path)) {
                // Execute conversion
                convertPdfToExcel($pdfFile);
            } else {
                echo '<script>alert("File upload failed!");</script>';
            }
        } else {
            echo '<script>alert("Only PDF files are allowed!");</script>';
        }
    } else {
        echo '<script>alert("Please upload a file to convert!");</script>';
    }
}

?>