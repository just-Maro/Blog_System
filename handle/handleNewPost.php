<?php
session_start();
require_once '../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $user_id = $_SESSION['user_id'];

    if (empty($title)) {
        $errors['title'] = 'Title is required';
    }
    if (empty($body)) {
        $errors['body'] = 'Body is required';
    }

    $img = $_FILES['image'];
    $img_name = $img['name'];
    $img_size = $img['size'] / (1024 * 1024);
    $img_tmp = $img['tmp_name'];
    $img_error = $img['error'];
    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_newName = uniqid() . "." . $ext;

    if (empty($img)) {
        $errors[] = "image is required";
    } else if ($img_error > 0) {
        $errors[] = "Image is broken";
    } else if (!in_array($ext, ["png", "jpg"])) {
        $errors[] = "Image should be in png or jpg format";
    }

    if (empty($errors)) {
        $query = "INSERT INTO posts (`title`, `body`, `image`,`user_id`) 
        VALUES ('$title', '$body', '$img_newName', '$user_id')";
        $result = mysqli_query($con, $query);
        if ($result) {
            $_SESSION['successAdd'] = "Post added successfully";
            move_uploaded_file($img_tmp, '../assets/images/postImage/' . $img_newName);
            header('location:../index.php');
            exit();
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location:../addPost.php');
        exit();
    }
} else {
    header('location:../index.php');
}
