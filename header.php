<?php
session_start();
if (!empty($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ./loginpage.php");
}
?>

<!-- Nav Bar -->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="./mainmenu.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="./shifthistory.php">Shift History</a>
    </li>
    <?php
    if ($_SESSION["is_manager"] == 1) {
    ?>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./addshifts.php">Add/Update Shifts</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="./allocateshifts.php">Rejected/Canceled Shifts</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="./viewAndDeactivate.php">Employee List</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="./addemployee.php">Add New Employee</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="./changehours.php">Change Weekly Limit</a>
        </li>
    <?php
    }
    ?>
    <li class="nav-item">
        <a class="nav-link" href="./notification.php">Notification</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./changeavailability.php">Change Availability</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./profile.php">Profile</a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="./updatedetails.php">Update Details</a>
    </li> -->



    <form method="post" action="">
        <div class="position-absolute top-0 end-0">
            Welcome, <?= $_SESSION['name'] ?>
            <button class="btn btn-primary" type="submit" name="logout" value="logout">Logout</button>
        </div>
    </form>
</ul>
