<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
	</head>
	<body>
  

   <header class="wrapper">
  
      <div class="logo-wrapper">
        <a href="<?php echo get_site_url(); ?>">
          
          <?php
              
              $default_logo =  get_template_directory_uri() . '/img/logo.png';

              if (!(get_theme_mod('plain_theme_options[blog_logo]')) == null){
              $blog_logo = get_theme_mod('plain_theme_options[blog_logo]', true);
              $logo = wp_get_attachment_image_src( $blog_logo, 'full' );
          ?>
          <img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo get_bloginfo('name'); ?>" title="<?php echo get_bloginfo('name'); ?>">

          <?php  } else { ?>
          
            <img src="<?php echo $default_logo; ?>" alt="<?php echo get_bloginfo('name'); ?>" title="<?php echo get_bloginfo('name'); ?>">

          <?php } ?>

        </a>
      </div>

      <div class="social-menu-wrapper">
        
        <ul class="social-menu">
            <?php get_template_part('inc/social-media'); ?>
        </ul>
    
      </div>
    
  
    </header>