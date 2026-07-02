<?php
/**
 * Plugin recomendations
 **/
$piemont_theme_options = piemont_get_theme_options();

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

require_once ('class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'piemont_register_required_plugins' );

function piemont_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name'                  => esc_html__('Piemont Custom Metaboxes', 'piemont'), // The plugin name
            'slug'                  => 'cmb2', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/cmb2.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.6.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => esc_html__('Piemont Theme Addons', 'piemont'),
            'slug'                  => 'piemont-theme-addons',
            'source'                => get_template_directory() . '/inc/plugins/piemont-theme-addons.zip',
            'required'              => true,
            'version'               => '2.0',
        ),
        array(
            'name'                  => esc_html__('WooCommerce', 'piemont'), // The plugin name
            'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                  => esc_html__('Piemont Translation Manager', 'piemont'), // The plugin name
            'slug'                  => 'loco-translate', // The plugin slug (typically the folder name)
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                  => esc_html__('Instagram Feed', 'piemont'), // The plugin name
            'slug'                  => 'instagram-feed', // The plugin slug (typically the folder name)
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                  => esc_html__('MailChimp for WordPress (Newsletter signup)', 'piemont'), // The plugin name
            'slug'                  => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                  => esc_html__('WordPress LightBox', 'piemont'), // The plugin name
            'slug'                  => 'responsive-lightbox', // The plugin slug (typically the folder name)
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                  => esc_html__('Contact Form 7', 'piemont'), // The plugin name
            'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                  => esc_html__('Regenerate Thumbnails', 'piemont'), // The plugin name
            'slug'                  => 'regenerate-thumbnails', // The plugin slug (typically the folder name)
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'                  => esc_html__('WP Retina 2x', 'piemont'), // The plugin name
            'slug'                  => 'wp-retina-2x', // The plugin slug (typically the folder name)
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
        )

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'piemont',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'menu'              => 'install-required-plugins',  // Menu slug
        'has_notices'       => true,                        // Show admin notices or not
        'dismissable'  => true,
        'is_automatic'      => true,                       // Automatically activate plugins after installation or not
        'message'           => ''                          // Message to output right before the plugins table
    );

    tgmpa( $plugins, $config );

}

/* Widgets */

function piemont_sidebars_init() {

    register_sidebar(
      array(
        'name' => esc_html__( 'Left/Right sidebar', 'piemont' ),
        'id' => 'main-sidebar',
        'description' => esc_html__( 'Widgets in this area will be shown in the left or right site column.', 'piemont' )
      )
    );

    register_sidebar(
      array(
        'name' => esc_html__( 'Offcanvas Right sidebar', 'piemont' ),
        'id' => 'offcanvas-sidebar',
        'description' => esc_html__( 'Widgets in this area will be shown in the right floating offcanvas menu sidebar that can be opened by toggle button in header. You can enable this sidebar in theme control panel.', 'piemont' )
      )
    );

    register_sidebar(
      array(
        'name' => esc_html__( 'Footer light sidebar', 'piemont' ),
        'id' => 'footer-sidebar',
        'description' => esc_html__( 'Widgets in this area will be shown in site footer in 4 column.', 'piemont' )
      )
    );

    register_sidebar(
      array(
        'name' => esc_html__( 'Footer dark sidebar', 'piemont' ),
        'id' => 'footer-sidebar-2',
        'description' => esc_html__( 'Widgets in this area will be shown in site footer in 4 column after Footer sidebar #1.', 'piemont' )
      )
    );
}
add_action( 'widgets_init', 'piemont_sidebars_init' );

// Customisation Menu Links
class piemont_description_walker extends Walker_Nav_Menu{
      function start_el(&$output, $item, $depth = 0, $args = Array(), $current_object_id = 0 ){
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
           $class_names = $value = '';
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

           $add_class = '';

           $post = get_post($item->object_id);

               $class_names = ' class="'.$add_class.' '. esc_attr( $class_names ) . '"';
               $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
               $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
               $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
               $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

                    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

                if (is_object($args)) {
                    $item_output = $args->before;
                    $item_output .= '<a'. $attributes .'>';
                    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
                    $item_output .= $args->link_after;
                    if($item->description !== '') {
                        $item_output .= '<span>'.$item->description.'</span>';
                    }

                    $item_output .= '</a>';
                    $item_output .= $args->after;
                    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

                }
     }
}

function piemont_google_fonts_url() {

    $piemont_theme_options = piemont_get_theme_options();

    $font_url = '';
    $font_header = '';
    $font_body = '';
    $font_additional = '';

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

    if(!isset($piemont_theme_options['font_google_disable']) || $piemont_theme_options['font_google_disable'] == false) {

        // Header font
        if(isset($piemont_theme_options['header_font'])) {
            $font_header = $piemont_theme_options['header_font']['font-family'];

            if(isset($piemont_theme_options['header_font_options'])) {
                $font_header = $font_header.':'.$piemont_theme_options['header_font_options'];
            }
        }
        // Body font
        if(isset($piemont_theme_options['body_font'])) {
            $font_body = '|'.$piemont_theme_options['body_font']['font-family'];

            if(isset($piemont_theme_options['body_font_options'])) {
                $font_body = $font_body.':'.$piemont_theme_options['body_font_options'];
            }
        }
        // Additional font
        if(isset($piemont_theme_options['additional_font_enable']) && $piemont_theme_options['additional_font_enable']) {
            if(isset($piemont_theme_options['additional_font'])) {
                $font_additional = '|'.$piemont_theme_options['additional_font']['font-family'].'|';
            }
        }

        // Build Google Fonts request
        $font_url = add_query_arg( 'family', urlencode( $font_header.$font_body.$font_additional ), "//fonts.googleapis.com/css" );

    }

    return $font_url;
}

// Custom layout functions
function piemont_header_promo_show() {
    $piemont_theme_options = piemont_get_theme_options();

    echo '<div class="header-promo-content">'.($piemont_theme_options['header_banner_editor']).'</div>';
}

function piemont_logo_show() {
    ?>
    <div class="logo">
    <a class="logo-link" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url(get_header_image()); ?>" alt="<?php bloginfo('name'); ?>"></a>
    <?php if(get_bloginfo('description')!=='') {
      echo '<div class="header-blog-info">';
      bloginfo('description');
      echo '</div>';
    }
    ?>
    </div>
    <?php
}

function piemont_menu_below_header_show() {
    $piemont_theme_options = piemont_get_theme_options();

    // Demo settings
    if ( defined('DEMO_MODE') && isset($_GET['header_menu_style']) ) {
      $piemont_theme_options['header_menu_style'] = esc_html($_GET['header_menu_style']);
    }
    if ( defined('DEMO_MODE') && isset($_GET['header_menu_align']) ) {
      $piemont_theme_options['header_menu_align'] = esc_html($_GET['header_menu_align']);
    }

    // MainMenu styles
    $menu_add_class = '';

    if(isset($piemont_theme_options['header_menu_style'])) {
        $menu_add_class = ' '.$piemont_theme_options['header_menu_style'];
    }
    if(isset($piemont_theme_options['header_menu_font_decoration'])) {
        $menu_add_class .= ' mainmenu-'.esc_html($piemont_theme_options['header_menu_font_decoration']);
    }
    if(isset($piemont_theme_options['header_menu_font_size'])) {
        $menu_add_class .= ' mainmenu-'.esc_html($piemont_theme_options['header_menu_font_size']);
    }
    if(isset($piemont_theme_options['header_menu_arrow_style'])) {
        $menu_add_class .= ' mainmenu-'.esc_html($piemont_theme_options['header_menu_arrow_style']);
    }
    if((isset($piemont_theme_options['header_menu_align'])) && ($piemont_theme_options['header_menu_align'] == 'menu_center')) {
        $menu_add_class .= ' menu-center';
    }

    ?>

    <?php
    // Main Menu

    $menu = wp_nav_menu(
        array (
            'theme_location'  => 'primary',
            'echo' => FALSE,
            'fallback_cb' => '__return_false'
        )
    );

    if (!empty($menu)):

    ?>
    <div class="mainmenu-belowheader<?php echo esc_attr($menu_add_class); ?>">
        <div class="mainmenu-belowheader-spacer"></div>
        <div id="navbar" class="navbar navbar-default clearfix">
          <div class="navbar-inner">
              <div class="container">

              <div class="navbar-toggle" data-toggle="collapse" data-target=".collapse">
                <?php _e( 'Menu', 'piemont' ); ?>
              </div>

              <?php

                 wp_nav_menu(array(
                  'theme_location'  => 'primary',
                  'container_class' => 'navbar-collapse collapse',
                  'menu_class'      => 'nav',
                  'walker'          => new piemont_description_walker
                  ));

              ?>
              </div>
          </div>
        </div>
    </div>
    <?php endif; ?>

    <?php
    // MainMenu Below header position END
}

function piemont_header_left_show() {
    $piemont_theme_options = piemont_get_theme_options();

    // Show header banner
    if((isset($piemont_theme_options['header_banner_editor'])) && ($piemont_theme_options['header_banner_editor'] <> '') && (isset($piemont_theme_options['header_banner_position'])) && ($piemont_theme_options['header_banner_position'] == 'left')){
        piemont_header_promo_show();
    }

    if((isset($piemont_theme_options['header_logo_position'])) && ($piemont_theme_options['header_logo_position'] == 'left')) {
        piemont_logo_show();
    }

}

function piemont_header_center_show() {
    $piemont_theme_options = piemont_get_theme_options();

    if((isset($piemont_theme_options['header_logo_position'])) && ($piemont_theme_options['header_logo_position'] == 'center')) {
        piemont_logo_show();
    }
}

function piemont_header_right_show() {
    $piemont_theme_options = piemont_get_theme_options();

    if((isset($piemont_theme_options['header_logo_position'])) && ($piemont_theme_options['header_logo_position'] == 'right')) {
        piemont_logo_show();
    }

    // Show header banner
    if((isset($piemont_theme_options['header_banner_editor'])) && ($piemont_theme_options['header_banner_editor'] <> '') && (isset($piemont_theme_options['header_banner_position'])) && ($piemont_theme_options['header_banner_position'] == 'right')){
        piemont_header_promo_show();
    }

    // Demo settings
    if ( defined('DEMO_MODE') && isset($_GET['enable_offcanvas_sidebar']) ) {
      $piemont_theme_options['enable_offcanvas_sidebar'] = $_GET['enable_offcanvas_sidebar'];
    }

    ?>
    <ul class="header-nav">
        <?php
            if(isset($piemont_theme_options['enable_offcanvas_sidebar'])&&($piemont_theme_options['enable_offcanvas_sidebar'])):
        ?>
        <li class="float-sidebar-toggle"><div id="st-sidebar-trigger-effects"><a class="float-sidebar-toggle-btn" data-effect="st-sidebar-effect-2"><i class="fa fa-bars"></i></a></div></li>
        <?php endif; ?>
    </ul>
<?php
}

function piemont_blog_slider_show() {
    global $post;

    $piemont_theme_options = piemont_get_theme_options();

    // Demo settings
    if ( defined('DEMO_MODE') && isset($_GET['blog_homepage_slider_style']) ) {
      $piemont_theme_options['blog_homepage_slider_style'] = $_GET['blog_homepage_slider_style'];
    }
    if ( defined('DEMO_MODE') && isset($_GET['blog_homepage_slider_fullwidth']) ) {
      if($_GET['blog_homepage_slider_fullwidth'] == 1) {
        $piemont_theme_options['blog_homepage_slider_fullwidth'] = true;
      }
      if($_GET['blog_homepage_slider_fullwidth'] == 0) {
        $piemont_theme_options['blog_homepage_slider_fullwidth'] = false;
      }
    }

    $args = array(
        'posts_per_page'   => 0,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'meta_key'         => '_post_featured_value',
        'meta_value'         => 'on',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true
    );

    $posts = get_posts( $args );

    $total_posts = sizeof($posts);

    if($total_posts > 0) {
        if(isset($piemont_theme_options['post_info_separator'])) {
            $post_info_separator = $piemont_theme_options['post_info_separator'];
        } else {
            $post_info_separator = '*';
        }

        if(isset($piemont_theme_options['blog_homepage_slider_autoplay'])) {
            $slider_style = $piemont_theme_options['blog_homepage_slider_style'];
        } else {
            $slider_style = 1;
        }

        $style = ' style="display: none;"';

        if($slider_style == 4) {
            $style = '';
        }

        if(isset($piemont_theme_options['blog_homepage_slider_autoplay'])) {
            $slider_autoplay = $piemont_theme_options['blog_homepage_slider_autoplay'];
        } else {
            $slider_autoplay = 1;
        }
        if(isset($piemont_theme_options['blog_homepage_slider_navigation'])) {
            $slider_navigation = $piemont_theme_options['blog_homepage_slider_navigation'];
        } else {
            $slider_navigation = 1;
        }
        if(isset($piemont_theme_options['blog_homepage_slider_pagination'])) {
            $slider_pagination = $piemont_theme_options['blog_homepage_slider_pagination'];
        } else {
            $slider_pagination = 1;
        }

        if($slider_autoplay == 1) {
            $slider_autoplay = 'true';
        } else {
            $slider_autoplay = 'false';
        }
        if($slider_navigation == 1) {
            $slider_navigation = 'true';
        } else {
            $slider_navigation = 'false';
        }
        if($slider_pagination == 1) {
            $slider_pagination = 'true';
        } else {
            $slider_pagination = 'false';
        }

        echo '<div class="piemont-post-list-wrapper piemont-post-wrapper-style-'.$slider_style.' clearfix">';


        echo '<div id="piemont-post-list" class="piemont-post-list piemont-post-style-'.$slider_style.'"'.$style.'>';

        $i = 0;

        foreach($posts as $post) {

            if($slider_style == 4) {
                if($i == 3) {
                    break;
                }
            }

            setup_postdata($post);

            echo '<div class="piemont-post">';

            if((isset($piemont_theme_options['blog_homepage_slider_fullwidth'])&&$piemont_theme_options['blog_homepage_slider_fullwidth']) && (isset($piemont_theme_options['blog_homepage_slider_style'])&&$piemont_theme_options['blog_homepage_slider_style'] < 3)) {
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
            } else {
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-thumb');
            }

            if(has_post_thumbnail( $post->ID )) {
                $image_bg ='background-image: url('.$image[0].');';
            }
            else {
                $image_bg = '';
            }

            $categories_list = get_the_category_list( ', ' );

            // Get next post details for slider style 2
            if($slider_style == 2) {

                if($i == $total_posts-1) {
                    $next_post_data = $posts[0];
                    $next_post_class = ' last';
                } else {
                    $next_post_data = $posts[$i+1];
                    $next_post_class = '';
                }

                $next_image = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post_data->ID ), 'blog-thumb');

                if(has_post_thumbnail( $next_post_data->ID )) {
                    $nextpost_image_bg ='background-image: url('.$next_image[0].');';
                } else {
                    $nextpost_image_bg ='';
                }

                $next_post_box_html = '<div class="piemont-next-post'.$next_post_class.'" data-style="'.esc_attr($nextpost_image_bg).'"><div class="piemont-next-post-text">'.esc_html__('Next', 'piemont').'</div></div>';
            } else {
                $next_post_box_html = '';
            }

            if(isset($piemont_theme_options['blog_post_show_author'])&&($piemont_theme_options['blog_post_show_author'])) {
                $author_info_html = $post_info_separator.' '.esc_html__('by ', 'piemont').get_the_author();
            } else {
                $author_info_html = '';
            }

            echo '<div class="piemont-post-image" data-style="'.esc_attr($image_bg).'"><div class="piemont-post-image-wrapper">
            <div class="piemont-post-details">
                <div class="piemont-post-box">'.$next_post_box_html.'</div>
                <div class="piemont-post-category">'.wp_kses_post($categories_list).'</div>
                <div class="piemont-post-title"><a href="'.get_permalink($post->ID).'"><h2>'.esc_html($post->post_title).'</h2></a></div>
                <div class="piemont-post-date">'.get_the_time( get_option( 'date_format' ), $post->ID ).' '.$author_info_html.'</div>
                <div class="piemont-read-more"><a class="btn" href="'.get_permalink($post->ID).'">'.esc_html__('Read more', 'piemont').'</a></div>
            </div>
            </div></div>';

            echo '</div>';

            $i++;

        }

        wp_reset_postdata();

        echo '</div>';
        echo '</div>';

        // Slider items per row
        $slider_slides = 1;

        if($slider_style == 3) {
            $slider_slides = 3;
        }

        if(in_array($slider_style, array(1,2,3))) {

            wp_add_inline_script('piemont-script', '(function($){
            $(document).ready(function() {
                "use strict";
                $("#piemont-post-list").owlCarousel({
                    items: '.esc_js($slider_slides).',
                    itemsDesktop:   [1199,'.esc_js($slider_slides).'],
                    itemsDesktopSmall: [979,1],
                    itemsTablet: [768,1],
                    itemsMobile : [479,1],
                    autoPlay: '.esc_js($slider_autoplay).',
                    navigation: '.esc_js($slider_navigation).',
                    navigationText : false,
                    pagination: '.esc_js($slider_pagination).',
                    afterInit : function(elem){
                        $(this).css("display", "block");
                    }
                });

                $(".piemont-post-list.piemont-post-style-2 .piemont-next-post").on("click", function(e){
                    $("#piemont-post-list").trigger("owl.next");
                });

                $(".piemont-post-list.piemont-post-style-2 .piemont-next-post.last").on("click", function(e){
                    $("#piemont-post-list").trigger("owl.goTo(1)");
                });

            });})(jQuery);');
        }
    }


}

/* Homepage Welcome Block */
function piemont_welcome_block_show() {

    $piemont_theme_options = piemont_get_theme_options();

    if(isset($piemont_theme_options['blog_homepage_welcome_block_image']) && $piemont_theme_options['blog_homepage_welcome_block_image']['url'] <> '') {
        $welcome_block_has_image = true;
    } else {
        $welcome_block_has_image = false;
    }

    if($welcome_block_has_image) {
        echo '<div class="homepage-welcome-block homepage-welcome-block-with-image">';
    } else {
        echo '<div class="homepage-welcome-block">';
    }

    echo '<div class="homepage-welcome-block-content">';
    echo wp_kses_post($piemont_theme_options['blog_homepage_welcome_block_content']);
    echo '</div>';

    if($welcome_block_has_image) {
      echo '<div class="homepage-welcome-block-right-bg"></div>';
      echo '<div class="homepage-welcome-block-image"><img src="'.esc_url($piemont_theme_options['blog_homepage_welcome_block_image']['url']).'" alt="'.get_bloginfo('name').'" /></div>';
    }

    echo '</div>';

}

function piemont_welcome_block_2_show() {

    $piemont_theme_options = piemont_get_theme_options();

    echo '<div class="homepage-welcome-block-2">';

    echo '<div class="homepage-welcome-block-2-content">';

    if(isset($piemont_theme_options['blog_homepage_welcome_block_2_content'])) {
        echo wp_kses_post($piemont_theme_options['blog_homepage_welcome_block_2_content']);
    }

    echo '</div>';

    echo '</div>';

}

/* Blog post excerpt read more */
function piemont_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'piemont_excerpt_more');
