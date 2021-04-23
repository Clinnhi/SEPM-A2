<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocate Shifts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="addshifts.css">
</head>

<body>
    <?php include 'header.php'; ?>


    <div class="container" style="text-align: center;">
        <div class="margin-top">
            <select name="shiftList">
                <option value="">Shift 1</option>
                <option value="">Shift 2</option>
                <option value="">Shift 3</option>
                <option value="">Shift 4</option>
            </select>
        </div>
    </div>

    <div class="mt-5">
        <div class="container">

            <div class="container px-4">
                <div class="row gx-5">

                    <div class="col" style="text-align: center;">
                        <div style="text-align: center;">
                            <h3>Staff Currently Roastered</h3>
                        </div>

                        <div class="p-4 bg-light border">
                            <!-- Employee name here  --> Jarrod Sample
                        </div>
                        <div class="p-4 bg-light border"> Sample Tom
                            <!-- Employee name here  -->
                        </div>
                        <div class="p-4 bg-light border"> Thomas Blackburn
                            <!-- Employee name here  -->
                        </div>
                        <div class="p-4 bg-light border"> Clinton Roaster
                            <!-- Employee name here  -->
                        </div>


                    </div>
                    <div class="col">
                        <div style="text-align: center;">
                            <h3>Add Employees To Shift</h3>
                        </div>


                        <div class="form-check" style="text-align: center;">
                            <div class="p-4 border bg-light"> <input class="form-check-input" type="checkbox" value="" >
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    <!-- Employee Name -->
                                    Sample Jarros
                                </label>
                            </div>
                            <div class="p-4 border bg-light"> <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    Blackburn Hawk

                                </label>
                            </div>
                            <div class="p-4 border bg-light"> <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    Barrack Obama
                                </label>
                            </div>
                            <div class="p-4 border bg-light"> <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    John Howard
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="bottomright">
            <button type="submit" class="btn btn-primary">Allocate Shifts</button>
        </div>
    </div>


</body>

</html>