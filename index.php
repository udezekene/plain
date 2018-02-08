<?php  get_header(); 
  // Title
?>
  
  <section class="intro-wrapper wrapper" role="region"  aria-label="Welcome Message">
      <div class="welcome-header">
          <div class="blurp">
              <h1 tabindex="0">
                <?php echo bloginfo('title'); ?>
              </h1>
              <p tabindex="0"><?php bloginfo('description'); ?></p>
          </div>
      </div>
  
  </section>

  <section class="post-list wrapper" role="main" aria-label="Main Content">
    <div class="post-list-wrapper">
      <?php get_template_part('loop'); ?>      
    </div>

    <div class="load-more">
        <a href="" title="Load more posts" class="button">Load More Posts</a>
        <?php get_template_part('pagination'); ?>
    </div>
  </section>

<?php get_footer(); ?>
