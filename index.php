<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$numUsers = $db->getValue ("users", "count(*)");
$numDeposits = $db->getValue ("deposits", "count(*)");
$numWithdrawals = $db->getValue ("withdrawals", "count(*)");
$numCpbtc1 = $db->getValue ("cpbtc1", "count(*)");

include_once('includes/header.php');
?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><span class="icon-home text-primary" style="margin-right: 8px"></span>Dashboard</h2>
        </div>
    </div>
	
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="icon-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numUsers; ?></div>
                            <div>Total Investors</div>
                        </div>
                    </div>
                </div>
                <a href="investors.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Investors</span>
                        <span class="pull-right"><i class="icon-arrow-right-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="icon-cloud-upload fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numDeposits; ?></div>
                            <div>Total Deposits</div>
                        </div>
                    </div>
                </div>
                <a href="deposits.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Deposits</span>
                        <span class="pull-right"><i class="icon-arrow-right-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="icon-cloud-download fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numWithdrawals; ?></div>
                            <div>Total Withdrawals</div>
                        </div>
                    </div>
                </div>
                <a href="withdrawals.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Withdrawals</span>
                        <span class="pull-right"><i class="icon-arrow-right-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		
        <div class="col-lg-3 col-md-6">
			<div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="icon-fire fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $numCpbtc1; ?></div>
                            <div>Bitcoin Transactions</div>
                        </div>
                    </div>
                </div>
                <a href="bitcoins.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Bitcoin</span>
                        <span class="pull-right"><i class="icon-arrow-right-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		
        <div class="col-lg-3 col-md-6">
            
        </div>
		
		<div class="col-lg-3 col-md-6">
            
        </div>
		
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">


            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">

            <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php include_once('includes/footer.php'); ?>
