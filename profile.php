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
    <title>Update Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script type="text/javascript" src="https://dss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/js/lib/jquery-1-edb203c114.10.2.js"></script>

    <script>
        $(function() {
            //remove active class for 'Home' and add active class for current page.
            $(".nav-item a[href|='./mainmenu.php']").removeClass("active");
            $(".nav-item a[href|='./profile.php']").addClass("active");
        });
    </script>

</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center">My Profile</h1>
        <hr>
        <?php
        $user = $_SESSION['id'];
        $profile = $connection->query("select * from employee where id='$user'")->fetch_assoc();
        $hourLimit = $connection->query("select hour_limit from hour_limits where employee_id='$user'")->fetch_assoc();
        ?>
        <dl class="row">
            <dt class="col-sm-4"></dt>
            <dt class="col-sm-3">Full Name:</dt>
            <dd class="col-sm-5"><?= $profile['name'] ?></dd>

            <dt class="col-sm-4"></dt>
            <dt class="col-sm-3">Weekly Hour Limit:</dt>
            <dd class="col-sm-5"><?= $hourLimit['hour_limit'] ?></dd>

            <dt class="col-sm-4"></dt>
            <dt class="col-sm-3">Preferred Name:</dt>
            <dd class="col-sm-5"><?= $profile['preferred_name']?></dd>

            <dt class="col-sm-4"></dt>
            <dt class="col-sm-3">Phone Number:</dt>
            <dd class="col-sm-5"><?= $profile['phone_number'] ?></dd>

            <dt class="col-sm-4"></dt>
            <dt class="col-sm-3">Home Address:</dt>
            <dd class="col-sm-5"><?= $profile['address'] ?></dd>

            <dt class="col-sm-4"></dt>
            <dt class="col-sm-3">Email:</dt>
            <dd class="col-sm-5"><?= $profile['email'] ?></dd>
        </dl>
        <hr>
        <div class="d-flex justify-content-end">
            <a href="updatedetails.php" class="btn btn-primary">Update my details</a>
        </div>
        </form>

</body>

</html>
