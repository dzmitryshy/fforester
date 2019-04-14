<?php
    if (get_theme_mod( 'hide_slideshow', '') == '') {
?>
<section class="no-margin" id="main-slider">
        <div class="carousel slide" data-ride="carousel" id="carousel-slides">
            <ol class="carousel-indicators">
                <li data-target="#carousel-slides" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-slides" data-slide-to="1"></li>
                <li data-target="#carousel-slides" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">

                <div class="item active" style="background-image: url(<?php echo get_theme_mod( 'slider1_upload', get_template_directory_uri() . '/assets/images/slider/bg1.jpg' ); ?>)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1 white"><?php echo get_theme_mod( 'slider1_title', 'Photo Video Store Script' ); ?></h1>
                                    <h2 class="animation animated-item-2"><?php echo get_theme_mod( 'slider1_description', 'The best way to sell your photos and prints online' ); ?></h2>
                                    <a class="btn-slide animation animated-item-3" href="<?php echo get_theme_mod( 'slider1_button_link', site_url() . '/index.php?search=' ); ?>"><?php echo get_theme_mod( 'slider1_button_text', 'Browse catalog' ); ?></a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo( get_template_directory_uri() ); ?>/assets/images/slider/img1.png" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(<?php echo get_theme_mod( 'slider1_upload', get_template_directory_uri() . '/assets/images/slider/bg2.jpg' ); ?>)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1 white"><?php echo get_theme_mod( 'slider2_title', 'Corlate Theme' ); ?></h1>
                                    <h2 class="animation animated-item-2"> <?php echo get_theme_mod( 'slider2_description', 'Modern responsive template' ); ?></h2>
                                    <a class="btn-slide animation animated-item-3" href="<?php echo get_theme_mod( 'slider2_button_link', site_url() . '/index.php?sphoto=1' ); ?>"><?php echo get_theme_mod( 'slider2_button_text', 'View Photos' ); ?></a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo( get_template_directory_uri() ); ?>/assets/images/slider/img2.png" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(<?php echo get_theme_mod( 'slider1_upload', get_template_directory_uri() . '/assets/images/slider/bg3.jpg' ); ?>)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1 white"><?php echo get_theme_mod( 'slider3_title', 'Signup as photographer' ); ?></h1>
                                    <h2 class="animation animated-item-2"><?php echo get_theme_mod( 'slider3_description', 'Upload images and earn commission' ); ?></h2>
                                    <a class="btn-slide animation animated-item-3" href="<?php echo get_theme_mod( 'slider3_button_link', site_url() . '/signup/' ); ?>"><?php echo get_theme_mod( 'slider3_button_text', 'Sign Up' ); ?></a>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="<?php echo( get_template_directory_uri() ); ?>/assets/images/slider/img3.png" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
            </div><!--/.carousel-inner-->
      <a class="prev hidden-xs" href="#carousel-slides" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#carousel-slides" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
        </div><!--/.carousel-->

        

        
    </section><!--/#main-slider-->
<?php
}
?>    
   
<?php
if (get_theme_mod( 'hide_features', '') == '') {
?>
    <section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2><?php echo get_theme_mod( 'features_title', 'Features' ); ?></h2>
                <p class="lead"><?php echo get_theme_mod( 'features_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam' ); ?></p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa <?php echo get_theme_mod( 'icon1_icon', 'fa-bullhorn' ); ?>"></i>
                            <h2><?php echo get_theme_mod( 'icon1_title', 'Fresh and Clean' ); ?></h2>
                            <h3><?php echo get_theme_mod( 'icon1_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit' ); ?></h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa <?php echo get_theme_mod( 'icon2_icon', 'fa-comments' ); ?>"></i>
                            <h2><?php echo get_theme_mod( 'icon2_title', 'Retina ready' ); ?></h2>
                            <h3><?php echo get_theme_mod( 'icon2_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit' ); ?></h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa <?php echo get_theme_mod( 'icon3_icon', 'fa-cloud-download' ); ?>"></i>
                            <h2><?php echo get_theme_mod( 'icon3_title', 'Easy to customize' ); ?></h2>
                            <h3><?php echo get_theme_mod( 'icon3_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit' ); ?></h3>
                        </div>
                    </div><!--/.col-md-4-->
                
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa <?php echo get_theme_mod( 'icon4_icon', 'fa-leaf' ); ?>"></i>
                            <h2><?php echo get_theme_mod( 'icon4_title', 'Adipisicing elit' ); ?></h2>
                            <h3><?php echo get_theme_mod( 'icon4_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit' ); ?></h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa <?php echo get_theme_mod( 'icon5_icon', 'fa-cogs' ); ?>"></i>
                            <h2><?php echo get_theme_mod( 'icon5_title', 'Sed do eiusmod' ); ?></h2>
                            <h3><?php echo get_theme_mod( 'icon5_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit' ); ?></h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa <?php echo get_theme_mod( 'icon6_icon', 'fa-heart' ); ?>"></i>
                            <h2><?php echo get_theme_mod( 'icon6_title', 'Labore et dolore' ); ?></h2>
                            <h3><?php echo get_theme_mod( 'icon6_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit' ); ?></h3>
                        </div>
                    </div><!--/.col-md-4-->
                </div><!--/.services-->
            </div><!--/.row-->    
        </div><!--/.container-->
    </section><!--/#feature-->
<?php
}
if (get_theme_mod( 'hide_latest_images', '') == '') {
?>

    <section id="recent-works">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2><?php echo get_theme_mod( 'latest_images_title', 'Latest images' ); ?></h2>
                <p class="lead"><?php echo get_theme_mod( 'latest_images_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam' ); ?></p>
            </div>

            <div class="row">
            	<?php echo(pvs_show_homepage_component(2));?>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#recent-works-->
 <?php
 }
 ?>   
<script>check_carts('');</script>







