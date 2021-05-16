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

$user = $_SESSION['id'];
$profile = $connection->query("SELECT * FROM employee WHERE id='$user'")->fetch_assoc();

$password = $profile['password'];

if (!empty($_POST['submit'])) {
    if ($password == $_POST['oldPassword'] && $_POST['newPassword'] == $_POST['confirmNewPassword']){
        $newPassword = $_POST['newPassword'];
        $sql = $connection->prepare("UPDATE `employee` SET `password` = ? WHERE id = ?");
        $sql->bind_param('ss', $newPassword, $user);
        if (!$sql->execute()) {
            echo $sql->error;
        }
        $sql->close();
    }
    else {
        echo "You made an incorrect input!";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="addshifts.css">

</head>


<body>
    <?php include 'header.php'; ?>

    <center>
        <div class="container margin-top">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Change Password</h1>
                </div>
            </div>
            <div class="row">
                <div class="">
                    <p class="text-center">Use the form below to change your password</p>
                    <form method="post" id="" action="">

                        <input type="password" class="col-sm-3" name="oldPassword" id="employeePassword"
                            placeholder="Current Password" autocomplete="off" required="required"> <br /> <br />

                        <input type="password" class="col-sm-3" name="newPassword" id="newPassword"
                            placeholder="New Password" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}"
                            maxlength="8"
                            title="Exactly 8 Charcters, 1 Uppercase, 1 Lower Case, 1 Number, 1 Special Character"
                            required="required"> <br /> <br />

                        <input type="password" class="col-sm-3" name="confirmNewPassword" id="confirmNewPassword"
                            placeholder="Confirm New Password" autocomplete="off"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" maxlength="8"
                            title="Exactly 8 Charcters, 1 Uppercase, 1 Lower Case, 1 Number, 1 Special Character"
                            required="required">
                        <div class="row">
                        </div>
                        <br />
                        <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-sm" value="Change Password" name="submit">
                    </form>
                </div>
                <!--/col-sm-6-->
            </div>
            <!--/row-->
        </div>
    </center>
</body>

</html>