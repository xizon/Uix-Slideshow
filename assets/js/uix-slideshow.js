( function( $ ) {
'use strict';
	$( function() {

	
		$( '[data-uix-slideshow="1"]' ).each( function()  {
			var prefix = $( this ).data( 'prefix' );
			
			$( this ).flexslider({
				namespace	      : prefix+'-flex-',
				animation         : uix_slideshow_vars.animation+'',
				selector          : '.'+prefix+'-slides > div.item',
				controlNav        : uix_slideshow_vars.paging_nav,
				directionNav      : uix_slideshow_vars.arr_nav,
				smoothHeight      : uix_slideshow_vars.smoothheight,
				prevText          : uix_slideshow_vars.prev_txt,
				nextText          : uix_slideshow_vars.next_txt,
				animationSpeed    : uix_slideshow_vars.effect_duration,
				slideshowSpeed    : uix_slideshow_vars.speed,
				slideshow         : uix_slideshow_vars.auto,
				animationLoop     : uix_slideshow_vars.animloop,
				/*
				start: initslides, //Fires when the slider loads the first slide
				before: initslides //Fires after each slider animation completes
				*/
				start: function( slider ) {
						slider.removeClass( prefix+'-flexslider-loading' );
				}		
			});
			
		});
			
        /*
		function initslides( slider ) {
			
			var prefix = slider.data( 'prefix' ),
				$logo  = $( '.brand' );
			
			slider.removeClass( prefix+'-flexslider-loading' );
			
			//Adjust position
			if ( $( '.full-slideshow-header' ).length > 0 ) {
				
				var logo_h = $logo.height(),
					logo_t = $logo.offset().top;
				
				$( window ).on('resize', function() {
					
					logo_h = $logo.height();
					logo_t = $logo.offset().top;


					$( slider.slides ).each( function( i, item ) {
						 if ( logo_h > 0 && typeof logo_h !== typeof undefined ) {
							 $( item ).find( '.slides-info' ).css( {'top': ( logo_h + logo_t ) + 'px' } );	
						 }
					})
				});

				$( slider.slides ).each( function( i, item ) {
					 if ( logo_h > 0 && typeof logo_h !== typeof undefined ) {
						 $( item ).find( '.slides-info' ).css( {'top': ( logo_h + logo_t ) + 'px' } );	
					 }
				})
			}
			
			
			//Prevent to <a> of page transitions
			$( 'a' ).each( function() {
				var attr = $( this ).attr( 'href' );
				
				if ( typeof attr === typeof undefined ) {
					$( this ).attr( 'href', '#' );
				}
			});		
			

		}
		*/

		
		/* 
		 * Button Color
		 * --------------------------------
		*/
		 $( '.link-button' ).each( function(){

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