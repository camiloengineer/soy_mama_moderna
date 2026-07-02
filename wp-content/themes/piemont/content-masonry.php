<?php
/**
 * @package Piemont
 */
?>
<?php

$post_classes = get_post_class();

$current_post_class = $post_classes[4];

// This post formats will display content before title
$post_classes_content_top = array('format-audio', 'format-image', 'format-video', 'format-gallery', 'format-status', 'format-link');

?>
<div class="content-block blog-post clearfix">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


				<div class="post-content-wrapper">

					<?php
					if(in_array($current_post_class , $post_classes_content_top)) {
						echo '<div class="entry-content">';
						the_content( esc_html__( 'Continue reading...', 'piemont' ) );
						echo '</div>';
					} else {
						if ( has_post_thumbnail() ):
						?>
						<div class="blog-post-thumb text-center">
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php the_post_thumbnail('blog-thumb'); ?>
							</a>
						</div>
						<?php
						endif;
					}
					?>
					<div class="post-content">

						<h1 class="entry-title post-header-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						<div class="post-info">

						<span><?php

							if($current_post_class == 'format-chat') {
								esc_html_e("Chat on ", 'piemont');
							}
						?> <?php the_time(get_option( 'date_format' ));  ?></span>

						<?php edit_post_link( esc_html__( 'Edit', 'piemont' ), ' / <span class="edit-link">', '</span>' ); ?>

						</div>

							<?php if(!in_array($current_post_class , $post_classes_content_top)): ?>
							<div class="entry-content">
								<?php

								the_content( esc_html__( 'Continue reading...', 'piemont' ) );


								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'piemont' ),
									'after'  => '</div>',
								) );
								?>
							</div><!-- .entry-content -->
							<?php endif;?>

							<div class="blog-post-masonry-meta">
							<span><?php esc_html_e('by','piemont'); ?> <strong><?php the_author();?></strong></span> 	<?php
								/* translators: used between list items, there is a space after the comma */
								$categories_list = get_the_category_list( ', ' ) ;
								if ( $categories_list ) :
							?>

							 <span><?php esc_html_e('in','piemont'); ?></i> <?php echo wp_kses_post($categories_list); ?></span>

							<?php endif; // End if categories ?>
							</div>


						</div>

				</div>


	</article>
</div>
