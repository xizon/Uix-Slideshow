<?php
/*
 * Enqueuing Scripts and Styles
 * 
 */
function uix_slideshow_scripts() {

	//Check if screen ID
	$currentScreen = get_current_screen();

	if ( UixSlideshow::inc_str( $currentScreen->base, '_page_' ) &&
		 ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == UixSlideshow::HELPER )	
	 ) 
	{
	    wp_enqueue_style( UixSlideshow::PREFIX . '-helper', UixSlideshow::plug_directory() .'helper/helper.css', true, UixSlideshow::ver(), 'all' );
		wp_enqueue_script( UixSlideshow::PREFIX . '-helper', UixSlideshow::plug_directory() .'helper/helper.js', array( 'jquery' ), UixSlideshow::ver(), true );	

	} 
	
	
}
add_action( 'admin_enqueue_scripts', 'uix_slideshow_scripts' );


/*
 * Add an operator panel in admin panel
 * 
 */
function uix_slideshow_options_page(){
	
    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.', 'uix-slideshow') );
    }

  
?>

<div class="wrap uix-bg-custom-wrapper">
    
    <h2><?php _e( 'Uix Slideshow Helper', 'uix-slideshow' ); ?></h2>
    <?php
	
	if( !isset( $_GET[ 'tab' ] ) ) {
		$active_tab = 'about';
	}
	
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	} 
	
	$tabs = array();
	$tabs[] = array(
	    'tab'     =>  'about', 
		'title'   =>  __( 'About', 'uix-slideshow' )
	);
	$tabs[] = array(
	    'tab'     =>  'usage', 
		'title'   =>  __( 'How to use?', 'uix-slideshow' )
	);
	
	$tabs[] = array(
	    'tab'     =>  'credits', 
		'title'   =>  __( 'Credits', 'uix-slideshow' )
	);
	
	$tabs[] = array(
	    'tab'     =>  'temp', 
		'title'   =>  __( 'Template Files', 'uix-slideshow' )
	);
	
	$tabs[] = array(
	    'tab'     =>  'general-settings', 
		'title'   =>  __( '<i class="dashicons dashicons-admin-generic"></i> General Settings', 'uix-slideshow' )
	);
	
	if ( UixSlideshow::core_css_file_exists() ) {
		$tabs[] = array(
			'tab'     =>  'custom-css', 
			'title'   =>  __( '<i class="dashicons dashicons-welcome-view-site"></i> Custom CSS', 'uix-slideshow' )
		);
	}
	
	$tabs[] = array(
		'tab'     =>  'for-developer', 
		'title'   =>  __( '<i class="dashicons dashicons-networking"></i> For Theme Developer', 'uix-slideshow' )
	);		
    
	
	?>
    <h2 class="nav-tab-wrapper">
        <?php foreach ( $tabs as $key ) :  ?>
            <?php $url = 'admin.php?page=' . rawurlencode( UixSlideshow::HELPER ) . '&tab=' . rawurlencode( $key[ 'tab' ] ); ?>
            <a href="<?php echo esc_attr( is_network_admin() ? network_admin_url( $url ) : admin_url( $url ) ) ?>"
               class="nav-tab<?php echo $active_tab === $key[ 'tab' ] ? esc_attr( ' nav-tab-active' ) : '' ?>">
                <?php echo $key[ 'title' ] ?>
            </a>
        <?php endforeach ?>
    </h2>

    <?php 
		foreach ( glob( UIX_SLIDESHOW_PLUGIN_DIR. "helper/tabs/*.php") as $file ) {
			include $file;
		}	
	?>
        
    
    
</div>
 
    <?php
     
}