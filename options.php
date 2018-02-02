<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/options-framework/images/';

	$options = array();

	$options[] = array(
		'name' => __( 'Homepage Settings', 'theme-textdomain' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Welcome Text'),
		'desc' => __( 'The main text at the top of the page' ),
		'id' => 'welcome_text',
		'std' => 'Welcome to the Plain.',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Welcome Description', 'theme-textdomain' ),
		'desc' => __( 'This is the text that will appear directly below the header' ),
		'id' => 'welcome_description',
		'placeholder' => 'Tell the world what to expect from you',
		'std' => 'Plain is a simple, yet bold WordPress theme that will help you kickstart your (hopefully) awesome blog. It’s absolutely free.', 'theme-textdomain',
		'type' => 'textarea'
	);

	
	$options[] = array(
		'name' => __( 'About Author', 'theme-textdomain' ),
		'desc' => __( 'Tell us about the author of this website'),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( 'Author Picture'),
		'desc' => __( 'Upload your picture. It will appear in the footer area.'),
		'id' => 'author_photo',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Author Name'),
		'desc' => __( 'Name of the author' ),
		'id' => 'author_name',
		'std' => 'Hailey Walters',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'About the Author', 'theme-textdomain' ),
		'desc' => __( 'A short description. Consider this a twitter bio. For the sake of the world, please don\'t make this a blog post'),
		'id' => 'author_description',
		'std' => 'Don’t panic, when it gets crazy and rough, don’t panic, stay calm. Hammock talk come soon. The key is to drink coconut, fresh coconut, trust me.',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Social Media Links'),
		'type' => 'heading'
	);


	
	$options[] = array(
		'name' => __( 'Social Media Links'),
		'desc' => __( 'Add your social media handles/links. The social media icon will only be visible to visitors if you the field is not empty '),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __('Twitter Username'),
		'desc' => __( 'Enter your twitter username without the \'@\' Eg. udezekene' ),
		'id' => 'sm_twitter',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Instagram Username'),
		'desc' => __( 'Enter your instagram username username without the \'@\' Eg. udezekene' ),
		'id' => 'sm_instagram',
		'std' => '',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __('Github Username'),
		'desc' => __( 'Enter the link to your github page Eg. udezekene' ),
		'id' => 'sm_github',
		'std' => '',
		'type' => 'text'
	);


	$options[] = array(
		'name' => __('Facebook URL'),
		'desc' => __( 'Enter the link to your facebook page' ),
		'id' => 'sm_facebook',
		'std' => '',
		'type' => 'text'
	);


	$options[] = array(
		'name' => __('LinkedIn URL'),
		'desc' => __( 'Enter the link to your linkedin page' ),
		'id' => 'sm_linkedin',
		'std' => '',
		'type' => 'text'
	);

	return $options;
}