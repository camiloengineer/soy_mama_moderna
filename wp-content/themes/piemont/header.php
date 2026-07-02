<?php
/**
 * WP Theme Header
 *
 * Displays all of the <head> section
 *
 * @package Piemont
 */
$piemont_theme_options = piemont_get_theme_options();

// Demo settings
if ( defined('DEMO_MODE') && isset($_GET['header_logo_position']) ) {
  $piemont_theme_options['header_logo_position'] = esc_html($_GET['header_logo_position']);
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<?php
// Demo settings
if ( defined('DEMO_MODE') && isset($_GET['blog_style']) ) {
  $piemont_theme_options['blog_style'] = $_GET['blog_style'];
}
if ( defined('DEMO_MODE') && isset($_GET['blog_layout']) ) {
  $piemont_theme_options['blog_layout'] = $_GET['blog_layout'];
}

// Blog styles
if(isset($piemont_theme_options['blog_style'])) {
  $blog_style = $piemont_theme_options['blog_style'];
} else {
  $blog_style = 1;
}

$blog_style_class = 'blog-style-'.$blog_style;

// Slider on/off
if(isset($piemont_theme_options['blog_enable_homepage_slider'])) {
  $blog_enable_homepage_slider = $piemont_theme_options['blog_enable_homepage_slider'];
} else {
  $blog_enable_homepage_slider = false;
}

if($blog_enable_homepage_slider) {
  $blog_style_class .= ' blog-slider-enable';
} else {
  $blog_style_class .= ' blog-slider-disable';
}

?>
<body <?php echo body_class(esc_attr($blog_style_class)); ?>>

<?php do_action( 'before' ); ?>

<?php if(isset($piemont_theme_options['disable_top_menu']) && !$piemont_theme_options['disable_top_menu']): ?>
<?php

// Sticky top header
if(isset($piemont_theme_options['enable_sticky_header']) && $piemont_theme_options['enable_sticky_header']) {
  $header_add_class = ' '.esc_attr('sticky-header');
} else {
  $header_add_class = '';
}
if(isset($piemont_theme_options['header_top_menu_style'])) {
  $header_top_menu_style = $piemont_theme_options['header_top_menu_style'];
  $header_add_class .= ' '.esc_attr($header_top_menu_style);
}

?>
<div class="header-menu-bg<?php echo esc_attr($header_add_class); ?>">
  <div class="header-menu">
    <div class="container">
      <div class="row">
          <div class="col-md-6">
          <div class="menu-top-menu-container-toggle"></div>
          <?php
          wp_nav_menu(array(
            'theme_location'  => 'top',
            'menu_class'      => 'links'
            ));
          ?>
        </div>
        <div class="col-md-6">

            <?php

            $social_services_arr = Array("facebook", "vk","twitter", "google-plus", "linkedin", "dribbble", "behance", "instagram", "tumblr", "pinterest", "vimeo-square", "youtube", "skype");

            $s_count = 0;

            $social_services_html = '';

            foreach( $social_services_arr as $ss_data ){
              if(isset($piemont_theme_options[$ss_data]) && (trim($piemont_theme_options[$ss_data])) <> '') {
                $s_count++;
                $social_service_url = $piemont_theme_options[$ss_data];
                $social_service = $ss_data;
                $social_services_html .= '<a href="'.esc_url($social_service_url).'" target="_blank" class="a-'.esc_attr($social_service).'"><i class="fa fa-'.esc_attr($social_service).'"></i></a>';
              }
            }

            if($social_services_html <> '') {
              echo '<div class="header-info-text">'.$social_services_html.'</div>';
            }

            ?>
            <div class="search-bar-header">
              <?php
              if(isset($piemont_theme_options['disable_top_menu_search']) && !$piemont_theme_options['disable_top_menu_search']) {
                echo get_search_form();
              }
              ?>
            </div>
        </div>


      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php

// Center logo
if(isset($piemont_theme_options['header_logo_position'])) {
  $header_container_add_class = ' header-logo-'.$piemont_theme_options['header_logo_position'];
} else {
  $header_container_add_class = '';
}
?>

<?php
// Disable header
if(!isset($piemont_theme_options['disable_header'])) {
  $piemont_theme_options['disable_header'] = false;
}

if(isset($piemont_theme_options['disable_header']) && !$piemont_theme_options['disable_header']):
?>
<header>
<div class="container<?php echo esc_attr($header_container_add_class); ?>">
  <div class="row">
    <div class="col-md-12">

      <div class="header-left">
        <?php piemont_header_left_show(); ?>
      </div>

      <div class="header-center">
        <?php piemont_header_center_show(); ?>
      </div>

      <div class="header-right">
        <?php piemont_header_right_show(); ?>
      </div>
    </div>
  </div>

</div>
<?php piemont_menu_below_header_show(); ?>
</header>
<?php endif; ?>
