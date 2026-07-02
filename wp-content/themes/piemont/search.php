<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Piemont
 */

get_header();

$piemont_theme_options = piemont_get_theme_options();

$search_sidebarposition = esc_html($piemont_theme_options['search_sidebar_position']);

if(is_active_sidebar( 'main-sidebar' ) && ($search_sidebarposition <> 'disable') ) {
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
	<div class="container-fluid container-page-item-title">
		<div class="row">
		<div class="col-md-12">
			<div class="page-item-title-archive">
			<?php
				echo '<p>'.esc_html__( 'Search Results', 'piemont' ).'</p>';
				echo ( '<h1>' . get_search_query() . '</h1>' );
			?>
			</div>
		</div>
		</div>
	</div>
<div class="container">
<div class="row">

<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $search_sidebarposition == 'left')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($span_class); ?>">
		<div class="blog-posts-list<?php echo esc_attr($blog_masonry_class);?>">
<?php /* Start the Loop */ ?>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'search' ); ?>

					<?php endwhile; ?>



				<?php else : ?>

					<?php get_template_part( 'no-results', 'search' ); ?>

				<?php endif; ?>
		</div>
		<?php piemont_content_nav( 'nav-below' ); ?>
		</div>
		<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $search_sidebarposition == 'right')) : ?>
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
