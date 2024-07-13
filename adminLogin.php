<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Povezivanje sa bazom podataka
    $host = "localhost";
    $db = "vbis";
    $user = "root";
    $pass = "";
    $charset = "utf8mb4";

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

    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $username = $_POST['user'];
        $password = $_POST['pass'];

        if ($username === "Ratko") {

            $allowedPassword = "ratko123";
            if ($password === $allowedPassword) {
                $_SESSION['user_id'] = $username;
                echo "Uspela prijava!";
                header("Location: adminLogged.php");
                exit();
            } else {
                echo "Pogrešna lozinka!";
            }
        } else {
            echo "Pogrešno korisničko ime!";
        }
    } else {
        echo "Nisu postavljeni korisničko ime i lozinka.";
    }
} else {
    echo "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            color: bisque;
            background-color: rgba(0, 0, 0, 0.870);
            font: 600 16px/18px "Open Sans", sans-serif;
        }
        *,
        :after,
        :before {
            box-sizing: border-box;
        }
        a {
            color: inherit;
            text-decoration: none;
        }
        .login-wrap {
            margin-top: 100px;
            width: 100%;
            margin: auto;
            max-width: 525px;
            min-height: 760px;
            position: relative;
            border-radius: 20px;
        }
        .login-html {
            margin-top: 50px;
            width: 100%;
            height: 100%;
            position: absolute;
            padding: 90px 70px 50px 70px;

        }
        .login-html .tab,
        .login-form .group .label,
        .login-form .group .button {
            text-transform: uppercase;
        }
        .login-html .tab {
            font-size: 22px;
            margin-right: 15px;
            cursor: pointer;
            padding-bottom: 5px;
            margin: 0 15px 10px 0;
            display: inline-block;
            border-bottom: 2px solid transparent;
        }
        .login-html .sign-in:checked + .tab,
        .login-html .sign-up:checked + .tab {
            color: #fff;
            border-color: rgba(0, 0, 0, 0.145);
            cursor: pointer;
        }
        .login-form {
            margin-top: 50px;
            min-height: 345px;
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
        }
        .login-form .group {
            margin-bottom: 15px;
        }
        .login-form .group .label,
        .login-form .group .input,
        .login-form .group .button {
            width: 100%;
            color: bisque;
            display: block;
        }
        .login-form .group .input,
        .login-form .group .button {
            border: none;
            padding: 15px 20px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
        }
        .login-form .group .label {
            color: bisque;
            font-size: 12px;
        }
        .login-form .group .button {
            background-color: red;
            cursor: pointer;
        }
        .login-form .group .button:hover {
            background-color: rgba(0, 0, 0, 0.700);
            cursor: pointer;
        }
        .previous {
            background-color: #f1f1f1;
            color: black;
            border-radius: 50%;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px;
        }

        a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>
<a href="index.php" class="previous">&#8249;</a>
<div class="login-wrap">
    <div class="login-html">
        <label for="tab-1" class="tab">ADMINISTRATOR</label>

        <form action="adminLogin.php" method="post">
            <div class="login-form">
                <div class="sign-in-htm">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" name="user" required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="pass" required>
                    </div>

                    <div class="group">
                        <input type="submit" class="button" value="Log in">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
