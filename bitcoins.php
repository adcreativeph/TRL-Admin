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

$select = array('id','user_id','amount','amount1','currency1','currency2','item_number','btc_amount');

if ($search_string) 
{
    $db->where('first_name', '%' . $search_string . '%', 'like');
    $db->orwhere('last_name', '%' . $search_string . '%', 'like');
}

$db->pageLimit = $pagelimit;

$cpbtc1 = $db->arraybuilder()->paginate('cpbtc1', $page, $select);
$total_pages = $db->totalPages;

foreach ($cpbtc1 as $row) {
    foreach ($row as $col_name => $col_row) {
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
            <h2 class="page-header" style="text-transform: uppercase"><span class="icon-fire text-primary" style="margin-right: 8px"></span>Bitcoin Transactions</h2>
        </div>
    </div>
    <?php include('./includes/flash_messages.php') ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default table-responsive panel-primary">
						<div class="panel-heading">
							Bitcoins
						</div>
						<!-- /.panel-heading -->
					<div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover table-responsive" id="dataTables">
						<thead>
							<tr>
								<th class="header">ID</th>
								<th>User ID</th>
								<th>Amount</th>
								<th>Currency[1]</th>
								<th>Currency[2]</th>
								<th>Item Number</th>
								<th>Amount[1]</th>
								<th>BTC Amount</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($cpbtc1 as $row) {
							?>
								<tr class="odd gradeX">
									<td><?php echo $row['id'] ?></td>
									<td><?php echo $row['user_id'] ?></td>
									<td class="text-danger bg-warning" style="font-size: 12px;"><strong><?php echo $row['amount'] ?> €</strong></td>
									<td><?php echo $row['currency1'] ?></td>
									<td><?php echo $row['currency2'] ?></td>
									<td><?php echo $row['item_number'] ?></td>
									<td><?php echo $row['amount1'] ?></td>
									<td><?php echo $row['btc_amount'] ?></td>
									<td>
										<a href="#" class="btn btn-primary btn-sm" data-target="#edit-funds-<?php echo $row['user_id'] ?>" style="margin:0 2px"><span class="icon-note"></span>

										<a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['user_id'] ?>" style="margin:0 2px"><span class="icon-trash"></span>
									</td>
								</tr>
								
									<!-- Edit Funds Modal-->
									 <div class="modal fade" id="edit-funds-<?php echo $row['user_id'] ?>" role="dialog">
										<div class="modal-dialog">
										  <form action="e_bitcoins.php" method="POST">
										  <!-- Modal content-->
											  <div class="modal-content">
												<div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal">&times;</button>
												  <h4 class="modal-title">Modify Investor Funds</h4>
												</div>
												<div class="modal-body">
											  
														<input type="hidden" name="user_id" id="user_id" value="<?php echo $row['user_id'] ?>">
													
												  <p>Are you sure you want to modify the investor funds?</p>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px;">Modify</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
												</div>
											  </div>
										  </form>
										  
										</div>
									</div>

									<!-- Delete Confirmation Modal-->
									 <div class="modal fade" id="confirm-delete-<?php echo $row['user_id'] ?>" role="dialog">
										<div class="modal-dialog">
										  <form action="delete_investors.php" method="POST">
										  <!-- Modal content-->
											  <div class="modal-content">
												<div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal">&times;</button>
												  <h4 class="modal-title">Delete Investor</h4>
												</div>
												<div class="modal-body">
											  
														<input type="hidden" name="user_id" id = "user_id" value="<?php echo $row['user_id'] ?>">
													
												  <p>Are you sure you want to delete this investor?</p>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px;">Delete</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
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

