 <div class="clearfix">             
	<h1><?php echo($pvs_theme_content[ 'title' ]);?></h1>
	<ul class="path_corlate">
		<?php echo(pvs_get_social_meta_tags('path'));?>
	</ul>
</div>
    <div class="row">
    <div class="col-lg-7 col-md-7" style="min-width:600px">
        	<?php echo($pvs_theme_content[ 'preview' ]);?> 
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
			
			<div class='file_details'>
			<h5><?php echo(pvs_word_lang("Keywords"));?></h5>
			<?php echo($pvs_theme_content[ 'keywords_lite' ]);?>
			
			<hr />
			

		</div>
    </div>   

    <div class="col-lg-5 col-md-5 summary entry-summary">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
		<p><?php echo($pvs_theme_content[ 'author' ]);?> </p>
		<p><b>ID : <?php echo($pvs_theme_content[ 'id' ]);?></b></p>
		<p><?php if ($pvs_theme_content[ 'flag_ratio' ] ) {?>
				<span><b><?php echo(pvs_word_lang("aspect ratio"));?>:</b> <?php echo($pvs_theme_content[ 'ratio' ]);?></span>
			<?php }?></p>
		</div>
       
			<div class="col-lg-6 col-md-6 col-sm-6">
		<p><span><b><?php echo(pvs_word_lang("Category"));?>:</b> <?php echo($pvs_theme_content[ 'category' ]);?></span></p>
       	<div class="video_format"><?php if ($pvs_theme_content[ 'flag_format' ] ) {?>
				<p><span><b><?php echo(pvs_word_lang("clip format"));?>:</b> <?php echo($pvs_theme_content[ 'format' ]);?></span></p>
			<?php }?></div>
		<p><?php if ($pvs_theme_content[ 'flag_frames' ] ) {?>
				<span><b><?php echo(pvs_word_lang("frames per second"));?>:</b> <?php echo($pvs_theme_content[ 'frames' ]);?></span>
			<?php }?></p>
       	</div>
		</div>
       
       <hr / style="margin-bottom:0px">

		<?php if ($pvs_theme_content[ 'flag_exclusive' ] ) {?>
			<div class="editorial"><?php echo(pvs_word_lang("Exclusive price. The file will be removed from the stock after the purchase"));?></div>
		<?php }?>
		<div class="cart-actions">
			<div class="addto">
				<?php echo($pvs_theme_content[ 'sizes' ]);?>
			</div>
			
			<div style="clear:both"></div><br><br>
		</div>
		


      
       

    
		</div>
		
    
  </div>
<?php if ($pvs_theme_content[ 'flag_related' ]) {?> 
	<h2><?php echo(pvs_word_lang("Related items"));?></h2>
	<hr />
	<div class="container-fluid ">
		<div class="row">
		<?php pvs_show_related_items( get_query_var('pvs_id'), "show" );?>
	</div> 
	</div>
	<br>
	<br>
<?php }?> 
