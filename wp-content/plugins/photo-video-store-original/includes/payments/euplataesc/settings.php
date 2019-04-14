<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
//Check access
pvs_admin_panel_access( "settings_payments" );

if ( @$_REQUEST["action"] == 'change' )
{
	pvs_update_setting('euplataesc_account', pvs_result( $_POST["account"] ));
	pvs_update_setting('euplataesc_password', pvs_result( $_POST["password"] ));
	pvs_update_setting('euplataesc_active', (int) @ $_POST["active"] );
	
	//Update settings
	pvs_get_settings();
}
?>

<p><a href="https://euplatesc.ro/"><b>EuPlatesc.ro</b></a> is a payment provider.</p>

<ul>
<li>
	<b>Instant Payment Notification URL:</b>
	<br><a href="<?php echo (site_url( ) );?>/payment-notification/?payment=euplataesc"><?php echo (site_url( ) );?>/payment-notification/?payment=euplataesc</a>
</li>
</ul>


<form method="post">
<input type="hidden" name="d" value="<?php echo($_GET["d"]);?>">
<input type="hidden" name="action" value="change">

<div class='admin_field'>
<span>Merchant ID:</span>
<input type='text' name='account'  style="width:400px" value="<?php echo $pvs_global_settings["euplataesc_account"] ?>">
</div>

<div class='admin_field'>
<span>IPN secret:</span>
<input type='text' name='password'  style="width:400px" value="<?php echo $pvs_global_settings["euplataesc_password"] ?>">
</div>


<div class='admin_field'>
<span><?php echo pvs_word_lang( "enable" )?>:</span>
<input type='checkbox' name='active' value="1" <?php
	if ( $pvs_global_settings["euplataesc_active"] == 1 ) {
		echo ( "checked" );
	}
?>>
</div>


<div class='admin_field'>
<input type="submit" class="btn btn-primary" value="<?php echo pvs_word_lang( "save" )?>">
</div>
</form>