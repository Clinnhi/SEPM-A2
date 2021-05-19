<?php
session_start();

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";

if (!empty($_POST['employeeEmail']) && !empty($_POST['employeePassword']) && !empty($_POST['employeePhoneNo']) && !empty($_POST['employeeFullName']) && !empty($_POST['employeeAddress'])) {
  $email = $_POST['employeeEmail'];
  $password = $_POST['employeePassword'];
  $phone_number = $_POST['employeePhoneNo'];
  $dob = $_POST['employeeDOB'];
  $name = $_POST['employeeFullName'];
  $address = $_POST['employeeAddress'];
  $is_manager = $_POST['optradio'] == 'manager' ? 1 : 0;
  $preferred_name = $_POST['employeePreferredName'];

  $connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
  if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit();
  }

  $sql = $connection->prepare("INSERT INTO `Employee` (`email`, `password`, `phone_number`, `dob`, `name`, `preferred_name`, `address`, `is_manager`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $sql->bind_param('sssssssi', $email, $password, $phone_number, $dob, $name, $preferred_name, $address, $is_manager);

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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="addshifts.css">
  <script type="text/javascript" src="https://dss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/js/lib/jquery-1-edb203c114.10.2.js"></script>

  <script>
    $(function() {
      //remove active class for 'Home' and add active class for current page.
      $(".nav-item a[href|='./mainmenu.php']").removeClass("active");
      $(".nav-item a[href|='./addemployee.php']").addClass("active");
    });
  </script>
</head>

<body>

  <?php include 'header.php'; ?>


  <div class="container">
    <center>
      <h3 class="margin-top">Add New Employee</h3>
    </center>
    <!-- <div class="position-absolute top-50 start-50 translate-middle"> -->
    <div class="mt-5 mb-5 d-flex justify-content-center">
      <form method="post" action="">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" name="employeeEmail" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" name="employeePassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" maxlength="8" title="Exactly 8 Charcters, 1 Uppercase, 1 Lower Case, 1 Number, 1 Special Character" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Phone Number</label>
          <input type="phone" class="form-control" name="employeePhoneNo" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Date Of Birth</label>
          <input type="date" class="form-control" name="employeeDOB" value="2021-06-01" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Full Name</label>
          <input type="text" class="form-control" name="employeeFullName" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Preferred Name</label>
          <input type="text" class="form-control" name="employeePreferredName">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Residential Address</label>
          <input type="text" class="form-control" name="employeeAddress" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Weekly Hour Limit</label>
          <input type="text" class="form-control" name="employeeLimit" required>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="optradio" id="shiftManagerOption" value="manager" checked>
          <label class="form-check-label" for="shiftManagerOption">
            Shift Manager
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="optradio" id="staffUserOption" value="staff">
          <label class="form-check-label" for="staffUserOption">
            Staff User
          </label>
        </div>
    </div>
  </div>


  <div class="container mb-5">
    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary">Add New Account</button>
    </div>
  </div>


  </form>

</body>

</html>