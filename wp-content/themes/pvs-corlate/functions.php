<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
 
 
//Content width 
if ( ! isset( $content_width ) ) {
	$content_width = 900;
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
		'name'          => __( 'Footer area 1', 'pvs-corlate' ),
		'id'            => 'sidebar-footer-area-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer area 2', 'pvs-corlate' ),
		'id'            => 'sidebar-footer-area-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer area 3', 'pvs-corlate' ),
		'id'            => 'sidebar-footer-area-3',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer area 4', 'pvs-corlate' ),
		'id'            => 'sidebar-footer-area-4',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'pvs_widgets' );

//Menu
register_nav_menus( array(
	'corlatemenu' => __( 'Corlate Menu', 'pvs-corlate' )
) );

function pvs_corlate_menu() {
	get_template_part('menu');
}


//Theme header/footer for internal pages
$pvs_theme_header = '<div class="container">' ;
$pvs_theme_footer = '</div>';



//Customize
function pvs_corlate_customize($wp_customize) {

	//Logo
    $wp_customize->add_section(
        'pvs_corlate_logo',
        array(
            'title' => 'Logo',
            'description' => '',
            'priority' => 1,
        )
    );
	
	$wp_customize->add_setting( 
    	'logo', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/logo.png',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo',
			array(
				'label' => 'Logo',
				'section' => 'pvs_corlate_logo',
				'settings' => 'logo'
			)
		)
	);
	//End. Logo
	
	//Slideshow
	$wp_customize->add_section(
        'pvs_corlate_slideshow',
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
			'section' => 'pvs_corlate_slideshow',
			'type' => 'checkbox',
		)
	);
    
    //Slide 1
    $wp_customize->add_setting( 
    	'slider1_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slider/bg1.jpg',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'slider1_upload',
			array(
				'label' => 'Slide 1 Upload',
				'section' => 'pvs_corlate_slideshow',
				'settings' => 'slider1_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'slider1_title',
		array(
			'default' => 'Photo Video Store Script',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider1_title',
		array(
			'label' => 'Slide 1 Title',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider1_description',
		array(
			'default' => 'The best way to sell your photos and prints online',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider1_description',
		array(
			'label' => 'Slide 1 Description',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider1_button_text',
		array(
			'default' => 'Browse catalog',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider1_button_text',
		array(
			'label' => 'Slide 1 Button text',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider1_button_link',
		array(
			'default' => site_url() . '/index.php?search=',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider1_button_link',
		array(
			'label' => 'Slide 1 Button link',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	//End. Slide 1
	
	//Slide 2
	$wp_customize->add_setting( 
    	'slider2_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slider/bg2.jpg',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'slider2_upload',
			array(
				'label' => 'Slide 2 Upload',
				'section' => 'pvs_corlate_slideshow',
				'settings' => 'slider2_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'slider2_title',
		array(
			'default' => 'Corlate Theme',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider2_title',
		array(
			'label' => 'Slide 2 Title',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider2_description',
		array(
			'default' => 'Modern responsive template',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider2_description',
		array(
			'label' => 'Slide 2 Description',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider2_button_text',
		array(
			'default' => 'View Photos',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider2_button_text',
		array(
			'label' => 'Slide 2 Button text',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider2_button_link',
		array(
			'default' => site_url() . '/index.php?sphoto=1',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider2_button_link',
		array(
			'label' => 'Slide 2 Button link',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	//End. Slide 2
	
	//Slide 3
	$wp_customize->add_setting( 
    	'slider3_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slider/bg3.jpg',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'slider3_upload',
			array(
				'label' => 'Slide 3 Upload',
				'section' => 'pvs_corlate_slideshow',
				'settings' => 'slider3_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'slider3_title',
		array(
			'default' => 'Signup as photographer',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider3_title',
		array(
			'label' => 'Slide 3 Title',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider3_description',
		array(
			'default' => 'Upload images and earn commission',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider3_description',
		array(
			'label' => 'Slide 3 Description',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider3_button_text',
		array(
			'default' => 'Sign up',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider3_button_text',
		array(
			'label' => 'Slide 3 Button text',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'slider3_button_link',
		array(
			'default' => site_url() . '/signup/',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'slider3_button_link',
		array(
			'label' => 'Slide 3 Button link',
			'section' => 'pvs_corlate_slideshow',
			'type' => 'text',
		)
	);
	//End. Slide 3
	//Slide Default
	$wp_customize->add_setting( 
    	'sliderDefault_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slider/bg2.jpg',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'sliderDefault_upload',
			array(
				'label' => 'Slide Default Upload',
				'section' => 'pvs_corlate_slideshow',
				'settings' => 'sliderDefault_upload'
			)
		)
	);
    
   
	//End. Slide Defaul
	//End. Slideshow
	
	//griale
	$wp_customize->add_section(
        'pvs_corlate_catstock',
        array(
            'title' => 'Homepage catstock',
            'description' => '',
            'priority' => 2,
        )
    );
    
    $wp_customize->add_setting(
		'hide_catstock'
	);
	
	$wp_customize->add_control(
		'hide_catstock',
		array(
			'label' => 'Hide catstock',
			'section' => 'pvs_corlate_catstock',
			'type' => 'checkbox',
		)
	);
    
	//Catstock
		$wp_customize->add_setting(
		'catstock_title',
		array(
			'default' => 'Stock',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'catstock_title',
		array(
			'label' => 'Title',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'catstock_description',
		array(
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
et dolore magna aliqua. Ut enim ad minim veniam',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'catstock_description',
		array(
			'label' => 'Description catstock',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	///End title & desc
	
    //Slide 1
    $wp_customize->add_setting( 
    	'photo_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slider/bg1.jpg',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'photo_upload',
			array(
				'label' => 'Photo Upload',
				'section' => 'pvs_corlate_catstock',
				'settings' => 'photo_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'photo_title',
		array(
			'default' => 'Photo Video Store Script',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'photo_title',
		array(
			'label' => 'Slide 1 Title',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'photo_description',
		array(
			'default' => 'The best way to sell your photos and prints online',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'photo_description',
		array(
			'label' => 'Slide 1 Description',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'photo_button_text',
		array(
			'default' => 'Browse catalog',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'photo_button_text',
		array(
			'label' => 'Slide 1 Button text',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'photo_button_link',
		array(
			'default' => site_url() . '/index.php?search=',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'photo_button_link',
		array(
			'label' => 'Slide 1 Button link',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	//End Photo
	
	//Video
	$wp_customize->add_setting( 
    	'video_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slider/bg2.jpg',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'video_upload',
			array(
				'label' => 'Video Img Upload',
				'section' => 'pvs_corlate_catstock',
				'settings' => 'video_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'video_title',
		array(
			'default' => 'Corlate Theme',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'video_title',
		array(
			'label' => 'Slide 2 Title',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'video_description',
		array(
			'default' => 'Modern responsive template',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'video_description',
		array(
			'label' => 'Slide 2 Description',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'video_button_text',
		array(
			'default' => 'View Photos',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'video_button_text',
		array(
			'label' => 'Slide 2 Button text',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'video_button_link',
		array(
			'default' => site_url() . '/index.php?sphoto=1',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'video_button_link',
		array(
			'label' => 'Slide 2 Button link',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	//End Video
	
	//Vector
	$wp_customize->add_setting( 
    	'vector_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slider/bg3.jpg',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'vector_upload',
			array(
				'label' => 'Vector IMG Upload',
				'section' => 'pvs_corlate_catstock',
				'settings' => 'vector_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'vector_title',
		array(
			'default' => 'Signup as photographer',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'vector_title',
		array(
			'label' => 'Slide 3 Title',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'vector_description',
		array(
			'default' => 'Upload images and earn commission',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'vector_description',
		array(
			'label' => 'Slide 3 Description',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'vector_button_text',
		array(
			'default' => 'Sign up',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'vector_button_text',
		array(
			'label' => 'Slide 3 Button text',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'vector_button_link',
		array(
			'default' => site_url() . '/signup/',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'vector_button_link',
		array(
			'label' => 'Slide 3 Button link',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	//End Vector
	//Audio
	$wp_customize->add_setting( 
    	'audio_upload', 
    	array(
			'default' => get_template_directory_uri() . '/assets/images/slider/bg3.jpg',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
    );
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'audio_upload',
			array(
				'label' => 'audio IMG Upload',
				'section' => 'pvs_corlate_catstock',
				'settings' => 'audio_upload'
			)
		)
	);
    
    $wp_customize->add_setting(
		'audio_title',
		array(
			'default' => 'Signup as photographer',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'audio_title',
		array(
			'label' => 'audio Title',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'audio_description',
		array(
			'default' => 'Upload images and earn commission',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'audio_description',
		array(
			'label' => 'audio Description',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'audio_button_text',
		array(
			'default' => 'Sign up',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'audio_button_text',
		array(
			'label' => 'audio Button text',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'audio_button_link',
		array(
			'default' => site_url() . '/signup/',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'audio_button_link',
		array(
			'label' => 'audio Button link',
			'section' => 'pvs_corlate_catstock',
			'type' => 'text',
		)
	);
	//End Audio
	//end-griale
	
	
	
	//Features
	$wp_customize->add_section(
        'pvs_corlate_featured_images',
        array(
            'title' => 'Homepage Features',
            'description' => '',
            'priority' => 3,
        )
    );
    
    $wp_customize->add_setting(
		'hide_features'
	);
	
	$wp_customize->add_control(
		'hide_features',
		array(
			'label' => 'Hide features',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'features_title',
		array(
			'default' => 'Features',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'features_title',
		array(
			'label' => 'Title',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'features_description',
		array(
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
et dolore magna aliqua. Ut enim ad minim veniam',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'features_description',
		array(
			'label' => 'Description',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon1_title',
		array(
			'default' => 'Fresh and Clean',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon1_title',
		array(
			'label' => 'Title 1',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon1_description',
		array(
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon1_description',
		array(
			'label' => 'Description 1',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon1_icon',
		array(
			'default' => 'fa-bullhorn',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon1_icon',
		array(
			'label' => 'Fontawesome Icon 1',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
		$wp_customize->add_setting(
		'icon2_title',
		array(
			'default' => 'Retina ready',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon2_title',
		array(
			'label' => 'Title 2',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon2_description',
		array(
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon2_description',
		array(
			'label' => 'Description 2',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon2_icon',
		array(
			'default' => 'fa-comments',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon2_icon',
		array(
			'label' => 'Fontawesome Icon 2',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
		$wp_customize->add_setting(
		'icon3_title',
		array(
			'default' => 'Easy to customize',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon3_title',
		array(
			'label' => 'Title 3',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon3_description',
		array(
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon3_description',
		array(
			'label' => 'Description 3',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon3_icon',
		array(
			'default' => 'fa-cloud-download',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon3_icon',
		array(
			'label' => 'Fontawesome Icon 3',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
		$wp_customize->add_setting(
		'icon4_title',
		array(
			'default' => 'Adipisicing elit',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon4_title',
		array(
			'label' => 'Title 4',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon4_description',
		array(
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon4_description',
		array(
			'label' => 'Description 4',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon4_icon',
		array(
			'default' => 'fa-leaf',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon4_icon',
		array(
			'label' => 'Fontawesome Icon 4',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
		$wp_customize->add_setting(
		'icon5_title',
		array(
			'default' => 'Sed do eiusmod',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon5_title',
		array(
			'label' => 'Title 5',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon5_description',
		array(
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon5_description',
		array(
			'label' => 'Description 5',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon5_icon',
		array(
			'default' => 'fa-cogs',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon5_icon',
		array(
			'label' => 'Fontawesome Icon 5',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
		$wp_customize->add_setting(
		'icon6_title',
		array(
			'default' => 'Labore et dolore',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon6_title',
		array(
			'label' => 'Title 6',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon6_description',
		array(
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon6_description',
		array(
			'label' => 'Description 6',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'icon6_icon',
		array(
			'default' => 'fa-heart',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'icon6_icon',
		array(
			'label' => 'Fontawesome Icon 6',
			'section' => 'pvs_corlate_featured_images',
			'type' => 'text',
		)
	);
	//End. Features
	

	
	
	//Latest images
	$wp_customize->add_section(
        'pvs_corlate_latest_images',
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
			'section' => 'pvs_corlate_latest_images',
			'type' => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'latest_images_title',
		array(
			'default' => 'Latest images',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'latest_images_title',
		array(
			'label' => 'Title',
			'section' => 'pvs_corlate_latest_images',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'latest_images_description',
		array(
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'latest_images_description',
		array(
			'label' => 'Description',
			'section' => 'pvs_corlate_latest_images',
			'type' => 'text',
		)
	);
	

	
	//End. latest images
	
	

	

	
	
	//Footer
    $wp_customize->add_section(
        'pvs_corlate_footer',
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
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'footer_text',
		array(
			'label' => 'Footer text',
			'section' => 'pvs_corlate_footer',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'footer_copyright_year',
		array(
			'default' => '2018',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'footer_copyright_year',
		array(
			'label' => 'Year',
			'section' => 'pvs_corlate_footer',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default' => 'Photo Video Store',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'label' => 'Copyright',
			'section' => 'pvs_corlate_footer',
			'type' => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'footer_copyright_link',
		array(
			'default' => 'https://www.cmsaccount.com/',
			'sanitize_callback' => 'pvs_corlate_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
		'footer_copyright_link',
		array(
			'label' => 'Copyright Link',
			'section' => 'pvs_corlate_footer',
			'type' => 'text',
		)
	);
	//End. Footer
}

add_action('customize_register', 'pvs_corlate_customize' );

function pvs_corlate_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//End. Customize



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
}



?>