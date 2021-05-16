<?php
session_start();
$userId = intval($_SESSION['id']);

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "SEPM";

$connection = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit();
}

// Get week duration
// weekday start from0, 0 is Monday
$weekWorkload = $connection
    ->query("select weekday(date) weekday, sum(duration) duration from shifts where date>=curdate()-weekday(date) and employee_id='$userId' group by weekday")
    ->fetch_all(MYSQLI_ASSOC);
$weekData = array_fill(0, 7, 0);
foreach ($weekWorkload as $w) {
    $weekData[$w['weekday']] = $w['duration'];
}

// Mouth duration
// day start from 01, 01 is the frist day of erveymouth
// Array counts from 0
$monthWorkload = $connection
    ->query("select date_format(date,'%d') day, sum(duration) duration from shifts where date_format(date,'%Y%m')=date_format(curdate(),'%Y%m') and employee_id='$userId' group by day")
    ->fetch_all(MYSQLI_ASSOC);
$monthData = array_fill(0, 31, 0);
foreach ($monthWorkload as $w) {
    $day = intval($w['day']) - 1;
    $monthData[$day] = $w['duration'];
}

$output = array(
    "weekData" => $weekData,
    "monthData" => $monthData
);
echo json_encode($output);