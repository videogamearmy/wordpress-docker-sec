<form action="<?php echo home_url(); ?>/" class="searchform" method="get">
	<button class="search-button"><i class="tm-search"></i></button>
	<input type="text" name="s" class="search-input" value="<?php _e('Search', 'curated'); ?>" onfocus="if(this.value=='<?php _e('Search', 'curated'); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Search', 'curated'); ?>';" autocomplete="off" />
</form>