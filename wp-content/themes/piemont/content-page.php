<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Piemont
 */

$piemont_theme_options = piemont_get_theme_options();
?>

<?php

  $page_sidebarposition = get_post_meta( $post->ID, '_page_sidebarposition_value', true );
  $page_notdisplaytitle = get_post_meta( $post->ID, '_page_notdisplaytitle_value', true );

  if(!isset($page_sidebarposition)||($page_sidebarposition == '')) {
    $page_sidebarposition = 0;
  }

  if($page_sidebarposition == "0") {
    $page_sidebarposition = $piemont_theme_options['page_sidebar_position'];
  }

  $page_class = get_post_meta( $post->ID, '_page_class_value', true );

  if(is_active_sidebar( 'main-sidebar' ) && ($page_sidebarposition <> 'disable')) {
    $span_class = 'col-md-9';
  }
  else {
    $span_class = 'col-md-12';
  }
?>
<div class="content-block <?php echo esc_attr($page_class); ?>">
  <div class="page-container container">
    <div class="row">
      <?php if ( is_active_sidebar( 'main-sidebar' ) && ( $page_sidebarposition == 'left')) : ?>
      <div class="col-md-3 main-sidebar sidebar">
        <ul id="main-sidebar">
          <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </ul>
      </div>
      <?php endif; ?>
			<div class="<?php echo esc_attr($span_class);?>">
      <?php if(!$page_notdisplaytitle): ?>
      <div class="page-item-title">
      <h1><?php the_title(); ?></h1>
      </div>
      <?php endif; ?>
      <div class="entry-content clearfix">
      <article>
				<?php the_content(); ?>
      </article>
      </div>
        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() )
            comments_template();
        ?>

			</div>
      <?php if ( is_active_sidebar( 'main-sidebar' ) && ( $page_sidebarposition == 'right')) : ?>
      <div class="col-md-3 main-sidebar sidebar">
        <ul id="main-sidebar">
          <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </ul>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
