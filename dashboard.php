<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    $concert_name = $_POST["concert_name"];
    $description = $_POST["description"];
    $date = $_POST["starts_at"];
    $price = $_POST["price"];
    $concert_status = $_POST["concert_status"];
    $sql = "INSERT INTO concert (concert_name, description, starts_at, concert_status, price) 
            VALUES ('$concert_name', '$description', '$date', '$concert_status', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "Uspešno dodat novi koncert.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_select = "SELECT concert_id, concert_name, starts_at, concert_status, price FROM concert";
$result = $conn->query($sql_select);


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Concerts</title>
    <link rel="canonical" href="Https://preview.keenthemes.com/jet-free" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>

    <style>
        .form-control {
            color: grey;
            font-size: 10px;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
            color: #000000;
            text-transform: uppercase;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .form-group label {
            margin-right: 10px;
            font-size: 10px;
        }
    </style>
</head>

<body style="margin: 10px;">
<ol class="breadcrumb text-muted fs-6 fw-bold">
    <li class="breadcrumb-item pe-3"><a href="adminLogged.php" class="pe-3" style="color: red;">< Home</a></li>
    <li class="breadcrumb-item px-3 text-muted">Concerts</li>
</ol>

<button id="btnAddConcert" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger" style="width: 16%; font-size: 14px; margin: 20px;"> + ADD NEW CONCERT</button>

<div id="addConcertDiv" class="card card-flush shadow-sm" style="display: none; width: 50%; margin-bottom: 20px; padding: 20px; margin-left: 20%;">
    <div class="card-header">
        <h3 class="card-title">ADD CONCERT</h3>
        <div class="card-toolbar">
            <button id="btnClose" type="button" class="btn btn-sm btn-light">
                X
            </button>
        </div>
    </div>
    <div class="card-body py-2">
        <form action="" method="POST">
            <label>CONCERT NAME</label>
            <input type="text" name="concert_name" class="form-control"/>
            <label>DESCRIPTION</label>
            <input type="text" name="description" class="form-control"/>
            <label for="starts_at">DATE</label>
            <div class="form-group">
                <input type="date" id="starts_at" name="starts_at" class="form-control">
            </div>
            <label>CONCERT STATUS</label>
            <select id="concert_status" name="concert_status" class="form-control">
                <option value="" disabled selected hidden>active/inactive ↓</option>
                <option value="active">active</option>
                <option value="inactive">inactive</option>
            </select>
            <label>PRICE</label>
            <input type="number" name="price" class="form-control"/>
    </div>
    <div class="card-footer">
        <button type="submit" name="submit" class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success">SUBMIT</button>
    </div>
    </form>
</div>

<div style="padding-left: 100px; padding-right: 100px; border-radius: 10px; margin-top: 5%; box-shadow: 20px 20px 40px #bebebe49, -20px -20px 40px #ffffff; width: 80%; margin: 0 5%; border: 1px solid rgb(241, 241, 241);">
    <table id="kt_datatable_example_1" class="table table-row-bordered gy-6">
        <thead>
        <tr class="fw-bold fs-8 text-muted">
            <th>ID</th>
            <th>Concert name</th>
            <th>Starts at</th>
            <th>Status</th>
            <th>Price</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='fs-6'>";
            echo "<td>{$row['concert_id']}</td>";
            echo "<td>{$row['concert_name']}</td>";
            echo "<td>{$row['starts_at']}</td>";
            //STATUS AKTIVAN
            if ($row['concert_status'] == 'active') {
                echo "<td style='color: green; font-weight: bolder;'>{$row['concert_status']}</td>";
            } elseif ($row['concert_status'] == 'inactive') {
                echo "<td style='color: red; font-weight: bolder;'>{$row['concert_status']}</td>";
            } else {
                echo "<td>{$row['concert_status']}</td>";
            }
            echo "<td>{$row['price']}</td>";
            echo '<td><a href="adminEdit.php?concert_id=' . $row['concert_id'] . '" class="btn btn-light btn-sm">EDIT</a></td>';
            echo '<td><button class="deleteButton" style="border: none; background: none; padding: 0;" data-id="' . $row['concert_id'] . '">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" color="red" width="20" height="20" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">';
            echo '<path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 1 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>';
            echo '</svg>';
            echo '</button></td>';
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php include('import.php'); ?>
<script>
    $("#kt_datatable_example_1").DataTable();
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var addButton = document.getElementById('btnAddConcert');
        var addConcertDiv = document.getElementById('addConcertDiv');
        var closeButton = document.getElementById('btnClose');

        addButton.addEventListener('click', function () {
            addConcertDiv.style.display = 'block';
        });

        closeButton.addEventListener('click', function () {
            addConcertDiv.style.display = 'none';
        });
    });

    $(document).ready(function () {
        $(".deleteButton").click(function () {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "delete.php",
                data: { concert_id: id },
                success: function () {
                    window.location.href = "dashboard.php";
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
</body>
</html>
