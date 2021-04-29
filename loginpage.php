<?php
session_start();

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";

$hasError = false;

if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword'])) {
    $username = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];


    $connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    if ($connection->connect_errno) {
        echo "Failed to connect to MySQL: " . $connection->connect_error;
        exit();
    }

    $result = $connection->query("SELECT * FROM `Employee` WHERE `email` = '$username' AND `password` = '$password' LIMIT 1");
    $employeeIndex = mysqli_fetch_array($result);

    if ($employeeIndex['email'] == $username && $employeeIndex['password'] == $password) {

        $_SESSION["username"] = $username;
        $_SESSION["name"] = $employeeIndex['name'];
        $_SESSION["id"] = $employeeIndex['id'];
        $_SESSION["is_manager"] = $employeeIndex['is_manager'];
        header("Location: ./mainmenu.php");
    } else {
        $hasError = true;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="loginpage.css">

</head>

<body>

    <div class="container">
        <div class="position-absolute top-50 start-50 translate-middle">
            <h3>Login </h3>
            <form method="post" action="">
                <?php
                if ($hasError == true) {
                    echo "<b>Invalid Username or Password</b>";
                }
                ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="inputEmail" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="inputPassword">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

</body>

</html>