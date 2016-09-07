<?php
/**
 * The template for displaying Uix Slideshow.
 *
 *
 * Note: The function will be used to .php file of theme when get_header() exist. The code could also be sought for header.php file.
 * The .php file of theme contains the following standard code:

   get_template_part( 'partials', 'uix_slideshow' ); 
  
 *
 */
 
if ( ! class_exists( 'UixSlideshow' ) ) { 
    return;
}

// Important: This variable with this plugin's customizer linking
global $slideshow_prefix;
$slideshow_prefix = 'custom-slideshow';

// Query
$uix_slideshow_query = new WP_Query(
	array(
		'post_type'      => 'uix-slideshow',
		'posts_per_page' => -1, //lists all of the posts.
		'no_found_rows'  => true
	)
);

?>

<?php if ( $uix_slideshow_query->posts && is_array ( $uix_slideshow_query->posts ) ) {  ?>
            
    <div class="custom-slideshow-flexslider primary custom-slideshow-flexslider-loading">
        <div class="custom-slideshow-slides">
   
            <?php
                // Loop through each item
                foreach( $uix_slideshow_query->posts as $post ) : setup_postdata( $post ); ?>

                    <?php
                    // Get data
                    $caption       = get_post_meta( get_the_ID(), 'uix_slideshow_caption', true );
                    $button_text   = get_post_meta( get_the_ID(), 'uix_slideshow_button_text', true );
                    $url           = get_post_meta( get_the_ID(), 'uix_slideshow_url', true );
                    $url_target    = get_post_meta( get_the_ID(), 'uix_slideshow_target', true );
                    $title_color   = ( get_post_meta( get_the_ID(), 'uix_slideshow_title_color', true ) == '' ) ? esc_attr( '#ffffff' ) : esc_attr( get_post_meta( get_the_ID(), 'uix_slideshow_title_color', true ) );
                    $caption_color = ( get_post_meta( get_the_ID(), 'uix_slideshow_caption_color', true ) == '' ) ? esc_attr( '#ffffff' ) : esc_attr( get_post_meta( get_the_ID(), 'uix_slideshow_caption_color', true ) ); 
                

                    ?>

                    <div class="item" id="uix-slideshow-<?php echo esc_attr( get_the_ID() ); ?>">
                    
                        <?php
                        // Display post thumbnail
                        $image_src = get_post_meta( get_the_ID(), 'uix_slideshow_img', true );
                        $image_id = attachment_url_to_postid( $image_src );
                                            
                        if ( $image_id ) {
                            $thumb = esc_url( wp_get_attachment_image_url( $image_id, 'uix-slideshow-entry', true ) );
                        }
                        
                        if ( isset( $thumb ) ) {
                            echo '<img src="'.$thumb.'" alt="">';
                        } 
                        
                        ?>
                        
                        <div class="slides-info">
                        
                            <div class="text-container">
                                    <?php if ( get_the_title() ) { ?>
                                    <h2 class="level level-1"><span class="uix-slideshow-custom-title" style="color:<?php echo esc_attr( $title_color ); ?>"><?php the_title(); ?></span></h2>
                                    <?php } ?>
                                    
                                    <?php if ( $caption ) { ?>
                                    <p class="caption level level-2">									
                                        <span class="uix-slideshowhow-custom-caption" style="color:<?php echo esc_attr( $caption_color ); ?>"><?php echo wp_kses( $caption, wp_kses_allowed_html( 'post' ) ); ?></span>
                                    </p>
                                    <?php } ?>
                                    
                                    <?php if ( $url ) { ?>
                                        <a class="link-button level level-3" href="<?php echo esc_url( $url ); ?>" title="<?php the_title_attribute(); ?>" target="<?php echo esc_attr( $url_target ); ?>"><?php echo wp_kses( $button_text, wp_kses_allowed_html( 'post' ) ); ?></a>
                                    <?php } ?>
                                
                            </div>
    
    
                        </div>
                        <!-- .slides-info  end -->   
                        
                    </div>


            <?php endforeach; ?>


        </div>
        <!-- .custom-slideshow-slides end -->
    </div>
    <!-- .custom-slideshow-flexslider end -->

<?php } ?>



<?php
// Reset post data to prevent conflicts with the main query 
wp_reset_postdata();