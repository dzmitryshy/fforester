<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

$result = json_decode(file_get_contents('php://input'), true);

$headers = getallheaders();
$encoded_credentials = base64_encode("Paycom:" . $pvs_global_settings["payme_password"]);
if ( !$headers || !isset($headers['Authorization']) ||  !preg_match('/^\s*Basic\s+(\S+)\s*$/i', $headers['Authorization'], $matches) || $matches[1] != $encoded_credentials ) {
	exit();
}


if ( isset( $result->result->id ) ) { 

	$mass = explode( "-", $result['params']['account']['order_id'] );
	$id = ( int )$mass[1];
	$product_type = pvs_result( $mass[0] );

	$transaction_id = pvs_transaction_add( "payme", $result['params']['id'], $product_type, $id );

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
?>