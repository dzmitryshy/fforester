<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('decription'); ?> <?php echo(pvs_get_social_meta_tags( 'meta_description' ));?>">
	<meta name="keywords" content="<?php echo(pvs_get_social_meta_tags( 'meta_keywords' ));?>">
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" >
	<link href="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/css/prettyPhoto.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.1/flexslider.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
	<link href="<?php echo( get_template_directory_uri() ); ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?php echo( get_template_directory_uri() ); ?>/assets/css/woocommerce.css" rel="stylesheet">
	<link href="<?php echo( get_template_directory_uri() ); ?>/theme.css" rel="stylesheet">
	<link href="<?php echo( get_template_directory_uri() ); ?>/my.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script src="<?php echo( get_template_directory_uri() ); ?>/custom.js" type="text/javascript"></script>
	<script src="<?php echo( pvs_plugins_url() ); ?>/assets/js/JsHttpRequest.js" type="text/javascript"></script>
	<script data-cfasync="false" data-no-minify="1">
    (function(w,d){function a(){var b=d.createElement("script");b.async=!0;b.src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js";var a=d.getElementsByTagName("script")[0];a.parentNode.insertBefore(b,a)}w.attachEvent?w.attachEvent("onload",a):w.addEventListener("load",a,!1)})(window,document);
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'home blog woocommerce-active' ); ?>>
    <!--<div class="page-loader">
        <div class="loader">
            Loading...
        </div>
    </div>-->
    <nav class="navbar navbar-custom navbar-transparent navbar-fixed-top" role=
    "navigation">
        <div class="container">
            <div class="header-container">
                <div class="navbar-header">
                    <div class="shop_isle_header_title">
                        <div class="shop-isle-header-title-inner">
                            <h1 class="site-title"><a href=
                            "<?php echo (site_url( ) );?>/" rel="home"><?php echo get_theme_mod( 'logo_text', 'Photostore' ); ?></a></h1>
                        </div>
                    </div>
                    <div class="navbar-toggle" data-target="#custom-collapse"
                    data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span> <span class=
                        "icon-bar"></span> <span class="icon-bar"></span>
                    </div>
                </div>
                <div class="header-menu-wrap">
					<?php 
					//Show Photo Video Store menu from menu.php file.
					//get_template_part('menu');
					
					//Show Standard Wordpress menu
					$args = array(
						'theme_location'  => '',
						'menu'            => 'shopislemenu',
						'container'       => 'div',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'custom-collapse',
						'menu_class'      => 'nav navbar-nav navbar-right',
						'menu_id'         => 'menu-menu-1',
						'echo'            => true,
						'fallback_cb'     => 'pvs_shopisle_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0
					);
					wp_nav_menu($args);
					?>
                </div>
                <div class="navbar-cart">
                	<div class="header-lang dropdown hidden-xs hidden-sm">
                    	<a data-toggle="dropdown" href="#"><img src="<?php echo(pvs_get_theme_content ('lang_img'));?>" class="lang_img" alt="<?php echo(pvs_get_theme_content ('lang_name'));?>"></a>
                    	<div class="dropdown-menu lang_menu">
                    		<?php echo(pvs_get_theme_content ('languages_list'));?>
                    	</div>
                    </div>
                    <div  class="header-members dropdown hidden-xs hidden-sm">
                    	<div class=
                        "glyphicon glyphicon-user header-search-button" data-toggle="dropdown">
                        </div>
                    	<div class="dropdown-menu members_menu">	
                    		<?php if (is_user_logged_in()) {
                    						$user_info  = get_userdata(get_current_user_id());
                    		?> 
                    			<h5 class="white"><?php echo(pvs_word_lang("Member area"));?></h5>
								<a href="<?php echo (pvs_get_page_url('profile'));?>"><i class="fa fa-user"></i> <?php echo(pvs_word_lang("My profile"));?></a><br>
								<a href="<?php echo wp_logout_url(site_url()); ?>"><i class="fa fa-sign-out"></i> <?php echo(pvs_word_lang("Logout"));?> [<?php echo(pvs_show_user_name($user_info -> user_login));?>]?</a>
                    		<?php } else {?>
								 <h4><?php echo(pvs_word_lang("Member area"));?></h4>
								
									<form class="login-form margin-clear" method="post" action="<?php echo (site_url( ) );?>/wp-login.php">
										<div class="form_field">
											<input class="form-control" type="text" name="log" id="user_login" placeholder="<?php echo(pvs_word_lang("Username"));?>" value="" />
										</div>
										<div class="form_field">
											<input class="form-control" name="pwd" id="user_pass" type="password" placeholder="<?php echo(pvs_word_lang("Password"));?>" value="" />
										</div>
										<div class="form_field">
											<input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> <?php echo(pvs_word_lang("Remember me"));?>
										</div>
										<div class="form_field">
											<input type="submit" class="btn btn-md btn-primary" value="<?php echo(pvs_word_lang("Login"));?>" />
										</div>
									</form>
										<a href="<?php echo (pvs_get_page_url('forgot-password'));?>"><?php echo(pvs_word_lang("Forgot password"));?>?</a><br>
										<a href="<?php echo (pvs_get_page_url('signup'));?>"><?php echo(pvs_word_lang("Sign up"));?></a><br>								
								<hr />
								
								<h5 class="white"><?php echo(pvs_word_lang("Login without signup"));?></h5>
								<div class="sign-in">
									<ul class="social">
										<?php if (pvs_settings_value( 'auth_facebook' )) {?>
											<li><a href="<?php echo (site_url( ) );?>/check-facebook/"><i class="fa fa-facebook"></i></a></li>
										<?php }?>
										<?php if (pvs_settings_value( 'auth_twitter' )) {?>
											<li><a href="<?php echo (site_url( ) );?>/check-twitter/"><i class="fa fa-twitter"></i></a></li>
										<?php }?>
										<?php if (pvs_settings_value( 'auth_instagram' )) {?>
											<li><a href="<?php echo (site_url( ) );?>/check-instagram/"><i class="fa fa-instagram"></i></a></li>
										<?php }?>
										<?php if (pvs_settings_value( 'auth_vkontakte' )) {?>
											<li><a href="<?php echo (site_url( ) );?>/check-vk/"><i class="fa fa-vk"></i></a></li>
										<?php }?>
										<?php if (pvs_settings_value( 'auth_yandex' )) {?>
											<li><a href="<?php echo (site_url( ) );?>/check-yandex/"><i class="fa fa-yahoo"></i></a></li>
										<?php }?>
										<?php if (pvs_settings_value( 'auth_google' )) {?>
											<li><a href="<?php echo (site_url( ) );?>/check-google/"><i class="fa fa-google"></i></a></li>
										<?php }?>
									</ul>
								</div>
                    		<?php }?>
                    	</div>
                    </div>
                    <div class="header-search dropdown hidden-xs hidden-sm">
                        <div class=
                        "glyphicon glyphicon-search header-search-button" data-toggle="dropdown">
                        </div>
                        <div class="header-search-input dropdown-menu">
							<form action="<?php echo (site_url( ) );?>/index.php"
							class="woocommerce-product-search" method="get"
							role="search">
								<input class="search-field" type="search" id="search"  placeholder="<?php echo(pvs_word_lang("Search"));?>..." autocomplete="off" name="search">
								<input type="submit" value="<?php echo(pvs_word_lang("Search"));?>">
							</form>
							<div id="instant_search"></div>
						</div>
                    </div>
                    <div class="navbar-cart-inner  hidden-xs hidden-sm dropdown" id="cart_desktop"></div>
                        
                            <?php echo(pvs_get_theme_content ('shopping_cart_lite'));?>
										  <script>
											cart_word='<?php echo(pvs_word_lang("Cart"));?>';
											cart_word_checkout='<?php echo(pvs_word_lang("Checkout"));?>';
											cart_word_view='<?php echo(pvs_word_lang("View Cart"));?>';
											cart_word_subtotal='<?php echo(pvs_word_lang("Subtotal"));?>';
											cart_word_total='<?php echo(pvs_word_lang("Total"));?>';
											cart_word_qty='<?php echo(pvs_word_lang("Quantity"));?>';
											cart_word_item='<?php echo(pvs_word_lang("Item"));?>';
											cart_word_delete='<?php echo(pvs_word_lang("Delete"));?>';
											cart_currency1='<?php echo(pvs_currency(1));?>';
											cart_currency2='<?php echo(pvs_currency(2));?>';
											cart_site_root='<?php echo (site_url( ) );?>/';
										  </script>	
                    
                    
                </div>
            </div>
        </div>
    </nav>