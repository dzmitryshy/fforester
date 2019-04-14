<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

require_once(PVS_PATH . 'includes/plugins/euplataesc/function.php');

$key = $pvs_global_settings["euplataesc_password"];
$zcrsp =  array (
'amount'     => addslashes(trim(@$_POST['amount'])),  //original amount
'curr'       => addslashes(trim(@$_POST['curr'])),    //original currency
'invoice_id' => addslashes(trim(@$_POST['invoice_id'])),//original invoice id
'ep_id'      => addslashes(trim(@$_POST['ep_id'])), //Euplatesc.ro unique id
'merch_id'   => addslashes(trim(@$_POST['merch_id'])), //your merchant id
'action'     => addslashes(trim(@$_POST['action'])), // if action ==0 transaction ok
'message'    => addslashes(trim(@$_POST['message'])),// transaction responce message
'approval'   => addslashes(trim(@$_POST['approval'])),// if action!=0 empty
'timestamp'  => addslashes(trim(@$_POST['timestamp'])),// meesage timestamp
'nonce'      => addslashes(trim(@$_POST['nonce'])),
);
 
$zcrsp['fp_hash'] = strtoupper(euplatesc_mac($zcrsp, $key));

$fp_hash=addslashes(trim(@$_POST['fp_hash']));
if($zcrsp['fp_hash']===$fp_hash)	{
// start facem update in baza de date
if($zcrsp['action']=="0") {
	echo "Successfully completed";

	$mass = explode( "-", @$_POST['invoice_id'] );
	$id = ( int )$mass[1];
	$product_type = pvs_result( $mass[0] );

	$transaction_id = pvs_transaction_add( "euplatesc", pvs_result(@$_POST['ep_id']), $product_type, $id );

	if ( $product_type == "credits" and ! pvs_is_order_approved( $id, 'credits' ) ) {
		pvs_credits_approve( $id, $transaction_id );
		pvs_send_notification( 'credits_to_user', $id );
		pvs_send_notification( 'credits_to_admin', $id );
	}

	if ( $product_type == "subscription" and ! pvs_is_order_approved( $id, 'subscription' ) ) {
		pvs_subscription_approve( $id );
		pvs_send_notification( 'subscription_to_user', $id );
		pvs_send_notification( 'subscription_to_admin', $id );
	}

	if ( $product_type == "order"  and ! pvs_is_order_approved( $id, 'order' ) ) {
		pvs_order_approve( $id );
		pvs_commission_add( $id );

		pvs_coupons_add( pvs_order_user( $id ) );
		pvs_send_notification( 'neworder_to_user', $id );
		pvs_send_notification( 'neworder_to_admin', $id );
	}
}
else {
	echo "Tranzaction failed" . $zcrsp['message'];
}
// end facem update in baza de date
} else {
echo "Invalid signature";
}
?>