<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// variables for the field and option names 
$hidden_field_name = 'submit_hidden_uix_slideshow_temp';

	
// If they did, this hidden field will be set to 'Y'
if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'temp' &&
    ( ( isset( $_GET[ 'tempfiles' ] ) && $_GET[ 'tempfiles' ] == 'ok' ) || ( isset( $_GET[ '_wpnonce' ] ) && !empty( $_GET[ '_wpnonce' ] ) ) ) 
  ) {

	// Only if administrator
	if( current_user_can( 'administrator' ) ) {
		
		$status_echo = "";
		
		if( UixSlideshow::tempfile_exists() ) {
			// Template files removed
			$status_echo = UixSlideshow::templates( 'uix_slideshow_tempfiles', 'admin.php?page='.UixSlideshow::HELPER.'&tab=temp', true );
			echo $status_echo;
	
		} else {
			// Template files copied
			$status_echo = UixSlideshow::templates( 'uix_slideshow_tempfiles', 'admin.php?page='.UixSlideshow::HELPER.'&tab=temp' );
			echo $status_echo;
		
		}
	
	}
	
 }


if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'temp' ) { ?>

	<?php if ( !isset( $_GET[ 'tempfiles' ] ) && !isset( $_GET[ '_wpnonce' ] ) ) { ?>
   
		<?php if( UixSlideshow::tempfile_exists() ) { ?>

			 <h3><?php _e( 'Uix Slideshow template files already exists. Remove Uix Slideshow template files in your templates directory:', 'uix-slideshow' ); ?></h3>
			 <p>
			   <?php _e( 'As a workaround you can use FTP, access path <code>/wp-content/themes/{your-theme}/</code> and remove Uix Slideshow template files.', 'uix-slideshow' ); ?>
			 </p>   

			 <div class="uix-plug-note">
				<h4><?php _e( 'Template files list:', 'uix-slideshow' ); ?></h4>
				<?php UixSlideshow::list_templates_name( 'theme' ); ?>
			 </div>
			<p>
				<a class="button button-remove" href="<?php echo esc_url( 'admin.php?page='.UixSlideshow::HELPER.'&tab=temp&tempfiles=ok' ); ?>" onClick="return confirm('<?php echo esc_attr__( 'Are you sure?\nIt is possible based on your theme of the plugin templates. When you create them again, the default plugin template will be used.', 'uix-slideshow' ); ?>');"><?php echo esc_html__( 'Remove Uix Slideshow Template Files', 'uix-slideshow' ); ?></a>
			</p>


		<?php } else { ?>

			 <h3><?php _e( 'Copy Uix Slideshow template files in your templates directory:', 'uix-slideshow' ); ?></h3>
			 <p>
			   <?php _e( 'As a workaround you can use FTP, access the Uix Slideshow template files path <code>/wp-content/plugins/uix-slideshow/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-slideshow' ); ?>

			 </p>   

			 <p>
			 <strong><?php _e( 'Hi, there! It’s just a custom template file in the theme folder. Of course you doesn’t need to create it, you can use of the default page template or your own custom template file directly.', 'uix-slideshow' ); ?></strong>

			</p> 

			 <div class="uix-plug-note">
				<h4><?php _e( 'Template files list:', 'uix-slideshow' ); ?></h4>
				<?php UixSlideshow::list_templates_name( 'plug' ); ?>
			 </div>


			<p>
				<a class="button button-primary" href="<?php echo esc_url( 'admin.php?page='.UixSlideshow::HELPER.'&tab=temp&tempfiles=ok' ); ?>"><?php echo esc_html__( 'Click This Button to Copy Uix Slideshow Files', 'uix-slideshow' ); ?></a>
			</p> 



		<?php } ?>

	
	<?php } ?>
 
	
    
<?php } ?>