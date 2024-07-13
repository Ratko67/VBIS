<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    $imePrezime = $_POST['ime_prezime'];
    $email = $_POST["email"];
    $username = $_POST["korisnicko_ime"];
    $concert_name = $_POST["concert_name"];
    $starts_at = $_POST["starts_at"];
    $price = $_POST["price"];

    $sql = "INSERT INTO reservation (id_korisnika, concert_name, ime_prezime, email, korisnicko_ime, starts_at, price) 
            VALUES ('$user_id', '$concert_name', '$imePrezime', '$email', '$username', '$starts_at', '$price')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Successful booking!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$concert_id = isset($_GET['concert_id']) ? $_GET['concert_id'] : null;

$sql = "SELECT concert_name, starts_at, price FROM concert WHERE concert_status = 'active'";
$result = $conn->query($sql);

$selected_concert = null;
if ($concert_id) {
    $selected_sql = "SELECT concert_name, starts_at, price FROM concert WHERE concert_id = $concert_id";
    $selected_result = $conn->query($selected_sql);
    if ($selected_result->num_rows > 0) {
        $selected_concert = $selected_result->fetch_assoc();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervacija</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300&family=Unbounded:wght@500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300&family=Unbounded:wght@500&family=Work+Sans&display=swap">
    <style>
        body {
            height: 100%;
            width: 100%;
            margin: 0;
            background-color: #603737;
            font-family: 'Work Sans', sans-serif;
        }
        form {
            background-color: white;
            color: red;
            border-radius: 20px;
            backdrop-filter: blur( 10.5px );
            -webkit-backdrop-filter: blur( 10.5px );
            border-radius: 10px;
            border: 1px solid red;
            max-width: 400px;
            margin: 0 auto;
            padding: 40px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"] {
            width: 350px;
            height: 80%;
            padding: 8px;
            margin-top: 5px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid red;
            background: transparent;
        }
        input[type="text"]:invalid:focus,
        input[type="email"]:invalid:focus,
        input[type="date"]:invalid:focus,
        input[type="number"]:invalid:focus {
            border-color: red;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .rezervisi {
            display: block;
            margin: 25px auto;
            outline: none;
            cursor: pointer;
            font-weight: 500;
            border-radius: 3px;
            padding: 0 15px;
            border-radius: 4px;
            color: bisque;
            background: #524c4c;
            line-height: 1.15;
            font-size: 14px;
            height: 36px;
            word-spacing: 0px;
            letter-spacing: .0892857143em;
            text-decoration: none;
            text-transform: uppercase;
            min-width: 64px;
            border: 1px solid #ee0000;
            transition: background 280ms cubic-bezier(0.4, 0, 0.2, 1);
            align-items: center;
        }
        .rezervisi:hover {
            background: #f00c0c;
            color: #f2f2f2;
        }
        .sve-rezervacije {
            display: block;
            margin: 10px auto 0;
            outline: none;
            cursor: pointer;
            font-weight: 500;
            border-radius: 3px;
            padding: 0 15px;
            border-radius: 4px;
            color: #ee0000;
            background: transparent;
            line-height: 1.15;
            font-size: 14px;
            height: 36px;
            word-spacing: 0px;
            letter-spacing: 0.3px;
            text-decoration: none;
            text-transform: uppercase;
            min-width: 64px;
            border: 1px solid #ee0000;
            transition: background 280ms cubic-bezier(0.4, 0, 0.2, 1);
            align-items: center;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
        }
        .sve-rezervacije:hover {
            background: #f00c0c;
            color: #f2f2f2;
        }
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
            background-color: #fff;
        }
        select option {
            font-size: 16px;
        }
        .previous {
            background-color: #f1f1f1;
            color: black;
            border-radius: 50%;
            margin-top:10px;
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px;
        }
        a:hover {
            background-color: #ddd;
            color: #2c2c2c;
        }
        .success-message {
            color: #000000;
            font-weight: bold;
            font-size: 32px;
            text-align: center;
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
<a href="userLogged.php" class="previous">&#8249;</a>
<div style="margin-top: 100px;"></div>
<form action="reservation.php" method="POST">
    <label for="imePrezime">Full name</label>
    <input type="text" id="imePrezime" name="ime_prezime" required><br>
    <label for="email">Email address</label>
    <input type="email" id="email" name="email" required><br>
    <label for="username">Username</label>
    <input type="text" id="username" name="korisnicko_ime" required><br><br>
    <label for="concert_name">Choose concert</label>
    <select id="concert_name" name="concert_name" required>
        <?php
        while ($row = $result->fetch_assoc()) {
            $selected = ($selected_concert && $selected_concert['concert_name'] == $row['concert_name']) ? 'selected' : '';
            echo "<option value='" . $row['concert_name'] . "' $selected>" . $row['concert_name'] . "</option>";
        }
        ?>
    </select>
    <br>
    <label for="starts_at">Date</label>
    <input type="date" id="starts_at" name="starts_at" value="<?php echo $selected_concert ? $selected_concert['starts_at'] : ''; ?>" required><br><br>
    <label for="price">Price</label>
    <input type="number" id="price" name="price" value="<?php echo $selected_concert ? $selected_concert['price'] : ''; ?>" required><br><br>
    <button class="rezervisi" type="submit" name="submit">Make a booking</button>
</form>
<?php if (isset($success_message)) { echo '<p class="success-message">' . $success_message . '</p>'; } ?>
<?php if (isset($error_message)) { echo '<p>' . $error_message . '</p>'; } ?>
</body>
</html>
