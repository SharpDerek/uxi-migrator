<form role="search" method="get" class="search-form clearfix" action="<?php echo home_url('/'); ?>">
  <label class="hidden" for="s"><?php _e('Search for:', 'mad'); ?></label>
  <input type="search" value="" name="s" id="s" class="search-query" placeholder="<?php _e('Search', 'mad'); ?>">
  <button type="submit" id="searchsubmit" class="search-button"><i class="icon-mw-search"></i> <span class="visuallyhidden"><?php _e('Search', 'mad'); ?></span></button>
</form>