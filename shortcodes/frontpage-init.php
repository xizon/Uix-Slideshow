<?php

/**
 * Enable the use of shortcodes in ...
 *
 */

add_filter( 'widget_text', 'do_shortcode' ); //text widgets.
add_filter( 'the_excerpt', 'do_shortcode' ); //excerpt.
add_filter( 'comment_text', 'do_shortcode' ); //comment.

//----------------------------------------------------------------------------------------------------
//[shortcode - uix_slideshow]
//----------------------------------------------------------------------------------------------------
	
function uix_slideshow_fun( $atts, $content = null ){
	extract( shortcode_atts( array( 
		  'show' => '-1',
	 ), $atts ) );
	 
	 global $post;
	 global $uix_slider_per;
	 
	$uix_slider_per = $show;
	 
    // capture output from the widgets
	ob_start();
	
	    if( !UixSlideshow::tempfile_exists() ) {
			require_once UIX_SLIDESHOW_PLUGIN_DIR. 'theme_templates/partials-uix_slideshow.php';
		} else {
			require_once get_template_directory() . '/partials-uix_slideshow.php';
		}
		
		$out = ob_get_contents();
	ob_end_clean();
	 
	
   $return_string = $out;
   
   return UixSlideshow::do_callback( $return_string );
}
add_shortcode( 'uix_slideshow_output', 'uix_slideshow_fun' );


