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
 * Version:     1.5.3
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
		add_action( 'admin_init', array( __CLASS__, 'tc_i18n' ) );
		add_action( 'admin_init', array( __CLASS__, 'load_helper' ) );
		add_action( 'admin_init', array( __CLASS__, 'nag_ignore' ) );
		add_action( 'admin_menu', array( __CLASS__, 'options_admin_menu' ) );
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
		
		//Add custom meta boxes API. 
		//Provides a compatible solution for some personalized themes that require Uix Slideshow.
		require_once UIX_SLIDESHOW_PLUGIN_DIR.'includes/admin/uix-custom-metaboxes/init.php';
		require_once UIX_SLIDESHOW_PLUGIN_DIR.'includes/admin/uix-custom-metaboxes/controller-upload.php';
		
		//Custom post type function initialization
		require_once UIX_SLIDESHOW_PLUGIN_DIR.'includes/admin/post-type-init.php';
        
		//Options for custom meta boxes
		require_once UIX_SLIDESHOW_PLUGIN_DIR.'includes/admin/options.php';
		
		//Plugin shortcodes
		require_once UIX_SLIDESHOW_PLUGIN_DIR.'includes/shortcodes.php';

	}
	
	
	
	/*
	 * Enqueue scripts and styles.
	 *
	 *
	 */
	public static function frontpage_scripts() {
	

		if ( self::core_css_file_exists() ) {
			
			//Add shortcodes style to Front-End
			wp_enqueue_style( self::PREFIX . '-slideshow', self::core_css_file(), false, self::ver(), 'all');
			
		}
		
		//Main stylesheets and scripts to Front-End
		wp_enqueue_script( self::PREFIX . '-slideshow', self::core_js_file(), array( 'jquery' ), self::ver() , true );	


		$uix_slideshow_opt_animation       = get_option( 'uix_slideshow_opt_animation', 'slide' );
		$uix_slideshow_opt_auto            = get_option( 'uix_slideshow_opt_auto', true );
        $uix_slideshow_opt_effect_duration = get_option( 'uix_slideshow_opt_effect_duration', 600 );
		$uix_slideshow_opt_speed           = get_option( 'uix_slideshow_opt_speed', 10000 );
		$uix_slideshow_opt_paging_nav      = get_option( 'uix_slideshow_opt_paging_nav', true );
		$uix_slideshow_opt_arr_nav         = get_option( 'uix_slideshow_opt_arr_nav', true );
		$uix_slideshow_opt_animloop        = get_option( 'uix_slideshow_opt_animloop', true );
        $uix_slideshow_opt_drag            = get_option( 'uix_slideshow_opt_drag', false );
		$uix_slideshow_opt_prev_txt        = get_option( 'uix_slideshow_opt_prev_txt', '<span class=\'custom-slideshow-flex-dir custom-slideshow-flex-dir-prev\'></span>' );
		$uix_slideshow_opt_next_txt        = get_option( 'uix_slideshow_opt_next_txt', '<span class=\'custom-slideshow-flex-dir custom-slideshow-flex-dir-next\'></span>' );
	
		
		$translation_array = array(
			'animation'        =>  $uix_slideshow_opt_animation,
			'auto'             =>  ( $uix_slideshow_opt_auto ) ? 'true' : 'false',
            'duration'         =>  $uix_slideshow_opt_effect_duration,
			'speed'            =>  $uix_slideshow_opt_speed,
			'paging_nav'       =>  ( $uix_slideshow_opt_paging_nav ) ? 'true' : 'false',
			'arr_nav'          =>  ( $uix_slideshow_opt_arr_nav ) ? 'true' : 'false',
			'animloop'         =>  ( $uix_slideshow_opt_animloop ) ? 'true' : 'false',
            'draggable'        =>  ( $uix_slideshow_opt_drag ) ? 'true' : 'false',
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
				  
		     wp_enqueue_style( self::PREFIX . '-slideshow-admin', self::plug_directory() .'includes/admin/css/style.min.css', false, self::ver(), 'all' );
			 wp_enqueue_script( self::PREFIX . '-slideshow-admin', self::plug_directory() .'includes/admin/js/core.min.js', array( 'jquery' ), self::ver(), true );	 
			
		  }
		

	}
	
	
	
	/**
	 * Internationalizing  Plugin
	 *
	 */
	public static function tc_i18n() {
	
	
	    load_plugin_textdomain( 'uix-slideshow', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
        
        //move language files to System folder "languages/plugins/yourplugin-<locale>.po"
        global $wp_filesystem;

        if ( empty( $wp_filesystem ) ) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        $filenames = array();
        $filepath = UIX_SLIDESHOW_PLUGIN_DIR.'languages/';
        $systempath = WP_CONTENT_DIR . '/languages/plugins/';

        if ( !$wp_filesystem->is_dir( $systempath ) ) {
            $wp_filesystem->mkdir( $systempath, FS_CHMOD_DIR );
        }//endif is_dir( $systempath ) 
            
        if ( $wp_filesystem->is_dir( $systempath ) ) {
            
            //Only execute one-time scripts
            $transient = self::PREFIX . '-slideshow-lang_files_onetime_check';
            if ( !get_transient( $transient ) ) {

                set_transient( $transient, 'locked', 1800 ); // lock function for 30 Minutes


                foreach(glob(dirname(__FILE__)."/languages/*.po") as $file) {
                    $filenames[] = str_replace(dirname(__FILE__)."/languages/", '', $file);
                }

                foreach(glob(dirname(__FILE__)."/languages/*.mo") as $file) {
                    $filenames[] = str_replace(dirname(__FILE__)."/languages/", '', $file);
                }

                foreach ($filenames as $filename) {

                    // Copy
                    $dir1 = $wp_filesystem->find_folder($filepath);
                    $file1 = trailingslashit($dir1).$filename;

                    $dir2 = $wp_filesystem->find_folder($systempath);
                    $file2 = trailingslashit($dir2).$filename;

                    $filecontent = $wp_filesystem->get_contents($file1);

                    $wp_filesystem->put_contents($file2, $filecontent, FS_CHMOD_FILE);  

                }
                



            }//endif get_transient( $transient )

            
        }//endif is_dir( $systempath )  
        
		

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

//		$hook = add_submenu_page(
//			'edit.php?post_type=uix-slideshow',
//			__( 'Uix Slideshow Settings', 'uix-slideshow' ),
//			__( 'Settings', 'uix-slideshow' ),
//			'manage_options',
//			'uix-slideshow-custom-submenu-page',
//			array( __CLASS__, 'uix_slideshow_options_page' )
//		);
//		
//		add_action("load-{$hook}", function( $caps ) {
//			header( "Location: " . admin_url( "admin.php?page=".self::HELPER."&tab=general-settings" ) );
//			exit;
//        });
		 
		 
	
        //Add sub links
		add_submenu_page(
			'edit.php?post_type=uix-slideshow',
			__( 'Settings', 'uix-slideshow' ),
			__( 'Settings', 'uix-slideshow' ),
			'manage_options',
            'admin.php?page='.self::HELPER.'&tab=general-settings'
		);	     
         
         
		add_submenu_page(
			'edit.php?post_type=uix-slideshow',
			__( 'How to use?', 'uix-slideshow' ),
			__( 'How to use?', 'uix-slideshow' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=usage'
		);	  
		 
		add_submenu_page(
			'edit.php?post_type=uix-slideshow',
			__( 'Template Files', 'uix-slideshow' ),
			__( 'Template Files', 'uix-slideshow' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=temp'
		);	  
		 
		add_submenu_page(
			'edit.php?post_type=uix-slideshow',
			__( 'Custom CSS', 'uix-slideshow' ),
			__( 'Custom CSS', 'uix-slideshow' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=custom-css'
		);

         
		add_submenu_page(
			'edit.php?post_type=uix-slideshow',
			__( 'For Theme Developer', 'uix-slideshow' ),
			__( 'For Theme Developer', 'uix-slideshow' ),
			'manage_options',
			'admin.php?page='.self::HELPER.'&tab=for-developer'
		);
         
	
		add_submenu_page(
			'edit.php?post_type=uix-slideshow',
			__( 'Helper', 'uix-slideshow' ),
			__( 'About', 'uix-slideshow' ),
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

	      if( !file_exists( get_stylesheet_directory() . '/tmpl-uix_slideshow.php' ) ) {
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
	
	public static function templates( $nonceaction, $nonce, $remove = false, $ajax = false ){
	
		  global $wp_filesystem;
			
		  $filenames = array();
		  $filepath  = UIX_SLIDESHOW_PLUGIN_DIR. 'theme_templates/';
		  $themepath = get_stylesheet_directory() . '/';

	      foreach ( glob( dirname(__FILE__). "/theme_templates/*.php") as $file ) {
			$filenames[] = str_replace( dirname(__FILE__). "/theme_templates/", '', $file );
		  }	
		  
		 
			/*
			* To perform the requested action, WordPress needs to access your web server. 
			* Please enter your FTP credentials to proceed. If you do not remember your credentials, 
			* you should contact your web host.
			*
			*/
		   if ( $ajax ) {
				ob_start();

					self::wpfilesystem_read_file( $nonceaction, $nonce, self::get_theme_template_dir_name().'/', 'tmpl-uix_slideshow.php', 'plugin' );
					$out = ob_get_contents();
				ob_end_clean();

				if ( !empty( $out ) ) {
					return 0;
					exit();
				}  
			   
		   }

			/*
			* File batch operation
			*
			*/
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
			
		  } 
		
		
		
			/*
			* Returns the system information.
			*
			*/
			$div_notice_info_before    = '<p class="uix-bg-custom-info-msg"><strong><i class="dashicons dashicons-warning"></i> ';
			$div_notice_success_before = '<p class="uix-bg-custom-success-msg"><strong><i class="dashicons dashicons-yes"></i> ';
			$div_notice_error_before   = '<p class="uix-bg-custom-error-msg"><strong><i class="dashicons dashicons-no"></i> ';
		    $div_notice_after  = '</strong></p>';
			$notice                    = '';    
			$echo_ok_status            = '<span data-ok="1"></span>';

			if ( $ajax ) {
				$div_notice_info_before      = '';   
				$div_notice_success_before   = '';   
				$div_notice_error_before     = '';
				$div_notice_after            = '';
			}

			if ( !$remove ) {
				if ( self::tempfile_exists() ) {
					$info   = $echo_ok_status.__( 'Operation successfully completed!', 'uix-slideshow' );
					$notice = $div_notice_success_before.$info.$div_notice_after;
					echo '<script type="text/javascript">
							   setTimeout( function(){
								   window.location = "'.admin_url( 'admin.php?page='.self::HELPER.'&tab=temp' ).'";
							   }, 1000 );

						  </script>';
					
				} else {
					$info   = __( 'There was a problem copying your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.', 'uix-slideshow' );
					$notice = $div_notice_error_before.$info.$div_notice_after;
				}
				
				

			} else {
				if ( self::tempfile_exists() ) {
					$info   = __( 'There was a problem removing your template files:</strong> Please check your server settings. You can upload files to theme templates directory using FTP.', 'uix-slideshow' );
					$notice = $div_notice_error_before.$info.$div_notice_after;
				} else {
					$info   = $echo_ok_status.__( 'Remove successful!', 'uix-slideshow' );
					$notice = $div_notice_success_before.$info.$div_notice_after;
					echo '<script type="text/javascript">
							   setTimeout( function(){
								   window.location = "'.admin_url( 'admin.php?page='.self::HELPER.'&tab=temp' ).'";
							   }, 1000 );

						  </script>';
				}	

			}
		
		
			return $notice;
		    
		    
			
	}	 



	/**
	 * Initialize the WP_Filesystem
	 * 
	 * Example:
	        
            $output = "";
			
            if ( !empty( $_POST ) && check_admin_referer( 'custom_action_nonce') ) {
				
				
                  $output = UixSlideshow::wpfilesystem_write_file( 'custom_action_nonce', 'admin.php?page='.UixSlideshow::HELPER.'&tab=???', UIX_SLIDESHOW_PLUGIN_DIR.'helper/', 'debug.txt', 'This is test.', 'plugin' );
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
	
	public static function wpfilesystem_write_file( $nonceaction, $nonce, $path, $pathname, $text, $type = 'plugin' ){
		  global $wp_filesystem;
		  
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
		
		  if ( $type == 'plugin' ) {
			  $contentdir = UIX_SLIDESHOW_PLUGIN_DIR.$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_stylesheet_directory() ).$path; 
		  } 
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				$wp_filesystem->put_contents( $file, $text, FS_CHMOD_FILE );
			
				return true;
				
		  } else {
			  return false;
		  }
	}	
	
	 
	public static function wpfilesystem_read_file( $nonceaction, $nonce, $path, $pathname, $type = 'plugin' ){
		  global $wp_filesystem;
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
	
		  if ( $type == 'plugin' ) {
			  $contentdir = UIX_SLIDESHOW_PLUGIN_DIR.$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_stylesheet_directory() ).$path; 
		  } 	  
		
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				
				
				if( $wp_filesystem->exists( $file ) ) {
					
				    return $wp_filesystem->get_contents( $file );
	
				} else {
					return false;
				}
		
		
		  } 
	}	 	
	
	
	public static function wpfilesystem_del_file( $nonceaction, $nonce, $path, $pathname, $type = 'plugin' ){
		  global $wp_filesystem;
		
		  $url = wp_nonce_url( $nonce, $nonceaction );
	
		  if ( $type == 'plugin' ) {
			  $contentdir = UIX_SLIDESHOW_PLUGIN_DIR.$path; 
		  } 
		  if ( $type == 'theme' ) {
			  $contentdir = trailingslashit( get_stylesheet_directory() ).$path; 
		  } 	  
		
		  
		  if ( self::wpfilesystem_connect_fs( $url, '', $contentdir ) ) {
			  
				$dir = $wp_filesystem->find_folder( $contentdir );
				$file = trailingslashit( $dir ) . $pathname;
				
				
				if( $wp_filesystem->exists( $file ) ) {
					
					$wp_filesystem->delete( $file, false, FS_CHMOD_FILE );
					return true;
	
				} else {
					return false;
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

        if ( self::old_version_135() ) {
            //Compatible with versions of this plugin < `1.3.5`
            
            $filePath     = self::plug_filepath() .'assets/css/migrate-1.3.5/uix-slideshow.css';
        } else {
            $filePath     = self::plug_filepath() .'assets/css/uix-slideshow.css';
        }
        
        if ( self::theme_core_css_file_exists() || file_exists( $filePath ) ) {
            return true;
        } else {
            return false;
        }	   
        
	}
	
	
	/**
	 * Determine whether the css core file exists in your theme
	 *
	 */
	public static function theme_core_css_file_exists() {
		  $FilePath      = get_stylesheet_directory() . '/uix-slideshow-custom.css';
	      $FilePath2     = get_stylesheet_directory() . '/assets/css/uix-slideshow-custom.css';
		  if ( file_exists( $FilePath ) || file_exists( $FilePath2 ) ) {
			  return true;
		  } else {
			  return false;
		  }	
	}
	
	/**
	 * Determine whether the javascript core file exists in your theme
	 *
	 */
	public static function theme_core_js_file_exists() {
		  $FilePath      = get_stylesheet_directory() . '/uix-slideshow-custom.js';
	      $FilePath2     = get_stylesheet_directory() . '/assets/js/uix-slideshow-custom.js';
		  if ( file_exists( $FilePath ) || file_exists( $FilePath2 ) ) {
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
		
        if ( self::old_version_135() ) {
            //Compatible with versions of this plugin < `1.3.5`
            
            $validPath    = self::plug_directory() .'assets/css/migrate-1.3.5/uix-slideshow.css';
        } else {
            $validPath    = self::plug_directory() .'assets/css/uix-slideshow.css';
        } 
        
        
		$newFilePath  = get_stylesheet_directory() . '/uix-slideshow-custom.css';
		$newFilePath2 = get_stylesheet_directory() . '/assets/css/uix-slideshow-custom.css';
	
		if ( file_exists( $newFilePath ) ) {
			$validPath = get_stylesheet_directory_uri() . '/uix-slideshow-custom.css';
		}
		
	
		if ( file_exists( $newFilePath2 ) ) {
			$validPath = get_stylesheet_directory_uri() . '/assets/css/uix-slideshow-custom.css';
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
		
		
        
        if ( self::old_version_135() ) {
            //Compatible with versions of this plugin < `1.3.5`
            
            $validPath    = self::plug_directory() .'assets/js/migrate-1.3.5/uix-slideshow.js';
            
        } else {
            
            $validPath    = self::plug_directory() .'assets/js/uix-slideshow.js';
            
        } 
        
        
		$newFilePath  = get_stylesheet_directory() . '/uix-slideshow-custom.js';
		$newFilePath2 = get_stylesheet_directory() . '/assets/js/uix-slideshow-custom.js';
	
		if ( file_exists( $newFilePath ) ) {
			$validPath = get_stylesheet_directory_uri() . '/uix-slideshow-custom.js';
		}
		
	
		if ( file_exists( $newFilePath2 ) ) {
			$validPath = get_stylesheet_directory_uri() . '/assets/js/uix-slideshow-custom.js';
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
    
	
	/**
	 * Compatible with versions of this plugin < `1.3.5`
	 *
	 */
	public static function old_version_135() {
		
		if ( file_exists( get_stylesheet_directory() . '/partials-uix_slideshow.php' ) ) {
            return true;
        } else {
            return false;
        }

	}
     
    
    
    


}

add_action( 'plugins_loaded', array( 'UixSlideshow', 'init' ) );

