<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'about' ) {
?>

        <p>
        <?php _e( 'This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme. <strong>Using template file to embed your theme.</strong> <br>Insert slideshow anywhere on your site using a custom post type. Powered by jQuery Flexslider with some transition styles to choose from.', 'uix-slideshow' ); ?>
        </p>  
       

        <p>
            <?php 
				$embed_code = wp_oembed_get('https://www.youtube.com/watch?v=ckjZ570mYiU', array('width'=>560, 'height'=>315 )); 
				echo $embed_code;										 
			  ?>
        
        </p>    
       
       
<?php } ?>
