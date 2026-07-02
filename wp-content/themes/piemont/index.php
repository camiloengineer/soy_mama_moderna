<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Piemont
 */

get_header();

$piemont_theme_options = piemont_get_theme_options();

// Demo settings
if ( defined('DEMO_MODE') && isset($_GET['blog_sidebar_position']) ) {
  $piemont_theme_options['blog_sidebar_position'] = $_GET['blog_sidebar_position'];
}

if ( defined('DEMO_MODE') && isset($_GET['blog_homepage_slider_fullwidth']) ) {
  if($_GET['blog_homepage_slider_fullwidth'] == 1) {
    $piemont_theme_options['blog_homepage_slider_fullwidth'] = true;
  }
  if($_GET['blog_homepage_slider_fullwidth'] == 0) {
    $piemont_theme_options['blog_homepage_slider_fullwidth'] = false;
  }
}

if(!isset($piemont_theme_options['blog_sidebar_position'])) {
	$piemont_theme_options['blog_sidebar_position'] = 'disable';
}

$blog_sidebarposition = $piemont_theme_options['blog_sidebar_position'];

if(is_active_sidebar( 'main-sidebar' ) && ($blog_sidebarposition <> 'disable') ) {
	$span_class = 'col-md-9';
}
else {
	$span_class = 'col-md-12';
}

// Blog layout
if(isset($piemont_theme_options['blog_layout'])) {
	$blog_layout = $piemont_theme_options['blog_layout'];
} else {
	$blog_layout = 'layout_default';
}

if($blog_layout == 'layout_masonry') {

	wp_register_script('masonry', get_template_directory_uri() . '/js/query.masonry.min.js');
	wp_enqueue_script('masonry');

	$blog_enable_masonry_design = true;
	$blog_masonry_class = ' blog-masonry-layout';
} else {
	$blog_enable_masonry_design = false;
	$blog_masonry_class = '';
}

$temp_query = $wp_query;

?>
<?php if($blog_layout == 'layout_masonry'): ?>
<?php
wp_add_inline_script( 'masonry', '(function($){

"use strict";

$(document).ready(function() {
	var $container = $(".blog-masonry-layout");
	$container.imagesLoaded(function(){
	  $container.masonry({
	    itemSelector : ".blog-masonry-layout .blog-post"
	  });
	});
});

})(jQuery);');
?>
<?php endif; ?>
<div class="content-block">
	<?php if(isset($piemont_theme_options['blog_enable_homepage_slider']) && $piemont_theme_options['blog_enable_homepage_slider']): ?>
	<?php if(isset($piemont_theme_options['blog_homepage_slider_fullwidth']) && ($piemont_theme_options['blog_homepage_slider_fullwidth'] == 1)) {
		$slider_container_class = 'container-fluid piemont-blog-posts-slider';
	} else {
		$slider_container_class = 'container piemont-blog-posts-slider';
	}
	?>
	<div class="<?php echo esc_attr($slider_container_class); ?>">
		<div class="row">

			<div class="col-md-12">
				<?php piemont_blog_slider_show(); ?>
			</div>

		</div>
	</div>
	<?php endif; ?>

	<?php if(isset($piemont_theme_options['blog_enable_homepage_welcome_block']) && $piemont_theme_options['blog_enable_homepage_welcome_block']): ?>
	<div class="container homepage-welcome-block-container">
		<div class="row">

			<div class="col-md-12">
				<div class="homepage-welcome-block-wrapper">
				<?php piemont_welcome_block_show(); ?>
				</div>
			</div>

		</div>
	</div>
	<?php endif; ?>

	<?php if(isset($piemont_theme_options['blog_enable_homepage_welcome_block_2']) && $piemont_theme_options['blog_enable_homepage_welcome_block_2']): ?>
	<div class="container homepage-welcome-block-2-container">
		<div class="row">

			<div class="col-md-12">
				<div class="homepage-welcome-block-2-wrapper">
				<?php piemont_welcome_block_2_show(); ?>
				</div>
			</div>

		</div>
	</div>
	<?php endif; ?>


	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $blog_sidebarposition == 'left')) : ?>
			<div class="col-md-3 main-sidebar sidebar">
			<ul id="main-sidebar">
			  <?php dynamic_sidebar( 'main-sidebar' ); ?>
			</ul>
			</div>
			<?php endif; ?>

			<div class="<?php echo esc_attr($span_class);?>">
			<div class="blog-posts-list<?php echo esc_attr($blog_masonry_class);?>" id="content">
			<?php

			$wp_query = $temp_query;

			?>
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */
				$post_loop_id = 1;
				?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						$post_loop_details['post_loop_id'] = $post_loop_id;

						piemont_set_post_details($post_loop_details);

						get_template_part( 'content', get_post_format() );

						$post_loop_id++;
					?>

				<?php endwhile; ?>




			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>
			</div>
			<?php piemont_content_nav( 'nav-below' ); ?>
			</div>
			<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $blog_sidebarposition == 'right')) : ?>
			<div class="col-md-3 main-sidebar sidebar">
			<ul id="main-sidebar">
			  <?php dynamic_sidebar( 'main-sidebar' ); ?>
			</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
