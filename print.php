<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payroll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $print = $_POST["id"];

    $stmt = $conn->prepare("SELECT * FROM employees WHERE EmployeeID = ?");
    $stmt->bind_param("i", $print);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $fresult = $result->fetch_assoc();
        echo '
        <html>
        <head>
            <title>Employee Summary</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 30px;
                    padding: 20px;
                }
                .summary {
                    border: 1px solid #ddd;
                    padding: 20px;
                    background: #f9f9f9;
                    width: 50%;
                    margin: 0 auto;
                    border-radius: 8px;
                }
                .summary h2 {
                    text-align: center;
                    color: #1976d2;
                }
                .summary .info {
                    margin-bottom: 10px;
                    font-size: 1.2em;
                }
            </style>
            <script>
                window.print();
            </script>
        </head>
        <body>
            <div class="summary">
                <h2>Employee Summary</h2>
                <div class="info"><strong>Employee ID:</strong> ' . $fresult["EmployeeID"] . '</div>
                <div class="info"><strong>Name:</strong> ' . $fresult["Name"] . '</div>
                <div class="info"><strong>Position:</strong> ' . $fresult["Position"] . '</div>
                <div class="info"><strong>Rate Type:</strong> ' . $fresult["RateType"] . '</div>
                <div class="info"><strong>Rate:</strong> ' . $fresult["Rate"] . '</div>
            </div>
        </body>
        </html>
        ';
    }
}

$conn->close();
?>
