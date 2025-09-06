<?php
session_start();
require_once('../db/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)) {
        $query = "SELECT * FROM users WHERE `email` = '$email'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $oldPassword = $user['password'];
            $user_id = $user['id'];
            $user_name = $user['name'];

            $verify = password_verify($password, $oldPassword);
            if ($verify) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['successLogin'] = "Welcome . $user_name";
                setcookie('welcomeMsg',$_SESSION['successLogin'],time() + 30);
                header('location:../index.php');
                exit();
            } else {    
                $_SESSION['error'] = "Wrong password";
                header('location:../login.php');
                exit();
            }
        } else {
            $_SESSION['error'] = "Wrong email";
            header('location:../login.php');
            exit();
        }
    }
    $_SESSION['error'] = "you must fill all the fields";
    header('location:../login.php');
    exit();
} else {
    header('location:../login.php');
}
