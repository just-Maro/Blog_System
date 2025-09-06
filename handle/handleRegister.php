<?php
session_start();
require_once '../db/connection.php';
require_once 'validate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];

    $checkQuery = "SELECT `email` FROM users WHERE `email` = '$email'";
    $checkResult = mysqli_query($con, $checkQuery);
    if (mysqli_num_rows($checkResult) == 1) {
        $errors['email'] = "email is already exist";
        $_SESSION['errors'] = $errors;
        header('location:../register.php');
        exit();
    }


    $errors = [];
    foreach ($validate as $validate_name => $validate_value) {
        $value = filter_input(
            INPUT_POST,
            $validate_name,
            $validate_value['filter'],
            $validate_value['myOptions'] ?? []
        );

        if (empty($_POST[$validate_name])) {
            $errors[$validate_name] = "u must fill $validate_name";
        } else if ($value == false) {
            $errors[$validate_name] = $validate_value['error'];
        }
    }

    if ($errors) {
        $_SESSION['errors']  = $errors;
        header('location:../register.php');
        exit();
    } else {
        $_SESSION['successRegister'] = "successful register";
    }


    $query = "INSERT INTO users (`name`,`email`,`password`,`phone`) VALUES ('$name','$email','$password','$phone')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "user created";
        header('location:../login.php');
        exit();
    } else {
        header('location:../register.php');
    }
} else {
    header('location:../register.php');
}
