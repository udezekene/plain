<?php
/**
 * Plain Customizer functionality
 */


add_action( 'customize_register', 'plain_customize' );
function plain_customize($wp_customize) {

    $wp_customize->add_section( 'plain_theme_settings', array(
        'title'          => 'Customize Plain Theme',
        'priority'       => 35,
    ) );

    $wp_customize->add_setting( 'some_setting', array(
        'default'        => 'default_value',
    ) );

    $wp_customize->add_control( 'some_setting', array(
        'label'   => 'Text Setting',
        'section' => 'plain_theme_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'some_other_setting', array(
        'default'        => '#000000',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'some_other_setting', array(
        'label'   => 'Color Setting',
        'section' => 'plain_theme_settings',
        'settings'   => 'some_other_setting',
    ) ) );

}