<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .nav .links a:hover,
        button:hover {
            background-color: #8000ff;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 20px;
            background-color: #607d8b4a;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            width: 100%;
            height: 100px;
            padding: 10px;
        }

        .nav .links {
            width: 15%;
            display: flex;
            justify-content: space-around;
        }

        .nav .links a {
            color: white;
            padding: 4px 10px;
            background-color: #03a9f47a;
            text-decoration: none;
            border-radius: 4px;
            transition: all 1s;
        }

        .input {
            outline: none;
            border: none;
            width: 300px;
            height: 45px;
            border-radius: 10px;
            padding: 10px;
        }

        .form {
            width: 430px;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.423);
            backdrop-filter: blur(30px);
            padding: 30px;
            border-radius: 30px;
            margin-top: 20px;
        }

        form button {
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            background-color: #03a9f47a;
            transition: all 1s;
            cursor: pointer;
        }

        .wrong {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="nav">
        <div class="links">
            <!-- <a href="Login.php">Log in</a> -->
            <!-- <a href="Register.php">Register</a> -->
        </div>
    </div>

    <?php
if(isset($_SESSION['errors'])){
    foreach($_SESSION['errors'] as $error){
        echo "<p class='wrong'>".$error."</p>";
        echo "<br>";
    }
    unset($_SESSION['errors']);
}
    ?>


    <form class="form" action="handle/handleRegister.php" method="post">
        <h3>Register Here</h3>
        <input placeholder="Enter Name" class="input" type="text" name="name">
        <input placeholder="Enter Email" class="input" type="email" name="email">
        <input class="input" placeholder="Enter Password" type="password" name="password">
        <input class="input" placeholder="Enter your phone" type="text" name="phone">
        <button type="submit" name="submit">Register</button>
    </form>

</body>

</html>