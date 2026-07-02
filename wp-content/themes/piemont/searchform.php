<?php
/**
 * The template for displaying search forms in Piemont
 *
 * @package Piemont
 */
?>
	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr(__('Looking for something ? Search away?', 'piemont' )); ?>" />
		<input type="submit" class="submit btn" id="searchsubmit" value="<?php echo esc_attr(__('Search', 'piemont' )); ?>" />
	</form>
