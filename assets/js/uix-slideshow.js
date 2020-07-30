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
			
				 var $this     = $( this );
                
                $this.UixSlideshow({
                    
                    //Get parameter configuration from the data-* attribute of HTML
                    auto              : $this.data( 'auto' ),
                    timing            : $this.data( 'timing' ),
                    loop              : $this.data( 'loop' ),
                    countTotalID      : $this.data( 'count-total' ),
                    countCurID        : $this.data( 'count-now' ),
                    paginationID      : $this.data( 'controls-pagination' ),
                    arrowsID          : $this.data( 'controls-arrows' ),
                    draggable         : $this.data( 'draggable' ),
                    draggableCursor   : $this.data( 'draggable-cursor' )
                });

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
					defaultbg     = $this.data( 'default-bg' ),
                    defaultBorder = $this.data( 'default-border' );

				 
				if ( typeof activated === typeof undefined || activated === 0 ) {

				
					 if ( defaultbg != '' && typeof defaultbg !== typeof undefined ) {

						$this.css( {
							'background-color': defaultbg
						} );	 

					 }
                    
					 if ( defaultBorder != '' && typeof defaultBorder !== typeof undefined ) {

						$this.css( {
							'border-color'    : defaultBorder
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
 * @ Version 1.1 (July 30, 2020)
 *
 * @param  {Boolean} auto                  - Setup a slideshow for the slider to animate automatically.
 * @param  {Number} timing                 - Autoplay interval.
 * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop.
 * @param  {String} countTotalID           - Total number ID or class of counter.
 * @param  {String} countCurID             - Current number ID or class of counter.
 * @param  {String} paginationID           - Navigation ID for paging control of each slide.
 * @param  {String} arrowsID               - Previous/Next arrow navigation ID.
 * @param  {Boolean} draggable             - Allow drag and drop on the slider.
 * @param  {String} draggableCursor        - Drag & Drop Change icon/cursor while dragging.
 *
 *************************************
 */    
( function ( $ ) {
	'use strict';
    $.fn.UixSlideshow = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({
			auto              : false,
            timing            : 10000,
			loop              : false,
            countTotalID      : 'p.count em.count',
            countCurID        : 'p.count em.current',
            paginationID      : '.uix-advanced-slider__pagination',
            arrowsID          : '.uix-advanced-slider__arrows',
            draggable         : false,
            draggableCursor   : 'move'
        }, options );
 
 
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
             * Get the CSS animation/transition duration for a DOM element
             * Useful for matching CSS animations and JS events
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
                        $items                   = $this.find( '.uix-slideshow__item' ),
                        $first                   = $items.first(),
                        nativeItemW,
                        nativeItemH,
                        activated                = $this.data( 'activated' ); 
				
				
                
                    if ( typeof activated === typeof undefined || activated === 0 ) {
                        
                        var dataAuto                = settings.auto, 
                            dataTiming              = settings.timing, 
                            dataLoop                = settings.loop, 
                            dataControlsPagination  = settings.paginationID, 
                            dataControlsArrows      = settings.arrowsID,
                            dataDraggable           = settings.draggable,
                            dataDraggableCursor     = settings.draggableCursor,                     
                            dataCountTotal          = settings.countTotalID,
                            dataCountCur            = settings.countCurID;    

                        
                        if ( typeof dataAuto === typeof undefined ) dataAuto = false;	
                        if ( typeof dataTiming === typeof undefined ) dataTiming = 10000;
                        if ( typeof dataLoop === typeof undefined ) dataLoop = false; 
                        if ( typeof dataControlsPagination === typeof undefined ) dataControlsPagination = '.uix-advanced-slider__pagination';
                        if ( typeof dataControlsArrows === typeof undefined || dataControlsArrows == false ) dataControlsArrows = '.uix-advanced-slider__arrows';
                        if ( typeof dataDraggable === typeof undefined ) dataDraggable = false;
                        if ( typeof dataDraggableCursor === typeof undefined || dataDraggableCursor == false ) dataDraggableCursor = 'move';
                        if ( typeof dataCountTotal === typeof undefined ) dataCountTotal = 'p.count em.count';
                        if ( typeof dataCountCur === typeof undefined ) dataCountCur = 'p.count em.current';      

                        
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


                        setTimeout( function(){

                            //The speed of movement between elements.
                            // Avoid the error that getTransitionDuration takes 0
                            animDelay = getTransitionDuration( $first[0] );

                        }, 100 );  



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
                          
                            if ( typeof videoURL === typeof undefined ) videoURL = $first.find( 'video' ).attr( 'src' );
                            $first.find( 'video' ).css({
                                'width': $this.width() + 'px'
                            });
                            

                            video.addEventListener( 'loadedmetadata', function( e ) {
                                $this.css( 'height', this.videoHeight*($this.width()/this.videoWidth) + 'px' );	

                                nativeItemW = this.videoWidth;
                                nativeItemH = this.videoHeight;	

                                //Initialize all the items to the stage
                                addItemsToStage( $this, nativeItemW, nativeItemH, dataControlsPagination, dataControlsArrows, dataLoop, dataDraggable, dataDraggableCursor, dataCountTotal, dataCountCur );

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
                                    addItemsToStage( $this, nativeItemW, nativeItemH, dataControlsPagination, dataControlsArrows, dataLoop, dataDraggable, dataDraggableCursor, dataCountTotal, dataCountCur );

                                };

                                img.src = imgURL;
                            }



                        }	



                        //Autoplay Slider
                        //-------------------------------------		
                        if ( !resize ) {



                            if ( dataAuto && !isNaN( parseFloat( dataTiming ) ) && isFinite( dataTiming ) ) {

                                sliderAutoPlay( playTimes, dataTiming, dataLoop, $this, dataCountTotal, dataCountCur, dataControlsPagination, dataControlsArrows );

                                $this.on({
                                    mouseenter: function() {
                                        clearInterval( $this[0].animatedSlides );
                                    },
                                    mouseleave: function() {
                                        sliderAutoPlay( playTimes, dataTiming, dataLoop, $this, dataCountTotal, dataCountCur, dataControlsPagination, dataControlsArrows );
                                    }
                                });	

                            }


                        }   

                        //Prevents front-end javascripts that are activated with AJAX to repeat loading.
                        $this.data( 'activated', 1 );

                    }//endif activated
  
                    

                });


            }




            /*
             * Trigger slider autoplay
             *
             * @param  {Function} playTimes            - Number of times.
             * @param  {Number} timing                 - Autoplay interval.
             * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop.
             * @param  {Object} slider                 - Selector of the slider .
             * @param  {String} countTotalID           - Total number ID or class of counter.
             * @param  {String} countCurID             - Current number ID or class of counter.
             * @param  {String} paginationID           - Navigation ID for paging control of each slide.
             * @param  {String} arrowsID               - Previous/Next arrow navigation ID.
             * @return {Void}                          - The constructor.
             */
            function sliderAutoPlay( playTimes, timing, loop, slider, countTotalID, countCurID, paginationID, arrowsID ) {	

                var items = slider.find( '.uix-slideshow__item' ),
                    total = items.length;

                slider[0].animatedSlides = setInterval( function() {

                    playTimes = parseFloat( items.filter( '.is-active' ).index() );
                    playTimes++;


                    if ( !loop ) {
                        if ( playTimes < total && playTimes >= 0 ) sliderUpdates( playTimes, $sliderWrapper, 'next', countTotalID, countCurID, paginationID, arrowsID, loop );
                    } else {
                        if ( playTimes == total ) playTimes = 0;
                        if ( playTimes < 0 ) playTimes = total-1;		
                        sliderUpdates( playTimes, $sliderWrapper, 'next', countTotalID, countCurID, paginationID, arrowsID, loop );
                    }



                }, timing );	
            }




            /*
             * Initialize all the items to the stage
             *
             * @param  {Object} slider                 - Current selector of each slider.
             * @param  {Number} nativeItemW            - Returns the intrinsic width of the image/video.
             * @param  {Number} nativeItemH            - Returns the intrinsic height of the image/video.
             * @param  {String} paginationID           - Navigation ID for paging control of each slide.
             * @param  {String} arrowsID               - Previous/Next arrow navigation ID.
             * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop. 
             * @param  {Boolean} draggable             - Allow drag and drop on the slider.
             * @param  {String} draggableCursor        - Drag & Drop Change icon/cursor while dragging.
             * @param  {String} countTotalID           - Total number ID or class of counter.
             * @param  {String} countCurID             - Current number ID or class of counter.
             * @return {Void}
             */
            function addItemsToStage( slider, nativeItemW, nativeItemH, paginationID, arrowsID, loop, draggable, draggableCursor, countTotalID, countCurID ) {

                var $this                    = slider,
                    $items                   = $this.find( '.uix-slideshow__item' ),
                    $first                   = $items.first(),
                    itemsTotal               = $items.length;


                //If arrows does not exist on the page, it will be added by default, 
                //and the drag and drop function will be activated.
                if ( $( arrowsID ).length == 0 ) {
                    $( 'body' ).prepend( '<div style="display:none;" class="uix-slideshow__arrows '+arrowsID.replace('#','').replace('.','')+'"><a href="#" class="uix-slideshow__arrows--prev"></a><a href="#" class="uix-slideshow__arrows--next"></a></div>' );
                }



                //Prevent bubbling
                if ( itemsTotal == 1 ) {
                    $( paginationID ).hide();
                    $( arrowsID ).hide();
                }
                
                
                //Add identifiers for the first and last items
                $items.last().addClass( 'last' );
                $items.first().addClass( 'first' );



                //Pagination dots 
                //-------------------------------------	
                var _dot       = '',
                    _dotActive = '';
                _dot += '<ul>';
                for ( var i = 0; i < itemsTotal; i++ ) {

                    _dotActive = ( i == 0 ) ? 'class="is-active"' : '';

                    _dot += '<li><a '+_dotActive+' data-index="'+i+'" href="javascript:"></a></li>';
                }
                _dot += '</ul>';

                if ( $( paginationID ).html() == '' ) $( paginationID ).html( _dot );

                $( paginationID ).find( 'li a' ).off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();
                    
                    //Prevent buttons' events from firing multiple times
                    var $btn = $( this );
                    if ( $btn.attr( 'aria-disabled' ) == 'true' ) return false;
                    $( paginationID ).find( 'li a' ).attr( 'aria-disabled', 'true' );
                    setTimeout( function() {
                        $( paginationID ).find( 'li a' ).attr( 'aria-disabled', 'false' );
                    }, animDelay );
                    

                    if ( !$( this ).hasClass( 'is-active' ) ) {


                        //Determine the direction
                        var curDir = 'prev';
                        if ( $( this ).attr( 'data-index' ) > parseFloat( $items.filter( '.is-active' ).index() ) ) {
                            curDir = 'next';
                        }


                        sliderUpdates( $( this ).attr( 'data-index' ), $this, curDir, countTotalID, countCurID, paginationID, arrowsID, loop );

                        //Pause the auto play event
                        clearInterval( $this[0].animatedSlides );	
                    }



                });

                //Next/Prev buttons
                //-------------------------------------		
                var _prev = $( arrowsID ).find( '.uix-slideshow__arrows--prev' ),
                    _next = $( arrowsID ).find( '.uix-slideshow__arrows--next' );

                $( arrowsID ).find( 'a' ).attr( 'href', 'javascript:' );

                $( arrowsID ).find( 'a' ).removeClass( 'is-disabled' );
                if ( !loop ) {
                    _prev.addClass( 'is-disabled' );
                }


                _prev.off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();
                    
                    //Prevent buttons' events from firing multiple times
                    if ( _prev.attr( 'aria-disabled' ) == 'true' ) return false;
                    _prev.attr( 'aria-disabled', 'true' );
                    setTimeout( function() {
                        _prev.attr( 'aria-disabled', 'false' );
                    }, animDelay );
                    

                    sliderUpdates( parseFloat( $items.filter( '.is-active' ).index() ) - 1, $this, 'prev', countTotalID, countCurID, paginationID, arrowsID, loop );

                    //Pause the auto play event
                    clearInterval( $this[0].animatedSlides );

                });

                _next.off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();
                    
                    
                    //Prevent buttons' events from firing multiple times
                    if ( _next.attr( 'aria-disabled' ) == 'true' ) return false;
                   _next.attr( 'aria-disabled', 'true' );
                    setTimeout( function() {
                        _next.attr( 'aria-disabled', 'false' );
                    }, animDelay );
                    

                    sliderUpdates( parseFloat( $items.filter( '.is-active' ).index() ) + 1, $this, 'next', countTotalID, countCurID, paginationID, arrowsID, loop );


                    //Pause the auto play event
                    clearInterval( $this[0].animatedSlides );


                });



                //Added touch method to mobile device and desktop
                //-------------------------------------	
                var $dragDropTrigger = $items;


                //Make the cursor a move icon when a user hovers over an item
                if ( draggable && draggableCursor != '' && draggableCursor != false ) $dragDropTrigger.css( 'cursor', draggableCursor );


                //Mouse event
                $dragDropTrigger.on( 'mousedown.UIX_SLIDESHOW touchstart.UIX_SLIDESHOW', function( e ) {

                    //Do not use "e.preventDefault()" to avoid prevention page scroll on drag in IOS and Android

                    var touches = e.originalEvent.touches;

                    $( this ).addClass( 'is-dragging' );


                    if ( touches && touches.length ) {	
                        $( this ).data( 'origin_mouse_x', parseInt( touches[0].pageX ) );
                        $( this ).data( 'origin_mouse_y', parseInt( touches[0].pageY ) );

                    } else {

                        if ( draggable ) {
                            $( this ).data( 'origin_mouse_x', parseInt( e.pageX ) );
                            $( this ).data( 'origin_mouse_y', parseInt( e.pageY ) );	
                        }


                    }

                    $dragDropTrigger.on( 'mouseup.UIX_SLIDESHOW touchmove.UIX_SLIDESHOW', function( e ) {


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
                                $dragDropTrigger.off( 'touchmove.UIX_SLIDESHOW' );
                            }	


                        } else {


                            if ( draggable ) {
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

                                $dragDropTrigger.off( 'mouseup.UIX_SLIDESHOW' );

                            }	



                        }



                    } );//end: mouseup.UIX_SLIDESHOW touchmove.UIX_SLIDESHOW




                } );// end: mousedown.UIX_SLIDESHOW touchstart.UIX_SLIDESHOW

            }




            /*
             * Transition Between Slides
             *
             * @param  {Number} elementIndex           - Index of current slider.
             * @param  {Object} slider                 - Selector of the slider .
             * @param  {String} dir                    - Switching direction indicator.
             * @param  {String} countTotalID           - Total number ID or class of counter.
             * @param  {String} countCurID             - Current number ID or class of counter.
             * @param  {String} paginationID           - Navigation ID for paging control of each slide.
             * @param  {String} arrowsID               - Previous/Next arrow navigation ID.
             * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop.
             * @return {Void}
             */
            function sliderUpdates( elementIndex, slider, dir, countTotalID, countCurID, paginationID, arrowsID, loop ) {

                var $items                   = slider.find( '.uix-slideshow__item' ),
                    total                    = $items.length;



                //Prevent bubbling
                if ( total == 1 ) {
                    $( paginationID ).hide();
                    $( arrowsID ).hide();
                    return false;
                }



                //Transition Interception
                //-------------------------------------
                if ( loop ) {
                    if ( elementIndex == total ) elementIndex = 0;
                    if ( elementIndex < 0 ) elementIndex = total-1;	
                } else {
                    $( arrowsID ).find( 'a' ).removeClass( 'is-disabled' );
                    if ( elementIndex == total - 1 ) $( arrowsID ).find( '.uix-slideshow__arrows--next' ).addClass( 'is-disabled' );
                    if ( elementIndex == 0 ) $( arrowsID ).find( '.uix-slideshow__arrows--prev' ).addClass( 'is-disabled' );
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
                    if ( !loop ) {
                        //first item
                        if ( elementIndex == 0 ) {
                            $( arrowsID ).find( '.uix-slideshow__arrows--prev' ).addClass( 'is-disabled' );
                        }

                        //last item
                        if ( elementIndex == total - 1 ) {
                            $( arrowsID ).find( '.uix-slideshow__arrows--next' ).addClass( 'is-disabled' );
                        }	
                    }


                }
				

				// call the current item
				//-------------------------------------
				var $current = $items.eq( elementIndex );	



                //Determine the direction and add class to switching direction indicator.
                var dirIndicatorClass = '';
                if ( dir == 'prev' ) dirIndicatorClass = 'prev';
                if ( dir == 'next' ) dirIndicatorClass = 'next';



                //Add transition class to Controls Pagination
                $( paginationID ).find( 'li a' ).removeClass( 'leave' );
                $( paginationID ).find( 'li a.is-active' ).removeClass( 'is-active' ).addClass( 'leave');
                $( paginationID ).find( 'li a[data-index="'+elementIndex+'"]' ).addClass( 'is-active').removeClass( 'leave' );

                //Add transition class to each item
                $items.removeClass( 'leave prev next' );
                $items.addClass( dirIndicatorClass );
                slider.find( '.uix-slideshow__item.is-active' ).removeClass( 'is-active' ).addClass( 'leave ' + dirIndicatorClass );
                $items.eq( elementIndex ).addClass( 'is-active ' + dirIndicatorClass ).removeClass( 'leave' );




                //Display counter
                //-------------------------------------
                $( countTotalID ).text( total );
                $( countCurID ).text( parseFloat( elementIndex ) + 1 );		


                //Reset the default height of item
                //-------------------------------------	
                itemDefaultInit( slider, $current );		



            }

            /*
             * Initialize the default height of item
             *
             * @param  {Object} slider                 - Selector of the slider .
             * @param  {Object} currentLlement         - Current selector of each slider.
             * @return {Void}
             */
            function itemDefaultInit( slider, currentLlement ) {

                if ( currentLlement.find( 'video' ).length > 0 ) {

                    //Returns the dimensions (intrinsic height and width ) of the video
                    var video    = document.getElementById( currentLlement.find( 'video' ).attr( 'id' ) ),
                        videoURL = currentLlement.find( 'source:first' ).attr( 'src' );
                    
                    if ( typeof videoURL === typeof undefined ) videoURL = currentLlement.find( 'video' ).attr( 'src' );

                    currentLlement.find( 'video' ).css({
                        'width': currentLlement.closest( '.uix-slideshow__outline' ).width() + 'px'
                    });   
                    
                    
                    video.addEventListener( 'loadedmetadata', function( e ) {

                        slider.css( 'height', this.videoHeight*(currentLlement.closest( '.uix-slideshow__outline' ).width()/this.videoWidth) + 'px' );	

                    }, false);	

                    video.src = videoURL;


                } else {

                    var imgURL   = currentLlement.find( 'img' ).attr( 'src' );


                    if ( typeof imgURL != typeof undefined ) {
                        var img = new Image();

                        img.onload = function() {

                            slider.css( 'height', currentLlement.closest( '.uix-slideshow__outline' ).width()*(this.height/this.width) + 'px' );		

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






