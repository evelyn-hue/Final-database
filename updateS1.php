<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $update_id = $_POST["id"];

    $nameId = $_POST["name"];
    $positionId = $_POST["position"];
    $rate_typeId = $_POST["rate_type"];
    $rateId = $_POST["rate"];

    $sql = $conn->prepare("UPDATE employees SET Name = ?, Position = ?, RateType = ?, Rate = ?
    WHERE EmployeeID = ?");

    $sql->bind_param("ssssi", $nameId, $positionId, $rate_typeId, $rateId, $update_id);

    $sql->execute();

    $sql->close();


}




$conn->close();


?>