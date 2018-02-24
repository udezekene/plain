<?php 

	if ( has_post_thumbnail() ) {
    $image_url = plain_get_f_image_url('large');
  } else {
     
  }

?>	

<div class="post-block" role="article" and aria-label="<?php the_title(); ?>">
  
    <!-- post thumbnail -->
      <?php if (plain_featured_image()) { ?>
        <div class="__image">
          <img src="<?php echo plain_featured_image() ?>" alt="">
        </div>    
      <?php } ?>
      <!-- /post thumbnail -->


    <div class="__meta">
        <span title="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
    </div>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
</div>
