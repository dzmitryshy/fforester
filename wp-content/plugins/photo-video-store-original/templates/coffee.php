<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
?>
<div class="page_internal">
<h1><?php echo pvs_word_lang( "Coffee" )?></h1>
<p>Photo ID #<?php echo((int)$_GET["id"]);?> "<?php echo(pvs_result($_GET["title"]));?>"</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business" value="<?php echo $pvs_global_settings["paypal_account"] ?>">

    <!-- Specify a Donate button. -->
    <input type="hidden" name="cmd" value="_donations">

    <!-- Specify details about the contribution -->
    <input type="hidden" name="item_name" value="<?php echo(pvs_result($_GET["title"]));?>">
    <input type="hidden" name="item_number" value="Photo ID #<?php echo((int)$_GET["id"]);?>">
    <input type="hidden" name="currency_code" value="<?php echo pvs_get_currency_code(1)?>">
    
	<input type="text" name="amount" value="" placeholder="10.00 <?php echo pvs_get_currency_code(1)?>" class="form-control" style="width:150px">
    <!-- Display the payment button. -->
    <br>
    <input type="submit" name="submit" class="btn btn-primary clearfix"  value="Donate">

</form>


</div>
