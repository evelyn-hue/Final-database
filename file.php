<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Error";
}else {
    echo "Connected";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $NameId = $_POST['name'];
    $PositionId = $_POST["position"];
    $Rate_TypeId = $_POST["rate_type"];
    $RateId = $_POST['rate'];
$sql = $conn->prepare("INSERT INTO `employees` (`Name`, `Position`, `RateType`, `Rate`) VALUES (?, ?, ?, ?)");

$sql->bind_param("ssss", $NameId, $PositionId, $Rate_TypeId, $RateId);

$sql->execute();
$sql->close();

}

$conn->close();

?>