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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="addshifts.css">

    <script type="text/javascript" src="https://dss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/js/lib/jquery-1-edb203c114.10.2.js"></script>
    <script src="allocateshifts.js"></script>

    <script>
        $(function() {
            //remove active class for 'Home' and add active class for current page.
            $(".nav-item a[href|='./mainmenu.php']").removeClass("active");
            $(".nav-item a[href|='./allocateshifts.php']").addClass("active");
        });
    </script>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container" style="text-align: center;">
        <div class="margin-top">
            <select id="shiftList" name="shiftList">
                <option></option>

                <?php
                //update shifts table, set employee who are selected, accepted = null
                if (isset($_POST['employee']) && isset($_POST['id'])) {
                    $employeeId = intval($_POST['employee']);
                    $id = $_POST['id'];
                    $sql = $connection->prepare("update shifts set employee_id=? ,accepted=null where shift_id=?");
                    $sql->bind_param("ii", $employeeId, $id);
                    $r = $sql->execute();
                }

                // $id = intval($_POST['id']);
                // if (!isset($_POST['id'])) {
                //     $id = 0;
                // }
                $shifts = $connection->query("select shift_id,location,date from shifts where not accepted=1")->fetch_all();
                foreach ($shifts as $shift) {
                    // output data to the website
                    echo "<option value='$shift[0]' class='$shift[2]'>$shift[1]</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <form class="reallocate-form" action="" method="post">
        <div class="mt-5">
            <div class="container">

                <div class="container px-4">
                    <div class="row gx-5">
                    </div>
                    <div class="col">
                        <div class="mb-5" style="text-align: center;">
                            <h3>Add Employees To Shift</h3>
                        </div>


                        <div class="list-group form-check" style="text-align: center;">
                            <h5>Please select a shift.</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <input type="number" class="idInput visually-hidden" name="id" value="">

        <div class="container">
            <div class="bottomright">
                <button type="submit" class="btn btn-primary">Allocate Shifts</button>
            </div>
        </div>

    </form>
    <!-- <script>
        // Change of drop-down box option
        function changeShift(choose) {
            if (choose.value != -1) {
                window.location.replace("allocateshifts.php?id=" + choose.value)
            }
        }
    </script> -->

</body>

</html>