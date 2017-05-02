<form method="get" class="search-form" action="<?php echo home_url('/'); ?>">
	<label for="s" class="search-form-label screen-reader-text"><?php _e('Search for: ', 'zero-blank'); ?></label>
	<input type="search" class="search-field" name="s" id="s" placeholder="Search...">
	<input type="submit" class="search-submit" value="Search">
</form>