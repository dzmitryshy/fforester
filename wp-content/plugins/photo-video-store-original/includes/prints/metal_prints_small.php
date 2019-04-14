<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
$pvs_theme_content[ 'print_content' ] = '<div class="home_box" style="border:0">
	
	<div class="metal_prints_small" style="background:url(\'' . $pvs_theme_content[ 'item_img2' ] . '\');background-size:cover;width:' . $pvs_theme_content[ 'width_prints' ] . 'px;height:' . $pvs_theme_content[ 'height_prints' ] . 'px">
		<a href="' . $pvs_theme_content[ 'print_url' ] . '"><img src="' . pvs_plugins_url() . '/assets/images/e.gif"  style="width:' . $pvs_theme_content[ 'width_prints' ] . 'px;height:' . $pvs_theme_content[ 'height_prints' ] . 'px"></a>
		<div class="metal_prints_small_left"></div>
		<div class="metal_prints_small_bottom"></div>
		<div class="metal_prints_small_shadow"></div>
	</div>';
	
if ( @$show_print_title == true) {
	$pvs_theme_content[ 'print_content' ] .= '<div class="acrylic_prints_title">
		<a href="' . $pvs_theme_content[ 'print_url' ] . '">' . $pvs_theme_content[ 'item_title' ] . '</a>
		<div class="price">' . $pvs_theme_content[ 'price' ] . '</div>
	</div>';
}

$pvs_theme_content[ 'print_content' ] .= '</div>';
?>