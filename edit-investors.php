<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
$users = filter_input(INPUT_GET, 'users',FILTER_SANITIZE_STRING); 
($users == 'edit') ? $edit = true : $edit = false;

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $user_id = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $data_to_update['last_sign_in_stamp'] = date('Y-m-d H:i:s');
    
    $db->where('id',$user_id);
    $stat = $db->update('users', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Investor updated successfully!";
        //Redirect to the listing page,
        header('location: investors.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $user_id);
    //Get data to pre-populate the form.
    $users = $db->getOne("users");
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Investors</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./includes/forms/investors_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>