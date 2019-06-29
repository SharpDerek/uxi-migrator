<aside class="sidebar <?php echo mad_sidebar_class(); ?>"  role="complementary">
  
  <?php /* Keep the following for accessibility */ ?>
  <h2 class="visuallyhidden"><?php _e( 'Sidebar', 'mad' ); ?></h2>
  
  <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
  
</aside>
<!--/#sidebar-->