<?php
// Database connection details
include 'db_connection.php';

// Fetch data and filter by date if provided
$filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';

$sql = "SELECT email, password, created_at FROM users";
if ($filter_date) {
    $sql .= " WHERE DATE(created_at) = '$filter_date'";
}
$sql .= " ORDER BY created_at DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    form {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        margin-right: 10px;
    }

    input[type="date"] {
        padding: 5px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        padding: 6px 12px;
        font-size: 16px;
        color: #fff;
        background-color: #007BFF;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;
    }

    button:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
    }

    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #007BFF;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .no-records {
        text-align: center;
        padding: 20px;
        font-size: 18px;
        color: #888;
    }
</style>

</head>
<body>
    <h2>Registered Users</h2>

    <form method="GET" action="">
        <label for="filter_date">Filter by Date:</label>
        <input type="date" id="filter_date" name="filter_date">
        <button type="submit">Filter</button>
    </form>

    <table border="1">
        <tr>
            <th>Email</th>
            <th>Password</th>
            <th>Date Registered</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            // Output data for each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }
        ?>

    </table>

    <?php
    // Close the connection
    $conn->close();
    ?>
</body>
</html>
