
        <div class="bottom-page-wrap">
            <div class="module-small bg-dark shop_isle_footer_sidebar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 footer-sidebar-wrap">
                            <?php
							if ( is_active_sidebar( 'sidebar-footer-area-1' ) ) {
								dynamic_sidebar( 'sidebar-footer-area-1' );
							} else {
							?>
								<aside class="widget widget_text">
									<h3 class="widget-title"><?php echo(pvs_word_lang("Media Stock"));?></h3>
									<div class="textwidget">
										<p><?php echo get_theme_mod( 'footer_text', 'Professional software for photographers and video producers.' ); ?></p>
										<p>Phone: <?php echo(pvs_settings_value( 'telephone' ));?></p>         
									</div>
								</aside>
                            <?php
							}
							?>
                        </div>
                        <div class="col-sm-6 col-md-3 footer-sidebar-wrap">
                        	<?php
							if ( is_active_sidebar( 'sidebar-footer-area-2' ) ) {
								dynamic_sidebar( 'sidebar-footer-area-2' );
							} else {
							?>
								<aside class="widget widget_text">
									<h3 class="widget-title"><?php echo(pvs_word_lang("Site info"));?></h3>
									<ul id="recentcomments">
										<?php echo(pvs_get_theme_content ('site_info'));?>
									</ul>
								</aside>
                            <?php
							}
							?>
                        </div>
                        
                        <div class="col-sm-6 col-md-3 footer-sidebar-wrap">
                        	<?php
							if ( is_active_sidebar( 'sidebar-footer-area-3' ) ) {
								dynamic_sidebar( 'sidebar-footer-area-3' );
							} else {
							?>
								<aside class="widget widget_text">
									<h3 class="widget-title"><?php echo(pvs_word_lang("Customers"));?></h3>
									<ul id="recentcomments">
										<li class="recentcomments"><a href="<?php echo (pvs_get_page_url('users'));?>"><?php echo(pvs_word_lang("Users"));?></a></li>
										<?php
										if (pvs_settings_value("credits")) {
											?>
											<li class="recentcomments"><a href="<?php echo (pvs_get_page_url('credits'));?>"><?php echo(pvs_word_lang("Buy Credits"));?></a></li>
											<?php 
										}
										if (pvs_settings_value("subscription")) {
											?>
											<li class="recentcomments"><a href="<?php echo (pvs_get_page_url('subscription'));?>"><?php echo(pvs_word_lang("Buy Subscription"));?></a></li>
											<?php
										}	
										?>
									</ul>
								</aside>
                            <?php
							}
							?>
                        </div>
                        
                        <div class="col-sm-6 col-md-3 footer-sidebar-wrap">
                        	<?php
							if ( is_active_sidebar( 'sidebar-footer-area-4' ) ) {
								dynamic_sidebar( 'sidebar-footer-area-4' );
							} else {
							?>
								<aside class="widget widget_text">
									<h3 class="widget-title"><?php echo(pvs_word_lang("Stats"));?></h3>
									<ul class="no_markers">
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
								</aside>
                            <?php
							}
							?>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer bg-dark">
                <hr class="divider-d">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="copyright font-alt">Copyright &copy; <?php echo get_theme_mod( 'footer_copyright_year', '2018' ); ?> <a href="<?php echo get_theme_mod( 'footer_copyright_link', 'https://www.cmsaccount.com/' ); ?>"><?php echo get_theme_mod( 'footer_copyright_text', 'Photo Video Store' ); ?></a> - <?php echo(pvs_word_lang("All rights reserved"));?></p>
                            <p class="shop-isle-poweredby-box">Theme: <a class=
                            "shop-isle-poweredby" href=
                            "http://themeisle.com/themes/shop-isle/" rel=
                            "nofollow">ShopIsle</a></p>
                        </div>
                        <div class="col-sm-6">
                            <div class="footer-social-links">
                                <a href="<?php echo(pvs_settings_value( 'facebook_link' ));?>"><span class=
                                "social_facebook"></span></a><a href=
                                "<?php echo(pvs_settings_value( 'twitter_link' ));?>"><span class=
                                "social_twitter"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="scroll-up">
        <a href="#totop"><i class="arrow_carrot-2up"></i></a>
    </div>
    <div style="display:none"></div>
    
    

    
        <script>
        check_carts('');
        </script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/js/jquery.prettyPhoto.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.1/jquery.flexslider.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.1.0/jquery.fitvids.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simple-text-rotator/1.0.0/jquery.simple-text-rotator.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-smooth-scroll/1.7.2/jquery.smooth-scroll.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/jquery.magnific-popup/1.0.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mb.YTPlayer/3.0.3/jquery.mb.YTPlayer.min.js"></script>
    <script src="<?php echo( get_template_directory_uri() ); ?>/assets/js/custom.js" type="text/javascript"></script>
	<script src="<?php echo( pvs_plugins_url() ); ?>/assets/js/jquery.colorbox-min.js" type="text/javascript"></script>  
	<?php
	wp_footer();
	?>
</body>
</html>