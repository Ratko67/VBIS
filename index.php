<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300&family=Unbounded:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            width: 100vw;
            margin: 0;
            background-image: url(images/koncertPozadina.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        h1 {
            font-family: 'Unbounded', cursive;
            text-align: center;
            margin-top: 80px;
            font-size: 100px;
            color: bisque;
        }

        h2 {
            text-align: center;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 30px;
            margin-top: -70px;
            color: bisque;
        }

        h3 {
            text-align: right;
            color: white;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 500;
        }

        .dugme {
            display: inline-block;
            outline: none;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            text-align: center;
            align-items: center;
            border-radius: 500px;
            transition-property: background-color, border-color, color, box-shadow, filter;
            transition-duration: .3s;
            border: 1px solid transparent;
            letter-spacing: 2px;
            min-width: 160px;
            text-transform: uppercase;
            white-space: normal;
            font-weight: 700;
            padding: 17px 48px;
            color: crimson;
            background-color: beige;
            height: 48px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dugme:hover {
            transform: scale(1.04);
            background-color: #e02121;
            color: bisque;
        }

        footer>p {
            text-align: center;
            color: white;
            margin-top: 20%;
            font-family: 'Space Grotesk', sans-serif;
        }

        .fixed-content img {
            max-width: 500px;
            float: left;
            bottom: 0;
        }

        .fixed-content p {
            color: red;
            float: right;
            margin-bottom: -100px;
        }

        label {
            color: white;
            font-family: 'Unbounded', cursive;
        }

        .dugme2 {
            display: inline-block;
            outline: none;
            cursor: pointer;
            font-size: 12px;
            text-align: center;
            align-items: center;
            background: none;
            margin-top: 10px;
            margin-left: 10px;
            color: bisque;
            height: 48px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
        }

        .dugme2:hover {
            transform: scale(1.04);
            background-color: #e02121;
            color: white;
        }
    </style>
</head>
<body>
<button onclick="window.location.href = 'adminLogin.php';" class="dugme2">ADMINISTRATOR</button>
<h1>CONCERT BOOKING</h1>
<h2>schedule a new unforgettable experience</h2>
<center><button onclick="window.location.href = 'userLogin.php';" class="dugme">Let's go</button></center>
</body>
</html>
