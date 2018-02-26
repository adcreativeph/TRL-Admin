<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('max_execution_time', 0);
require_once("MerchantWebService.php");
$merchantWebService = new MerchantWebService();

$arg0 = new authDTO();
$arg0->apiName = "thereallife";
$arg0->accountEmail = "www.thereallife@gmail.com";
$arg0->authenticationToken = $merchantWebService->getAuthenticationToken("thereallifeuser");

$arg1 = new sendMoneyRequest();
$arg1->amount = 1.00;
$arg1->currency = "EUR";
$arg1->email = "julzinvest2@gmail.com";
//$arg1->walletId = "U000000000000";
$arg1->note = "this is a test";
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

    echo print_r($sendMoneyResponse, true)."<br/><br/>";
    echo $sendMoneyResponse->return."<br/><br/>";
} catch (Exception $e) {
    echo "ERROR MESSAGE => " . $e->getMessage() . "<br/>";
    echo $e->getTraceAsString();
}
?>