<?php

function uix_slideshow_options_page(){
	
    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.', 'uix-slideshow') );
    }

  
?>


<style type="text/css">
.uix-bg-custom-wrapper img {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 5px;
    -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.uix-field-custom-style img {
    vertical-align: middle;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
}

.uix-field-custom-style label {
    padding-right: 1.5em;
}

.uix-field-custom-style .sp-con {
    position: relative;
    width: 137px;
    display: inline-block;
}

.uix-field-custom-style .sp-con .title {
    position: absolute;
    bottom: 0;
    display: block;
    background: rgba(0,0,0,.7);
    left: 0;
    text-align: center;
    font-size: 12px;
    width: 100%;
    padding: .2em 0;
    color: #fff;
}

.uix-bg-custom-wrapper a {
    text-decoration: none;
}

.uix-bg-custom-wrapper code {
    border: 1px solid #B1B1B1;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    margin-bottom: 5px;
    display: inline-block;
    padding: 0;
    margin: 0;
}

.uix-bg-custom-title {
    font-size: 1.1em;
    font-weight: bold;
}

.uix-bg-custom-title strong,
.uix-bg-custom-desc strong {
    color: #D16E15;
}

.uix-bg-custom-desc-note {
	filter: alpha(opacity=50);  
	-moz-opacity: 0.5;   
	opacity: 0.5; 

}	

.uix-bg-custom-desc a {
	color: #D16E15;
	border-bottom: 1px solid #D16E15;
}
	
.uix-bg-custom-desc a:hover {
	border-color: transparent;
}
	
	
.uix-bg-custom-blockquote {
    background: #EBEBEB;
    border: 1px solid #F8F8F8;
    border-left: 7px solid #BEBEBE;
    padding: 0 2em 1.421875em;
    margin: 1.625em;
    font-style: italic;
    line-height: 2;
    quotes: "\201C""\201D""\2018""\2019";
    font-size: 1.14285714286em;
    color: #939393;
}

</style>

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