<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vbis";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT concert_id, concert_name, starts_at, description, concert_status FROM concert WHERE concert_status = 'active'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo '<div style="width: 70%; height: auto; margin-top: 40px;">';

    echo '<div class="flex flex-col rounded-xl overflow-hidden aspect-square border dark:border-zinc-600">';

    $imagePath = 'images/' . strtolower(str_replace(' ', '', $row['concert_name'])) . '.jpg';
    echo '<img src="' . $imagePath . '" class="h-/5 object-cover w-full" alt="Concert cover" style="width: 835px; height: 550px;">';

    echo '<div class="w-full h-1/5 bg-white dark:bg-zinc-800 dark:text-white px-5 flex items-center justify-between border-t-2 border-t-red-600">';


    echo '<span class="capitalize font-medium truncate" style="font-size: 180%; margin-top: 20px; font-weight: bolder; height: 100px">'. $row['concert_name'] . '</span>';


    echo '<a class="prikaziVise ml-auto" href="concert.php?concert_id=' . $row['concert_id'] . '">Show more about concert</a>';
    echo '</div>';

    echo '<div style="width: 100%; display: flex; justify-content: center; align-items: center;">';
    echo '<h4 style="font-size: 180%; color: grey;">' . $row['description'] . '</h4>';
    echo '</div>';

    echo '<div style="width: 100%; display: flex; justify-content: center; align-items: center; margin-top: 20px;">';
    echo '<h2 style="font-size: 20px; font-weight: bold; color: black;"><p>DATE OF CONCERT</p>' . $row['starts_at'] . '</h2>';
    echo '</div>';

    echo '</div>';
    echo '</div>';
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
    <title>Concerts</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    .prikaziVise{
        background-color: rgba(0, 0, 0, 0.750);
        color: bisque;
        padding: 10px;
        width: 200px;
        margin-left: 20px;
        border-radius: 20px;
        text-align: center;
    }
</style>

</head>
<body>
</body>
</html>
