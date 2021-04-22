<?php
session_start();
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";

$user = $_SESSION['id'];
$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit();
}

$result = $connection->query("SELECT * FROM `Shifts` WHERE `employee_id` = '$user' AND `accepted` = 1");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Home Screen</title>

  <!-- Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>

<?php include 'header.php';?>

<div class="container">
        <div class="margin-top5">
            <h5>Accepted Shifts</h5>
            <?php
                if ($result->num_rows > 0) {
                    foreach($result as $shift){
                        ?>
            <div class="list-group margin-top3">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <p class="mb-1">&nbsp;&nbsp;A shift has been allocated to you</p>
                    <p class="mb-1">【TIME】<?= $shift['time'] ?></p>
                    <p class="mb-1">【DATE】<?= $shift['date'] ?></p>
                    <p class="mb-1">【Location】<?= $shift['location'] ?></p>
                    <div class="d-flex flex-row-reverse">
                    </div>
                </a>
            </div>
            <?php
                    }
                }
                else {
                    echo "No New Shifts";
                }
                ?>
        </div>
    </div>
 


  <footer>
      <hr>
            <!-- Prints out the footer for the webpages -->
            &copy; SEPM Group B4-3 2021
  </footer>


</body>

</html>
