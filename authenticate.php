<?php 
require_once './config/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = filter_input(INPUT_POST, 'user_name');
    $password = filter_input(INPUT_POST, 'password');
    $remember = filter_input(INPUT_POST, 'remember');
    $password=  md5($password);
   	
    $query = "SELECT * FROM users WHERE user_name='$username' AND password='$password'";
	
    $row = $db->query($query);

    $db->where ("user_name", $username);
    $db->where ("password", $password);
    $row = $db->get('users');
     
    if ($db->count >= 1) {
        $_SESSION['user_logged_in'] = TRUE;
        $_SESSION['admin_type'] = $row[0]['admin_type'];
       	if($remember)
       	{
       		setcookie('username',$username , time() + (86400 * 90), "/");
       		setcookie('password',$password , time() + (86400 * 90), "/");
       	}
        header('Location:index.php');
        exit;
    } else {
        $_SESSION['login_failure'] = "Invalid Username or Password";
        header('Location:login.php');
        exit;
    }
}
?>