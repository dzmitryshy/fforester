<?php
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

include ( "content_list_vars.php" );?>
<style>
/*New styles for the previews. It overwrites style.css file.*/
.item_list 
{ 
	width: <?php echo ( $pvs_global_settings["thumb_width"] + 20 )?>px;
}

.item_list_img
{
	width: <?php echo ( $pvs_global_settings["thumb_width"] + 20 )?>px;
	height: <?php echo ( $pvs_global_settings["thumb_width"] + 20 )?>px;
}

.item_list_text1,.item_list_text2,.item_list_text3,.item_list_text4
{
	width: <?php echo ( $pvs_global_settings["thumb_width"] + 20 )?>px;
}

<?php
if ( @$stock != "site" ) {
?>
	<?php
	if ( @$stock != "fotolia" and @$stock != "depositphotos" and @$stock !=
		"pixabay" ) {
?>
		.iviewed,.idownloaded
		{
		display:none;
		}
	<?php
	}
?>
	
	.action-control,.fa-heart-o,li.hb_lightbox
	{
	display:none;
	}
	
	.preview_listing
	{
	max-width:120px;
	max-height:120px;
	}
	
<?php
}
?>
</style>
<?php
if ( @$prints_flag ) {
?>
	<link href="<?php echo pvs_plugins_url()?>/includes/prints/style.css" rel="stylesheet">
	<?php
}
?>

<?php

$search_header = '<div class="row" id="search_columns"><div class="col-xl-3 col-lg-3 col-md-3 search_left">';
$search_middle = '</div><div class="col-xl-9 col-lg-9 col-md-9 search_right">';
$search_footer = '</div></div>';
?>


<?php
if ( $showmenu == 1 and $pvs_global_settings["left_search"] ) {
	echo ( $search_header );

	if ( $stock == 'site' ) {
		include ( "content_list_menu.php" );
	}

	if ( $stock == 'istockphoto' ) {
		include ( "content_list_menu_istockphoto.php" );
	}

	if ( $stock == 'shutterstock' ) {
		include ( "content_list_menu_shutterstock.php" );
	}

	if ( $stock == 'fotolia' ) {
		include ( "content_list_menu_fotolia.php" );
	}

	if ( $stock == 'depositphotos' ) {
		include ( "content_list_menu_depositphotos.php" );
	}

	if ( $stock == 'rf123' ) {
		include ( "content_list_menu_123rf.php" );
	}

	if ( $stock == 'bigstockphoto' ) {
		include ( "content_list_menu_bigstockphoto.php" );
	}

	if ( $stock == 'pixabay' ) {
		include ( "content_list_menu_pixabay.php" );
	}

	echo ( $search_middle );
}


//Show menu
include ( "content_list_menu_top.php" );


if ( $flow == 1 ) {
?>
	<script src="<?php echo(pvs_plugins_url() . '/assets/js/jquery.masonry.min.js'); ?>"></script>
	<script>
	$(document).ready(function(){
	
		$('#flow_body').masonry({
  		itemSelector: '.home_box'
		});
		
		$('.home_preview').each(function(){


     		$(this).animate({opacity:'1.0'},1);
   			$(this).mouseover(function(){
     		$(this).stop().animate({opacity:'0.6'},600);
    		});
    		$(this).mouseout(function(){
    		$(this).stop().animate({opacity:'1.0'},300);
    		});

    		
    		$(".hb_cart").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);

    		});

    		$(".hb_cart").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
 		
    		<?php
	if ( @$stock == "site" ) {
?>
    		 $(".hb_lightbox").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);
    		});

    		$(".hb_lightbox").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
    		<?php
	}
?>
    		
    		 $(".hb_free").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);
    		});

    		$(".hb_free").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
        

		});
	});
	</script>
	<?php
}

if ( $flow == 2 ) {
?>
	<script src="<?php echo pvs_plugins_url()?>/assets/js/collageplus/jquery.collagePlus.min.js"></script>
	<script src="<?php echo pvs_plugins_url()?>/assets/js/collageplus/extras/jquery.removeWhitespace.js"></script>
    <script src="<?php echo pvs_plugins_url()?>/assets/js/collageplus/extras/jquery.collageCaption.js"></script>
	<script>
	$(document).ready(function(){
	
	

	
		refreshCollagePlus();
		
		$('.home_preview').each(function(){
     		$(this).animate({opacity:'1.0'},1);
   			$(this).mouseover(function(){
     		$(this).stop().animate({opacity:'0.6'},600);
    		});
    		$(this).mouseout(function(){
    		$(this).stop().animate({opacity:'1.0'},300);
    		});
    	});
	});
	

	
	function refreshCollagePlus() {
    	$('.item_list_page').removeWhitespace().collagePlus({
        	'targetHeight'    : <?php echo $pvs_global_settings["height_flow"] ?>,
            'fadeSpeed'       : "slow",
            'effect'          : 'default',
            'direction'       : 'vertical',
            'allowPartialLastRow'       : true
    	});
	}
	
	// This is just for the case that the browser window is resized
    var resizeTimer = null;
    $(window).bind('resize', function() {
        if (resizeTimer) clearTimeout(resizeTimer);
        resizeTimer = setTimeout(refreshCollagePlus, 200);
    });

	</script>
	<style>

	.item_list_page img{
    	margin:10px;
    	padding:0px;
    	display:inline-block;
    	vertical-align:bottom;
    	opacity:1;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="<?php echo pvs_plugins_url()?>/assets/js/collageplus/css/transitions.css" media="all" />
	<?php
}

if ( $autopaging == 1 ) {
?>
	<script>
	str=2;
	flag_auto=true;
	res=" ";
	
	function auto_pvs_paging(page) {
		str=page;
	
    	var req = new JsHttpRequest();
   		 // Code automatically called on load finishing.
    	req.onreadystatechange = function() {
        if (req.readyState == 4) {
 		if(page==1)
 		{
			document.getElementById('flow_body').innerHTML =req.responseText;
			res=req.responseText;
		}
		else
		{
			document.getElementById('flow_body').innerHTML = document.getElementById('flow_body').innerHTML + req.responseText;
			res=req.responseText;
			check_carts('<?php echo pvs_word_lang( "in your cart" )?>');
		}

		<?php
		if ( $flow == 1 ) {
		?>
			$('#flow_body').masonry({
  			itemSelector: '.home_box'
			});
		
			$('#flow_body').masonry('reload') ;
			
		<?php
		}
		if ( $flow == 2 ) {
		?>
			refreshCollagePlus();
		<?php
		}
		?>
		
		
		$('.home_preview').each(function(){


     		$(this).animate({opacity:'1.0'},1);
   			$(this).mouseover(function(){
     		$(this).stop().animate({opacity:'0.6'},600);
    		});
    		$(this).mouseout(function(){
    		$(this).stop().animate({opacity:'1.0'},300);
    		});

    		
    		$(".hb_cart").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);

    		});

    		$(".hb_cart").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
    		
    		$(".hb_cart2").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);
    		});

    		$(".hb_cart2").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
 		
    		
    		 $(".hb_lightbox").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);
    		});

    		$(".hb_lightbox").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
    		
    		 $(".hb_free").mouseover(function(){
     			$(this).stop().animate({ opacity: 1}, 600);
    		});

    		$(".hb_free").mouseout(function(){
    			$(this).stop().animate({ opacity: 0.5}, 600);
    		});
        

		});


        }
    }
    req.open(null, '<?php echo site_url()?>/content-list-paging/', true);
    req.send( {<?php echo @$flow_vars
?>,str: str,id_parent:<?php echo (int)@$id_parent
?>} );
    str++;

	}
	
	
	$(document).ready(function(){
		$(window).scroll(function(){
			if($(document).height() - $(window).height() - $(window).scrollTop() <150) 
    		{
    			if(flag_auto)
    			{
					flag_auto=false;
					if(res!="")
					{
						auto_pvs_paging(str);
					}
    			}
    		}
    		else
    		{
    			flag_auto=true;
    		}
		});
	});
	</script>
	<?php
}
?>


<div class='item_list_page' id="flow_body" style="display:block">
	<?php
$search_content = pvs_word_lang( "not found" );

if ( $stock == 'site' ) {
	include ( "content_list_items.php" );
}

if ( $stock == 'istockphoto' ) {
	include ( "content_list_istockphoto.php" );
}

if ( $stock == 'shutterstock' ) {
	include ( "content_list_shutterstock.php" );
}

if ( $stock == 'fotolia' ) {
	include ( "content_list_fotolia.php" );
}

if ( $stock == 'depositphotos' ) {
	include ( "content_list_depositphotos.php" );
}

if ( $stock == 'rf123' ) {
	include ( "content_list_123rf.php" );
}

if ( $stock == 'bigstockphoto' ) {
	include ( "content_list_bigstockphoto.php" );
}

if ( $stock == 'pixabay' ) {
	include ( "content_list_pixabay.php" );
}

//Show result
echo ( $search_content );?>
</div>

<script>
check_carts('<?php echo pvs_word_lang( "in your cart" )?>');
</script>


<?php
//Stock results count
if ( $stock != 'site' ) {
	$paging_text = pvs_paging( ( int )@$stock_result_count, $str, $kolvo, $kolvo2,
		$redirect_page, pvs_build_variables( "str", "", false ), false, true );

	if ( ( int )@$stock_result_count > $kolvo and @$autopaging == 0 ) {
?>
	<div id="search_footer">
		<div id="search_paging2"><?php echo $paging_text
?></div>
	</div>
	<?php
	}
?>
	<script>
		function show_results_count() {
			$('#result_count').html('(<?php echo ( int )@$stock_result_count
?>)')
		}
		show_results_count()
	</script>
	<?php
} else
{
	if ( $record_count > $kolvo and @$autopaging == 0 ) {
?>
	<div id="search_footer">
		<div id="search_paging2"><?php echo $paging_text
?></div>
	</div>
	<?php
	}
}
?>


<?php
if ( $showmenu == 1 and $pvs_global_settings["left_search"] ) {
	echo ( $search_footer );
}
?>

