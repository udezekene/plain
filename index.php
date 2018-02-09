<?php  get_header(); 
  
  // Let's get everything we'll be using here
  $blog_logo = get_theme_mod('welcome_title');
  $blog_name = get_theme_mod('welcome_title');
  $blog_description = get_theme_mod('welcome_description');

  $settings_sm_facebook = get_theme_mod('settings_sm_facebook');
  $settings_sm_twitter = get_theme_mod('settings_sm_twitter');
  $settings_sm_instagram = get_theme_mod('settings_sm_instagram');
  $settings_sm_linkedin = get_theme_mod('settings_sm_linkedin');
  $settings_sm_github = get_theme_mod('settings_sm_github');

  $settings_author_avatar = get_theme_mod('plain_theme_options[settings_author_avatar]');
  $settings_author_name = get_theme_mod('settings_author_name');
  $settings_author_bio = get_theme_mod('settings_author_bio');
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
