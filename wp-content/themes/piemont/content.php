<?php
/**
 * @package Piemont
 */

$piemont_theme_options = piemont_get_theme_options();

$post_loop_details = piemont_get_post_details();
$post_loop_id = $post_loop_details['post_loop_id'] ?? '';

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

$post_classes = get_post_class();

$current_post_format = $post_classes[4];

$post_formats_media = array('format-audio', 'format-video', 'format-gallery');

// This post formats will display content before title
$post_socialshare_disable = get_post_meta( get_the_ID(), '_post_socialshare_disable_value', true );

// Blog layout
if(isset($piemont_theme_options['blog_layout'])) {
	$blog_layout = $piemont_theme_options['blog_layout'];
} else {
	$blog_layout = 'layout_default';
}

if($blog_layout == 'layout_vertical_design') {
	$blog_enable_vertical_post_design = true;
} else {
	$blog_enable_vertical_post_design = false;
}

if($blog_layout == 'layout_2column_design') {
	$blog_enable_2_column_design = true;
} else {
	$blog_enable_2_column_design = false;
}

if($blog_layout == 'layout_masonry') {
	$blog_enable_masonry_design = true;
} else {
	$blog_enable_masonry_design = false;
}

if(!isset($post_loop_id)) {
	$post_loop_id = 1;
}

if(($post_loop_id % 3 == 0)&&has_post_thumbnail( get_the_ID() )&&$blog_enable_vertical_post_design&&!in_array($current_post_format, $post_formats_media)) {
	$current_post_vertical = true;
} else {
	$current_post_vertical = false;
}

if($blog_layout == 'layout_list') {
	$current_post_list = true;
} else {
	$current_post_list = false;
}

if(is_sticky(get_the_ID())) {
	$current_post_sticky = true;
	$sticky_post_class = 'sticky';
} else {
	$current_post_sticky = false;
	$sticky_post_class = '';
}

$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'blog-thumb');

if(has_post_thumbnail( get_the_ID() )) {
    $image_bg ='background-image: url('.$image[0].');';
}
else {
    $image_bg = '';
}

// Post Format options
// $current_post_format:
// format-gallery
// format-video
// format-audio

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
		$post_embed_gallery_output .= '<div class="blog-post-gallery-image"><a href="'.get_the_permalink().'"><img src="'.esc_url($gallery_image).'" alt="'.get_the_title().'"/></a></div>';
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
<?php if(!has_post_thumbnail( get_the_ID() )) { $sticky_post_class .= ' sticky-post-without-image'; } else { $sticky_post_class .= ''; } ?>
<div class="content-block blog-post clearfix<?php if($current_post_vertical) { echo ' blog-post-vertical';} if($current_post_list) { echo ' blog-post-list-layout';} if($blog_enable_2_column_design) { echo ' blog-post-2-column-layout';}?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class($sticky_post_class); ?>>

		<div class="post-content-wrapper"<?php if(($current_post_sticky)&&($blog_enable_masonry_design)&&($image_bg !== '')&&(!in_array($current_post_format, $post_formats_media))) { echo ' data-style="'.esc_attr($image_bg).'"'; } ?>>
			<?php if(($current_post_sticky)&&($blog_enable_masonry_design)&&($image_bg !== '')): ?>
				<div class="sticky-post-badge<?php if(!has_post_thumbnail( get_the_ID() )) { echo ' sticky-post-without-image'; } ?>"><?php _e('Featured', 'piemont'); ?></div>
			<?php endif; ?>
			<?php
			// Vertical post thumb
			if($current_post_vertical):
			?>
			<div class="blog-post-thumb">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail('blog-thumb-vertical'); ?>
				</a>
			</div>
			<?php endif;?>
			<?php
			// List post thumb
			if(($current_post_list)||($blog_style == 4)&&!$current_post_vertical&&!$blog_enable_masonry_design):
			?>
			<?php
          	if(($image_bg !== '')&&(!in_array($current_post_format, $post_formats_media))):
			?>
			<a class="blog-post-thumb" href="<?php the_permalink(); ?>" rel="bookmark" data-style="<?php echo esc_attr($image_bg); ?>"></a>
			<?php endif;?>
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
					echo '<div class="blog-post-media blog-post-media-gallery clearfix">';
					echo wp_kses_post($post_embed_gallery_output);
					echo '</div>';

				}
					echo '</div>';
				}

			?>
			<?php endif;?>

			<?php
			// Masonry thumbnail
			if($blog_enable_masonry_design) {

				if ( has_post_thumbnail() && (!$current_post_sticky)&&!in_array($current_post_format, $post_formats_media) ):
				?>

				<div class="blog-post-thumb">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail('blog-thumb'); ?>
					</a>
				</div>
				<?php
				endif;

				// Masonry media posts
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
					echo '<div class="blog-post-media blog-post-media-gallery clearfix">';
					echo wp_kses_post($post_embed_gallery_output);
					echo '</div>';
				}
					echo '</div>';
				}
			}
			?>
			<div class="post-content">

				<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list(  ', '  );
				if ( $categories_list ) :
				?>

				<div class="post-categories"><?php echo wp_kses_post($categories_list); ?></div>

				<?php endif; // End if categories ?>


				<h1 class="entry-title post-header-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?><?php if($current_post_sticky&&!$blog_enable_masonry_design) { echo '<sup>'.esc_html__('Featured', 'piemont').'</sup>'; } ?></a></h1>

				<?php if(($blog_style == 5)&&(!$blog_enable_masonry_design)): ?>
					<div class="post-info clearfix">
						<span><?php the_time(get_option( 'date_format' ));  ?></span>
					</div>
				<?php endif; ?>

				<?php if(($blog_style < 4)||($blog_enable_masonry_design)): ?>
				<div class="post-info clearfix">
					<span><?php the_time(get_option( 'date_format' ));  ?></span>
					<?php if(isset($piemont_theme_options['blog_post_show_author'])&&($piemont_theme_options['blog_post_show_author'])): ?>
					<?php echo wp_kses_post($post_info_separator); ?>
					<span><?php esc_html_e('by','piemont'); ?> <?php the_author();?></span>
					<?php endif; ?>

					<?php if($blog_style == 1): ?>
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						<?php echo wp_kses_post($post_info_separator); ?>
						<span class="comments-count"><?php comments_popup_link( esc_html__( 'Leave a comment', 'piemont' ), esc_html__( '1 Comment', 'piemont' ), esc_html__( '% Comments', 'piemont' ) ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
					<?php edit_post_link( esc_html__( 'Edit', 'piemont' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
				<?php endif; ?>
				<?php

				if((!$current_post_vertical)&&(!$current_post_list)&&(in_array($blog_style, array(1,2,3,5)))&&(!$blog_enable_masonry_design)) {

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
						echo '<div class="blog-post-media blog-post-media-gallery clearfix">';
						echo wp_kses_post($post_embed_gallery_output);
						echo '</div>';
					} else {
						// Post thumbnail
						if ( has_post_thumbnail() ):
						?>

							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php the_post_thumbnail('blog-thumb'); ?>
							</a>

						<?php
						endif;
					}

					echo '</div>';
				}

				?>
				<div class="entry-content">
					<?php

					// Post content
					if($blog_enable_masonry_design) {
						the_excerpt();
					} else {
						if($current_post_list||$blog_style == 4||$blog_enable_2_column_design) {
							$read_more_text = esc_html__('Read more', 'piemont');
						} else {
							$read_more_text = esc_html__('Continue reading...', 'piemont');
						}

						if(isset($piemont_theme_options['blog_post_loop_type']) && $piemont_theme_options['blog_post_loop_type']=='excerpt') {
							the_excerpt();
							echo '<a class="more-link" href="'.get_permalink().'">'.$read_more_text.'</a>';
						} else {
							the_content( $read_more_text );
						}

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'piemont' ),
							'after'  => '</div>',
						) );
					}

					?>
				</div><!-- .entry-content -->

				<div class="blog-post-bottom clearfix">
					<?php if($blog_style == 5 && !$current_post_list && !$blog_enable_masonry_design): ?>
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						<span class="comments-count"><?php comments_popup_link( esc_html__( 'Leave a comment', 'piemont' ), esc_html__( '1 Comment', 'piemont' ), esc_html__( '% Comments', 'piemont' ) ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
					<?php if($blog_enable_masonry_design): ?>
						<a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Continue reading', 'piemont'); ?></a>
					<?php endif; ?>
					<?php if(($blog_style == 4)&&(!$blog_enable_masonry_design)): ?>
					<div class="post-info clearfix">
						<span><?php the_time(get_option( 'date_format' ));  ?></span>
						<?php if(isset($piemont_theme_options['blog_post_show_author'])&&($piemont_theme_options['blog_post_show_author'])): ?>
						<?php echo wp_kses_post($post_info_separator); ?>
						<span><?php esc_html_e('by','piemont'); ?> <?php the_author();?></span>
						<?php endif; ?>


						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						<?php echo wp_kses_post($post_info_separator); ?>
						<span class="comments-count"><?php comments_popup_link( esc_html__( 'Leave a comment', 'piemont' ), esc_html__( '1 Comment', 'piemont' ), esc_html__( '% Comments', 'piemont' ) ); ?></span>
						<?php endif; ?>

						<?php edit_post_link( esc_html__( 'Edit', 'piemont' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
					<?php endif; ?>
					<?php if(($blog_style == 2)||($blog_style == 3)): ?>
						<?php if(!$blog_enable_masonry_design):?>
						<div class="blog-post-bottom-comments">
							<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
							<span class="comments-count"><?php comments_popup_link( esc_html__( 'Leave a comment', 'piemont' ), esc_html__( '1 Comment', 'piemont' ), esc_html__( '% Comments', 'piemont' ) ); ?></span>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					<?php if(($blog_layout !== 'layout_list')&&(!$blog_enable_masonry_design)):?>
						<?php if(!isset($post_socialshare_disable) || !$post_socialshare_disable): ?>
							<?php do_action('piemont_social_share'); // this action called from plugin ?>
						<?php endif; ?>
					<?php endif; ?>
				</div>

			</div>

		</div>

	</article>
</div>

<?php if(isset($piemont_theme_options['blog_list_show_related'])&&($piemont_theme_options['blog_list_show_related'])&&!$blog_enable_masonry_design&&!$blog_enable_2_column_design): ?>
<?php get_template_part( 'related-posts-loop' ); ?>
<?php endif; ?>
