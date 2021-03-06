<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
//Check access
pvs_admin_panel_access( "orders_credits" );
include ( plugin_dir_path( __FILE__ ) . "../includes/header.php" );

//Add
if ( @$_REQUEST["action"] == 'add' )
{
	include ( "add.php" );
}




//Delete
if ( @$_REQUEST["action"] == 'delete' )
{
	include ( "delete.php" );
}


//New
if ( @$_REQUEST["action"] == 'new' ) {
	include ( "new.php" );	
} else {
	?>
	
	
	
	
	
	<a class="btn btn-success toright" href="<?php echo(pvs_plugins_admin_url('credits/index.php'));?>&action=new"><i class="icon-tags icon-white fa fa-plus"></i> <?php echo pvs_word_lang( "credits" )?></a>
	
	<h1><?php echo pvs_word_lang( "Credits list" )?>:</h1>
	
	
	<script>
	
	function pvs_credits_status(value) 
	{
		jQuery.ajax({
			type:'POST',
			url:ajaxurl,
			data:'action=pvs_credits_status&id=' + value,
			success:function(data){
				if(data.charAt(data.length-1) == '0')
				{
					data = data.substring(0,data.length-1)
				}
				document.getElementById('status'+value).innerHTML =data;
			}
		});
	}
	
	
	
	
	
	</script>
	
	
	
	
	<?php
	//Get Search
	$search = "";
	if ( isset( $_REQUEST["search"] ) ) {
		$search = pvs_result( $_REQUEST["search"] );
	}
	
	
	//Get Search type
	$search_type = "";
	if ( isset( $_REQUEST["search_type"] ) ) {
		$search_type = pvs_result( $_REQUEST["search_type"] );
	}
	
	//Get pub_type
	$pub_type = "all";
	if ( isset( $_REQUEST["pub_type"] ) ) {
		$pub_type = pvs_result( $_REQUEST["pub_type"] );
	}
	
	//Get credits type
	$credits_type = 0;
	if ( isset( $_GET["credits_type"] ) ) {
		$credits_type = ( int )$_GET["credits_type"];
	}
	if ( isset( $_POST["credits_type"] ) ) {
		$credits_type = ( int )$_POST["credits_type"];
	}
	
	//Items
	$items = 30;
	if ( isset( $_REQUEST["items"] ) ) {
		$items = ( int )$_REQUEST["items"];
	}
	
	//Search variable
	$var_search = "search=" . $search . "&search_type=" . $search_type . "&items=" .
		$items . "&pub_type=" . $pub_type . "&credits_type=" . $credits_type;
	
	//Sort by date
	$adate = 0;
	if ( isset( $_GET["adate"] ) ) {
		$adate = ( int )$_GET["adate"];
	}
	
	//Sort by ID
	$aid = 0;
	if ( isset( $_GET["aid"] ) ) {
		$aid = ( int )$_GET["aid"];
	}
	
	//Sort by default
	if ( $adate == 0 and $aid == 0 ) {
		$adate = 2;
	}
	
	//Add sort variable
	$com = "";
	
	if ( $adate != 0 ) {
		$var_sort = "&adate=" . $adate;
		if ( $adate == 1 ) {
			$com = " order by data ";
		}
		if ( $adate == 2 ) {
			$com = " order by data desc ";
		}
	}
	
	if ( $aid != 0 ) {
		$var_sort = "&aid=" . $aid;
		if ( $aid == 1 ) {
			$com = " order by id_parent ";
		}
		if ( $aid == 2 ) {
			$com = " order by id_parent desc ";
		}
	}
	
	//Items on the page
	$items_mass = array(
		10,
		20,
		30,
		50,
		75,
		100 );
	
	//Search parameter
	$com2 = "";
	
	if ( $search != "" ) {
	
		if ( $search_type == "id" ) {
			$com2 .= " and id_parent=" . ( int )$search . " ";
		}
		if ( $search_type == "login" ) {
			$com2 .= " and user = '" . $search . "' ";
		}
	
	}
	
	if ( $pub_type == "plus" ) {
		$com2 .= " and quantity>0 ";
	}
	if ( $pub_type == "minus" ) {
		$com2 .= " and quantity<0 ";
	}
	
	if ( $credits_type != 0 ) {
		$com2 .= " and credits=" . $credits_type . " ";
	}
	
	//Item's quantity
	$kolvo = $items;
	
	//Pages quantity
	$kolvo2 = PVS_PAGE_NUMBER;
	
	//Page number
	if ( ! isset( $_GET["str"] ) ) {
		$str = 1;
	} else
	{
		$str = ( int )$_GET["str"];
	}
	
	$n = 0;
	
	$sql = "select id_parent,title,quantity,user,data,approved,expiration_date,total from " .
		PVS_DB_PREFIX . "credits_list where id_parent>0 ";
	
	$sql .= $com2 . $com;
	
	$rs->open( $sql );
	$record_count = $rs->rc;
	
	//limit
	$lm = " limit " . ( $kolvo * ( $str - 1 ) ) . "," . $kolvo;
	
	$sql .= $lm;
	
	//echo($sql);
	$rs->open( $sql );
	?>
	<div id="catalog_menu">
	
	
	<form method="post">
	<div class="toleft">
	<span><?php echo pvs_word_lang( "search" )?>:</span>
	<input type="text" name="search" style="width:200px;display:inline" class="ft" value="<?php echo $search
	?>" onClick="this.value=''">
	<select name="search_type" style="width:100px;display:inline" class="ft">
	<option value="login" <?php
	if ( $search_type == "login" ) {
		echo ( "selected" );
	}
	?>><?php echo pvs_word_lang( "login" )?></option>
	<option value="id" <?php
	if ( $search_type == "id" ) {
		echo ( "selected" );
	}
	?>>ID</option>
	
	</select>
	
	</div>
	
	
	
	
	
	
	
	
	
	
	<div class="toleft">
	<span><?php echo pvs_word_lang( "type" )?>:</span>
	<select name="pub_type" style="width:100px" class="ft">
	<option value="all"><?php echo pvs_word_lang( "all" )?></option>
	<option value="plus" <?php
	if ( $pub_type == "plus" ) {
		echo ( "selected" );
	}
	?>>+ Credits</option>
	<option value="minus" <?php
	if ( $pub_type == "minus" ) {
		echo ( "selected" );
	}
	?>>- Credits</option>
	
	</select>
	</div>
	
	
	<div class="toleft">
	<span><?php echo pvs_word_lang( "credits types" )?>:</span>
	<select name="credits_type" style="width:200px" class="ft">
	<option value="0"><?php echo pvs_word_lang( "all" )?></option>
	<?php
	$sql = "select id_parent,title from " . PVS_DB_PREFIX .
		"credits order by priority";
	$ds->open( $sql );
	while ( ! $ds->eof ) {
		$sel = "";
		if ( $credits_type == $ds->row["id_parent"] ) {
			$sel = "selected";
		}
	?><option value="<?php echo $ds->row["id_parent"] ?>" <?php echo $sel
	?>><?php echo $ds->row["title"] ?></option><?php
		$ds->movenext();
	}
	?>
	</select>
	</div>
	
	
	
	
	<div class="toleft">
	<span><?php echo pvs_word_lang( "page" )?>:</span>
	<select name="items" style="width:70px" class="ft">
	<?php
	for ( $i = 0; $i < count( $items_mass ); $i++ ) {
		$sel = "";
		if ( $items_mass[$i] == $items ) {
			$sel = "selected";
		}
	?>
	<option value="<?php echo $items_mass[$i] ?>" <?php echo $sel
	?>><?php echo $items_mass[$i] ?></option>
	<?php
	}
	?>
	
	</select>
	</div>
	
	<div class="toleft">
	<span>&nbsp;</span>
	<input type="submit" class="btn btn-danger" value="<?php echo pvs_word_lang( "search" )?>">
	</div>
	
	<div class="toleft_clear"></div>
	</form>
	
	
	</div>
	
	
	
	<?php
	if ( ! $rs->eof ) {
	?>
	
	
	<div style="padding:0px 0px 15px 6px"><?php echo ( pvs_paging( $record_count, $str, $kolvo, $kolvo2, pvs_plugins_admin_url('credits/index.php'), "&" . $var_search .
			$var_sort ) );
	?></div>
	
	<script language="javascript">
	function publications_select_all(sel_form) {
		if(sel_form.selector.checked)
		{
			$("input:checkbox", sel_form).attr("checked",true);
		}
		else
		{
			$("input:checkbox", sel_form).attr("checked",false);
		}
	}
	</script>
	
	
	
	<form method="post" action="<?php echo(pvs_plugins_admin_url('credits/index.php'));?>" style="margin:0px"  id="adminform" name="adminform">
	<input type="hidden" name="action" value="delete">
	<table class="wp-list-table widefat fixed striped posts">
	<thead>
	<tr>
	<th><input type="checkbox"  name="selector" value="1" onClick="publications_select_all(document.adminform);"></th>
	<th class="hidden-phone hidden-tablet">
	<a href="<?php echo(pvs_plugins_admin_url('credits/index.php'));?>&<?php echo $var_search
	?>&aid=<?php
		if ( $aid == 2 ) {
			echo ( 1 );
		} else {
			echo ( 2 );
		}
	?>">ID</a> <?php
		if ( $aid == 1 ) {
	?><img src="<?php echo(pvs_plugins_url());?>/assets/images/sort_up.gif" width="11" height="8"><?php
		}
	?><?php
		if ( $aid == 2 ) {
	?><img src="<?php echo(pvs_plugins_url());?>/assets/images/sort_down.gif" width="11" height="8"><?php
		}
	?>
	</th>
	<th class="hidden-phone hidden-tablet"><?php echo pvs_word_lang( "order" )?></th>
	<th><?php echo pvs_word_lang( "quantity" )?></th>
	<th><?php echo pvs_word_lang( "user" )?></th>
	
	
	<th class="hidden-phone hidden-tablet">
	<a href="<?php echo(pvs_plugins_admin_url('credits/index.php'));?>&<?php echo $var_search
	?>&adate=<?php
		if ( $adate == 2 ) {
			echo ( 1 );
		} else {
			echo ( 2 );
		}
	?>"><?php echo pvs_word_lang( "date" )?></a> <?php
		if ( $adate == 1 ) {
	?><img src="<?php echo(pvs_plugins_url());?>/assets/images/sort_up.gif" width="11" height="8"><?php
		}
	?><?php
		if ( $adate == 2 ) {
	?><img src="<?php echo(pvs_plugins_url());?>/assets/images/sort_down.gif" width="11" height="8"><?php
		}
	?>
	
	</th>
	<th class="hidden-phone hidden-tablet"><?php echo pvs_word_lang( "expiration date" )?></th>
	
	<th><?php echo pvs_word_lang( "status" )?></th>
	
	
	
	<th class="hidden-phone hidden-tablet"><?php echo pvs_word_lang( "Invoice" )?></th>
	
	
	</tr>
	</thead>
	<?php
		$property_value = pvs_get_admin_notifications( 'credits', 'value' );
		while ( ! $rs->eof ) {
	
			$cl3 = "";
			$cl_script = "";
			if ( $rs->row["id_parent"] > $property_value and $property_value > 0 ) {
				$cl3 = "<span class='label label-danger credits" . $rs->row["id_parent"] . "'>" . pvs_word_lang("new") . "</span>";
				$cl_script = "onMouseover=\"pvs_deselect_row('credits'," . $rs->row["id_parent"] . ")\"";
			}
	?>
	<tr valign="top" <?php echo $cl_script
	?>>
	<td><input type="checkbox" name="sel<?php echo $rs->row["id_parent"] ?>" id="sel<?php echo $rs->row["id_parent"] ?>"></td>
	<td class="hidden-phone hidden-tablet"><?php echo $rs->row["id_parent"] ?></td>
	<td class="big hidden-phone hidden-tablet"><?php echo $rs->row["title"] ?> <?php echo $cl3
	?></td>
	<td><?php echo $rs->row["quantity"] ?></td>
	<td>
	
	<div class="link_user"><a href="<?php
		echo ( pvs_plugins_admin_url( 'customers/index.php' ) );
	?>&action=content&id=<?php
				echo pvs_user_login_to_id( $rs->row["user"] )?>"><?php
				echo $rs->row["user"] ?></a></div>
	
	
	</td>
	
	<td class="gray hidden-phone hidden-tablet"><?php echo date( date_format, $rs->row["data"] )?></td>
	
	<td class="gray hidden-phone hidden-tablet">
	<?php
			if ( $rs->row["quantity"] > 0 ) {
				if ( $rs->row["expiration_date"] == 0 )
				{
					echo ( pvs_word_lang( "never" ) );
				} else
				{
					echo ( date( date_format, $rs->row["expiration_date"] ) );
				}
			} else {
				echo ( "&#8212;" );
			}
	?>
	</td>
	
	<td>
	<?php
			if ( $rs->row["quantity"] > 0 ) {
	
				$cl = "success";
				if ( $rs->row["approved"] != 1 )
				{
					$cl = "danger";
				}
	?>
	<div id="status<?php
				echo $rs->row["id_parent"] ?>" name="status<?php
				echo $rs->row["id_parent"] ?>"><a href="javascript:pvs_credits_status(<?php
				echo $rs->row["id_parent"] ?>);"><span class="label label-<?php
				echo $cl
	?>"><?php
				if ( $rs->row["approved"] == 1 )
				{
					echo ( pvs_word_lang( "approved" ) );
				} else
				{
					echo ( pvs_word_lang( "pending" ) );
				}
	?></span></a></div>
	
	
	
	
	
	<?php
			} else {
				echo ( "&#8212;" );
			}
	?>
	
	</td>
	
	
	<td class="hidden-phone hidden-tablet">
	<?php
			if ( $rs->row["quantity"] > 0 and $rs->row["total"] > 0 ) {
				$invoice_number = "";
				$link_class = "";
	
				$sql = "select invoice_number,refund from " . PVS_DB_PREFIX .
					"invoices where order_type='credits' and order_id=" . $rs->row["id_parent"] .
					" order by id";
				$ds->open( $sql );
				while ( ! $ds->eof )
				{
					if ( $ds->row["refund"] == 1 )
					{
						$link_class = "class='red'";
						$invoice_number = "#" . $pvs_global_settings["credit_notes_prefix"] . $ds->row["invoice_number"];
						$word_refund = pvs_word_lang( "Refund money" ) . ": ";
					} else
					{
						$invoice_number = "#" . $pvs_global_settings["invoice_prefix"] . $ds->row["invoice_number"];
						$word_refund = "";
					}
	?>
			<a href="<?php echo(pvs_plugins_admin_url('invoices/index.php'));?>&action=invoice&id=<?php
					echo $ds->row["invoice_number"] ?>" <?php
					echo $link_class
	?>><i class="fa fa-file-pdf-o"></i>
			 <?php
					echo $word_refund
	?><?php
					echo $invoice_number
	?></a><br>
			<?php
					$ds->movenext();
				}
			}
	?>
	</td>
	</tr>
	<?php
			
			$n++;
			$rs->movenext();
		}
	?>
	</table>
	
	
	
	<input type="submit" class="btn btn-danger" value="<?php echo pvs_word_lang( "delete" )?>"  style="margin:15px 0px 0px 6px;">
	
	
	
	
	
	
	</form>
	<div style="padding:25px 0px 0px 6px;"><?php echo ( pvs_paging( $record_count, $str, $kolvo, $kolvo2, pvs_plugins_admin_url('credits/index.php'), "&" . $var_search .
			$var_sort ) );
	?></div>
	<?php
	} else
	{
		echo ( "<p><b>" . pvs_word_lang( "not found" ) . "</b></p>" );
	}
	?>
	
	<?php
}
include ( plugin_dir_path( __FILE__ ) . "../includes/footer.php" );
?>