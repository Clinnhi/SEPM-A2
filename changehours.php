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
    <title>Change Hour Per Week</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="addshifts.css">
    <script type="text/javascript" src="https://dss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/js/lib/jquery-1-edb203c114.10.2.js"></script>

    <script>
        $(function() {
            //remove active class for 'Home' and add active class for current page.
            $(".nav-item a[href|='./mainmenu.php']").removeClass("active");
            $(".nav-item a[href|='./changehours.php']").addClass("active");
        });
    </script>

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

                        <select class="form-select text-center" id="select-employee" onchange="changeEmployee(this)">
                            <option selected>Select Which Employee</option>
                            <!-- loop through database to retrieve employee and display below -->
                            <?php
                            //collect data from table 'employee'
                            $results = $connection->query("SELECT employee_id, name FROM `Employee`");
                            if ($results->num_rows > 0) {
                                foreach ($results as $employee) {
                                    if ($employee['employee_id'] == $_GET['employee_id']) {
                                        echo "<option value='$employee[employee_id]' selected>$employee[name]</option>";
                                    } else {
                                        echo "<option value='$employee[employee_id]'>$employee[name]</option>";
                                    }
                                }
                            }

                            ?>
                        </select>
                    </div>
                </div>



                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Current Hours</h5>
                        <p class="card-text">
                        <div class="mb-2 mx-auto"><br>
                            <?php
                            //collect data from table 'hour_limit'
                            $currentHour = null;
                            $employeeId = isset($_GET['employee_id'])? intval($_GET['employee_id']) : -1;
                            if (isset($_GET['employee_id']) && $_GET['employee_id'] != -1) {

                                //Get hour limit
                                $result = $connection
                                    ->query("select hour_limit from hour_limits where employee_id='$employeeId'")
                                    ->fetch_all(MYSQLI_ASSOC)[0];

                                //Output
                                $currentHour = $result['hour_limit'] ?: 40;

                            ?>
                                <input type="text" readonly class="form-control-plaintext text-center" id="currentHours" value="<?= $currentHour ?>">
                                <!-- Code to retrieve employees hours goes in value -->
                            <?php
                            }
                            ?>

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
                <!-- <button type="submit" class="btn btn-primary btn-lg">Increase Limit</button> -->
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Increase Limit
                </button>


                <!-- Code to check if staff is eligible to have their hourly limits increased -->
                <?php
                //check data correctly
                if (isset($_POST['hoursNumber']) && isset($_GET['employee_id']) && $_GET['employee_id'] != -1) {
                    $hoursNumber = $_POST['hoursNumber'];
                    $hours = $currentHour + $hoursNumber;

                    if ($hours >= 80) {

                ?>
                        <div class="alert alert-danger" role="alert">
                            This staff is not eligible to have his/her hours increased.
                        </div>
                    <?php
                        //<!-- else -->
                    } else {
                        //update data

                        $sql = $connection->prepare("replace into hour_limits values(?,?)");
                        $sql->bind_param("ii", $employeeId, $hours);
                        $sql->execute();
                    ?>
                        <div class="alert alert-success" role="alert">
                            This staff working limit has been successfully increased.
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        Please confirm whether this staff is eligible to have this increase
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Change of drop-down box option
        function changeEmployee(choose) {
            if (choose.value != -1) {
                window.location.replace("changehours.php?employee_id=" + choose.value)
            }
        }
    </script>



</body>

</html>
