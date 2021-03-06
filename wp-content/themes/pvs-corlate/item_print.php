<script>
//Print type
print_type = "<?php echo($pvs_theme_content[ 'print_type' ]);?>";

//Big preview size
print_width = <?php echo($pvs_theme_content[ 'big_width_prints' ]);?>;
print_height = <?php echo($pvs_theme_content[ 'big_height_prints' ]);?>;
print_image ="<?php echo($pvs_theme_content[ 'print_preview' ]);?>";

//Overlay image size
image_width = <?php echo($pvs_theme_content[ 'width_print_preview' ]);?>;
image_height = <?php echo($pvs_theme_content[ 'height_print_preview' ]);?>;

//Default image size
default_width = <?php echo($pvs_theme_content[ 'default_width' ]);?>;
default_height = <?php echo($pvs_theme_content[ 'default_height' ]);?>;

//Site root
site_root = "<?php echo (pvs_plugins_url());?>/";
site_root2 = "<?php echo (site_url());?>/";

//Default settings
$(function() {
	<?php echo($pvs_theme_content[ 'default_js_functions' ]);?>
});


//Image preupload
$.preloadImages = function() {
  for (var i = 0; i < arguments.length; i++) {
    $("<img />").attr("src", arguments[i]);
  }
}
$.preloadImages(print_image);

<?php echo($pvs_theme_content[ 'preloaded_frames' ]);?>
<?php echo($pvs_theme_content[ 'preloaded_tshirts' ]);?>

</script>
<script src="<?php echo(pvs_plugins_url());?>/includes/prints/prints.js"></script>


<div style="margin:40px auto 40px auto;display:table;">
	<h1><?php echo($pvs_theme_content[ 'print_title' ]);?>: <?php echo($pvs_theme_content[ 'title' ]);?></h1>
	<?php echo($pvs_theme_content[ 'image' ]);?>
	<div class="print_wrap"></div>
	<div class="print_border_left print_display"></div>
	<div class="print_border_top print_display"></div>
	<div class="print_border_right print_display"></div>
	<div class="print_border_bottom print_display"></div>
	<div class="print_border_left2 print_display"></div>
	<div class="print_border_top2 print_display"></div>
	<div class="print_border_right2 print_display"></div>
	<div class="print_border_bottom2 print_display"></div> 
	
	<div class="clearfix"></div>
		<div class="file_links row">
			<div class="col-lg-9 col-md-9">
				<?php if ( $pvs_global_settings[ 'lightboxes' ]) {?>
					<a href="<?php echo($pvs_theme_content[ 'add_to_favorite_link' ]);?>" class="btn btn-success btn-sm"><i class="fa fa-heart"> </i> <?php echo(pvs_word_lang("add to favorite"));?></a> 
				<?php }?>
			</div>
			<div class="col-lg-3 col-md-3 next_previous">
				<?php if ($pvs_theme_content[ 'flag_previous' ] ) {?>
					<a href="<?php echo($pvs_theme_content[ 'previous_link' ]);?>" title="<?php echo(pvs_word_lang("Previous"));?>"><i class="fa fa-arrow-circle-left"></i></a>&nbsp;&nbsp;&nbsp;
				<?php }?>
				<?php if ($pvs_theme_content[ 'flag_next' ] ) {?>
					<a href="<?php echo($pvs_theme_content[ 'next_link' ]);?>" title="<?php echo(pvs_word_lang("Next"));?>"><i class="fa fa-arrow-circle-right"></i></a>
				<?php }?>
			</div>
		</div>	
</div>
<hr />

<div class="row transitionfx">
    <div class="col-lg-6 col-md-6" style="padding-right:50px">
      
      <div class="row">
      	<div class="col-lg-4 col-md-4 col-sm-4"><?php echo($pvs_theme_content[ 'author' ]);?> </div>
       	<div class="col-lg-2 col-md-2 col-sm-2"><b>ID : <?php echo($pvs_theme_content[ 'id' ]);?></b></div>
       	<div class="col-lg-6 col-md-6 col-sm-6">
       		<div id="vote_dislike" class="dislike-btn dislike-h"><?php echo(pvs_word_lang("Dislike"));?> <?php echo($pvs_theme_content[ 'dislike' ]);?></div>
			<div id="vote_like" class="like-btn like-h"><?php echo(pvs_word_lang("Like"));?> <?php echo($pvs_theme_content[ 'like' ]);?></div>
       	</div>
       </div>
		   
		   <hr />
			
			<div class='file_details'>
			<p><?php echo(pvs_word_lang("Keywords"));?></p>
			<?php echo($pvs_theme_content[ 'keywords_lite' ]);?>
			
			<hr />
			

			
			<p><?php echo(pvs_word_lang("File details"));?></p>
			<span><b><?php echo(pvs_word_lang("Published"));?>:</b> <?php echo($pvs_theme_content[ 'published' ]);?></span>
			<span><b><?php echo(pvs_word_lang("Rating"));?>:</b> <?php echo($pvs_theme_content[ 'item_rating_new' ]);?></span>
			<span><b><?php echo(pvs_word_lang("Category"));?>:</b> <?php echo($pvs_theme_content[ 'category' ]);?></span>
		</div>
		
		<br><br>
		
		 <div class="product-tab w100 clearfix">
      
        <ul class="nav nav-tabs  style-2" role="tablist" style="margin:0px;">
          <li class="active"><a href="#details" data-toggle="tab"><?php echo(pvs_word_lang("Description"));?></a></li>
          <li><a href="#comments_content" data-toggle="tab" onclick="reviews_show(<?php echo($pvs_theme_content[ 'id' ]);?>);"><?php echo(pvs_word_lang("Comments"));?></a></li>
          <li><a href="#tell_content" data-toggle="tab"  onclick="tell_show(<?php echo($pvs_theme_content[ 'id' ]);?>);"><?php echo(pvs_word_lang("Tell a friend"));?></a></li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="details"><?php echo($pvs_theme_content[ 'description' ]);?></div>
          <div class="tab-pane" id="comments_content"></div>
          <div class="tab-pane" id="tell_content"></div>
          
        </div>
        
      </div>
      
      <div style="clear:both"></div>
		
    </div>   

    <div class="col-lg-6 col-md-6" style="padding-left:50px">

				<?php if ($pvs_theme_content[ 'flag_resize' ]) {?> 
					<h4><?php echo(pvs_word_lang("Image size"));?>:</h4>
					<script type="text/javascript">
						$(document).ready(function() {
							 $("#slide1").slider({
								min: <?php echo($pvs_theme_content[ 'resize_min' ]);?>,
								max: <?php echo($pvs_theme_content[ 'resize_max' ]);?>,
								value:<?php echo($pvs_theme_content[ 'resize_value' ]);?>,
								slide: function( event, ui ) {
											$( "#print_size" ).val(ui.value);
											show_image();
										}
							});
						});
					</script>
		
					<div id="slide1"></div> 
					<input type="hidden" id="print_size" value="<?php echo($pvs_theme_content[ 'resize_value' ]);?>">
				<?php }?> 
				
				<form name="print_form" id="print_form" action="<?php echo (site_url( ) );?>/shopping-cart-add-print/"  enctype="multipart/form-data">
				<?php echo($pvs_theme_content[ 'properties' ]);?>
				
				<hr />
				<div class="row">
   					<div class="col-lg-6 col-md-6">
   						<h4><?php echo(pvs_word_lang("price"));?></h4>
   						<div id="print_price" class="price" style="font-size:17px"><?php echo($pvs_theme_content[ 'price' ]);?></div>
   					</div>
   					<div class="col-lg-6 col-md-6">
   						<input type="submit" class="add_to_cart" value="<?php echo($pvs_theme_content[ 'add_to_cart' ]);?>">
   					</div>
   				</div>
   				</form>

			
			<div style="clear:both"></div><br><br>

      
     
      
      <div class="clearfix"></div>
        <p> <?php echo(pvs_word_lang("Share"));?> </p>
        <div class="socialIcon"> 
        <a href="http://www.facebook.com/sharer/sharer.php?s=100&p[title]=<?php echo($pvs_theme_content[ 'share_title' ]);?>&p[summary]=<?php echo($pvs_theme_content[ 'share_title' ]);?>&p[url]=<?php echo($pvs_theme_content[ 'share_url' ]);?>&&p[images][0]=<?php echo($pvs_theme_content[ 'share_image' ]);?>" target="_blank" class="btn btn-md btn-default">&nbsp;<i  class="fa fa-facebook"></i></a>
        <a href="http://twitter.com/home?status=<?php echo($pvs_theme_content[ 'share_url' ]);?>&title=<?php echo($pvs_theme_content[ 'share_title' ]);?>" target="_blank" class="btn btn-md btn-primary">&nbsp;<i  class="fa fa-twitter"></i></a> 
        <a href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php echo($pvs_theme_content[ 'share_url' ]);?>&title=<?php echo($pvs_theme_content[ 'share_title' ]);?>" target="_blank" class="btn btn-md btn-warning">&nbsp;<i  class="fa fa-google-plus"></i></a>
        <a href="http://pinterest.com/pin/create/button/?url=<?php echo($pvs_theme_content[ 'share_url' ]);?>&media=<?php echo($pvs_theme_content[ 'share_image' ]);?>&description=<?php echo($pvs_theme_content[ 'share_title' ]);?>" target="_blank" class="btn btn-md btn-danger">&nbsp;<i  class="fa fa-pinterest"></i></a>
		
      </div>
      
    </div>
    
  </div>
<?php if ($pvs_theme_content[ 'flag_related_prints' ]) {?> 
  <div class="row recommended">
  <hr />
 	<h2> <?php echo(pvs_word_lang("Other prints and products"));?> </h2>
 	<div class="clearfix">
  		<?php pvs_show_related_prints( get_query_var('pvs_id'), get_query_var('pvs_print_id'),$pvs_theme_content[ 'title' ], "show" );?>
    </div> 
  </div>
<?php }?> 

  <div style="clear:both"></div>