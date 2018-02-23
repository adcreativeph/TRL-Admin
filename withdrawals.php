<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$page = filter_input(INPUT_GET, 'page');

$pagelimit = 500;
if (!$page) {
    $page = 1;
}

$db->pageLimit = $pagelimit;

$withdrawals = $db->arraybuilder()->paginate('withdrawals', $page);
$total_pages = $db->totalPages;

foreach ($withdrawals as $value) {
    foreach ($value as $col_name => $value) {
    }
    //execute only once
	break;
}

include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
           <h2 class="page-header" style="text-transform: uppercase"><span class="icon-wallet text-primary" style="margin-right: 8px"></span>Withdrawals</h2>
        </div>
    </div>
    <?php include('./includes/flash_messages.php') ?>
	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default table-responsive panel-primary">
					<div class="panel-heading">
						Withdrawals
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover table-responsive" id="dataTables">
						<thead>
							<tr>
								<th class="header bg-secondary">Date</th>
								<th>User ID</th>
								<th>Investor</th>
								<th><strong>Account No / BTC Wallet</strong></th>
								<th>Email</th>
								<th>Processor</th>
								<th>Status</th>
								<th class="bg-warning">Amount</th>
								<th>Actions</th>
							</tr>
						</thead>
							<tbody>
								<?php
								foreach ($withdrawals as $row){ ?>
									<tr>
										<td><?php echo $row['t_submitted'] ?></td>
										<td><?php echo $row['user_id'] ?></td>
										<td><?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?></td>
										<td class="text-primary" style="text-transform: uppercase"><?php echo $row['accname'] ?></td>
										<td><strong><?php echo $row['email'] ?></strong></td>
										<td><?php echo $row['payment_processor_id'] ?></td>
										<td><?php echo $row['status'] ?></td>
										<td class="text-danger bg-warning" style="font-size: 12px;"><strong><?php echo $row['amount'] ?> €</strong></td>
										
										<td>
											<a href="" data-toggle="modal" data-target="#confirm-payout-<?php echo $row['id'] ?>" class="btn btn-warning btn-sm" style="margin:0 2px"><span class="fa fa-money"></span>
											
											<a href="" data-toggle="modal" data-target="#confirm-status-<?php echo $row['status'] ?>" class="btn btn-info btn-sm" style="margin:0 2px"><span class="icon-note"></span>
											
											<a href=""  class="btn btn-danger btn-sm delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id'] ?>" style="margin:0 2px"><span class="icon-trash"></span>
										</td>
									</tr>

										<!-- Payout Confirmation Modal-->
										<div class="modal fade" id="confirm-payout-<?php echo $row['id'] ?>" role="dialog">
											<div class="modal-dialog">
											  <form name="form-send-payment" id="form-send-payment-<?php echo $row['id'] ?>" class="form-send-payment" action="https://payeer.com/ajax/api/api.php" method="POST">
											  <!-- Modal content-->
												  <div class="modal-content">
													<div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													  <h4 class="modal-title">Send Payout</h4>
													</div>
													<div class="modal-body">
												  
															<input type="hidden" name="accname" value="<?php echo $row['accname'] ?>">
										<input type="hidden" name="withdrawal_id"  value="<?php echo $row['id'] ?>">
													  <p>You are about to send payout to <strong class="text-danger"><u><?php echo $row['first_name'] ?></strong>.</u></p>
													  
														<ul>
															<li><strong>Account Number:</strong> <span class="text-success"><?php echo $row['accname'] ?></span> </li> 
															<li><strong>Amount:</strong> <span class="text-success"><?php echo $row['amount'] ?> €</span></li>
															<li><strong>Select Payment Processor:</strong><br />
																<select class="form-control" name="payment_processor" id="payment_processor_<?php echo $row['id'] ?>" style="width:90%; margin-top: 10px;">
																	<option>ADV</option>
																	<option>Payeer</option>
																	<option>Bitcoin (Coming Soon)</option>
																	<option>Perfect Money (Coming Soon)</option>
																	<option>Paypal (Coming Soon)</option>
																	<option>Coins.PH(Coming Soon)</option>
																</select>
															</li>
														</ul>
														
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-danger pull-right btn-payout" style="margin-left: 10px;" data-wid="<?php echo $row['id'] ?>">Send Payment</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
													</div>
												  </div>
											  </form>
											  
											</div>
										</div>
										
										<!-- Status Confirmation Modal-->
										<div class="modal fade" id="confirm-status-<?php echo $row['status'] ?>" role="dialog">
											<div class="modal-dialog">
											  <form action="status.php" name="status" method="POST">
											  <!-- Modal content-->
												  <div class="modal-content">
													<div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													  <h4 class="modal-title">Withdrawals Status</h4>
													</div>
													<div class="modal-body">
												  
															<input type="hidden" name="status" value="<?php echo $row['status'] ?>">
														
													  <p>Please select withdrawal status</p>
													  
																<select class="form-control" name="status" id="<?php echo $row['id'] ?>" style="width:100%; margin-top: 10px;">
																	<option class="text-warning">Submitted</option>
																	<option class="text-danger">Processing</option>
																	<option class="text-primary">Sent</option>
																	<option class="text-success">Completed</option>
																</select>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-danger pull-right" style="margin-left: 10px;" data-wid="<?php echo $row['id'] ?>">Save</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
													</div>
												  </div>
											  </form>
											  
											</div>
										</div>
									
											<!-- Delete Confirmation Modal-->
										<div class="modal fade" name="delete-withdrawal" id="confirm-delete-<?php echo $value['user_id'] ?>" role="dialog">
											<div class="modal-dialog">
											  <form action="d-withdrawals.php" id="confirm-delete-<?php echo $value['user_id'] ?>" method="POST">
											  <!-- Modal content-->
												  <div class="modal-content">
													<div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													  <h4 class="modal-title">Confirm Deletion</h4>
													</div>
													<div class="modal-body">
												  
															<input type="hidden" name="user_id" id = "user_id" value="<?php echo $value['user_id'] ?>">
														
													  <p>Are you sure you want to <span class="text-danger"><strong>delete</strong></span> this withdrawal?</p>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-danger pull-right" style="margin-left: 10px;">Delete</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
													</div>
												  </div>
											  </form>
											  
											</div>
										</div>
								<?php } ?>      
							</tbody>
						</table>
				</div>
				</div>
			</div>
		</div>
</div>
<!--Main container end-->
<?php include_once './includes/footer.php'; ?>