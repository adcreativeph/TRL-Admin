<?php
session_start();
require_once '../config/config.php';


//print_r($_POST);exit;


$db->where('id', $_POST['withdrawal_id']);
//Get data to pre-populate the form.
$withdrawal = $db->getOne("withdrawals");

//print_r($withdrawal);exit;

$m_shop = '446148722';
$m_orderid = ''.$withdrawal['id'];
$m_amount = number_format(floatval($withdrawal['amount']), 2, '.', '');
$m_curr = 'EUR';
$m_desc = base64_encode('Payout made in thereallife system');
$m_key = 'thereallifeuser';

$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc
);

$arHash[] = $m_key;
$sign = strtoupper(hash('sha256', implode(':', $arHash)));
?>
<form method="post" id="form-payeer" action="https://payeer.com/merchant/">
<input type="hidden" name="m_shop" value="<?=$m_shop?>">
<input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
<input type="hidden" name="m_amount" value="<?=$m_amount?>">
<input type="hidden" name="m_curr" value="<?=$m_curr?>">
<input type="hidden" name="m_desc" value="<?=$m_desc?>">
<input type="hidden" name="m_sign" value="<?=$sign?>">
<?php /*
<input type="hidden" name="form[ps]" value="2609">
<input type="hidden" name="form[curr[2609]]" value="USD">
*/ ?>
<?php /*
<input type="hidden" name="m_params" value="<?=$m_params?>">
*/ ?>
<!-- <input type="submit" name="m_process" value="Send Payeer Payment" /> -->
</form>
<script type="text/javascript">
    document.getElementById('form-payeer').submit(); // SUBMIT FORM
</script>