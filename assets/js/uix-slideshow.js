( function( $ ) {
'use strict';
	$( function() {

	
		$( '[data-uix-slideshow="1"]' ).each( function()  {
			var prefix = $( this ).data( 'prefix' );
			
			$( this ).flexslider({
				namespace	      : prefix+'-flex-',
				animation         : uix_slideshow_vars.animation+'',
				selector          : '.'+prefix+'-slides > div.item',
				controlNav        : ( uix_slideshow_vars.paging_nav == 'true' ) ? 1 : 0,
				directionNav      : ( uix_slideshow_vars.arr_nav == 'true' ) ? 1 : 0,
				smoothHeight      : ( uix_slideshow_vars.smoothheight == 'true' ) ? 1 : 0,
				prevText          : uix_slideshow_vars.prev_txt,
				nextText          : uix_slideshow_vars.next_txt,
				animationSpeed    : uix_slideshow_vars.effect_duration,
				slideshowSpeed    : uix_slideshow_vars.speed,
				slideshow         : ( uix_slideshow_vars.auto == 'true' ) ? 1 : 0,
				animationLoop     : ( uix_slideshow_vars.animloop == 'true' ) ? 1 : 0,
				start: initslides, //Fires when the slider loads the first slide
				//before: initslides //Fires after each slider animation completes	
	
			});
			
		});
			
		function initslides( slider ) {
			
			var prefix = slider.data( 'prefix' );
			
			slider.removeClass( prefix+'-flexslider-loading' );
			
			$( slider.slides ).each( function( i, item ) {
	
				var sw            = slider.width(),
					$title        = $( item ).find( '.uix-slideshow-custom-title' ).closest( 'h3' ),
					$caption      = $( item ).find( '.uix-slideshow-custom-caption' ).closest( 'p' ),
					$btn          = $( item ).find( '.uix-slideshow-custom-button' ),
					$level        = $( item ).find( '.uix-slideshow-custom-button' ),
					dropclasses   = 'fsize-tiny fsize-s fsize-m fsize-l fsize-xl fsize-xxl fsize-xxxl';
				
				$title.removeClass( dropclasses );
				$caption.removeClass( dropclasses );
				$btn.removeClass( dropclasses );

				if ( sw > 0 && typeof sw !== typeof undefined ) {
					if ( sw <= 1280 && sw > 980 ) {
						$title.addClass( 'fsize-xxxl' );
						$caption.addClass( 'fsize-l' );
						$btn.addClass( 'fsize-m' );
						
					}
					if ( sw <= 980 && sw > 768 ) {
						$title.addClass( 'fsize-xxl' );
						$caption.addClass( 'fsize-m' );
						$btn.addClass( 'fsize-s' );
					}
					if ( sw <= 768 ) {
						$title.addClass( 'fsize-xl' );
						$caption.addClass( 'fsize-s' );
						$btn.addClass( 'fsize-tiny' );
					}	
					
				}
				
				$( window ).on('resize', function() {
					sw = slider.width();
					
					$title.removeClass( dropclasses );
					$caption.removeClass( dropclasses );
					$btn.removeClass( dropclasses );
					
					if ( sw > 0 && typeof sw !== typeof undefined ) {
						if ( sw <= 1280 && sw > 980 ) {
							$title.addClass( 'fsize-xxxl' );
							$caption.addClass( 'fsize-l' );
							$btn.addClass( 'fsize-s' );

						}
						if ( sw <= 980 && sw > 768 ) {
							$title.addClass( 'fsize-xxl' );
							$caption.addClass( 'fsize-m' );
							$btn.addClass( 'fsize-tiny' );
						}
						if ( sw <= 768 ) {
							$title.addClass( 'fsize-xl' );
							$caption.addClass( 'fsize-s' );
							$btn.addClass( 'fsize-tiny' );
						}	

					}
				});
				

			})
			
			
			//Prevent to <a> of page transitions
			$( 'a' ).each( function() {
				var attr = $( this ).attr( 'href' );
				
				if ( typeof attr === typeof undefined ) {
					$( this ).attr( 'href', '#' );
				}
			});		
			

		}

		
		/* 
		 * Button Color
		 * --------------------------------
		*/
		 $( '.uix-slideshow-custom-button' ).each( function(){

			var $this              = $( this ),
				hoverbg            = $this.data( 'color' ),
				textcolor          = $this.data( 'tcolor' ),
				defaultbg          = $this.data( 'default-bg' );

			 if ( defaultbg != '' && typeof defaultbg !== typeof undefined ) {

				$( this ).css( {
					'background-color': 'transparent',
					'border-color'    : defaultbg,
				} );	 

			 }
			 
			 if ( hoverbg != '' && typeof hoverbg !== typeof undefined ) {

				$this.on( 'mouseenter', function( e ) {
					e.preventDefault();
					$( this ).css( {
						'background-color': hoverbg,
						'border-color'    : hoverbg,
					} );

					return false;
				});
				$this.on( 'mouseleave', function( e ) {
					e.preventDefault();
					$( this ).css( {
						'background-color': 'transparent',
						'border-color'    : defaultbg,
					} );
					return false;
				});		 

			 }

		 });	



	} );
} ) ( jQuery );