<?php ob_start();
  $category_description = category_description();
  if ( ! empty( $category_description ) )
  echo apply_filters( 'category_archive_meta', '<div class="description">' . $category_description . '</div>' );
?>

<?php get_template_part('templates/loop');

$additional_content = ob_get_clean();

require_once(get_stylesheet_directory().'/layout/layout-loader.php');
          
