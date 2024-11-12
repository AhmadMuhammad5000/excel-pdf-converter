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
    <div class="all">
        <div class="header">
            <h2 class="fs-4">File Converter</h2>
            <div class="div d-flex align-items-center">
                <span class=""><a href="dashboard.php" class="">Pdf to Excel</a></span>
                <span class="ms-3"><a href="exceltopdf.php" class="">Excel to Pdf</a></span>
            </div>
            <span class="text-primary"><a href="logout.php">Logout</a></span>
        </div>
    </div>

    <!-- Welcoming user -->
    <i class="ms-2 fs-5"> Hi, <?php echo $_SESSION['username']; ?> </i>

</body>
</html>