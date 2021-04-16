<?php

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";

<<<<<<< HEAD
if (!empty($_POST['employeeEmail']) && !empty($_POST['employeePassword']) && !empty($_POST['employeePhoneNo']) && !empty($_POST['employeeFullName']) && !empty($_POST['employeeAddress'])) {
=======
if ($_POST['employeeEmail'] && $_POST['employeePassword'] && $_POST['employeePhoneNo'] && $_POST['employeeFullName'] && $_POST['employeeAddress']) {
>>>>>>> 4ad1873fa6e2e78e7e3d3207811b53164f44c746
  $email = $_POST['employeeEmail'];
  $password = $_POST['employeePassword'];
  $phone_number = $_POST['employeePhoneNo'];
  $dob = $_POST['employeeDOB'];
  $name = $_POST['employeeFullName'];
  $address = $_POST['employeeAddress'];

  $connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
  if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit();
  }

  $sql = $connection->prepare("INSERT INTO `Employee` (`email`, `password`, `phone_number`, `dob`, `name`, `address`) VALUES (?, ?, ?, ?, ?, ?)");
  $sql->bind_param('ssssss',$email, $password, $phone_number, $dob, $name, $address);

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
  <title>New Employee</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="addshifts.css">

</head>

<body>

  <!-- Nav Bar -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="./mainmenu.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="./addshifts.php">Shifts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/menu1.html">Menu Item</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/menu2.html">Menu Item</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Menu Item</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="./addemployee.php">Add New Employee</a>
    </li>
    <div class="position-absolute top-0 end-0">
      <button class="btn btn-primary" type="button">Logout</button>
    </div>
  </ul>


  <div class="container">
    <center>
      <h3 class="margin-top">Add New Employee</h3>
    </center>
    <div class="position-absolute top-50 start-50 translate-middle">
      <form method="post" action="">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" name="employeeEmail">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" name="employeePassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" maxlength="8" title="Exactly 8 Charcters, 1 Uppercase, 1 Lower Case, 1 Number, 1 Special Character">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Phone Number</label>
          <input type="phone" class="form-control" name="employeePhoneNo">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Date Of Birth</label>
<<<<<<< HEAD
          <input type="date" class="form-control" name="employeeDOB" value="2021-06-01">
=======
          <input type="text" class="form-control" name="employeeDOB" value="2017-06-01">
>>>>>>> 4ad1873fa6e2e78e7e3d3207811b53164f44c746
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Full Name</label>
          <input type="text" class="form-control" name="employeeFullName">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Residential Address</label>
          <input type="text" class="form-control" name="employeeAddress">
        </div>
    </div>
  </div>


  <div class="container">
    <div class="bottomright">
      <button type="submit" class="btn btn-primary">Add New Account</button>
    </div>
  </div>

  </form>

</body>

</html>
