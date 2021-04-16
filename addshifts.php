<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shifts</title>

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
            <a class="nav-link active" aria-current="page" href="#">Shifts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Menu Item</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Menu Item</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Menu Item</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./addemployee.php">Add New Employee</a>
        </li>
        <div class="position-absolute top-0 end-0">
            <button class="btn btn-primary" type="button">Logout</button>
        </div>
    </ul>

    <!-- Date/Time/Location -->
    <div class="container">
        <div class="margin-top">
            <center> <h5>Please Enter The Shift Date, Time and Location</h5></center>
            <div class="row g-3">
                <div class="col-sm">
                    <input type="text" class="form-control" placeholder="Shift Date" aria-label="State">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" placeholder="Shift Time" aria-label="Shift Time">
                </div>
                <div class="col-sm-7">
                    <input type="text" class="form-control" placeholder="Shift Location" aria-label="Shift Location">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="position-absolute top-50 start-50 translate-middle">
            <ul class="list-group">
                <h5>Select Who Should Work The Shift</h5>
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    Steve Bob
                </li>
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    Bob Steve
                </li>
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    Harry Fu
                </li>
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    Michael Jo
                </li>
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    Joe Lama
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="bottomright">
            <button type="button" class="btn btn-primary">Create New Shift</button>
        </div>
    </div>
</body>

</html>