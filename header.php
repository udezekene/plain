<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>


		
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<?php wp_head(); ?>
	</head>
	<body>
  
   <header class="wrapper">
  
      <div class="logo-wrapper">
        <a href="<?php echo get_site_url(); ?>">
          
          <?php
              
              $default_logo =  get_template_directory_uri() . '/img/logo.png';

              if (!(get_option('plain_site_logo')) == null){
              $blog_logo = get_option('plain_site_logo');
          ?>
          <img src="<?php echo esc_url($blog_logo); ?>" alt="<?php echo get_bloginfo('name'); ?>" title="<?php echo get_bloginfo('name'); ?>">

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