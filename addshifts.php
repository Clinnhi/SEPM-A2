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
$results = $connection->query("SELECT id, name FROM `Employee`");

if (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['location']) && !empty($_POST['duration']) && !empty($_POST['employee'])) {
    $date = str_replace('/', '-', $_POST['date']);
    $time = $_POST['time'];
    $location = $_POST['location'];
    $duration = $_POST['duration'];
    $employee = $_POST['employee'][0];

    $sql = $connection->prepare("INSERT INTO `Shifts` (`date`, `time`, `location`, `duration`, `employee_id`) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param('sssii', $date, $time, $location, $duration, $employee);
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="addshifts.css">
    <script type="text/javascript" src="https://dss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/js/lib/jquery-1-edb203c114.10.2.js"></script>
    <script src="addshifts.js"></script>

</head>

<body>
    <?php include 'header.php'; ?>

    <!-- Date/Time/Location -->
    <form method="post" action="">
        <div class="container">
            <div class="margin-top">
                <center>
                    <h5>Please Enter The Shift Date, Time and Location</h5>
                </center>
                <div class="row g-3">
                    <div class="col-sm">
                        <input type="date" class="form-control date" placeholder="Shift Date" aria-label="Date" name="date" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>">
                    </div>
                    <div class="col-sm">
                        <input type="text" class="form-control" placeholder="Shift Time" aria-label="Shift Time" name="time">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" placeholder="Shift Location" aria-label="Shift Location" name="location">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" placeholder="Shift Duration Hours" aria-label="Shift Duration" name="duration">
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="position-absolute top-50 start-50 translate-middle">
                <ul class="list-group">
                    <h5>Select Who Should Work The Shift</h5>

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