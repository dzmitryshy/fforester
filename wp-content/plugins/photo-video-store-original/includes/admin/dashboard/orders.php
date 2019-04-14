<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}


?>
<div class="postbox" id="box_orders">
                  <h4 class="hndle ui-sortable-handle" style="padding:0px 0px 5px 20px"><span><?php echo pvs_word_lang( "orders" )?></span></h4>

                <div class="inside">
	<div class="main">
                    <table class="table no-margin">
                    	<thead>
						<tr>
						<th><b><?php echo pvs_word_lang( "stats" )?></b></th>
						<th><b><?php echo pvs_word_lang( "day" )?></b></th>
						<th><b><?php echo pvs_word_lang( "week" )?></b></th>
						<th><b><?php echo pvs_word_lang( "month" )?></b></th>
						<th><b><?php echo pvs_word_lang( "year" )?></b></th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td><?php echo pvs_word_lang( "approved" )?></td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where status=1 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 1 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where status=1 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 7 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where status=1 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 30 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where status=1 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 365 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						</tr>
						<tr class="snd">
						<td><?php echo pvs_word_lang( "pending" )?></td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where status=0 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 1 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where status=0 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 7 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where status=0 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 30 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where status=0 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 365 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						</tr>
						<tr>
						<td><?php echo pvs_word_lang( "quantity" )?></td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where data>" . ( pvs_get_time( date( "H" ), date( "i" ), date( "s" ),
		date( "m" ), date( "d" ), date( "Y" ) ) - 1 * 24 * 3600 ) . " group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where data>" . ( pvs_get_time( date( "H" ), date( "i" ), date( "s" ),
		date( "m" ), date( "d" ), date( "Y" ) ) - 7 * 24 * 3600 ) . " group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where data>" . ( pvs_get_time( date( "H" ), date( "i" ), date( "s" ),
		date( "m" ), date( "d" ), date( "Y" ) ) - 30 * 24 * 3600 ) . " group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select count(id) as count_param from " . PVS_DB_PREFIX .
		"orders where data>" . ( pvs_get_time( date( "H" ), date( "i" ), date( "s" ),
		date( "m" ), date( "d" ), date( "Y" ) ) - 365 * 24 * 3600 ) . " group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( $count_param );?>
						</td>
						</tr>
						
						<tr class="snd">
						<td><?php echo pvs_word_lang( "Total" )?> (<?php echo pvs_word_lang( "pending" )?>)</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select sum(total) as count_param from " . PVS_DB_PREFIX .
		"orders where status=0 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 1 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( pvs_price_format( $count_param, 2 ) );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select sum(total) as count_param from " . PVS_DB_PREFIX .
		"orders where status=0 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 7 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( pvs_price_format( $count_param, 2 ) );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select sum(total) as count_param from " . PVS_DB_PREFIX .
		"orders where status=0 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 30 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( pvs_price_format( $count_param, 2 ) );?>
						</td>
						<td>
						<?php
	$count_param = 0;
	$sql = "select sum(total) as count_param from " . PVS_DB_PREFIX .
		"orders where status=0 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 365 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( pvs_price_format( $count_param, 2 ) );?>
						</td>
						</tr>
						
						
						
						
						<tr>
						<td><?php echo pvs_word_lang( "Total" )?> (<?php echo pvs_word_lang( "approved" )?>)</td>
						<td><b>
						<?php
	$count_param = 0;
	$sql = "select sum(total) as count_param from " . PVS_DB_PREFIX .
		"orders where status=1 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 1 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( pvs_price_format( $count_param, 2 ) );?>
						</td>
						<td><b>
						<?php
	$count_param = 0;
	$sql = "select sum(total) as count_param from " . PVS_DB_PREFIX .
		"orders where status=1 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 7 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( pvs_price_format( $count_param, 2 ) );?>
						</td>
						<td><b>
						<?php
	$count_param = 0;
	$sql = "select sum(total) as count_param from " . PVS_DB_PREFIX .
		"orders where status=1 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 30 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( pvs_price_format( $count_param, 2 ) );?>
						</td>
						<td><b>
						<?php
	$count_param = 0;
	$sql = "select sum(total) as count_param from " . PVS_DB_PREFIX .
		"orders where status=1 and data>" . ( pvs_get_time( date( "H" ), date( "i" ),
		date( "s" ), date( "m" ), date( "d" ), date( "Y" ) ) - 365 * 24 * 3600 ) .
		" group by status";
	$rs->open( $sql );
	if ( ! $rs->eof ) {
		$count_param = $rs->row["count_param"];
	}
	echo ( pvs_price_format( $count_param, 2 ) );?>
						</td>
						</tr>
						</tbody>
                    </table>
                  </div>
                </div>
              </div>
