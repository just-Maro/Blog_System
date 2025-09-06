<?php
session_start();
require_once '../db/connection.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $errors = [];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $id = $_GET['id'];

    if (empty($title)) {
        $errors['title'] = 'Title is required';
    }
    if (empty($body)) {
        $errors['body'] = 'Body is required';
    }

    $updatedQuery = "SELECT `image` FROM posts WHERE `id` = $id";
    $updatedRes = mysqli_query($con, $updatedQuery);
    $oldImg = mysqli_fetch_assoc($updatedRes)['image'];

    if (isset($_FILES['image']) && $_FILES['image']['name']) {
        $img = $_FILES['image'];
        $img_name = $img['name'];
        $img_size = $img['size'] / (1024 * 1024);
        $img_tmp = $img['tmp_name'];
        $img_error = $img['error'];
        $ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_newName = uniqid() . "." . $ext;
        $user_id = $_SESSION['user_id'];

        if (empty($img)) {
            $errors[] = "image is required";
        } else if ($img_error > 0) {
            $errors[] = "Image is broken";
        } else if (!in_array($ext, ["png", "jpg"])) {
            $errors[] = "Image should be in png or jpg format";
        }else if($img_size > 5){
            $errors[] = "Image size should be less than 5MB";
        }
    }else{
        $img_newName = $oldImg;
    }

    if (empty($errors)) {
        $query = "UPDATE posts SET `title`='$title', `body`='$body', `image`='$img_newName' WHERE `id`=$id";
        $result = mysqli_query($con, $query);
        if ($result) {
            $_SESSION['successUpdate'] = "Post updated successfully";
            if ($img) {
                move_uploaded_file($img_tmp, '../assets/images/postImage/' . $img_newName);
                unlink('../assets/images/postImage/' . $oldImg);
            }
            header('Location:../index.php');
            exit();
        }
    }
    $_SESSION['errors'] = $errors;
    header('location:../editPost.php');
    exit();
} else {
    header('location:../index.php');
}
