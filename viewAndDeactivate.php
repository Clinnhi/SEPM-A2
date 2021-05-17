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

$results = $connection->query("SELECT employee_id, name FROM `Employee`");

if (isset($_POST['deactivate'])) {
    $deactivate = $_POST['deactivate'];
    $sql = "DELETE FROM `Employee` WHERE id = $deactivate";
    if ($connection->query($sql) == true) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="addshifts.css">

    <script type="text/javascript" src="https://dss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/js/lib/jquery-1-edb203c114.10.2.js"></script>

    <script>
        $(function() {
            //remove active class for 'Home' and add active class for current page.
            $(".nav-item a[href|='./mainmenu.php']").removeClass("active");
            $(".nav-item a[href|='./viewAndDeactivate.php']").addClass("active");
        });
    </script>

</head>

<body>

    <?php include 'header.php'; ?>

    <form method="post" action="">
        <div class="container margin-top">
            <h3 style="text-align: center">Employee List</h3><br><br>
            <ul class="list-group">
                <?php
                if ($results->num_rows > 0) {
                    foreach ($results as $employee) {
                ?>
                        <li class="list-group-item"><?= $employee['name'] ?> <div class="btn-group position-absolute top-0 end-0" role="group" aria-label="Basic example">
                                <button type="submit" class="btn btn-dark" name="view" value="<?= $employee['employee_id'] ?>">View Profile</button>
                                <button type="submit" class="btn btn-secondary" name="edit" value="<?= $employee['employee_id'] ?>">Edit Profile</button>
                                <button type="submit" class="btn btn-primary" name="deactivate" value="<?= $employee['employee_id'] ?>">Deactivate Account</button>
                            </div>
                        </li>
                    <?php
                    }
                } else {
                    ?>
                    <h2>There are no employees! Hire someone!!!</h2>
                <?php
                }
                ?>

            </ul>

        </div>
    </form>

</body>

</html>