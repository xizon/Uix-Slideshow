<?php
/*
 * Custom Metaboxes and Fields
 *
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
                        'title'          =>  esc_html__( 'Slider Image or Video', 'uix-slideshow' ),
                        'options'     =>  array( 
                                                'label_controller_up_remove'  => esc_html__( 'Remove', 'uix-slideshow' ),
                                                'label_controller_up_add'     => esc_html__( 'Select a file', 'uix-slideshow' )
                                          )
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
                        'title'         =>  esc_html__( 'Target', 'uix-slideshow' ),
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



