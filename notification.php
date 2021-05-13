<?php
session_start();
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";

$user = $_SESSION['id'];
$shiftIndex = "";
$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit();
}

$result = $connection->query("SELECT * FROM `Shifts` WHERE `employee_id` = '$user' AND `accepted` IS Null");
$shiftId = $_POST['shiftId'][0];

if (!empty($_POST['acceptButton']) && !empty($_POST['shiftId'])) {
    $result = $connection->query("UPDATE `Shifts` SET `accepted` = 1 WHERE `shift_id` = $shiftId");
    $result = $connection->query("SELECT * FROM `Shifts` WHERE `employee_id` = '$user' AND `accepted` IS Null");
}

if (!empty($_POST['rejectButton']) && !empty($_POST['shiftId'])) {
    $result = $connection->query("UPDATE `Shifts` SET `accepted` = 0 WHERE `shift_id` = $shiftId");
    $result = $connection->query("SELECT * FROM `Shifts` WHERE `employee_id` = '$user' AND `accepted` IS Null");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shifts</title>

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://dss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/js/lib/jquery-1-edb203c114.10.2.js"></script>

    <script>
        $(function() {
            //remove active class for 'Home' and add active class for current page.
            $(".nav-item a[href|='./mainmenu.php']").removeClass("active");
            $(".nav-item a[href|='./notification.php']").addClass("active");
        });
    </script>
</head>

<body>
    <?php include 'header.php'; ?>

    <!-- Notifications -->
    <div class="container">
        <div class="mt-5">
            <h5>Notifications</h5>
            <?php
            if ($result->num_rows > 0) {
                foreach ($result as $shift) {
            ?>
                    <div class="list-group mt-3">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <p class="mb-1">&nbsp;&nbsp;A shift has been allocated to you</p>
                            <p class="mb-1">【TIME】<?= $shift['time'] ?></p>
                            <p class="mb-1">【DATE】<?= $shift['date'] ?></p>
                            <p class="mb-1">【Location】<?= $shift['location'] ?></p>
                            <p class="mb-1">【Duration】<?= $shift['duration'] ?> hours</p>
                            <div class="d-flex flex-row-reverse">
                                <!-- Button trigger modal -->
                                <form method="POST" action="">
                                    <div class="p-2"><input type="submit" class="btn btn-danger" data-toggle="modal" data-target="#rejConfirm" name="rejectButton" value="Reject" /></div>
                                    <div class="p-2"><input type="submit" class="btn btn-success" data-toggle="modal" data-target="#accConfirm" name="acceptButton" value="Accept" /></div>
                                    <input type="hidden" value="<?= $shift['shift_id'] ?>" name="shiftId[]" />
                                </form>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "No New Shifts";
            }
            ?>
        </div>
    </div>

    <!-- Pagination -->
    <div class="container">
        <div class="d-flex flex-row-reverse mt-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Modal -->
    <!-- <div class="modal fade" id="rejConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Reject this Allocation?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="accConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Accept</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Accept this Allocation?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div> -->


</body>

</html>