<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vbis';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Greška pri povezivanju sa bazom podataka: ' . $conn->connect_error);
}

if (isset($_POST['concert_id'])) {
    $delete_id = $_POST['concert_id'];

    $sql = "DELETE FROM concert WHERE concert_id = '$delete_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Greška prilikom brisanja podataka: " . $conn->error;
    }
}

$conn->close();
