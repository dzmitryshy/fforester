<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
 
//Content width 
if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

//Body class
add_filter('body_class','pvs_body_class');
function pvs_body_class( $classes ) {

	foreach ( $classes as $key => $value ) {
		unset($classes[$key]);
	}

	$classes[] = 'home';
	$classes[] = 'blog';
	$classes[] = 'woocommerce-active';

	return $classes;
}

//Js scripts
function pvs_theme_js_scripts() {
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pvs_theme_js_scripts' );


//The theme supports:
add_theme_support( 'menus' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
add_theme_support( 'post-formats', array(
		'aside'
	) );


//Disable top admin panel
add_filter('show_admin_bar', '__return_false');


//Widgets
function pvs_widgets(){
	register_sidebar( array(
		'name'          => __( 'Footer area 1', 'pvs-shopisle' ),
		'id'            => 'sidebar-footer-area-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer area 2', 'pvs-shopisle' ),
		'id'            => 'sidebar-footer-area-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer area 3', 'pvs-shopisle' ),
		'id'            => 'sidebar-footer-area-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer area 4', 'pvs-shopisle' ),
		'id'            => 'sidebar-footer-area-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'pvs_widgets' );
//End. Widgets

//Menu
register_nav_menus( array(
	'shopislemenu' => __( 'Shopisle Menu', 'pvs-shopisle' )
) );

function pvs_shopisle_menu() {
	get_template_part('menu');
}




//Theme header/footer for internal pages
$pvs_theme_header = '<div class="container second_page">' ;
$pvs_theme_footer = '</div>';




//Customize
function pvs_shopisle_customize($wp_customize) {

	//Logo
    $wp_customize->add_section(
        'pvs_shopisle_logo',
        array(
            'title' => 'Logo',
            'description' => '',
            'priority' => 1,
        )
    );
    
    $wp_customize->add_setting(
		'logo_text',
		array(
			'default' => 'Photostore',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'logo_text',
		array(
			'label' => 'Logo text',
			'section' => 'pvs_shopisle_logo',
			'type' => 'text',
		)
	);
	//End. Logo
	
	//Slideshow
	$wp_customize->add_section(
        'pvs_shopisle_slideshow',
        array(
            'title' => 'Homepage Slideshow',
            'description' => '',
            'priority' => 2,
        )
    );
    
    $wp_customize->add_setting(
		'hide_slideshow'
	);
	
	$wp_customize->add_control(
		'hide_slideshow',
		array(
			'label' => 'Hide Slideshow',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'checkbox',
		)
	);
    
    //Slide 1
    $wp_customize->add_setting( 
    	'slider1_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slide1.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'slider1_upload',
			array(
				'label' => 'Slide 1 Upload',
				'section' => 'pvs_shopisle_slideshow',
				'settings' => 'slider1_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'slider1_title',
		array(
			'default' => 'Photo Video Store Script',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider1_title',
		array(
			'label' => 'Slide 1 Title',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider1_description',
		array(
			'default' => 'The best way to sell your photos and prints online',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider1_description',
		array(
			'label' => 'Slide 1 Description',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider1_button_text',
		array(
			'default' => 'Browse catalog',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider1_button_text',
		array(
			'label' => 'Slide 1 Button text',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider1_button_link',
		array(
			'default' => site_url() . '/index.php?search=',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider1_button_link',
		array(
			'label' => 'Slide 1 Button link',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	//End. Slide 1
	
	//Slide 2
	$wp_customize->add_setting( 
    	'slider2_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slide2.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'slider2_upload',
			array(
				'label' => 'Slide 2 Upload',
				'section' => 'pvs_shopisle_slideshow',
				'settings' => 'slider2_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'slider2_title',
		array(
			'default' => 'Shopisle Theme',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider2_title',
		array(
			'label' => 'Slide 2 Title',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider2_description',
		array(
			'default' => 'Modern responsive template',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider2_description',
		array(
			'label' => 'Slide 2 Description',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider2_button_text',
		array(
			'default' => 'View Photos',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider2_button_text',
		array(
			'label' => 'Slide 2 Button text',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider2_button_link',
		array(
			'default' => site_url() . '/index.php?sphoto=1',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider2_button_link',
		array(
			'label' => 'Slide 2 Button link',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	//End. Slide 2
	
	//Slide 3
	$wp_customize->add_setting( 
    	'slider3_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slide3.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'slider3_upload',
			array(
				'label' => 'Slide 3 Upload',
				'section' => 'pvs_shopisle_slideshow',
				'settings' => 'slider3_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'slider3_title',
		array(
			'default' => 'Signup as photographer',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider3_title',
		array(
			'label' => 'Slide 3 Title',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider3_description',
		array(
			'default' => 'Upload images and earn commission',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider3_description',
		array(
			'label' => 'Slide 3 Description',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider3_button_text',
		array(
			'default' => 'Sign up',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider3_button_text',
		array(
			'label' => 'Slide 3 Button text',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider3_button_link',
		array(
			'default' => site_url() . '/signup/',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider3_button_link',
		array(
			'label' => 'Slide 3 Button link',
			'section' => 'pvs_shopisle_slideshow',
			'type' => 'text',
		)
	);
	//End. Slide 3
	//End. Slideshow
	
	
	//Banners
	$wp_customize->add_section(
        'pvs_shopisle_banners',
        array(
            'title' => 'Homepage Banners',
            'description' => '',
            'priority' => 3,
        )
    );
    
    $wp_customize->add_setting(
		'hide_banners'
	);
	
	$wp_customize->add_control(
		'hide_banners',
		array(
			'label' => 'Hide banners',
			'section' => 'pvs_shopisle_banners',
			'type' => 'checkbox',
		)
	);
    
    $wp_customize->add_setting( 
    	'banner1_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/banner1.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'banner1_upload',
			array(
				'label' => 'Banner 1',
				'section' => 'pvs_shopisle_banners',
				'settings' => 'banner1_upload'
			)
		)
	);
	
	$wp_customize->add_setting( 
    	'banner2_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/banner2.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'banner2_upload',
			array(
				'label' => 'Banner 2',
				'section' => 'pvs_shopisle_banners',
				'settings' => 'banner2_upload'
			)
		)
	);
	
	$wp_customize->add_setting( 
    	'banner3_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/banner3.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'banner3_upload',
			array(
				'label' => 'Banner 3',
				'section' => 'pvs_shopisle_banners',
				'settings' => 'banner3_upload'
			)
		)
	);
	//End. Banners
	
		//Functions Cat Stock
	$wp_customize->add_section(
        'pvs_shopisle_catstock',
        array(
            'title' => 'Homepage CatStock',
            'description' => '',
            'priority' => 3,
        )
    );
    
    $wp_customize->add_setting(
		'hide_CatStock'
	);
	
	$wp_customize->add_control(
		'hide_CatStock',
		array(
			'label' => 'Hide CatStock',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'checkbox',
		)
	);
    
    //Cat 1
    $wp_customize->add_setting( 
    	'cat1_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slide1.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'cat1_upload',
			array(
				'label' => 'Photo Upload',
				'section' => 'pvs_shopisle_catstock',
				'settings' => 'cat1_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'cat1_title',
		array(
			'default' => 'Photo Video Store Script',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat1_title',
		array(
			'label' => 'Photo Title',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat1_description',
		array(
			'default' => 'The best way to sell your photos and prints online',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat1_description',
		array(
			'label' => 'Photo Description',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat1_button_text',
		array(
			'default' => 'Browse catalog',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat1_button_text',
		array(
			'label' => 'Photo Button text',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat1_button_link',
		array(
			'default' => site_url() . '/index.php?search=',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat1_button_link',
		array(
			'label' => 'Cat 1 Button link',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	//End. Cat 1
	
	//Cat 2
	$wp_customize->add_setting( 
    	'cat2_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slide2.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'cat2_upload',
			array(
				'label' => 'Cat1 2 Upload',
				'section' => 'pvs_shopisle_catstock',
				'settings' => 'cat2_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'cat2_title',
		array(
			'default' => 'Shopisle Theme',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat2_title',
		array(
			'label' => 'Cat 2 Title',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat2_description',
		array(
			'default' => 'Modern responsive template',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat2_description',
		array(
			'label' => 'Cat 2 Description',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat2_button_text',
		array(
			'default' => 'View Photos',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat2_button_text',
		array(
			'label' => 'Cat 2 Button text',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat2_button_link',
		array(
			'default' => site_url() . '/index.php?sphoto=1',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat2_button_link',
		array(
			'label' => 'Cat 2 Button link',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	//End. Cat 2
	
	//Cat 3
	$wp_customize->add_setting( 
    	'cat3_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slide3.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'cat3_upload',
			array(
				'label' => 'Cat1 3 Upload',
				'section' => 'pvs_shopisle_catstock',
				'settings' => 'cat3_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'cat3_title',
		array(
			'default' => 'Signup as photographer',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat3_title',
		array(
			'label' => 'Cat 3 Title',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat3_description',
		array(
			'default' => 'Upload images and earn commission',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat3_description',
		array(
			'label' => 'Cat 3 Description',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat3_button_text',
		array(
			'default' => 'Sign up',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat3_button_text',
		array(
			'label' => 'Cat 3 Button text',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat3_button_link',
		array(
			'default' => site_url() . '/signup/',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat3_button_link',
		array(
			'label' => 'Cat 3 Button link',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	//End. Cat 3
	//Cat 4
	$wp_customize->add_setting( 
    	'cat4_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slide3.jpg',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'cat4_upload',
			array(
				'label' => 'Cat1 3 Upload',
				'section' => 'pvs_shopisle_catstock',
				'settings' => 'cat4_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'cat4_title',
		array(
			'default' => 'Signup as photographer',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat4_title',
		array(
			'label' => 'Cat 4 Title',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat4_description',
		array(
			'default' => 'Upload images and earn commission',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat4_description',
		array(
			'label' => 'Cat 4 Description',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat4_button_text',
		array(
			'default' => 'Sign up',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat4_button_text',
		array(
			'label' => 'Cat 4 Button text',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'cat4_button_link',
		array(
			'default' => site_url() . '/signup/',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'cat4_button_link',
		array(
			'label' => 'Cat 4 Button link',
			'section' => 'pvs_shopisle_catstock',
			'type' => 'text',
		)
	);
	//End. Cat 4
	//End. CatStock
	
	//Latest images
	$wp_customize->add_section(
        'pvs_shopisle_latest_images',
        array(
            'title' => 'Homepage Latest images',
            'description' => '',
            'priority' => 4,
        )
    );
    
    $wp_customize->add_setting(
		'hide_latest_images'
	);
	
	$wp_customize->add_control(
		'hide_latest_images',
		array(
			'label' => 'Hide latest images',
			'section' => 'pvs_shopisle_latest_images',
			'type' => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'latest_images_title',
		array(
			'default' => 'Latest images',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'latest_images_title',
		array(
			'label' => 'Title',
			'section' => 'pvs_shopisle_latest_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'latest_images_description',
		array(
			'default' => 'New photos',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'latest_images_description',
		array(
			'label' => 'Description',
			'section' => 'pvs_shopisle_latest_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'latest_images_button',
		array(
			'default' => 'See All Images',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'latest_images_button',
		array(
			'label' => 'Button text',
			'section' => 'pvs_shopisle_latest_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'latest_images_button_link',
		array(
			'default' => site_url() . '/index.php?sphoto=1',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'latest_images_button_link',
		array(
			'label' => 'Button link',
			'section' => 'pvs_shopisle_latest_images',
			'type' => 'text',
		)
	);
	
	//End. latest images
	
	
	//Homepage video
    $wp_customize->add_section(
        'pvs_shopisle_youtube',
        array(
            'title' => 'Homepage Video',
            'description' => '',
            'priority' => 5,
        )
    );
    
    $wp_customize->add_setting(
		'hide_video'
	);
	
	$wp_customize->add_control(
		'hide_video',
		array(
			'label' => 'Hide video',
			'section' => 'pvs_shopisle_youtube',
			'type' => 'checkbox',
		)
	);
    
    $wp_customize->add_setting(
		'youtube_id',
		array(
			'default' => 'EMy5krGcoOU',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'youtube_id',
		array(
			'label' => 'Youtube Video ID',
			'section' => 'pvs_shopisle_youtube',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'youtube_text',
		array(
			'default' => 'BE INSPIRED. GET AHEAD OF TRENDS.',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'youtube_text',
		array(
			'label' => 'Text on the video',
			'section' => 'pvs_shopisle_youtube',
			'type' => 'text',
		)
	);
	//End. Homepage video
	
	
	//Featured images
	$wp_customize->add_section(
        'pvs_shopisle_featured_images',
        array(
            'title' => 'Homepage Featured images',
            'description' => '',
            'priority' => 6,
        )
    );
    
    $wp_customize->add_setting(
		'hide_featured_images'
	);
	
	$wp_customize->add_control(
		'hide_featured_images',
		array(
			'label' => 'Hide featured images',
			'section' => 'pvs_shopisle_featured_images',
			'type' => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'featured_images_title',
		array(
			'default' => 'Featured images',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'featured_images_title',
		array(
			'label' => 'Title',
			'section' => 'pvs_shopisle_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'featured_images_description',
		array(
			'default' => 'Exclusive content',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'featured_images_description',
		array(
			'label' => 'Description',
			'section' => 'pvs_shopisle_featured_images',
			'type' => 'text',
		)
	);
	
	
	//End. Featured images
	
	
	//Footer
    $wp_customize->add_section(
        'pvs_shopisle_footer',
        array(
            'title' => 'Footer',
            'description' => '',
            'priority' => 7,
        )
    );
    
    $wp_customize->add_setting(
		'footer_text',
		array(
			'default' => 'Professional software for photographers and video producers.',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'footer_text',
		array(
			'label' => 'Footer text',
			'section' => 'pvs_shopisle_footer',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'footer_copyright_year',
		array(
			'default' => '2018',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'footer_copyright_year',
		array(
			'label' => 'Year',
			'section' => 'pvs_shopisle_footer',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default' => 'Photo Video Store',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'label' => 'Copyright',
			'section' => 'pvs_shopisle_footer',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'footer_copyright_link',
		array(
			'default' => 'https://www.cmsaccount.com/',
			'sanitize_callback' => 'pvs_shopisle_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'footer_copyright_link',
		array(
			'label' => 'Copyright Link',
			'section' => 'pvs_shopisle_footer',
			'type' => 'text',
		)
	);
	//End. Footer
}

add_action('customize_register', 'pvs_shopisle_customize' );

function pvs_shopisle_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//End. Customize
 
//PVS content
if ( function_exists ( 'pvs_content' ) ) {
	pvs_content();
	
	//Remove unnecessary js scripts and css
	add_action( 'wp_print_scripts', 'pvs_remove_scripts');
	add_action( 'wp_print_styles', 'pvs_remove_styles');

	function pvs_remove_scripts() {
		wp_dequeue_script( 'jquery' );
		wp_deregister_script( 'jquery' );
		
		wp_dequeue_script( 'pvs_jquery' );
		wp_deregister_script( 'pvs_jquery' );
		
		wp_dequeue_script( 'pvs_jqueryui' );
		wp_deregister_script( 'pvs_jqueryui' );
		
		wp_dequeue_script( 'bootstrap' );
		wp_deregister_script( 'bootstrap' );
		
		wp_dequeue_script( 'pvs_jshttprequest' );
		wp_deregister_script( 'pvs_jshttprequest' );
		
		wp_dequeue_script( 'pvs_custom_js' );
		wp_deregister_script( 'pvs_custom_js' );
	}
		
	function pvs_remove_styles() {
		wp_dequeue_style( 'pvs_css' );
		wp_deregister_style( 'pvs_css' );
		
		wp_dequeue_style( 'bootstrap_style' );
		wp_deregister_style( 'bootstrap_style' );
	}

	//Menu shopisle
	function pvs_build_menu_categories_shopisle($t_id) {
		global $db;
		global $dr;
		$dp = new TMySQLQuery;
		$dp->connection = $db;
		global $itg;
		global $nlimit;
		
		$nn  = 0;
		
		$sql = "select id, id_parent, title, priority, published, url from " . PVS_DB_PREFIX . "category where id_parent=" . $t_id . " and published=1 and activation_date < " . pvs_get_time() . " and (expiration_date > " . pvs_get_time() . " or expiration_date = 0) order by priority, title";
		$dp->open($sql);
		if (!$dp->eof) {
			while (!$dp->eof) {
				$title = pvs_category_url($dp->row["id"], $dp->row["url"]);
				
				$zp  = false;
				
				$sql = "select id, id_parent, title, priority, published, url from " . PVS_DB_PREFIX . "category where id_parent=" . $dp->row["id"] . " and published=1 and activation_date < " . pvs_get_time() . " and (expiration_date > " . pvs_get_time() . " or expiration_date = 0) order by priority, title";
				$dr->open($sql);
				if (!$dr->eof) {
				$zp = true;
				}
				
				if ($nlimit < 10000) {
					$translate_results = pvs_translate_category($dp->row["id"], $dp->row["title"], "", "");
					
					$ttl = addslashes($translate_results["title"]);
					
					if ($nn == 0) {
						$itg .= "<ul  class='sub-menu'>\n";
					}
					
					$class_dropdown  = "";
					
					if ($zp) {
						$class_dropdown = ' class="menu-item menu-item-has-children"';
					}
					
					$itg .= "<li " . $class_dropdown . "><a href=\"" . pvs_category_url($dp->row["id"], $dp->row["url"]) . "\" title=\"" . $ttl . "\">" . $ttl . "</a>\n";
					
					if (!$zp) {
						$itg .= "</li>";
					}
					pvs_build_menu_categories_shopisle($dp->row["id"]);
					if ($zp) {
						$itg .= "</li>";
					}
				}
				$nlimit++;
				$nn++;
				$dp->movenext();
			}
			$itg .= "</ul>\n";
		}
	}
	
	$itg="";
	$nlimit=0;
	pvs_build_menu_categories_shopisle(0);
	$pvs_theme_content[ 'box_categories' ] = $itg;
}


?>