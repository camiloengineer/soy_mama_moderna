<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Piemont
 */

get_header();

$piemont_theme_options = piemont_get_theme_options();

$archive_sidebarposition = $piemont_theme_options['archive_sidebar_position'];

if(is_active_sidebar( 'main-sidebar' ) && ($archive_sidebarposition <> 'disable') ) {
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
			if ( is_category() ) :
				echo '<p>'.esc_html__( 'Category', 'piemont' ).'</p>';
				echo ( '<h1>' . single_cat_title( '', false ) . '</h1>' );

			elseif ( is_tag() ) :

				echo '<p>'.esc_html__( 'Tag', 'piemont' ).'</p>';
				echo ( '<h1>' . single_tag_title( '', false ) . '</h1>' );

			elseif ( is_author() ) :
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				*/
				the_post();
				echo '<p>'.esc_html__( 'Author', 'piemont' ).'</p>';
				echo ( '<h1>' . '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' . '</h1>' );

				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			elseif ( is_day() ) :

				echo '<p>'.esc_html__( 'Daily Archives', 'piemont' ).'</p>';
				echo ( '<h1>' . get_the_date() . '</h1>' );

			elseif ( is_month() ) :

				echo '<p>'.esc_html__( 'Monthly Archives', 'piemont' ).'</p>';
				echo ( '<h1>' . get_the_date( 'F Y' ) . '</h1>' );

			elseif ( is_year() ) :

				echo '<p>'.esc_html__( 'Yearly Archives', 'piemont' ).'</p>';
				echo ( '<h1>' . get_the_date( 'Y' ) . '</h1>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :

				echo '<p>'.esc_html__( 'Post format', 'piemont' ).'</p>';
				echo ( '<h1>' . esc_html_e( 'Aside', 'piemont' ) . '</h1>' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :

				echo '<p>'.esc_html__( 'Post format', 'piemont' ).'</p>';
				echo ( '<h1>' . esc_html_e( 'Images', 'piemont' ) . '</h1>' );

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :

				echo '<p>'.esc_html__( 'Post format', 'piemont' ).'</p>';
				echo ( '<h1>' . esc_html_e( 'Videos', 'piemont' ) . '</h1>' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :

				echo '<p>'.esc_html__( 'Post format', 'piemont' ).'</p>';
				echo ( '<h1>' . esc_html_e( 'Quotes', 'piemont' ) . '</h1>' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :

				echo '<p>'.esc_html__( 'Post format', 'piemont' ).'</p>';
				echo ( '<h1>' . esc_html_e( 'Links', 'piemont' ) . '</h1>' );

			else :

				echo '<p>'.esc_html__( 'Posts', 'piemont' ).'</p>';
				echo ( '<h1>' . esc_html_e( 'Archives', 'piemont' ) . '</h1>' );

			endif;
		?>

	</div>
	</div>
	</div>
</div>
<div class="container">
	<div class="row">
<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $archive_sidebarposition == 'left')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($span_class); ?>">
		<div class="blog-posts-list<?php echo esc_attr($blog_masonry_class);?>">
		<?php
			if ( is_category() ) :
				// show an optional category description
				$category_description = category_description();
				if ( ! empty( $category_description ) ) :
					echo '<div class="container-fluid category-description">
		<div class="row">
		<div class="col-md-12">'.apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . wp_kses_post($category_description) . '</div>' ).'		</div>
		</div>
		</div>';
				endif;

			elseif ( is_tag() ) :
				// show an optional tag description
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) ) :
					echo '<div class="container-fluid taxonomy-description">
		<div class="row">
		<div class="col-md-12">'.apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . wp_kses_post($tag_description) . '</div>' ).'		</div>
		</div>
		</div>';
				endif;

			endif;
		?>
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>



			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>
		</div>
		<?php piemont_content_nav( 'nav-below' ); ?>
		</div>
		<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $archive_sidebarposition == 'right')) : ?>
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
