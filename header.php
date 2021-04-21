<?php
if(!empty($_POST['logout']))
{
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
        <a class="nav-link" aria-current="page" href="./addshifts.php">Shifts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./notification.php">Notification</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/menu2.php">Menu Item</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Menu Item</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./addemployee.php">Add New Employee</a>
    </li>
    <form method="post" action="">
        <div class="position-absolute top-0 end-0">
            Welcome, <?= $_SESSION['name'] ?>
            <button class="btn btn-primary" type="submit" name="logout" value="logout">Logout</button>
        </div>
    </form>
</ul>