	<section id="bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
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

                <div class="col-md-4 col-sm-6">
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

                <div class="col-md-4 col-sm-6">
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

              </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 hidden-xs hidden-sm">
				<div class="span10">
				
				<img src="/wp-content/uploads/content/belcard.png" width="750px"  alt="">&nbsp;&nbsp;
				
				<!-- begin WebMoney Transfer : attestation label -->
<a href="https://passport.webmoney.ru/asp/certview.asp?wmid=000000000000" target="_blank">
<img src="/wp-content/uploads/content/v_blue_on_white_ru.png" alt="Здесь находится аттестат нашего WM идентификатора 000000000000" border="0" /><br /><span style="font-size: 0,7em;">Проверить аттестат</span></a>
<!-- end WebMoney Transfer : attestation label -->
<!-- begin WebMoney Transfer : accept label -->
<a href="https://www.megastock.com/" target="_blank"><img src="https://www.webmoney.ru/img/icons/88x31_wm_blue.png" alt="www.megastock.com" border="0"/></a>
<!-- end WebMoney Transfer : accept label -->
				
				
			</div>
                   
                </div>
                <div class="col-sm-5">
					<div class="social">
						<ul class="social-share">
							<li><a href="<?php echo(pvs_settings_value( 'facebook_link' ));?>" class="white"><i class="fa fa-facebook" style="color:#FFFFFF"></i></a></li>
							
						
						<?php
$pharm_qrup = pvs_settings_value( 'twitter_link' );

						if (!empty($pharm_qrup)): ?>
   
        <li><a href="<?php echo(pvs_settings_value( 'twitter_link' ));?>" class="white"><i class="fa fa-twitter" style="color:#FFFFFF"></i></a></li>
   
<?php endif; ?>
						
						
							<li><a href="<?php echo(pvs_settings_value( 'instagram_link' ));?>" class="white"><i class="fa fa-instagram" style="color:#FFFFFF"></i></a></li>
							
						</ul>
					</div>
					 <div class="text-right">Copyright &copy; <?php echo get_theme_mod( 'footer_copyright_year', '2018' ); ?> 
					<a href="<?php echo get_theme_mod( 'footer_copyright_link', '/' ); ?>"><?php echo get_theme_mod( 'footer_copyright_text', 'Photo Video Store' ); ?></a> - <?php echo(pvs_word_lang("All rights reserved"));?>
					</div>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
    <div class="gototop"></div>
	<script>check_carts('');</script>
    <script src="<?php echo( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/js/jquery.prettyPhoto.min.js"></script>
    <script src="<?php echo( get_template_directory_uri() ); ?>/assets/js/main_second.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="<?php echo( pvs_plugins_url() ); ?>/assets/js/jquery.colorbox-min.js" type="text/javascript"></script>  
	
	<script type="text/javascript">
window.addEventListener("load",function(){
    var myLinks = document.querySelectorAll("#menu a");
    for(var i=0; i<myLinks.length; i++) if(location.href==myLinks[i].href) myLinks[i].parentNode.classList.add("active");
});
</script>

    <?php
	wp_footer();
	?>

</body>
</html>