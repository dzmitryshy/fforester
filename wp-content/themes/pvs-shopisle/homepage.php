 	<div class="main">
    	<?php
    	if (get_theme_mod( 'hide_slideshow', '') == '') {
    	?>
        <section class="home-section home-parallax home-fade home-full-height"
        id="home">
            <div class="hero-slider">
                <ul class="slides">
                    <li class="bg-dark" style=
                    "background-image:url(<?php echo get_theme_mod( 'slider1_upload', get_template_directory_uri() . '/assets/images/slide1.jpg' ); ?>)">
                    <div class="home-slider-overlay"></div>
                        <div class="hs-caption">
                            <div class="caption-content">
                                <div class="hs-title-size-4 font-alt mb-30">
                                	<?php echo get_theme_mod( 'slider1_title', 'Photo Video Store Script' ); ?>
                                </div>
                                <div class="hs-title-size-1 font-alt mb-40">
                                    <?php echo get_theme_mod( 'slider1_description', 'The best way to sell your photos and prints online' ); ?>
                                </div><a class=
                                "section-scroll btn btn-border-w btn-round"
                                href="<?php echo get_theme_mod( 'slider1_button_link', site_url() . '/index.php?search=' ); ?>"><?php echo get_theme_mod( 'slider1_button_text', 'Browse catalog' ); ?></a>
                            </div>
                        </div>
                    </li>
                    <li class="bg-dark" style=
                    "background-image:url(<?php echo get_theme_mod( 'slider2_upload', get_template_directory_uri() . '/assets/images/slide2.jpg' ); ?>)">
                    <div class="home-slider-overlay"></div>
                        <div class="hs-caption">
                            <div class="caption-content">
                                <div class="hs-title-size-4 font-alt mb-30">
                                    <?php echo get_theme_mod( 'slider2_title', 'Shopisle Theme' ); ?>
                                    
                                </div>
                                <div class="hs-title-size-1 font-alt mb-40">
                                   <?php echo get_theme_mod( 'slider2_description', 'Modern responsive template' ); ?>
                                </div><a class=
                                "section-scroll btn btn-border-w btn-round"
                                href="<?php echo get_theme_mod( 'slider2_button_link', site_url() . '/index.php?sphoto=1' ); ?>"><?php echo get_theme_mod( 'slider2_button_text', 'View Photos' ); ?></a>
                            </div>
                        </div>
                    </li>
                    <li class="bg-dark" style=
                    "background-image:url(<?php echo get_theme_mod( 'slider3_upload', get_template_directory_uri() . '/assets/images/slide3.jpg' ); ?>)">
                    <div class="home-slider-overlay"></div>
                        <div class="hs-caption">
                            <div class="caption-content">
                                <div class="hs-title-size-4 font-alt mb-30">
                                    <?php echo get_theme_mod( 'slider3_title', 'Signup as photographer' ); ?>
                                </div>
                                <div class="hs-title-size-1 font-alt mb-40">
                                    <?php echo get_theme_mod( 'slider3_description', 'Upload images and earn commission' ); ?>
                                </div><a class=
                                "section-scroll btn btn-border-w btn-round"
                                href="<?php echo get_theme_mod( 'slider3_button_link', site_url() . '/signup/' ); ?>"><?php echo get_theme_mod( 'slider3_button_text', 'Sign Up' ); ?></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <?php
        }
    	?>
		
        <div class="main front-page-main" style="background-color: #FFF">
		
        	<?php
        	if (get_theme_mod( 'hide_banners', '') == '') {
        	?>
            <section class="module-small home-banners">
                <div class="container">
                    <div class="row shop_isle_bannerss_section">
                        <div class="col-sm-4">
                            <div class="content-box mt-0 mb-0">
                                <div class="content-box-image">
                                    <a href="#"><img src=
                                    "<?php echo get_theme_mod( 'banner1_upload', get_template_directory_uri() . '/assets/images/banner1.jpg' ); ?>"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="content-box mt-0 mb-0">
                                <div class="content-box-image">
                                    <a href="#"><img src=
                                    "<?php echo get_theme_mod( 'banner2_upload', get_template_directory_uri() . '/assets/images/banner2.jpg' ); ?>"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="content-box mt-0 mb-0">
                                <div class="content-box-image">
                                    <a href="#"><img src=
                                    "<?php echo get_theme_mod( 'banner3_upload', get_template_directory_uri() . '/assets/images/banner3.jpg' ); ?>"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
			}
			?>
			
			
		
			<!---------------griale-------------->
		<?php
    	if (get_theme_mod( 'hide_CatStock', '') == '') {
    	?>
		
        		<section class="module-small home-banners">
                <div class="container">
                    <div class="row shop_isle_bannerss_section">
                       
						<?php
			if (pvs_settings_value("allow_photo")) {
				?>
				 <div class="col-sm-3">
					<div class="inner-module photos">
						<a class="a" data-track="click.contentType.photos" href="<?php echo (site_url( ) );?>/index.php?sphoto=1">
						  <div class="img-wrap gradient">
							<img class="img w-12" src="<?php echo get_theme_mod( 'cat1_upload', get_template_directory_uri() . '/assets/images/slide1.jpg' ); ?>">
							<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/assets/images/icons/icon_photos.png' );">
							
						  </div>
						  <h4 class="h5 subtitle bold">
						  
						 <?php echo get_theme_mod( 'cat1_title', 'Photo Video Store Script' ); ?>
						  
						  </h4>
						  <p class="description hidden-xs">
						  
						  <?php echo get_theme_mod( 'cat1_description', 'The best way to sell your photos and prints online' ); ?>
						  
						  </p>
						</a>
					
					</div>
				</div>
				<?php 
			}
			if (pvs_settings_value("allow_video")) {
				?>
				<div class="col-sm-3">
					<div class="inner-module photos">
						<a class="a" data-track="click.contentType.photos" href="<?php echo (site_url( ) );?>/index.php?svideo=1">
						  <div class="img-wrap gradient">
							<img class="img w-12" src="<?php echo get_theme_mod( 'cat2_upload', get_template_directory_uri() . '/assets/images/slide2.jpg' ); ?>">
							<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/assets/images/icons/icon_video.png' );">
						  </div>
						  <h4 class="h5 subtitle bold">
						  
						 <?php echo get_theme_mod( 'cat2_title', 'Photo Video Store Script' ); ?>
						  
						  </h4>
						  <p class="description hidden-xs">
						  
						  <?php echo get_theme_mod( 'cat2_description', 'The best way to sell your photos and prints online' ); ?>
						  
						  </p>
						</a>
					
					</div>
				</div>
				<?php 
			}
			if (pvs_settings_value("allow_audio")) {
				?>
				<div class="col-sm-3">
					<div class="inner-module photos">
						<a class="a" data-track="click.contentType.photos" href="<?php echo (site_url( ) );?>/index.php?svector=4">
						  <div class="img-wrap gradient">
							<img class="img w-12" src="<?php echo get_theme_mod( 'cat3_upload', get_template_directory_uri() . '/assets/images/slide2.jpg' ); ?>">
							<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/assets/images/icons/icon_vectors.png' );">
						  </div>
						  <h4 class="h5 subtitle bold">
						  
						 <?php echo get_theme_mod( 'cat3_title', 'Photo Video Store Script' ); ?>
						  
						  </h4>
						  <p class="description hidden-xs">
						  
						  <?php echo get_theme_mod( 'cat3_description', 'The best way to sell your photos and prints online' ); ?>
						  
						  </p>
						</a>
					
					</div>
				</div>
				<?php 
			}
			if (pvs_settings_value("allow_vector")) {
				?>
				<div class="col-sm-3">
					<div class="inner-module photos">
						<a class="a" data-track="click.contentType.photos" href="<?php echo (site_url( ) );?>/index.php?svector=4">
						  <div class="img-wrap gradient">
							<img class="img w-12" src="<?php echo get_theme_mod( 'cat4_upload', get_template_directory_uri() . '/assets/images/slide2.jpg' ); ?>">
							<img class="icon" src="<?php echo( get_template_directory_uri() ); ?>/assets/images/icons/icon_audio.png' );">
						  </div>
						  <h4 class="h5 subtitle bold">
						  
						 <?php echo get_theme_mod( 'cat4_title', 'Photo Video Store Script' ); ?>
						  
						  </h4>
						  <p class="description hidden-xs">
						  
						  <?php echo get_theme_mod( 'cat4_description', 'The best way to sell your photos and prints online' ); ?>
						  
						  </p>
						</a>
					
					</div>
				</div>
				<?php
			}	
			if (pvs_settings_value("collections")) {
				?>
				<div class="col-sm-4"><li><a href='<?php echo (site_url( ) );?>/media-collections/'> <?php echo(pvs_word_lang("Collections"));?></a></li></div>
				<?php
			}
			if (pvs_settings_value("lightboxes")) {
			?>
				<div class="col-sm-4"><li><a href='<?php echo (site_url( ) );?>/lightboxes/'> <?php echo(pvs_word_lang("Lightboxes"));?></a></li></div>
			<?php
			}
			?>
            
                       
                       </div>
                </div>
            </section>
        
		
		<?php
        }
    	?>
			
			<!----------------end-griale---->
			
		
			<!---------------griale-------------->
		<section class="module-small home-banners">
                <div class="container">
                    <div class="row shop_isle_bannerss_section">
                       
						<ul class="sub-menu2">
						<?php echo(pvs_show_homepage_component(80));?>
						</ul>
                       
                       
                       </div>
                </div>
            </section>
			
			<!----------------end-griale---->
			<?php
        	if (get_theme_mod( 'hide_latest_images', '') == '') {
        	?>
            <hr class="divider-w">
            <section class="module-small" id="latest">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class=
                            "module-title font-alt product-hide-title"><?php echo get_theme_mod( 'latest_images_title', 'Latest
                            images' ); ?></h2>
                            <div class=
                            "module-subtitle font-serif home-prod-subtitle">
                                <?php echo get_theme_mod( 'latest_images_description', 'New photos' ); ?>
                            </div>
                        </div>
                    </div>
                    <ul class="products" style="padding-top:0px">
                    <?php echo(pvs_show_homepage_component(2));?>
                    </ul>
                    <div class="row mt-30">
                        <div class="col-sm-12 align-center">
                            <a class="btn btn-b btn-round" href=
                            "<?php echo get_theme_mod( 'latest_images_button_link', site_url( ) . '/index.php?sphoto=1' ); ?>"><?php echo get_theme_mod( 'latest_images_button', 'See all images' ); ?></a>
                        </div>
                    </div>
                </div>
            </section>
            <?php
			}
			?>
            <?php
        	if (get_theme_mod( 'hide_video', '') == '') {
        	?>
            <section class="module module-video bg-dark-30">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="module-title font-alt mb-0 video-title">
                            <?php echo get_theme_mod( 'youtube_text', 'BE INSPIRED. GET AHEAD OF TRENDS.' ); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="video-player" data-property=
                "{videoURL:'https://www.youtube.com/watch?v=<?php echo get_theme_mod( 'youtube_id', 'EMy5krGcoOU' ); ?>', containment:'.module-video', startAt:0, mute:true, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:25}">
                </div>
            </section>
            <?php
			}
			?>
			<?php
        	if (get_theme_mod( 'hide_featured_images', '') == '') {
        	?>
            <section class="home-product-slider">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class="module-title font-alt home-prod-title">
                            <?php echo get_theme_mod( 'featured_images_title', 'Featured
                            images' ); ?></h2>
                            <div class=
                            "module-subtitle font-serif home-prod-subtitle">
                                <?php echo get_theme_mod( 'featured_images_description', 'Exclusive content' ); ?>
                            </div>
                        </div>
                    </div>
					<ul class="products" style="padding-top:0px">
                    <?php echo(pvs_show_homepage_component(4));?>
                    </ul>
                </div>
            </section>
            <?php
			}
			?>
        </div>