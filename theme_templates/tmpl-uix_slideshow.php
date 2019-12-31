<?php
/**
 * The template for displaying Uix Slideshow.
 *
 *
 * Note: The function will be used to .php file of theme when get_header() exist. The code could also be sought for header.php file.
 * The .php file of theme contains the following standard code:

   get_template_part( 'tmpl', 'uix_slideshow' ); 
  
 *
 */
 
if ( ! class_exists( 'UixSlideshow' ) ) { 
    return;
}

// Query
$uix_slideshow_query = new WP_Query(
	array(
		'post_type'      => 'uix-slideshow',
		'posts_per_page' => -1,
		'no_found_rows'  => true
	)
);



$uix_slideshow_opt_animation       = get_option( 'uix_slideshow_opt_animation', 'slide' );
$uix_slideshow_opt_auto            = get_option( 'uix_slideshow_opt_auto', true );
$uix_slideshow_opt_effect_duration = get_option( 'uix_slideshow_opt_effect_duration', 600 );
$uix_slideshow_opt_speed           = get_option( 'uix_slideshow_opt_speed', 10000 );
$uix_slideshow_opt_paging_nav      = get_option( 'uix_slideshow_opt_paging_nav', true );
$uix_slideshow_opt_arr_nav         = get_option( 'uix_slideshow_opt_arr_nav', true );
$uix_slideshow_opt_animloop        = get_option( 'uix_slideshow_opt_animloop', true );
$uix_slideshow_opt_drag            = get_option( 'uix_slideshow_opt_drag', false );
$uix_slideshow_opt_prev_txt        = get_option( 'uix_slideshow_opt_prev_txt', '<span class=\'custom-slideshow-flex-dir custom-slideshow-flex-dir-prev\'></span>' );
$uix_slideshow_opt_next_txt        = get_option( 'uix_slideshow_opt_next_txt', '<span class=\'custom-slideshow-flex-dir custom-slideshow-flex-dir-next\'></span>' );




$translation_array = array(
    'animation'        =>  $uix_slideshow_opt_animation,
    'auto'             =>  ( $uix_slideshow_opt_auto ) ? 'true' : 'false',
    'duration'         =>  $uix_slideshow_opt_effect_duration,
    'speed'            =>  $uix_slideshow_opt_speed,
    'paging_nav'       =>  ( $uix_slideshow_opt_paging_nav ) ? 'true' : 'false',
    'arr_nav'          =>  ( $uix_slideshow_opt_arr_nav ) ? 'true' : 'false',
    'animloop'         =>  ( $uix_slideshow_opt_animloop ) ? 'true' : 'false',
    'draggable'        =>  ( $uix_slideshow_opt_drag ) ? 'true' : 'false',
    'prev_txt'         =>  str_replace( '"', '\'', $uix_slideshow_opt_prev_txt ),
    'next_txt'         =>  str_replace( '"', '\'', $uix_slideshow_opt_next_txt )
);




?>

<?php if ( $uix_slideshow_query->posts && is_array ( $uix_slideshow_query->posts ) ) {  ?>
            
   <div role="banner" class="uix-slideshow__wrapper">
       <div data-uix-slideshow="1" class="uix-slideshow__outline uix-slideshow uix-slideshow--eff-<?php echo esc_attr( $translation_array[ 'animation' ] ); ?>" 
          data-draggable="<?php echo esc_attr( $translation_array[ 'draggable' ] ); ?>"
          data-draggable-cursor="move"	   
          data-auto="<?php echo esc_attr( $translation_array[ 'auto' ] ); ?>"
          data-loop="<?php echo esc_attr( $translation_array[ 'animloop' ] ); ?>"
          data-speed="<?php echo esc_attr( $translation_array[ 'duration' ] ); ?>"
          data-timing="<?php echo esc_attr( $translation_array[ 'speed' ] ); ?>" 
          data-count-total="false"
          data-count-now="false"
          data-controls-pagination=".my-a-slider-pagination-1" 
          data-controls-arrows=".my-a-slider-arrows-1">
           <div class="uix-slideshow__inner">

           <?php
                // Loop through each item
                foreach( $uix_slideshow_query->posts as $post ) : setup_postdata( $post ); ?>

                    <?php
                    // Get data
                    $caption       = get_post_meta( get_the_ID(), 'uix_slideshow_caption', true );
                    $button_text   = get_post_meta( get_the_ID(), 'uix_slideshow_button_text', true );
	                $button_color  = get_post_meta( get_the_ID(), 'uix_slideshow_bcolor', true );
	                $button_tcolor = get_post_meta( get_the_ID(), 'uix_slideshow_button_textcolor', true );
	                $button_size   = get_post_meta( get_the_ID(), 'uix_slideshow_bsize', true );
                    $url           = get_post_meta( get_the_ID(), 'uix_slideshow_url', true );
                    $url_target    = ( get_post_meta( get_the_ID(), 'uix_slideshow_target', true ) ) ? esc_attr( '_blank' ) : esc_attr( '_self' );
                    $title_color   = ( get_post_meta( get_the_ID(), 'uix_slideshow_title_color', true ) == '' ) ? esc_attr( '#ffffff' ) : esc_attr( get_post_meta( get_the_ID(), 'uix_slideshow_title_color', true ) );
                    $caption_color = ( get_post_meta( get_the_ID(), 'uix_slideshow_caption_color', true ) == '' ) ? esc_attr( '#ffffff' ) : esc_attr( get_post_meta( get_the_ID(), 'uix_slideshow_caption_color', true ) ); 
                
	                //url
	                if ( $url == 'http://' || $url == 'https://' ) $url = '';

					//button
	                if ( empty( $button_color ) )   $button_color = 'transparent';
	                if ( empty( $button_tcolor ) )  $button_tcolor = '#ffffff';
	                if ( empty( $button_size ) )    $button_size = 'small';
	                $button_size_class = 'bsize-m';
					switch ( $button_size ) {
						case 'tiny':
							$button_size_class = 'bsize-s';
							break;
						case 'small':
							$button_size_class = 'bsize-m';
							break;
						case 'medium':
							$button_size_class = 'bsize-l';
							break;
						case 'large':
							$button_size_class = 'bsize-xl';
							break;	
					}


                    ?>

                   <div class="uix-slideshow__item" id="uix-slideshow-<?php echo esc_attr( get_the_ID() ); ?>">
                        <?php
                        // Display post thumbnail
                        $image_src = get_post_meta( get_the_ID(), 'uix_slideshow_img', true );
                        $image_id = attachment_url_to_postid( $image_src );
                                            
                        if ( $image_id ) {
                            $thumb = esc_url( wp_get_attachment_image_url( $image_id, 'uix-slideshow-entry', true ) );
                        }
                        
                        if ( isset( $thumb ) ) {
                            
            
                            //check file type
                            $is_video = false;
                            $file_type = pathinfo( $image_src,PATHINFO_EXTENSION );

                            if( $file_type == 'mp4' || 
                                $file_type == 'avi' || 
                                $file_type == 'wmv' || 
                                $file_type == 'flv' || 
                                $file_type == 'mpg'
                            ) {
                                $is_video = true;
                            } 
                            
                            if ( $is_video ) {
                                echo '<video id="'.esc_attr( $image_id ).'_video" src="'.$image_src.'" autoplay></video>';
                            } else {
                                echo '<img src="'.$thumb.'" alt="">';
                            }
                            
                        } 
                        
                        ?>
                        <div class="uix-slideshow__txt">
                            <div>
                                <?php if ( get_the_title() ) { ?>
                                <h3>
                                    <span class="uix-slideshow-custom-title" data-span-color="<?php echo esc_attr( $title_color ); ?>"><?php the_title(); ?></span>
                                </h3>
                                <?php } ?>
                                <?php if ( !empty( $caption ) ) { ?>
                                <p>									
                                    <span class="uix-slideshow-custom-caption" data-span-color="<?php echo esc_attr( $caption_color ); ?>"><?php echo wp_kses( $caption, wp_kses_allowed_html( 'post' ) ); ?></span>
                                </p>
                                <?php } ?>
                                <?php if ( !empty( $url ) ) { ?>
                                    <a data-tcolor="<?php echo esc_attr( $button_tcolor ); ?>" data-default-border="<?php echo esc_attr( $button_color ); ?>" data-default-bg=""  class="uix-slideshow-custom-button <?php echo esc_attr( $button_size_class ); ?> <?php echo esc_attr( UixSlideshow::color( $button_color ) ); ?>" href="<?php echo esc_url( $url ); ?>" title="<?php the_title_attribute(); ?>" target="<?php echo esc_attr( $url_target ); ?>"><span data-span-color="<?php echo esc_attr( $button_tcolor ); ?>"><?php echo wp_kses( $button_text, wp_kses_allowed_html( 'post' ) ); ?></span></a>
                                <?php } ?>
                            </div>

                        </div>
                   </div>
               

            <?php endforeach; ?> 
               


           </div>
          <!-- /.uix-slideshow__inner -->

        </div>
       <!-- /.uix-slideshow__outline -->
       

       <?php if ( $uix_slideshow_opt_paging_nav ) { ?>
           <div class="uix-slideshow__pagination my-a-slider-pagination-1"></div>
       <?php } ?>
       <?php if ( $uix_slideshow_opt_arr_nav ) { ?>
           <div class="uix-slideshow__arrows my-a-slider-arrows-1">
                <a href="#" class="uix-slideshow__arrows--prev"><?php echo wp_kses( $translation_array[ 'prev_txt' ], wp_kses_allowed_html( 'post' ) ); ?></a>
                <a href="#" class="uix-slideshow__arrows--next"><?php echo wp_kses( $translation_array[ 'next_txt' ], wp_kses_allowed_html( 'post' ) ); ?></a>
           </div>
       <?php } ?>

   </div>
   <!-- /.uix-slideshow__wrapper -->




   



<?php } ?>



<?php
// Reset post data to prevent conflicts with the main query 
wp_reset_postdata();