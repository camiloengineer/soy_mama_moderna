<?php
/**
 * Piemont functions
 *
 * @package Piemont
 */

/*
 *	Theme options
*/
define( 'IPANEL_PATH' , get_template_directory() . '/ipanel/' );
define( 'IPANEL_URI' , get_template_directory_uri() . '/ipanel/' );
define( 'IPANEL_PLUGIN_USAGE' , false );

include_once IPANEL_PATH . 'iPanel.php';

/**
 * Get theme options globally
 */
if (!function_exists('piemont_get_theme_options')) :
function piemont_get_theme_options() {
	if(get_option('PIEMONT_PANEL')) {
		$theme_options_data = maybe_unserialize(get_option('PIEMONT_PANEL'));
	} else {
		$theme_options_data = Array();
	}

	return $theme_options_data;
}
endif;

$piemont_theme_options = piemont_get_theme_options();

if (!isset($content_width))
	$content_width = 810; /* pixels */

if (!function_exists('piemont_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function piemont_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Piemont, use a find and replace
	 * to change 'piemont' to the name of your theme in all the template files
	 */
	load_theme_textdomain('piemont', get_template_directory() . '/languages');

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support('automatic-feed-links');

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Enable support for JetPack Infinite Scroll
	 *
	 * @link https://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
	    'container' => 'content',
	    'footer' => 'page',
	) );

	/**
	 * Enable support for Title Tag
	 *
	 */
	function piemont_theme_slug_setup() {
	   add_theme_support( 'title-tag' );
	}
	add_action( 'after_setup_theme', 'piemont_theme_slug_setup' );

	/**
	 * Enable support for Logo
	 */
	add_theme_support( 'custom-header', array(
	    'default-image' =>  get_template_directory_uri() . '/img/logo.png',
            'width'         => 415,
            'flex-width'    => true,
            'flex-height'   => false,
            'header-text'   => false,
	));

	/**
	 *	Woocommerce support
	 */
	add_theme_support( 'woocommerce' );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

    // Gutenberg support
    add_theme_support('align-wide');

	/**
	 * Theme resize image
	 */
	add_image_size( 'blog-thumb', 1140, 660, true);
	add_image_size( 'blog-thumb-vertical', 400, 600, true);
	add_image_size( 'blog-thumb-wide', 1140, 350, true);
	add_image_size( 'blog-thumb-widget', 100, 58, true);

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
            'primary' => esc_html__('Header Menu', 'piemont'),
            'top' => esc_html__('Top Menu', 'piemont'),
            'footer' => esc_html__('Footer Menu', 'piemont'),
	) );
	/*
	* Change excerpt length
	*/
	function piemont_new_excerpt_length($length) {
		$piemont_theme_options = piemont_get_theme_options();

		if(isset($piemont_theme_options['post_excerpt_legth'])) {
			$post_excerpt_length = $piemont_theme_options['post_excerpt_legth'];
		} else {
			$post_excerpt_length = 18;
		}

		return $post_excerpt_length;
	}
	add_filter('excerpt_length', 'piemont_new_excerpt_length');
	/**
	 * Enable support for Post Formats
	 */
	add_theme_support('post-formats', array('aside', 'image', 'gallery', 'video', 'audio', 'quote', 'link', 'status', 'chat'));
}
endif;
add_action('after_setup_theme', 'piemont_setup');

/**
 * Enqueue scripts and styles
 */
function piemont_scripts() {
	$piemont_theme_options = piemont_get_theme_options();

	wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style( 'bootstrap' );

	wp_enqueue_style( 'piemont-fonts', piemont_google_fonts_url(), array(), '1.0' );

	wp_register_style('owl-main', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css');
	wp_register_style('owl-theme', get_template_directory_uri() . '/js/owl-carousel/owl.theme.css');
	wp_enqueue_style( 'owl-main' );
	wp_enqueue_style( 'owl-theme' );

	wp_register_style('stylesheet', get_stylesheet_uri(), array(), '1.0', 'all');
	wp_enqueue_style( 'stylesheet' );

	wp_register_style('responsive', get_template_directory_uri() . '/responsive.css', '1.0', 'all');
	wp_enqueue_style( 'responsive' );

	if(isset($piemont_theme_options['enable_theme_animations']) && $piemont_theme_options['enable_theme_animations']) {
		wp_register_style('animations', get_template_directory_uri() . '/css/animations.css');
		wp_enqueue_style( 'animations' );
	}

	wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
	wp_register_style('select2-mgt', get_template_directory_uri() . '/js/select2/select2.css');
	wp_register_style('offcanvasmenu', get_template_directory_uri() . '/css/offcanvasmenu.css');
	wp_register_style('nanoscroller', get_template_directory_uri() . '/css/nanoscroller.css');
	wp_register_style('swiper', get_template_directory_uri() . '/css/idangerous.swiper.css');

	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'select2-mgt' );
	wp_enqueue_style( 'offcanvasmenu' );
	wp_enqueue_style( 'nanoscroller' );
	wp_enqueue_style( 'swiper' );

	add_thickbox();

	wp_register_script('piemont-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.1.1', true);
	wp_register_script('piemont-easing', get_template_directory_uri() . '/js/easing.js', array(), '1.3', true);
	wp_register_script('piemont-template', get_template_directory_uri() . '/js/template.js', array(), '1.0', true);
	wp_register_script('piemont-select2', get_template_directory_uri() . '/js/select2/select2.min.js', array(), '3.5.1', true);
	wp_register_script('owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js', array(), '1.3.3', true);
	wp_register_script('nanoscroller', get_template_directory_uri() . '/js/jquery.nanoscroller.min.js', array(), '3.4.0', true);

	wp_enqueue_script('piemont-script', get_template_directory_uri() . '/js/template.js', array('jquery', 'piemont-bootstrap', 'piemont-easing', 'piemont-select2', 'owl-carousel', 'nanoscroller'), '1.0', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

}
add_action('wp_enqueue_scripts', 'piemont_scripts');

// Deregister scripts
function piemont_dequeue_stylesandscripts() {
	if ( class_exists( 'woocommerce' ) ) {
		wp_dequeue_style( 'select2' );
		wp_deregister_style( 'select2' );
	}
}
add_action( 'wp_enqueue_scripts', 'piemont_dequeue_stylesandscripts', 100 );

/**
 * Enqueue scripts and styles for admin area
 */
function piemont_admin_scripts() {
	wp_register_style( 'piemont-style-admin', get_template_directory_uri() .'/css/admin.css' );
	wp_enqueue_style( 'piemont-style-admin' );
	wp_register_style('font-awesome-admin', get_template_directory_uri() . '/css/font-awesome.css');
	wp_enqueue_style( 'font-awesome-admin' );

	wp_register_script('piemont-template-admin', get_template_directory_uri() . '/js/template-admin.js', array(), '1.0', true);
	wp_enqueue_script('piemont-template-admin');

}
add_action( 'admin_init', 'piemont_admin_scripts' );

function piemont_load_wp_media_files() {
  wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'piemont_load_wp_media_files' );

// Custom theme title
add_filter( 'wp_title', 'piemont_wp_title', 10, 2 );

function piemont_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'piemont' ), max( $paged, $page ) );
	}

	return $title;
}

/**
 * Ajax registration PHP
 */
if (!function_exists('piemont_registration_process_callback')) :
function piemont_registration_process_callback() {
	// User don't allowed subscription
    if(empty($_POST['email'])) {
        $email = '-';
        $subscribe = 0;
    } else {
    // User allowed subscription
        $email = esc_html($_POST['email']);
        $subscribe = 1;
    }

	$code = esc_html($_POST['code']);

    update_option('envato_purchase_code_piemont', $code);

	echo wp_kses_post($email.';'.$code.';-;'.wp_get_theme().';'.get_site_url().';'.$subscribe);

	wp_die();
}
add_action('wp_ajax_piemont_registration_process', 'piemont_registration_process_callback');
endif;

/**
 * Ajax registration JS
 */
if (!function_exists('piemont_registration_javascript')) :
function piemont_registration_javascript() {
  ?>
  <script type="text/javascript" >
  (function($){
  $(document).ready(function($) {

  	"use strict";

	$('.theme-activation-wrapper .activate-theme-btn').on('click', function(e){

		var email = $('.theme-activation-wrapper .activate-theme-email').val();
		var code = $('.theme-activation-wrapper .activate-theme-code').val();

		if(code == '') {
			$('.theme-activation-wrapper .theme-activation-message').html('<span class="error"><?php esc_html_e('Please fill out purchase code field.', 'piemont'); ?></span>');
		} else {
			$('.theme-activation-wrapper .activate-theme-btn').attr('disabled', 'disabled').removeClass('button-primary').addClass('button-secondary');

			$('.theme-activation-wrapper .theme-activation-message').html('<?php esc_html_e('Registering theme...', 'piemont'); ?>');

			var data = {
		      action: 'piemont_registration_process',
		      email: email,
		      code: code
		    };

			$.post( ajaxurl, data, function(response) {

		      var wpdata = response;

			  $.ajax({
			    url: "//api.magniumthemes.com/activation.php?act=register&purchasecheck&data="+wpdata,
			    type: "GET",
			    timeout: 10000,
			    success: function(data) {
			    	if(data == 'verified') {

						$('.theme-activation-wrapper .theme-activation-message').html('<span class="success"><?php esc_html_e('Theme registered succesfully!', 'piemont'); ?></span><br/><br>');

						window.location = "themes.php?page=ipanel_PIEMONT_PANEL&act=registration_complete";


					} else if(data == 'verifiedused') {
                        $('.theme-activation-wrapper .theme-activation-message').html('<span class="success"><?php esc_html_e('Theme registered succesfully!', 'piemont'); ?></span><br/><br>');

                        alert('<?php esc_html_e('Theme registered succesfully, but we see that theme purchase code was already activated before. Please note that by ThemeForest regular license rules you can use one theme license only on one WordPress installation with one language (you allowed to use theme another time only on test/development environments). If you are using theme on multiple sites or multilanguage website make sure you purchased separate regular license for every site and language, otherwise theme on your sites can be automatically blocked in next check.', 'piemont'); ?>');

                        window.location = "themes.php?page=ipanel_PIEMONT_PANEL&act=registration_complete";

                    } else {
						$('.theme-activation-wrapper .theme-activation-message').html('<span class="error"><?php esc_html_e('Purchase code is not valid. Your purchase code should look like this: 36434418-e837-48c5-8737-f20d52b36a1f', 'piemont'); ?></span>');

						$('.theme-activation-wrapper .activate-theme-btn').removeAttr('disabled', 'disabled').removeClass('button-secondary').addClass('button-primary');

					}
			    },
			    error: function(xmlhttprequest, textstatus, message) {
			        $('.theme-activation-wrapper .theme-activation-message').html("<?php echo wp_kses_post(__("<span class='error'>Oops! It looks like the registration server is on technical maintenance.<br/>Please click the button below to start using all theme features right now. Don't worry, you can register your theme tomorrow.<br/>We're sorry for the inconvenience!<br/>If this issue persist on next activation this means your hosting blocks external connections to our server,<br/>please <a href='http://support.magniumthemes.com/' target='_blank'>contact our support team</a> to get theme activated manually.</span><br><a href='themes.php?page=ipanel_PIEMONT_PANEL&act=registration_skip' class='button button-primary button-hero activate-theme-btn'>Start using theme</a>", 'piemont')); ?>");
			    }
			  });

		    });

	  	}


    });

  });
  })(jQuery);
  </script>
  <?php
}
add_action('admin_print_footer_scripts', 'piemont_registration_javascript', 99);
endif;

/*
* Process already escaped complex data
*/
function piemont_wp_kses_data($data) {
  // This function used in safe places only, where all dynamic data already escaped before,
  // and does not need double escaping

  return $data;
}

/*
* Set/Get current post details for global usage in templates (post position in loop, etc)
*/
if(!function_exists('piemont_set_post_details')):
function piemont_set_post_details($details) {
	global $piemont_post_details;

	$piemont_post_details = $details;
}
endif;

if(!function_exists('piemont_get_post_details')):
function piemont_get_post_details() {
	global $piemont_post_details;

	return $piemont_post_details;
}
endif;

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/theme-tags.php';

/**
 * Load theme functions.
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Load theme dynamic CSS.
 */
require get_template_directory() . '/inc/theme-css.php';

/**
 * Load theme dynamic JS.
 */
require get_template_directory() . '/inc/theme-js.php';
