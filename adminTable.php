<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vbis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_select = "SELECT concert_id, concert_name, starts_at, concert_status, price FROM concert WHERE concert_status = 'active'";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<table id="kt_datatable_example_2" class="table table-striped table-row-bordered gy-6 gs-9">
    <thead>
    <tr class="fw-bold fs-8 text-muted">
        <th>ID</th>
        <th>Concert name</th>
        <th>Date</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='fs-6'>";
        echo "<td>{$row['concert_id']}</td>";
        echo "<td>{$row['concert_name']}</td>";
        echo "<td>{$row['starts_at']}</td>";
        echo "<td>{$row['price']}</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>

