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
	

?>

    <form method="post" action="">
    
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
        <?php wp_nonce_field( 'uix_slideshow_customcss' ); ?>
        
        <h4><?php _e( 'You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original <code>.css</code> files.', 'uix-slideshow' ); ?></h4>
            
        <table class="form-table">
          <tr>
            <th scope="row">
              <?php _e( 'Paste your CSS code', 'uix-slideshow' ); ?>
            </th>
            <td>
              <textarea name="uix_slideshow_opt_cssnewcode" class="regular-text" rows="25" style="width:98%;"><?php echo esc_textarea( get_option( 'uix_slideshow_opt_cssnewcode' ) ); ?></textarea>
            </td>
          </tr>
        </table> 
        
          
<?php


	$newFilePath                 = get_stylesheet_directory() . '/uix-slideshow-custom.css';
	$newFilePath2                = get_stylesheet_directory() . '/assets/css/uix-slideshow-custom.css';
	$org_cssname_uix_slideshow   = UixSlideshow::core_css_file( 'name' );
	$org_csspath_uix_slideshow   = UixSlideshow::core_css_file();

	if ( file_exists( $newFilePath ) || file_exists( $newFilePath2 ) ) {
		$filetype = 'theme';
		
		//CSS file directory
		$filepath = '';
		
		if ( file_exists( $newFilePath2 ) ) {
			$filepath = 'assets/css/';
		}
		
	} else {
		$filetype = 'plugin';
		$filepath = 'assets/css/';
	}
	

	// capture output from WP_Filesystem
	ob_start();
	
		UixSlideshow::wpfilesystem_read_file( 'uix_slideshow_customcss', 'admin.php?page='.UixSlideshow::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_slideshow, $filetype );
		$filesystem_uix_slideshow_out = ob_get_contents();
	ob_end_clean();
	
	if ( empty( $filesystem_uix_slideshow_out ) ) {
		
		$style_org_code_uix_slideshow = UixSlideshow::wpfilesystem_read_file( 'uix_slideshow_customcss', 'admin.php?page='.UixSlideshow::HELPER.'&tab=custom-css', $filepath, $org_cssname_uix_slideshow, $filetype );
		
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
						
						$( "#uix_slideshow_view_css" ).click( function() {
							dialog_uix_slideshow.show();
						});
						$( "#uix_slideshow_close_css" ).click( function() {
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