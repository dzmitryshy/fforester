<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

pvs_show_payment_page( 'header' );

require_once(PVS_PATH . 'includes/plugins/euplataesc/function.php');

$mid=$pvs_global_settings["euplataesc_account"];
$key=$pvs_global_settings["euplataesc_password"];


  $dataAll = array(
			'amount'      => $product_total,                                                   //suma de plata
			'curr'        => 'RON',                                                   // moneda de plata
			'invoice_id'  => $product_type . "-" . $product_id,  // numarul comenzii este generat aleator. inlocuiti cuu seria dumneavoastra
			'order_desc'  => $product_name,                                            //descrierea comenzii
                     // va rog sa nu modificati urmatoarele 3 randuri
			'merch_id'    => $mid,                                                    // nu modificati
			'timestamp'   => gmdate("YmdHis"),                                        // nu modificati
 			'nonce'       => md5(microtime() . mt_rand()),                            //nu modificati
); 
  
$dataAll['fp_hash'] = strtoupper(euplatesc_mac($dataAll,$key));

$buyer_info = array();
pvs_get_buyer_info( get_current_user_id(), $product_id, $product_type );
$user_info = get_userdata(get_current_user_id());

//completati cu valorile dvs
$dataBill = array(
			'fname'	   => $buyer_info["name"],      // nume
			'lname'	   => $buyer_info["lastname"],   // prenume
			'country'  => $buyer_info["billing_country"],      // tara
			'company'  => $buyer_info["company"],   // firma
			'city'	   => $buyer_info["billing_city"],      // oras
			'add'	   => $buyer_info["billing_address"],    // adresa
			'email'	   => @$user_info -> user_email,     // email
			'phone'	   => $buyer_info["telephone"],   // telefon
			'fax'	   => '',       // fax
);
$dataShip = array(
			'sfname'       => $buyer_info["shipping_name"],     // nume
			'slname'       => $buyer_info["shipping_lastname"],  // prenume
			'scountry'     => $buyer_info["shipping_country"],     // tara
			'scompany'     => $buyer_info["company"],  // firma
			'scity'	       => $buyer_info["shipping_city"],     // oras
			'sadd'         => $buyer_info["shipping_address"],      // adresa
			'semail'       => @$user_info -> user_email,    // email
			'sphone'       => $buyer_info["telephone"],  // telefon
			'sfax'	       => '',      // fax
);


if ( $pvs_global_settings["euplataesc_active"] ) {
?>
<form action="https://secure.euplatesc.ro/tdsprocess/tranzactd.php" method="post" id="process" name="process">

<!-- begin billing details -->
    <input name="fname" type="hidden" value="<?php echo $dataBill['fname'];?>" />
    <input name="lname" type="hidden" value="<?php echo $dataBill['lname'];?>" />
    <input name="country" type="hidden" value="<?php echo $dataBill['country'];?>" />
    <input name="company" type="hidden" value="<?php echo $dataBill['company'];?>" />
    <input name="city" type="hidden" value="<?php echo $dataBill['city'];?>" />
    <input name="add" type="hidden" value="<?php echo $dataBill['add'];?>" />
    <input name="email" type="hidden" value="<?php echo $dataBill['email'];?>" />
    <input name="phone" type="hidden" value="<?php echo $dataBill['phone'];?>" />
    <input name="fax" type="hidden" value="<?php echo $dataBill['fax'];?>" />
<!-- snd billing details -->

<!-- daca detaliile de shipping difera -->
<!-- begin shipping details -->
    <input name="sfname" type="hidden" value="<?php echo $dataShip['sfname'];?>" />
    <input name="slname" type="hidden" value="<?php echo $dataShip['slname'];?>" />
    <input name="scountry" type="hidden" value="<?php echo $dataShip['scountry'];?>" />
    <input name="scompany" type="hidden" value="<?php echo $dataShip['scompany'];?>" />
    <input name="scity" type="hidden" value="<?php echo $dataShip['scity'];?>" />
    <input name="sadd" type="hidden" value="<?php echo $dataShip['sadd'];?>" />
    <input name="semail" type="hidden" value="<?php echo $dataShip['semail'];?>" />
    <input name="sphone" type="hidden" value="<?php echo $dataShip['sphone'];?>" />
    <input name="sfax" type="hidden" value="<?php echo $dataShip['sfax'];?>" />

<!-- end shipping details -->

<input type="hidden" NAME="amount" VALUE="<?php echo  $dataAll['amount'] ?>" SIZE="12" MAXLENGTH="12" />
<input TYPE="hidden" NAME="curr" VALUE="<?php echo  $dataAll['curr'] ?>" SIZE="5" MAXLENGTH="3" />
<input type="hidden" NAME="invoice_id" VALUE="<?php echo  $dataAll['invoice_id'] ?>" SIZE="32" MAXLENGTH="32" />
<input type="hidden" NAME="order_desc" VALUE="<?php echo  $dataAll['order_desc'] ?>" SIZE="32" MAXLENGTH="50" />
<input TYPE="hidden" NAME="merch_id" SIZE="15" VALUE="<?php echo  $dataAll['merch_id'] ?>" />
<input TYPE="hidden" NAME="timestamp" SIZE="15" VALUE="<?php echo  $dataAll['timestamp'] ?>" />
<input TYPE="hidden" NAME="nonce" SIZE="35" VALUE="<?php echo  $dataAll['nonce'] ?>" />
<input TYPE="hidden" NAME="fp_hash" SIZE="40" VALUE="<?php echo  $dataAll['fp_hash'] ?>" />
</form>     
<?php
}

pvs_show_payment_page( 'footer' );
?>