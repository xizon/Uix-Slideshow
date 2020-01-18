<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( !isset( $_GET[ 'tab' ] ) || $_GET[ 'tab' ] == 'about' ) {
?>

        <p>
        <?php _e( 'This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme. <strong>Using template file to embed your theme.</strong> <br>Insert slideshow anywhere on your site using a custom post type.', 'uix-slideshow' ); ?>
        </p>  
       

       
       
<?php } ?>
