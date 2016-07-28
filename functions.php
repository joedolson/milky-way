<?php
/**
 * Univeresal functions and definitions
 * @package Milky Way
 */
add_action( 'after_setup_theme', 'milky_way_setup' );
if ( ! function_exists( 'milky_way_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 * To override milky_way_setup() in a child theme, add your own milky_way_setup to your child theme's
	 * functions.php file.
	 *
	 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
	 * @uses register_nav_menus() To add support for navigation menus.
	 * @uses add_custom_background() To add support for a custom background.
	 * @uses add_editor_style() To style the visual editor.
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_custom_image_header() To add support for a custom header.
	 * @uses register_default_headers() To register the default custom header images provided with the theme.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since Milky Way 1.0
	 */
	function milky_way_setup() {
	
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 640; 
		}

		load_theme_textdomain( 'milky-way' );

		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'audio', 'gallery', 'image', 'video', 'aside', 'status', 'quote' ) );
		add_theme_support( 'automatic-feed-links' ); 
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-header', apply_filters( 'milky_way_custom_header_args', array(
				'default-color' => '#fff',
				'default-text-color' => '#fff',
				'header-text' => false,
				'width' => 960, 
				'flex-width' => true,
				'height' => 180,
				'flex-height' => true,
				'default-image' => get_template_directory_uri() . '/images/header.jpg',
				'uploads' => true
			) ) );
		add_theme_support( 'custom-logo' );			
		add_theme_support( 'custom-background', apply_filters( 'milky_way_custom_background_args', array(
				'default-color' => '#e6e6e6',
				'default-image' => '',
			) ) );
		add_theme_support( 'woocommerce' );			
		$header_font = apply_filters( 'milky_way_header_font', "https://fonts.googleapis.com/css?family=Domine:400,700" );
		add_editor_style( array( 'css/editor.css', str_replace( ',', '%2C', $header_font ) ) );
		
		register_nav_menus( array( 
				'primary' => __( 'Main Menu', 'milky-way' ),
				'secondary' => __( 'Footer Menu', 'milky-way' ),
				'site-map' => __( 'Site Map', 'milky-way' ),
				'social-networks' => __( 'Social Networks', 'milky-way' )
			)
		);
	}
}

if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function milky_way_render_title() {
		?>
		<title><?php wp_title( ' &raquo; ', true, 'right' ); ?></title>
		<?php
    }
    add_action( 'wp_head', 'milky_way_render_title' );
}

add_action( 'widgets_init', 'milky_way_widgets_init' );
if ( ! function_exists( 'milky_way_widgets_init' ) ) {
	function milky_way_widgets_init() {
		register_sidebar( array(
			'name'=> __( 'Post Sidebar', 'milky-way' ),
			'description' => __( 'Widgets in this region will appear on all posts and post archives', 'milky-way' ),
			'id' => 'mw1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-inner"><h2>',
			'after_title' => '</h2></div>',
		));

		register_sidebar( array(
			'name'=> __( 'Home Sidebar', 'milky-way' ),
			'description' => __( 'Add up to 5 widgets to show on the bottom of your front page.', 'milky-way' ),
			'id' => 'mw2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-inner"><h2>',
			'after_title' => '</h2></div>',
		));

		register_sidebar( array(
			'name'=> __( 'Page Sidebar', 'milky-way' ),
			'description' => __( 'Widgets in this region will appear on WordPress Pages.', 'milky-way' ),
			'id' => 'mw3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-inner"><h2>',
			'after_title' => '</h2></div>',
		));

		register_sidebar( array(
			'name'=> __( 'Global Sidebar - Top', 'milky-way' ),
			'description' => __( 'These widgets appear globally on posts and pages, excluding the front page.', 'milky-way' ),
			'id' => 'mw4',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-inner"><h2>',
			'after_title' => '</h2></div>',
		));

		register_sidebar( array(
			'name'=> __( 'Global Sidebar - Bottom', 'milky-way' ),
			'description' => __( 'These widgets appear globally on posts and pages, excluding the front page.', 'milky-way' ),
			'id' => 'mw5',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-inner"><h2>',
			'after_title' => '</h2></div>',
		));
		
		register_sidebar( array(
			'name'=> __( 'Front Page Content - Left', 'milky-way' ),
			'description' => __( 'Left Column on front page', 'milky-way' ),
			'id' => 'mw6',
			'before_widget' => '<div id="%1$s" class="widget home-left %2$s"><div class="home-widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<h2 id="heading-fpcl">',
			'after_title' => '</h2>',
		));	

		register_sidebar( array(
			'name'=> __( 'Front Page Content - Right', 'milky-way' ),
			'description' => __( 'Right Column on front page', 'milky-way' ),
			'id' => 'mw7',
			'before_widget' => '<div id="%1$s" class="widget home-right %2$s"><div class="home-widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<h2 id="heading-fpcr">',
			'after_title' => '</h2>',
		));		
	}
}

require_once( get_template_directory() . '/inc/a11y.php' );
require_once( get_template_directory() . '/inc/comments.php' );
require_once( get_template_directory() . '/inc/customizer.php' );

add_filter( 'tiny_mce_before_init', 'milky_way_tinymce_init' );
function milky_way_tinymce_init( $init ) {
	// Remove H1 from TinyMCE so users are discouraged from breaking headings hierarchy.
	$init['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5,h6';
	
	return $init;
}

add_filter( 'wp_title', 'milky_way_home_title' );
function milky_way_home_title( $title ) {
	if ( ( is_front_page() || is_home() ) && empty( $title ) ) {
		return __( 'Home', 'milky-way' ). ' &raquo; '.get_bloginfo( 'name' );
	} 
	return $title;
}

add_filter( 'milky_way_end_of_header', 'milky_way_social_media_menu' );
function milky_way_social_media_menu( $return ) {
	if ( has_nav_menu( 'social-networks' ) ) {
		$alignment = esc_attr( get_theme_mod( 'milky_way_sm_alignment' ) );
		$alignment = ( $alignment == false || $alignment == '' ) ? 'center' : $alignment;
		$class     = " align-$alignment";
		$return = "<div class='social-networks$class' role='navigation' aria-label='Social Media'>";
		$return .= wp_nav_menu( array( 'theme_location'=>'social-networks', 'fallback_cb'=>'', 'echo'=>false, 'link_before'=>'<span class="screen-reader-text">', 'link_after'=>'</span>' ) );
		$return .= "</div>";
	}
	echo $return;
}

add_action( 'wp_print_styles', 'milky_way_load_styles' );
function milky_way_load_styles() {
		wp_register_style('heading', 'https://fonts.googleapis.com/css?family=Domine:400,700');
		wp_enqueue_style( 'milky-way-style', get_stylesheet_uri(), array( 'dashicons', 'heading' ), '1.0' );	
}


function milky_way_show_excerpt() {
	if ( !is_singular() && get_theme_mod( 'milky_way_content_display' ) == 'excerpt' ) {
		return true;
	}
	return false;
}

/* 
 * Check for customizer color settings. 
 * If set, check whether links can be blue against that background. If not, use calculated inverse color. 
 */
add_action( 'wp_head', 'milky_way_customizer_styles' );
function milky_way_customizer_styles() {

	$header = 	milky_way_generate_custom_styles( 'header', '#222222' );
	$sidebar = 	milky_way_generate_custom_styles( 'sidebar', '#ffffff' );
	$content = 	milky_way_generate_custom_styles( 'content', '#ffffff' );
	$menu = 	milky_way_generate_custom_styles( 'primary-menu', '#111111' );
	$footer = 	milky_way_generate_custom_styles( 'footer', '#ffffff' );

	if ( $header || $sidebar || $content || $pw || $menu ) {
		?>

<style>
/* Styles for Milky Way by Joe Dolson http://themes.joedolson.com/milky-way/ */
<?php echo "$footer"; ?>
<?php echo "$header"; ?>
<?php echo "$menu"; ?>
<?php echo "$sidebar"; ?>
<?php echo "$content"; ?>
</style>
		<?php
	}
}

function milky_way_generate_custom_styles( $setting, $default ) {
	$value = $color = '';
	if ( $setting == 'primary-menu' ) {
		$get_setting = 'menu'; 
	} else {
		$get_setting = $setting;
	}
	
	$theme_mod = get_theme_mod( 'milky_way_'.$get_setting.'_bg' );
	
	if ( $setting == 'primary-menu' ) {
		$value = ( $theme_mod && $theme_mod != $default ) ? ".$setting, .$setting a { background-color: ".esc_attr( $theme_mod )."; }\n" : ".$setting, .$setting a { background-color: ".$default."; }\n";
	} else {
		$value = ( $theme_mod && $theme_mod != $default ) ? ".$setting { background-color: ".esc_attr( $theme_mod )."; }\n" : ".$setting { background-color: ".$default."; }\n";
	}
	if ( $value ) { 
		$default_link_color = ( $setting == 'header' ) ? '#111111' : apply_filters( 'milky_way_custom_link_color', '#2929EC' );
		$test_color = ( $theme_mod != '' ) ? esc_attr( $theme_mod ) : $default;
		$viable = milky_way_compare_contrast( $test_color, $default_link_color );
		if ( $viable ) { 
			$color = ".$setting { color: ".milky_way_inverse_color( $test_color )."; }\n.$setting a { color: $default_link_color }\n";
		} else {
			$color = ".$setting, .$setting a { color: ".milky_way_inverse_color( $test_color )."; }\n"; 
		}
	}
	return $value.$color;
}

add_action( 'wp_head', 'milky_way_custom_header' );
function milky_way_custom_header() {
		$header_image = get_header_image();
		if ( $header_image ) {
			if ( get_custom_header()->height > 260 ) {
				$height = ( is_front_page() ) ? get_custom_header()->height . 'px' : apply_filters( 'milky_way_inner_header_height', '260px' );
			} else {
				$height = ( is_front_page() ) ? apply_filters( 'milky_way_inner_header_height', '260px' ): get_custom_header()->height . 'px';
			}
		} else {
			$height = '260px';
		}
		$distance = esc_html( get_theme_mod( 'milky_way_text_position' ) );
		$height = "calc( $height - ( $distance / 2 ) )";
		$color = esc_html( get_theme_mod( 'milky_way_header_bg' ) );
		$shadow = esc_html( milky_way_shift_color( $color, 'small' ) );
		echo "
<style>
	.header .text-header { padding-top: $distance; }
	.header .text-header.has-image { background: $color url($header_image) 50% 50% no-repeat; background-size: cover; min-height: $height }
	.header { min-height: $height; }
	.header .social-networks a { text-shadow: 3px 3px 0 $shadow,-1px -1px 0 $shadow,1px -1px 0 $shadow,-1px 1px 0 #000,1px 1px 0 $shadow; }
</style>
";	
}

add_action( 'wp_head', 'milky_way_custom_background' );
function milky_way_custom_background() {
	$image = get_background_image();
	$color = get_background_color();
	if ( $color && $image ) {
		?>
<style type='text/css'>
	body { background: <?php echo $color; ?> url(<?php echo $image; ?>) no-repeat stretch; }
</style>
	<?php
	} else if ( $image ) {
		?>
<style type='text/css'>
	body { background: url(<?php echo $image; ?>) no-repeat stretch: }
</style>
	<?php		
	} else if ( $color ) {
		?>
<style type='text/css'>
	body { background-color: <?php echo $color; ?>; }
</style>
	<?php		
	}
}

add_action( 'wp_enqueue_scripts','milky_way_enqueue_scripts' );
function milky_way_enqueue_scripts() {
	wp_enqueue_script( 'milkyWay.a11y', get_template_directory_uri() . '/js/a11y.js', array('jquery'), '1.0.0', true );
	$a11y_i18n = array(
		'externalLink' => __( 'External link', 'milky-way' ),
		'newWindow' => __( 'Opens in a new window', 'milky-way' )
	);
	wp_localize_script( 'milkyWay.a11y', 'milkyWayA11y', $a11y_i18n );
	if ( get_theme_mod( 'milky_way_ajax_comments' ) == 1 ) {
		wp_enqueue_script( 'milkyWay.comments', get_template_directory_uri() . "/js/comments.js", array('jquery'), '1.0.0', true );
		$comment_i18n = array( 
			'processing' => __( 'Processing...', 'milky-way' ),
			'flood' => sprintf( __( 'Your comment was either a duplicate or you are posting too rapidly. <a href="%s">Edit your comment</a>', 'milky-way' ), '#comment' ),
			'error' => __( 'There were errors in submitting your comment; complete the missing fields and try again!', 'milky-way' ),
			'emailInvalid' => __( 'That email appears to be invalid.', 'milky-way' ),
			'required' => __( 'This is a required field.', 'milky-way' )		
		);
		wp_localize_script( 'milkyWay.comments', 'milkyWayComments', $comment_i18n );
	}
	wp_enqueue_script( 'milkyWay.general', get_template_directory_uri() . '/js/general.js', array('jquery'), '1.0.0', true );
	wp_localize_script( 'milkyWay.general', 'milkyWay', array( 
		'close' => '<span class="screen-reader-text">' . __( 'Close %s Sub-menu', 'milky-way' ) . ' </span>' . '<span aria-hidden="true" class="dashicons dashicons-minus"></span>', 
		'expand' => '<span class="screen-reader-text">' . __( 'Open %s Sub-menu', 'milky-way' ) . ' </span>' . '<span aria-hidden="true" class="dashicons dashicons-plus"></span>' ) 
	);
	wp_register_style( 'milkyWay.woocommerce', get_template_directory_uri() . '/css/woocommerce.css' ); 
	if ( class_exists( 'WC_Cart' ) ) {
		wp_enqueue_style( 'milkyWay.woocommerce' );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function milky_way_archive_title( $display = true ) {	
	$hidden = '';
	if ( is_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	if ( is_category() || is_tax() ) {
		$title = single_term_title( '', false );
	}
	if ( is_tag() ) {
		$title = ucfirst( trim( single_tag_title( '', false ) ) );
	}
	if ( is_date() ) {
		$title = trim( single_month_title( ' ', false ) );
	}
	if ( is_home() ) {
		if ( !is_front_page() ) {
			$title = get_bloginfo( 'name' ) . ' / ' . get_the_title( get_option( 'page_for_posts' ) );			
		} else {
			$hidden = ' screen-reader-text';
			$title = sprintf( __( '%s / Posts', 'milky-way' ), get_bloginfo( 'name' ) );
		}
	} else {
		$title = sprintf( __( '%s / Posts', 'milky-way' ), $title );
	}
	if ( $title ) {
		$title = "<div class='archive-title$hidden'><h1>" . $title . "</h1></div>";
	}
	if ( $display ) {
		echo $title;
	} else {
		return $title;
	}
}

/* WooCommerce support */

add_action( 'woocommerce_before_main_content', 'milky_way_theme_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'milky_way_theme_wrapper_end', 10 );

function milky_way_theme_wrapper_start() {
  echo '<section>';
}

function milky_way_theme_wrapper_end() {
  echo '</section>';
}

/**
 * @param $id string Sidebar id
 * @return $count integer number of widgets in this sidebar
 */
function milky_way_get_widget_count( $id = false ) {
	$count = 0;
	if ( $id ) {
		$sidebars = wp_get_sidebars_widgets();
		$sidebar = isset( $sidebars[$id] ) ? $sidebars[$id] : array();
		$count = count( $sidebar );
	}
	
	return $count;
}