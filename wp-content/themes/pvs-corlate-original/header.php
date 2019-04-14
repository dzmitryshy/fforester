<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('decription'); ?> <?php echo(pvs_get_social_meta_tags( 'meta_description' ));?>">
	<meta name="keywords" content="<?php echo(pvs_get_social_meta_tags( 'meta_keywords' ));?>">
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/css/prettyPhoto.min.css" rel="stylesheet">
    <link href="<?php echo( get_template_directory_uri() ); ?>/assets/css/main.css" rel="stylesheet">
    <link href="<?php echo( get_template_directory_uri() ); ?>/theme.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script src="<?php echo( get_template_directory_uri() ); ?>/custom.js" type="text/javascript"></script>
	<script src="<?php echo( pvs_plugins_url() ); ?>/assets/js/JsHttpRequest.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head><!--/head-->

<body <?php body_class( 'homepage' ); ?>>

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                	<div class="col-sm-2 col-xs-2 col-md-5 col-lg-5 header-lang dropdown">
                		<a data-toggle="dropdown" href="#" class="hidden-xs hidden-sm"><img src="<?php echo(pvs_get_theme_content ('lang_img'));?>" class="lang_img"><?php echo(pvs_get_theme_content ('lang_name'));?></a>
                		<a href="<?php echo (site_url( ) );?>/language-list/" class="hidden-md hidden-lg"><img src="<?php echo(pvs_get_theme_content ('lang_img'));?>" class="lang_img"></a>
						<div class="dropdown-menu lang_menu">
							<?php echo(pvs_get_theme_content ('languages_list'));?>
						</div>
                	</div>
                    <div class="col-sm-8 col-xs-6 col-md-4 col-lg-4 nopadding">
                       <form role="search" class="search-box" method="get" action="<?php echo (site_url( ) );?>/index.php" id="main_search">
							<div class="form-group has-feedback">
								<input id="search" name="search" type="text" class="form-control" placeholder="<?php echo(pvs_word_lang("Search"));?>..." autocomplete="off">
								<i class="fa fa-search form-control-feedback"></i>
							</div>
							<div id="instant_search"></div>
						</form>
                    </div>
                    <div class="col-md-1 col-lg-1">
                    
                    </div>
					<div class="col-sm-1 col-xs-2 col-md-1 col-lg-1">
						<div class="btn-group dropdown"  id="cart_desktop"></div>
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
					<div  class="col-sm-1 col-xs-2 col-md-1 col-lg-1 header-members dropdown">
						 <?php if (is_user_logged_in()) {
                    					$user_info  = get_userdata(get_current_user_id());
                    					?>	
                    					<div class='hidden-lg hidden-md'>
											<a href="<?php echo (pvs_get_page_url('profile'));?>"><i class="glyphicon glyphicon-user header-search-button"></i></a>
											<a href="<?php echo wp_logout_url(site_url()); ?>"><i class="glyphicon glyphicon-log-out header-search-button"></i></a>
										</div>
										<div class='hidden-xs hidden-sm'>
											<a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-user header-search-button"></i> <span class="hidden-xs hidden-sm"><?php echo(pvs_word_lang("Member area"));?></span></a>
											<div class="dropdown-menu members_menu">
												<ul  class="text-right">
													<li><a href="<?php echo (pvs_get_page_url('profile'));?>"><i class="fa fa-user"></i> <?php echo(pvs_word_lang("My profile"));?></a></li>
													<li><a href="<?php echo wp_logout_url(site_url()); ?>"><i class="fa fa-sign-out"></i> <?php echo(pvs_word_lang("Logout"));?> [<?php echo(pvs_show_user_name($user_info -> user_login));?>]?</a></li>
												</ul>
											</div>
										</div>
                    					<?php	
                    				} else {
                    					?>	
										<div class='hidden-lg hidden-md'>
											<a href="<?php echo (site_url( ) );?>/login/"><i class="glyphicon glyphicon-user header-search-button"></i></a>
										</div>
										<div class='hidden-xs hidden-sm'>
										<a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-user header-search-button"></i> <span class="hidden-xs hidden-sm"><?php echo(pvs_word_lang("Login"));?></span></a>
										<div class="dropdown-menu members_menu">
											<h5 class="white"><?php echo(pvs_word_lang("Member area"));?></h5>
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
										</div>
										</div>                    					
                    					<?php	                    				
                    				}
                    	 ?>
					</div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo (site_url( ) );?>/"><img src="<?php echo get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/logo.png' ); ?>"></a>
                </div>		
                <?php 
					//Show Photo Video Store menu from menu.php file.
					//get_template_part('menu');
					
					//Show Standard Wordpress menu
					$args = array(
						'theme_location'  => '',
						'menu'            => 'corlatemenu',
						'container'       => 'div',
						'container_class' => 'collapse navbar-collapse navbar-right',
						'container_id'    => '',
						'menu_class'      => 'nav navbar-nav',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'pvs_corlate_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0
					);
					wp_nav_menu($args);
					?>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->		