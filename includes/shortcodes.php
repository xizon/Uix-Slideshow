<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *  Enable the Uix Slideshow Shortcode
 *
 */
if ( !class_exists( 'UixSlideshow_Shortcode' ) ) {
	class UixSlideshow_Shortcode {
	
	
		public static function init() {
			
			//Enable short code on the front page
			add_action( 'wp_head', array( __CLASS__, 'do_my_shortcodes' ) );
			
			//When switching the page template
			add_action( 'admin_init', array( __CLASS__, 'do_my_shortcodes' ) ); 
			
			//Search content for shortcodes and filter shortcodes through their hooks.
			add_filter( 'widget_text', 'do_shortcode' );
			add_filter( 'the_excerpt', 'do_shortcode' );
			add_filter( 'comment_text', 'do_shortcode' );
		
			//Add an operation entry in the admin panel
			add_filter( 'mce_buttons', array( __CLASS__, 'register_buttons' ) );
			add_filter( 'mce_external_plugins', array( __CLASS__, 'add_buttons' ) );

			//To internationalize a TinyMCE button/plugin within a WordPress plugin
			add_filter( 'mce_external_languages', array( __CLASS__, 'custom_tinymce_plugin_add_locale' ) );
		
		}
	
		
		/*
		 * Register shortcodes of front-end
		 *
		 *
		 */
		public static function do_my_shortcodes() {
			add_shortcode( 'uix_slideshow_output', array( __CLASS__, 'func' ) );
			
		}
	
		/**
		 * Shortcode
		 *
		 */
		public static function func( $atts, $content = null ) {
			extract( shortcode_atts( array( 
				 
			 ), $atts ) );

			 global $post;

			// capture output from the widgets
			ob_start();

				if( !UixSlideshow::tempfile_exists() ) {
					require_once UIX_SLIDESHOW_PLUGIN_DIR. 'theme_templates/tmpl-uix_slideshow.php';
				} else {
					require_once get_stylesheet_directory() . '/tmpl-uix_slideshow.php';
				}

				$out = ob_get_contents();
			ob_end_clean();


		   $return_string = UixSlideshow::do_callback( $out );
			
			//Themes can filter this by using the "uix_slideshow_shortcode_filter" filter.
		    return apply_filters( 'uix_slideshow_shortcode_filter', $return_string );
	
		}
		
		
		/*
		 * To add buttons to the editor
		 *
		 *
		 */
		public static function register_buttons( $buttons ) {
			array_push( $buttons, 'uix_slideshow_btn' ); 
			return $buttons;
		}

		public static function add_buttons( $plugin_array ) {
			$plugin_array['uix_slideshow'] = UixSlideshow::plug_directory() .'includes/tinymce/tinymce-plugin.js';
			return $plugin_array;
		}



		/**
		 * To internationalize a TinyMCE button/plugin within a WordPress plugin
		 * @link: https://codex.wordpress.org/Plugin_API/Filter_Reference/mce_external_languages
		 *
		 */

		public static function custom_tinymce_plugin_add_locale( $locales ) {
			$locales [ 'uix_slideshow_custom_tinymce_plugin' ] = plugin_dir_path ( __FILE__ ) . 'tinymce/tinymce-plugin-lang.php';
			return $locales;
		}

		
	}
		
	
}


UixSlideshow_Shortcode::init();

