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
    <center> <h3 class="margin-top">Add New Employee</h3></center>
     <div class="position-absolute top-50 start-50 translate-middle">
        <form>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="employeeEmail">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="employeePassword">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                <input type="phone" class="form-control" id="employeePhoneNo" >
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Date Of Birth</label>
                <input type="email" class="form-control" id="employeeDOB" >
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Full Name</label>
                <input type="email" class="form-control" id="employeeFullName" >
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Residential Address</label>
                <input type="email" class="form-control" id="employeeAddress">
              </div>
          </form>
    </div>
</div>


  <div class="container">
    <div class="bottomright">
        <button type="button" class="btn btn-primary">Add New Account</button>
    </div>
</div>


</body>
</html>