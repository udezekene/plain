<footer role="contentinfo">
  <div class="about-author-wrapper">
    
    <?php
    
      if (!(get_theme_mod('plain_theme_options[settings_author_avatar]')) == null){
      $author_avatar_id = get_theme_mod('plain_theme_options[settings_author_avatar]');
      $author_avatar = wp_get_attachment_image_src( $author_avatar_id, 'full' );

    ?>
      <div class="author-photo">
          <img src="<?php echo $author_avatar ?>" title="<?php echo get_theme_mod('settings_author_name') ?>" alt="<?php echo get_theme_mod('settings_author_name') ?>" />
      </div>
    <?php } ?>

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