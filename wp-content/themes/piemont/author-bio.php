<?php
/*
*	Posts Author info template
*/
?>
<div class="author-bio">
	<div class="author-image">
		<?php echo get_avatar( get_the_author_meta('email'), '100' ); ?>
	</div>
	<div class="author-info">
		<p class="author-title"><strong><?php the_author_link(); ?></strong></p>
		<p class="author-description"><?php the_author_meta('description'); ?></p>
		<p class="author-social">
			<ul class="author-social-icons">
				<?php 
					$social_array = array('facebook', 'twitter', 'vk', 'google-plus', 'behance', 'linkedin', 'pinterest', 'deviantart', 'dribbble',  'flickr', 'instagram', 'skype', 'tumblr', 'twitch', 'vimeo-square', 'youtube');
					
					foreach ($social_array as $social_profile) {
						$$social_profile = get_the_author_meta( $social_profile.'_profile' );

						if ( $$social_profile && $$social_profile != '' ) {
							echo '<li class="author-social-link-'.$social_profile.'"><a href="' . esc_url($$social_profile) . '" target="_blank"><i class="fa fa-'.$social_profile.'"></i></a></li>';
						}
					}
				?>
			</ul>
		</p>
	</div>
	<div class="clear"></div>
</div>