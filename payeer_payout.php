<?php
session_start();
require_once './config/config.php';




include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
           <h2 class="page-header" style="text-transform: uppercase"><span class="icon-wallet text-primary" style="margin-right: 8px"></span>Payeer Payout</h2>
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
                require_once('./lib/cpayeer.php');
                require_once './config/payeer-config.php';

                $payeer = new CPayeer($accountNumber, $apiId, $apiKey);
                if ($payeer->isAuth())
                {
                  echo "You are successfully authorized<br>";

                  //print_r($_POST);
                  echo "<br>";  
                  $db->where('id', $_POST['withdrawal_id']);
                  //Get data to pre-populate the form.
                  $withdrawal = $db->getOne("withdrawals");

                  $arTransfer = $payeer->transfer(array(
                    'curIn' => $currency,
                    'sum' => intval($withdrawal['amount']),
                    'curOut' => $currency,
                    //'sumOut' => 1,
                    'to' => $withdrawal['accname'],
                    //'to' => 'normaneil.macutay@gmail.com',
                    //'comment' => 'test',
                    //'protect' => 'Y',
                    //'protectPeriod' => '3',
                    //'protectCode' => '12345',
                  ));

                  if (empty($arTransfer['errors']))
                  {
                    echo $arTransfer['historyId'].": Money transfer is successful";
                  }
                  else
                  {
                    echo '<pre>'.print_r($arTransfer["errors"], true).'</pre>';
                  }


                }
                else
                {
                  echo '<pre>'.print_r($payeer->getErrors(), true).'</pre>';
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