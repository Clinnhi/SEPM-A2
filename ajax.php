<?php
$inputDate = $_POST['inpDate'];
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";

$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit();
}
$results = $connection->query("SELECT id, name FROM `Employee`");
$results1 = $connection->query("SELECT date, employee_id FROM `Unavailabilities`");

// if (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['location']) && !empty($_POST['employee'])) {
//     $date = str_replace('/', '-', $_POST['date']);
//     $time = $_POST['time'];
//     $location = $_POST['location'];
//     $employee = $_POST['employee'][0];

//     $sql = $connection->prepare("INSERT INTO `Shifts` (`date`, `time`, `location`, `employee_id`) VALUES (?, ?, ?, ?)");
//     $sql->bind_param('sssi', $date, $time, $location, $employee);
//     if (!$sql->execute()) {
//         echo $sql->error;
//     }
//     $sql->close();
// }
$na_id = array();
if ($results1->num_rows > 0) {
    foreach ($results1 as $na) {
        if ($na['date'] == $inputDate) {
            array_push($na_id, $na['employee_id']);
        }
    }
}
// var_dump($na_id);
$filter_result = array();
if ($results->num_rows > 0) {
    foreach ($results as $employee) {
        if (!in_array($employee['id'], $na_id)) {
            $filter_result[$employee['id']] = $employee['name'];
        }
    }
}
// var_dump($filter_result);

echo json_encode($filter_result);//json_encode方式是必须的
