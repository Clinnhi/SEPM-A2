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
$results = $connection->query("SELECT employee_id, name FROM `Employee`");
$results1 = $connection->query("SELECT date, employee_id FROM `Unavailabilities`");

$na_id = array();
if ($results1->num_rows > 0) {
    foreach ($results1 as $na) {
        if ($na['date'] == $inputDate) {
            array_push($na_id, $na['employee_id']);
        }
    }
}

$filter_result = array();
if ($results->num_rows > 0) {
    foreach ($results as $employee) {
        if (!in_array($employee['employee_id'], $na_id)) {
            $filter_result[$employee['employee_id']] = $employee['name'];
        }
    }
}

echo json_encode($filter_result);
