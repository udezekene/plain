<?php
/**
 * Plain Theme Customizer
 *
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function plain_customize_register( $wp_customize ) {
    
    $wp_customize->add_panel( 'options_panel', array(
        'title'       => __( 'Plain: Theme Options', 'plain' ),
        'description' => __( 'Configure your theme settings', 'plain' ),
    ) );

    // Page Options.
    $wp_customize->add_section( 'welcome_header_options', array(
        'title'           => __( 'Welcome Header', 'plain' ),
        'panel'           => 'options_panel',
    ) );

    $wp_customize->add_setting('plain_theme_options[site_logo]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'transport'   => 'postMessage',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'site_logo', array(
        'label'    => __('Website Logo', 'plain'),
        'section'  => 'welcome_header_options',
        'description' => 'Upload the logo for the website. Ideally something in the 4:2 ratio',
        'settings' => 'plain_theme_options[site_logo]',
    )));

    $wp_customize->add_setting('welcome_title', array(
      'default'         => '',
      'capability'        => 'edit_theme_options',
      'transport'   => 'postMessage',
    ) );

    $wp_customize->add_control( 'welcome_title', array(
        'label'   => 'Welcome Title',
        'section' => 'welcome_header_options',
        'description' => 'This is the welcome description E.g: Welcome to Plain',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting('welcome_description', array(
      'default'         => '',
      'capability'        => 'edit_theme_options',

        'transport'   => 'postMessage',
      'sanitize_callback' => 'wp_filter_nohtml_kses', //removes all HTML from content

    ) );

    $wp_customize->add_control( 'welcome_description', array(
        'label'   => 'Welcome Description',
        'section' => 'welcome_header_options',
        'description' => 'This is the welcome text in the big E.g: Plain is a simple, yet bold WordPress theme that will help you kickstart your (hopefully) awesome blog. It’s absolutely FREE.',
        'type'    => 'textarea',
    ) );
    
    $wp_customize->add_setting('site_title', array(
      'default'         => 'Welcome to Plain',
      'capability'        => 'edit_theme_options',
      'transport'   => 'postMessage',
    ) );

    $wp_customize->add_section( 'socialmedia_options', array(
        'title'           => __( 'Social Media Links', 'plain' ),
        'panel'           => 'options_panel',
    ) );

    $wp_customize->add_setting( 'socialmedia_options', array(
        'default'           => 'two-column',
        'capability'        => 'edit_theme_options',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'plain_sanitize_layout',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_setting('settings_sm_facebook', array(
      'default'         => '',
      'capability'        => 'edit_theme_options',
      'transport'   => 'postMessage',
      'sanitize_callback' => 'esc_url_raw', //cleans URL from all invalid characters

    ) );

    $wp_customize->add_control( 'settings_sm_facebook', array(
        'label'   => 'Link to your Facebook Page or Profile',
        'section' => 'socialmedia_options',
        'description' => 'Full link to your facebook page. Eg: https://www.facebook.com/xxxxxxxxxx',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting('settings_sm_twitter', array(
      'default'         => '',
      'capability'        => 'edit_theme_options',
      'transport'   => 'postMessage',
      'sanitize_callback' => 'esc_url_raw', //cleans URL from all invalid characters

    ) );

    $wp_customize->add_control( 'settings_sm_twitter', array(
        'label'   => 'Link to your Twitter profile',
        'section' => 'socialmedia_options',
        'description' => 'Full link to your Twitter profile. Eg: https://www.twitter.com/xxxxxxxxxx',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting('settings_sm_instagram', array(
      'default'         => '',
      'capability'        => 'edit_theme_options',
      'transport'   => 'postMessage',
      'sanitize_callback' => 'esc_url_raw', //cleans URL from all invalid characters

    ) );

    $wp_customize->add_control( 'settings_sm_instagram', array(
        'label'   => 'Link to your Instagram profile',
        'section' => 'socialmedia_options',
        'description' => 'Full link to your Instagram profile. Eg: https://www.twitter.com/xxxxxxxxxx',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting('settings_sm_linkedin', array(
      'default'         => '',
      'capability'        => 'edit_theme_options',
      'transport'   => 'postMessage',
      'sanitize_callback' => 'esc_url_raw', //cleans URL from all invalid characters

    ) );

    $wp_customize->add_control( 'settings_sm_linkedin', array(
        'label'   => 'Link to your LinkedIn profile',
        'section' => 'socialmedia_options',
        'description' => 'Full link to your LinkedIn profile. Eg: https://www.linkedin.com/xxxxxxxxxx',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting('settings_sm_github', array(
      'default'         => '',
      'capability'        => 'edit_theme_options',
      'transport'   => 'postMessage',
      'sanitize_callback' => 'esc_url_raw', //cleans URL from all invalid characters

    ) );

    $wp_customize->add_control( 'settings_sm_github', array(
        'label'   => 'Link to your Github profile',
        'section' => 'socialmedia_options',
        'description' => 'Full link to your Github profile. Eg: https://www.linkedin.com/xxxxxxxxxx',
        'type'    => 'url',
    ) );


    $wp_customize->add_section( 'footer_options', array(
        'title'           => __( 'Footer Options', 'plain' ),
        'panel'           => 'options_panel',
    ) );

    $wp_customize->add_setting('plain_theme_options[settings_author_avatar]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'transport'   => 'postMessage',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'settings_author_avatar', array(
        'label'    => __('Author Avatar', 'plain'),
        'section'  => 'footer_options',
        'settings' => 'plain_theme_options[settings_author_avatar]',
    )));

    // Name of Author
    $wp_customize->add_setting('settings_author_name', array(
      'default'         => '',
      'capability'        => 'edit_theme_options',
      'transport'   => 'postMessage',
    ) );

    $wp_customize->add_control( 'settings_author_name', array(
        'label'   => 'Name of Author/Site-owner',
        'section' => 'footer_options',
        'description' => 'Name of the Author',
        'type'    => 'text',
    ) );

    // Short Bio of Author
    $wp_customize->add_setting('settings_author_bio', array(
      'default'         => '',
      'capability'        => 'edit_theme_options',
      'transport'   => 'postMessage',
      'sanitize_callback' => 'wp_filter_nohtml_kses', //removes all HTML from content
    ) );

    $wp_customize->add_control( 'settings_author_bio', array(
        'label'   => 'Author Bio',
        'section' => 'footer_options',
        'description' => 'About the author. Keep',
        'type'    => 'textarea',
    ) );



}
add_action( 'customize_register', 'plain_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function plain_customize_preview_js() {
    wp_enqueue_script( 'plain-customizer', get_theme_file_uri( '/js/customizer.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'plain_customize_preview_js' );

/**
 * Some extra JavaScript to improve the user experience in the Customizer for this theme.
 */
function plain_panels_js() {
    wp_enqueue_script( 'plain-panel-customizer', get_theme_file_uri( '/js/panel-customizer.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'plain_panels_js' );