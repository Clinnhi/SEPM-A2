<?php
session_start();

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";

$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
// if ($connection->connect_errno) {
//     echo "Failed to connect to MySQL: " . $connection->connect_error;
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocate Shifts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="addshifts.css">
</head>

<body>
<?php include 'header.php'; ?>

<div class="container" style="text-align: center;">
    <div class="margin-top">
        <select name="shiftList" onchange="changeShift(this)">
            <option></option>

            <?php
            // Get shifts information according to the passed parameter id
            $id = intval($_GET['id']);
            if (!isset($_GET['id'])) {
                $id = 0;
            }
            $shifts = $connection->query("select shift_id,location from shifts where not accepted=1")->fetch_all();
            foreach ($shifts as $shift) {
                // output data to the website
                if ($shift[0] == $id) {
                    echo "<option value='$shift[0]' selected>$shift[1]</option>";
                } else {
                    echo "<option value='$shift[0]'>$shift[1]</option>";
                }
            }
            ?>
        </select>
    </div>
</div>

<form action="" method="post">
    <div class="mt-5">
        <div class="container">

        <div class="container px-4">
                <div class="row gx-5">
                    </div>
                    <div class="col">
                        <div style="text-align: center;">
                            <h3>Add Employees To Shift</h3>
                        </div>


                        <div class="form-check" style="text-align: center;">

                            <?php


                            // find the employee who are unavailabilities
                            $employees = $connection
                                ->query("SELECT id,name FROM employee where id not in (select employee_id from unavailabilities)")
                                ->fetch_all();
                            foreach ($employees as $employee) {
                                // output data to the website
                                ?>
                                <div class="p-4 border bg-light"><input class="form-check-input" type="radio"
                                                                        name="employee"
                                                                        value="<?= $employee[0] ?>"
                                                                        id="check<?= $employee[0] ?>">
                                    <label class="form-check-label" for="check<?= $employee[0] ?>">
                                        <?= $employee[1] ?>
                                    </label>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="bottomright">
            <button type="submit" class="btn btn-primary">Allocate Shifts</button>
        </div>
    </div>
    <?php



    //update shifts table, set employee who are selected, accepted = null
    if (isset($_POST['employee'])) {
        $employeeId = intval($_POST['employee']);
        $sql = $connection->prepare("update shifts set employee_id=? ,accepted=null where shift_id=?");
        $sql->bind_param("ii", $employeeId, $id);
        $r = $sql->execute();
    }

    ?>
</form>
<script>
    // Change of drop-down box option
    function changeShift(choose) {
        if (choose.value != -1) {
            window.location.replace("allocateshifts.php?id=" + choose.value)
        }
    }
</script>

</body>

</html>
