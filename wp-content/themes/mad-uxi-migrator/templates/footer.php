    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrap -->
  
  <footer class="footer" role="contentinfo">
    <section class="footer-inner container">
      <div class="col-sm-12">        
        <?php /* Keep the following for accessibility */ ?>
        <h2 class="visuallyhidden"><?php _e( 'Footer', 'mad' ); ?></h2>
            
        <?php if( has_nav_menu('footer_navigation') ) : /* show only if menu has been assigned */ ?>
        <nav class="footer-nav">
          <?php /* Keep the following for accessibility */ ?>
          <h3 class="visuallyhidden"><?php _e( 'Footer Navigation', 'mad' ); ?></h3>
          <?php wp_nav_menu(array(
            'theme_location' => 'footer_navigation',
            'container' => false,
            'items_wrap' => '<ul class="nav">%3$s</ul>',
            'depth' => 1,
            'walker' => new Mad_Nav_Walker()
          ));?>
        </nav>
        <?php endif; ?>
        
       <?php get_template_part('templates/footer', 'widget-area'); ?>
        
        <p class="copyright"><small>&copy; <?php echo date('Y');?> <?php bloginfo('name'); ?></small></p>
      </div>
    </section>  
  </footer>
  
</div>
<!-- /.wrap -->

<?php wp_footer(); ?>