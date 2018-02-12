<?php  get_header(); ?>
  
  <section class="intro-wrapper wrapper" role="region"  aria-label="Welcome Message">
      <div class="welcome-header">
          <div class="blurp">
              <h1 tabindex="0">
                <?php 
                  if (!(get_theme_mod('welcome_title')) == null){
                    echo get_theme_mod('welcome_title');
                  }else{
                    echo bloginfo('title');     
                  }
                ?>
              </h1>
              <p tabindex="0">
                <?php 
                  if (!(get_theme_mod('welcome_description')) == null){
                    echo get_theme_mod('welcome_description');
                  }else{
                    echo bloginfo('description');
                  }
                   
                ?>
                
              </p>
          </div>
      </div>
  
  </section>

  <section class="post-list wrapper" role="main" aria-label="Main Content">
    <div class="post-list-wrapper">
      <?php get_template_part('loop'); ?>      
    </div>

    <?php get_template_part('pagination'); ?>
  </section>

<?php get_footer(); ?>
