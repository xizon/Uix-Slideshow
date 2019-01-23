<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'credits' ) {
?>


        <h3>
           <?php _e( 'I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:', 'uix-slideshow' ); ?>
        </h3>  
        <p>
        
        <ul>
            <li><a href="https://github.com/woothemes/FlexSlider" target="_blank" rel="nofollow">Flexslider</a></li>

        </ul>
        
        </p> 
        
    
<?php } ?>