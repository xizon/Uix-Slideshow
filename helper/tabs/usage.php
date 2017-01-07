<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( isset( $_GET[ 'tab' ] ) && $_GET[ 'tab' ] == 'usage' ) {
?>


        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to <strong>"Appearance -> Install Plugins"</strong>.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)</h4>', 'uix-slideshow' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixSlideshow::plug_directory(); ?>helper/img/plug.jpg" alt="">
        </p> 
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">2. You need to create Uix Slideshow template files in your templates directory. You can create the files on the WordPress admin panel.</h4>', 'uix-slideshow' ); ?>
     
        </p>  
        <p>
           &nbsp;&nbsp;&nbsp;&nbsp;<a class="button button-primary" href="<?php echo admin_url( "admin.php?page=".UixSlideshow::HELPER."&tab=temp" ); ?>"><?php _e( 'Create now!', 'uix-slideshow' ); ?></a>
     
        </p>  
         <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;As a workaround you can use FTP, access the Uix Slideshow template files path <code>/wp-content/plugins/uix-slideshow/theme_templates/</code> and upload files to your theme templates directory <code>/wp-content/themes/{your-theme}/</code>. ', 'uix-slideshow' ); ?>
   
        </p>  
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;Please check if you have the 1 template file <code>"partials-uix_slideshow.php"</code> in your templates directory. If you can\'t find these files, then just copy them from the directory "/wp-content/plugins/uix-slideshow/theme_templates/" to your templates directory.', 'uix-slideshow' ); ?>
           
          
        </p>  
        <p>
           <img src="<?php echo UixSlideshow::plug_directory(); ?>helper/img/temp.jpg" alt="">
        </p> 
       
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">3. Create uix slideshow item and publish slideshow then.</h4>', 'uix-slideshow' ); ?>
        </p>  
        <p>
           <img src="<?php echo UixSlideshow::plug_directory(); ?>helper/img/add-item.jpg" alt="">
        </p> 
        
         <p>
           <?php _e( '<h4 class="uix-bg-custom-title">4. You can pretty much custom every aspect of the look and feel of this page by modifying the <code>*.php</code> template files <strong>(Access the path to the themes directory)</strong> . Best Practices for Editing WordPress Template Files:</h4>', 'uix-slideshow' ); ?>
        </p> 
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to <strong>"Appearance > Editor"</strong> from your sidebar.', 'uix-slideshow' ); ?>
        </p>   
          
        <p>
           <img src="<?php echo UixSlideshow::plug_directory(); ?>helper/img/editor.jpg" alt="">
        </p> 
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(2) You can connect to your site via an <strong>FTP</strong> client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.', 'uix-slideshow' ); ?>
        </p>  
         
    
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">5. Adding Uix Slideshow to Web Pages.</h4>', 'uix-slideshow' ); ?>
        </p>   
        <p>
           <?php _e( 'There are two different ways you can add the Uix Slideshow widget to your site\'s pages:', 'uix-slideshow' ); ?>
        </p>  
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(1) <strong>Shortcode</strong> - Embed a shortcode into the editor of any post, page, or custom post type.', 'uix-slideshow' ); ?>
        </p>  
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Use <code>[uix_slideshow_output show="-1"]</code> to add it to your Post, Widgets or Page content. Now this shortcode has one attributes. Uix Slideshow show at most can be customized using the "show" parameter. Show all items if value is "-1". Go to your WordPress admin panel, edit or create a new post (or page). You’ll see our tiny little button in the toolbar, preceded by a separator:', 'uix-slideshow' ); ?>
        </p> 
        
         <p>
           <img src="<?php echo UixSlideshow::plug_directory(); ?>helper/img/sc.jpg" alt="">
        </p>         
        
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;(2) <strong>Template tags</strong> - Add a simple PHP function to one of your theme\'s template files.', 'uix-slideshow' ); ?>
        </p> 
        <p>
           <?php _e( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Place <code>&lt;?php get_template_part( \'partials\', \'uix_slideshow\' ); ?&gt;</code> in your templates.', 'uix-slideshow' ); ?>
        </p> 

        
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">6. The Uix Slideshow plugin allows users to easily customize to themes. Go to <strong>"Uix Slideshow -> Settings -> General Settings"</strong>.</h4>', 'uix-slideshow' ); ?>
        </p>   
        <p>
           <img src="<?php echo UixSlideshow::plug_directory(); ?>helper/img/customize.jpg" alt="">
        </p>  
        <p>
           <?php _e( '<h4 class="uix-bg-custom-title">7. You can overview the original styles to overwrite it. It will be on creating new styles to your website, without modifying original <code>.css</code> files. Go to <strong>"Uix Slideshow -> Settings -> Custom CSS"</strong>.</h4>', 'uix-slideshow' ); ?>
        </p> 
        <blockquote class="uix-bg-custom-blockquote">
			<p class="uix-bg-custom-desc">
			   <?php _e( 'There is a second way, make a new Cascading Style Sheet (CSS) document which name to <strong>uix-slideshow-custom.css</strong> to your templates directory ( <code>/wp-content/themes/{your-theme}/</code> or <code>/wp-content/themes/{your-theme}/assets/css/</code> ). You can connect to your site via an FTP client, make the changes and then upload the file back to the server. Once you have created an existing CSS file, Uix Slideshow will use it as a default style sheet to your WordPress Theme. Of course, Uix Slideshow\'s function of "Custom CSS" is still valid.', 'uix-slideshow' ); ?>

			</p>    
			<p class="uix-bg-custom-desc">
			   <?php _e( '<b>Note:<b> Making a new javascrpt (.js) document which name to <strong>uix-slideshow-custom.js</strong> to your templates directory ( <code>/wp-content/themes/{your-theme}/</code> or <code>/wp-content/themes/{your-theme}/assets/js/</code> ). Once you have created an existing JS file, Uix Slideshow will use it as a default script to your WordPress Theme.', 'uix-slideshow' ); ?>

			</p>
        </blockquote>      
        <p>
           <img src="<?php echo UixSlideshow::plug_directory(); ?>helper/img/css.jpg" alt="">
        </p>  
     
        
<?php } ?>