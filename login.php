<?php
session_start();
require_once './config/config.php';

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE) {
    header('Location:index.php');
}

if(isset($_COOKIE['user_name']) && isset($_COOKIE['password']))
{
	//Get user credentials from cookies.
	$username = filter_var($_COOKIE['user_name']);
	$password = filter_var($_COOKIE['password']);
	$db->where ("user_name", $username);
	$db->where ("password", $password);
    $row = $db->get('users');

    if ($db->count >= 1) 
    {
    	//Allow user to login.
        $_SESSION['user_logged_in'] = TRUE;
        header('Location:index.php');
        exit;
    }
    else //Username Or password might be changed. Unset cookie
    {
    unset($_COOKIE['user_name']);
    unset($_COOKIE['password']);
    setcookie('user_name', null, -1, '/');
    setcookie('password', null, -1, '/');
    header('Location:login.php');
    exit;
    }
}
include_once 'includes/header.php';
?>

<div id="page-" class="col-md-4 col-md-offset-4">
	<form class="form loginform" method="POST" action="authenticate.php">
		<div class="login-panel panel panel-default">
			<div class="panel-heading"><h2>Admin Login</h2><span class="text-danger">version 1.1</span> - www.thereallife.biz</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label">Username</label>
					<input type="text" name="user_name" class="form-control" required="required">
				</div>
				<div class="form-group">
					<label class="control-label">Password</label>
					<input type="password" name="password" class="form-control" required="required">
				</div>
				<div class="checkbox">
					<label>
						<input name="remember" type="checkbox" value="1">Remember Me
					</label>
				</div>
				<?php
				if(isset($_SESSION['login_failure'])){ ?>
				<div class="alert alert-danger alert-dismissable fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $_SESSION['login_failure']; unset($_SESSION['login_failure']);?>
				</div>
				<?php } ?>
				<button type="submit" class="btn btn-success loginField" >Login</button>
			</div>
		</div>
	</form>
</div>
<?php include_once 'includes/footer.php'; ?>