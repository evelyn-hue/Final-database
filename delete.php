  
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $deleteId = $_POST["id"];

    $sql = $conn->prepare("DELETE FROM employees WHERE EmployeeID = ?");
    $sql->bind_param("i", $deleteId);
    $sql->execute();
    $sql->close();

    header('Location: http://localhost/table.php');
}


$conn->close();


?>
