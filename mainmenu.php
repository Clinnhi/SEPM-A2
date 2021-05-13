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

if (!empty($_POST['cancel'])) {
    $shiftId = $_POST['shiftId'][0];
    $result = $connection->query("UPDATE `Shifts` SET `accepted` = 3, `employee_id` = null WHERE `shift_id` = $shiftId");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home Screen</title>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://dss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/js/lib/jquery-1-edb203c114.10.2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="mainmenu.js"></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <div class="mt-5">
            <h5>Accepted Shifts</h5>
            <?php
            if ($result->num_rows > 0) {
                foreach ($result as $shift) {
            ?>
                    <div class="list-group margin-top3">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <p class="mb-1">&nbsp;&nbsp;A shift has been allocated to you</p>
                            <p class="mb-1">【TIME】<?= $shift['time'] ?></p>
                            <p class="mb-1">【DATE】<?= $shift['date'] ?></p>
                            <p class="mb-1">【Location】<?= $shift['location'] ?></p>
                            <p class="mb-1">【Duration】<?= $shift['duration'] ?> hours</p>
                            <div class="d-flex flex-row-reverse">
                            </div>
                            <form method="POST" action="">
                                <div class="p-2"><input type="submit" class="btn btn-danger" data-toggle="modal" name="cancel" value="cancel" /></div>
                                <input type="hidden" value="<?= $shift['shift_id'] ?>" name="shiftId[]" />
                            </form>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "No New Shifts";
            }
            ?>
        </div>
        <div class="row mt-3 d-flex justify-content-end">
            <div class="col-md-2">
                <select class="form-select" aria-label="Default select example">
                    <option value="1" selected>Week workload</option>
                    <option value="2">Month workload</option>
                </select>
            </div>
        </div>

        <div class="row d-flex justify-content-center">

            <div class="col-md-10 ">
                <canvas id="weekChart"></canvas>
                <canvas id="monthChart"></canvas>
            </div>
        </div>

    </div>



    <footer>
        <hr>
        <!-- Prints out the footer for the webpages -->
        &copy; SEPM Group B4-3 2021
    </footer>


</body>

</html>