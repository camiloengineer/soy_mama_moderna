<?php
/*
*	Related posts
*/
?>
<?php
global $post;

?>
<?php
//for use in the loop, list 5 post titles related to first tag on current post
$tags = wp_get_post_tags($post->ID);

if ($tags) {

	$intags = array();

	foreach ($tags as $tag) {
		$intags[] = $tag->term_id;
	}

	$args=array(
	'tag__in' => $intags,
	'post__not_in' => array($post->ID),
	'posts_per_page'=> 3
	);

	$my_query = new WP_Query($args);

	if( $my_query->have_posts() ) {

		echo '<div class="blog-post-related clearfix">';

		echo '<h5>'.esc_html__('You may also like','piemont').'</h5>';

		while ($my_query->have_posts()) : $my_query->the_post();
			$post_image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'blog-thumb');
			$post_image = $post_image_data[0];
		?>
		<div class="blog-post-related-item">
		<a href="<?php the_permalink() ?>" class="blog-post-related-image"><img src="<?php echo esc_attr($post_image); ?>" alt="<?php the_title_attribute(); ?>"/></a>
		<a href="<?php the_permalink() ?>" class="blog-post-related-title"><?php the_title(); ?></a>
		<div class="blog-post-related-date"><?php echo get_the_time( get_option( 'date_format' ), get_the_ID() );?></div>
		</div>
		<?php
		endwhile;

		echo '</div>';

	}

	wp_reset_query();

}

?>
