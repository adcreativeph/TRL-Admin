<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>TRL Admin Dashboard - www.thereallife.biz</title>

		<link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/sb-admin-2.css" rel="stylesheet">
		
		<link href="vendor/metisMenu/metisMenu.css" rel="stylesheet">
		<!-- <link href="vendor/morrisjs/morris.css" rel="stylesheet"> -->
		<link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
		
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="js/jquery.min.js" type="text/javascript"></script> 

    </head>

    <body>
        <div id="wrapper">
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ) : ?>
                <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">TRL Admin Dashboard <span class="text-danger" style="font-size: 12px;">version 1.1</span></a>
                    </div>
                    <!-- /.navbar-header -->

                    <ul class="nav navbar-top-links navbar-right">
                        <!-- /.dropdown -->

                        <!-- /.dropdown -->
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-user"></i> <i class="icon-arrow-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#"><i class="icon-user"></i> Admin Profile</a>
                                </li>
                                <li><a href="#"><i class="icon-settings"></i> Admin Settings</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="icon-logout"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.navbar-top-links -->

                    <div class="navbar-default sidebar" role="navigation">
                        <div class="sidebar-nav navbar-collapse">
                            <ul class="nav" id="side-menu">
                                <li>
                                    <a href="index.php"><i class="icon-home" style="padding-right: 15px"></i> Dashboard</a>
                                </li>

                                <li class="">
                                    <a href="investors.php"><i class="icon-people" style="padding-right: 15px"></i> Investors<span class="fa arrow"></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="investors.php"><i class="icon-list" style="padding-right: 15px"></i> All</a>
                                        </li>
										<li class="bg-warning">
											<a href="verify.php" class="text-secondary"><i class="icon-check" style="padding-right: 15px"></i> Verify Documents</a>
										</li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="deposits.php"><i class="icon-cloud-upload" style="padding-right: 15px"></i> Deposits<span class="fa arrow"></span></a>
									<ul class="nav nav-second-level">
                                        <li>
                                            <a href="deposits.php"><i class="icon-list" style="padding-right: 15px"></i> All</a>
                                        </li>
										<li>
											<a href="#"><i class="icon-pencil" style="padding-right: 15px"></i> Edit Deposit</a>
										</li>

                                    </ul>
                                </li>
								<li>
                                    <a href="withdrawals.php"><i class="icon-cloud-download" style="padding-right: 15px"></i> Withdrawals<span class="fa arrow"></span></a>
                                </li>
								<li>
                                    <a href="bitcoins.php"><i class="fa fa-bitcoin" style="padding-right: 15px"></i> Bitcoin<span class="fa arrow"></span></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.sidebar-collapse -->
                    </div>
                    <!-- /.navbar-static-side -->
                </nav>
            <?php endif; ?>
            <!-- The End of the Header -->