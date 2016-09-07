<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_slideshow_generalsettings';

	
	
// If they did, this hidden field will be set to 'Y'
if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	
	// Save the posted value in the database
	update_option( 'uix_slideshow_opt_animation', $_POST[ 'uix_slideshow_opt_animation' ] );
	update_option( 'uix_slideshow_opt_auto', $_POST[ 'uix_slideshow_opt_auto' ] );
	update_option( 'uix_slideshow_opt_effect_duration', $_POST[ 'uix_slideshow_opt_effect_duration' ] );
	update_option( 'uix_slideshow_opt_speed', $_POST[ 'uix_slideshow_opt_speed' ] );
	update_option( 'uix_slideshow_opt_arr_nav', $_POST[ 'uix_slideshow_opt_arr_nav' ] );
	update_option( 'uix_slideshow_opt_paging_nav', $_POST[ 'uix_slideshow_opt_paging_nav' ] );
	update_option( 'uix_slideshow_opt_animloop', $_POST[ 'uix_slideshow_opt_animloop' ] );
	update_option( 'uix_slideshow_opt_smoothheight', $_POST[ 'uix_slideshow_opt_smoothheight' ] );
	update_option( 'uix_slideshow_opt_prev_txt', wp_unslash( $_POST[ 'uix_slideshow_opt_prev_txt' ] ) );
	update_option( 'uix_slideshow_opt_next_txt', wp_unslash( $_POST[ 'uix_slideshow_opt_next_txt' ] ) );

	// Put a "settings saved" message on the screen
	echo '<div class="updated"><p><strong>'.__('Settings saved.', 'uix-slideshow' ).'</strong></p></div>';

 }  


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'general-settings' ) {
	

?>

    <form name="form1" method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
  
        <table class="form-table">
        
          <tr>
            <th scope="row">
              <?php _e( 'Effect', 'uix-slideshow' ); ?>
            </th>
            
            <td>
                <p>
                    <label>
                        <input name="uix_slideshow_opt_animation" type="radio" value="slide" class="tog" <?php echo ( get_option( 'uix_slideshow_opt_animation' ) == 'slide' || !get_option( 'uix_slideshow_opt_animation' ) ) ? 'checked' : ''; ?> />
                        <?php _e( 'Slide', 'uix-slideshow' ); ?>
                    </label>
                </p>
                
                <p>
                    <label>
                        <input name="uix_slideshow_opt_animation" type="radio" value="fade" class="tog" <?php echo ( get_option( 'uix_slideshow_opt_animation' ) == 'fade' ) ? 'checked' : ''; ?> />
                        <?php _e( 'Fade', 'uix-slideshow' ); ?>
                    </label>
                </p>    
            </td>
      
          </tr>
            
            
            
          <tr>
            <th scope="row">
              <?php _e( 'Speed of Images Appereance', 'uix-slideshow' ); ?>
            </th>
             <td>
                <p>
                    <label>
                        <input name="uix_slideshow_opt_effect_duration" type="number" step="100" min="0" value="<?php echo esc_attr( get_option( 'uix_slideshow_opt_effect_duration', 600 ) ); ?>" class="small-text" /> <?php _e( 'ms', 'uix-slideshow' ); ?>
                    </label>
                </p>
               
            </td>         
            
          </tr>   
          
           <tr>
            <th scope="row">
              <?php _e( 'Delay Between Images', 'uix-slideshow' ); ?>
            </th>
             <td>
                <p>
                    <label>
                        <input name="uix_slideshow_opt_speed" type="number" step="100" min="0" value="<?php echo esc_attr( get_option( 'uix_slideshow_opt_speed', 10000 ) ); ?>" class="small-text" /> <?php _e( 'ms', 'uix-slideshow' ); ?>
                    </label>
                </p>
               
            </td>         
            
          </tr>  
           
           
          <tr>
            <th scope="row">
              <?php _e( 'Previous Button Text', 'uix-slideshow' ); ?>
            </th>
             <td>
                <p>
                    <textarea name="uix_slideshow_opt_prev_txt" class="regular-text" rows="1" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_slideshow_opt_prev_txt', '<span class="custom-slideshow-flex-dir custom-slideshow-flex-dir-prev"></span>' ) ); ?></textarea>
                </p>
               
            </td>         
            
          </tr>     
           
          <tr>
            <th scope="row">
              <?php _e( 'Next Button Text', 'uix-slideshow' ); ?>
            </th>
             <td>
                <p>
                    <textarea name="uix_slideshow_opt_next_txt" class="regular-text" rows="1" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_slideshow_opt_next_txt', '<span class="custom-slideshow-flex-dir custom-slideshow-flex-dir-next"></span>' ) ); ?></textarea>
                </p>
               
            </td>         
            
          </tr>        
         
          <tr>
            <th scope="row">
              <?php _e( 'Automatically Transition', 'uix-slideshow' ); ?>
            </th>
             <td>
                <p>
                    <label>
                    <input name="uix_slideshow_opt_auto" type="checkbox" value="1" <?php checked( '1', get_option( 'uix_slideshow_opt_auto', 1 ) ); ?> />
                    <?php _e( 'Setup a slideshow for the slider to animate automatically.', 'uix-slideshow' ); ?>
                    </label>
                </p>
            </td>         
            
          </tr>
          
          
          <tr>
            <th scope="row">
              <?php _e( 'Show Arrow Navigation', 'uix-slideshow' ); ?>
            </th>
             <td>
                <p>
                    <label>
                    <input name="uix_slideshow_opt_arr_nav" type="checkbox" value="1" <?php checked( '1', get_option('uix_slideshow_opt_arr_nav') ); ?> />
                    <?php _e( 'Create previous/next arrow navigation.', 'uix-slideshow' ); ?>
                    </label>
                </p>
            </td>         
            
          </tr> 
          
          
          <tr>
            <th scope="row">
              <?php _e( 'Show Paging Navigation', 'uix-slideshow' ); ?>
            </th>
             <td>
                <p>
                    <label>
                    <input name="uix_slideshow_opt_paging_nav" type="checkbox" value="1" <?php checked( '1', get_option( 'uix_slideshow_opt_paging_nav', 1 ) ); ?> />
                    <?php _e( 'Create navigation for paging control of each slide.', 'uix-slideshow' ); ?>
                    </label>
                </p>
                
            </td>         
            
          </tr>    
          
          
          <tr>
            <th scope="row">
              <?php _e( 'Animation Loop', 'uix-slideshow' ); ?>
            </th>
             <td>
                <p>
                    <label>
                    <input name="uix_slideshow_opt_animloop" type="checkbox" value="1" <?php checked( '1', get_option( 'uix_slideshow_opt_animloop' , 1 ) ); ?> />
                    <?php _e( 'Gives the slider a seamless infinite loop.', 'uix-slideshow' ); ?>
                    </label>
                </p>
                
            </td>         
            
          </tr>      
          
          <tr>
            <th scope="row">
              <?php _e( 'Smooth Height', 'uix-slideshow' ); ?>
            </th>
             <td>
                <p>
                    <label>
                    <input name="uix_slideshow_opt_smoothheight" type="checkbox" value="1" <?php checked( '1', get_option( 'uix_slideshow_opt_smoothheight' , 1 ) ); ?> />
                    <?php _e( 'Animate the height of the slider smoothly for slides of varying height.', 'uix-slideshow' ); ?>
                    </label>
                </p>
            </td>         
            
          </tr>      
                  
           
          
        </table> 
        

        <?php submit_button(); ?>

    
    </form>


    
<?php } ?>