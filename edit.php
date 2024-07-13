<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Izmena podataka o korisničkom profilu</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <style>
        body {
            font-family: "Raleway", sans-serif;
        }
        .edit-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .edit-button button {
            padding: 10px 20px;
            background-color: #444;
            color: #eee;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .edit-button button:hover {
            background-color: black;
            color: bisque;
            cursor: pointer;
        }
        button {
            font-family: "Raleway", sans-serif;
        }
        footer {
            display: flex;
            justify-content: center;
            width: 100%;
            align-items: center;
            background-color: #800000;
            height: 100px;
            margin-top: 144px;
        }


        header {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 40px;
        }

        form label,
        form input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<header>
    <h1>Izmena podataka o korisničkom profilu</h1>
</header>

<main>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vbis";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Greška pri povezivanju sa bazom podataka: " . $conn->connect_error);
    }

    if (!isset($_POST['id'])) {
        echo "ID nije prosleđen.";
        exit();
    }



    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $korisnicko_ime = $row['korisnicko_ime'];
            $email = $row['email'];
            $broj_telefona = $row['broj_telefona'];
        } else {
            echo "Nije moguće pronaći podatke za izmenu.";
            exit();
        }
    }

    if (isset($_POST['update_button'])) {
        $id = $_POST['id'];
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $email = $_POST['email'];
        $broj_telefona = $_POST['broj_telefona'];

        $sql = "UPDATE user SET korisnicko_ime = '$korisnicko_ime', email = '$email', broj_telefona = '$broj_telefona' WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            header("Location: userLogged.php");
            exit();
        } else {
            echo "Greška prilikom ažuriranja podataka: " . $conn->error;
        }
    }
    ?>

    <form id="bookForm" action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">

        <label for="korisnicko_ime">Username:</label>
        <input type="text" id="korisnicko_ime" name="korisnicko_ime" value="<?php echo isset($korisnicko_ime) ? $korisnicko_ime : ''; ?>" required>

        <label for="email">E-mail adresa:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>

        <label for="broj_telefona">Broj telefona:</label>
        <input type="text" id="broj_telefona" name="broj_telefona" value="<?php echo isset($broj_telefona) ? $broj_telefona : ''; ?>" required>

        <div class="edit-button">
            <button type="submit" name="update_button">Sačuvaj izmene</button>
        </div>
    </form>
</main>
</body>
</html>
