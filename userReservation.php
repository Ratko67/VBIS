<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vbis";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT r.id, r.ime_prezime, r.email, r.korisnicko_ime, r.concert_name, r.starts_at, r.price
        FROM reservation r
        JOIN user u ON r.id_korisnika = u.id
        WHERE u.id = '$user_id'";
$result = $conn->query($sql);


if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Reservation</title>
            <link rel='preconnect' href='https://fonts.googleapis.com'> 
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin> 
            <link href='https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300&family=Unbounded:wght@500&display=swap' rel='stylesheet'>
            <link href='https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300&family=Unbounded:wght@500&family=Work+Sans&display=swap' rel='stylesheet'>
            

            <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: #1b3467; 
            margin: 0; 
            padding: 0; 
            color: #ffffff; 
        }

        table {
            width: 80%;
            margin: 100px auto 0;
            border-collapse: collapse;
            color: #ffffff;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
        td{
            color: yellow;
            font-size: 17px;
        }

        th {
            background-color: #363636; 
            color: bisque; 
        }

        .previous {
            background-color: #222222; 
            color: #ffffff;
            border-radius: 50%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px;
            color: #ffffff;
        }

        a:hover {
            background-color: #444444; 
            color: #ffffff; 
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-top: 0px;
            color: yellow;
        }

       
        tr:hover {
            background-color: #555555;
        }
            </style>
        </head>
        <body>";
    echo "<a href='userLogged.php' class='previous'>&#8249;</a>";

    echo "<h1>My reservations</h1>";

    echo "<table>
        <tr>
            <th>ID</th>
            <th>Full name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Concert name</th>
            <th>Date</th>
            <th>Price</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['ime_prezime'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['korisnicko_ime'] . "</td>
                <td>" . $row['concert_name'] . "</td>
                <td>" . $row['starts_at'] . "</td>
                <td>" . $row['price'] . "</td>
            </tr>";
    }

    echo "</table>
        </body>
        </html>";
} else {
    echo "Nema rezervacija za korisnika sa korisničkim imenom: $user_id";

}
$conn->close();
