<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vbis";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_select = "SELECT korisnicko_ime, email, broj_telefona FROM user";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <style>
    </style>
</head>
<body style="margin: 10px;">
<ol class="breadcrumb text-muted fs-6 fw-bold">
    <li class="breadcrumb-item pe-3"><a href="adminLogged.php" class="pe-3" style="color: red;">&lt; Home</a></li>
    <li class="breadcrumb-item px-3 text-muted">Users</li>
</ol>

<div style="padding-left: 100px; padding-right: 100px; border-radius: 10px;  box-shadow: 20px 20px 40px #bebebe49,
        -20px -20px 40px #ffffff; width: 80%; margin: 2% auto; border: 1px solid rgb(241, 241, 241);">
    <table id="kt_datatable_example_1" class="table table-row-bordered gy-5">
        <thead>
        <tr class="fw-bold fs-6 text-muted">
            <th>Username</th>
            <th>Email</th>
            <th>Telephone number</th>

        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['korisnicko_ime']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['broj_telefona']}</td>";

            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $("#kt_datatable_example_1").DataTable();
    });
</script>
</body>
</html>
