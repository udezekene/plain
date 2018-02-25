<footer role="contentinfo">
  <div class="about-author-wrapper">
    
    <?php if (get_option('settings_author_avatar')): 
      $author_avatar = get_option('settings_author_avatar');
    ?>
    <div class="author-photo">
      <img src="<?php echo $author_avatar; ?>" title="<?php echo get_theme_mod('settings_author_bio'); ?>" alt="<?php echo $author_avatar; ?>" />
    </div>
    <?php endif; ?>
    
    <div class="author-bio">
        <h3> <?php echo get_theme_mod('settings_author_name') ?></h3>
        
        <?php if (!(get_theme_mod('settings_author_bio')) == null){ ?>
          <?php echo get_theme_mod('settings_author_bio') ?>
        <?php } ?>        
    </div>
    <ul class="social-menu">
        <?php get_template_part('inc/social-media'); ?>
    </ul>

    <div class="copyright">© <?php echo date('Y'); if (!(get_theme_mod('settings_author_name')) == null){ ?> <?php echo get_theme_mod('settings_author_name') ?>. <?php } ?></div>
  </div>
</footer>