<?php

	add_action( 'wp_enqueue_scripts', 'piemont_enqueue_dynamic_styles', '999' );

	function piemont_enqueue_dynamic_styles( ) {

        require_once(ABSPATH . 'wp-admin/includes/file.php'); // required to use WP_Filesystem()

        WP_Filesystem();

		global $wp_filesystem;

        if ( function_exists( 'is_multisite' ) && is_multisite() ){
            $cache_file_name = 'style-cache-'.wp_get_theme()->get('TextDomain').'-b' . get_current_blog_id();
        } else {
            $cache_file_name = 'style-cache-'.wp_get_theme()->get('TextDomain');
        }

        $wp_upload_dir = wp_upload_dir();

        $css_cache_file = $wp_upload_dir['basedir'].'/'.$cache_file_name.'.css';

        $css_cache_file_url = $wp_upload_dir['baseurl'].'/'.$cache_file_name.'.css';

        $ipanel_saved_date = get_option( 'ipanel_saved_date', 1 );
        $cache_saved_date = get_option( 'cache_css_saved_date', 0 );

        if( file_exists( $css_cache_file ) ) {
            $cache_status = 'exist';

            if($ipanel_saved_date > $cache_saved_date) {
                $cache_status = 'no-exist';
            }

        } else {
            $cache_status = 'no-exist';
        }

        if ( defined('DEMO_MODE') ) {
            $cache_status = 'no-exist';
        }

		if ( $cache_status == 'exist' ) {

			wp_register_style( $cache_file_name, $css_cache_file_url, $cache_saved_date);
            wp_enqueue_style( $cache_file_name );

		} else {

			$out = '';

			$generated = microtime(true);

			$out = piemont_get_css();

			$out = str_replace( array( "\t", "
", "\n", "  ", "   ", ), array( "", "", " ", " ", " ", ), $out );

			$out .= '/* CSS Generator Execution Time: ' . floatval( ( microtime(true) - $generated ) ) . ' seconds */';

			// FS_CHMOD_FILE required by WordPress guideliness - https://codex.wordpress.org/Filesystem_API#Using_the_WP_Filesystem_Base_Class
            if ( defined( 'FS_CHMOD_FILE' ) ) {
                $chmod_file = FS_CHMOD_FILE;
            } else {
                $chmod_file = ( 0644 & ~ umask() );
            }

			if ( $wp_filesystem->put_contents( $css_cache_file, $out, $chmod_file) ) {

				wp_register_style( $cache_file_name, $css_cache_file_url, $cache_saved_date);
                wp_enqueue_style( $cache_file_name );

                // Update save options date
                $option_name = 'cache_css_saved_date';

                $new_value = microtime(true) ;

                if ( get_option( $option_name ) !== false ) {

                    // The option already exists, so we just update it.
                    update_option( $option_name, $new_value );

                } else {

                    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
                    $deprecated = null;
                    $autoload = 'no';
                    add_option( $option_name, $new_value, $deprecated, $autoload );
                }
			}

		}
	}

	function piemont_get_css () {
		$piemont_theme_options = piemont_get_theme_options();
		// ===
		ob_start();
    ?>
    <?php
    if ( defined('DEMO_MODE') && isset($_GET['header_height']) ) {
      $piemont_theme_options['header_height'] = $_GET['header_height'];
    }

    if(isset($piemont_theme_options['header_height']) && $piemont_theme_options['header_height'] > 0) {
        $header_height = $piemont_theme_options['header_height'];
    } else {
        $header_height = 200;
    }

    if(isset($piemont_theme_options['logo_width']) && $piemont_theme_options['logo_width'] > 0) {
        $logo_width = $piemont_theme_options['logo_width'];
    } else {
        $logo_width = 415;
    }

    if(isset($piemont_theme_options['footer_logo_width']) && $piemont_theme_options['footer_logo_width'] > 0) {
        $footer_logo_width = $piemont_theme_options['footer_logo_width'];
    } else {
        $footer_logo_width = 102;
    }
    ?>
    header .col-md-12 {
        height: <?php echo intval($header_height); ?>px;
    }
    <?php
    // Retina logo
    ?>
    header .logo-link img {
        width: <?php echo intval($logo_width); ?>px;
    }
    footer .footer-logo img {
        width: <?php echo intval($footer_logo_width); ?>px;
    }
    <?php
    // Header menu styles
    if(isset($piemont_theme_options['header_menu_style']) && $piemont_theme_options['header_menu_style'] == 'menu_light'): ?>
    .post-container,
    .page-container,
    .piemont-post-list-wrapper {
        margin-top: 0;
    }
    <?php endif; ?>
    <?php
    /**
    * Custom CSS
    **/
    if(isset($piemont_theme_options['custom_css_code'])) {

        echo piemont_wp_kses_data($piemont_theme_options['custom_css_code']); // This variable contains user Custom CSS code and can't be escaped with WordPress functions

    } ?>

    /**
    * Theme Google Font
    **/
    <?php
        // Demo settings
        if ( defined('DEMO_MODE') && isset($_GET['header_font']) ) {
          $piemont_theme_options['header_font']['font-family'] = $_GET['header_font'];
        }
        if ( defined('DEMO_MODE') && isset($_GET['body_font']) ) {
          $piemont_theme_options['body_font']['font-family'] = $_GET['body_font'];
        }
        if ( defined('DEMO_MODE') && isset($_GET['additional_font']) ) {
          $piemont_theme_options['additional_font']['font-family'] = $_GET['additional_font'];
        }

        if(isset($piemont_theme_options['font_google_disable']) && $piemont_theme_options['font_google_disable']) {

            $piemont_theme_options['body_font']['font-family'] = $piemont_theme_options['font_regular'];
            $piemont_theme_options['header_font']['font-family'] = $piemont_theme_options['font_regular'];
            $piemont_theme_options['additional_font']['font-family'] = $piemont_theme_options['font_regular'];
        }
    ?>
    h1, h2, h3, h4, h5, h6 {
        font-family: '<?php echo str_replace("+"," ", $piemont_theme_options['header_font']['font-family']); ?>';
    }
    .comment-metadata .author,
    blockquote,
    .blog-post .format-quote .entry-content,
    .blog-style-5 .blog-post .post-categories,
    .blog-style-5 .blog-post .more-link,
    .blog-style-5 .post-social-title,
    .blog-style-5 .blog-post-bottom .comments-count,
    .blog-style-5 .piemont-post-list .piemont-post-category,
    .blog-style-5 .piemont-post-list .piemont-read-more,
    .blog-style-5 .menu-top-menu-container,
    .blog-style-5 a.btn,
    .blog-style-5 .btn,
    .blog-style-5 .btn:focus,
    .blog-style-5 input[type="submit"],
    .blog-style-5 .woocommerce #content input.button,
    .blog-style-5 .woocommerce #respond input#submit,
    .blog-style-5 .woocommerce a.button,
    .blog-style-5 .woocommerce button.button,
    .blog-style-5 .woocommerce input.button,
    .blog-style-5 .woocommerce-page #content input.button,
    .blog-style-5 .woocommerce-page #respond input#submit,
    .blog-style-5 .woocommerce-page a.button,
    .blog-style-5 .woocommerce-page button.button,
    .blog-style-5 .woocommerce-page input.button,
    .blog-style-5 .woocommerce a.added_to_cart,
    .blog-style-5 .woocommerce-page a.added_to_cart,
    .blog-style-5 .blog-post a.more-link,
    .blog-style-5 .homepage-welcome-block-2 .welcome-image-overlay,
    .blog-style-5 .blog-post.blog-post-single .comments-count,
    .blog-style-5 .blog-post .sticky-post-badge,
    .blog-style-5 .piemont-post-list .piemont-post-details .piemont-post-title h2 {
        font-family: '<?php echo str_replace("+"," ", $piemont_theme_options['header_font']['font-family']); ?>';
    }
    h1 {
        font-size: <?php echo esc_html($piemont_theme_options['header_font']['font-size']); ?>px;
    }
    body {
        font-family: '<?php echo esc_html($piemont_theme_options['body_font']['font-family']); ?>';
        font-size: <?php echo esc_html($piemont_theme_options['body_font']['font-size']); ?>px;
    }
    <?php if(isset($piemont_theme_options['additional_font_enable']) && $piemont_theme_options['additional_font_enable']): ?>

    <?php endif; ?>

    /**
    * Colors and color skins
    */
    <?php
    // Demo settings
    if ( defined('DEMO_MODE') && isset($_GET['color_skin_name']) ) {
      $piemont_theme_options['color_skin_name'] = $_GET['color_skin_name'];
    }

    if(!isset($piemont_theme_options['color_skin_name'])) {
        $color_skin_name = 'none';
    }
    else {
        $color_skin_name = $piemont_theme_options['color_skin_name'];
    }
    // Use panel settings
    if($color_skin_name == 'none') {

        $theme_body_color = $piemont_theme_options['theme_body_color'];
        $theme_text_color = $piemont_theme_options['theme_text_color'];
        $theme_main_color = $piemont_theme_options['theme_main_color'];
        $theme_header_bg_color = $piemont_theme_options['theme_header_bg_color'];
        $theme_cat_menu_bg_color = $piemont_theme_options['theme_cat_menu_bg_color'];
        $theme_footer_color = $piemont_theme_options['theme_footer_color'];
        $theme_masonry_bg_color = $piemont_theme_options['theme_masonry_bg_color'];

    }
    // Default skin
    if($color_skin_name == 'default') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#EC9F2E';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#F9F5EF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Turquoise skin
    if($color_skin_name == 'turquoise') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#52E4FD';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Black skin
    if($color_skin_name == 'black') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#000000';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Light blue skin
    if($color_skin_name == 'lightblue') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#A2C6EA';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Blue skin
    if($color_skin_name == 'blue') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#346DF4';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Red
    if($color_skin_name == 'red') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#e86f75';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Green
    if($color_skin_name == 'green') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#00BC8F';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Magnium
    if($color_skin_name == 'magnium') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#4686cc';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Fencer
    if($color_skin_name == 'fencer') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#26cdb3';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Perfectum
    if($color_skin_name == 'perfectum') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#F2532F';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Simplegreat
    if($color_skin_name == 'simplegreat') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#C3A36B';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Piemont Light
    if($color_skin_name == 'piemontlight') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#EC9F2E';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#FFFFFF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    // Simple
    if($color_skin_name == 'simple') {

        $theme_body_color = '#ffffff';
        $theme_text_color = '#000000';
        $theme_main_color = '#8e9da5';
        $theme_header_bg_color = '#FFFFFF';
        $theme_cat_menu_bg_color = '#F9F5EF';
        $theme_footer_color = '#262626';
        $theme_masonry_bg_color = '#F8F8F8';

    }
    ?>
    body {
        background-color: <?php echo esc_html($theme_body_color); ?>;
        color: <?php echo esc_html($theme_text_color); ?>;
    }
    .st-pusher, .st-sidebar-pusher {
        background-color: <?php echo esc_html($theme_body_color); ?>;
    }
    .woocommerce #content input.button.alt,
    .woocommerce #respond input#submit.alt,
    .woocommerce a.button.alt,
    .woocommerce button.button.alt,
    .woocommerce input.button.alt,
    .woocommerce-page #content input.button.alt,
    .woocommerce-page #respond input#submit.alt,
    .woocommerce-page a.button.alt,
    .woocommerce-page button.button.alt,
    .woocommerce-page input.button.alt,
    .blog-post .tags a:hover,
    .blog-post .post-categories,
    .blog-post .post-categories:before,
    .blog-post .post-categories:after,
    #top-link,
    .sidebar .widget_calendar th,
    .sidebar .widget_calendar tfoot td,
    .sidebar .widget_tag_cloud .tagcloud a:hover,
    .sidebar .widget_product_tag_cloud .tagcloud a:hover,
    .comment-meta .reply a:hover,
    .piemont-post-list .piemont-post-details .piemont-post-category,
    .piemont-post-list .piemont-post-details .piemont-post-category:before,
    .piemont-post-list .piemont-post-details .piemont-post-category:after,
    .piemont-post-list .piemont-post-details .piemont-read-more a:hover,
    .piemont-post-list.piemont-post-style-2 .piemont-post-box,
    body .owl-theme .owl-controls .owl-page.active span,
    body .owl-theme .owl-controls.clickable .owl-page:hover span,
    .st-sidebar-menu-close-btn,
    .footer-signup-wrapper input[type="submit"]:hover,
    .blog-style-3 a.btn:hover,
    .blog-style-3 .sidebar .widget_text a.btn:hover,
    .blog-style-3 .btn:hover,
    .blog-style-3 .btn:focus:hover,
    .blog-style-3 input[type="submit"]:hover,
    .blog-style-3 .woocommerce #content input.button:hover,
    .blog-style-3 .woocommerce #respond input#submit:hover,
    .blog-style-3 .woocommerce a.button:hover,
    .blog-style-3 .woocommerce button.button:hover,
    .blog-style-3 .woocommerce input.button:hover,
    .blog-style-3 .woocommerce-page #content input.button:hover,
    .blog-style-3 .woocommerce-page #respond input#submit:hover,
    .blog-style-3 .woocommerce-page a.button:hover,
    .blog-style-3 .woocommerce-page button.button:hover,
    .blog-style-3 .woocommerce-page input.button:hover,
    .blog-style-3 .woocommerce a.added_to_cart:hover,
    .blog-style-3 .woocommerce-page a.added_to_cart:hover,
    .blog-style-3 .blog-post .more-link:hover,
    .blog-style-4 header .header-right ul.header-nav > li.float-sidebar-toggle a,
    .sidebar .widget .widget-social-follow a,
    .homepage-welcome-block .homepage-welcome-block-right-bg,
    .homepage-welcome-block-wrapper {
        background-color: <?php echo esc_html($theme_main_color); ?>;
    }
    a,
    a:focus,
    blockquote:before,
    .blog-post .format-quote .entry-content:before,
    .blog-post .post-header-title sup,
    .blog-post-related-item .blog-post-related-title:hover,
    .post-social a:hover,
    .blog-style-3 .blog-posts-list.blog-masonry-layout .blog-post .sticky:not(.sticky-post-without-image) a.more-link,
    .blog-style-4 .blog-posts-list.blog-masonry-layout .blog-post .sticky:not(.sticky-post-without-image) a.more-link,
    .sidebar .widget_text a,
    body .select2-results .select2-highlighted,
    .blog-style-3 a.more-link.visible:hover,
    .blog-style-3 .blog-posts-list.blog-masonry-layout .blog-post a.more-link:hover,
    .blog-style-4 .blog-post .post-info a,
    .blog-style-4 .blog-posts-list.blog-masonry-layout .blog-post a.more-link:hover,
    .navbar .nav > li > a:hover,
    .nav .sub-menu li.menu-item > a:hover,
    .nav .children li.menu-item > a:hover,
    .header-info-text a:hover,
    .header-menu li a:hover,
    .blog-style-5 .blog-post .post-categories a {
        color: <?php echo esc_html($theme_main_color); ?>;
    }
    a.btn,
    .btn,
    .btn:focus,
    input[type="submit"],
    .wp-block-button a,
    .woocommerce #content input.button,
    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce button.button,
    .woocommerce input.button,
    .woocommerce-page #content input.button,
    .woocommerce-page #respond input#submit,
    .woocommerce-page a.button,
    .woocommerce-page button.button,
    .woocommerce-page input.button,
    .woocommerce a.added_to_cart,
    .woocommerce-page a.added_to_cart,
    a.more-link,
    .woocommerce #content input.button.alt,
    .woocommerce #respond input#submit.alt,
    .woocommerce a.button.alt,
    .woocommerce button.button.alt,
    .woocommerce input.button.alt,
    .woocommerce-page #content input.button.alt,
    .woocommerce-page #respond input#submit.alt,
    .woocommerce-page a.button.alt,
    .woocommerce-page button.button.alt,
    .woocommerce-page input.button.alt,
    .sidebar .widgettitle,
    .sidebar .widget_calendar tbody td a,
    .piemont-post-list .piemont-post-details .piemont-read-more a:hover,
    body .owl-theme .owl-controls .owl-page.active span,
    body .owl-theme .owl-controls.clickable .owl-page:hover span,
    .footer-signup-wrapper input[type="submit"]:hover,
    .blog-style-3 a.more-link.visible:hover,
    .blog-style-3 .blog-posts-list.blog-masonry-layout .blog-post a.more-link:hover,
    .blog-style-3 a.btn:hover,
    .blog-style-3 .sidebar .widget_text a.btn:hover,
    .blog-style-3 .btn:hover,
    .blog-style-3 .btn:focus:hover,
    .blog-style-3 input[type="submit"]:hover,
    .blog-style-3 .woocommerce #content input.button:hover,
    .blog-style-3 .woocommerce #respond input#submit:hover,
    .blog-style-3 .woocommerce a.button:hover,
    .blog-style-3 .woocommerce button.button:hover,
    .blog-style-3 .woocommerce input.button:hover,
    .blog-style-3 .woocommerce-page #content input.button:hover,
    .blog-style-3 .woocommerce-page #respond input#submit:hover,
    .blog-style-3 .woocommerce-page a.button:hover,
    .blog-style-3 .woocommerce-page button.button:hover,
    .blog-style-3 .woocommerce-page input.button:hover,
    .blog-style-3 .woocommerce a.added_to_cart:hover,
    .blog-style-3 .woocommerce-page a.added_to_cart:hover,
    .blog-style-3 .blog-post .more-link:hover {
        border-color: <?php echo esc_html($theme_main_color); ?>;
    }
    header {
        background-color: <?php echo esc_html($theme_header_bg_color); ?>;
    }
    .mainmenu-belowheader {
        background-color: <?php echo esc_html($theme_cat_menu_bg_color); ?>;
    }
    .footer-sidebar-2-wrapper,
    footer {
        background-color: <?php echo esc_html($theme_footer_color); ?>;
    }
    .blog-masonry-layout .blog-post.content-block .post-content,
    .blog-post-list-layout.blog-post {
        background-color: <?php echo esc_html($theme_masonry_bg_color); ?>;
    }

    <?php

    	$out = ob_get_clean();

		$out .= ' /*' . date("Y-m-d H:i") . '*/';
		/* RETURN */
		return $out;
	}
?>
