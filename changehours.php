<?php
session_start();

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";

$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change hours</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="changehours.css">


</head>

<body>

    <?php include 'header.php'; ?>

    <form method="post" action="">
    <div class="container" style="text-align: center;">
        <br><br>
        <h2>Below is the time you are working now</h2>  
        <br><br>

        <br><br>
        <h2>48 hours</h2>  
        <br><br>

        <br><br>
        <h2>If you want to increase the time, please enter the length of time you want to increase</h2>  
        <br><br>

        <div class="mb-3">
                    <input type="number" placeholder="please input the hours number" class="form-control" name="hoursNumber">
        </div>
        <button type="submit" class="btn btn-primary">submit</button>




    </div>
    </form>



</body>

</html>