<?php
/**
 * Thumbnail support for slideshow posts
 *
 */
add_theme_support( 'post-thumbnails', array( 'uix-slideshow' ) );

/*
 * Removing a Meta Box
 * 
 */ 
if ( !function_exists( 'uix_slideshow_remove_custom_field_meta_box' ) ) {
    add_action( 'do_meta_boxes', 'uix_slideshow_remove_custom_field_meta_box' );
    function uix_slideshow_remove_custom_field_meta_box() {
        remove_meta_box( 'postimagediv', 'uix-slideshow', 'side' );
    }

}



if ( !function_exists( 'uix_slideshow_featured_image_column_init' ) ) {
    add_action( 'featured_image_column_init', 'uix_slideshow_featured_image_column_init' );
    function uix_slideshow_featured_image_column_init() {
        add_filter( 'featured_image_column_post_types', 'uix_slideshow_featured_image_column_remove_post_types', 11 ); // Remove
    }


    function uix_slideshow_featured_image_column_remove_post_types( $post_types ) {
        foreach( $post_types as $key => $post_type ) {
            if ( 'uix-slideshow' === $post_type ) // Post type you'd like removed. Ex: 'post' or 'page'
                unset( $post_types[$key] );
        }
        return $post_types;
    }
 
}





/**
 * Registers the "Slideshow" custom post type
 *
 * @link	http://codex.wordpress.org/Function_Reference/register_post_type
 */
if ( !function_exists( 'uix_slideshow_taxonomy_register' ) ) {
    add_action( 'init', 'uix_slideshow_taxonomy_register', 0 );
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
            'supports'			=> array( 'title', 'editor', 'thumbnail' ),
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
}







/**
 * Adds columns in the admin view for thumbnail and taxonomies
 *
 *
 */
if ( !function_exists( 'uix_slideshow_taxonomy_edit_cols' ) ) {
    add_filter( 'manage_edit-uix-slideshow_columns', 'uix_slideshow_taxonomy_edit_cols' );
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
}





/**
 * Adds columns in the admin view for thumbnail and taxonomies
 *
 * Display the meta_boxes in the column view
 */
if ( !function_exists( 'uix_slideshow_taxonomy_cols_display' ) ) {
    add_action( 'manage_uix-slideshow_posts_custom_column', 'uix_slideshow_taxonomy_cols_display', 10, 2 );
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
}




/**
 * Display “Edit | Quick Edit | Trash ” in custom WP_List_Table column
 */
if ( !function_exists( 'uix_slideshow_row_actions' ) ) {
    add_action( 'current_screen', 'uix_slideshow_row_actions' );
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
  
}




/**
 * Removes the permalinks display on the custom post type
 */
if ( !function_exists( 'uix_slideshow_remove_permalink' ) ) {
    add_action( 'admin_head', 'uix_slideshow_remove_permalink' );
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
  
}



/*
 * Remove comments metabox of "page" but still allow comments
 *
*/
if ( !function_exists( 'uix_slideshow_remove_meta_boxes' ) ) {

    if ( is_admin() ) {
        add_action( 'admin_menu', 'uix_slideshow_remove_meta_boxes' );
        function uix_slideshow_remove_meta_boxes() {
           remove_meta_box( 'commentstatusdiv', 'uix-slideshow', 'normal' );
           remove_meta_box( 'commentsdiv', 'uix-slideshow', 'normal' );
           remove_meta_box( 'slugdiv', 'uix-slideshow', 'normal' );

        }
    }  
}





