<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

pvs_show_payment_page( 'header' );

// following files need to be included
require_once(PVS_PATH . 'includes/plugins/paytm/config_paytm.php');
require_once(PVS_PATH . 'includes/plugins/paytm/encdec_paytm.php');

$user_info = get_userdata(get_current_user_id());

$checkSum = "";
$paramList = array();

$ORDER_ID = $product_type . "-" . $product_id;
$CUST_ID = @$user_info -> user_login;
$INDUSTRY_TYPE_ID = "Retail";
$CHANNEL_ID = "WEB";
$TXN_AMOUNT = $product_total;

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = $pvs_global_settings["paytm_account"];
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = str_replace("http://", "", str_replace("https://", "", site_url()));


$paramList["CALLBACK_URL"] = site_url() . "/payment-notification/?payment=paytm";

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,$pvs_global_settings["paytm_password"]);

if ( $pvs_global_settings["paytm_active"] ) {
?>
<form action="<?php echo PAYTM_TXN_URL ?>" method="post" id="process" name="process">
	<?php
		foreach($paramList as $name => $value) {
			echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
		}
	?>
	<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
</form>
<?php
}

pvs_show_payment_page( 'footer' );
?>