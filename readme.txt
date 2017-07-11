=== Uix Slideshow ===
Contributors: uiuxlab
Donate link: https://uiux.cc
Author URI: https://uiux.cc
Plugin URL: https://uiux.cc/wp-plugins/uix-slideshow/
Tags: slideshow, slider, post type, slides, carousel
Requires at least: 4.2
Tested up to: 4.8
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme. 

== Description ==


This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme. **Using template file to embed your theme.**

Insert slideshow anywhere on your site using a custom post type. Powered by jQuery Flexslider with some transition styles to choose from.


https://www.youtube.com/watch?v=ckjZ570mYiU


= Adding Uix Slideshow to Web Pages =

There are two different ways you can add the Uix Slideshow widget to your site's pages:

(1) Shortcode - Embed a shortcode into the editor of any post, page, or custom post type. 
  

  Use `[uix_slideshow_output show="-1"]` to add it to your Post, Widgets or Page content. Now this shortcode has one attributes. Uix Slideshow show at most can be customized using the "show" parameter. Show all items if value is '-1'.


  Go to your WordPress admin panel, edit or create a new post (or page). You’ll see a Uix Slideshow button in the toolbar.

(2) Template tags - Add a simple PHP function to one of your theme's template files. 

  Place `<?php get_template_part( 'partials', 'uix_slideshow' ); ?>` in your templates.
  
  
  
= Custom Usage =

You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original .css files. Go to "Uix Slideshow" in the WordPress Administration Screens, then link to a specific tab like "Custom CSS".

> There is a second way, make a new Cascading Style Sheet (CSS) document which name to <strong>"uix-slideshow-custom.css"</strong> to your templates directory ( "/wp-content/themes/{your-theme}/" or "/wp-content/themes/{your-theme}/assets/css/" ). You can connect to your site via an FTP client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Slideshow will use it as a default style sheet to your WordPress Theme. Of course, Uix Slideshow's function of "Custom CSS" is still valid.

> Note: Making a new javascrpt (.js) document which name to <strong>"uix-slideshow-custom.js"</strong> to your templates directory ( "/wp-content/themes/{your-theme}/" or "/wp-content/themes/{your-theme}/assets/js/" ). Once you have created an existing JS file, Uix Slideshow will use it as a default script to your WordPress Theme.

  
  

== Installation ==

1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to "Appearance -> Install Plugins".
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

2. You need to create Uix Slideshow template files in your templates directory. You can create the files on the WordPress admin panel. As a workaround you can use FTP, access the Uix Slideshow template files path (/wp-content/plugins/uix-slideshow/theme_templates/) and upload files to your theme templates directory (/wp-content/themes/{your-theme}/).  

   Please check if you have the 1 template file 'partials-uix_slideshow.php' in your templates directory. If you can't find these files, then just copy them from the directory '/wp-content/plugins/uix-slideshow/theme_templates/' to your templates directory.

3. Create uix slideshow item and publish slideshow then.

4. You can pretty much custom every aspect of the look and feel of this page by modifying the "*.php" template files (Access the path to the themes directory) . Best Practices for Editing WordPress Template Files:

  (1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to "Appearance > Editor" from your sidebar.

  (2) You can connect to your site via an FTP client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.
  
  
5. Adding Uix Slideshow to Web Pages.



= There are two different ways you can add the Uix Slideshow widget to your site's pages: =

  (1) Shortcode - Embed a shortcode into the editor of any post, page, or custom post type. 
      
     Use `[uix_slideshow_output show="-1"]` to add it to your Post, Widgets or Page content. Now this shortcode has one attributes. Uix Slideshow show at most can be customized using the "show" parameter. Show all items if value is '-1'.


      
      Go to your WordPress admin panel, edit or create a new post (or page). You’ll see a Uix Slideshow button in the toolbar.
  
  (2) Template tags - Add a simple PHP function to one of your theme's template files. 
  
      Place `<?php get_template_part( 'partials', 'uix_slideshow' ); ?>` in your templates.
 
6. The Uix Slideshow plugin allows users to easily customize to themes. Go to "Uix Slideshow -> Settings -> General Settings". 

7. You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original ".css" files. Go to "Uix Slideshow -> Settings -> Custom CSS".


== Frequently Asked Questions ==

= What's with the version numbers? =

The version number is the date of the revision of the [guidelines](https://make.wordpress.org/themes/handbook/review/) used to create it.


== Screenshots ==
1. screenshot-1.jpg
2. screenshot-2.jpg
3. screenshot-3.jpg
4. screenshot-4.jpg


== Upgrade Notice ==


* Bug fixes and improvements.


== Changelog ==


= 1.2.1 (July 11, 2017) =

* Remove the "CMB" classes and files.
* Using "Uix_Slideshow_Uix_Custom_Metaboxes" class instead of "CMB" class. (More fast, simple and compatible).
* Remove the "CMB" classes and files.
* Rebuild part of the background file directory.


= 1.1.25 (July 7, 2017) =

* Optimized core scripts(uix-slideshow.js) for front-end.
* Optimized Uix Slideshow template.


= 1.1.2 (May 22, 2017) =

* Optimized core stylesheets for front-end.
* Optimized admin panel of Custom CSS.


= 1.1.1 (April 8, 2017) =

* Compatible with low version PHP (5.3+)
* Fixed some minor errors in the low version of PHP.


= 1.1.0 (March 25, 2017) =

* Fixed bug that the slider button was invalid and some of the options were invalid.



= 1.0.9 (March 12, 2017) =

* Add button settings, you could set up your button color and size.
* Optimized core stylesheets for front-end.


= 1.0.8 (March 4, 2017) =

* Add dynamic form fields, meet the needs of custom fields.
* Enhanced API compatibility for themes.


= 1.0.7 (March 1, 2017) =

* Optimized binding theme picker.


= 1.0.6 (January 5, 2017) =

* Fixed a bug that caused the slides to not be displayed.



= 1.0.5 (January 3, 2017) =

* WordPress 4.7 compatible.
* Enhanced scalability structure.
* Enhanced the user experience of templates admin panel.
* Supports custom Uix Slideshow core stylesheet and script based on "/wp-content/themes/{your-theme}/" and "/wp-content/themes/{your-theme}/" directories  for your theme.
* Supports custom Uix Slideshow core stylesheet and script based on "/wp-content/themes/{your-theme}/assets/css/" and "/wp-content/themes/{your-theme}/assets/js/" directories  for your theme.



= 1.0.1 (December 22, 2016) =

* Optimized for tablet display.
* Improved event binding from the plugin main JavaScript file.
* Improved the main CSS file.



= 1.0.0 (September 20, 2016) =

* First release.

