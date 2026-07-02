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

	echo '<div class="blog-post-related blog-post-related-loop clearfix">';

	echo '<h5>'.esc_html__('Related posts','piemont').'</h5>';

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
		while ($my_query->have_posts()) : $my_query->the_post();
			$post_image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'blog-thumb');

			if(has_post_thumbnail( $post->ID )) {
			    $post_image = 'background-image: url('.$post_image_data[0].');';
			    $post_class = '';
			}
			else {
			    $post_image = '';
			    $post_class = ' blog-post-related-no-image';
			}

		?>
		<div class="blog-post-related-item">

		<a href="<?php the_permalink() ?>" class="blog-post-related-image<?php echo esc_attr($post_class); ?>" data-style="<?php echo esc_attr($post_image);?>">
		<div class="blog-post-related-item-inside">
		<div class="blog-post-related-title"><?php the_title(); ?></div>
		<div class="blog-post-related-date"><?php echo get_the_time( get_option( 'date_format' ), get_the_ID() );?></div>
		</div>
		</a>

		</div>
		<?php
		endwhile;

	}

	wp_reset_query();
	echo '<div class="blog-post-related-separator clearfix"></div>';
	echo '</div>';

}

?>
