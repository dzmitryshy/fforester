<div class="collapse navbar-collapse navbar-right">
	<ul class="nav navbar-nav" id="menu">
		<li><a href="<?php echo (site_url( ) );?>/"><?php echo(pvs_word_lang("Home"));?></a></li>
		 <?php
				if (pvs_settings_value("allow_photo")) {
					?>
					<li><a href='<?php echo (site_url( ) );?>/?sphoto=1'> <?php echo(pvs_word_lang("Photo"));?></a></li>
					<?php 
				}
				if (pvs_settings_value("allow_video")) {
					?>
					<li><a href='<?php echo (site_url( ) );?>/?svideo=1'> <?php echo(pvs_word_lang("Video"));?></a></li>
					<?php 
				}
				if (pvs_settings_value("allow_audio")) {
					?>
					<li><a href='<?php echo (site_url( ) );?>/?saudio=1'> <?php echo(pvs_word_lang("Audio"));?></a></li>
					<?php 
				}
				if (pvs_settings_value("allow_vector")) {
					?>
					<li><a href='<?php echo (site_url( ) );?>/?svector=1'> <?php echo(pvs_word_lang("Vector"));?></a></li>
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
		<?php
		if (pvs_settings_value("prints") and PVS_LICENSE != 'Free') {
		?>
			<li class="dropdown"><a href='#'  class="dropdown-toggle" data-toggle="dropdown"> <?php echo(pvs_word_lang("Prints and Products"));?></a>
				<ul class="dropdown-menu">
				  <?php echo(pvs_get_theme_content ('prints_list'));?>
				 </ul>
			</li>
		<?php
		}	
		?>
		<li class="dropdown"><a href='<?php echo (pvs_get_page_url('categories'));?>'  class="dropdown-toggle" data-toggle="dropdown"> <?php echo(pvs_word_lang("Categories"));?></a>
			<ul class="dropdown-menu">
				<?php echo(pvs_get_theme_content ('box_categories'));?>
			</ul>
		</li>
		
	</ul>
</div>