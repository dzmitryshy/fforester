<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

if ( preg_match("/^([a-z0-9_.-]{1,20})@([a-z0-9.-]{1,20}).([a-z]{2,4})/uis", $_POST["guest_email"]) ) {
	$aff = 0;
	if ( isset( $_COOKIE["aff"] ) ) {
		$aff = ( int )$_COOKIE["aff"];
	}

	$sql = "select ID from " . $table_prefix . "users where user_email='" .
		pvs_result( $_POST["guest_email"] ) . "'";
	$rs->open( $sql );
	if ( $rs->eof ) {
		$email_part = explode("@", pvs_result( $_POST["guest_email"] ));
		
		$guest_login = $email_part[0];
		
		if ( username_exists( $guest_login ) ) {
			$guest_login .= 'guest';
			
			if ( username_exists( $guest_login ) ) {
				$guest_login .= '2';
			}
		}
		
		$guest_password = pvs_create_password();
	
		$params["login"] = $guest_login;
		$params["password"] = $guest_password;
		$params["name"] = 'Guest';
		$params["country"] = '';
		$params["telephone"] = '';
		$params["address"] = '';
		$params["email"] = pvs_result( $_POST["guest_email"] );
		$params["ip"] = pvs_result( $_SERVER["REMOTE_ADDR"] );
		$params["lastname"] = 'Guest';
		$params["city"] = '';
		$params["state"] = '';
		$params["zipcode"] = '';
		$params["category"] = $pvs_global_settings["userstatus"];
		$params["website"] = '';
		$params["utype"] = 'buyer';
		$params["company"] = '';
		$params["newsletter"] = 0;
		$params["examination"] = 1;
		$params["authorization"] = 'site';
		$params["aff_commission_buyer"] = ( int )$pvs_global_settings["buyer_commission"];
		$params["aff_commission_seller"] = ( int )$pvs_global_settings["seller_commission"];
		$params["aff_visits"] = 0;
		$params["aff_signups"] = 0;
		$params["aff_referal"] = $aff;
		$params["business"] = 0;
		$params["vat"] = '';
		$params["payout_limit"] = ( int )$pvs_global_settings["payout_limit"];
		$params["avatar"] = '';
		$params["description"] = '';
		$params["downloads"] = 0;
		$params["downloads_date"] = 0;
		$params["country_checked"] = 0;
		$params["country_checked_date"] = 0;
		$params["vat_checked"] = 0;
		$params["vat_checked_date"] = 0;
		$params["rating"] = 0;

		$id = pvs_add_user( $params );

		pvs_send_notification( 'signup_guest', $guest_login, $guest_password );
		pvs_send_notification( 'signup_to_admin', $id );

		//insert the coupon for new user
		pvs_coupons_add( $guest_login, "New Signup" );
		
		$creds = array();
		$creds['user_login'] = $guest_login;
		$creds['user_password'] = $guest_password;
		$creds['remember'] = true;

		$user = wp_signon( $creds, false );
		wp_set_current_user($user->ID);
	} else {
		header( "location:" . site_url()  . "/login/?d=4" );
		exit();
	}
} else {
	header( "location:" . site_url()  . "/login/" );
	exit();
}
?>