<?php

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";


$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit();
}
$results = $connection->query("SELECT id, name FROM `Employee`");

if (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['location']) && !empty($_POST['employee'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $employee = $_POST['employee'][0];
    


$sql = $connection->prepare("INSERT INTO `Shifts` (`date`, `time`, `location`, `employee_id`) VALUES (?, ?, ?, ?)");
$sql->bind_param('sssi',$date, $time, $location, $employee);
if (!$sql->execute()) {
    echo $sql->error;
  }
  $sql->close();

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shifts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="addshifts.css">

</head>

<body>
    <!-- Nav Bar -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./mainmenu.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Shifts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Menu Item</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Menu Item</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Menu Item</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./addemployee.php">Add New Employee</a>
        </li>
        <div class="position-absolute top-0 end-0">
            <button class="btn btn-primary" type="button">Logout</button>
        </div>
    </ul>

    <!-- Date/Time/Location -->
    <form method="post" action="">
        <div class="container">
            <div class="margin-top">
                <center>
                    <h5>Please Enter The Shift Date, Time and Location</h5>
                </center>
                <div class="row g-3">
                    <div class="col-sm">
                        <input type="text" class="form-control" placeholder="Shift Date" aria-label="State" name="date" value="2021-06-01">
                    </div>
                    <div class="col-sm">
                        <input type="text" class="form-control" placeholder="Shift Time" aria-label="Shift Time"
                            name="time">
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" placeholder="Shift Location" aria-label="Shift Location"
                            name="location">
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="position-absolute top-50 start-50 translate-middle">
                <ul class="list-group">
                    <h5>Select Who Should Work The Shift</h5>
                    <?php
                    if ($results->num_rows > 0) {
                    foreach ($results as $employee) {
                        ?>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="radio" value="<?=$employee['id']?>" aria-label="..."
                            name="employee[]">
                        <?= $employee['name'] ?>
                    </li>
                    <?php
                      }
                    } else {
                        ?>
                    <h7>There are no employees available.</h7>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="bottomright">
                <button type="submit" class="btn btn-primary">Create New Shift</button>
            </div>
        </div>
    </form>

</body>

</html>