<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
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

$sql = "SELECT * FROM user WHERE id = $user_id";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Mazyar">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet">
    <meta name="author" content="Mazyar">
    <title>prikazProfila</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css'>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .card {
            max-width: 800px;
            margin: 0 auto;
        }

        .btn-edit {
            background-color: rgba(0, 0, 0, 0.600)  !important;
            color: bisque !important;
            border: none;
        }

        .btn-edit:hover {
            background-color: black !important;
            color: white !important;
        }
    </style>
</head>

<body>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo '<div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">USERNAME</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">' . $row['korisnicko_ime'] . '</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">EMAIL</h6>
                            </div>';
        echo '<div class="col-sm-9 text-secondary">' . $row['email'] . '</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">TELEFON</h6>
                            </div>';
        echo '<div class="col-sm-9 text-secondary">' . $row['broj_telefona'] . '</div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="edit.php" method="POST">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <button type="submit" class="btn btn-edit">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }
} else {
    echo "<div>Korisnik nije pronađen.</div>";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Mazyar">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet">
    <meta name="author" content="Mazyar">
    <title>prikazProfila</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css'>
</head>

<body>
</body>

</html>

