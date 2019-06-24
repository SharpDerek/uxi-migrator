<div class="wrap">

  <header class="header" role="banner">    
    <div class="header-inner container">
      <div class="col-sm-12">
        
        <h1 class="logo">
          <a href="<?php echo home_url(); ?>/">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo('name'); ?>">
          </a>
        </h1>
        
        <?php if( has_nav_menu('utility_navigation') ) : ?>
        <nav class="utility-nav mobilehide">                    
          <?php wp_nav_menu(array(
            'theme_location' => 'utility_navigation',
            'container' => false,
            'items_wrap' => '<ul class="nav">%3$s</ul>',
            'depth' => 1,
            'walker' => new Mad_Nav_Walker()
          ));?>           
        </nav>
        <?php endif; ?>
        
        <?php /* Don't Delete Button */ ?>
        <a class="btn-navbar hidden-lg hidden-md visible-sm visible-xs">
          <span class="icon-bar icon-bar-first"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
      </div>      
    </div>
    
    <nav class="main-nav-wrap" role="navigation">
      <div class="main-nav-wrap-inner container">
        <div class="col-sm-12">
          <?php /* Keep the following for accessibility */ ?>
          <h2 class="visuallyhidden"><?php _e( 'Primary Navigation', 'mad' ); ?></h2>
          <a class="visuallyhidden" href="#main" title="<?php _e('Go to main content', 'satus') ?>"><?php _e('Go to main content', 'satus') ?></a>     
          
          <div class="main-nav">
            <?php wp_nav_menu(array(
              'theme_location' => 'primary_navigation',
              'container' => false,
              'items_wrap' => '<ul class="nav">%3$s</ul>',
              'depth' => 3,
              'walker' => new Mad_Navbar_Walker()
            )); ?>
          </div>
          
          <?php // get_search_form(); ?>
          
          <?php if( has_nav_menu('utility_navigation') ) : ?>
          <div class="utility-nav mobile mobileshow">                    
            <?php wp_nav_menu(array(
              'theme_location' => 'utility_navigation',
              'container' => false,
              'items_wrap' => '<ul class="nav">%3$s</ul>',
              'depth' => 1,
              'walker' => new Mad_Nav_Walker()
            ));?>           
          </div>
          <?php endif; ?>
        </div>
      </div>
    </nav>            
  </header>

  <div class="content-wrap">
    <div class="container content">