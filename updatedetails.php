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
$hourLimit = $connection->query("SELECT hour_limit FROM hour_limits WHERE employee_id='$user'")->fetch_assoc();


$name = $profile['name'];
$userHourLimit = $hourLimit['hour_limit'];
$preferred_name = $profile['preferred_name'];
$phone_number = $profile['phone_number'];
$address = $profile['address'];
$email = $profile['email'];

if (!empty($_POST['submit'])) {
	$name = $_POST['employeeFullName'] ? $_POST['employeeFullName'] : $name;
    $preferred_name = $_POST['employeePreferredName'] ? $_POST['employeePreferredName'] : $preferred_name;
    $phone_number = $_POST['employeePhoneNumber'] ? $_POST['employeePhoneNumber'] : $phone_number;
	$address = $_POST['employeeAddress'] ? $_POST['employeeAddress'] : $address;
    $email = $_POST['employeeEmail'] ? $_POST['employeeEmail'] : $email;

    $array = [$name, $preferred_name, $phone_number, $address, $email, $user];
    // var_dump($array);
    $sql = $connection->prepare("UPDATE `employee` SET `name` = ?, `preferred_name` = ?, `phone_number`= ?, `address` = ?, `email` = ? WHERE id = ?");
    $sql->bind_param('sssssi', $name, $preferred_name, $phone_number, $address, $email, $user);
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
    <title>Update Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="addshifts.css">

</head>

<body>
    <?php include 'header.php'; ?>
<center> 
    <div class="container margin-top">
        <h1>Update Profile</h1>
        <hr>
        <div class="row">

            <div class="col-md personal-info">
                <h3>Personal info</h3>

                <form class="form-horizontal form-sm" role="form" action="" method="POST">
                    <div class="form-group">
                        <form method="post" action="">
                            <label class="col-lg-3 control-label">Full Name: </label>
                            <div class="col-sm-3">
                                <!-- Preferred name goes into value -->
                                <input class="form-control" type="text" name="employeeFullName" value="<?=$name?>" required="required">
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Weekly Hour Limit: </label>
                        <div class="col-sm-3">
                            <!-- Weekly Hour Limits goes into 40 -->
                            <input class="form-control" type="number" name="userHourLimit" value="<?= $hourLimit['hour_limit'] ?>" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Preferred Name: <?= $preferred_name ?></label>
                        <div class="col-sm-3">
                            <input class="form-control" type="text" name="employeePreferredName" value="<?=$preferred_name?>" required="required">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label">Phone Number: </label>
                        <div class="col-sm-3">
                            <input class="form-control" type="text" name="employeePhoneNumber" value="<?=$phone_number?>" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Home Address: </label>
                        <div class="col-sm-3">
                            <input class="form-control" type="text" name="employeeAddress" value="<?=$address?>" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-sm-3">
                            <input class="form-control" name="employeeEmail" type="text" value="<?=$email?>" required="required">
                        </div>
                    </div>

                    <a href="./changepassword.php" class="button-class">Change Password</a>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-sm-3">
                            <input type="submit" class="btn btn-primary" value="Save Changes" name="submit">
                            <span></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    </center>
    </form>

</body>

</html>