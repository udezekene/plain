  <?php get_header(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		 <section class="post-header-wrapper">
        
            <div class="post-title">
                
                <h2><?php the_title(); ?></h1>
                <span title="date"><?php the_time('F j, Y'); ?></span>
            </div>    
        
        
      	<!-- post thumbnail -->
        <?php if (plain_featured_image()) { ?>
          <div class="post-image">
            <img src="<?php echo plain_featured_image() ?>" alt="">
          </div>    
				<?php } ?>
				<!-- /post thumbnail -->

    </section>

    <section class="post-content">
      <div class="the-post">
        <?php the_content(); // Dynamic Content ?>  
      </div>
    </section>

    <section class="comments wrapper">
      <div class="comments-wrapper">
        <?php comments_template(); ?>
      </div>
    </section>


	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'plain' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php get_footer(); ?>
