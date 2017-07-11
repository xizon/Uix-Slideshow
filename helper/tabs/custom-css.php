<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_slideshow_customcss';

	
// If they did, this hidden field will be set to 'Y'
if ( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
	
	// Just security thingy that wordpress offers us
	check_admin_referer( 'uix_slideshow_customcss' );
	
	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$uix_slideshow_opt_cssnewcode = wp_unslash( $_POST[ 'uix_slideshow_opt_cssnewcode' ] );
	
		// Save the posted value in the database
		update_option( 'uix_slideshow_opt_cssnewcode', $uix_slideshow_opt_cssnewcode );
	
	
		// Put a "settings saved" message on the screen
		echo '<div class="updated"><p><strong>'.__('Settings saved.', 'uix-slideshow' ).'</strong></p></div>';
		
	}

 }  


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'custom-css' ) {
	
	$newFilePath                 = get_stylesheet_directory() . '/uix-slideshow-custom.css';
	$newFilePath2                = get_stylesheet_directory() . '/assets/css/uix-slideshow-custom.css';
	$newJSFilePath               = get_stylesheet_directory() . '/uix-slideshow-custom.js';
	$newJSFilePath2              = get_stylesheet_directory() . '/assets/js/uix-slideshow-custom.js';
	$org_cssname_uix_slideshow   = UixSlideshow::core_css_file( 'name' );
	$org_csspath_uix_slideshow   = UixSlideshow::core_css_file();
	$org_jsname_uix_slideshow    = UixSlideshow::core_js_file( 'name' );
	$org_jspath_uix_slideshow    = UixSlideshow::core_js_file();

	//CSS file directory
	if ( file_exists( $newFilePath ) || file_exists( $newFilePath2 ) ) {
		$cssfiletype = 'theme';
		
		$filepath = '';
		if ( file_exists( $newFilePath2 ) ) {
			$filepath = 'assets/css/';
		}

		
	} else {
		$cssfiletype   = 'plugin';
		$filepath   = 'assets/css/';	
	}
	
	
	//Javascript file directory
	if ( file_exists( $newJSFilePath ) || file_exists( $newJSFilePath2 ) ) {
		$JSfiletype = 'theme';
		
		$jsfilepath = '';
		if ( file_exists( $newJSFilePath2 ) ) {
			$jsfilepath = 'assets/js/';
		}	
			
	} else {
		$JSfiletype   = 'plugin';
		$jsfilepath = 'assets/js/';
	}
	
		
?>

    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_slideshow_customcss' ); ?>
        
    
		<p class="uix-bg-custom-desc">
		   <?php _e( '1) Making a new Cascading Style Sheet (CSS) document which name to <strong>uix-slideshow-custom.css</strong> to your templates directory ( <code>/wp-content/themes/{your-theme}/</code> or <code>/wp-content/themes/{your-theme}/assets/css/</code> ). You can connect to your site via an FTP client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Slideshow will use it as a default style sheet instead of the "<a href="'.$org_csspath_uix_slideshow.'" target="_blank"><strong>uix-slideshow.css</strong></a>" to your WordPress Theme. Of course, Uix Slideshow\'s function of "Custom CSS" is still valid.', 'uix-slideshow' ); ?>

		</p>    
		<p class="uix-bg-custom-desc">
		   <?php _e( '2) Making a new javascrpt (.js) document which name to <strong>uix-slideshow-custom.js</strong> to your templates directory ( <code>/wp-content/themes/{your-theme}/</code> or <code>/wp-content/themes/{your-theme}/assets/js/</code> ). Once you have created an existing JS file, Uix Slideshow will use it as a default script instead of the "<a href="'.$org_jspath_uix_slideshow.'" target="_blank"><strong>uix-slideshow.js</strong></a>" to your WordPress Theme.', 'uix-slideshow' ); ?>

		</p>    
            
        <table class="form-table">
          <tr>
            <th scope="row">
              <?php _e( 'Paste your CSS code', 'uix-slideshow' ); ?>
              <hr>
              <p class="uix-bg-custom-desc-note"><?php _e( 'You could add new styles code to your website, without modifying original .css files.', 'uix-slideshow' ); ?></p>
            </th>
            <td>
              <textarea name="uix_slideshow_opt_cssnewcode" class="regular-text" rows="25" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_slideshow_opt_cssnewcode' ) ); ?></textarea>
            </td>
          </tr>
        </table> 
        
          
<?php

	// capture output from WP_Filesystem
	ob_start();
	
		UixSlideshow::wpfilesystem_read_file( 'uix_slideshow_customcss', 'admin.php?page='.UixSlideshow::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_slideshow, $cssfiletype );
		$filesystem_uix_slideshow_out = ob_get_contents();
	ob_end_clean();
	
	if ( empty( $filesystem_uix_slideshow_out ) ) {
		
		$style_org_code_uix_slideshow = UixSlideshow::wpfilesystem_read_file( 'uix_slideshow_customcss', 'admin.php?page='.UixSlideshow::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_slideshow, $cssfiletype );
		
		echo '
		
		         <p>'.__( 'CSS file root directory:', 'uix-slideshow' ).' 
				     <a href="javascript:" id="uix_slideshow_view_css" >'.$org_csspath_uix_slideshow.'</a>
					 <div class="uix-slideshow-dialog-mask"></div>
					 <div class="uix-slideshow-dialog" id="uix-slideshow-view-css-container">  
						<textarea rows="15" style=" width:95%;" class="regular-text">'.$style_org_code_uix_slideshow.'</textarea>
						<a href="javascript:" id="uix_slideshow_close_css" class="close button button-primary">'.__( 'Close', 'uix-slideshow' ).'</a>  
					</div>
				 </p><hr />
				<script type="text/javascript">
					
				( function($) {
					
					"use strict";
					
					$( function() {
						
						var dialog_uix_slideshow = $( "#uix-slideshow-view-css-container, .uix-slideshow-dialog-mask" );  
						
						
						$( "#uix_slideshow_view_css" ).on( "click", function( e ) {
						    e.preventDefault();
							dialog_uix_slideshow.show();
						});
						$( "#uix_slideshow_close_css" ).on( "click", function( e ) {
						    e.preventDefault();
							dialog_uix_slideshow.hide();
						});
			
					} );
					
				} ) ( jQuery );
				
				</script>
		
		';	

	} else {
		
		echo '
		         <p>'.__( 'CSS file root directory:', 'uix-slideshow' ).' 
				     <a href="'.$org_csspath_uix_slideshow.'" target="_blank">'.$org_csspath_uix_slideshow.'</a>
				 </p><hr />

		';	
		
		
	}
?>
        
        
        <?php submit_button(); ?>

    
    </form>


    
<?php } ?>