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
	pvs_update_setting('payme_account', pvs_result( $_POST["account"] ));
	pvs_update_setting('payme_password', pvs_result( $_POST["password"] ));
	pvs_update_setting('payme_active', (int) @ $_POST["active"] );
	pvs_update_setting('payme_test', (int) @ $_POST["test"] );
	
	//Update settings
	pvs_get_settings();
}
?>

<p><a href="https://paycom.uz/"><b>Payme</b></a> is a payment provider.</p>


<form method="post">
<input type="hidden" name="d" value="<?php echo($_GET["d"]);?>">
<input type="hidden" name="action" value="change">

<div class='admin_field'>
<span>Merchant ID:</span>
<input type='text' name='account'  style="width:400px" value="<?php echo $pvs_global_settings["payme_account"] ?>">
</div>

<div class='admin_field'>
<span>Key:</span>
<input type='text' name='password'  style="width:400px" value="<?php echo $pvs_global_settings["payme_password"] ?>">
</div>


<div class='admin_field'>
<span><?php echo pvs_word_lang( "enable" )?>:</span>
<input type='checkbox' name='active' value="1" <?php
	if ( $pvs_global_settings["payme_active"] == 1 ) {
		echo ( "checked" );
	}
?>>
</div>

<div class='admin_field'>
<span>Test mode:</span>
<input type='checkbox' name='test' value="1" <?php
	if ( $pvs_global_settings["payme_test"] == 1 ) {
		echo ( "checked" );
	}
?>>
</div>


<div class='admin_field'>
<input type="submit" class="btn btn-primary" value="<?php echo pvs_word_lang( "save" )?>">
</div>
</form>