<?php
/**
 * Uix Slideshow
 *
 * @author UIUX Lab <uiuxlab@gmail.com>
 *
 *
 * Plugin name: Uix Slideshow
 * Plugin URI:  https://uiux.cc/wp-plugins/uix-slideshow/
 * Description: This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme.  
 * Version:     1.2.1
 * Author:      UIUX Lab
 * Author URI:  https://uiux.cc
 * License:     GPLv2 or later
 * Text Domain: uix-slideshow
 * Domain Path: /languages
 */

class UixSlideshow {
	
	const PREFIX = 'uix';
	const HELPER = 'uix-slideshow-helper';
	const NOTICEID = 'uix-slideshow-helper-tip';

	
	/**
	 * Initialize
	 *
	 */
	public static function init() {
	
		self::setup_constants();
		self::includes();
	
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'actions_links' ), -10 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'backstage_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'frontpage_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'print_custom_stylesheet' ) );
		add_action( 'current_screen', array( __CLASS__, 'usage_notice' ) );
		add_action( 'current_screen', array( __CLASS__, 'do_register_shortcodes' ) );
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_init', array( __CLASS__, 'nag_ignore' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
		add_action( 'wp_head', array( __CLASS__, 'do_my_shortcodes' ) );
		add_action( 'after_setup_theme', array( __CLASS__, 'image_sizes' ) );
		

	}
	

	/**
	 * Setup plugin constants.
	 *
	 */
	public static  function setup_constants() {

		// Plugin Folder Path.
		if ( ! defined( 'UIX_SLIDESHOW_PLUGIN_DIR' ) ) {
			define( 'UIX_SLIDESHOW_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'UIX_SLIDESHOW_PLUGIN_URL' ) ) {
			define( 'UIX_SLIDESHOW_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
		}

		// Plugin Root File.
		if ( ! defined( 'UIX_SLIDESHOW_PLUGIN_FILE' ) ) {
			define( 'UIX_SLIDESHOW_PLUGIN_FILE', trailingslashit( __FILE__ ) );
		}
	}
	
	/*
	 * Include required files.
	 *
	 *
	 */
	public static function includes() {
		
		require_once UIX_SLIDESHOW_PLUGIN_DIR.'admin/custom-metaboxes/class-custom-metaboxes-init.php';
		require_once UIX_SLIDESHOW_PLUGIN_DIR.'admin/custom-metaboxes/class-custom-metaboxes-cmpt-uploadController.php';
		require_once UIX_SLIDESHOW_PLUGIN_DIR.'admin/options.php';

	}
	
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
	
		// Add flexslider
		wp_enqueue_script( 'flexslider', self::plug_directory() .'assets/js/jquery.flexslider.min.js', array( 'jquery' ), '2.6.2', true );	
		wp_enqueue_style( 'flexslider', self::plug_directory() .'assets/css/flexslider.css', false, '2.6.2', 'all' );
		
		// Easing
		wp_enqueue_script( 'jquery-easing', self::plug_directory() .'assets/js/jquery.easing.js', array( 'jquery' ), '1.3', false );	
	

		if ( self::core_css_file_exists() ) {
			
			//Add shortcodes style to Front-End
			wp_enqueue_style( self::PREFIX . '-slideshow', self::core_css_file(), false, self::ver(), 'all');
			
		}
		
		//Main stylesheets and scripts to Front-End
		wp_enqueue_script( self::PREFIX . '-slideshow', self::core_js_file(), array( 'jquery' ), self::ver() , true );	


		$uix_slideshow_opt_animation       = get_option( 'uix_slideshow_opt_animation', 'slide' );
		$uix_slideshow_opt_auto            = get_option( 'uix_slideshow_opt_auto', true );
		$uix_slideshow_opt_speed           = get_option( 'uix_slideshow_opt_speed', 10000 );
		$uix_slideshow_opt_effect_duration = get_option( 'uix_slideshow_opt_effect_duration', 600 );
		$uix_slideshow_opt_smoothheight    = get_option( 'uix_slideshow_opt_smoothheight', true );
		$uix_slideshow_opt_paging_nav      = get_option( 'uix_slideshow_opt_paging_nav', true );
		$uix_slideshow_opt_arr_nav         = get_option( 'uix_slideshow_opt_arr_nav', true );
		$uix_slideshow_opt_animloop        = get_option( 'uix_slideshow_opt_animloop', true );
		$uix_slideshow_opt_prev_txt        = get_option( 'uix_slideshow_opt_prev_txt', '<span class=\'custom-slideshow-flex-dir custom-slideshow-flex-dir-prev\'></span>' );
		$uix_slideshow_opt_next_txt        = get_option( 'uix_slideshow_opt_next_txt', '<span class=\'custom-slideshow-flex-dir custom-slideshow-flex-dir-next\'></span>' );
	
		
		$translation_array = array(
			'animation'        =>  $uix_slideshow_opt_animation,
			'auto'             =>  ( $uix_slideshow_opt_auto ) ? 'true' : 'false',
			'speed'            =>  $uix_slideshow_opt_speed,
			'effect_duration'  =>  $uix_slideshow_opt_effect_duration,
			'smoothheight'     =>  ( $uix_slideshow_opt_smoothheight ) ? 'true' : 'false',
			'paging_nav'       =>  ( $uix_slideshow_opt_paging_nav ) ? 'true' : 'false',
			'arr_nav'          =>  ( $uix_slideshow_opt_arr_nav ) ? 'true' : 'false',
			'animloop'         =>  ( $uix_slideshow_opt_animloop ) ? 'true' : 'false',
			'prev_txt'         =>  str_replace( '"', '\'', $uix_slideshow_opt_prev_txt ),
			'next_txt'         =>  str_replace( '"', '\'', $uix_slideshow_opt_next_txt )
		);


		wp_localize_script( self::PREFIX . '-slideshow', 'uix_slideshow_vars', $translation_array );	

	}
	
	

	
	/*
	 * Enqueue scripts and styles  in the backstage
	 *
	 *
	 */
	public static function backstage_scripts() {
	
		 //Check if screen’s ID, base, post type, and taxonomy, among other data points
		 $currentScreen = get_current_screen();
	
		 if ( 
			 self::inc_str( $currentScreen->id, 'uix_slideshow' ) || 
			 self::inc_str( $currentScreen->id, 'uix-slideshow' ) || 
			 self::inc_str( $currentScreen->base, '_page_' )
		 ) 
		 {
				  
		     wp_enqueue_style( self::PREFIX . '-slideshow-admin', self::plug_directory() .'admin/css/style.min.css', false, self::ver(), 'all' );
			 wp_enqueue_script( self::PREFIX . '-slideshow-admin', self::plug_directory() .'admin/js/core.min.js', array( 'jquery' ), self::ver(), true );	 
			
		  }
		

	}
	
	
	
	/**
	 * Internationalizing  Plugin
	 *
	 */
	public static function tc_i18n() {
	
	
	    load_plugin_textdomain( 'uix-slideshow', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
		

	}
	
	/*
	 * The function finds the position of the first occurrence of a string inside another string.
	 *
	 * As strpos may return either FALSE (substring absent) or 0 (substring at start of string), strict versus loose equivalency operators must be used very carefully.
	 *
	 */
	public static function inc_str( $str, $incstr ) {
		
		$incstr = str_replace( '(', '\(',
				  str_replace( ')', '\)',
				  str_replace( '|', '\|',
				  str_replace( '*', '\*',
				  str_replace( '+', '\+',
			      str_replace( '.', '\.',
				  str_replace( '[', '\[',
				  str_replace( ']', '\]',
				  str_replace( '?', '\?',
				  str_replace( '/', '\/',
				  str_replace( '^', '\^',
			      str_replace( '{', '\{',
				  str_replace( '}', '\}',	
				  str_replace( '$', '\$',
			      str_replace( '\\', '\\\\',
				  $incstr 
				  )))))))))))))));
			
		if ( !empty( $incstr ) ) {
			if ( preg_match( '/'.$incstr.'/', $str ) ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}


	}

	
	
	/*
	 * Create customizable menu in backstage  panel
	 *
	 * Add a submenu page
	 *
	 */
	 public static function options_admin_menu() {
	
	    //settings
		$hook = add_submenu_page(
			'edit.php?post_type=uix-slideshow',
			__( 'Uix Slideshow Settings', 'uix-slideshow' ),
			__( 'Settings', 'uix-slideshow' ),
			'manage_options',
			'uix-slideshow-custom-submenu-page',
			array( __CLASS__, 'uix_slideshow_options_page' )
		);
		
		add_action("load-{$hook}", create_function('','
			header( "Location: ' . admin_url( "admin.php?page=".self::HELPER."&tab=general-settings" ) . '" );
			exit;
		'));
	
	
        //Add sub links
		add_submenu_page(
			'edit.php?post_type=uix-slideshow',
			__( 'Custom CSS', 'uix-slideshow' ),
			__( 'Custom CSS', 'uix-slideshow' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=custom-css'
		);

		add_submenu_page(
			'edit.php?post_type=uix-slideshow',
			__( 'Helper', 'uix-slideshow' ),
			__( 'Helper', 'uix-slideshow' ),
			'manage_options',
			self::HELPER,
			'uix_slideshow_options_page' 
		);
	 }
	 
	public static function uix_slideshow_options_page(){
		
	}
	
	
	
	/*
	 * Load helper
	 *
	 */
	 public static function load_helper() {
		 
		 require_once UIX_SLIDESHOW_PLUGIN_DIR.'helper/settings.php';
	 }
	
	
	
	/*
	 * Adds image sizes for slideshow items
	 *
	 * @link	http://codex.wordpress.org/Function_Reference/add_image_size
	 *
	 */
	public static function image_sizes() {
	
		add_image_size( 'uix-slideshow-entry', get_theme_mod( 'custom_uix_slideshow_single_size_w', 1920 ), get_theme_mod( 'custom_uix_slideshow_single_size_h', 9999 ), false );

	}
	
	
	/**
	 * Add plugin actions links
	 */
	public static function actions_links( $links ) {
		$links[] = '<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=general-settings" ) . '">' . __( 'Settings', 'uix-slideshow' ) . '</a>';
		$links[] = '<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=usage" ) . '">' . __( 'How to use?', 'uix-slideshow' ) . '</a>';
		return $links;
	}
	
	
	/*
	 * Register shortcodes
	 *
	 *
	 */
	public static function do_register_shortcodes() {
	
		  //Check if screen’s ID, base, post type, and taxonomy, among other data points
		  $currentScreen = get_current_screen();
	
		  if( $currentScreen->base === "post" || self::inc_str( $currentScreen->base, '_page_' ) ) {
			
				require_once UIX_SLIDESHOW_PLUGIN_DIR.'shortcodes/backstage-init.php';
		
		  } 
	

	}
	
	/*
	 * Register shortcodes of front-end
	 *
	 *
	 */
	public static function do_my_shortcodes() {
	
		  require_once UIX_SLIDESHOW_PLUGIN_DIR.'shortcodes/frontpage-init.php';
	
	}
	

	
	
	/*
	 * Get plugin slug
	 *
	 *
	 */
	public static function get_slug() {

         return dirname( plugin_basename( __FILE__ ) );
	
	}

	
	/*
	 *  Add admin one-time notifications
	 *
	 *
	 */
	public static function usage_notice() {
		
		
		  //Check if screen’s ID, base, post type, and taxonomy, among other data points
		  $currentScreen = get_current_screen();

		  if ( 
			  ( self::inc_str( $currentScreen->id, 'uix_slideshow' ) || self::inc_str( $currentScreen->id, 'uix-slideshow' ) ) && 
			  !self::inc_str( $currentScreen->id, '_page_' ) 
		  ) 
		  {
			  add_action( 'admin_notices', array( __CLASS__, 'usage_notice_app' ) );
			  add_action( 'admin_notices', array( __CLASS__, 'template_notice_required' ) );
		  }
		
	
	}	
	
	public static function usage_notice_app() {
		
		global $current_user ;
		$user_id = $current_user->ID;
		
		/* Check that the user hasn't already clicked to ignore the message */
		if ( ! get_user_meta( $user_id, self::NOTICEID ) ) {
			echo '<div class="updated"><p>
				'.__( 'Do you want to create a slideshow website with WordPress?  Learn how to add slideshow to your themes.', 'uix-slideshow' ).'
				<a href="' . admin_url( "admin.php?page=".self::HELPER."&tab=usage" ) . '">' . __( 'How to use?', 'uix-slideshow' ) . '</a>
				 | 
			';
			printf( __( '<a href="%1$s">Hide Notice</a>' ), '?post_type='.self::get_slug().'&'.self::NOTICEID.'=0');
			
			echo "</p></div>";
		}
	
	}	
	
	public static function template_notice_required() {
		
		if( !self::tempfile_exists() ) {
			echo '
				<div class="notice notice-warning">
					<p>' . __( '<strong>You could create Uix Slideshow template files in your templates directory. You can create the files on the WordPress admin panel.</strong>', 'uix-slideshow' ) . ' <a class="button button-primary" href="' . admin_url( "admin.php?page=".self::HELPER."&tab=temp" ) . '">' . __( 'Create now!', 'uix-slideshow' ) . '</a><br>' . __( 'As a workaround you can use FTP, access the Uix Slideshow template files path <code>/wp-content/plugins/uix-slideshow/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-slideshow' ) . '</p>
				</div>
			';
	
		}
	
	}	
	
	
	public static function nag_ignore() {
		    global $current_user;
			$user_id = $current_user->ID;
			
			/* If user clicks to ignore the notice, add that to their user meta */
			if ( isset( $_GET[ self::NOTICEID ]) && '0' == $_GET[ self::NOTICEID ] ) {
				 add_user_meta( $user_id, self::NOTICEID, 'true', true);

				if ( wp_get_referer() ) {
					/* Redirects user to where they were before */
					wp_safe_redirect( wp_get_referer() );
				} else {
					/* This will never happen, I can almost gurantee it, but we should still have it just in case*/
					wp_safe_redirect( home_url() );
				}
		    }
	}
	
	/*
	 * Checks whether a template file or directory exists
	 *
	 *
	 */
	public static function tempfile_exists() {

	      if( !file_exists( get_stylesheet_directory() . '/partials-uix_slideshow.php' ) ) {
			  return false;
		  } else {
			  return true;
		  }

	}
	
	
	/*
	 * Callback the plugin directory URL
	 *
	 *
	 */
	public static function plug_directory() {

	  return UIX_SLIDESHOW_PLUGIN_URL;

	}
	
	/*
	 * Callback the plugin directory
	 *
	 *
	 */
	public static function plug_filepath() {

	  return UIX_SLIDESHOW_PLUGIN_DIR;

	}
	
	
	
	/*
	 * Returns template files directory
	 *
	 *
	 */
	public static function list_templates_name( $show = 'plug' ){
	
		
		$filenames = array();
		$filepath = UIX_SLIDESHOW_PLUGIN_DIR. 'theme_templates/';
		$themepath = get_stylesheet_directory() . '/';
		
		foreach ( glob( dirname(__FILE__). "/theme_templates/*") as $file ) {
		    $filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		}	
		
		echo '<ul>';
		
		foreach ( $filenames as $filename ) {
			$file1 = trailingslashit( $filepath ) . $filename;
			
			$file2 = trailingslashit( $themepath ) . $filename;	
			
			if ( $show == 'plug' ) {
				echo '<li>'.trailingslashit( $filepath ) . $filename.'</li>';
			} else {
				echo '<li>'.trailingslashit( $themepath ) . $filename.' &nbsp;&nbsp;'.sprintf( __( '<a target="_blank" href="%1$s"><i class="dashicons dashicons-welcome-write-blog"></i> Edit this template</a>', 'uix-slideshow' ), admin_url( 'theme-editor.php?file='.$filename ) ).'</li>';
			}
			
		}	
		
		echo '</ul>';
			
	}	 

	
	
	/*
	 * Copy/Remove template files to your theme directory
	 *
	 *
	 */
	
	public static function templates( $nonceaction, $nonce, $remove = false ){
	
		  global $wp_filesystem;
			
		  $filenames = array();
		  $filepath = UIX_SLIDESHOW_PLUGIN_DIR. 'theme_templates/';
		  $themepath = get_stylesheet_directory() . '/';

	      foreach ( glob( dirname(__FILE__). "/theme_templates/*") as $file ) {
			$filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		  }	
		  

		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  $contentdir = $filepath; 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir, '' ) ) {
	
				foreach ( $filenames as $filename ) {
					
				    // Copy
					if ( ! file_exists( $themepath . $filename ) ) {
						
						$dir1 = $wp_filesystem->find_folder( $filepath );
						$file1 = trailingslashit( $dir1 ) . $filename;
						
						$dir2 = $wp_filesystem->find_folder( $themepath );
						$file2 = trailingslashit( $dir2 ) . $filename;
									
						$filecontent = $wp_filesystem->get_contents( $file1 );
	
						$wp_filesystem->put_contents( $file2, $filecontent, FS_CHMOD_FILE );
						
			
					} 
					
					// Remove
					if ( $remove ) {
						if ( file_exists( $themepath . $filename ) ) {
							
							$dir = $wp_filesystem->find_folder( $themepath );
							$file = trailingslashit( $dir ) . $filename;
							
							$wp_filesystem->delete( $file, false, FS_CHMOD_FILE );
							
				
						} 
						
	
					}
				}
				
				if ( !$remove ) {
					if ( self::tempfile_exists() ) {
						return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-slideshow' );
					} else {
						return __( '<div class="notice notice-error"><p><strong>There was a problem copying your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.</p></div>', 'uix-slideshow' );
					}
	
				} else {
					if ( self::tempfile_exists() ) {
						return __( '<div class="notice notice-error"><p><strong>There was a problem removing your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.</p></div>', 'uix-slideshow' );
						
					} else {
						return __( '<div class="notice notice-success"><p>Remove successful!</p></div>', 'uix-slideshow' );
					}	
					
				}
				
		
				
				
		  } 
	}	 



	/**
	 * Initialize the WP_Filesystem
	 * 
	 * Example:
	 
            $output = "";
			
            if ( !empty( $_POST ) && check_admin_referer( 'custom_action_nonce') ) {
				
				
                  $output = UixSlideshow::wpfilesystem_write_file( 'custom_action_nonce', 'admin.php?page='.UixSlideshow::HELPER.'&tab=???', 'helper/', 'debug.txt', 'This is test.' );
				  echo $output;
			
            } else {
				
				wp_nonce_field( 'custom_action_nonce' );
				echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Click This Button to Copy Files', 'uix-slideshow' ).'"  /></p>';
				
			}
			
		
	 *
	 */
	public static function wpfilesystem_connect_fs( $url, $method, $context, $fields = null) {
		  global $wp_filesystem;
		  if ( false === ( $credentials = request_filesystem_credentials( $url, $method, false, $context, $fields) ) ) {
			return false;
		  }
		
		  //check if credentials are correct or not.
		  if( !WP_Filesystem( $credentials ) ) {
			request_filesystem_credentials( $url, $method, true, $context);
			return false;
		  }
		
		  return true;
	}
	
	public static function wpfilesystem_write_file( $nonceaction, $nonce, $path, $pathname, $text ){
		  global $wp_filesystem;
		  
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  $contentdir = UIX_SLIDESHOW_PLUGIN_DIR.$path; 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir, '' ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				$wp_filesystem->put_contents( $file, $text, FS_CHMOD_FILE );
			
				return __( '<div class="notice notice-success"><p>Operation successfully completed!</p></div>', 'uix-slideshow' );
				
		  } 
	}	
	
	 
	public static function wpfilesystem_read_file( $nonceaction, $nonce, $path, $pathname, $type = 'plugin' ){
		  global $wp_filesystem;
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
	
		  if ( $type == 'plugin' ) {
			  $contentdir = UIX_SLIDESHOW_PLUGIN_DIR.$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_template_directory() ).$path; 
		  } 	  
		
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				
				
				if( $wp_filesystem->exists( $file ) ) {
					
				    return $wp_filesystem->get_contents( $file );
	
				} else {
					return '';
				}
		
		
		  } 
	}	 
	
	
	

	/*
	 * Returns current plugin version.
	 *
	 *
	 */
	public static function ver() {
	
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_folder = get_plugins( '/' . self::get_slug() );
		$plugin_file = basename( ( __FILE__ ) );
		return $plugin_folder[$plugin_file]['Version'];


	}
	



	/*
	 * Print Custom Stylesheet
	 *
	 *
	 */
	public static function print_custom_stylesheet( $uix_slideshow_frontend_css = null ) {
	
		$custom_css = get_option( 'uix_slideshow_opt_cssnewcode' );
		
		if ( !empty( $uix_slideshow_frontend_css ) ) {
			$custom_css = $custom_css.$uix_slideshow_frontend_css;
		}
		wp_add_inline_style( self::PREFIX . '-slideshow', $custom_css );
		
		return $uix_slideshow_frontend_css;

	}
		
		
		
	
	/*
	 * Callback function of "do shortcodes"
	 *
	 *
	 */
	public static function do_callback( $str ) {

	  return do_shortcode( $str );
	  

	}

	
	/**
	 * Determine whether the css core file exists
	 *
	 */
	public static function core_css_file_exists() {
		  $FilePath      = get_stylesheet_directory() . '/uix-slideshow-custom.css';
	      $FilePath2     = get_stylesheet_directory() . '/assets/css/uix-slideshow-custom.css';
		  $FilePath3     = self::plug_filepath() .'assets/css/uix-slideshow.css';
		  if ( file_exists( $FilePath ) || file_exists( $FilePath2 ) || file_exists( $FilePath3 ) ) {
			  return true;
		  } else {
			  return false;
		  }	
	}
	
	/**
	 * Returns .css file name of custom script 
	 *
	 */
	public static function core_css_file( $type = 'uri' ) {
		
		$validPath    = self::plug_directory() .'assets/css/uix-slideshow.css';
		$newFilePath  = get_stylesheet_directory() . '/uix-slideshow-custom.css';
		$newFilePath2 = get_stylesheet_directory() . '/assets/css/uix-slideshow-custom.css';
	
		if ( file_exists( $newFilePath ) ) {
			$validPath = get_template_directory_uri() . '/uix-slideshow-custom.css';
		}
		
	
		if ( file_exists( $newFilePath2 ) ) {
			$validPath = get_template_directory_uri() . '/assets/css/uix-slideshow-custom.css';
		}
		
		if ( $type == 'name' ) {
			if ( file_exists( $newFilePath ) || file_exists( $newFilePath2 ) ) {
				$validPath = 'uix-slideshow-custom.css';
			} else {
				$validPath = 'uix-slideshow.css';
			}
		}
		
		
		return $validPath;
		
	}
		
	/**
	 * Returns .js file name of custom script 
	 *
	 */
	public static function core_js_file( $type = 'uri' ) {
		
		$validPath    = self::plug_directory() .'assets/js/uix-slideshow.js';
		$newFilePath  = get_stylesheet_directory() . '/uix-slideshow-custom.js';
		$newFilePath2 = get_stylesheet_directory() . '/assets/js/uix-slideshow-custom.js';
	
		if ( file_exists( $newFilePath ) ) {
			$validPath = get_template_directory_uri() . '/uix-slideshow-custom.js';
		}
		
	
		if ( file_exists( $newFilePath2 ) ) {
			$validPath = get_template_directory_uri() . '/assets/js/uix-slideshow-custom.js';
		}
		
		if ( $type == 'name' ) {
			if ( file_exists( $newFilePath ) || file_exists( $newFilePath2 ) ) {
				$validPath = 'uix-slideshow-custom.js';
			} else {
				$validPath = 'uix-slideshow.js';
			}
		}
		
		
		return $validPath;
		
	}
	
	
	/**
	 * Returns class name of color conversion
	 * @string Likes: color-333333
	 *
	 */
	public static function color( $str ) {
		
		return str_replace( '#', 'color-', $str );
		
	}
	
	/**
	 * Filters content and keeps only allowable HTML elements.
	 *
	 */
	public static function kses( $html ){
		
		return wp_kses( $html, wp_kses_allowed_html( 'post' ) );

	}


}

add_action( 'plugins_loaded', array( 'UixSlideshow', 'init' ) );

