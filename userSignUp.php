<?php
// Podešavanje konekcije na MySQL bazu podataka
$host = "localhost";
$db = "vbis";
$user = "root";
$pass = "";
$charset = "utf8mb4";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $email = $_POST['email'];
    $broj_telefona = $_POST['broj_telefona'];
    $password = $_POST['password'];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        die("Error: Could not connect. " . $e->getMessage());
    }


    $stmt_register = $pdo->prepare("INSERT INTO user (korisnicko_ime, email, broj_telefona, password) VALUES (?, ?, ?, ?)");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt_register->execute([$korisnicko_ime, $email, $broj_telefona, $hashed_password]);
    if ($stmt_register->rowCount() > 0) {
        echo "";
    } else {
        echo "Greška prilikom registracije.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])): ?>

            var toastContainer = document.getElementById('toastContainer');
            toastContainer.style.display = 'block';

            var confirmButton = document.getElementById('confirmButton');
            confirmButton.addEventListener('click', function () {
                toastContainer.style.display = 'none';
            });
            <?php endif; ?>
        });
        document.addEventListener('DOMContentLoaded', function () {
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])): ?>
            var toastContainer = document.getElementById('toastContainer');
            toastContainer.classList.add('show');

            var confirmButton = document.getElementById('confirmButton');
            confirmButton.addEventListener('click', function () {
                toastContainer.classList.remove('show');

                window.location.href = 'userLogin.php';
            });


            setTimeout(function () {
                toastContainer.classList.remove('show');

                window.location.href = 'userLogin.php';
            }, 5000);
            <?php endif; ?>
        });

    </script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        body{
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Jost', sans-serif;
            background: linear-gradient( rgba(159, 211, 229, 0.69), rgba(0, 0, 0, 0.31)), url(images/koncert3.jpg);
            background-repeat: no-repeat;
            background-size: cover;

        }
        .main{
            width: 350px;
            height: auto;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.601);
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
        }
        #chk{
            display: none;
        }
        .signup{
            position: relative;
            width:100%;
            height: 100%;
        }
        label{
            color: bisque;
            font-size: 2.3em;
            justify-content: center;
            display: flex;
            margin: 60px;
            font-weight: bold;
            cursor: pointer;
            transition: .5s ease-in-out;
        }
        input{
            width: 60%;
            height: 20px;
            background: #ffffff;
            justify-content: center;
            display: flex;
            margin: 20px auto;
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 5px;
        }
        button{
            width: 60%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: block;
            color: bisque;
            background-color: rgba(0, 0, 0, 0.145);
            font-size: 1em;
            font-weight: bold;
            margin-top: 20px;
            outline: none;
            border: none;
            border-radius: 20px;
            transition: .2s ease-in;
            cursor: pointer;
        }
        button:hover{
            background: white;
            color: black;
        }
        .toast__container {
            display: table-cell;
            vertical-align: middle;
        }

        .toast__cell{
            display:inline-block;
        }

        .add-margin{
            margin-top:20px;
        }

        .toast__svg{
            fill:#fff;
        }

        .toast {
            text-align:left;
            padding: 21px 0;
            border-radius:4px;
            max-width: 500px;
            top: 0px;
            position:relative;
            margin-left: 20px;
        }


        .toast:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            border-top-left-radius:4px;
            border-bottom-left-radius: 4px;

        }

        .toast__icon{
            position:absolute;
            top:50%;
            left:22px;
            transform:translateY(-50%);
            width:14px;
            height:14px;
            padding: 7px;
            border-radius:50%;
            display:inline-block;
        }

        .toast__type {
            color: bisque;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 8px;
        }

        .toast__message {
            font-size: 14px;
            margin-top: 0;
            margin-bottom: 0;
            color: bisque;
        }

        .toast__content{
            padding-left:70px;
            padding-right:60px;
        }


        .toast--blue .toast__icon{
            background-color: rgba(0, 0, 0, 0.601);
        }

        .toast--blue:before{
            background-color: rgba(0, 0, 0, 0.601);
        }
        p{
            color: bisque;
        }
        a{
            color: bisque;
            font-weight: bold;

        }
        #toastContainer {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.601);
            color: bisque;
            padding: 10px;
            border-radius: 10px;
            z-index: 999;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        #toastContainer.show {
            opacity: 1;
        }

        #toastContainer p {
            margin: 0;
        }

        #confirmButton {
            margin-top: 10px;
            background-color: rgba(0, 0, 0, 0.601);
            color: bisque;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        #confirmButton:hover {
            background-color: rgba(0, 0, 0, 0.601);
            color: bisque;
        }
    </style>

</head>

<body>


<div class="toast__container">
    <div class="toast__cell">
        <div class="toast toast--blue add-margin">
            <div class="toast__icon">
                <svg version="1.1" class="toast__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
            <g>
                <g id="info">
                    <g>
                        <path  d="M10,16c1.105,0,2,0.895,2,2v8c0,1.105-0.895,2-2,2H8v4h16v-4h-1.992c-1.102,0-2-0.895-2-2L20,12H8     v4H10z"></path>
                        <circle  cx="16" cy="4" r="4"></circle>
                    </g>
                </g>
            </g>

                </svg>
            </div>
            <div class="toast__content">
                <p class="toast__type">PLEASE LOG IN!</p>
                <p class="toast__message">To countinue, you need to be logged in. You dont have account? Sign up.</p>
            </div>
        </div>
    </div>
</div>

<center>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div id="toastContainer" style="display: none; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: rgba(0, 0, 0, 0.601); color: bisque; padding: 10px; border-radius: 5px; z-index: 999;">
            <p>Registracija uspešna.</p>
            <button id="confirmButton" style="margin-top: 10px; background-color: rgba(0, 0, 0, 0.145); color: bisque; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">Potvrdi</button>
        </div>
        <div class="signup">

            <form action="userSignUp.php" method="POST">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="korisnicko_ime" placeholder="User name">
                <input type="email" name="email" placeholder="Email">
                <input type="telefon" name="broj_telefona" placeholder="Broj telefona">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="register">Sign up</button>
            </form>
        </div>

        <p>Imate kreiran nalog? <a href="userLogin.php">ULOGUJTE SE</a></p>
    </div>
</center>
</body>

</html>
