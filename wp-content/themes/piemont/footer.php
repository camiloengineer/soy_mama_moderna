<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Piemont
 */
?>
<?php
$piemont_theme_options = piemont_get_theme_options();

$show_footer_sidebar_1 = true;

if(isset($piemont_theme_options['footer_sidebar_1_homepage_only']) && ($piemont_theme_options['footer_sidebar_1_homepage_only']) && is_front_page()) {
  $show_footer_sidebar_1 = true;
}
if(isset($piemont_theme_options['footer_sidebar_1_homepage_only']) && ($piemont_theme_options['footer_sidebar_1_homepage_only']) && !is_front_page()) {
  $show_footer_sidebar_1 = false;
}
?>

<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
  <?php if($show_footer_sidebar_1): ?>
  <div class="footer-sidebar-wrapper clearfix">
    <div class="footer-sidebar sidebar container">
      <ul id="footer-sidebar">
        <?php dynamic_sidebar( 'footer-sidebar' ); ?>
      </ul>
    </div>
  </div>
  <?php endif; ?>
<?php endif; ?>
<?php
// Instagram feed
if(isset($piemont_theme_options['footer_instagram_display']) && ($piemont_theme_options['footer_instagram_display'])) {


    echo '<div class="footer-instagram-wrapper">';

    if(isset($piemont_theme_options['footer_instagram_title']) && $piemont_theme_options['footer_instagram_title'] <> '') {
      echo '<h5>'.esc_html($piemont_theme_options['footer_instagram_title']).'</h5>';
    }

    echo do_shortcode('[instagram-feed]');
    echo '</div>';


}
?>
<?php
// Instagram feed
if(isset($piemont_theme_options['footer_signup_display']) && ($piemont_theme_options['footer_signup_display'])) {
  echo '<div class="footer-signup-wrapper"><div class="container"><div class="row">';
  echo do_shortcode('[mc4wp_form]');
  echo '</div></div></div>';
}
?>
<div class="container-fluid container-fluid-footer">
  <div class="row">
    <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
    <div class="footer-sidebar-2-wrapper">
      <div class="footer-sidebar-2 sidebar container footer-container">

        <ul id="footer-sidebar-2" class="clearfix">
          <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
        </ul>

      </div>
    </div>
    <?php endif; ?>
    <?php
    if(!isset($piemont_theme_options['footer_style'])) {
      $piemont_theme_options['footer_style'] = 'mini';
    }

    $footer_style_class = 'footer-style-'.$piemont_theme_options['footer_style'];

    ?>
    <footer class="<?php echo esc_attr($footer_style_class); ?>">
      <div class="container">
      <div class="row">
          <?php if(isset($piemont_theme_options['footer_logo']) && $piemont_theme_options['footer_logo']['url'] <> ''):?>
          <div class="col-md-12 footer-logo">
            <?php
              echo '<a class="logo-link" href="'.esc_url(site_url()).'"><img src="'.esc_url($piemont_theme_options['footer_logo']['url']).'" alt="'.esc_attr(get_bloginfo('name')).'" /></a>';
            ?>
          </div>
          <?php endif; ?>
          <div class="col-md-6 footer-menu">
            <?php
              wp_nav_menu(array(
                'theme_location'  => 'footer',
                'menu_class'      => 'footer-links'
                ));
            ?>
          </div>
          <div class="col-md-6 copyright">
              <?php
              if(isset($piemont_theme_options['footer_copyright_editor'])) {
                echo wp_kses_post($piemont_theme_options['footer_copyright_editor']);
              }
              ?>
          </div>
          <?php if(isset($piemont_theme_options['footer_top_button']) && $piemont_theme_options['footer_top_button']):?>
          <div class="col-md-12 footer-top-button">
             <div id="footer-top-button"></div>
          </div>
          <?php endif; ?>
      </div>
      </div>
      <a id="top-link" href="#top"></a>
    </footer>

  </div>
</div>

<?php

    // Demo settings
    if ( defined('DEMO_MODE') && isset($_GET['enable_offcanvas_sidebar']) ) {
      $piemont_theme_options['enable_offcanvas_sidebar'] = $_GET['enable_offcanvas_sidebar'];
    }

    if(isset($piemont_theme_options['enable_offcanvas_sidebar'])&&($piemont_theme_options['enable_offcanvas_sidebar'])):
?>
      <nav id="offcanvas-sidebar-nav" class="st-sidebar-menu st-sidebar-effect-2">
      <div class="st-sidebar-menu-close-btn">×</div>
        <?php if ( is_active_sidebar( 'offcanvas-sidebar' ) ) : ?>
          <div class="offcanvas-sidebar sidebar">
          <ul id="offcanvas-sidebar" class="clearfix">
            <?php dynamic_sidebar( 'offcanvas-sidebar' ); ?>
          </ul>
          </div>
        <?php endif; ?>
      </nav>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
