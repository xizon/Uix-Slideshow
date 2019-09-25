<?php
/*
 * Custom Metaboxes and Fields
 *
 */


/*

 
if ( class_exists( 'Uix_Slideshow_Custom_Metaboxes' ) ) {

	$custom_metaboxes_page_vars = array(

		//-- Group
		array(
			'config' => array( 
				'id'         =>  'yourtheme_metaboxes-1', 
				'title'      =>  esc_html__( '[Demo] Normal Fields', 'your-theme' ),
				'screen'     =>  'page', 
				'context'    =>  'normal',
				'priority'   =>  'high',
				'fields' => array( 
					array(
						'id'          =>  'cus_page_ex_demoname_1',
						'type'        =>  'textarea',
						'title'       =>  esc_html__( 'Textarea', 'your-theme' ),
						'placeholder' =>  esc_html__( 'Placeholder Text', 'your-theme' ),
						'desc'        =>  esc_html__( 'Here is the description. It could be left blank. (Support for HTML tags)', 'your-theme' ),
						'default'     =>  '',
						'options'     =>  array( 
											'rows'  => 5	
										  )
					),
					array(
						'id'            =>  'cus_page_ex_demoname_2',
						'type'          =>  'text',
						'title'         =>  esc_html__( 'Text', 'your-theme' ),
						'desc_primary'  =>  esc_html__( 'Here is the description. It could be left blank.', 'your-theme' ),
						'default'       =>  '123',
					),

					array(
						'id'            =>  'cus_page_ex_demoname_3',
						'type'          =>  'url',
						'title'         =>  esc_html__( 'URL', 'your-theme' )
					),

					array(
						'id'          =>  'cus_page_ex_demoname_4',
						'type'        =>  'number',
						'title'       =>  esc_html__( 'Number', 'your-theme' ),
						'options'     =>  array( 
											'units'  =>  esc_html__( 'px', 'your-theme' )
										  )

					),



					array(
						'id'          =>  'cus_page_ex_demoname_5',
						'type'        =>  'radio',
						'title'       =>  esc_html__( 'Radio', 'your-theme' ),
						'default'     =>  '2',
						'options'     =>  array( 
											'radio_type'  => 'normal',
											'value'       => array(
												'1'            =>  esc_html__( 'Option: 1', 'your-theme' ),
												'2'            =>  esc_html__( 'Option: 2 (Default)', 'your-theme' ),
												'3'            =>  esc_html__( 'Option: 3', 'your-theme' ),	
											 )


										  )

					),

					array(
						'id'          =>  'cus_page_ex_demoname_5_2',
						'type'        =>  'radio',
						'title'       =>  esc_html__( 'Radio 2', 'your-theme' ),
						'options'     =>  array( 
											'br'          => true,
											'radio_type'  => 'normal',
											'value'       => array(
												'1'            =>  esc_html__( 'Option: 1', 'your-theme' ),
												'2'            =>  esc_html__( 'Option: 2', 'your-theme' ),
												'3'            =>  esc_html__( 'Option: 3', 'your-theme' ),	
											 )


										  )

					),



					array(
						'id'            =>  'cus_page_ex_demoname_6',
						'type'          =>  'radio',
						'title'         =>  esc_html__( 'Radio(Associated)', 'your-theme' ),
						'desc_primary'  =>  esc_html__( 'It is valid to assign height to page title area when the featured image is not empty.', 'your-theme' ),

						'default'     =>  'normal',
						'options'     =>  array( 
											'radio_type'  => 'normal',
											'value'       =>  array(
												'normal'       =>  esc_html__( 'Option: Normal(Default)', 'your-theme' ),
												'higher'       =>  esc_html__( 'Option: Higher', 'your-theme' ),
												'full-screen'  =>  esc_html__( 'Option: Full Screen', 'your-theme' ),
												'cus-height'   =>  esc_html__( 'Option: Custom Height', 'your-theme' ),
											 ),
											'toggle'      =>  array(
												'normal'       =>  '',
												'higher'       =>  '',
												'full-screen'  =>  array(
                                                                    'id'             =>  'cus_page_ex_demoname_6_opt-full-screen-toggle',
                                                                    'type'           =>  'text',
                                                                    'title'          =>  esc_html__( 'full-screen', 'your-theme' ),
                                                                    'desc_primary'   =>  '',
                                                                ),
												'cus-height'   =>  array( 
                                                                    'id'       =>  'cus_page_ex_demoname_6_opt-cus-height-toggle', 
                                                                    'type'     =>  'number',
                                                                    'default'  =>  350,
                                                                    'options'     =>  array( 
                                                                                        'units'  =>  esc_html__( 'px', 'your-theme' )
                                                                                      )
                                                                ),
											 ),
										  )

					),


					array(
						'id'          =>  'cus_page_ex_demoname_7',
						'type'        =>  'radio',
						'title'       =>  esc_html__( 'Radio Image', 'your-theme' ),
						'default'     =>  'no-sidebar',
						'options'     =>  array( 
											'radio_type'  => 'image',
											'value'       => array(
												'no-sidebar'    =>  esc_url( '/images/layouts/no-sidebar.png' ),
												'sidebar'       =>  esc_url( '/images/layouts/sidebar.png' ),
											 )


										  )

					),

					array(
						'id'            =>  'cus_page_ex_demoname_8',
						'type'          =>  'checkbox',
						'title'         =>  esc_html__( 'Checkbox', 'your-theme' ),
						'desc_primary'  =>  esc_html__( 'Here is the description. It could be left blank.', 'your-theme' ),

					),

					array(
						'id'          =>  'cus_page_ex_demoname_9',
						'type'        =>  'select',
						'title'       =>  esc_html__( 'Select', 'your-theme' ),
						'default'     =>  '3',
						'options'     =>  array( 
											'value'       => array(
												'1'            =>  esc_html__( 'Option: 1', 'your-theme' ),
												'2'            =>  esc_html__( 'Option: 2', 'your-theme' ),
												'3'            =>  esc_html__( 'Option: 3 (Default)', 'your-theme' ),	
											 )


										  )

					),

					array(
						'id'             =>  'cus_page_ex_demoname_10',
						'type'           =>  'price',
						'title'          =>  esc_html__( 'Price', 'your-theme' ),
						'desc_primary'   =>  esc_html__( 'Here is the description. It could be left blank.', 'your-theme' ),
						'options'        =>  array( 
											'units'  =>  esc_html__( '$', 'your-theme' )
										  )

					),

					array(
						'id'          =>  'cus_page_ex_demoname_11',
						'type'        =>  'multi-checkbox',
						'title'       =>  esc_html__( 'Multi Checkbox', 'your-theme' ),
						'default'     =>  array( 'opt-1', 'opt-3' ),
						'options'     =>  array( 
											'br'          => true,
											'value'       => array(
												'opt-1'            =>  esc_html__( 'Option: 1', 'your-theme' ),
												'opt-2'            =>  esc_html__( 'Option: 2', 'your-theme' ),
												'opt-3'            =>  esc_html__( 'Option: 3', 'your-theme' ),	
												'opt-4'            =>  esc_html__( 'Option: 4', 'your-theme' ),
												'opt-5'            =>  esc_html__( 'Option: 5', 'your-theme' ),
												'opt-6'            =>  esc_html__( 'Option: 6', 'your-theme' ),	
											 )


										  )

					),



				)
			)

		),

		//-- Group
		array(
			'config' => array( 
				'id'         =>  'yourtheme_metaboxes-2', 
				'title'      =>  esc_html__( '[Demo] Appearance Fields', 'your-theme' ),
				'screen'     =>  'page',
				'context'    =>  'normal',
				'priority'   =>  'high',
				'fields' => array( 
					array(
						'id'          =>  'cus_page_ex_demoname_appear_1',
						'type'        =>  'image',
						'title'       =>  esc_html__( 'Image', 'your-theme' ),
						'placeholder' =>  esc_html__( 'Image URL', 'your-theme' ),
					),
					array(
						'id'       =>  'cus_page_ex_demoname_appear_2',
						'type'     =>  'color',
						'title'    =>  esc_html__( 'Color', 'your-theme' ),
					),
					array(
						'id'       =>  'cus_page_ex_demoname_appear_3',
						'type'     =>  'editor',
						'title'    =>  esc_html__( 'Editor', 'your-theme' ),
						'options'     =>  array( 
											'height'  => 200,
											'toolbar'  => 'formatselect fontselect forecolor backcolor bold italic underline strikethrough bullist numlist blockquote code alignleft aligncenter alignright uix_slideshow_link uix_slideshow_unlink | removeformat outdent indent superscript subscript hr uix_slideshow_image uix_slideshow_highlightcode media customCode fullscreen'
										  )
					),
					array(
						'id'            =>  'cus_page_ex_demoname_appear_4',
						'type'          =>  'date',
						'title'         =>  esc_html__( 'Date', 'your-theme' ),
						'desc_primary'  =>  UixShortcodes::kses( __( 'Enter date of your projects. <strong>(optional)</strong>', 'your-theme' ) ),
						'options'       =>  array( 
											'format'  => 'MM dd, yy',
										  )


					),

					array(
						'id'            =>  'cus_page_ex_demoname_appear_5',
						'type'          =>  'custom-attrs',
						'title'         =>  esc_html__( 'Custom Attributes', 'your-theme' ),
						'options'       =>  array( 
											'label_title'  => esc_html__( 'Title', 'your-theme' ),
											'label_value'  => esc_html__( 'Value', 'your-theme' ),
										  )



					),
                    
                    
                    
					array(
						'id'            =>  'uix_slideshow_themeplugin_multicontent',
						'type'          =>  'multi-content',
						'title'         =>  esc_html__( 'Multiple Content Area', 'your-theme' ),
						'options'       =>  array( 
											'label_title'      => esc_html__( 'Title', 'your-theme' ),
											'label_value'      => esc_html__( 'Contnet', 'your-theme' ),
                                            'label_id'         => esc_html__( 'Step ID', 'your-theme' ),
                                            'label_subtitle'   => esc_html__( 'Subtitle', 'your-theme' ),
                                            'label_level'      => esc_html__( 'Level', 'your-theme' ),
                                            'label_classname'  => esc_html__( 'Class Name', 'your-theme' ),
                                            'height_teeny'     => 50,
                                            'toolbar_teeny'    => 'formatselect forecolor backcolor bold italic underline strikethrough alignleft aligncenter alignright uix_slideshow_link uix_slideshow_unlink removeformat customCode',
											'height'           => 450,
											'toolbar'          => 'formatselect fontselect forecolor backcolor bold italic underline strikethrough bullist numlist blockquote code alignleft aligncenter alignright uix_slideshow_link uix_slideshow_unlink | removeformat outdent indent superscript subscript hr uix_slideshow_image uix_slideshow_highlightcode media customCode fullscreen'
										  )



					),




				)
			)

		),	
	);

	$custom_metaboxes_page = new Uix_Slideshow_Custom_Metaboxes( apply_filters( 'custom_metaboxes_uix_slideshow_vars', $custom_metaboxes_uix_slideshow_vars ) );
}


 */



/*
 [Front-end Page]:
 
 $demoname = get_post_meta( get_the_ID(), 'cus_page_ex_demoname_1', true );
 
*/

/*
 [Dev]:
 
    if ( !function_exists( 'mytheme_modify_vars' ) ) {
        add_filter( 'uix_slideshow_custom_metaboxes_vars', 'mytheme_modify_vars' );
        function mytheme_modify_vars() {

            $all_config = array();
            $config  = array(

                    //-- Settings 1
                    array(
                        'config' => array( ... )
                    ),

                   //-- Settings 2
                    array(
                        'config' => array( ... )
                    ),

                );

            array_push( $all_config, $config );

            return $all_config;

        } 
    }

 
*/



if ( class_exists( 'Uix_Slideshow_Custom_Metaboxes' ) ) { 
	
    $custom_metaboxes_uix_slideshow_vars  = array(

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
                        'title'    =>  esc_html__( 'Background/Border Color', 'uix-slideshow' ),
                        'default'  => '#ffffff'
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

	$custom_metaboxes_uix_slideshow = new Uix_Slideshow_Custom_Metaboxes( $custom_metaboxes_uix_slideshow_vars );
	
}




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




