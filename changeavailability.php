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
echo $_POST['date'];
if (!empty($_POST['date'])){
    //Convert date to format accepted by database
    $date = str_replace('/', '-', $_POST['date']);
    echo $date;
    
    $sql = $connection->prepare("INSERT INTO `Unavailabilities` (`date`, `employee_id`) VALUES (?, ?)");
    $sql->bind_param('ss',$date, $_SESSION['id']);
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
    <title>Change Availability</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="addshifts.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>

<script>
    function confirmBtn() {
        alert("You have successfully taken the following date off: " + document.getElementById('date').value);
    }
</script>

<body>

    <?php include 'header.php'; ?>

    <form method="post" action="">
    <div class="container" style="text-align: center;">
        <br><br>
        <h3>Please indicate which day you are unavailable</h3>  
        <br><br>

        <input type="date" name="date" id="date" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>">
        <button type="submit" class="btn btn-secondary btn-sm" onclick="confirmBtn()" id="result">Confirm</button>

        <!-- <p id="test"></p> -->




    </div>
    </form>



</body>

</html>