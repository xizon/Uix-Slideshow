<?php
/*
 * Custom Metaboxes and Fields
 *
 */

$custom_metaboxes_uix_slideshow        = new Uix_Slideshow_Uix_Custom_Metaboxes();
$custom_metaboxes_uix_slideshow::$vars = array(
	
    //-- Slider Settings
	array(
		'config' => array( 
			'id'         =>  'uix-slideshow-main-settings', 
			'title'      =>  esc_html__( 'Slider Settings', 'uix-slideshow' ),
			'screen'     =>  'uix-slideshow', 
			'context'    =>  'normal',
			'priority'   =>  'high',
			'fields' => array( 
				
				array(
					'id'             =>  'uix_slideshow_img',
					'type'           =>  'image',
					'title'          =>  esc_html__( 'Slider Image', 'uix-slideshow' ),
				),
	
				array(
					'id'             =>  'uix_slideshow_caption',
					'type'           =>  'textarea',
					'title'          =>  esc_html__( 'Caption', 'uix-slideshow' ),
					'desc_primary'   =>  UixSlideshow::kses( __( 'When this field is not empty, it will be displayed on the front-end page.', 'uix-slideshow' ) ),
	                'options'     =>  array( 
	                                    'rows'  => 3	
									  )
				),
	
				array(
					'id'       =>  'uix_slideshow_title_color',
					'type'     =>  'color',
					'title'    =>  esc_html__( 'Title Color', 'uix-slideshow' ),
	                'default'  => '#ffffff'
				),
	
				array(
					'id'       =>  'uix_slideshow_caption_color',
					'type'     =>  'color',
					'title'    =>  esc_html__( 'Caption Color', 'uix-slideshow' ),
	                'default'  => '#ffffff'
				),
	
	
	
	
			)
		)

	),
	
	
	
	//-- URL Settings
	array(
		'config' => array( 
			'id'         =>  'uix-slideshow-url-settings', 
			'title'      =>  esc_html__( 'URL Settings', 'uix-slideshow' ),
			'screen'     =>  'uix-slideshow', 
			'context'    =>  'normal',
			'priority'   =>  'high',
			'fields' => array( 
	
	
				array(
					'id'             =>  'uix_slideshow_url',
					'type'           =>  'url',
					'title'          =>  esc_html__( 'URL', 'uix-slideshow' ),
	                'placeholder'    =>  esc_html__( 'http://', 'uix-slideshow' ),
					'desc_primary'   =>  UixSlideshow::kses( __( 'Enter a custom URL to link this slide to. When the URL is not empty, the button will be displayed on the front-end page.', 'uix-slideshow' ) ),
				),
	
				array(
					'id'            =>  'uix_slideshow_target',
					'type'          =>  'checkbox',
					'title'         =>  esc_html__( 'Target', 'uiuxlabtheme' ),
	                'desc_primary'   =>  UixSlideshow::kses( __( 'Open Link In A New Window/Tab.', 'uix-slideshow' ) ),

				),
	
	
	
	
	
	
			)
		)

	),
	
	
	//-- Button Settings
	array(
		'config' => array( 
			'id'         =>  'uix-slideshow-btn-settings', 
			'title'      =>  esc_html__( 'Button Settings', 'uix-slideshow' ),
			'screen'     =>  'uix-slideshow', 
			'context'    =>  'side',
			'priority'   =>  'low',
			'fields' => array( 
	
				array(
					'id'       =>  'uix_slideshow_bcolor',
					'type'     =>  'color',
					'title'    =>  esc_html__( 'Color', 'uix-slideshow' ),
	                'default'  => '#ffffff'
				),
	
				array(
					'id'       =>  'uix_slideshow_bhcolor',
					'type'     =>  'color',
					'title'    =>  esc_html__( 'Hover Color', 'uix-slideshow' ),
	                'default'  => '#333333'
				),
	
				array(
					'id'       =>  'uix_slideshow_button_textcolor',
					'type'     =>  'color',
					'title'    =>  esc_html__( 'Text Color', 'uix-slideshow' ),
	                'default'  => '#ffffff'
				),
	
				array(
					'id'          =>  'uix_slideshow_bsize',
					'type'        =>  'select',
					'title'       =>  esc_html__( 'Size', 'uiuxlabtheme' ),
					'default'     =>  'small',
	                'options'     =>  array( 
										'value'       => array(
											'tiny'     => esc_html__( 'Tiny', 'uix-slideshow' ),
											'small'    => esc_html__( 'Small', 'uix-slideshow' ),
											'medium'   => esc_html__( 'Medium', 'uix-slideshow' ),
											'large'    => esc_html__( 'Large', 'uix-slideshow' ),
										 )
	
											
									  )

				),
	
	
				array(
					'id'             =>  'uix_slideshow_button_text',
					'type'           =>  'text',
					'title'          =>  esc_html__( 'Text On The Button', 'uix-slideshow' ),
					'default'        => esc_html__( 'Check Out', 'uix-slideshow' )
				),
	
			
	
	
	
			)
		)

	),
	
	
);

$custom_metaboxes_uix_slideshow::get_instance();


/**
 * Thumbnail support for slideshow posts
 *
 */
add_theme_support( 'post-thumbnails', array( 'uix-slideshow' ) );

/*
 * Removing a Meta Box
 * 
 */ 

function uix_slideshow_remove_custom_field_meta_box() {
	remove_meta_box( 'postimagediv', 'uix-slideshow', 'side' );
}
add_action( 'do_meta_boxes', 'uix_slideshow_remove_custom_field_meta_box' );


function uix_slideshow_featured_image_column_remove_post_types( $post_types ) {
    foreach( $post_types as $key => $post_type ) {
        if ( 'uix-slideshow' === $post_type ) // Post type you'd like removed. Ex: 'post' or 'page'
            unset( $post_types[$key] );
    }
    return $post_types;
}

function uix_slideshow_featured_image_column_init() {
    add_filter( 'featured_image_column_post_types', 'uix_slideshow_featured_image_column_remove_post_types', 11 ); // Remove
}
add_action( 'featured_image_column_init', 'uix_slideshow_featured_image_column_init' );




/**
 * Registers the "Slideshow" custom post type
 *
 * @link	http://codex.wordpress.org/Function_Reference/register_post_type
 */

function uix_slideshow_taxonomy_register() {

	// Define post type labels
	$labels = array(
		'name'					=> __( 'Uix Slideshow', 'uix-slideshow' ),
		'singular_name'			=> __( 'Slideshow Item', 'uix-slideshow' ),
		'add_new'				=> __( 'Add New Item', 'uix-slideshow' ),
		'add_new_item'			=> __( 'Add New Slideshow Item', 'uix-slideshow' ),
		'edit_item'				=> __( 'Edit Slideshow Item', 'uix-slideshow' ),
		'new_item'				=> __( 'Add New Slideshow Item', 'uix-slideshow' ),
		'view_item'				=> __( 'View Item', 'uix-slideshow' ),
		'search_items'			=> __( 'Search Slideshow', 'uix-slideshow' ),
		'not_found'				=> __( 'No slideshow items found', 'uix-slideshow' ),
		'not_found_in_trash'	=> __( 'No slideshow items found in trash', 'uix-slideshow' )
	);
	
	// Define post type args
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'supports'			=> array( 'title', 'thumbnail'),
		'capability_type'	=> 'post',
		'rewrite'			=> false,
		'has_archive'		=> false,
		'menu_icon'			=> 'dashicons-images-alt2',
	); 
	
	// Apply filters for child theming
	$args = apply_filters( 'uix_slideshow_args', $args );
	
	
	// Register the post type
	register_post_type( 'uix-slideshow', $args );

}
add_action( 'init', 'uix_slideshow_taxonomy_register', 0 );





/**
 * Adds columns in the admin view for thumbnail and taxonomies
 *
 *
 */

	
function uix_slideshow_taxonomy_edit_cols( $columns ) {

	$columns = array(
		'cb' 		                => $columns['cb'], 
		'uix-slideshow-thumbnail'      => __( 'Slide Image', 'uix-slideshow' ),
		'title'                  	=> $columns['title'], 
		'uix-slideshow-url'            => __( 'URL', 'uix-slideshow' ),
		'author' 	                => __('Author', 'uix-slideshow'),
		'date'                      => $columns['date']
		
	);
	
	return $columns;
}
add_filter( 'manage_edit-uix-slideshow_columns', 'uix_slideshow_taxonomy_edit_cols' );


/**
 * Adds columns in the admin view for thumbnail and taxonomies
 *
 * Display the meta_boxes in the column view
 */
function uix_slideshow_taxonomy_cols_display( $columns, $post_id ) {
	
	switch ( $columns ) {
		
		case 'uix-slideshow-thumbnail':
	
	
	        // Get attachment ID
			$image_src = get_post_meta( $post_id, 'uix_slideshow_img', true );
			$image_id = attachment_url_to_postid( $image_src );
			
		
			if ( $image_id ) {
				$thumb = wp_get_attachment_image_url( $image_id, array( '50', '50' ), true );
			}
			
			if ( isset( $thumb ) ) {
				echo '<a href="'.$image_src.'" target="_blank"><img src="'.$thumb.'" style="max-width:50px; max-height:50px"></a>';
			} else {
				echo '&mdash;';
			}
			
			

		break;	

	
		case 'uix-slideshow-url':


			$url = esc_html( get_post_meta( get_the_ID(), 'uix_slideshow_url', true ) );
			if ( $url == 'http://' || $url == 'https://' ) $url = '';
			
			if ( $url != '' ) {
				echo '<a href="'.$url.'" target="_blank">'.$url.'</a>';
			} else {
				echo '&mdash;';
			}
			
		break;		
		
	}

}
add_action( 'manage_uix-slideshow_posts_custom_column', 'uix_slideshow_taxonomy_cols_display', 10, 2 );


/**
 * Display “Edit | Quick Edit | Trash ” in custom WP_List_Table column
 */
function uix_slideshow_row_actions() {
	
	  //Check if screen’s ID, base, post type, and taxonomy, among other data points
	  $currentScreen = get_current_screen();

	  if( ( mb_strlen( strpos( $currentScreen->id, 'uix_slideshow' ), 'UTF8' ) > 0 || mb_strlen( strpos( $currentScreen->id, 'uix-slideshow' ), 'UTF8' ) > 0 ) && mb_strlen( strpos( $currentScreen->id, '_page_' ), 'UTF8' ) <= 0 ) {
		  add_filter( 'post_row_actions', 'uix_slideshow_remove_row_actions', 10, 1 );
	  }
	

}	
function uix_slideshow_remove_row_actions( $actions ){
    if( get_post_type() === 'uix-slideshow' )
        unset( $actions['view'] );
		unset( $actions['inline hide-if-no-js'] );
       
    return $actions;
}
add_action( 'current_screen', 'uix_slideshow_row_actions' );


/**
 * Removes the permalinks display on the custom post type
 */
function uix_slideshow_remove_permalink() {
	if( get_post_type() === 'uix-slideshow' ) {
			echo '
			<style>
		    	#edit-slug-box,
				#post-preview,
				.notice-success > p > a
				{display:none;}
			</style>';
	}
}
add_action( 'admin_head', 'uix_slideshow_remove_permalink' );


/*
 * Remove comments metabox of "page" but still allow comments
 *
*/

if ( is_admin() ) {
    function uix_slideshow_remove_meta_boxes() {
       remove_meta_box( 'commentstatusdiv', 'uix-slideshow', 'normal' );
	   remove_meta_box( 'commentsdiv', 'uix-slideshow', 'normal' );
	   remove_meta_box( 'slugdiv', 'uix-slideshow', 'normal' );
	
    }
    add_action( 'admin_menu', 'uix_slideshow_remove_meta_boxes' );
	
}




