<?php
/**
* Field Type: Editor
*
* @print: 
* echo UixSlideshow::kses( get_post_meta( get_the_ID(), 'cus_page_ex_demoname_appear_3', true ) );
*
*/
class UixSlideshowFormType_Editor extends Uix_Slideshow_Custom_Metaboxes {
	
	public static function add( $id = '', $title = '', $desc = '', $default = '', $options = '', $placeholder = '', $desc_primary = '', $enable_table = false ) {

		//editor options
		$editor_toolbar = 'formatselect fontselect forecolor backcolor bold italic underline strikethrough bullist numlist blockquote code alignleft aligncenter alignright uix_slideshow_link uix_slideshow_unlink | removeformat outdent indent superscript subscript hr uix_slideshow_image uix_slideshow_highlightcode media customCode fullscreen';
		$editor_height = 200;  


	?>
		<?php if ( $enable_table ) : ?>
		<tr>
			<th class="uix-slideshow-cmb__title">
				<label><?php echo self::kses( $title ); ?></label>
				<?php if ( !empty ( $desc ) ) { ?>
					<p class="uix-slideshow-cmb__title_desc"><?php echo self::kses( $desc ); ?></p>
				<?php } ?>
			</th>
			<td>
		<?php endif; ?>

					<?php 

						$editor_toolbar  = 'formatselect fontselect forecolor backcolor bold italic underline strikethrough bullist numlist blockquote code alignleft aligncenter alignright uix_slideshow_link uix_slideshow_unlink | removeformat outdent indent superscript subscript hr uix_slideshow_image uix_slideshow_highlightcode media customCode fullscreen';
						$editor_height   = 200;
						if ( is_array ( $options ) ) {
							if ( isset( $options[ 'editor_toolbar' ] ) ) $editor_toolbar = $options[ 'editor_toolbar' ];
							if ( isset( $options[ 'editor_height' ] ) ) $editor_height = $options[ 'editor_height' ];
						}

					?> 

					<div class="uix-slideshow-cmb__mce-editor" aria-init="0">

					   <textarea data-editor-toolbar="<?php echo esc_attr( $editor_toolbar ); ?>" data-editor-height="<?php echo esc_attr( $editor_height ); ?>" id="<?php echo esc_attr( $id ); ?>-editor" name="<?php echo esc_attr( $id ); ?>" ><?php echo esc_textarea( $default ); ?></textarea>

					</div>


		<?php if ( $enable_table ) : ?>  
			</td>
		</tr>
		<?php endif; ?>
	<?php	
	}	


}
