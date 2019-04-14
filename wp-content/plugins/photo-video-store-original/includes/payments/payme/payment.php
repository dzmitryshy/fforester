<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

pvs_show_payment_page( 'header' );

if ( $pvs_global_settings["payme_test"] ) {
	$url = 'https://test.paycom.uz';
} else {
	$url = 'https://checkout.paycom.uz';
}

$currency_code1 = pvs_get_currency_code(1);

if ( $currency_code1 == 'RUB' or $currency_code1 == 'RUR' ) {
	$payme_currency = 643;
}
else if ( $currency_code1 == 'USD' ) {
	$payme_currency = 840;
}
else if ( $currency_code1 == 'EUR' ) {
	$payme_currency = 978;
}
else {
	$payme_currency = 860;
}

if ( $pvs_global_settings["payme_active"] ) {
?>
	<form action="<?php echo $url ?>" method="post" id="process" name="process">
	<input type="hidden" name="account[order_id]" value="<?php echo($product_type . "-" . $product_id);?>">
	<input type="hidden" name="amount" value="<?php echo $product_total * 100 ?>">
	<input type="hidden" name="merchant" value="<?php echo $pvs_global_settings["payme_account"] ?>">
	<input type="hidden" name="lang" value="ru">
	<input type="hidden" name="currency" value="<?php echo $payme_currency ?>"/>
	<input type="hidden" name="description" value="<?php echo $product_name ?>">
	<input type="hidden" name="callback" value="<?php echo (site_url( ) );?>/payment-notification/?payment=payme"/>
	</form>
<?php
}

pvs_show_payment_page( 'footer' );
?>