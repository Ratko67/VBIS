<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vbis";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$concert_id = $_GET['concert_id'];

$sql = "SELECT concert_name, starts_at, description, concert_status FROM concert WHERE concert_id = $concert_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $concert_name = $row['concert_name'];
    $starts_at = $row['starts_at'];
    $description = $row['description'];
    $concert_status = $row['concert_status'];
} else {
    echo "Nema rezultata za dati ID koncerta.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/scripts.bundle.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            font-family: 'Yanone Kaffeesatz', sans-serif;
            margin: 0; padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            outline: none;
            border: none;
            transition: all .3s cubic-bezier(.16,.8,.62,1.52);
            text-transform: capitalize;
            font-weight: normal;
        }

        *::selection {
            background-color: red;
            color: #fff;
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
        }

        body {
            overflow-x: hidden;
            background-color: #801d1d;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 2rem;
        }

        html::-webkit-scrollbar {
            width: 1.3rem;
        }

        html::-webkit-scrollbar-track {
            background: #000;
        }

        html::-webkit-scrollbar-thumb {
            background-color: red;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 800px;
        }

        .container h1 {
            color: white;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-block;
            padding: .7rem 4rem;
            font-size: 2rem;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.750);
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .btn:hover {
            transform: scale(1.02);
        }

        .home {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: linear-gradient(rgba(159, 211, 229, 0.69), rgba(0, 0, 0, 0.31));
            border: 1px solid black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
        }

        .home .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .home .content h3 {
            color: red;
            font-size: 2rem;
            padding-bottom: 1rem;
        }

        .home .content h1 {
            color: #000;
            font-size: 5rem;
            margin-bottom: 1rem;
        }

        .home .content p {
            color: black;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .home .content .desc {
            color: black;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>MAKE RESERVATION</h1>
    <section class="home" id="home">
        <div class="content">
            <h1><?php echo $concert_name; ?></h1>
            <p>CONCERT DATE: <?php echo $starts_at ?></p>
            <p class="desc"><?php echo $description; ?></p>
            <a href="reservation.php?concert_id=<?php echo $concert_id; ?>" class="btn">reservations</a>
        </div>
    </section>
</div>
</body>
</html>

