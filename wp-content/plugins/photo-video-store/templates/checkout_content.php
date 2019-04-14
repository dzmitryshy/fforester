<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit();
}

if ( isset($_POST["step"]) ) {
	$_SESSION["checkout_steps"] = 2;
	if ( ! is_user_logged_in() ) {	
		if ( $pvs_global_settings["no_cart"] ) {
			//Guest login
			include('check_guest_content.php');
		} else {
			exit();
		}
	}
}
?>


<script>

function show_shipping(value) {
	if(value==0) {
		jQuery("#shipping_form").slideDown("slow");
	}
	else {
		jQuery("#shipping_form").slideUp("slow");
	}
}



function check_country(value) {
   	jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/states/',
		data:'country=' + document.getElementById(value+"_country").value + '&state=' +  document.getElementById(value+"_state").value + '&type=' +value,
		success:function(data){
			document.getElementById('states_'+value).innerHTML =data;
			
			jQuery( "#" + value+ "_state" ).on('change',function() {
				jQuery.ajax({
					type:'POST',
					url:'<?php echo site_url()?>/checkout-address/',
					data:'key=' + value + '_state&value=' +  jQuery( "#" + value+ "_state" ).val()
				}); 
			});

		}
	}); 
}

function change_total(value,value2) {
    jQuery.ajax({
		type:'POST',
		dataType: 'json',
		url:'<?php echo(site_url());?>/checkout-shipping/',
		data:'shipping=' + value + '&type=' + value2,
		success:function(data){
			document.getElementById("total_block").innerHTML =data.total;	
			document.getElementById("shipping_block").innerHTML =data.shipping;	
			document.getElementById("taxes_block").innerHTML =data.taxes;	
		}
	});
}


function check_email(value) 
{
    jQuery.ajax({
		type:'POST',
		url:'<?php echo (site_url( ) );?>/check-email/',
		data:'email=' + value,
		success:function(data){
			document.getElementById('error_email').innerHTML =data;
			if(data=="<span class='error'><?php echo pvs_word_lang( "Error: Email is already in use." );?></span>" || data=="<span class='error'><?php echo pvs_word_lang( "incorrect field" );?></span>")
			{
				document.getElementById('email_ok').value=-1
				jQuery("#guest_email").addClass("ibox_error").removeClass("ibox_ok");
			}
			else
			{
				document.getElementById('email_ok').value=1
				jQuery("#guest_email").addClass("ibox_ok").removeClass("ibox_error");
			}
		}
	});
}

function check_shipping() {
	flag_shipping=true;
	
	address_mass=new Array("firstname","lastname","country","city","zip","address","state");
	
	
	for(i=0;i<address_mass.length;i++) {
		<?php
		if ( $pvs_global_settings["checkout_order_billing"] ) {
		?>
		if(jQuery("#billing_"+address_mass[i]).val()=="") {
			jQuery("#billing_"+address_mass[i]).addClass("ibox_error");
			flag_shipping=false;
		}
		else
		{
			jQuery("#billing_"+address_mass[i]).removeClass("ibox_error");
		}
		<?php
		}
		?>
		
		if(jQuery("#thesame2").attr('checked')) {
			if(jQuery("#shipping_"+address_mass[i]).val()=="")
			{
				jQuery("#shipping_"+address_mass[i]).addClass("ibox_error");
				flag_shipping=false;
			}
			else
			{
				jQuery("#shipping_"+address_mass[i]).removeClass("ibox_error");
			}
		}
	}
	
	if( document.getElementById("billing_company") && document.getElementById("billing_vat") ) {
		if( document.getElementById("billing_company").value == '' && document.getElementById("billing_vat").value != '' ) {
			jQuery("#billing_company").removeClass("ibox_ok").addClass("ibox_error");
			document.getElementById('error_company').innerHTML ="<span class='error'><?php echo pvs_word_lang( "Company name required for VAT exemption" );?></span>";
			flag_shipping=false;
		}
		else
		{
			jQuery("#billing_company").removeClass("ibox_error");
			document.getElementById('error_company').innerHTML ="";
		}
	}
	
	if( document.getElementById("guest_email") ) {
		if( document.getElementById("guest_email").value == '' ) {
			jQuery("#guest_email").removeClass("ibox_ok").addClass("ibox_error");
			flag_shipping=false;
		}
		else
		{
			if(document.getElementById('email_ok').value==-1) {
				flag_shipping=false;
			}
			else
			{
				jQuery("#guest_email").removeClass("ibox_error");
			}
		}
	}
	
	if(flag_shipping==false) {
		//jQuery(window).scrollTo(300,1000, {axis:'y'} );
		jQuery('#order_now').attr('disabled',true);
	}
	else {
		jQuery('#order_now').attr('disabled',false);
	}
	
	return flag_shipping;
}


jQuery(document).ready(function() {
	jQuery( ".checkout_field" ).on('change keyup click',function() {
		if ( document.getElementById("thesame1") ) {
			thesame = jQuery('input[name=thesame]:checked').val();
		} else {
			thesame = 0
		}
	
		jQuery.ajax({
			type:'POST',
			url:'<?php echo site_url()?>/checkout-address/',
			data:'key=' + jQuery(this).attr('id') + '&value=' +  jQuery(this).val() + '&thesame=' + thesame
		}); 
	});
});
</script>






<?php
$checkout_header = '<div class="row"><div class="col-lg-9 col-md-9 panel_left3">';
$checkout_middle = '</div><div class="col-lg-3 col-md-3 panel_right3">';
$checkout_footer = '</div></div>';

$product_subtotal = 0;
$product_shipping = 0;
$product_tax = 0;
$product_discount = 0;
$product_total = 0;
$weight = 0;
$quantity = 0;
$flag_shipping = false;

$cart_id = pvs_shopping_cart_id();

if ( ! isset( $_SESSION["checkout_steps"] ) ) {
	if ( ! $pvs_global_settings["checkout_order_billing"] and ! $pvs_global_settings["checkout_order_shipping"] ) {
		if ( $pvs_global_settings["no_cart"] and ! is_user_logged_in()  ) {
			$_SESSION["checkout_steps"] = 1;
		} else {
			$_SESSION["checkout_steps"] = 2;
		}
	} else {
		$_SESSION["checkout_steps"] = 1;
	}
}

if ( ! isset( $_SESSION["shipping_thesame"] ) ) {
	$_SESSION["shipping_thesame"] = 1;
}

if ( @$_GET["checkout_method"] != "" ) {
	$_SESSION["checkout_method"] = @$_GET["checkout_method"];
}


//Billing and Shipping address
if ( is_user_logged_in() ) {
	$user_info = get_userdata(get_current_user_id());
	
	$_SESSION["billing_business"] = $user_info->business;
	$_SESSION["billing_company"] = $user_info->company;
	
	if ( ! isset( $_SESSION["billing_firstname"] ) ) {
		$_SESSION["billing_firstname"] = $user_info->first_name;
	}
	
	if ( ! isset( $_SESSION["billing_lastname"] ) ) {
		$_SESSION["billing_lastname"] = $user_info->last_name;
	}
	
	if ( ! isset( $_SESSION["billing_address"] ) ) {
		$_SESSION["billing_address"] = $user_info->address;
	}
	
	if ( ! isset( $_SESSION["billing_city"] ) ) {
		$_SESSION["billing_city"] = $user_info->city;
	}
	
	if ( ! isset( $_SESSION["billing_zip"] ) ) {
		$_SESSION["billing_zip"] = $user_info->zipcode;
	}
	
	if ( ! isset( $_SESSION["billing_country"] ) ) {
		$_SESSION["billing_country"] = $user_info->country;
	}
	
	if ( ! isset( $_SESSION["billing_state"] ) ) {
		$_SESSION["billing_state"] = $user_info->state;
	}
	
	if ( ! isset( $_SESSION["shipping_firstname"] ) ) {
		$_SESSION["shipping_firstname"] = $user_info->first_name;
	}
	
	if ( ! isset( $_SESSION["shipping_lastname"] ) ) {
		$_SESSION["shipping_lastname"] = $user_info->last_name;
	}
	
	if ( ! isset( $_SESSION["shipping_address"] ) ) {
		$_SESSION["shipping_address"] = $user_info->address;
	}
	
	if ( ! isset( $_SESSION["shipping_city"] ) ) {
		$_SESSION["shipping_city"] = $user_info->city;
	}
	
	if ( ! isset( $_SESSION["shipping_zip"] ) ) {
		$_SESSION["shipping_zip"] = $user_info->zipcode;
	}
	
	if ( ! isset( $_SESSION["shipping_country"] ) ) {
		$_SESSION["shipping_country"] = $user_info->country;
	}
	
	if ( ! isset( $_SESSION["billing_company"] ) ) {
		$_SESSION["billing_company"] = $user_info->company;
	}
	
	if ( ! isset( $_SESSION["billing_vat"] ) ) {
		$_SESSION["billing_vat"] = $user_info->vat;
	}
	
	if ( ! isset( $_SESSION["billing_telephone"] ) ) {
		$_SESSION["billing_telephone"] = $user_info->telephone;
	}
}



$items_list = "";
$sql = "select id,item_id,prints_id,publication_id,quantity,option1_id,option1_value,option2_id,option2_value,option3_id,option3_value,option4_id,option4_value,option5_id,option5_value,option6_id,option6_value,option7_id,option7_value,option8_id,option8_value,option9_id,option9_value,option10_id,option10_value,rights_managed,printslab,stock,stock_type,stock_id,stock_url,stock_preview,stock_site_url,print_width,print_height,collection,package from " .
	PVS_DB_PREFIX . "carts_content where id_parent=" . $cart_id;
$dq->open( $sql );
while ( ! $dq->eof ) {
	if ( $items_list != "" ) {
		$items_list .= "<div class='checkout_line'></div>";
	}
	
	if ( (int) $dq->row["package"] == 0 ) {
		if ( (int) $dq->row["collection"] == 0 ) {
			//Download items
			if ( $dq->row["item_id"] > 0 ) {
				$sql = "select id,name,price,id_parent,url,shipped from " . PVS_DB_PREFIX .
					"items where id=" . $dq->row["item_id"];
				$dr->open( $sql );
				if ( ! $dr->eof )
				{
					$price = $dr->row["price"];
		
					if ( $dq->row["rights_managed"] != "" )
					{
						$rights_mass = explode( "|", $dq->row["rights_managed"] );
						$price = $rights_mass[0];
					}
		
					$items_list .= "<div class='checkout_list'><a href='" . pvs_item_url( $dr->row["id_parent"] ) .
						"'><b>#" . $dr->row["id_parent"] . " &mdash; " . pvs_word_lang( "file" ) . ": " .
						pvs_word_lang( $dr->row["name"] ) . "</b></a><div style='margin-top:3px'>
				" . $dq->row["quantity"] . " x " . pvs_currency( 1, true, @$_SESSION["checkout_method"] ) .
						pvs_price_format( $price, 2 ) . " " . pvs_currency( 2, true, @$_SESSION["checkout_method"] ) .
						"</div></div>";
		
					if ( $dr->row["shipped"] == 1 )
					{
						$weight += $pvs_global_settings["cd_weight"];
						$flag_shipping = true;
						$quantity++;
					}
		
					$taxes_info = array();
					if ( $dr->row["shipped"] != 1 )
					{
						pvs_order_taxes_calculate( $price, false, "order" );
					} else
					{
						pvs_order_taxes_calculate( $price, false, "prints" );
					}
		
					if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
					{
						$product_tax += $taxes_info["total"];
						$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
							": " . pvs_currency( 1, false ) . $taxes_info["total"] . " " . pvs_currency( 2, false ) .
							"</b></small></div>";
					}
					unset( $taxes_info );
		
					$product_subtotal += $price * $dq->row["quantity"];
				}
			}
		
			//Prints items
			if ( $dq->row["prints_id"] > 0 ) {
				if ( ( int )$dq->row["stock"] == 0 )
				{
					if ( $dq->row["printslab"] != 1 )
					{
						$sql = "select id_parent,title,price,itemid,printsid from " . PVS_DB_PREFIX .
							"prints_items where id_parent=" . $dq->row["prints_id"];
						$dr->open( $sql );
						if ( ! $dr->eof )
						{
							$price = pvs_define_prints_price( $dr->row["price"], $dq->row["option1_id"], $dq->
								row["option1_value"], $dq->row["option2_id"], $dq->row["option2_value"], $dq->
								row["option3_id"], $dq->row["option3_value"], $dq->row["option4_id"], $dq->row["option4_value"],
								$dq->row["option5_id"], $dq->row["option5_value"], $dq->row["option6_id"], $dq->
								row["option6_value"], $dq->row["option7_id"], $dq->row["option7_value"], $dq->
								row["option8_id"], $dq->row["option8_value"], $dq->row["option9_id"], $dq->row["option9_value"],
								$dq->row["option10_id"], $dq->row["option10_value"] );
		
							$sql = "select id,title,server1 from " . PVS_DB_PREFIX .
								"media where id=" . ( int )$dr->row["itemid"];
							$rs->open( $sql );
							if ( ! $rs->eof )
							{
								if ( $pvs_global_settings["prints_previews"] )
								{
									$print_info = pvs_get_print_preview_info( $dr->row["printsid"] );
									if ( $print_info["flag"] )
									{
										$url = pvs_print_url( $dr->row["itemid"], $dr->row["printsid"], $rs->row["title"],
											$print_info["preview"], '' );
									} else
									{
										$url = pvs_item_url( $dr->row["itemid"] );
									}
								} else
								{
									$url = pvs_item_url( $dr->row["itemid"] );
								}
							}
		
							$items_list .= "<div class='checkout_list'><div><a href='" . $url . "'><b>" .
								pvs_word_lang( "photo" ) . " #" . $dr->row["itemid"] . ":  " . pvs_word_lang( $dr->
								row["title"] ) . "</b></a></div>
			<span class='gr'>";
		
							for ( $i = 1; $i < 11; $i++ )
							{
								if ( $dq->row["option" . $i . "_id"] != 0 and $dq->row["option" . $i . "_value"] !=
									"" )
								{
									$sql = "select title,property_name from " . PVS_DB_PREFIX .
										"products_options where id=" . $dq->row["option" . $i . "_id"];
									$ds->open( $sql );
									if ( ! $ds->eof )
									{
										if ( $ds->row["property_name"] == 'print_size' )
										{
											$print_width = $dq->row["print_width"];
											$print_height = $dq->row["print_height"];
		
											if ( $print_width > $print_height )
											{
												$print_size = $print_width;
											} else
											{
												$print_size = $print_height;
											}
		
											$property_value = $dq->row["option" . $i . "_value"];
		
											$value_array = explode( "cm", $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 )
											{
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) .
													"cm x " . round( $property_value * $print_height / $print_size ) . "cm";
											}
		
											$value_array = explode( 'in', $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 )
											{
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) . '" x ' .
													round( $property_value * $print_height / $print_size ) . '"';
											}
		
											$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . $property_value .
												". <br>";
										} else
										{
											$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . pvs_word_lang( $dq->
												row["option" . $i . "_value"] ) . ". <br>";
										}
									}
								}
							}
		
							$items_list .= "</span>
			<div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
								@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
								pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
		
							$sql = "select weight from " . PVS_DB_PREFIX . "prints where id_parent=" . $dr->
								row["printsid"];
							$ds->open( $sql );
							if ( ! $ds->eof )
							{
								$weight += $ds->row["weight"];
								$flag_shipping = true;
							}
							$product_subtotal += $price * $dq->row["quantity"];
							$quantity += $dq->row["quantity"];
		
							$taxes_info = array();
							pvs_order_taxes_calculate( $price, false, "prints" );
		
							if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
							{
								$product_tax += $taxes_info["total"] * $dq->row["quantity"];
								$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
									": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
									row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
							}
							unset( $taxes_info );
						}
					} else
					{
						$sql = "select id_parent,title,price from " . PVS_DB_PREFIX .
							"prints where id_parent=" . $dq->row["prints_id"];
						$dr->open( $sql );
						if ( ! $dr->eof )
						{
							$price = pvs_define_prints_price( $dr->row["price"], $dq->row["option1_id"], $dq->
								row["option1_value"], $dq->row["option2_id"], $dq->row["option2_value"], $dq->
								row["option3_id"], $dq->row["option3_value"], $dq->row["option4_id"], $dq->row["option4_value"],
								$dq->row["option5_id"], $dq->row["option5_value"], $dq->row["option6_id"], $dq->
								row["option6_value"], $dq->row["option7_id"], $dq->row["option7_value"], $dq->
								row["option8_id"], $dq->row["option8_value"], $dq->row["option9_id"], $dq->row["option9_value"],
								$dq->row["option10_id"], $dq->row["option10_value"] );
		
							$gallery_id = 0;
							$sql = "select id_parent from " . PVS_DB_PREFIX . "galleries_photos where id=" .
								$dq->row["publication_id"];
							$dn->open( $sql );
							if ( ! $dn->eof )
							{
								$gallery_id = $dn->row["id_parent"];
							}
		
							$items_list .= "<div class='checkout_list'><div><a href='<?php echo (site_url( ) );?>/printslab_content/?id=" .
								$gallery_id . "'><b>" . pvs_word_lang( "prints lab" ) . " #" . $dq->row["publication_id"] .
								":  " . pvs_word_lang( $dr->row["title"] ) . "</b></a></div>
			<span class='gr'>";
		
							for ( $i = 1; $i < 11; $i++ )
							{
								if ( $dq->row["option" . $i . "_id"] != 0 and $dq->row["option" . $i . "_value"] !=
									"" )
								{
									$sql = "select title,property_name from " . PVS_DB_PREFIX .
										"products_options where id=" . $dq->row["option" . $i . "_id"];
									$ds->open( $sql );
									if ( ! $ds->eof )
									{
										if ( $ds->row["property_name"] == 'print_size' )
										{
											$print_width = $dq->row["print_width"];
											$print_height = $dq->row["print_height"];
		
											if ( $print_width > $print_height )
											{
												$print_size = $print_width;
											} else
											{
												$print_size = $print_height;
											}
		
											$property_value = $dq->row["option" . $i . "_value"];
		
											$value_array = explode( "cm", $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 )
											{
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) .
													"cm x " . round( $property_value * $print_height / $print_size ) . "cm";
											}
		
											$value_array = explode( '"', $property_value );
											if ( count( $value_array ) == 2 and $print_size != 0 )
											{
												$property_value = $value_array[0];
												$property_value = round( $property_value * $print_width / $print_size ) . '" x ' .
													round( $property_value * $print_height / $print_size ) . '"';
											}
		
											$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . $property_value .
												". <br>";
										} else
										{
											$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . pvs_word_lang( $dq->
												row["option" . $i . "_value"] ) . ". <br>";
										}
									}
								}
							}
		
							$items_list .= "</span>
			<div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
								@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
								pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
		
							$sql = "select weight from " . PVS_DB_PREFIX . "prints where id_parent=" . $dq->
								row["prints_id"];
							$ds->open( $sql );
							if ( ! $ds->eof )
							{
								$weight += $ds->row["weight"];
								$flag_shipping = true;
							}
							$product_subtotal += $price * $dq->row["quantity"];
							$quantity += $dq->row["quantity"];
		
							$taxes_info = array();
							pvs_order_taxes_calculate( $price, false, "prints" );
		
							if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
							{
								$product_tax += $taxes_info["total"] * $dq->row["quantity"];
								$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
									": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
									row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
							}
							unset( $taxes_info );
						}
					}
				} else
				{
					//Stock
					$sql = "select id_parent,title,price from " . PVS_DB_PREFIX .
						"prints where id_parent=" . $dq->row["prints_id"];
					$dr->open( $sql );
					if ( ! $dr->eof )
					{
						$price = pvs_define_prints_price( $dr->row["price"], $dq->row["option1_id"], $dq->
							row["option1_value"], $dq->row["option2_id"], $dq->row["option2_value"], $dq->
							row["option3_id"], $dq->row["option3_value"], $dq->row["option4_id"], $dq->row["option4_value"],
							$dq->row["option5_id"], $dq->row["option5_value"], $dq->row["option6_id"], $dq->
							row["option6_value"], $dq->row["option7_id"], $dq->row["option7_value"], $dq->
							row["option8_id"], $dq->row["option8_value"], $dq->row["option9_id"], $dq->row["option9_value"],
							$dq->row["option10_id"], $dq->row["option10_value"] );
		
						$title = @$mstocks[str_replace( "123rf", "rf123", $dq->row["stock_type"] )] .
							" #" . $dq->row["stock_id"];
						$preview = $dq->row["stock_preview"];
						$url = $dq->row["stock_site_url"];
		
						$items_list .= "<div class='checkout_list'><div><a href='" . $url . "'><b>" . $title .
							": " . pvs_word_lang( $dr->row["title"] ) . "</b></a></div>
		<span class='gr'>";
		
						for ( $i = 1; $i < 11; $i++ )
						{
							if ( $dq->row["option" . $i . "_id"] != 0 and $dq->row["option" . $i . "_value"] !=
								"" )
							{
								$sql = "select title,property_name from " . PVS_DB_PREFIX .
									"products_options where id=" . $dq->row["option" . $i . "_id"];
								$ds->open( $sql );
								if ( ! $ds->eof )
								{
									if ( $ds->row["property_name"] == 'print_size' )
									{
										$print_width = $dq->row["print_width"];
										$print_height = $dq->row["print_height"];
		
										if ( $print_width > $print_height )
										{
											$print_size = $print_width;
										} else
										{
											$print_size = $print_height;
										}
		
										$property_value = $dq->row["option" . $i . "_value"];
		
										$value_array = explode( "cm", $property_value );
										if ( count( $value_array ) == 2 and $print_size != 0 )
										{
											$property_value = $value_array[0];
											$property_value = round( $property_value * $print_width / $print_size ) .
												"cm x " . round( $property_value * $print_height / $print_size ) . "cm";
										}
		
										$value_array = explode( '"', $property_value );
										if ( count( $value_array ) == 2 and $print_size != 0 )
										{
											$property_value = $value_array[0];
											$property_value = round( $property_value * $print_width / $print_size ) . '" x ' .
												round( $property_value * $print_height / $print_size ) . '"';
										}
		
										$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . $property_value .
											". <br>";
									} else
									{
										$items_list .= pvs_word_lang( $ds->row["title"] ) . ": " . pvs_word_lang( $dq->
											row["option" . $i . "_value"] ) . ". <br>";
									}
								}
							}
						}
		
						$items_list .= "</span>
		<div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
							@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
							pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
		
						$sql = "select weight from " . PVS_DB_PREFIX . "prints where id_parent=" . $dq->
							row["prints_id"];
						$ds->open( $sql );
						if ( ! $ds->eof )
						{
							$weight += $ds->row["weight"];
							$flag_shipping = true;
						}
						$product_subtotal += $price * $dq->row["quantity"];
						$quantity += $dq->row["quantity"];
		
						$taxes_info = array();
						pvs_order_taxes_calculate( $price, false, "prints" );
		
						if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
						{
							$product_tax += $taxes_info["total"] * $dq->row["quantity"];
							$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
								": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
								row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
						}
						unset( $taxes_info );
					}
				}
			}
		} else {
			//Collection
			$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "collections where active = 1 and id = " . $dq->row["collection"];
			$ds->open( $sql );
			if ( ! $ds->eof ) {
				$price = $ds->row["price"];
			
				$title = pvs_word_lang("Collection") . ': ' . $ds->row["title"] . ' (' . pvs_count_files_in_collection($ds->row["id"]) . ')';
				$url = pvs_collection_url( $ds->row["id"], $ds->row["title"] );
				
				$items_list .= "<div class='checkout_list'><div><a href='" . $url . "'><b>" . $title . "</b></a></div><div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
					@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
					pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
			
				$product_subtotal += $price * $dq->row["quantity"];
				$quantity += $dq->row["quantity"];
			
				$taxes_info = array();
				pvs_order_taxes_calculate( $price, false, "prints" );
			
				if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
				{
					$product_tax += $taxes_info["total"] * $dq->row["quantity"];
					$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
						": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
						row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
				}
				unset( $taxes_info );
			}
		}
	} else {
		//Package
		$sql = "select id, title, price, description from " . PVS_DB_PREFIX . "packages where active = 1 and id = " . $dq->row["package"];
		$ds->open( $sql );
		if ( ! $ds->eof ) {
			$price = $ds->row["price"];
		
			$title = pvs_word_lang("Package") . ': ' . $ds->row["title"];
			$url = pvs_package_url($ds->row["id"], $dq->row["id"]);
			
			$items_list .= "<div class='checkout_list'><div><a href='" . $url . "'><b>" . $title . " " . pvs_count_files_in_package($ds->row["id"], $dq->row["id"]) . "</b></a></div><div style='margin-top:3px'>" . $dq->row["quantity"] . " x " . pvs_currency( 1, true,
				@$_SESSION["checkout_method"] ) . pvs_price_format( $price, 2 ) . " " .
				pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></div>";
		
			$product_subtotal += $price * $dq->row["quantity"];
			$quantity += $dq->row["quantity"];
		
			$taxes_info = array();
			
			$sql = "select id from " . PVS_DB_PREFIX . "packages_files where print_id > 0 and quantity > 0 and package_id = " . $dq->row["package"];
			$dr->open($sql);
			if ( ! $dr->eof ) {
				$flag_shipping = true;
				pvs_order_taxes_calculate( $price, false, "prints" );
			} else {
				pvs_order_taxes_calculate( $price, false, "order" );
			}
		
			if ( $taxes_info["total"] != 0 and @$_SESSION["checkout_method"] != "credits" )
			{
				$product_tax += $taxes_info["total"] * $dq->row["quantity"];
				$items_list .= "<div class='checkout_list'><small><b>" . $taxes_info["text"] .
					": " . pvs_currency( 1, false ) . pvs_price_format( $taxes_info["total"] * $dq->
					row["quantity"], 2 ) . " " . pvs_currency( 2, false ) . "</b></small></div>";
			}
			unset( $taxes_info );
			

		}	
	}
	$dq->movenext();
}

//Discount
$discount_text = "";
if ( isset( $_SESSION["coupon_code"] ) and ( ! $pvs_global_settings["credits"] or
	( $pvs_global_settings["credits"] and $pvs_global_settings["credits_currency"] ) ) ) {
	$discount_info = array();
	pvs_order_discount_calculate( $_SESSION["coupon_code"], $product_subtotal );
	$product_discount = $discount_info["total"];
	$discount_text = $discount_info["text"];
	
	$discount_info = array();
	pvs_order_discount_calculate( $_SESSION["coupon_code"], $product_tax, true );
	$product_tax -= $discount_info["total"];
}


//Shipping
$product_shipping = 0;
$product_shipping_type = 0;

$shipping_list = "";

if ( $flag_shipping ) {
	$sql = "select id,title,shipping_time,methods,methods_calculation,taxes,regions from " .
		PVS_DB_PREFIX . "shipping where activ=1 and weight_min<=" . $weight .
		" and weight_max>=" . $weight . "  order by title";
	$dr->open( $sql );
	while ( ! $dr->eof ) {
		$shipping = 0;

		//Check regions
		$flag_regions = false;
		if ( $dr->row["regions"] == 0 )
		{
			$flag_regions = true;
		} else
		{
			$sql = "select country,state from " . PVS_DB_PREFIX .
				"shipping_regions where id_parent=" . $dr->row["id"] . " and country='" .
				pvs_result( @$_SESSION["shipping_country"] ) . "'";
			$ds->open( $sql );
			while ( ! $ds->eof )
			{
				if ( $ds->row["state"] == "" )
				{
					$flag_regions = true;
				} else
				{
					if ( $ds->row["state"] == @$_SESSION["shipping_state"] )
					{
						$flag_regions = true;
					}
				}
				$ds->movenext();
			}
		}

		//Calculate
		if ( $flag_regions )
		{
			if ( $dr->row["methods"] == "weight" )
			{
				$sql = "select price from " . PVS_DB_PREFIX .
					"shipping_ranges where from_param<=" . $weight . " and to_param>=" . $weight .
					" and id_parent=" . $dr->row["id"] . " order by from_param";
			}
			if ( $dr->row["methods"] == "quantity" )
			{
				$sql = "select price from " . PVS_DB_PREFIX .
					"shipping_ranges where from_param<=" . $quantity . " and to_param>=" . $quantity .
					" and id_parent=" . $dr->row["id"] . " order by from_param";
			}
			if ( $dr->row["methods"] == "subtotal" )
			{
				$sql = "select price from " . PVS_DB_PREFIX .
					"shipping_ranges where from_param<=" . $product_subtotal . " and to_param>=" . $product_subtotal .
					" and id_parent=" . $dr->row["id"] . " order by from_param";
			}
			if ( $dr->row["methods"] == "flatrate" )
			{
				$sql = "select price from " . PVS_DB_PREFIX . "shipping_ranges where id_parent=" .
					$dr->row["id"];
			}

			$ds->open( $sql );
			if ( ! $ds->eof )
			{
				if ( $dr->row["methods_calculation"] == "percent" )
				{
					$shipping = $ds->row["price"] * $product_subtotal / 100;
				}
				if ( $dr->row["methods_calculation"] == "currency" )
				{
					$shipping = $ds->row["price"];
				}
			}

			if ( $dr->row["taxes"] == 1 )
			{
				$word_taxes = " - " . pvs_word_lang( "taxable" );
			} else
			{
				$word_taxes = "";
			}

			$shipping_list .= "<div style='margin-bottom:3px'><input onClick=\"change_total(this.value," .
				$dr->row["id"] . ")\" checked name='shipping_type'  type='radio' value='" . $shipping .
				"'>&nbsp;" . pvs_currency( 1, true, @$_SESSION["checkout_method"] ) .
				pvs_price_format( $shipping, 2 ) . " " . pvs_currency( 2, true, @$_SESSION["checkout_method"] ) .
				" &mdash; " . $dr->row["title"] . " (" . $dr->row["shipping_time"] . ")" . $word_taxes .
				"</div>";
			$product_shipping = $shipping;
			$product_shipping_type = $dr->row["id"];
		}
		$dr->movenext();
	}
}

$flag_shipping_taxable = false;

$sql = "select taxes from " . PVS_DB_PREFIX . "shipping where id=" . $product_shipping_type;
$dr->open( $sql );
if ( ! $dr->eof ) {
	if ( $dr->row["taxes"] == 1 ) {
		$flag_shipping_taxable = true;
	}
}
//End. Shipping

//Taxes rates
$taxes_info = array();
if ( ! $pvs_global_settings["credits"] or ( $pvs_global_settings["credits_currency"] and
	@$_SESSION["checkout_method"] != "credits" ) ) {
	if ( $flag_shipping_taxable ) {
		pvs_order_taxes_calculate( $product_shipping, false, "order" );
		$product_tax += $taxes_info["total"];
	} else {
		pvs_order_taxes_calculate( $product_subtotal, false, "order" );
	}
	$taxes_text = "";
	$taxes_info["total"] = $product_tax;
	$taxes_info["text"] = "";
} else {
	$taxes_info["total"] = 0;
	$taxes_info["included"] = 0;
	$taxes_info["text"] = "";
}

//Count product total
$product_total = $product_subtotal + $product_shipping + $product_tax * $taxes_info["included"] -
	$product_discount;

if ( $product_total < 0 ) {
	$product_total = 0;
}

$_SESSION["product_total"] = $product_total;
$_SESSION["product_subtotal"] = $product_subtotal;
$_SESSION["product_shipping"] = $product_shipping;
$_SESSION["product_shipping_type"] = $product_shipping_type;
$_SESSION["product_tax"] = $product_tax;
$_SESSION["product_discount"] = $product_discount;
$_SESSION["weight"] = $weight;

$total_list = "";

$total_list .= "<tr><td style='padding-bottom:6px'><b>" . pvs_word_lang( "subtotal" ) .
	":</b></td><td>" . pvs_currency( 1, true, @$_SESSION["checkout_method"] ) .
	pvs_price_format( $product_subtotal, 2 ) . " " . pvs_currency( 2, true, @$_SESSION["checkout_method"] ) .
	"</td></tr></tr>";

if ( ! $pvs_global_settings["credits"] or ( $pvs_global_settings["credits_currency"] and
	@$_SESSION["checkout_method"] != "credits" ) ) {
	$total_list .= "<tr><td style='padding-bottom:6px'><b>" . pvs_word_lang( "discount" ) .
		$discount_text . ":</b></td><td>" . pvs_currency( 1, true, @$_SESSION["checkout_method"] ) .
		pvs_price_format( $product_discount, 2 ) . " " . pvs_currency( 2, true, @$_SESSION["checkout_method"] ) .
		"</td></tr>";
}

$total_list .= "<tr><td style='padding-bottom:6px'><b>" . pvs_word_lang( "shipping" ) .
	":</b></td><td><div id='shipping_block'>" . pvs_currency( 1, true, @$_SESSION["checkout_method"] ) .
	pvs_price_format( $product_shipping, 2 ) . " " . pvs_currency( 2, true, @$_SESSION["checkout_method"] ) .
	"</div></td></tr>";

if ( ! $pvs_global_settings["credits"] or ( $pvs_global_settings["credits_currency"] and
	@$_SESSION["checkout_method"] != "credits" ) ) {
	$total_list .= "<tr><td style='padding-bottom:6px'><b>" . pvs_word_lang( "taxes" ) .
		" " . $taxes_text . ":</b></td><td><div id='taxes_block'>" . pvs_currency( 1, true,
		@$_SESSION["checkout_method"] ) . pvs_price_format( $product_tax, 2 ) . " " .
		pvs_currency( 2, true, @$_SESSION["checkout_method"] ) . "</div></td></tr>";
}

$flag_continue = true;


//if Credits banance isn't sufficient
if ( $pvs_global_settings["credits"]  and ! $pvs_global_settings["no_cart"] ) {
	$balance = pvs_credits_balance();

	if ( $pvs_global_settings["credits_currency"] and @$_SESSION["checkout_method"] == "" ) {
?>
	<form method="get" action="<?php echo (site_url( ) );?>/checkout/">
	<?php wp_nonce_field( 'pvs-checkout' ); ?>
	<table border="0" cellpadding="0" cellspacing="0" class="profile_table" width="100%">
	<tr>
		<th></th>
		<th width="95%"><b><?php
		echo pvs_word_lang( "select payment method" )?></b></th>
	</tr>
	<tr>
		<td align="center"><input name="checkout_method" type="radio" value="credits" checked></td>
		<td><b><?php
		echo pvs_word_lang( "credits" )?></b> (<?php
		echo pvs_word_lang( "balance" )?>: <span class="price"><?php
		echo pvs_price_format( $balance, 2 )?> <?php
		echo pvs_word_lang( "credits" )?></span>)</td>
	</tr>
	<tr>
		<td align="center"><input name="checkout_method" type="radio" value="currency"></td>
		<td><b><?php
		echo pvs_get_currency_code(1)
?></b></td>
	</tr>
	</table>
	<input class='isubmit' type="submit" value="<?php
		echo pvs_word_lang( "continue" )?>" style="margin-top:10px">

	</form>
	
	<?php
		$flag_continue = false;
	} else {
		if ( $balance < $product_total and ( @$_SESSION["checkout_method"] == "" or @$_SESSION["checkout_method"] ==
			"credits" ) )
		{
?>
		<p><b><?php
			echo pvs_word_lang( "balance" )?>:</b> <span class="price"><?php
			echo pvs_price_format( $balance - $product_total, 2 )?> <?php
			echo pvs_word_lang( "credits" )?></span></p>
		<input type="button" class="isubmit" value="<?php
			echo pvs_word_lang( "buy credits" )?>" onClick="location.href='<?php echo (site_url( ) );?>/credits/?d=1'"> 
		
		<?php
			if ( $pvs_global_settings["credits_currency"] )
			{
?>
&nbsp;&nbsp;<?php
				echo pvs_word_lang( "or" )?>&nbsp;&nbsp; <input type="button" class="isubmit_orange" value="<?php
				echo pvs_word_lang( "select payment method" )?>" onClick="location.href='<?php echo (site_url( ) );?>/checkout-method/'"> 
		<?php
			}
?>
		
		<?php
			$flag_continue = false;
		}
	}
}
//End. if Credits banance isn't sufficient

//Place order
if ( $flag_continue ) {

	echo ( $checkout_header );?>


<?php
	if ( $pvs_global_settings["no_cart"] and ! is_user_logged_in() ) {
		?>
		<div class="checkoutbox"><?php echo pvs_word_lang( "Create an account" )?></div>
			<div class="checkoutbox_text">
				<div class="form_field">
				<span><b><?php echo pvs_word_lang( "e-mail" )?></b></span>
				<input class="ibox form-control checkout_field" type="text" id="guest_email" value="<?php echo @$_SESSION["guest_email"] ?>" style="width:200px" onChange="check_email(this.value);">
				<div id="error_email"></div>
				<input type="hidden" id="email_ok" value="-1">
				</div>
				<a href="<?php echo( site_url() );?>/login/"><u><?php echo pvs_word_lang( "Already a member?" )?></u></a>
			</div>
		<?php
		}
	if ( $pvs_global_settings["checkout_order_billing"] or ( $pvs_global_settings["checkout_order_shipping"] and
		$flag_shipping ) ) {

$show_billing_for_guests = true;
		
	if ( ( $pvs_global_settings["checkout_order_billing"] or ( $pvs_global_settings["checkout_order_shipping"] and $flag_shipping ) ) and ( ! $pvs_global_settings["no_cart"] or is_user_logged_in() or $flag_shipping or $show_billing_for_guests  ) ) {		
?>
<div class="checkoutbox"><?php
		echo pvs_word_lang( "billing and shipping address" )?></div>
<div class="checkoutbox_text">


<form method="post" action="<?php echo (site_url( ) );?>/checkout/" <?php
		if ( $flag_shipping or ! is_user_logged_in() )
		{
?>onsubmit="return check_shipping();"<?php
		}
?>>
<input type="hidden" name="step" value="2">
<input type="hidden" name="guest_email" id="guest_email2" value="<?php echo(@$_SESSION["guest_email"] );?>">
<?php wp_nonce_field( 'pvs-checkout-address' ); ?>
<div class="row">
<?php
		if ( $pvs_global_settings["checkout_order_billing"] )
		{
?>
<div class="col-lg-6 col-md-6 panel_left2">
	<div id="billing_form" name="billing_form" style="display:block;">
	
		<div class='login_header'><h2><?php
			echo pvs_word_lang( "billing address" )?>:</h2></div>

		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "first name" )?></b></span>
		<input class="ibox form-control checkout_field" type="text" name="billing_firstname"  id="billing_firstname" value="<?php
			echo @$_SESSION["billing_firstname"] ?>" style="width:300px">
		</div>

		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "last name" )?></b></span>
		<input class="ibox form-control checkout_field" type="text" id="billing_lastname" name="billing_lastname" value="<?php
			echo @$_SESSION["billing_lastname"] ?>" style="width:300px">
		</div>

		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "address" )?></b></span>
		<textarea class="ibox form-control checkout_field" name="billing_address" id="billing_address" style="width:300px;height:100px"><?php
			echo @$_SESSION["billing_address"] ?></textarea>
		</div>
		
		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "city" )?></b></span>
		<input class="ibox form-control checkout_field" type="text" name="billing_city" id="billing_city" value="<?php
			echo @$_SESSION["billing_city"] ?>" style="width:300px">
		</div>
		
		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "state" )?></b></span>
		<div id="states_billing">
<input type="text" name="billing_state" id="billing_state" style="width:310px" value="<?php
			echo @$_SESSION["billing_state"] ?>" class="ibox form-control checkout_field">
		</div>
		</div>
		
		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "zipcode" )?></b></span>
		<input class="ibox form-control checkout_field" type="text" name="billing_zip" id="billing_zip" value="<?php
			echo @$_SESSION["billing_zip"] ?>" style="width:300px">
		</div>

		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "country" )?></b></span>
		<select name="billing_country" id="billing_country" style="width:310px;" class="ibox form-control checkout_field" onChange="check_country('billing');"><option value=""></option>
		<?php
			$sql = "select name from " . PVS_DB_PREFIX .
				"countries where activ=1 order by priority,name";
			$dd->open( $sql );
			while ( ! $dd->eof )
			{
				$sel = "";
				if ( $dd->row["name"] == @$_SESSION["billing_country"] )
				{
					$sel = "selected";
				}
?>
<option value="<?php
				echo $dd->row["name"] ?>" <?php
				echo $sel
?>><?php
				echo $dd->row["name"] ?></option>
<?php
				$dd->movenext();
			}
?>
		</select>
		</div>
		
		
		
		<script>
			check_country('billing');
		</script>

		<?php
		if ( $pvs_global_settings["no_cart"] and $pvs_global_settings["eu_tax"]  ) {
		?>
			<script>
				vat_reg = /^(ATU[0-9]{8}|BE[01][0-9]{9}|BG[0-9]{9,10}|HR[0-9]{11}|CY[A-Z0-9]{9}|CZ[0-9]{8,10}|DK[0-9]{8}|EE[0-9]{9}|FI[0-9]{8}|FR[0-9A-Z]{2}[0-9]{9}|DE[0-9]{9}|EL[0-9]{9}|HU[0-9]{8}|IE([0-9]{7}[A-Z]{1,2}|[0-9][A-Z][0-9]{5}[A-Z])|IT[0-9]{11}|LV[0-9]{11}|LT([0-9]{9}|[0-9]{12})|LU[0-9]{8}|MT[0-9]{8}|NL[0-9]{9}B[0-9]{2}|PL[0-9]{10}|PT[0-9]{9}|RO[0-9]{2,10}|SK[0-9]{10}|SI[0-9]{8}|ES[A-Z]([0-9]{8}|[0-9]{7}[A-Z])|SE[0-9]{12}|GB([0-9]{9}|[0-9]{12}|GD[0-4][0-9]{2}|HA[5-9][0-9]{2}))$/gi
			
				function check_vat()
				{
					vat = jQuery('#billing_vat').val();

					if( vat.match(vat_reg) ) 
					{
						jQuery("#billing_vat").addClass("ibox_ok").removeClass("ibox_error");
						$('#button_vat').prop('disabled', false);
					} 
					else
					{
						jQuery("#billing_vat").removeClass("ibox_ok").addClass("ibox_error");
						$('#button_vat').prop('disabled', true);
					}
				}
				
				function check_vat2()
				{
					vat = jQuery('#billing_vat').val();
					
					if( vat.match(vat_reg) ) 
					{
						jQuery.ajax({
							type:'POST',
							url:'<?php echo (site_url( ) );?>/checkout-vat/',
							data:'vat=' + vat,
							success:function(data){
								if ( data == 1 ) {
									jQuery("#billing_vat").addClass("ibox_ok").removeClass("ibox_error");
									jQuery("#error_vat").html('<span class="ok"><?php echo(pvs_word_lang("Correct VAT number"));?></span>');
								} else {
									jQuery("#billing_vat").removeClass("ibox_ok").addClass("ibox_error");
									jQuery("#error_vat").html('<span class="error"><?php echo(pvs_word_lang("Incorrect VAT number"));?></span>');
								}
							}
						}); 
					}
				}
			</script>
			<div class="form_field">
				<span><?php echo pvs_word_lang( "company" )?></span>
				<input class="ibox form-control checkout_field" type="text" name="billing_company"  id="billing_company" value="<?php echo @$_SESSION["billing_company"] ?>" style="width:300px">
				<div id="error_company"></div>
			</div>
			
			<div class="form_field">
				<span><?php echo pvs_word_lang( "VAT number" )?></span>

				<input class="ibox form-control checkout_field" type="text" name="billing_vat"  id="billing_vat" value="<?php echo @$_SESSION["billing_vat"] ?>" style="width:185px;display:inline" onkeyup="check_vat();"><a id="button_vat" class="btn btn-info"  href="javascript:check_vat2();"><?php echo(pvs_word_lang("Check"));?></a>
				<div id="error_vat"></div>
			</div>
		
			<div class="form_field">
				<span><?php
					echo pvs_word_lang( "telephone" )?></span>
				<input class="ibox form-control checkout_field" type="text" name="billing_telephone"  id="billing_telephone" value="<?php echo @$_SESSION["billing_telephone"] ?>" style="width:300px">
			</div>				
		<?php
		}
			
			if ( $flag_shipping )
			{
?>
		<div class="form_field">
		<span><b><?php
				echo pvs_word_lang( "billing and shipping address are the same" )?>:</b></span>
		<input name="thesame" id="thesame1" type="radio" value="1" <?php
				if ( $_SESSION["shipping_thesame"] == 1 )
				{
					echo ( "checked" );
				}
?> onClick="show_shipping(this.value)"  class="checkout_field">&nbsp;<?php
				echo pvs_word_lang( "yes" )?>&nbsp;&nbsp;&nbsp;<input name="thesame" id="thesame2" type="radio" value="0" onClick="show_shipping(this.value)" <?php
				if ( $_SESSION["shipping_thesame"] == 0 )
				{
					echo ( "checked" );
				}
?>  class="checkout_field">&nbsp;<?php
				echo pvs_word_lang( "no" )?>
		</div>
	<?php
			}
?>

	</div>
	</div>
	<?php
		}
?>
	<div class="col-lg-6 col-md-6 panel_right2">
<?php
		if ( $flag_shipping )
		{
?>
	<div id="shipping_form" name="shipping_form" style="display:<?php
			if ( $_SESSION["shipping_thesame"] == 1 and $pvs_global_settings["checkout_order_billing"] )
			{
				echo ( "none" );
			} else
			{
				echo ( "block" );
			}
?>;">
		<div class='login_header'><h2><?php
			echo pvs_word_lang( "shipping address" )?>:</h2></div>

		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "first name" )?></b></span>
		<input class="ibox form-control checkout_field" type="text" name="shipping_firstname"  id="shipping_firstname" value="<?php
			echo @$_SESSION["shipping_firstname"] ?>" style="width:300px">
		</div>

		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "last name" )?></b></span>
		<input class="ibox form-control checkout_field" type="text" name="shipping_lastname" id="shipping_lastname" value="<?php
			echo @$_SESSION["shipping_lastname"] ?>" style="width:300px">
		</div>


		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "address" )?></b></span>
		<textarea class="ibox form-control checkout_field" name="shipping_address" id="shipping_address" style="width:300px;height:100px"><?php
			echo @$_SESSION["shipping_address"] ?></textarea>
		</div>
		
		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "city" )?></b></span>
		<input class="ibox form-control checkout_field" type="text" name="shipping_city" type="text" id="shipping_city" value="<?php
			echo @$_SESSION["shipping_city"] ?>" style="width:300px">
		</div>
		
		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "state" )?></b></span>
		<div id="states_shipping">
<input type="text" name="shipping_state" id="shipping_state" style="width:310px" value="<?php
			echo @$_SESSION["shipping_state"] ?>" class="ibox form-control checkout_field">
		</div>
		</div>
		
		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "zipcode" )?></b></span>
		<input class="ibox form-control checkout_field" type="text" name="shipping_zip"  id="shipping_zip" value="<?php
			echo @$_SESSION["shipping_zip"] ?>" style="width:300px">
		</div>
		

		<div class="form_field">
		<span><b><?php
			echo pvs_word_lang( "country" )?></b></span>
		<select name="shipping_country" id="shipping_country" style="width:310px;" class="ibox form-control checkout_field" onChange="check_country('shipping');"><option value=""></option>
		<?php
			$sql = "select name from " . PVS_DB_PREFIX .
				"countries where activ=1 order by priority,name";
			$dd->open( $sql );
			while ( ! $dd->eof )
			{
				$sel = "";
				if ( $dd->row["name"] == @$_SESSION["shipping_country"] )
				{
					$sel = "selected";
				}
?>
<option value="<?php
				echo $dd->row["name"] ?>" <?php
				echo $sel
?>><?php
				echo $dd->row["name"] ?></option>
<?php
				$dd->movenext();
			}
?>
		</select>
		</div>
		
		
		<script>
check_country('shipping');
		</script>
		

		

		

	</div>
	<?php
		}
?>
	</div>
	</div>
	

	
	<div class="clearfix"></div>
<?php
		if ( $_SESSION["checkout_steps"] == 1 )
		{
?>		
<input type="submit" class="isubmit" value="<?php
			echo pvs_word_lang( "next step" )?>">
<?php
		}
?>

</div>
</form>
<?php
	}
}
?>

<?php
	if ( $_SESSION["checkout_steps"] > 1 ) {
		if ( $flag_shipping )
		{
?>
	<div class="checkoutbox"><?php
			echo pvs_word_lang( "shipping" )?></div>
	<div class="checkoutbox_text">
		<?php
			echo $shipping_list
?>
	</div>
	<?php
		}
?>
<form method="post" action="<?php echo (site_url( ) );?>/orders-add/" style="margin:0px" <?php
		if ( $flag_shipping or ! is_user_logged_in() )
		{
?>onsubmit="return check_shipping();"<?php
		}
?>>
<?php wp_nonce_field( 'pvs-orders-add' ); ?>
<?php
		//Payment gateway
		if ( ( ! $pvs_global_settings["credits"] or ( $pvs_global_settings["credits_currency"] and
			@$_SESSION["checkout_method"] == "currency" ) or $pvs_global_settings["no_cart"] ) and $product_total > 0 )
		{
			?>
	<div class="checkoutbox"><?php
			echo pvs_word_lang( "select payment method" )?></div>
	<div class="checkoutbox_text">

	<script>
	function show_additional_fields(x) {
		<?php
			if ( $pvs_global_settings["qiwi_account"] != "" )
			{
?>
if(x=="qiwi") {
	jQuery("#qiwi_telephone").slideDown("slow");
}
else {
	jQuery("#qiwi_telephone").slideUp("slow");
}
		<?php
			}

			if ( $pvs_global_settings["yandex_account"] != "" )
			{
?>
if(x=="yandex") {
	jQuery("#yandex_payments").slideDown("slow");
}
else {
	jQuery("#yandex_payments").slideUp("slow");
}
<?php
			}

			if ( $pvs_global_settings["targetpay_account"] != "" )
			{
?>
if(x=="targetpay") {
	jQuery("#targetpay_banks").slideDown("slow");
}
else {
	jQuery("#targetpay_banks").slideUp("slow");
}
		<?php
			}
?>
		<?php
			if ( $pvs_global_settings["moneyua_account"] != "" )
			{
?>
if(x=="moneyua") {
	jQuery("#moneyua_method").slideDown("slow");
}
else {
	jQuery("#moneyua_method").slideUp("slow");
}
		<?php
			}
?>
	}
	</script>
	

	<?php
			$sel = false;

			foreach ( $pvs_payments as $key => $value )
			{
				if ( (int)@$pvs_global_settings[ $key . '_active' ] == 1 and $key != "fortumo" and $key != "jvzoo" ) {
?>
<div style="margin-bottom:3px"><input name="payment" type="radio" value="<?php
					echo $key
?>" <?php
					if ( $sel == false )
					{
						echo ( "checked" );
					}
?> onClick="show_additional_fields('<?php
					echo $key
?>')">&nbsp;<?php
					echo $value
?></div>
<?php
					if ( $key == "qiwi" )
					{
?>
	<div id="qiwi_telephone" style="display:<?php
						if ( $sel == false )
						{
							echo ( "block" );
						} else
						{
							echo ( "none" );
						}
?>;margin-top:5px;margin-left:25px"><b><?php
						echo pvs_word_lang( "telephone" )?></b> <small>(Example: +79061234560)</small><br><input type="text" name="telephone" value="" class="ibox form-control" style="width:150px;margin-top:2px;"></div>
<?php
					}
					if ( $key == "yandex" )
					{
?>
	<div id="yandex_payments" style="display:<?php
						if ( $sel == false )
						{
							echo ( "block" );
						} else
						{
							echo ( "none" );
						}
?>;margin-top:5px;">
	<select name="yandex_payments" style="width:400px;" class="ibox form-control">
		<?php
						foreach ( $site_yandex_payments as $key => $value )
						{
?><option value="<?php
							echo $key
?>"><?php
							echo $value
?></option><?php
						}
?>
	</select>
	</div>
	<?php
					}
					if ( $key == "targetpay" )
					{
?>
		<div id="targetpay_banks" style="display:<?php
						if ( $sel == false )
						{
							echo ( "block" );
						} else
						{
							echo ( "none" );
						}
?>;margin-top:5px;"><b><?php
						echo pvs_word_lang( "banks" )?></b><br><select name="bank" class="ibox form-control" style="width:250px;margin-top:2px;">
		<script src="https://www.targetpay.com/ideal/issuers-nl.js"></script>
		</select></div>
	<?php
					}

					if ( $key == "moneyua" )
					{
?>
	<div id="moneyua_method" style="display:<?php
						if ( $sel == false )
						{
							echo ( "block" );
						} else
						{
							echo ( "none" );
						}
?>;margin-top:5px;">
		<select name="moneyua_method" style="width:200px;" class="ibox form-control">
			<option value="16">VISA/MASTER Card</option>
			<option value="1">wmz</option>
			<option value="2">wmr</option>
			<option value="3">wmu</option>
			<option value="5">Yandex.Money</option>
			<option value="9">nsmep</option>
			<option value="14">Terminals</option>
			<option value="15">liqpay-USD</option>
			<option value="16">liqpay-UAH</option>
			<option value="17">Privat24-UAH</option>
			<option value="18">Privat24-USD</option>
		</select>
	</div>
	<?php
					}
					$sel = true;
				}
			}
?>



	</div>
	<?php
		}
?>



<?php
		$disabled = "";
		$mass = "";
		$i = 0;

		$sql = "select id,title,page_id from " . PVS_DB_PREFIX .
			"terms where types=1 order by priority";
		$rs->open( $sql );
		while ( ! $rs->eof )
		{
?>
	<div class="checkoutbox"><?php
			echo pvs_word_lang( $rs->row["title"] )?></div>
	<div class="checkoutbox_text">
		<iframe src="<?php
			echo site_url()?>/agreement/?id=<?php
			echo $rs->row["page_id"] ?>" frameborder="no" scrolling="yes" class="framestyle_seller" style="width:100%;height:150px"></iframe><br>
		<input name="terms<?php
			echo $rs->row["id"] ?>" id="terms<?php
			echo $rs->row["id"] ?>" type="checkbox" value="1" onClick="check_terms(<?php
			echo $rs->row["id"] ?>)"> <?php
			echo pvs_word_lang( "i agree" )?>
	</div>
<?php
			$mass .= "mass[" . $i . "]=" . $rs->row["id"] . ";";

			$i++;
			$disabled = "disabled";
			$rs->movenext();
		}
		if ( $disabled != "" )
		{
?>
<script>
	mass=new Array();	
	<?php
			echo $mass
?>

	function check_terms(value) {
		flag=true;	
		
		for(i=0;i<mass.length;i++)
		{
if(document.getElementById("terms"+mass[i].toString()) && jQuery("#terms"+mass[i].toString()).is(':checked')==false) {
	flag=false;
}
		}

		if(flag)
		{
document.getElementById('order_now').disabled=false;
		}
		else
		{
document.getElementById('order_now').disabled=true;
		}
	}
</script>
<?php
		}
?>



<input type="submit" id="order_now" class="isubmit" value="<?php
		echo pvs_word_lang( "order now" )?>" <?php
		echo $disabled
?>>
</form>
<?php
	}

	echo ( $checkout_middle );?>




<div class="checkoutbox2">
<div class="checkoutbox2_title">
	<?php echo pvs_word_lang( "order total" )?>
</div>
<div class="checkoutbox2_text">
	<div class="checkout_list">
		<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
<?php echo $total_list
?>
		</table>
	</div>
	<div class="checkout_list">
	<?php
	if ( ! isset( $_SESSION["coupon_code"] ) and ( ! $pvs_global_settings["credits"] or
		( $pvs_global_settings["credits"] and $pvs_global_settings["credits_currency"] ) ) ) {
		if ( isset( $_GET["coupon"] ) )
		{
			echo ( "<p><b>Error. The coupon doesn't exist.</b></p>" );
		}
?>
		<div id="coupon_field">
<form method="post" action="<?php echo (site_url( ) );?>/checkout-coupon/" style="margin:0px">
<?php wp_nonce_field( 'pvs-checkout-coupon' ); ?>
	<input type="text" name="coupon" style="width:150px" class="ibox form-control" value="<?php
		echo pvs_word_lang( "coupon" )?>" onClick="this.value=''">
	<input type="submit" value="Ok" class="isubmit">
</form>
		</div>
		<?php
	}
?>
	</div>
	
	<div class="checkoutbox2_bottom">
		<div id="total_block">
<b><?php echo pvs_word_lang( "total" )?>:</b> <span class="price"><b><?php echo pvs_currency( 1, true, @$_SESSION["checkout_method"] ) . pvs_price_format( $product_total,
		2 ) . " " . pvs_currency( 2, true, @$_SESSION["checkout_method"] )?></b></span>
		</div>
	</div>
	
</div>
</div>




<div class="checkoutbox2">
<div class="checkoutbox2_title">
	<?php echo pvs_word_lang( "items" )?>
</div>
<div class="checkoutbox2_text">
	<?php echo $items_list
?>
	
	<div class="checkoutbox2_bottom">
		<a href="<?php echo (site_url( ) );?>/cart/"><?php echo pvs_word_lang( "change" )?></a>
	</div>
</div>

</div>

<?php
	if ( $pvs_global_settings["credits_currency"] and $pvs_global_settings["credits"] and ! $pvs_global_settings["no_cart"] ) {
?>
<div class="checkoutbox2">
<div class="checkoutbox2_title">
	<?php
		echo pvs_word_lang( "currency" )?>
</div>
<div class="checkoutbox2_text">
	<div style="padding:10px">
	<?php
		if ( @$_SESSION["checkout_method"] == "currency" )
		{
			echo ( pvs_get_currency_code(1) );
		} else
		{
			echo ( pvs_word_lang( "credits" ) );
		}
?>
	</div>
	
	<div class="checkoutbox2_bottom">
		<a href="<?php echo (site_url( ) );?>/checkout-method/"><?php
		echo pvs_word_lang( "change" )?></a>
	</div>
</div>
</div>
<?php
	}
?>


<?php
	if ( ( $pvs_global_settings["checkout_order_billing"] or $pvs_global_settings["checkout_order_shipping"] or
		$flag_shipping )  and ( ! $pvs_global_settings["no_cart"] or is_user_logged_in() or
		$flag_shipping ) ) {
?>
<div class="checkoutbox2">
<div class="checkoutbox2_title">
	<?php
		echo pvs_word_lang( "order information" )?>
</div>
<div class="checkoutbox2_text">
	<?php
		if ( $pvs_global_settings["checkout_order_billing"] )
		{
?>
	<div class="checkout_list">
		<b><?php
			echo pvs_word_lang( "billing address" )?>:</b><br>
		<?php
			if ( @$_SESSION["billing_business"] == 1 )
			{
				echo ( pvs_word_lang( "company" ) . ": " . @$_SESSION["billing_company"] . "<br>" );
			}
			if ( @$_SESSION["billing_firstname"] != "" or @$_SESSION["billing_lastname"] != "" )
			{
				echo ( pvs_word_lang( "name" ) . ": " . @$_SESSION["billing_firstname"] . " " . @$_SESSION["billing_lastname"] .
					"<br>" );
			}
			if ( @$_SESSION["billing_address"] != "" )
			{
				echo ( pvs_word_lang( "address" ) . ": " . @$_SESSION["billing_address"] . "<br>" );
			}
			if ( @$_SESSION["billing_city"] != "" )
			{
				echo ( pvs_word_lang( "city" ) . ": " . @$_SESSION["billing_city"] . "<br>" );
			}
			if ( @$_SESSION["billing_state"] != "" )
			{
				echo ( pvs_word_lang( "state" ) . ": " . @$_SESSION["billing_state"] . "<br>" );
			}
			if ( @$_SESSION["billing_zip"] != "" )
			{
				echo ( pvs_word_lang( "zipcode" ) . ": " . @$_SESSION["billing_zip"] . "<br>" );
			}
			if ( @$_SESSION["billing_country"] != "" )
			{
				echo ( pvs_word_lang( "country" ) . ": " . @$_SESSION["billing_country"] . "<br>" );
			}
?>
	</div>
	<?php
		}
?>
	<?php
		if ( $flag_shipping or $pvs_global_settings["checkout_order_shipping"] )
		{
?>
	<div class="checkout_line"></div>
	<div class="checkout_list">	
		<b><?php
			echo pvs_word_lang( "shipping address" )?>:</b><br>
		<?php
			if ( @$_SESSION["billing_business"] == 1 )
			{
				echo ( pvs_word_lang( "company" ) . ": " . @$_SESSION["billing_company"] . "<br>" );
			}
			if ( @$_SESSION["shipping_firstname"] != "" or @$_SESSION["shipping_lastname"] !=
				"" )
			{
				echo ( pvs_word_lang( "name" ) . ": " . @$_SESSION["shipping_firstname"] . " " .
					@$_SESSION["shipping_lastname"] . "<br>" );
			}
			if ( @$_SESSION["shipping_address"] != "" )
			{
				echo ( pvs_word_lang( "address" ) . ": " . @$_SESSION["shipping_address"] .
					"<br>" );
			}
			if ( @$_SESSION["shipping_city"] != "" )
			{
				echo ( pvs_word_lang( "city" ) . ": " . @$_SESSION["shipping_city"] . "<br>" );
			}
			if ( @$_SESSION["shipping_state"] != "" )
			{
				echo ( pvs_word_lang( "state" ) . ": " . @$_SESSION["shipping_state"] . "<br>" );
			}
			if ( @$_SESSION["shipping_zip"] != "" )
			{
				echo ( pvs_word_lang( "zipcode" ) . ": " . @$_SESSION["shipping_zip"] . "<br>" );
			}
			if ( @$_SESSION["shipping_country"] != "" )
			{
				echo ( pvs_word_lang( "country" ) . ": " . @$_SESSION["shipping_country"] .
					"<br>" );
			}
?>
	</div>
	<?php
		}
?>
</div>
</div>
<?php
	}
?>













<?php echo ( $checkout_footer );
}
?>

