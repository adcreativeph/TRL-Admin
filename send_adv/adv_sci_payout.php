<?php
session_start();
require_once '../config/config.php';

//print_r($_POST);exit;

$db->where('id', $_POST['withdrawal_id']);
//Get data to pre-populate the form.
$withdrawal = $db->getOne("withdrawals");

$m_shop = '446148722';
$m_orderid = ''.$withdrawal['id'];
$m_amount = number_format(floatval($withdrawal['amount']), 2, '.', '');
$m_curr = 'EUR';
$m_desc = base64_encode('Payout made in thereallife system');
$m_key = 'thereallifeuser';

?>
<form id="form-advcash" method="post" action="https://wallet.advcash.com/sci/">
    <input type="hidden" name="ac_account_email" value="www.thereallife@gmail.com" />
    <input type="hidden" name="ac_sci_name" value="thereallife" />
    <input type="hidden" name="ac_amount" value="<?=$m_amount?>" />
    <input type="hidden" name="ac_currency" value="EUR" />
    <input type="hidden" name="ac_order_id" value="<?=$m_orderid?>" />
    <input type="hidden" name="ac_sign" value="71e9d066bf4d73d2b82957f5e6b8ef9fb134ab84781e0f861f9a2f2e7864bad2" />
    <!-- Optional Fields -->
    <!-- <input type="hidden" name="ac_success_url" value="https://www.thereallife.biz/members/#/deposit/adbsuccess" />
    <input type="hidden" name="ac_success_url_method" value="GET" />
    <input type="hidden" name="ac_fail_url" value="https://www.thereallife.biz/members/#/deposit/adbfail" />
    <input type="hidden" name="ac_fail_url_method" value="GET" />
    <input type="hidden" name="ac_status_url" value="https://www.thereallife.biz/be/ajaxPubCalls.php" />
    <input type="hidden" name="ac_status_url_method" value="POST" /> -->
    <input type="hidden" name="ac_comments" value="Payout made in thereallife system" />
    <!-- <input type="submit" /> -->
</form>
<script type="text/javascript">
    document.getElementById('form-advcash').submit(); // SUBMIT FORM
</script>