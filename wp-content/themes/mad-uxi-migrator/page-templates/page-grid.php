<?php
/*
Template Name: Grid
*/
get_header(); ?>
  
  <?php mad_content_before(); ?>
  
    <?php mad_main_before(); ?>
      <div class="main <?php echo mad_main_class(); ?>" role="main">
        <?php mad_main_inside_before(); ?>
        
          <?php get_template_part('templates/page-header'); ?> 
        
          <p class="h3">For proper grid alignment, grid-rows must contain grid-units as follows: <code>.grid-row > .grid-unit.sizeXofY</code>.</p>
          
          <h2>Grid Classes</h2>          
          <hr>
            
          <dl>
            <dt><code>.grid-row</code></dt>
            <dd>Contains the columns and have a min and max width. Nested rows have the widths removed and negative left and right margin added for grid alignment.</dd>
            <dt><code>.grid-row-collapse</code></dt>
            <dd>Extension for the grid-row class for nested rows. It removes the left and right negative margin when a background color is needed on the nested row so it aligns properly with the grid.</dd>
            <dt><code>.grid-unit</code></dt>
            <dd>Base class for making columns. Contains float and padding (gutter). By default columns are set to stack when the screen width is below 768 pixels.</dd>
            <dt><code>.sizeXofY</code></dt>
            <dd>Extension for the grid-unit class and can be used independently if desired. Widths can be thirds, quarters, fifths, sixths, halves or full. Total columns in a row must equal 1, for example &frac13; plus &frac23; equals 1.</dd>
            <dt><code>.colborder</code></dt>
            <dd>Extension for the grid-unit class and can be used independently if desired. This is used for added a left border.</dd>
          </dl>
          <!-- End Grid Classes -->
          
          <h2>Example Page Layout With Grid Nesting</h2>
          <hr>

          <pre><ol><li>&lt;div class="grid-row"&gt;</li><li>  &lt;div class="grid-unit size2of3"&gt;</li><li>    &lt;div class="grid-row grid-row-collapse"&gt;</li><li>      &lt;div class="grid-unit size1of4"&gt;&hellip;&lt;/div&gt;</li><li>      &lt;div class="grid-unit size1of4"&gt;&hellip;&lt;/div&gt;</li><li>      &lt;div class="grid-unit size1of4"&gt;&hellip;&lt;/div&gt;</li><li>      &lt;div class="grid-unit size1of4"&gt;&hellip;&lt;/div&gt;</li><li>    &lt;/div&gt;</li><li>  &lt;/div&gt;</li><li>  &lt;div class="grid-unit size1of3"&gt;&hellip;&lt;/div&gt;</li><li>&lt;/div&gt;</li></ol></pre>

          <div class="grid-row">
            <div class="grid-unit size2of3">
              <h1>Page Title</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <div class="grid-row grid-row-collapse" style="background:#ccc;">
                <div class="grid-unit size1of4">
                  <img alt="" src="http://placehold.it/200x200/0eafff/ffffff.png" />
                  <h3>Some Title</h3>
                </div>
                <div class="grid-unit size1of4">
                  <img alt="" src="http://placehold.it/200x200/0eafff/ffffff.png" />
                  <h3>Some Title</h3>
                </div>
                <div class="grid-unit size1of4">
                  <img alt="" src="http://placehold.it/200x200/0eafff/ffffff.png" />
                  <h3>Some Title</h3>
                </div>
                <div class="grid-unit size1of4">
                  <img alt="" src="http://placehold.it/200x200/0eafff/ffffff.png" />
                  <h3>Some Title</h3>
                </div>
              </div>
            </div>
            <div class="grid-unit size1of3">
              <h2>Sidebar</h2>
              <ul>
                <li>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</li>
                <li>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</li>
                <li>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</li>
                <li>Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</li>
              </ul>
            </div>
          </div>
          <!-- End Example Page Layout -->          
          
          <h2>Column Borders</h2>
          <hr>

          <pre><code>&lt;div class="grid-unit size1of3 colborder"&gt;&hellip;&lt;/div&gt;</code></pre>
          
          <div class="grid-row">
            <div class="grid-unit size1of3">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of3 colborder">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of3 colborder">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>
          <br>         
          <!-- End Column Borders -->
        
          <h2>Grid Examples</h2>
          <hr>
            
          <h3>Sixths</h3>
          <pre><ol><li>&lt;div class="grid-row"&gt;</li><li>  &lt;div class="grid-unit size1of6"&gt;&hellip;&lt;/div&gt;</li><li>  &lt;div class="grid-unit size5of6"&gt;&hellip;&lt;/div&gt;</li><li>&lt;/div&gt;</li></ol></pre>
          
          <div class="grid-row">
            <div class="grid-unit size1of6">
              <h4>1/6</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan.</p>
            </div>
            <div class="grid-unit size1of6">
              <h4>1/6</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan.</p>
            </div>
            <div class="grid-unit size1of6">
              <h4>1/6</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan.</p>
            </div>
            <div class="grid-unit size1of6">
              <h4>1/6</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan.</p>
            </div>
            <div class="grid-unit size1of6">
              <h4>1/6</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan.</p>
            </div>
            <div class="grid-unit size1of6">
              <h4>1/6</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan.</p>
            </div>
          </div>
          
          <div class="grid-row">
            <div class="grid-unit size5of6">
              <h4>5/6</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of6">
              <h4>1/6</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan.</p>
            </div>
          </div>

          <h3>Fifths</h3>

          <pre><ol><li>&lt;div class="grid-row"&gt;</li><li>  &lt;div class="grid-unit size2of5"&gt;&hellip;&lt;/div&gt;</li><li>  &lt;div class="grid-unit size3of5"&gt;&hellip;&lt;/div&gt;</li><li>&lt;/div&gt;</li></ol></pre>

          <div class="grid-row">
            <div class="grid-unit size1of5">
              <h4>1/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of5">
              <h4>1/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of5">
              <h4>1/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of5">
              <h4>1/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of5">
              <h4>1/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>

          <div class="grid-row">
            <div class="grid-unit size1of5">
              <h4>1/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size3of5">
              <h4>3/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pharetra nisl nec tortor convallis rutrum vestibulum felis consectetur. Nullam mi nisi, tincidunt id ornare ut, auctor non mi. Cras sagittis bibendum venenatis. In hac habitasse platea dictumst. Nulla in velit orci, quis venenatis lacus. Etiam mauris sem, tincidunt ac bibendum eget, tincidunt a odio. Vivamus scelerisque sagittis lacus condimentum posuere. Donec viverra lectus nec erat feugiat rutrum.</p>
            </div>
            <div class="grid-unit size1of5">
              <h4>1/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>

          <div class="grid-row">
            <div class="grid-unit size2of5">
              <h4>2/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size3of5">
              <h4>3/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>

          <div class="grid-row">
            <div class="grid-unit size4of5">
              <h4>4/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pharetra nisl nec tortor convallis rutrum vestibulum felis consectetur. Nullam mi nisi, tincidunt id ornare ut, auctor non mi. Cras sagittis bibendum venenatis. In hac habitasse platea dictumst. Nulla in velit orci, quis venenatis lacus. Etiam mauris sem, tincidunt ac bibendum eget, tincidunt a odio. Vivamus scelerisque sagittis lacus condimentum posuere. Donec viverra lectus nec erat feugiat rutrum.</p>
            </div>
            <div class="grid-unit size1of5">
              <h4>1/5</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>

          <h3>Fourths</h3>

          <pre><ol><li>&lt;div class="grid-row"&gt;</li><li>  &lt;div class="grid-unit size3of4"&gt;&hellip;&lt;/div&gt;</li><li>  &lt;div class="grid-unit size1of4"&gt;&hellip;&lt;/div&gt;</li><li>&lt;/div&gt;</li></ol></pre>

          <div class="grid-row">
            <div class="grid-unit size1of4">
              <h4>1/4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of4">
              <h4>1/4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of4">
              <h4>1/4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of4">
              <h4>1/4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>

          <div class="grid-row">
            <div class="grid-unit size1of4">
              <h4>1/4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size2of4">
              <h4>2/4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pharetra nisl nec tortor convallis rutrum vestibulum felis consectetur. Nullam mi nisi, tincidunt id ornare ut, auctor non mi. Cras sagittis bibendum venenatis. In hac habitasse platea dictumst. Nulla in velit orci, quis venenatis lacus.</p>
            </div>
            <div class="grid-unit size1of4">
              <h4>1/4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>

          <div class="grid-row">
            <div class="grid-unit size3of4">
              <h4>3/4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pharetra nisl nec tortor convallis rutrum vestibulum felis consectetur. Nullam mi nisi, tincidunt id ornare ut, auctor non mi. Cras sagittis bibendum venenatis. In hac habitasse platea dictumst. Nulla in velit orci, quis venenatis lacus. Etiam mauris sem, tincidunt ac bibendum eget, tincidunt a odio. Vivamus scelerisque sagittis lacus condimentum posuere. Donec viverra lectus nec erat feugiat rutrum.</p>
            </div>
            <div class="grid-unit size1of4">
              <h4>1/4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>

          <h3>Thirds</h3>

          <pre><ol><li>&lt;div class="grid-row"&gt;</li><li>  &lt;div class="grid-unit size1of3"&gt;&hellip;&lt;/div&gt;</li><li>  &lt;div class="grid-unit size2of3"&gt;&hellip;&lt;/div&gt;</li><li>&lt;/div&gt;</li></ol></pre>

          <div class="grid-row">
            <div class="grid-unit size1of3">
              <h4>1/3</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of3">
              <h4>1/3</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of3">
              <h4>1/3</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>

          <div class="grid-row">
            <div class="grid-unit size1of3">
              <h4>1/3</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size2of3">
              <h4>2/3</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pharetra nisl nec tortor convallis rutrum vestibulum felis consectetur. Nullam mi nisi, tincidunt id ornare ut, auctor non mi. Cras sagittis bibendum venenatis. In hac habitasse platea dictumst. Nulla in velit orci, quis venenatis lacus. Etiam mauris sem, tincidunt ac bibendum eget, tincidunt a odio.</p>
            </div>
          </div>

          <h3>Halves</h3>

          <pre><ol><li>&lt;div class="grid-row"&gt;</li><li>  &lt;div class="grid-unit size1of2"&gt;&hellip;&lt;/div&gt;</li><li>  &lt;div class="grid-unit size1of2"&gt;&hellip;&lt;/div&gt;</li><li>&lt;/div&gt;</li></ol></pre>

          <div class="grid-row">
            <div class="grid-unit size1of2">
              <h4>1/2</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
            <div class="grid-unit size1of2">
              <h4>1/2</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc.</p>
            </div>
          </div>

          <h3>Full</h3>

          <pre><ol><li>&lt;div class="grid-row"&gt;</li><li>  &lt;div class="grid-unit size1of1"&gt;&hellip;&lt;/div&gt;</li><li>&lt;/div&gt;</li></ol></pre>

          <div class="grid-row">
            <div class="grid-unit size1of1">
              <h4>1/1</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur quam sed sapien bibendum sit amet sodales arcu accumsan. Nam fringilla vulputate tincidunt. Mauris sed sem ante, at luctus justo. Fusce et tempor nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pharetra nisl nec tortor convallis rutrum vestibulum felis consectetur. Nullam mi nisi, tincidunt id ornare ut, auctor non mi. Cras sagittis bibendum venenatis. In hac habitasse platea dictumst. Nulla in velit orci, quis venenatis lacus. Etiam mauris sem, tincidunt ac bibendum eget, tincidunt a odio. Vivamus scelerisque sagittis lacus condimentum posuere. Donec viverra lectus nec erat feugiat rutrum.</p>
            </div>
          </div>
          <!-- End Grid Examples -->
        
        <?php mad_main_inside_after(); ?>
      </div>
      <!-- /.main -->
    <?php mad_main_after(); ?>
    
    <?php get_sidebar(); ?>
  
  <?php mad_content_after(); ?>
  
<?php get_footer(); ?>