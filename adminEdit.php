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

if (isset($_GET['concert_id'])) {
    $concert_id = $_GET['concert_id'];

    $sql_select = "SELECT * FROM concert WHERE concert_id = $concert_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $concert = $result->fetch_assoc();

        // Provera da li je forma poslata
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Dohvatanje novih podataka iz forme
            $concert_name = $_POST["concert_name"];
            $description = $_POST["description"];
            $starts_at = $_POST["starts_at"];
            $concert_status = $_POST["concert_status"];
            $price = $_POST["price"];

            // Ažuriranje podataka u tabeli "concert"
            $sql_update = "UPDATE concert SET
                            concert_name = '$concert_name',
                            description = '$description',
                            starts_at = '$starts_at',
                            concert_status = '$concert_status',
                            price = '$price'
                            WHERE concert_id = $concert_id";

            if ($conn->query($sql_update) === TRUE) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error: " . $sql_update . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Koncert sa ID-em $concert_id nije pronađen.";
        $concert = null;
    }
} else {
    echo "Nije dostavljen ID koncerta.";
    $concert = null;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change concert data</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <style>
        body {
            font-family: "Raleway", sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        header {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 40px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
        }

        select,
        input {
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #E24220; /* Crvena boja */
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        button:hover {
            background-color: #eee; /* Svetlo siva boja na hoveru */
            color: #E24220;
        }

        footer {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            background-color: #800000;
            height: 100px;
            margin-top: 20px;
        }

    </style>
</head>
<body>
<header>
    <h1>Change concert data</h1>
</header>
<?php if ($concert): ?>
    <form action="" method="POST">
        <label>Concert Name</label>
        <input type="text" name="concert_name" value="<?php echo $concert['concert_name']; ?>" class="form-control"/>

        <label>Concert Description</label>
        <input type="text" name="description" value="<?php echo $concert['description']; ?>" class="form-control"/>

        <label for="starts_at">Date</label>
        <div class="form-group">
            <input type="date" id="starts_at" name="starts_at" value="<?php echo $concert['starts_at']; ?>" class="form-control">
        </div>

        <label>Concert Status</label>
        <select name="concert_status" class="form-control">
            <option value="active" <?php echo ($concert['concert_status'] == 'active') ? 'selected' : ''; ?>>active</option>
            <option value="inactive" <?php echo ($concert['concert_status'] == 'inactive') ? 'selected' : ''; ?>>inactive</option>
        </select>

        <label>Price</label>
        <input type="text" name="price" value="<?php echo isset($concert['price']) ? $concert['price'] : ''; ?>" class="form-control"/>

        <button type="submit" name="submit" class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success">Save changes</button>
    </form>
<?php endif; ?>
</body>
</html>
