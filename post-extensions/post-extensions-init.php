<?php
/*
 * Custom Metaboxes and Fields
 *
 * Define the metabox and field configurations.
 * @param  array $meta_boxes
 * @return array
 *
 */


function uix_slideshow_metaboxes( array $meta_boxes ) {

	$meta_boxes[] = array(
		'id'			=> 'uix-slideshow-img',
		'title'			=> __( 'Slider Image', 'uix-slideshow' ),
		'pages'			=> array( 'uix-slideshow' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	    => false,
		'fields'		    => array(
			
			
			array(
				'name' => '',
				'id'   => 'uix_slideshow_img',
				'type' => 'file',
			),
			
		),
	);

	$meta_boxes[] = array(
		'id'			=> 'uix-slideshow-meta',
		'title'			=> __( 'Slider Settings', 'uix-slideshow' ),
		'pages'			=> array( 'uix-slideshow' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
		
			array(
				'name'	=> __( 'Caption', 'uix-slideshow' ),
				'desc'	=>  '',
				'id'	=> 'uix_slideshow_caption',
				'type'	=> 'textarea_small',
				
			),
			
			array(
				'name'    => __( 'Title Color', 'uix-slideshow' ),
				'desc'    => '',
				'id'      => 'uix_slideshow_title_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			
			array(
				'name'    => __( 'Caption Color', 'uix-slideshow' ),
				'desc'    => '',
				'id'      => 'uix_slideshow_caption_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			

		),
	);


	$meta_boxes[] = array(
		'id'			=> 'uix-slideshow-url-meta',
		'title'			=> __( 'URL Settings', 'uix-slideshow' ),
		'pages'			=> array( 'uix-slideshow' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	    => true,
		'fields'		    => array(
			array(
				'name'	=> __( 'URL', 'uix-slideshow' ),
				'desc'	=>  __( 'Enter a custom URL to link this slide to. Don\'t forget the http:// at the front!', 'uix-slideshow' ),
				'id'	=> 'uix_slideshow_url',
				'type'	=> 'text',
				
			),
			array(
				'name'	=> __( 'Button Label', 'uix-slideshow' ),
				'desc'	=>  __( 'It defines the text on the button.', 'uix-slideshow' ),
				'id'	=> 'uix_slideshow_button_text',
				'type'	=> 'text',
				'default' => __( 'Check Out', 'uix-slideshow' )
				
			),
			array(
				'name'	=> __( 'Target', 'uix-slideshow' ),
				'desc'	=>  __( 'Open link in a new window/tab', 'uix-slideshow' ),
				'id'	=> 'uix_slideshow_target',
				'type'	=> 'checkbox',
				'default' => false
				
			),
			
			

		),
	);



	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'uix_slideshow_metaboxes' );




/*
 * Custom Post Types
 *
 * WordPress can hold and display many different types of content. A single item of such a content is generally called a post, 
 * although post is also a specific post type. Internally, all the post types are stored in the same place, 
 * in the wp_posts database table, but are differentiated by a column called post_type.
 *
 */


//New custom post type
require_once 'slideshow.php';









 