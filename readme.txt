=== Uix Slideshow ===
Contributors: uiuxlab
Donate link: https://uiux.cc
Author URI: https://uiux.cc
Plugin URL: https://uiux.cc/wp-plugins/uix-slideshow/
Tags: slideshow, slider, post type, slides, carousel
Requires at least: 4.2
Requires PHP: 5.6
Tested up to: 6.1
Stable tag: 1.6.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme. 

== Description ==


This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme. **Using template file to embed your theme.**

Insert slideshow anywhere on your site using a custom post type.


https://www.youtube.com/watch?v=ckjZ570mYiU


= Adding Uix Slideshow to Web Pages =

There are two different ways you can add the Uix Slideshow widget to your site's pages:

(1) Shortcode - Embed a shortcode into the editor of any post, page, or custom post type. 
  

  Use `[uix_slideshow_output]` to add it to your Post, Widgets or Page content. Now this shortcode has one attributes. Uix Slideshow show at most can be customized using the "show" parameter.


  Go to your WordPress admin panel, edit or create a new post (or page). You’ll see a Uix Slideshow button in the toolbar.

(2) Template tags - Add a simple PHP function to one of your theme's template files. 

  Place `<?php get_template_part( 'tmpl', 'uix_slideshow' ); ?>` in your templates.
  
  
  
= Custom Usage =

You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original .css files. Go to "Uix Slideshow" in the WordPress Administration Screens, then link to a specific tab like "Custom CSS".

> There is a second way, make a new Cascading Style Sheet (CSS) document which name to **"uix-slideshow-custom.css"** to your templates directory ( "/wp-content/themes/{your-theme}/" or "/wp-content/themes/{your-theme}/assets/css/" ). You can connect to your site via an FTP client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Slideshow will use it as a default style sheet to your WordPress Theme. Of course, Uix Slideshow's function of "Custom CSS" is still valid.

> Note: Making a new javascrpt (.js) document which name to **"uix-slideshow-custom.js"** to your templates directory ( "/wp-content/themes/{your-theme}/" or "/wp-content/themes/{your-theme}/assets/js/" ). Once you have created an existing JS file, Uix Slideshow will use it as a default script to your WordPress Theme.

  
  

== Installation ==

1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to "Appearance -> Install Plugins".
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

2. You need to create Uix Slideshow template files in your templates directory. You can create the files on the WordPress admin panel. As a workaround you can use FTP, access the Uix Slideshow template files path (/wp-content/plugins/uix-slideshow/theme_templates/) and upload files to your theme templates directory (/wp-content/themes/{your-theme}/).  

   Please check if you have the 1 template file 'tmpl-uix_slideshow.php' in your templates directory. If you can't find these files, then just copy them from the directory '/wp-content/plugins/uix-slideshow/theme_templates/' to your templates directory.

3. Create uix slideshow item and publish slideshow then.

4. You can pretty much custom every aspect of the look and feel of this page by modifying the "*.php" template files (Access the path to the themes directory) . Best Practices for Editing WordPress Template Files:

  (1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to "Appearance > Editor" from your sidebar.

  (2) You can connect to your site via an FTP client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.
  
  
5. Adding Uix Slideshow to Web Pages.



= There are two different ways you can add the Uix Slideshow widget to your site's pages: =

  (1) Shortcode - Embed a shortcode into the editor of any post, page, or custom post type. 
      
     Use `[uix_slideshow_output]` to add it to your Post, Widgets or Page content. Now this shortcode has one attributes. Uix Slideshow show at most can be customized using the "show" parameter.


      
      Go to your WordPress admin panel, edit or create a new post (or page). You’ll see a Uix Slideshow button in the toolbar.
  
  (2) Template tags - Add a simple PHP function to one of your theme's template files. 
  
      Place `<?php get_template_part( 'tmpl', 'uix_slideshow' ); ?>` in your templates.
 
6. The Uix Slideshow plugin allows users to easily customize to themes. Go to "Uix Slideshow -> Settings -> General Settings". 

7. You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original ".css" files. Go to "Uix Slideshow -> Settings -> Custom CSS".


== Frequently Asked Questions ==

= FAQ 1: How to customize the Uix Slideshow templates by your theme location? =

Occasionally you may wish to edit one of the templates that come with Uix Slideshow. Instead of editing the templates right in the plugin you should move them to your theme, so that your changes aren\'t lost when you update the Uix Slideshow plugin. As a workaround you can use FTP, access the Uix Slideshow template files path (/wp-content/plugins/uix-slideshow/theme_templates/) and upload files to your theme templates directory (/wp-content/themes/{your-theme}/).  

= FAQ 2: How to customize page options and stylesheets? =

Go to **"Uix Slideshow -> Settings -> General Settings"** or **"Uix Slideshow -> Settings -> Custom CSS"**



== Screenshots ==
1. screenshot-1.jpg
2. screenshot-2.jpg
3. screenshot-3.jpg
4. screenshot-4.jpg


== Upgrade Notice ==


* Bug fixes and improvements.


== Changelog ==


= 1.6.5 (November 12, 2022) =

* Tweak: Enhance the functionality of the uix custom metabox.


= 1.6.4 (October 6, 2021) =

* Fix: Fixed the issue of triggering touch events on the mobile terminal of core script.


= 1.6.3 (October 5, 2021) =

* Tweak: Optimized the performance of core scripts and removed unnecessary traversal.


= 1.6.2 (July 5, 2021) =

* Tweak: Performance optimization of dynamic forms (use virtual tree to update dom) for Custom Meta Boxes.
* Tweak: Optimized the escape compatibility issue of the editor control for Custom Meta Boxes.


= 1.6.1 (December 8, 2020) =

* Tweak: Upgraded the uploading control.


= 1.6.0 (October 26, 2020) =

* Fix: Fixed an issue where the title of the custom post type was empty and could not be published when publishing.



= 1.5.5 (October 21, 2020) =

* Fix: Optimized the color transparency control, compatible with WP 5.5.0 and above.
* Tweak: Expand and optimize Uix Custom Meta Boxes.


= 1.5.3 (October 13, 2020) =

* Tweak: Optimized the language support and media insertion of the editor for Uix Custom Meta Boxes.


= 1.5.2 (September 25, 2020) =

* Tweak: Compatible with WP 5.5.*.
* Fix: Modified the style display of the module.


= 1.5.1 (July 30, 2020) =

* Fix: Fixed issue with initialization height for Slider.


= 1.5.0 (January 18, 2020) =

* New: Added Custom Meta Boxes API documentation to admin menu.
* New: Added zh_CN language support.


= 1.4.35 (December 31, 2019) =

* New: Added support for video formats.


= 1.4.25 (November 20, 2019) =

* Fix: Correct the path error of Setting after the corresponding theme.


= 1.4.1 (November 19, 2019) =

* New: Add drag sorting for Uix Custom Metaboxes' Image Gallery.
* Fix: Fixed a bug for ReferenceError: tinyMCE is not defined when using editor metabox.


= 1.3.9 (November 11, 2019) =

* Fix: Fixed button trigger event for uploading image control.
* Dev: New loop fields control for richer release types.
* Tweak: Optimized scalability for components such as uploads.



= 1.3.8 (October 11, 2019) =

* Tweak: Optimized the css and js of migrate to 1.3.5+.
* Fix:Fixed issue with initialization height.


= 1.3.6 (October 9, 2019) =

* Fix: Prevents front-end javascripts of Slider that are activated with AJAX to repeat loading.
* Refactor: unify the slider config parameters.
* Tweak: Optimized for sliding effects.


= 1.3.5 (September 24, 2019) =

* Remove: Removed the plugin `jquery.flexslider` using native js instead.
* New: Added effect "Scale".
* Dev: Added filter `add_filter( 'uix_slideshow_custom_metaboxes_vars', 'mytheme_modify_vars' );` for current Custom Metaboxes.
* Tweak: The transition effect is controlled by CSS3, and the styles can be modified directly through the admin panel.


= 1.3.4 (September 18, 2019) =

* Tweak: Enhance the functionality of the uix custom metabox.
* Tweak: MCEEditor upgrade in form component.


= 1.3.3 (February 14, 2019) =

* Fix: Fixed a bug for plugin.

= 1.3.2 (November 30, 2018) =

* Fix: Fixed a bug for create_function() is deprecated in PHP 7.2.


= 1.3.1 (November 17, 2018) =

* Fix: Fixed some style compatibility issues with the Flexslider plugin.


= 1.3.0 (July 13, 2018) =

* Fix: Fixed an issue when your theme uses more meta boxes.


= 1.2.9 (July 11, 2018) =

* Fix: Fixed issue where color picker does not display.
 
 
= 1.2.8 (May 3, 2018) =

* Fix: Fixed a bug with custom styles and child themes that if site uses a child theme when you create a custom css/js file in child theme folder, the plugin tries to connect style with path located in the parent theme folder.
* Tweak: Updated some third-party plugins to the latest version.


= 1.2.7 (September 17, 2017) =

* Optimized the directory and file structure, delete the unnecessary files and codes.
* Improve the Uix Slideshow assistant(helper) experience in admin panel.
* Resolved the possible permissions issues to create a template files.




= 1.2.6 (September 13, 2017) =

* Added new uix_slideshow_shortcode_filter filter to function that displays Uix Slideshow shortcode.


= 1.2.5 (September 5, 2017) =

* Fixed a possible bug of duplication running script with Uix Slideshow.
* Enhance the compatibility of each plug-in.
* Optimized front-end default scripts.
* Fixed a shortcode showing the number of errors.
* Removed the number of short code display attributes.
 
 
= 1.2.2 (September 3, 2017) =

* Re-defined the Uix Slideshow shortcode API.
* Compatible with WP plugin "Uix Slideshow".
* Optimized front-end default scripts.


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

