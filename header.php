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
          
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

            if ( has_custom_logo() ) { 

          ?>
            <img src="<?php echo esc_url( $logo[0] ); ?>" alt="" title="Plain. Logo">

          <?php  } else { echo '<h1>'. get_bloginfo( 'name' ) .'</h1>'; } ?>
        </a>
      </div>

      <div class="social-menu-wrapper">
        
        <ul class="social-menu">
            <li><a href="" aria-hidden="true" class="facebook" target="_blank" title="Open Facebook Link"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="" aria-hidden="true" class="twitter" target="_blank" title="Open Twitter Link"><i class="fab fa-twitter"></i></a></li>
            <li><a href="" aria-hidden="true" class="instagram" target="_blank" title="Open Github Link"><i class="fab fa-instagram"></i></a></li>
            <li><a href="" aria-hidden="true" class="linkedin" target="_blank" title="Open Linkedin Link"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="" aria-hidden="true" class="github" target="_blank" title="Open Github Link"><i class="fab fa-github-square"></i></a></li>

        </ul>
    
      </div>
    
  
    </header>
