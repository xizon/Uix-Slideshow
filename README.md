# Uix Slideshow
This is a WordPress Plugin. This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme.

Copyright (c) 2016 UIUX Lab [@uiux_lab](https://twitter.com/uiux_lab)

[Donate Me](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PYZLU7UZNQ6CE)

[Plugin for Wordpress at WordPress.org Repository](https://wordpress.org/plugins/uix-slideshow/)

[Plugin URI](https://uiux.cc/wp-plugins/uix-slideshow/)

### Licensing

Licensed under the [GPL3.0](http://www.gnu.org/licenses/gpl-3.0.en.html).

### Description

This plugin is a simple way to build, organize and display slideshow into any existing WordPress theme. **Using template file to embed your theme.**

Insert slideshow anywhere on your site using a custom post type. Powered by jQuery Flexslider with some transition styles to choose from.



### Updates

#### = 1.0.7 =

* Optimized binding theme picker.


#### = 1.0.6 =

* Fixed a bug that caused the slides to not be displayed.



#### = 1.0.5 =

* WordPress 4.7 compatible.
* Enhanced scalability structure.
* Enhanced the user experience of templates admin panel.
* Supports custom Uix Slideshow core stylesheet and script based on "/wp-content/themes/{your-theme}/" and "/wp-content/themes/{your-theme}/" directories  for your theme.
* Supports custom Uix Slideshow core stylesheet and script based on "/wp-content/themes/{your-theme}/assets/css/" and "/wp-content/themes/{your-theme}/assets/js/" directories  for your theme.



#### = 1.0.1 =

* Optimized for tablet display.
* Improved event binding from the plugin main JavaScript file.
* Improved the main CSS file.



#### = 1.0.0 =

* First release.





### Tested under

- WP 4.2.*
- WP 4.3.*
- WP 4.4.1
- WP 4.4.2
- WP 4.5.*
- WP 4.6
- WP 4.6.*
- WP 4.7

###Screenshot

![](https://github.com/xizon/Uix-Slideshow/blob/master/assets/screenshot-1.jpg)

![](https://github.com/xizon/Uix-Slideshow/blob/master/assets/screenshot-2.jpg)

![](https://github.com/xizon/Uix-Slideshow/blob/master/assets/screenshot-3.jpg)

![](https://github.com/xizon/Uix-Slideshow/blob/master/assets/screenshot-4.jpg)



###Credits

#####I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:

- [Custom Metaboxes and Fields](https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress)
- [Flexslider](https://github.com/woothemes/FlexSlider)

###How to use?

1.After activating your theme, you can see a prompt pointed out as absolutely critical. Go to **"Appearance -> Install Plugins"**.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

![](https://github.com/xizon/Uix-Slideshow/blob/master/helper/img/plug.jpg)


2.You need to create Uix Slideshow template files in your templates directory. You can create the files on the WordPress admin panel. As a workaround you can use FTP, access the Uix Slideshow template files path (`/wp-content/plugins/uix-slideshow/theme_templates/`) and upload files to your theme templates directory (`/wp-content/themes/{your-theme}/`).  


Please check if you have the **1** template file `partials-uix_slideshow.php` in your templates directory. If you can't find these files, then just copy them from the directory **"/wp-content/plugins/uix-slideshow/theme_templates/"** to your templates directory.

![](https://github.com/xizon/Uix-Slideshow/blob/master/helper/img/temp.jpg)


3.Create uix slideshow item and publish slideshow then.

![](https://github.com/xizon/Uix-Slideshow/blob/master/helper/img/add-item.jpg)


4.You can pretty much custom every aspect of the look and feel of this page by modifying the `*.php` template files **(Access the path to the themes directory)**. **Best Practices for Editing WordPress Template Files:**

　(1)  WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to **"Appearance > Editor"** from your sidebar.

![](https://github.com/xizon/Uix-Slideshow/blob/master/helper/img/editor.jpg)

　(2) You can connect to your site via an **FTP** client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.



5.**Adding Uix Slideshow to Web Pages.**

There are two different ways you can add the Uix Slideshow widget to your site's pages:

　(1)  **Shortcode** - Embed a shortcode into the editor of any post, page, or custom post type. 

　　Use `[uix_slideshow_output show="-1"]` to add it to your Post, Widgets or Page content. Now this shortcode has one attributes. Uix Slideshow show at most can be customized using the **"show"** parameter. Show all items if value is **"-1"**. Go to your WordPress admin panel, edit or create a new post (or page). You’ll see our tiny little button in the toolbar, preceded by a separator:

![](https://github.com/xizon/Uix-Slideshow/blob/master/helper/img/sc.jpg)
  
　(2)  **Template tags** - Add a simple PHP function to one of your theme's template files. 

　　Place `<?php get_template_part( 'partials', 'uix_slideshow' ); ?>` in your templates.



6.The Uix Slideshow plugin allows users to easily enable a "Customizer Page" to themes. Go to **"Appearance -> Customize -> General Settings"**.

![](https://github.com/xizon/Uix-Slideshow/blob/master/helper/img/customize.jpg)


7.You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original `.css` files. Go to **"Uix Slideshow -> Settings -> Custom CSS"**.

![](https://github.com/xizon/Uix-Slideshow/blob/master/helper/img/css.jpg)


> There is a second way, make a new Cascading Style Sheet (CSS) document which name to **uix-slideshow-custom.css** to your **templates directory** (`/wp-content/themes/{your-theme}/` or `/wp-content/themes/{your-theme}/assets/css/`). You can connect to your site via an **FTP** client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Slideshow will use it as a default style sheet to your WordPress Theme. Of course, Uix Slideshow's function of "Custom CSS" is still valid.


> Note: Making a new javascrpt (.js) document which name to **uix-slideshow-custom.js** to your templates directory (`/wp-content/themes/{your-theme}/` or `/wp-content/themes/{your-theme}/assets/js/`). Once you have created an existing JS file, Uix Slideshow will use it as a default script to your WordPress Theme.

