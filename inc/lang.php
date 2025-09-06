<?php
session_start();

if(isset($_GET['lang'])){
    $lang = $_GET['lang'];  
}



if($lang == 'ar'){
    $_SESSION['lang'] = 'ar';
}else {
    $_SESSION['lang'] = 'en';
}

// print_r($_SERVER['HTTP_REFERER']);
// exit();



header('location:'.$_SERVER['HTTP_REFERER']);