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

$select = array('user_id', 'user_name', 'first_name', 'last_name', 'email', 'sign_up_stamp','last_sign_in_stamp');

if ($search_string) 
{
    $db->where('first_name', '%' . $search_string . '%', 'like');
    $db->orwhere('last_name', '%' . $search_string . '%', 'like');
}

$db->pageLimit = $pagelimit;

$users = $db->arraybuilder()->paginate('users', $page, $select);
$total_pages = $db->totalPages;

foreach ($users as $value) {
    foreach ($value as $col_name => $col_value) {
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
            <h2 class="page-header" style="text-transform: uppercase"><span class="icon-people text-primary" style="margin-right: 8px"></span>Investors</h2>
        </div>
    </div>
    <?php include('./includes/flash_messages.php') ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default table-responsive panel-primary">
						<div class="panel-heading">
							Investors
						</div>
						<!-- /.panel-heading -->
					<div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover table-responsive" id="dataTables">
						<thead>
							<tr>
								<th class="header">User ID</th>
								<th>Username</th>
								<th>Investor</th>
								<th>Email</th>
								<th>Joined</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($users as $row) {
							?>
								<tr class="odd gradeX">
									<td><?php echo $row['user_id'] ?></td>
									<td><?php echo $row['user_name'] ?></td>
									<td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
									<td><?php echo $row['email'] ?></td>
									<td><?php echo $row['sign_up_stamp'] ?></td>
									<td>
										<a href="" class="btn btn-primary btn-sm" data-target="#confirm-verify-<?php echo $row['user_id'] ?>" style="margin:0 2px"><span class="icon-user"></span>

										<a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['user_id'] ?>" style="margin:0 2px"><span class="icon-trash"></span>
									</td>
								</tr>
								
									<!-- Verification Modal-->
									 <div class="modal fade" id="confirm-verify-<?php echo $row['user_id'] ?>" role="dialog">
										<div class="modal-dialog">
										  <form action="delete_investors.php" method="POST">
										  <!-- Modal content-->
											  <div class="modal-content">
												<div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal">&times;</button>
												  <h4 class="modal-title">Investor Verification</h4>
												</div>
												<div class="modal-body">
											  
														<input type="hidden" name="del_id" id = "del_id" value="<?php echo $row['user_id'] ?>">
													
												  <p>Are you sure you want to verify this investor?</p>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px;">Verify</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
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