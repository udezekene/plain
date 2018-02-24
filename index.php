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
      <?php if (have_posts()): 
          
          while (have_posts()) : the_post(); 
          
            get_template_part( 'loop');            
          
          endwhile; ?>
    </div>

    <?php 

            if ($wp_query->max_num_pages > 1): 

              get_template_part( 'pagination');

            endif;

        else:

      endif;
      
      wp_reset_query();

    ?>
  

    

  </section>

<?php get_footer(); ?>
