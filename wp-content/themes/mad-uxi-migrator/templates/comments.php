<?php if (post_password_required()) : ?>
  <section id="comments">
      
    <p><?php _e('This post is password protected. Enter the password to view comments.', 'mad'); ?></p>

  </section>
  <!-- /#comments -->
<?php return; endif; ?>

<?php function mad_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>" class="comment" itemscope itemtype="http://schema.org/UserComments">

      <header>
        <?php echo get_avatar($comment,$size='40'); ?>
        <h3 itemprop="name">
          <?php printf(__('<cite itemprop="creator">%s</cite>', 'mad'), get_comment_author_link()) ?>
          <time itemprop="commentTime startDate" datetime="<?php echo comment_date('c') ?>">
              <a itemprop="replyToUrl" href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                <?php printf(__('%s <span>%s</span> ', 'mad'), get_comment_date(),  get_comment_time()); ?>
              </a>
          </time>
        </h3>
        <?php edit_comment_link(__('Edit Comment', 'mad'), '', '') ?>
      </header>

      <?php if ($comment->comment_approved == '0') : ?>
               
      <p><?php _e('Your comment is awaiting moderation.', 'mad') ?></p>
          
      <?php endif; ?>
      
      <div itemprop="commentText">
        <?php comment_text() ?>
      </div>

      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

    </article>
<?php } ?>


<?php if (have_comments()) : ?>
  <section id="comments">

    <h2><?php comments_number(__('No Responses to', 'mad'), __('One Response to', 'mad'), __('% Responses to', 'mad') ); ?> &#8220;<?php the_title(); ?>&#8221;</h2>

    <ol class="comment-list">
      <?php wp_list_comments(array('callback' => 'mad_comments')); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
      
      <footer>
        <nav class="comments-nav pagination">
          <h3 class="assistive-text"><?php _e('Comments Navigation', 'mad') ?></h3>
          <?php paginate_comments_links(array(
            'prev_text' => '&larr;',
            'next_text' => '&rarr;'
            )); ?>
        </nav>
      </footer>
      
    <?php endif; // check for comment navigation ?>

    <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
        
      <p><?php _e('Comments are closed.', 'mad'); ?></p>
      
    <?php endif; ?>
  </section>
  <!-- /#comments -->
<?php endif; ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
  <section id="comments">
      
  <p><?php _e('Comments are closed.', 'mad'); ?></p>

  </section>
  <!-- /#comments -->
<?php endif; ?>

<?php if (comments_open()) : ?>
  <?php comment_form(); ?>
<?php endif; ?>