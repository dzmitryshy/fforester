<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "settings_prices" );

if ( wp_verify_nonce( @$_REQUEST['_wpnonce'], 'pvs-prices-add' ) ) {
	$shipped = 0;
	if ( isset( $_POST["shipped"] ) )
	{
		$shipped = 1;
		$_POST["types"] = "shipped";
	}
	
	$sql = "insert into " . PVS_DB_PREFIX .
		"audio_types (types,price,priority,thesame,title,license,shipped,contacts) values ('" .
		pvs_result( $_POST["types"] ) . "'," . ( float )$_POST["price"] . "," . ( int )
		$_POST["priority"] . "," . ( int )$_POST["thesame"] . ",'" . pvs_result( $_POST["title"] ) .
		"'," . ( int )$_POST["license"] . "," . $shipped . "," . ( int )@$_POST["contacts"] . ")";
	$db->execute( $sql );
	
	//define id
	$sql = "select id_parent from " . PVS_DB_PREFIX .
		"audio_types order by id_parent desc";
	$dr->open( $sql );
	$id = $dr->row['id_parent'];
	
	$items_count = 0;
	
	if ( ( int )$_POST["addto"] == 1 )
	{
		$ux = explode( ",", str_replace( " ", "", pvs_result( $_POST["types"] ) ) );
		$ux_reg = "";
		for ( $i = 0; $i < count( $ux ); $i++ )
		{
			$ux_reg .= "." . $ux[$i] . "$";
			if ( $i != count( $ux ) - 1 )
			{
				$ux_reg .= "|";
			}
		}
	
		$sql = "select id,server1 from " . PVS_DB_PREFIX .
			"media where media_id=3 order by id";
		$rs->open( $sql );
		while ( ! $rs->eof )
		{
			if ( $shipped != 1 )
			{
				$dir = opendir( pvs_upload_dir() . pvs_server_url( $rs->row["server1"] ) . "/" .
					$rs->row["id"] );
				while ( $file = readdir( $dir ) )
				{
					if ( $file <> "." && $file <> ".." )
					{
						if ( preg_match( "/" . $ux_reg . "/i", $file ) and ! preg_match( "/thumb/i", $file ) )
						{
							$sql = "insert into " . PVS_DB_PREFIX .
								"items (id_parent,name,url,price,priority,shipped,price_id,contacts) values (" . $rs->
								row["id"] . ",'" . pvs_result( $_POST["title"] ) . "','" . $file . "'," . ( float )
								$_POST["price"] . "," . ( int )$_POST["priority"] . "," . $shipped . "," . $id .
								"," . ( int )@$_POST["contacts"] . ")";
							$db->execute( $sql );
							$items_count++;
						}
					}
				}
				closedir( $dir );
			} else
			{
				$sql = "insert into " . PVS_DB_PREFIX .
					"items (id_parent,name,url,price,priority,shipped,price_id,contacts) values (" . $rs->
					row["id"] . ",'" . pvs_result( $_POST["title"] ) . "',''," . ( float )$_POST["price"] .
					"," . ( int )$_POST["priority"] . "," . $shipped . "," . $id . "," . ( int )@$_POST["contacts"] . ")";
				$db->execute( $sql );
				$items_count++;
			}
			$rs->movenext();
		}
	}
}
?>