<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');
$page = filter_input(INPUT_GET, 'page');

$pagelimit = 300;
if (!$page) {
    $page = 1;
}

$select = array('user_id','payment_processor_id','amount','t_submitted','user_name');
if ($order_by)
{
    $db->orderBy($filter_col, $order_by);
}

$db->pageLimit = $pagelimit;

$pagelimit = 500;
if (!$page) {
    $page = 1;
}

$deposits = $db->arraybuilder()->paginate('deposits', $page, $select);
$total_pages = $db->totalPages;

foreach ($deposits as $value) {
    foreach ($value as $col_name => $col_value) {
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
            <h1 class="page-header">Deposits</h1>
        </div>
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default table-responsive panel-primary">
						<div class="panel-heading">
							Deposits
						</div>
						<!-- /.panel-heading -->
					<div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover table-responsive" id="dataTables">
							<thead>
								<tr>
									<th class="header bg-secondary">Date</th>
									<th>User ID</th>
									<th>Username</th>
									<th>Processor</th>
									<th class="bg-warning">Amount</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($deposits as $value) { ?>
									<tr>
										<td><?php echo $value['t_submitted'] ?></td>
										<td><?php echo $value['user_id'] ?></td>
										<td><?php echo $value['user_name'] ?></td>
										<td><?php echo $value['payment_processor_id'] ?></td>
										<td class="text-danger bg-warning" style="font-size: 12px;"><strong><?php echo $value['amount'] ?> €</strong></td>
										
										 <td>
											<a href="" data-toggle="modal" data-target="#confirm-status-<?php echo $value['status'] ?>" class="btn btn-info btn-sm" style="margin:0 2px"><span class="icon-note" style="padding-right: 5px"></span> Edit
											
											<a href=""  class="btn btn-danger btn-sm delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $value['user_id'] ?>" style="margin:0 2px"><span class="icon-trash"></span>
										</td>
									</tr>

											<!-- Delete Confirmation Modal-->
										 <div class="modal fade" id="confirm-delete-<?php echo $row['user_name'] ?>" role="dialog">
											<div class="modal-dialog">
											  <form action="delete_investors.php" method="POST">
											  <!-- Modal content-->
												  <div class="modal-content">
													<div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
													  <h4 class="modal-title">Confirm</h4>
													</div>
													<div class="modal-body">
												  
															<input type="hidden" name="del_id" id = "del_id" value="<?php echo $row['user_name'] ?>">
														
													  <p>Are you sure you want to delete this deposit?</p>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-default pull-left">Yes</button>
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
<?php include_once './includes/footer.php';
?>