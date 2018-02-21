<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$user_id = filter_input(INPUT_POST, 'user_id');
if ($user_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='super'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: investors.php');
        exit;

	}
    $user_id = $user_id;
    $db->where('user_id', $user_id);
    $status = $db->delete('users');
    
    if ($status) 
    {
        $_SESSION['info'] = "Investor deleted successfully!";
        header('location: investors.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete investor";
    	header('location: investors.php');
        exit;

    }
    
}