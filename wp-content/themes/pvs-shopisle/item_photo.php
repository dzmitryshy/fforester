<div class="item_path">
	<ul>
		<li class="first"><a href="<?php echo (site_url( ) );?>/"><?php echo(pvs_word_lang("Home"));?></a></li>
		<?php echo(pvs_get_social_meta_tags('path'));?>
	</ul>
	<div class="clearfix"></div>
</div>
    <div class="row">
    <div class="col-lg-6 col-md-6" style="min-width:500px">
        	<?php echo($pvs_theme_content[ 'image' ]);?> 
        	<div class="file_links row">
        		<div class="col-lg-9 col-md-9">
        			<?php if ( $pvs_global_settings[ 'lightboxes' ]) {?>
						<a href="<?php echo($pvs_theme_content[ 'add_to_favorite_link' ]);?>" class="btn btn-success btn-sm"><i class="fa fa-heart"> </i> <?php echo(pvs_word_lang("add to favorite"));?></a> 
					<?php }?>
					<?php if ($pvs_theme_content[ 'flag_downloadsample' ] ) {?>
						<a href="<?php echo($pvs_theme_content[ 'downloadsample' ]);?>" class="btn btn-danger btn-sm"><i class="fa fa-download"> </i>  <?php echo(pvs_word_lang("Download Sample"));?></a>
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
			
			<span><b><?php echo(pvs_word_lang("Category"));?>:</b> <?php echo($pvs_theme_content[ 'category' ]);?></span>
			<span><b><?php echo(pvs_word_lang("Viewed"));?>:</b> <?php echo($pvs_theme_content[ 'viewed' ]);?></span>
			<span><b><?php echo(pvs_word_lang("Downloads"));?>:</b> <?php echo($pvs_theme_content[ 'downloads' ]);?></span>	
    </div>   

    <div class="col-lg-6 col-md-6 summary entry-summary" style="min-width:500px">
    
    	<h1 class="product_title entry-title"><?php echo($pvs_theme_content[ 'title' ]);?></h1>
		<div class="file_more">
		<div class="col-md-6"><span><b><?php echo(pvs_word_lang("Published"));?>:</b> <?php echo($pvs_theme_content[ 'published' ]);?></span></div>
		<div class="col-md-6 text-right"><span><b><?php echo(pvs_word_lang("Rating"));?>:</b> <?php echo($pvs_theme_content[ 'item_rating_new' ]);?></span></div>
		
		</div>
      <div class="row">
      	<div class="col-lg-4 col-md-4 col-sm-4"><?php echo($pvs_theme_content[ 'author' ]);?> </div>
       	<div class="col-lg-2 col-md-2 col-sm-2"><b>ID : <?php echo($pvs_theme_content[ 'id' ]);?></b></div>
       	<div class="col-lg-6 col-md-6 col-sm-6">
       		<div id="vote_dislike" class="dislike-btn dislike-h"><?php echo(pvs_word_lang("Dislike"));?> <?php echo($pvs_theme_content[ 'dislike' ]);?></div>
			<div id="vote_like" class="like-btn like-h"><?php echo(pvs_word_lang("Like"));?> <?php echo($pvs_theme_content[ 'like' ]);?></div>
       	</div>
       </div>
       
       <hr / style="margin-bottom:0px">

      	<?php if ($pvs_theme_content[ 'flag_editorial' ] ) {?>
			<div class="editorial"><?php echo(pvs_word_lang("files for editorial use only"));?></div>
		<?php }?>
		<?php if ($pvs_theme_content[ 'flag_exclusive' ] ) {?>
			<div class="editorial"><?php echo(pvs_word_lang("Exclusive price. The file will be removed from the stock after the purchase"));?></div>
		<?php }?>
		<div class="cart-actions">
			<div class="addto">
				<?php echo($pvs_theme_content[ 'sizes' ]);?>
			</div>
			
			<div style="clear:both"></div><br><br>
		</div>
   


      
        <ul class="nav nav-tabs  style-2" role="tablist" style="margin:0px;">
          <li class="active"><a href="#details" data-toggle="tab"><?php echo(pvs_word_lang("Description"));?></a></li>
		  
          <!--<li><a href="#exif_content" data-toggle="tab"  onclick="exif_show(< ?php echo($pvs_theme_content[ 'id' ]);?>);">EXIF</a></li>
          <li><a href="#comments_content" data-toggle="tab" onclick="reviews_show(< ?php echo($pvs_theme_content[ 'id' ]);?>);">< ?php echo(pvs_word_lang("Comments"));?></a></li>
          <li><a href="#tell_content" data-toggle="tab"  onclick="tell_show(< ?php echo($pvs_theme_content[ 'id' ]);?>);">< ?php echo(pvs_word_lang("Tell a friend"));?></a></li>
          <li><a href="#reviewscontent" data-toggle="tab"  onclick="map_show(< ?php echo($pvs_theme_content[ 'google_x' ]);?>,< ?php echo($pvs_theme_content[ 'google_y' ]);?>);">< ?php echo(pvs_word_lang("Google map"));?></a></li>-->
        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="details"><?php echo($pvs_theme_content[ 'description' ]);?></div>

          <!--<div class="tab-pane" id="exif_content"></div>     
          <div class="tab-pane" id="comments_content"></div>
          <div class="tab-pane" id="tell_content"></div>
          <div class="tab-pane" id="reviewscontent"></div>-->
          
        </div>

      <!--griale-->
	<div class="keywords_lite">
		<?php echo($pvs_theme_content[ 'keywords_lite' ]);?>
	</div>
	<!------------>
	<div class="share">
        <a href="http://www.facebook.com/sharer/sharer.php?s=100&p[title]=<?php echo($pvs_theme_content[ 'share_title' ]);?>&p[summary]=<?php echo($pvs_theme_content[ 'share_title' ]);?>&p[url]=<?php echo($pvs_theme_content[ 'share_url' ]);?>&&p[images][0]=<?php echo($pvs_theme_content[ 'share_image' ]);?>" target="_blank" class="btn btn-md btn-default">&nbsp;<i  class="fa fa-facebook"></i></a>
        <a href="http://twitter.com/home?status=<?php echo($pvs_theme_content[ 'share_url' ]);?>&title=<?php echo($pvs_theme_content[ 'share_title' ]);?>" target="_blank" class="btn btn-md btn-primary">&nbsp;<i  class="fa fa-twitter"></i></a> 
        <a href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php echo($pvs_theme_content[ 'share_url' ]);?>&title=<?php echo($pvs_theme_content[ 'share_title' ]);?>" target="_blank" class="btn btn-md btn-warning">&nbsp;<i  class="fa fa-google-plus"></i></a>
        <a href="http://pinterest.com/pin/create/button/?url=<?php echo($pvs_theme_content[ 'share_url' ]);?>&media=<?php echo($pvs_theme_content[ 'share_image' ]);?>&description=<?php echo($pvs_theme_content[ 'share_title' ]);?>" target="_blank" class="btn btn-md btn-danger">&nbsp;<i  class="fa fa-pinterest"></i></a>
	</div>		
			
	<!---/-->
    </div>
    
	
	
	
  </div>

<?php if ($pvs_theme_content[ 'flag_related' ]) {?> 
<hr />
<div class="products related">
	<h2><?php echo(pvs_word_lang("Related items"));?></h2>
	<ul class="products">
		<?php pvs_show_related_items( get_query_var('pvs_id'), "show" );?>
	</ul>
</div>
<?php }?> 
