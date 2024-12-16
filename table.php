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

    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Management Table</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 20px;
                background: linear-gradient(135deg, #e3f2fd, #bbdefb);
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            h2 {
                text-align: center;
                color: #333;
                margin-bottom: 30px;
                font-size: 2em;
            }

            .table-container {
                width: 97%;
                height: auto;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
                border-radius: 12px;
                background: white;
                animation: fadeIn 1s forwards;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            .table-header {
                background-color: #1976d2;
                color: white;
                padding: 15px;
                text-align: center;
                font-size: 1.2em;
                border-radius: 10px;
            }

            .table-row {
                width: 98%;
                height: auto;
                border-bottom: 1px solid #ddd;
                padding: 5px;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: background-color 0.2s;
                flex-wrap: wrap;
            }

            .table-row:hover {
                background-color: #f1f1f1;
            }

            .table-cell {
                flex-basis: 250px;
                text-align: center;
            }

            .button {
                padding: 10px 15px;
                border: none;
                border-radius: 6px;
                color: white;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.3s, transform 0.2s;
                margin-left: 5px;
            }

            .update {
                background-color: #4caf50;
            }

            .update:hover {
                background-color: #388e3c;
                transform: scale(1.05);
            }

            .delete {
                background-color: #f44336;
            }

            .delete:hover {
                background-color: #c62828;
                transform: scale(1.05);
            }

            .search-container {
                margin-bottom: 20px;
            }

            .search-bar {
                padding: 10px;
                font-size: 1em;
                width: 200px;
                border-radius: 6px;
                border: 1px solid #ccc;
            }

            .add-employee-btn {
            position: absolute;
            top: 100px;
            right: 50px;
            width: 50px;  
            height: 50px; 
            font-size: 30px;  
            text-align: center;
            line-height: 50px;  
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);  
            cursor: pointer;
            transition: transform 0.3s;  
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            text-decoration: none;
            background: transparent; 
        }

            .add-employee-btn:hover {
                transform: scale(1.1);  
            }

            .add-employee-btn i {
                color: #1976d2;  
                font-size: 30px;  
            }


        </style>
    </head>
    <body>

    <h2>Welcome <?php echo $_SESSION['user']; ?> :)</h2>

    <a href="login.html" class="add-employee-btn">
        <i class="fas fa-plus"></i> 
    </a>

    <div class="search-container">
        <input type="text" id="searchInput" class="search-bar" placeholder="Search by Name..." onkeyup="searchTable()">
    </div>

    <div class="table-container">
        <div class="table-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="flex: 1;">ID</span>
                <span style="flex: 2;">Name</span>
                <span style="flex: 2;">Position</span>
                <span style="flex: 2;">RateType</span>
                <span style="flex: 2;">Rate</span>
                <span style="flex: 1;">Actions</span>
            </div>
        </div>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo ' 
                <div class="table-row">
                    <div class="table-cell">' . $row["EmployeeID"] . '</div>
                    <div class="table-cell">' . $row["Name"] . '</div>
                    <div class="table-cell">' . $row["Position"] . '</div>
                    <div class="table-cell">' . $row["RateType"] . '</div>
                    <div class="table-cell">' . $row["Rate"] . '</div>

                    <form method="POST" action="updatef1.php">
                        <button class="button update">Update</button>
                        <input type="hidden" name="id" value="' . $row["EmployeeID"] . '">
                    </form>

                    <form method="POST" action="delete.php">
                        <button class="button delete">Delete</button>
                        <input type="hidden" name="id" value="' . $row["EmployeeID"] . '">
                    </form>
                </div>';
            }
        }
        ?>
    </div>

    <script>
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll('.table-row');
            
            rows.forEach(row => {
                const nameCell = row.querySelector('.table-cell:nth-child(2)');
                const name = nameCell ? nameCell.textContent.toLowerCase() : '';
                if (name.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>

    </body>
    </html>

    <?php
    $conn->close();
    ?> 
