<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="addshifts.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container margin-top">
        <h3 style="text-align: center">Employee List</h3><br><br>
        <ul class="list-group">

            <li class="list-group-item">Employee 1 <div class="btn-group position-absolute top-0 end-0" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-dark">View Profile</button>
                    <button type="button" class="btn btn-secondary">Edit Profile</button>
                    <button type="button" class="btn btn-primary">Deactivate Account</button>
                </div>
            </li>


            <li class="list-group-item">Employee 2 <div class="btn-group position-absolute top-0 end-0" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-dark">View Profile</button>
                    <button type="button" class="btn btn-secondary">Edit Profile</button>
                    <button type="button" class="btn btn-primary">Deactivate Account</button>
                </div>
            </li>

            <li class="list-group-item">Employee 3 <div class="btn-group position-absolute top-0 end-0" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-dark">View Profile</button>
                    <button type="button" class="btn btn-secondary">Edit Profile</button>
                    <button type="button" class="btn btn-primary">Deactivate Account</button>
                </div>
            </li>

            <li class="list-group-item">Employee 4 <div class="btn-group position-absolute top-0 end-0" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-dark">View Profile</button>
                    <button type="button" class="btn btn-secondary">Edit Profile</button>
                    <button type="button" class="btn btn-primary">Deactivate Account</button>
                </div>
            </li>
        </ul>

    </div>

</body>

</html>