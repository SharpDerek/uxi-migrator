<?php ob_start();

  $tag_description = tag_description();
  if ( ! empty( $tag_description ) )
    echo apply_filters( 'tag_archive_meta', '<div class="description">' . $tag_description . '</div>' );
?>

<?php get_template_part('templates/loop');
          
  $additional_content = ob_get_clean();

require_once(get_stylesheet_directory().'/layout/layout-loader.php');