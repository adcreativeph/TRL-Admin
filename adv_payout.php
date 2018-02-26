<?php
session_start();
require_once './config/config.php';




include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
           <h2 class="page-header" style="text-transform: uppercase"><span class="icon-wallet text-primary" style="margin-right: 8px"></span>ADVCASH Payout</h2>
        </div>
    </div>
    
	<div class="row">
    <div class="col-lg-12">
			<div class="panel panel-default table-responsive panel-primary">
					<div class="panel-heading">
						Result
					</div>

					<div class="panel-body">
            <pre>
              <?php
                error_reporting(E_ALL);
                ini_set('display_errors', '1');
                ini_set('max_execution_time', 0);
                require_once('./lib/MerchantWebService.php');
                require_once './config/adv-config.php';

                $merchantWebService = new MerchantWebService();
                $arg0 = new authDTO();
                $arg0->apiName = $apiName;
                $arg0->accountEmail = $accountEmail;
                $arg0->authenticationToken = $merchantWebService->getAuthenticationToken($authenticationToken);

                $arg1 = new sendMoneyRequest();

                //print_r($_POST);
                //echo "<br>";  
                if(!isset($_POST['withdrawal_id'])) {
                  echo "Missing withdrawal id";
                  exit;
                }

                $db->where('id', $_POST['withdrawal_id']);
                //Get data to pre-populate the form.
                $withdrawal = $db->getOne("withdrawals");
                //print_r($withdrawal);

                if($withdrawal['status'] == 'completed') {
                  echo "Already been processed";
                  exit;
                }

                $arg1->amount = floatval($withdrawal['amount']);
                $arg1->currency = $currency;
                //$arg1->email = "julzinvest2@gmail.com";
                $arg1->walletId = strtoupper($withdrawal['accname']);
                $arg1->note = "payout for withdrawal id : {$withdrawal['id']}";
                $arg1->savePaymentTemplate = false;

                $validationSendMoney = new validationSendMoney();
                $validationSendMoney->arg0 = $arg0;
                $validationSendMoney->arg1 = $arg1;

                $sendMoney = new sendMoney();
                $sendMoney->arg0 = $arg0;
                $sendMoney->arg1 = $arg1;

                try {
                    $merchantWebService->validationSendMoney($validationSendMoney);
                    $sendMoneyResponse = $merchantWebService->sendMoney($sendMoney);

                    //Update the status
                    $db->where('id',$_POST['withdrawal_id']);
                    $stat = $db->update('withdrawals', array('status' => 'completed'));
                    
                    //echo print_r($sendMoneyResponse, true)."<br/><br/>";
                    echo "Money transfer is successful<br>";
                    echo $sendMoneyResponse->return;
                } catch (Exception $e) {
                    echo "ERROR MESSAGE => " . $e->getMessage() . "<br/>";
                    echo $e->getTraceAsString();
                }

                
              ?>
            </pre>      
				  </div>
				</div>
			</div>
		</div>
</div>
<!--Main container end-->
<?php include_once './includes/footer.php'; ?>