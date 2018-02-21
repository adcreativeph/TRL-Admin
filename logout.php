<?php
session_start();
session_destroy();

if(isset($_COOKIE['user_name']) && isset($_COOKIE['password'])){
	unset($_COOKIE['user_name']);
    unset($_COOKIE['password']);
    setcookie('user_name', null, -1, '/');
    setcookie('password', null, -1, '/');
}
header('Location:index.php');

 ?>