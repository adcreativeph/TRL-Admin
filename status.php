<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$status = filter_input(INPUT_POST, 'status');
if ($status && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='super'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: withdrawals.php');
        exit;

	}
    $status = $status;
    $db->where('withdrawals', $status);
    
    if ($status) 
    {
        $_SESSION['info'] = "Status modified successfully!";
        header('location: withdrawals.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to modify withdrawal status";
    	header('location: withdrawals.php');
        exit;

    }
    
}