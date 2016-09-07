=== Uix Slideshow ===
Contributors: UIUX Lab
Donate link: https://uiux.cc
Author URI: https://uiux.cc
Plugin URL: https://uiux.cc/wp-plugins/uix-slideshow/
Tags: slideshow, slider, post type, slides, carousel
Requires at least: 4.2
Tested up to: 4.6
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme. 

== Description ==


This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme. **Using template file to embed your theme.**

Insert slideshow anywhere on your site using a custom post type. Powered by jQuery Flexslider with some transition styles to choose from.


= Adding Uix Slideshow to Web Pages =

There are two different ways you can add the Uix Slideshow widget to your site's pages:

(1) Shortcode - Embed a shortcode into the editor of any post, page, or custom post type. 
  
  Use [uix_slideshow_output show="-1"] to add it to your Post, Widgets or Page content. Now this shortcode has one attributes. Uix Slideshow show at most can be customized using the "show" parameter. Show all items if value is '-1'.
  
  Go to your WordPress admin panel, edit or create a new post (or page). You’ll see a Uix Slideshow button in the toolbar.

(2) Template tags - Add a simple PHP function to one of your theme's template files. 

  Place <?php get_template_part( 'partials', 'uix_slideshow' ); ?> in your templates.


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
      
      Use [uix_slideshow_output show="-1"] to add it to your Post, Widgets or Page content. Now this shortcode has one attributes. Uix Slideshow show at most can be customized using the "show" parameter. Show all items if value is '-1'.
      
      Go to your WordPress admin panel, edit or create a new post (or page). You’ll see a Uix Slideshow button in the toolbar.
  
  (2) Template tags - Add a simple PHP function to one of your theme's template files. 
  
      Place <?php get_template_part( 'partials', 'uix_slideshow' ); ?> in your templates.

 
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

= 1.0.0 =

* First release.

