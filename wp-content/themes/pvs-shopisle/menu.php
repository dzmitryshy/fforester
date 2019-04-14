<div class="collapse navbar-collapse" id="custom-collapse">
	<ul class="nav navbar-nav navbar-right" id=
	"menu-menu-1">
	<li class="menu-item menu-item-has-children"><a href='<?php echo (site_url( ) );?>/index.php?search='> <?php echo(pvs_word_lang("Stock"));?></a>
		<ul class="sub-menu">
		  <?php
			if (pvs_settings_value("allow_photo")) {
				?>
				<li><a href='<?php echo (site_url( ) );?>/index.php?sphoto=1'> <?php echo(pvs_word_lang("Photo"));?></a></li>
				<?php 
			}
			if (pvs_settings_value("allow_video")) {
				?>
				<li><a href='<?php echo (site_url( ) );?>/index.php?svideo=1'> <?php echo(pvs_word_lang("Video"));?></a></li>
				<?php 
			}
			if (pvs_settings_value("allow_audio")) {
				?>
				<li><a href='<?php echo (site_url( ) );?>/index.php?saudio=1'> <?php echo(pvs_word_lang("Audio"));?></a></li>
				<?php 
			}
			if (pvs_settings_value("allow_vector")) {
				?>
				<li><a href='<?php echo (site_url( ) );?>/index.php?svector=1'> <?php echo(pvs_word_lang("Vector"));?></a></li>
				<?php
			}	
			if (pvs_settings_value("collections")) {
				?>
				<li><a href='<?php echo (site_url( ) );?>/media-collections/'> <?php echo(pvs_word_lang("Collections"));?></a></li>
				<?php
			}
			if (pvs_settings_value("lightboxes")) {
			?>
				<li><a href='<?php echo (site_url( ) );?>/lightboxes/'> <?php echo(pvs_word_lang("Lightboxes"));?></a></li>
			<?php
			}
			?>
		 </ul>
	</li>
	<?php
	if (pvs_settings_value("prints") and PVS_LICENSE != 'Free') {
		?>
		<li class="menu-item menu-item-has-children"><a href='#'> <?php echo(pvs_word_lang("Prints and Products"));?></a>
			<ul class="sub-menu">
			  <?php echo(pvs_get_theme_content ('prints_categories_list'));?>
			 </ul>
		</li>
		<?php
	}	
	?>
	<li class="menu-item menu-item-has-children"><a href='<?php echo (pvs_get_page_url('categories'));?>'> <?php echo(pvs_word_lang("Categories"));?></a>
		<?php echo(pvs_get_theme_content ('box_categories'));?>
	</li>
	<li class="menu-item menu-item-has-children"><a href='#'> <?php echo(pvs_word_lang("Site info"));?></a>
			<ul class="sub-menu">
				<?php echo(pvs_get_theme_content ('site_info'));?>
				<li><a href='<?php echo (pvs_get_page_url('contacts'));?>'> <?php echo(pvs_word_lang("contacts"));?></a></li>
				<li><a href='<?php echo (pvs_get_page_url('google-map'));?>'> <?php echo(pvs_word_lang("Google map"));?></a></li>
			</ul>
	</li>
			
	
	<li class="menu-item hidden-md hidden-lg"><a href='<?php echo (pvs_get_page_url('cart'));?>'> <?php echo(pvs_word_lang("Shopping cart"));?></a></li>
	<li class="menu-item hidden-md hidden-lg"><a href='<?php echo (pvs_get_page_url('profile'));?>'> <?php echo(pvs_word_lang("Member area"));?></a></li>
	<li class="menu-item hidden-md hidden-lg"><a href="<?php echo (pvs_get_page_url('languages'));?>" class="hidden-md hidden-lg"><img src="<?php echo(pvs_get_theme_content ('lang_img'));?>" class="lang_img"> <?php echo(pvs_get_theme_content ('lang_name'));?></a></li>
	<li class="menu-item hidden-md hidden-lg">
	<form action="<?php echo (site_url( ) );?>/index.php" method="get">
		<div class="input-group">
		  <input type="text" class="form-control"  type="search" id="search" name="search" placeholder="<?php echo(pvs_word_lang("search"));?>">
		  <span class="input-group-btn">
			 <button class="btn btn-primary" type="button">OK</button>
		  </span>
		</div>
	</form><br>
	</li>
</ul>
</div>



