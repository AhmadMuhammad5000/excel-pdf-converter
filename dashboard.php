<?php require_once 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="CSS/bootstrap-5.1.3-dist/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/dashboard.css">

    <title>Dashboard</title>
</head>

<body>
    <?php require_once "header.php"; ?>
    
    <div class="all">
    <!-- Body -->
    <div class="body container mt-3 rounded">
        <div class="">
            <form method="POST" action="phpPdftoexcel.php" enctype="multipart/form-data">
                <div class="div">
                    <label><i>Upload Your Pdf file for Conversion !</i> </label> <br><br>
                        <label id="label" for="upload"><i class="fa fa-upload fs-5"></i>Upload here!</label>  
                        <input type="file" name="pdf" id="upload" accept=".pdf" class="d-none"/>
                 </div>

                <button name="convert" class="mt-2 btn btn-primary"><i class="fa fa-exchange me-2"></i>Convert to Excel</button>
            </form>
        </div>
    </div>

    <p class="mt-3 fs-5 text-center"><i class="fa fa-rotate"></i> Your converted file will be downloaded autimatically !</p>

    </div>
</body>
</html>