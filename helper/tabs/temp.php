<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'temp' ) {
	
	
	$wpnonce_url = 'edit.php?post_type='.UixSlideshow::get_slug().'&page='.UixSlideshow::HELPER;
	$wpnonce_action = 'temp-filesystem-nonce';
	
?>     

     <?php if( UixSlideshow::tempfile_exists() ) { ?>
	 
         <h3><?php _e( 'Uix Slideshow template files already exists. Remove Uix Slideshow template files in your templates directory:', 'uix-slideshow' ); ?></h3>
         <p>
           <?php _e( 'As a workaround you can use FTP, access path <code>/wp-content/themes/{your-theme}/</code> and remove Uix Slideshow template files.', 'uix-slideshow' ); ?>
   
        </p>   
         
        <div class="uix-plug-note">
            <h4><?php _e( 'Template files list:', 'uix-slideshow' ); ?></h4>
            <?php UixSlideshow::list_templates_name( 'theme' ); ?>
        </div>
         
         
         <form method="post">
          <?php
		  
            $output = "";

            if ( !empty( $_POST ) ) {
				
				
                  $output = UixSlideshow::templates( $wpnonce_action, $wpnonce_url, true );
				  echo $output;
				  
			
            } else {
				
				wp_nonce_field( $wpnonce_action );
				echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-remove" value="'.__( 'Remove Uix Slideshow Template Files', 'uix-slideshow' ).'"  /></p>';
				
			}

          ?>
         </form>
        
    <?php } else {  ?>

         <h3><?php _e( 'Copy Uix Slideshow template files in your templates directory:', 'uix-slideshow' ); ?></h3>
         <p>
           <?php _e( 'As a workaround you can use FTP, access the Uix Slideshow template files path <code>/wp-content/plugins/uix-slideshow/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-slideshow' ); ?>
   
        </p>   
      
        <div class="uix-plug-note">
            <h4><?php _e( 'Template files list:', 'uix-slideshow' ); ?></h4>
            <?php UixSlideshow::list_templates_name( 'plug' ); ?>
        </div>
         
         <form method="post">
          <?php
		  
            $output = "";

            if ( !empty( $_POST ) ) {
				
				
                  $output = UixSlideshow::templates( $wpnonce_action, $wpnonce_url );
				  echo $output;
				  
			
            } else {
				
				wp_nonce_field( $wpnonce_action );
				echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Click This Button to Copy Uix Slideshow Files', 'uix-slideshow' ).'"  /></p>';
				
			}

          ?>
         </form>
         
         
    <?php } ?>
    
<?php } ?>