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
    <link rel="stylesheet" href="addshifts.css">


</head>



<body>

    <?php include 'header.php'; ?>

    <form method="post" action="">
        <div class="container" style="text-align: center;">

            <br><br>
            <div class="container">
                <h3>Change Weekly Working Hour Limits</h3>
            </div>

            <div class="card-group margin-top">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Employee List</h5>
                        <br>
                        <select class="form-select text-center">
                            <option selected>Select Which Employee</option>
                            <!-- loop through database to retrieve employee and display below -->
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Current Hours</h5>
                        <p class="card-text">
                        <div class="mb-2 mx-auto"><br>
                            <input type="text" readonly class="form-control-plaintext text-center" id="currentHours" value="code to retrieve hours">
                            <!-- Code to retrieve employees hours goes in value -->
                        </div>
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Increase Limit</h5><br>
                            <div class="mb-4">
                                <input type="number" class="form-control text-center" name="hoursNumber" value="1">
                                <!-- employees current weekly hours can go into value -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container">
                <br><br><br>
                <button type="submit" class="btn btn-primary btn-lg">Increase Limit</button>
                <!-- Code to check if staff is eligible to have their hourly limits increased -->
                <!-- If they are --> 
                <div class="alert alert-danger" role="alert">
                    This staff is not eligible to have his/her hours increased.
                </div>
                <!-- else -->
                <div class="alert alert-success" role="alert">
                    This staff working limit has been successfully increased.
                </div>
            </div>
        </div>
    </form>



</body>

</html>