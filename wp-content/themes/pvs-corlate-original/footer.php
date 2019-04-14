	<section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                	<?php
                	if ( is_active_sidebar( 'sidebar-footer-area-1' ) ) {
                		dynamic_sidebar( 'sidebar-footer-area-1' );
                	} else {
					?>
						<div class="widget">
							<h3><?php echo(pvs_word_lang("Media Stock"));?></h3>
							<p><?php echo get_theme_mod( 'footer_text', 'Professional software for photographers and video producers.' ); ?></p>
							<p>Phone: <b><?php echo(pvs_settings_value( 'telephone' ));?></b></p>
						</div>    
					<?php
                    }
                    ?>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
               	 	<?php
                	if ( is_active_sidebar( 'sidebar-footer-area-2' ) ) {
                		dynamic_sidebar( 'sidebar-footer-area-2' );
                	} else {
					?>
						<div class="widget">
							<h3><?php echo(pvs_word_lang("Customers"));?></h3>
							<ul>
								<li><a href="<?php echo (pvs_get_page_url('users'));?>"><?php echo(pvs_word_lang("Users"));?></a></li>
								<?php
								if (pvs_settings_value("credits")) {
									?>
									<li><a href="<?php echo (pvs_get_page_url('credits'));?>"><?php echo(pvs_word_lang("Buy Credits"));?></a></li>
									<?php 
								}
								if (pvs_settings_value("subscription")) {
									?>
									<li><a href="<?php echo (pvs_get_page_url('subscription'));?>"><?php echo(pvs_word_lang("Buy Subscription"));?></a></li>
									<?php
								}	
								?>
							</ul>
						</div>   
                    <?php
                    }
                    ?>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                	<?php
                	if ( is_active_sidebar( 'sidebar-footer-area-3' ) ) {
                		dynamic_sidebar( 'sidebar-footer-area-3' );
                	} else {
					?>
						<div class="widget">
							<h3><?php echo(pvs_word_lang("Site info"));?></h3>
							<ul>
								<?php echo(pvs_get_theme_content ('site_info'));?>
							</ul>
						</div>    
                    <?php
                    }
                    ?>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                	<?php
                	if ( is_active_sidebar( 'sidebar-footer-area-4' ) ) {
                		dynamic_sidebar( 'sidebar-footer-area-4' );
                	} else {
					?>
						<div class="widget">
							<h3><?php echo(pvs_word_lang("Stats"));?></h3>
							<ul>
								<li><a href="<?php echo (pvs_get_page_url('users'));?>"><i class="fa fa-user"> </i> &nbsp;&nbsp; <?php echo(pvs_word_lang("Users"));?>: <?php echo(pvs_get_theme_content ('stats_users'));?></a></li>
								<?php if (pvs_settings_value( 'allow_photo' )) {?>
									<li><a href="<?php echo (site_url( ) );?>/index.php?sphoto=1"><i class="fa fa-photo"> </i> &nbsp;&nbsp;<?php echo(pvs_word_lang("Photos"));?>: <?php echo(pvs_get_theme_content ('stats_photo'));?></a></li>
								<?php }?>
								<?php if (pvs_settings_value( 'allow_video' )) {?>
									<li><a href="<?php echo (site_url( ) );?>/index.php?svideo=1"><i class="fa fa-video-camera"> </i> &nbsp;&nbsp; <?php echo(pvs_word_lang("Videos"));?>: <?php echo(pvs_get_theme_content ('stats_video'));?></a></li>
								<?php }?>
								<?php if (pvs_settings_value( 'allow_audio' )) {?>
									<li><a href="<?php echo (site_url( ) );?>/index.php?saudio=1"><i class="fa fa-music"> </i> &nbsp;&nbsp; <?php echo(pvs_word_lang("Audio"));?>: <?php echo(pvs_get_theme_content ('stats_audio'));?></a></li>
								<?php }?>
								<?php if (pvs_settings_value( 'allow_vector' )) {?>
									<li><a href="<?php echo (site_url( ) );?>/index.php?svector=1"><i class="fa fa-cubes"> </i> &nbsp;&nbsp;<?php echo(pvs_word_lang("Vector"));?>: <?php echo(pvs_get_theme_content ('stats_vector'));?></a></li>
								<?php }?>
							</ul>
						</div>  
					<?php
                    }
                    ?>
                </div><!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    Copyright &copy; <?php echo get_theme_mod( 'footer_copyright_year', '2018' ); ?> <a href="<?php echo get_theme_mod( 'footer_copyright_link', 'https://www.cmsaccount.com/' ); ?>"><?php echo get_theme_mod( 'footer_copyright_text', 'Photo Video Store' ); ?></a> - <?php echo(pvs_word_lang("All rights reserved"));?>
                </div>
                <div class="col-sm-3">
					<div class="social">
						<ul class="social-share">
							<li><a href="<?php echo(pvs_settings_value( 'facebook_link' ));?>" class="white"><i class="fa fa-facebook" style="color:#FFFFFF"></i></a></li>
							<li><a href="<?php echo(pvs_settings_value( 'twitter_link' ));?>" class="white"><i class="fa fa-twitter" style="color:#FFFFFF"></i></a></li>
							<li><a href="<?php echo(pvs_settings_value( 'google_link' ));?>" class="white"><i class="fa fa-google" style="color:#FFFFFF"></i></a></li> 
						</ul>
					</div>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
    <div class="gototop"></div>
	<script>check_carts('');</script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/js/jquery.prettyPhoto.min.js"></script>
    <script src="<?php echo( get_template_directory_uri() ); ?>/assets/js/main_second.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="<?php echo( pvs_plugins_url() ); ?>/assets/js/jquery.colorbox-min.js" type="text/javascript"></script>  
    <?php
	wp_footer();
	?>
</body>
</html>