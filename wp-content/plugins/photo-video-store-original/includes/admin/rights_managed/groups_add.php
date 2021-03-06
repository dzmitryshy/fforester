<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

//Check access
pvs_admin_panel_access( "settings_rightsmanaged" );

$id = 0;

if ( isset( $_GET["id"] ) )
{
	$sql = "update " . PVS_DB_PREFIX . "rights_managed_groups set title='" .
		pvs_result( $_POST["title"] ) . "',description='" . pvs_result( $_POST["description"] ) .
		"' where id=" . ( int )$_GET["id"];
	$db->execute( $sql );

	$id = ( int )$_GET["id"];
} else
{
	$sql = "insert into " . PVS_DB_PREFIX .
		"rights_managed_groups (title,description) values ('" . pvs_result( $_POST["title"] ) .
		"','" . pvs_result( $_POST["description"] ) . "')";
	$db->execute( $sql );

	$sql = "select id from " . PVS_DB_PREFIX . "rights_managed_groups where title='" .
		pvs_result( $_POST["title"] ) . "' order by id desc";
	$rs->open( $sql );
	$id = $rs->row["id"];
}

//Add ranges
if ( $id != 0 )
{
	$sql = "delete from " . PVS_DB_PREFIX .
		"rights_managed_options where id_parent=" . $id;
	$db->execute( $sql );

	$id_list = array();
	foreach ( $_POST as $key => $value )
	{
		if ( preg_match( "/options_price/i", $key ) )
		{
			$id_list[] = str_replace( "options_price", "", $key );
		}
	}
	for ( $i = 0; $i < count( $id_list ); $i++ )
	{
		$sql = "insert into " . PVS_DB_PREFIX .
			"rights_managed_options (id_parent,price,title,adjust) values (" . $id . "," . ( float )
			$_POST["options_price" . $id_list[$i]] . ",'" . pvs_result( $_POST["options" . $id_list[$i] .
			"_title"] ) . "','" . pvs_result( $_POST["options" . $id_list[$i] . "_adjust"] ) .
			"')";
		$db->execute( $sql );
	}
}
?>
