<?php

if ($layout_id):

	if (have_rows('block',$layout_id)):

		while(have_rows('block',$layout_id)): the_row();

			include(get_stylesheet_directory().'/layout/fields/'.get_row_layout().'.php');

		endwhile;

	endif;

endif;