<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');
$page = filter_input(INPUT_GET, 'page');

$pagelimit = 500;
if (!$page) {
    $page = 1;
}

$select = array('accname','user_name','email','user_id','first_name','last_name','payment_processor_id','amount','status','t_submitted');

$db->pageLimit = $pagelimit;

$withdrawals = $db->arraybuilder()->paginate('withdrawals', $page, $select);
$total_pages = $db->totalPages;

foreach ($withdrawals as $value) {
    foreach ($value as $col_name => $value) {
		 $filter_options[$col_name] = $col_name;
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
								foreach ($withdrawals as $value){ ?>
									<tr>
										<td><?php echo $value['t_submitted'] ?></td>
										<td><?php echo $value['user_id'] ?></td>
										<td><?php echo $value['first_name'] ?> <?php echo $value['last_name'] ?></td>
										<td class="text-primary" style="text-transform: uppercase"><?php echo $value['accname'] ?></td>
										<td><strong><?php echo $value['email'] ?></strong></td>
										<td><?php echo $value['payment_processor_id'] ?></td>
										<td><?php echo $value['status'] ?></td>
										<td class="text-danger bg-warning" style="font-size: 12px;"><strong><?php echo $value['amount'] ?> €</strong></td>
										
										<td>
											<a href="" data-toggle="modal" data-target="#confirm-payout-<?php echo $value['user_id'] ?>" class="btn btn-warning btn-sm" style="margin:0 2px"><span class="fa fa-money"></span>
											
											<a href="" data-toggle="modal" data-target="#confirm-status-<?php echo $value['status'] ?>" class="btn btn-info btn-sm" style="margin:0 2px"><span class="icon-note"></span>
											
											<a href=""  class="btn btn-danger btn-sm delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $value['user_id'] ?>" style="margin:0 2px"><span class="icon-trash"></span>
										</td>
									</tr>

										<!-- Payout Confirmation Modal-->
										<div class="modal fade" id="confirm-payout-<?php echo $value['user_id'] ?>" role="dialog">
											<div class="modal-dialog">
											  <form name="form-send-payment" id="form-send-payment-<?php echo $value['id'] ?>" class="form-send-payment" action="https://payeer.com/ajax/api/api.php" method="POST">
											  <!-- Modal content-->
												  <div class="modal-content">
													<div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													  <h4 class="modal-title">Send Payout</h4>
													</div>
													<div class="modal-body">
												  
															<input type="hidden" name="accname" id="accname" value="<?php echo $value['id'] ?>">
															<input type="hidden" name="withdrawal_id" id="withdrawal_id" value="<?php echo $value['id'] ?>">
													  <p>You are about to send payout to <strong class="text-danger"><u><?php echo $row['first_name'] ?></strong>.</u></p>
													  
														<ul>
															<li><strong>Account Number:</strong> <span class="text-success"><?php echo $value['accname'] ?></span> </li> 
															<li><strong>Amount:</strong> <span class="text-success"><?php echo $value['amount'] ?> €</span></li>
															<li><strong>Select Payment Processor:</strong><br />
																<select class="form-control" name="payment_processor" id="payment_processor_<?php echo $value['id'] ?>" style="width:90%; margin-top: 10px">
																	<option><strong>ADV</strong></option>
																	<option><strong>Payeer</strong></option>
																	<option class="text-danger">Bitcoin (Coming Soon)</option>
																	<option class="text-danger">Perfect Money (Coming Soon)</option>
																	<option class="text-danger">Paypal (Coming Soon)</option>
																	<option class="text-danger">Coins.PH(Coming Soon)</option>
																</select>
															</li>
														</ul>
														
													</div>
													<div class="modal-footer">
														<button type="submit" id="btn-payout" class="btn btn-danger pull-right" style="margin-left: 10px;" data-wid="<?php echo $value['id'] ?>">Send Payout</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
													</div>
												  </div>
											  </form>
											  
											</div>
										</div>
										
										<!-- Status Confirmation Modal-->
										<div class="modal fade" id="confirm-status-<?php echo $value['status'] ?>" role="dialog">
											<div class="modal-dialog">
											  <form action="status.php" name="status" method="POST">
											  <!-- Modal content-->
												  <div class="modal-content">
													<div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													  <h4 class="modal-title">Withdrawals Status</h4>
													</div>
													<div class="modal-body">
												  
															<input type="hidden" name="status" id="status" value="<?php echo $value['status'] ?>">
														
													  <p>Please select withdrawal status</p>
													  
																<select class="form-control" name="status" id="status" value="<?php echo $value['status'] ?>" style="width:100%; margin-top: 10px;">
																	
																	<option id="status" class="text-warning">Submitted</option>
																	<option id="status" class="text-danger">Processing</option>
																	<option id="status" class="text-primary">Sent</option>
																	<option id="status" class="text-success">Completed</option>

																</select><br />
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-danger pull-right" style="margin-left: 10px;">Save</button>
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