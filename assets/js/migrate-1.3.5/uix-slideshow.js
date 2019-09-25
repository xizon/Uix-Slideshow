/* ===================================== */
/* ===================================== */
/* ===================================== */
/* ===================================== */
/* !! The old versions migrated to version 1.3.5 (inclusive)  */
/* ===================================== */
/* ===================================== */
/* ===================================== */
/* ===================================== */


( function($) {
    'use strict';


	/*! 
	 *************************************
	 * The default plugin script runs in the front-end page
	 *************************************
	 */
	$.extend({ 
		uixslideshow_default:function () { 
	
			$( '[data-uix-slideshow="1"]' ).each( function()  {
			
				 var $this     = $( this ),
					 activated = $this.data( 'activated' );//In order to avoid duplication of the running script with Uix Page Builder ( required );
				

				if ( typeof activated === typeof undefined || activated === 0 ) {

					$this.UixSlideshow();

					//Prevents front-end javascripts that are activated in the background to repeat loading.
					$this.data( 'activated', 1 );	
				}	
				

			});

			/* 
			 * Span Color
			 * --------------------------------
			*/
			 $( '[data-span-color]' ).each( function(){

				 var $this     = $( this ),
					 activated = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
					 color     = $this.data( 'span-color' )


				if ( typeof activated === typeof undefined || activated === 0 ) {

					if ( color != '' ) {
						$this.css( {
							'color'    : color,
						} );	 
					 }

					//Prevents front-end javascripts that are activated in the background to repeat loading.
					$this.data( 'activated', 1 );	
				}
			   

			 });		


			/* 
			 * Button Color
			 * --------------------------------
			*/
			 $( '.uix-slideshow-custom-button' ).each( function(){

			
				var $this         = $( this ),
					activated     = $this.data( 'activated' ),//In order to avoid duplication of the running script with Uix Page Builder ( required )
					textcolor     = $this.data( 'tcolor' ),
					defaultbg     = $this.data( 'default-bg' );

				 
				if ( typeof activated === typeof undefined || activated === 0 ) {

				
					 if ( defaultbg != '' && typeof defaultbg !== typeof undefined ) {

						$this.css( {
							'background-color': 'transparent',
							'border-color'    : defaultbg,
						} );	 

					 }


					//Prevents front-end javascripts that are activated in the background to repeat loading.
					$this.data( 'activated', 1 );	
				}
 
			 });	

					
		} 
	}); 
	
	
	/*! 
	 *************************************
	 * Call the default script
	 *************************************
	 */
    $( function() {
		
		$.uixslideshow_default();
		
		//Compatible with Uix Page Builder editing of plugin in admin panel.
		//Reload the front-end javascripts to make the live preview take effect.
		//This function can be used in your theme script.
		if ( $.isFunction( $.uix_pb_render ) ) { 
			$.uix_pb_render( { 
				action: function() {
					$.uixslideshow_default();
				} 
			} ); 
		}

	} );
	
	
} ) ( jQuery );





/* 
 *************************************
 * Uix Slidershow
 *
 * @return {Void}
 *
 *************************************
 */    
( function ( $ ) {
	'use strict';
    $.fn.UixSlideshow = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({}, options );
 
        this.each( function() {
			
			
            var $window                   = $( window ),
                windowWidth               = window.innerWidth,
                windowHeight              = window.innerHeight,
                animDelay                 = 0,
                $sliderWrapper            = $( this );


            sliderInit( false );

            $window.on( 'resize', function() {
                // Check window width has actually changed and it's not just iOS triggering a resize event on scroll
                if ( window.innerWidth != windowWidth ) {

                    // Update the window width for next time
                    windowWidth = window.innerWidth;

                    sliderInit( true );

                }
            });



            /*
             * Get the CSS property
             *
             * @private
             * @description This function can be used separately in HTML pages or custom JavaScript.
             * @param  {Object} el     - Target object, using class name or ID to locate.
             * @return {String|JSON}   - The value of property.
             */
            function getTransitionDuration( el ) {

                if ( typeof el === typeof undefined ) {
                    return 0;
                }


                var style    = window.getComputedStyle(el),
                    duration = style.webkitTransitionDuration,
                    delay    = style.webkitTransitionDelay;

                if ( typeof duration != typeof undefined ) {
                    // fix miliseconds vs seconds
                    duration = (duration.indexOf("ms")>-1) ? parseFloat(duration) : parseFloat(duration)*1000;
                    delay = (delay.indexOf("ms")>-1) ? parseFloat(delay) : parseFloat(delay)*1000;

                    return duration;
                } else {
                    return 0;
                }

            }

            
            

            /*
             * Initialize slideshow
             *
             * @param  {Boolean} resize            - Determine whether the window size changes.
             * @return {Void}
             */
            function sliderInit( resize ) {

                $sliderWrapper.each( function()  {

                    var $this                    = $( this ),
                        $items                   = $this.find( '.item' ),
                        $first                   = $items.first(),
                        nativeItemW,
                        nativeItemH;

                    
                    
                    //------
                    var addPagination = uix_slideshow_vars.paging_nav;
                    var addControlsArrows = uix_slideshow_vars.arr_nav;
                    var prevTxt = uix_slideshow_vars.prev_txt;
                    var nextTxt = uix_slideshow_vars.next_txt;
                    var eff = uix_slideshow_vars.animation;
                    
                    $this.wrap( '<div class="custom-slideshow-flexslider__wrapper"></div>' );
                    
                    
                    $this.addClass( 'custom-slideshow-flexslider--eff-' + eff );
                    
                    if ( addPagination ) {
                        $( '<div class="custom-slideshow-flexslider__pagination my-a-slider-pagination-1"></div>' ).insertAfter( $this );
                    }
                    if ( addControlsArrows ) {
                        $( '<div class="custom-slideshow-flexslider__arrows my-a-slider-arrows-1"><a href="#" class="custom-slideshow-flexslider__arrows--prev">'+prevTxt+'</a><a href="#" class="custom-slideshow-flexslider__arrows--next">'+nextTxt+'</a></div>' ).insertAfter( $this );
                    }

                    
                    
                    //Images loaded
                    //-------------------------------------	
                    var images = [];
                    $items.each( function()  {
                        var imgURL   = $( this ).find( 'img' ).attr( 'src' );
                        if ( typeof imgURL != typeof undefined ) {
                            images.push( imgURL );
                        }
                    });
                    
                    loader( images, loadImage, function () {
                        $sliderWrapper.addClass( 'is-loaded' );
                    });	



                    //Autoplay times
                    var playTimes;
                    //A function called "timer" once every second (like a digital watch).
                    $this[0].animatedSlides;


                    //The speed of movement between elements.
                    animDelay = getTransitionDuration( $first[0] );

                    

                    //Initialize the first item container
                    //-------------------------------------		
                    $items.addClass( 'next' );

                    setTimeout( function() {
                        $first.addClass( 'is-active' );
                    }, animDelay );


                    if ( $first.find( 'video' ).length > 0 ) {

                        //Returns the dimensions (intrinsic height and width ) of the video
                        var video    = document.getElementById( $first.find( 'video' ).attr( 'id' ) ),
                            videoURL = $first.find( 'source:first' ).attr( 'src' );

                        video.addEventListener( 'loadedmetadata', function( e ) {
                            $this.css( 'height', this.videoHeight*($this.width()/this.videoWidth) + 'px' );	

                            nativeItemW = this.videoWidth;
                            nativeItemH = this.videoHeight;	

                            //Initialize all the items to the stage
                            addItemsToStage( $this, nativeItemW, nativeItemH );

                        }, false);	

                        video.src = videoURL;


                    } else {

                        var imgURL   = $first.find( 'img' ).attr( 'src' );

                        if ( typeof imgURL != typeof undefined ) {
                            var img = new Image();

                            img.onload = function() {
                                $this.css( 'height', $this.width()*(this.height/this.width) + 'px' );		

                                nativeItemW = this.width;
                                nativeItemH = this.height;	

                                //Initialize all the items to the stage
                                addItemsToStage( $this, nativeItemW, nativeItemH );

                            };

                            img.src = imgURL;
                        }



                    }	



                    //Autoplay Slider
                    //-------------------------------------		
                    if ( !resize ) {

                        var dataAuto                 = $this.data( 'auto' ),
                            dataTiming               = $this.data( 'timing' ),
                            dataLoop                 = $this.data( 'loop' );
                        
                        
                        //----
                        dataAuto = uix_slideshow_vars.auto == 'true' ? true : false;
                        dataTiming = uix_slideshow_vars.speed;
                        dataLoop = uix_slideshow_vars.animloop == 'true' ? true : false;
      

                        if ( typeof dataAuto === typeof undefined ) dataAuto = false;	
                        if ( typeof dataTiming === typeof undefined ) dataTiming = 10000;
                        if ( typeof dataLoop === typeof undefined ) dataLoop = false;


                        if ( dataAuto && !isNaN( parseFloat( dataTiming ) ) && isFinite( dataTiming ) ) {

                            sliderAutoPlay( playTimes, dataTiming, dataLoop, $this );

                            $this.on({
                                mouseenter: function() {
                                    clearInterval( $this[0].animatedSlides );
                                },
                                mouseleave: function() {
                                    sliderAutoPlay( playTimes, dataTiming, dataLoop, $this );
                                }
                            });	

                        }


                    }




                });


            }




            /*
             * Trigger slider autoplay
             *
             * @param  {Function} playTimes      - Number of times.
             * @param  {Number} timing           - Autoplay interval.
             * @param  {Boolean} loop            - Determine whether to loop through each item.
             * @param  {Object} slider           - Selector of the slider .
             * @return {Void}                    - The constructor.
             */
            function sliderAutoPlay( playTimes, timing, loop, slider ) {	

                var items = slider.find( '.item' ),
                    total = items.length;

                slider[0].animatedSlides = setInterval( function() {

                    playTimes = parseFloat( items.filter( '.is-active' ).index() );
                    playTimes++;


                    if ( !loop ) {
                        if ( playTimes < total && playTimes >= 0 ) sliderUpdates( playTimes, $sliderWrapper, 'next' );
                    } else {
                        if ( playTimes == total ) playTimes = 0;
                        if ( playTimes < 0 ) playTimes = total-1;		
                        sliderUpdates( playTimes, $sliderWrapper, 'next' );
                    }



                }, timing );	
            }




            /*
             * Initialize all the items to the stage
             *
             * @param  {Object} slider           - Current selector of each slider.
             * @param  {Number} nativeItemW      - Returns the intrinsic width of the image/video.
             * @param  {Number} nativeItemH      - Returns the intrinsic height of the image/video.
             * @return {Void}
             */
            function addItemsToStage( slider, nativeItemW, nativeItemH ) {

                var $this                    = slider,
                    $items                   = $this.find( '.item' ),
                    $first                   = $items.first(),
                    itemsTotal               = $items.length,
                    dataControlsPagination   = $this.data( 'controls-pagination' ),
                    dataControlsArrows       = $this.data( 'controls-arrows' ),
                    dataLoop                 = $this.data( 'loop' ),
                    dataDraggable            = $this.data( 'draggable' ),
                    dataDraggableCursor      = $this.data( 'draggable-cursor' );
                
                
                //-----
                dataLoop = uix_slideshow_vars.animloop == 'true' ? true : false;
                dataDraggable = uix_slideshow_vars.draggable == 'true' ? true : false;


                if ( typeof dataControlsPagination === typeof undefined ) dataControlsPagination = '.my-a-slider-pagination-1';
                if ( typeof dataControlsArrows === typeof undefined || dataControlsArrows == false ) dataControlsArrows = '.my-a-slider-arrows-1';
                if ( typeof dataLoop === typeof undefined ) dataLoop = false;
                if ( typeof dataDraggable === typeof undefined ) dataDraggable = false;
                if ( typeof dataDraggableCursor === typeof undefined ) dataDraggableCursor = 'move';


                //If arrows does not exist on the page, it will be added by default, 
                //and the drag and drop function will be activated.
                if ( $( dataControlsArrows ).length == 0 ) {
                    $( 'body' ).prepend( '<div style="display:none;" class="uix-slideshow__arrows '+dataControlsArrows.replace('#','').replace('.','')+'"><a href="#" class="custom-slideshow-flexslider__arrows--prev"></a><a href="#" class="custom-slideshow-flexslider__arrows--next"></a></div>' );
                }




                //Prevent bubbling
                if ( itemsTotal == 1 ) {
                    $( dataControlsPagination ).hide();
                    $( dataControlsArrows ).hide();
                }



                //Pagination dots 
                //-------------------------------------	
                var _dot       = '',
                    _dotActive = '';
                _dot += '<ul>';
                for ( var i = 0; i < itemsTotal; i++ ) {

                    _dotActive = ( i == 0 ) ? 'class="is-active"' : '';

                    _dot += '<li><a '+_dotActive+' data-index="'+i+'" href="#"></a></li>';
                }
                _dot += '</ul>';

                if ( $( dataControlsPagination ).html() == '' ) $( dataControlsPagination ).html( _dot );

                $( dataControlsPagination ).find( 'li a' ).off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();

                    if ( !$( this ).hasClass( 'is-active' ) ) {


                        //Determine the direction
                        var curDir = 'prev';
                        if ( $( this ).attr( 'data-index' ) > parseFloat( $items.filter( '.is-active' ).index() ) ) {
                            curDir = 'next';
                        }


                        sliderUpdates( $( this ).attr( 'data-index' ), $this, curDir );

                        //Pause the auto play event
                        clearInterval( $this[0].animatedSlides );	
                    }



                });

                //Next/Prev buttons
                //-------------------------------------		
                var _prev = $( dataControlsArrows ).find( '.custom-slideshow-flexslider__arrows--prev' ),
                    _next = $( dataControlsArrows ).find( '.custom-slideshow-flexslider__arrows--next' );

                $( dataControlsArrows ).find( 'a' ).attr( 'href', '#' );

                $( dataControlsArrows ).find( 'a' ).removeClass( 'is-disabled' );
                if ( !dataLoop ) {
                    _prev.addClass( 'is-disabled' );
                }


                _prev.off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();

                    sliderUpdates( parseFloat( $items.filter( '.is-active' ).index() ) - 1, $this, 'prev' );

                    //Pause the auto play event
                    clearInterval( $this[0].animatedSlides );

                });

                _next.off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();

                    sliderUpdates( parseFloat( $items.filter( '.is-active' ).index() ) + 1, $this, 'next' );


                    //Pause the auto play event
                    clearInterval( $this[0].animatedSlides );


                });



                //Added touch method to mobile device and desktop
                //-------------------------------------	
                var $dragDropTrigger = $items;


                //Make the cursor a move icon when a user hovers over an item
                if ( dataDraggable && dataDraggableCursor != '' && dataDraggableCursor != false ) $dragDropTrigger.css( 'cursor', dataDraggableCursor );


                //Mouse event
                $dragDropTrigger.on( 'mousedown.ADVANCED_SLIDER touchstart.ADVANCED_SLIDER', function( e ) {

                    //Do not use "e.preventDefault()" to avoid prevention page scroll on drag in IOS and Android

                    var touches = e.originalEvent.touches;

                    $( this ).addClass( 'is-dragging' );


                    if ( touches && touches.length ) {	
                        $( this ).data( 'origin_mouse_x', parseInt( touches[0].pageX ) );
                        $( this ).data( 'origin_mouse_y', parseInt( touches[0].pageY ) );

                    } else {

                        if ( dataDraggable ) {
                            $( this ).data( 'origin_mouse_x', parseInt( e.pageX ) );
                            $( this ).data( 'origin_mouse_y', parseInt( e.pageY ) );	
                        }


                    }

                    $dragDropTrigger.on( 'mouseup.ADVANCED_SLIDER touchmove.ADVANCED_SLIDER', function( e ) {


                        $( this ).removeClass( 'is-dragging' );
                        var touches        = e.originalEvent.touches,
                            origin_mouse_x = $( this ).data( 'origin_mouse_x' ),
                            origin_mouse_y = $( this ).data( 'origin_mouse_y' );

                        if ( touches && touches.length ) {

                            var deltaX = origin_mouse_x - touches[0].pageX,
                                deltaY = origin_mouse_y - touches[0].pageY;

                            //--- left
                            if ( deltaX >= 50) {
                                if ( $items.filter( '.is-active' ).index() < itemsTotal - 1 ) _next.trigger( 'click' );
                            }

                            //--- right
                            if ( deltaX <= -50) {
                                if ( $items.filter( '.is-active' ).index() > 0 ) _prev.trigger( 'click' );
                            }

                            //--- up
                            if ( deltaY >= 50) {


                            }

                            //--- down
                            if ( deltaY <= -50) {


                            }


                            if ( Math.abs( deltaX ) >= 50 || Math.abs( deltaY ) >= 50 ) {
                                $dragDropTrigger.off( 'touchmove.ADVANCED_SLIDER' );
                            }	


                        } else {


                            if ( dataDraggable ) {
                                //right
                                if ( e.pageX > origin_mouse_x ) {				
                                    if ( $items.filter( '.is-active' ).index() > 0 ) _prev.trigger( 'click' );
                                }

                                //left
                                if ( e.pageX < origin_mouse_x ) {
                                    if ( $items.filter( '.is-active' ).index() < itemsTotal - 1 ) _next.trigger( 'click' );
                                }

                                //down
                                if ( e.pageY > origin_mouse_y ) {

                                }

                                //up
                                if ( e.pageY < origin_mouse_y ) {

                                }	

                                $dragDropTrigger.off( 'mouseup.ADVANCED_SLIDER' );

                            }	



                        }



                    } );//end: mouseup.ADVANCED_SLIDER touchmove.ADVANCED_SLIDER




                } );// end: mousedown.ADVANCED_SLIDER touchstart.ADVANCED_SLIDER

            }




            /*
             * Transition Between Slides
             *
             * @param  {Number} elementIndex     - Index of current slider.
             * @param  {Object} slider           - Selector of the slider .
             * @param  {String} dir              - Switching direction indicator.
             * @return {Void}
             */
            function sliderUpdates( elementIndex, slider, dir ) {

                var $items                   = slider.find( '.item' ),
                    $current                 = $items.eq( elementIndex ),
                    total                    = $items.length,
                    dataCountTotal           = slider.data( 'count-total' ),
                    dataCountCur             = slider.data( 'count-now' ),
                    dataControlsPagination   = slider.data( 'controls-pagination' ),
                    dataControlsArrows       = slider.data( 'controls-arrows' ),	
                    dataLoop                 = slider.data( 'loop' );

                //-----
                dataLoop = uix_slideshow_vars.animloop == 'true' ? true : false;


                if ( typeof dataCountTotal === typeof undefined ) dataCountTotal = 'p.count em.count';
                if ( typeof dataCountCur === typeof undefined ) dataCountCur = 'p.count em.current';
                if ( typeof dataControlsPagination === typeof undefined ) dataControlsPagination = '.my-a-slider-pagination-1';
                if ( typeof dataControlsArrows === typeof undefined || dataControlsArrows == false ) dataControlsArrows = '.my-a-slider-arrows-1';
                if ( typeof dataLoop === typeof undefined ) dataLoop = false;


                //Prevent bubbling
                if ( total == 1 ) {
                    $( dataControlsPagination ).hide();
                    $( dataControlsArrows ).hide();
                    return false;
                }



                //Transition Interception
                //-------------------------------------
                if ( dataLoop ) {
                    if ( elementIndex == total ) elementIndex = 0;
                    if ( elementIndex < 0 ) elementIndex = total-1;	
                } else {
                    $( dataControlsArrows ).find( 'a' ).removeClass( 'is-disabled' );
                    if ( elementIndex == total - 1 ) $( dataControlsArrows ).find( '.custom-slideshow-flexslider__arrows--next' ).addClass( 'is-disabled' );
                    if ( elementIndex == 0 ) $( dataControlsArrows ).find( '.custom-slideshow-flexslider__arrows--prev' ).addClass( 'is-disabled' );
                }

                // To determine if it is a touch screen.
                var isTouchCapable = 'ontouchstart' in window ||
                                    window.DocumentTouch && document instanceof window.DocumentTouch ||
                                    navigator.maxTouchPoints > 0 ||
                                    window.navigator.msMaxTouchPoints > 0;  
                
                if ( isTouchCapable ) {
                    if ( elementIndex == total ) elementIndex = total-1;
                    if ( elementIndex < 0 ) elementIndex = 0;	

                    //Prevent bubbling
                    if ( !dataLoop ) {
                        //first item
                        if ( elementIndex == 0 ) {
                            $( dataControlsArrows ).find( '.custom-slideshow-flexslider__arrows--prev' ).addClass( 'is-disabled' );
                        }

                        //last item
                        if ( elementIndex == total - 1 ) {
                            $( dataControlsArrows ).find( '.custom-slideshow-flexslider__arrows--next' ).addClass( 'is-disabled' );
                        }	
                    }


                }


                //Determine the direction and add class to switching direction indicator.
                var dirIndicatorClass = '';
                if ( dir == 'prev' ) dirIndicatorClass = 'prev';
                if ( dir == 'next' ) dirIndicatorClass = 'next';



                //Add transition class to Controls Pagination
                $( dataControlsPagination ).find( 'li a' ).removeClass( 'leave' );
                $( dataControlsPagination ).find( 'li a.is-active' ).removeClass( 'is-active' ).addClass( 'leave');
                $( dataControlsPagination ).find( 'li a[data-index="'+elementIndex+'"]' ).addClass( 'is-active').removeClass( 'leave' );

                //Add transition class to each item
                $items.removeClass( 'leave prev next' );
                $items.addClass( dirIndicatorClass );
                slider.find( '.item.is-active' ).removeClass( 'is-active' ).addClass( 'leave ' + dirIndicatorClass );
                $items.eq( elementIndex ).addClass( 'is-active ' + dirIndicatorClass ).removeClass( 'leave' );




                //Display counter
                //-------------------------------------
                $( dataCountTotal ).text( total );
                $( dataCountCur ).text( parseFloat( elementIndex ) + 1 );		


                //Reset the default height of item
                //-------------------------------------	
                itemDefaultInit( $current );		



            }

            /*
             * Initialize the default height of item
             *
             * @param  {Object} slider           - Current selector of each slider.
             * @return {Void}
             */
            function itemDefaultInit( slider ) {

                if ( slider.find( 'video' ).length > 0 ) {

                    //Returns the dimensions (intrinsic height and width ) of the video
                    var video    = document.getElementById( slider.find( 'video' ).attr( 'id' ) ),
                        videoURL = slider.find( 'source:first' ).attr( 'src' );

                    video.addEventListener( 'loadedmetadata', function( e ) {

                        $sliderWrapper.css( 'height', this.videoHeight*(slider.closest( '.custom-slideshow-flexslider' ).width()/this.videoWidth) + 'px' );	

                    }, false);	

                    video.src = videoURL;


                } else {

                    var imgURL   = slider.find( 'img' ).attr( 'src' );


                    if ( typeof imgURL != typeof undefined ) {
                        var img = new Image();

                        img.onload = function() {

                            $sliderWrapper.css( 'height', slider.closest( '.custom-slideshow-flexslider' ).width()*(this.height/this.width) + 'px' );		

                        };

                        img.src = imgURL;	
                    }



                }	



            }

            // loader will 'load' items by calling thingToDo for each item,
            // before calling allDone when all the things to do have been done.
            function loader(items, thingToDo, allDone) {
                if (!items) {
                    // nothing to do.
                    return;
                }

                if ("undefined" === items.length) {
                    // convert single item to array.
                    items = [items];
                }

                var count = items.length;

                // this callback counts down the things to do.
                var thingToDoCompleted = function (items, i) {
                    count--;
                    if (0 == count) {
                        allDone(items);
                    }
                };

                for (var i = 0; i < items.length; i++) {
                    // 'do' each thing, and await callback.
                    thingToDo(items, i, thingToDoCompleted);
                }
            }

            function loadImage(items, i, onComplete) {
                var onLoad = function (e) {
                    e.target.removeEventListener("load", onLoad);

                    // this next line can be removed.
                    // only here to prove the image was loaded.
                    document.body.appendChild(e.target);

                    // notify that we're done.
                    onComplete(items, i);
                }
                var img = new Image();
                img.addEventListener("load", onLoad, false);
                img.src = items[i];
                img.style.display = 'none';
            }	

		});
 
    };
 
}( jQuery ));






