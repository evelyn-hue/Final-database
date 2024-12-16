<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "payroll";

    $conn = new mysqli($servername, $username, $password, $dbname);


        $user = $_POST["user"];
        $pass = $_POST["pass"];

        $stmt = $conn->prepare("SELECT * FROM user_pass WHERE user = ? AND pass = ?");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user'] = $row["user"];
            echo 'Login Successfully, ' . $row["user"] . '';
            header('Location: table.php');
        } else {
            echo 'Invalid User and Pass';
        }
        $stmt->close();

}

    $conn->close();
?>


