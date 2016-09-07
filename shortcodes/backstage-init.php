<?php
/**
 * Add shortcodes
 *
 * Search content for shortcodes and filter shortcodes through their hooks.
 */



/**
 * To add buttons to the editor
 *
 */
function uix_slideshow_register_buttons( $buttons ) {
    array_push( $buttons, 'uix_slideshow_btn' ); 
    return $buttons;
}
add_filter( 'mce_buttons', 'uix_slideshow_register_buttons' );


function uix_slideshow_add_buttons( $plugin_array ) {
    $plugin_array['uix_slideshow'] = UixSlideshow::plug_directory() .'shortcodes/core/tinymce-plugin.js';
    return $plugin_array;
}
add_filter( "mce_external_plugins", "uix_slideshow_add_buttons" );


/**
 * To internationalize a TinyMCE button/plugin within a WordPress plugin
 * @link: https://codex.wordpress.org/Plugin_API/Filter_Reference/mce_external_languages
 *
 */
 
function uix_slideshow_custom_tinymce_plugin_add_locale( $locales ) {
    $locales [ 'uix_slideshow_custom_tinymce_plugin' ] = plugin_dir_path ( __FILE__ ) . 'core/tinymce-plugin-lang.php';
    return $locales;
}
add_filter( 'mce_external_languages', 'uix_slideshow_custom_tinymce_plugin_add_locale' );



