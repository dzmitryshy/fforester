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
	pvs_update_setting('transferuj_account', pvs_result( $_POST["account"] ));
	pvs_update_setting('transferuj_password', pvs_result( $_POST["password"] ));
	pvs_update_setting('transferuj_active', (int) @ $_POST["active"] );
	
	//Update settings
	pvs_get_settings();
}
?>

<p><a href="http://transferuj.pl"><b>Transferuj</b></a> is Polish payments provider.</p>


<form method="post">
<input type="hidden" name="d" value="<?php echo($_GET["d"]);?>">
<input type="hidden" name="action" value="change">

<div class='admin_field'>
<span><?php echo pvs_word_lang( "Merchant ID" )?>:</span>
<input type='text' name='account'  style="width:400px" value="<?php echo $pvs_global_settings["transferuj_account"] ?>">
</div>

<div class='admin_field'>
<span><?php echo pvs_word_lang( "Secret word" )?>:</span>
<input type='text' name='password'  style="width:400px" value="<?php echo $pvs_global_settings["transferuj_password"] ?>">
</div>

<div class='admin_field'>
<span><?php echo pvs_word_lang( "enable" )?>:</span>
<input type='checkbox' name='active' value="1" <?php
	if ( $pvs_global_settings["transferuj_active"] == 1 ) {
		echo ( "checked" );
	}
?>>
</div>



<div class='admin_field'>
<input type="submit" class="btn btn-primary" value="<?php echo pvs_word_lang( "save" )?>">
</div>
</form>