<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vbis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM user WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];


        if (isset($hashedPassword) && password_verify($password, $hashedPassword)) {

            $_SESSION['user_id'] = $row['id'];
            header("Location: userLogged.php");
            exit();
        } else {
            echo "Pogrešan email ili lozinka.";
        }
    } else {
        echo "Pogrešan email ili lozinka.";
    }


    $stmt->close();
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
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
            background: linear-gradient( rgba(159, 211, 229, 0.69), rgba(0, 0, 0, 0.31)), url(images/koncert2.jpg);
            background-repeat: no-repeat;
            background-size: cover;

        }
        .main{
            width: 350px;
            height: 430px;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.300);
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
            margin-top: 170px;
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
        p{
            color: bisque;
        }
        a{
            color: bisque;
            font-weight: bold;

        }
    </style>

</head>

<body>

<center>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form action="userLogin.php" method="POST">
                <label for="chk" aria-hidden="true">Log in</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <button type="submit">Log in</button>
            </form>
            <p>You don't have an account? <a href="userSignUp.php"> Sign up</a></p>
        </div>



</center>
</body>

</html>