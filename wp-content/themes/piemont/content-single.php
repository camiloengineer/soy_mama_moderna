<?php
/**
 * @package Piemont
 */

$piemont_theme_options = piemont_get_theme_options();

// Blog styles
if(isset($piemont_theme_options['blog_style'])) {
  $blog_style = $piemont_theme_options['blog_style'];
} else {
  $blog_style = 1;
}

if(isset($piemont_theme_options['post_info_separator'])) {
	$post_info_separator = $piemont_theme_options['post_info_separator'];
} else {
	$post_info_separator = '*';
}

if($blog_style == 1) {
	$post_info_separator = '';
}

if(!isset($piemont_theme_options['blog_post_hide_featured_image'])) {
	$piemont_theme_options['blog_post_hide_featured_image'] = false;
}

$post_classes = get_post_class();

$current_post_format = $post_classes[4];

$post_formats_media = array('format-audio', 'format-video', 'format-gallery');

$post_sidebarposition = get_post_meta( get_the_ID(), '_post_sidebarposition_value', true );
$post_socialshare_disable = get_post_meta( get_the_ID(), '_post_socialshare_disable_value', true );

// Demo settings
if ( defined('DEMO_MODE') && isset($_GET['post_sidebar_position']) ) {
  $piemont_theme_options['post_sidebar_position'] = $_GET['post_sidebar_position'];
}

if(!isset($piemont_theme_options['post_sidebar_position'])) {
	$piemont_theme_options['post_sidebar_position'] = 'disable';
}

if(!isset($post_sidebarposition)||($post_sidebarposition == '')) {
	$post_sidebarposition = 0;
}

if($post_sidebarposition == "0") {
	$post_sidebarposition = $piemont_theme_options['post_sidebar_position'];
}

if(is_active_sidebar( 'main-sidebar' ) && ($post_sidebarposition <> 'disable') ) {
	$span_class = 'col-md-9';
}
else {
	$span_class = 'col-md-12 post-single-content';
}

// Post media
$post_embed_video = get_post_meta( get_the_ID(), '_piemont_video_embed', true );

if($post_embed_video !== '') {
	$post_embed_video_output = wp_oembed_get($post_embed_video);

} else {
	$post_embed_video_output = '';
}

$post_embed_audio = get_post_meta( get_the_ID(), '_piemont_audio_embed', true );

if($post_embed_audio !== '') {
	$post_embed_audio_output = wp_oembed_get($post_embed_audio);

} else {
	$post_embed_audio_output = '';
}

$gallery_images_data = get_post_meta( get_the_ID(), '_piemont_gallery_file_list', true );

if($gallery_images_data !== '') {

	$post_gallery_id = 'blog-post-gallery-'.get_the_ID();
	$post_embed_gallery_output = '<div class="blog-post-gallery-wrapper" id="'.$post_gallery_id.'" style="display: none;">';

	foreach ($gallery_images_data as $gallery_image) {
		$post_embed_gallery_output .= '<div class="blog-post-gallery-image"><a href="'.esc_url($gallery_image).'" rel="lightbox" title="'.get_the_title().'"><img src="'.esc_url($gallery_image).'" alt="'.get_the_title().'"/></a></div>';
	}

	$post_embed_gallery_output .= '</div>';

	wp_add_inline_script( 'piemont-script', '(function($){
	            $(document).ready(function() {

	            	"use strict";

	                $("#'.esc_js($post_gallery_id).'").owlCarousel({
	                    items: 1,
	                    itemsDesktop:   [1199,1],
	                    itemsDesktopSmall: [979,1],
	                    itemsTablet: [768,1],
	                    itemsMobile : [479,1],
	                    autoPlay: true,
	                    autoHeight: true,
	                    navigation: true,
	                    navigationText : false,
	                    pagination: false,
	                    afterInit : function(elem){
	                        $(this).css("display", "block");
	                    }
	                });

	            });})(jQuery);');

} else {
	$post_embed_gallery_output = '';
}

?>

<div class="content-block">
<div class="post-container container">
	<div class="row">
<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $post_sidebarposition == 'left')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($span_class); ?>">
			<div class="blog-post blog-post-single clearfix">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="post-content-wrapper">

								<div class="post-content">
									<?php if($blog_style == 4): ?>
										<?php
										if ( has_post_thumbnail()&&!in_array($current_post_format, $post_formats_media) ): // check if the post has a Post Thumbnail assigned to it.
										?>
										<div class="blog-post-thumb">
											<?php if(isset($piemont_theme_options['blog_post_hide_featured_image']) && !$piemont_theme_options['blog_post_hide_featured_image']):?>
											<?php the_post_thumbnail('blog-thumb'); ?>
											<?php endif; ?>
										</div>
										<?php endif; ?>
										<?php

										if(in_array($current_post_format, $post_formats_media)) {
											echo '<div class="blog-post-thumb">';

										// Post media
										if($current_post_format == 'format-video') {
											echo '<div class="blog-post-media blog-post-media-video">';
											echo piemont_wp_kses_data($post_embed_video_output);// escaping does not needed here, wordpress OEMBED function used for this var
											echo '</div>';
										}
										elseif($current_post_format == 'format-audio') {
											echo '<div class="blog-post-media blog-post-media-audio">';
											echo piemont_wp_kses_data($post_embed_audio_output);// escaping does not needed here, wordpress OEMBED function used for this var
											echo '</div>';
										}
										elseif($current_post_format == 'format-gallery') {
											echo '<div class="blog-post-media blog-post-media-gallery">';
											echo wp_kses_post($post_embed_gallery_output);
											echo '</div>';
										}
											echo '</div>';
										}
										?>
									<?php endif; ?>
									<?php
										/* translators: used between list items, there is a space after the comma */
										$categories_list = get_the_category_list(  ', '  );
										if ( $categories_list ) :
									?>

									<div class="post-categories"><?php echo wp_kses_post($categories_list); ?></div>

									<?php endif; // End if categories ?>

									<h1 class="entry-title post-header-title"><?php the_title(); ?></h1>
									<div class="post-info clearfix">
										<span><?php the_time(get_option( 'date_format' ));  ?></span>
										<?php if(isset($piemont_theme_options['blog_post_show_author'])&&($piemont_theme_options['blog_post_show_author']) && ($blog_style < 5)): ?>
										<?php echo wp_kses_post($post_info_separator); ?>
										<span><?php esc_html_e('by','piemont'); ?> <?php the_author();?></span>
										<?php endif;?>

										<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) && $blog_style < 5) : ?>
										<?php echo wp_kses_post($post_info_separator); ?>
										<span class="comments-count"><?php comments_popup_link( esc_html__( 'Leave a comment', 'piemont' ), esc_html__( '1 Comment', 'piemont' ), esc_html__( '% Comments', 'piemont' ) ); ?></span>
										<?php endif; ?>

										<?php edit_post_link( esc_html__( 'Edit', 'piemont' ), '<span class="edit-link">', '</span>' ); ?>

									</div>
									<?php if(in_array($blog_style, array(1,2,3,5))): ?>
										<?php
										if ( has_post_thumbnail()&&!in_array($current_post_format, $post_formats_media) ): // check if the post has a Post Thumbnail assigned to it.
										?>
										<div class="blog-post-thumb">

											<?php if(isset($piemont_theme_options['blog_post_hide_featured_image']) && !$piemont_theme_options['blog_post_hide_featured_image']):?>
											<?php the_post_thumbnail('blog-thumb'); ?>
											<?php endif; ?>

										</div>
										<?php endif; ?>
										<?php

										if(in_array($current_post_format, $post_formats_media)) {
											echo '<div class="blog-post-thumb">';

										// Post media
										if($current_post_format == 'format-video') {
											echo '<div class="blog-post-media blog-post-media-video">';
											echo piemont_wp_kses_data($post_embed_video_output);// escaping does not needed here, wordpress OEMBED function used for this var
											echo '</div>';
										}
										elseif($current_post_format == 'format-audio') {
											echo '<div class="blog-post-media blog-post-media-audio">';
											echo piemont_wp_kses_data($post_embed_audio_output);// escaping does not needed here, wordpress OEMBED function used for this var
											echo '</div>';
										}
										elseif($current_post_format == 'format-gallery') {
											echo '<div class="blog-post-media blog-post-media-gallery">';
											echo wp_kses_post($post_embed_gallery_output);
											echo '</div>';
										}
											echo '</div>';
										}
										?>
									<?php endif; ?>
									<?php if ( is_search() ) : // Only display Excerpts for Search ?>
									<div class="entry-summary">
										<?php the_excerpt(); ?>
									</div><!-- .entry-summary -->
									<?php else : ?>
									<div class="entry-content">
										<?php the_content('<div class="more-link">'.esc_html__( 'Continue reading...', 'piemont' ).'</div>' ); ?>
										<?php
											wp_link_pages( array(
												'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'piemont' ),
												'after'  => '</div>',
											) );
										?>
									</div><!-- .entry-content -->


									<?php endif; ?>
									</div>

							</div>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', ''  );
					if ( $tags_list ) :
				?>

				<span class="tags">
					<?php echo wp_kses_post($tags_list); ?>
				</span>

				<?php endif; // End if $tags_list ?>

				<?php if($blog_style == 5): ?>
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						<span class="comments-count"><?php comments_popup_link( esc_html__( 'Leave a comment', 'piemont' ), esc_html__( '1 Comment', 'piemont' ), esc_html__( '% Comments', 'piemont' ) ); ?></span>
						<?php endif; ?>
				<?php endif; ?>

				<?php if(!isset($post_socialshare_disable) || !$post_socialshare_disable): ?>
					<?php do_action('piemont_social_share'); // this action called from plugin ?>
				<?php endif; ?>



				</article>


			</div>

			<?php if(isset($piemont_theme_options['blog_enable_author_info'])&&($piemont_theme_options['blog_enable_author_info'])): ?>
				<?php if ( is_single() && get_the_author_meta( 'description' ) ) : ?>
					<?php get_template_part( 'author-bio' ); ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php
			if(isset($piemont_theme_options['blog_post_navigation']) && $piemont_theme_options['blog_post_navigation']) {
				piemont_content_nav( 'nav-below' );
			}
			?>

			<?php if(isset($piemont_theme_options['blog_post_show_related'])&&($piemont_theme_options['blog_post_show_related'])): ?>
			<?php get_template_part( 'related-posts' ); ?>
			<?php endif; ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )

					comments_template();
			?>



		</div>
		<?php if ( is_active_sidebar( 'main-sidebar' ) && ( $post_sidebarposition == 'right')) : ?>
		<div class="col-md-3 main-sidebar sidebar">
		<ul id="main-sidebar">
		  <?php dynamic_sidebar( 'main-sidebar' ); ?>
		</ul>
		</div>
		<?php endif; ?>
	</div>
	</div>
</div>
