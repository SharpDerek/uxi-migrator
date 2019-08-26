<?php
	$class = get_sub_field('class');
	$id = get_sub_field('id');
	$placeholder = get_sub_field('placeholder');
  $content = get_sub_field('content', false);
?>
<div uxi-widget="uxi_widget_search" id="<?php echo $id; ?>" class="<?php echo $class; ?>">
	<div class="content">
    <?php echo do_shortcode($content); ?>
		<form role="search" method="get" class="search-form search-form-block" action="/">
            <label class="sr-only" for="uxi-search-2">Search for:</label>
            <div class="clearfix">
               <div class="search-form-input">
                   <input id="uxi-search-2" type="search" value="" name="s" placeholder="<?php echo $placeholder; ?>">
               </div>
                <div class="search-form-button">
                    <button type="submit" class="button button-default"><span class="icon-uxis-search" aria-hidden="true"></span><span class="sr-only">Search</span></button>
                </div>
            </div>
        </form>
	</div>
</div>