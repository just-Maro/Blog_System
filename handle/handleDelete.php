<?php
session_start();
require_once '../db/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM posts WHERE `id` = $id";
    $result = mysqli_query($con, $query);
    if ($result) {
        $_SESSION['successDelete'] = "Post deleted successfully";
        header('location:../index.php');
        exit();
    }
    $_SESSION['errorDelete'] = "Post not deleted";
    header('location:../viewPost.php');
    exit();
}
