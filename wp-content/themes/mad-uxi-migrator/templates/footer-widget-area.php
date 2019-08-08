<?php if (
  is_active_sidebar( 'footer-widget-area-1' ) ||
  is_active_sidebar( 'footer-widget-area-2' ) ||
  is_active_sidebar( 'footer-widget-area-3' ) ||
  is_active_sidebar( 'footer-widget-area-4' )
) : ?>
<aside id="footer-widget-area">
  <div class="footer-widget-unit col-xs-12 col-sm-6 col-md-3">
    <?php dynamic_sidebar('footer-widget-area-1'); ?>
  </div>
  <div class="footer-widget-unit col-xs-12 col-sm-6 col-md-3">
    <?php dynamic_sidebar('footer-widget-area-2'); ?>
  </div>
  <div class="footer-widget-unit col-xs-12 col-sm-6 col-md-3">
    <?php dynamic_sidebar('footer-widget-area-3'); ?>
  </div>
  <div class="footer-widget-unit col-xs-12 col-sm-6 col-md-3">
    <?php dynamic_sidebar('footer-widget-area-4'); ?>
  </div>
</aside>
<?php endif; ?>