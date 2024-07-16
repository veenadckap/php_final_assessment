<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Data</title>
    <style>
        h1 {
            text-align: center;
        }
        .table {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        table {
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 3px solid #ddd;
            padding: 15px;
        }
        th {
            background-color: #f2f2f2;
        }
        .button-name {
            align-items: center;
            appearance: none;
            background-color: #FCFCFD;
            border-radius: 4px;
            border-width: 0;
            box-sizing: border-box;
            color: #36395A;
            cursor: pointer;
            display: inline-flex;
            font-family: "JetBrains Mono", monospace;
            height: 48px;
            justify-content: center;
            line-height: 1;
            list-style: none;
            overflow: hidden;
            padding-left: 16px;
            padding-right: 16px;
            position: relative;
            text-align: left;
            text-decoration: none;
            transition: box-shadow .15s, transform .15s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            will-change: box-shadow, transform;
            font-size: 18px;
            border: 1px solid black;
        }
        .button-name:hover {
            box-shadow: rgba(45, 35, 66, 0.3) 0 2px 8px, rgba(45, 35, 66, 0.2) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            transform: translateY(-2px);
        }
        .button-name:active {
            box-shadow: #D6D6E7 0 3px 7px inset;
            transform: translateY(2px);
        }
        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-input {
            width: 50%;
            padding: 10px;
            font-size: 16px;
        }
        .search-button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Students list</h1>
    <div class="search-bar">
        <form method="GET" action="">
            <input type="text" name="search" required class="search-input" placeholder="Search by name, roll number, dob, or standard">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>
    <div class="table">
        <table>
            <tr>
           
                <th>ID</th>
                <th>Name</th>
                <th>Standard</th>
                <th>Roll number</th>
                <th>DOB</th>
                <th>Modifying</th>
            </tr>
            <?php
            $db = include("../model/DB.php");
            $config = include('../config.php');
            $databaseConnection = new DatabaseConnection($config);
            $conn = $databaseConnection->getConnection();

            $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

            $sql = "SELECT * FROM students";
            if ($search != '') {
                $sql .= " WHERE 
                        name LIKE '%$search%' OR 
                        roll_number LIKE '%$search%' OR 
                        dob LIKE '%$search%' OR 
                        standard LIKE '%$search%'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["standard"] . "</td>";
                    echo "<td>" . $row["roll_number"] . "</td>";
                    echo "<td>" . $row["dob"] . "</td>";
                    echo "<td><a href='../controller/edit_user.php?id=" . $row["id"] . "'><button role='button' class='button-name'>Edit</button></a> <a href='../controller/delete_user.php?id=" . $row["id"] . "'><button role='button' class='button-name'>Delete</button></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No results found</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
