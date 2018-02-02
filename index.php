<?php 

  get_header(); 

  // Title
  $welcome_text = of_get_option('welcome_text');
  $welcome_description = of_get_option('welcome_description');
  $author_photo = of_get_option('author_photo');
  $author_name = of_get_option('author_name');
  $author_description = of_get_option('author_description');

  $sm_twitter = of_get_option('sm_twitter');
  $sm_facebook = of_get_option('sm_facebook');
  $sm_instagram = of_get_option('sm_instagram');
  $sm_github = of_get_option('sm_github');
  $sm_linked_in = of_get_option('sm_linked_in');


?>
  
  <section class="intro-wrapper wrapper" role="region"  aria-label="Welcome Message">
      <div class="welcome-header">
          <div class="blurp">
              <h1 tabindex="0">
                
                <?php if (isset($welcome_text)){
                    echo $welcome_text;
                }else{
                  echo bloginfo('title');
                }
                ?>

              </h1>
              <p tabindex="0"><?php bloginfo('description'); ?> <?php echo of_get_option( 'welcome_text', 'no entry' ); ?></p>
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
