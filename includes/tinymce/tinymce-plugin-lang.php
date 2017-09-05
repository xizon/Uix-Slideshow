<?php
// This file is based on wp-includes/js/tinymce/langs/wp-langs.php

if ( ! defined( 'ABSPATH' ) )
    exit;

if ( ! class_exists( '_WP_Editors' ) )
    require( ABSPATH . WPINC . '/class-wp-editor.php' );

function uix_slideshow_custom_tinymce_plugin_translation() {
    $strings = array(
        'lang_1' => __( 'Uix Slideshow', 'uix_slideshow' ),
		'lang_2' => __( 'Insert Uix Slideshow', 'uix_slideshow' ),

		
    );
    $locale = _WP_Editors::$mce_locale;
    $translated = 'tinyMCE.addI18n("' . $locale . '.uix_slideshow_custom_tinymce_plugin", ' . json_encode( $strings ) . ");".PHP_EOL;

     return $translated;
}

$strings = uix_slideshow_custom_tinymce_plugin_translation();