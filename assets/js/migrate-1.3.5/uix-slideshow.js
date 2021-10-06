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
			
				 var $this     = $( this );
                
                $this.UixSlideshow({
                    
                    //Get parameter configuration from the data-* attribute of HTML
                    auto              : ( uix_slideshow_vars.auto == 'true' ) ? true : false,
                    timing            : uix_slideshow_vars.speed,
                    loop              : ( uix_slideshow_vars.animloop == 'true' ) ? true : false,
                    countTotalID      : 'p.count em.count',
                    countCurID        : 'p.count em.current',
                    paginationID      : uix_slideshow_vars.paging_nav,
                    arrowsID          : uix_slideshow_vars.arr_nav,
                    draggable         : ( uix_slideshow_vars.draggable == 'true' ) ? true : false,
                    draggableCursor   : 'move'
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
			 $( '.custom-slideshow-flexslider-custom-button' ).each( function(){

			
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
 * @param  {Boolean} auto                  - Setup a slideshow for the slider to animate automatically.
 * @param  {Number} timing                 - Autoplay interval.
 * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop.
 * @param  {String} countTotalID           - Total number ID or class of counter.
 * @param  {String} countCurID             - Current number ID or class of counter.
 * @param  {Boolean} paginationID          - Navigation ID for paging control of each slide.
 * @param  {Boolean} arrowsID              - Previous/Next arrow navigation ID.
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
            paginationID      : true,
            arrowsID          : true,
            draggable         : false,
            draggableCursor   : 'move'
        }, options );
 
 
        this.each( function() {
			
			
            var $window                   = $( window ),
                windowWidth               = window.innerWidth,
                windowHeight              = window.innerHeight,
                animDelay                 = 0,
                $sliderWrapper            = $( this );

            // To determine if it is a touch screen.
            var isTouchCapable = 'ontouchstart' in window ||
                                window.DocumentTouch && document instanceof window.DocumentTouch ||
                                window.navigator.maxTouchPoints > 0;  

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
            function sliderInit(resize) {

                var $items = $sliderWrapper.find('.item'),
                    $first = $items.first(),
                    nativeItemW,
                    nativeItemH,
                    activated = $sliderWrapper.data('activated');



                if (typeof activated === typeof undefined || activated === 0) {

                    var dataAuto = settings.auto,
                        dataTiming = settings.timing,
                        dataLoop = settings.loop,
                        dataControlsPagination = (settings.paginationID == 'true') ? '.my-a-slider-pagination-1' : '',
                        dataControlsArrows = (settings.arrowsID == 'true') ? '.my-a-slider-arrows-1' : '',
                        dataDraggable = settings.draggable,
                        dataDraggableCursor = settings.draggableCursor,
                        dataCountTotal = settings.countTotalID,
                        dataCountCur = settings.countCurID;


                    if (typeof dataAuto === typeof undefined) dataAuto = false;
                    if (typeof dataTiming === typeof undefined) dataTiming = 10000;
                    if (typeof dataLoop === typeof undefined) dataLoop = false;
                    if (typeof dataDraggable === typeof undefined) dataDraggable = false;
                    if (typeof dataDraggableCursor === typeof undefined || dataDraggableCursor == false) dataDraggableCursor = 'move';
                    if (typeof dataCountTotal === typeof undefined) dataCountTotal = 'p.count em.count';
                    if (typeof dataCountCur === typeof undefined) dataCountCur = 'p.count em.current';



                    //------
                    var prevTxt = uix_slideshow_vars.prev_txt;
                    var nextTxt = uix_slideshow_vars.next_txt;
                    var eff = uix_slideshow_vars.animation;

                    $sliderWrapper.wrap('<div class="custom-slideshow-flexslider__wrapper"></div>');


                    $sliderWrapper.addClass('custom-slideshow-flexslider--eff-' + eff);

                    if (settings.paginationID == 'true') {
                        $('<div class="custom-slideshow-flexslider__pagination my-a-slider-pagination-1"></div>').insertAfter($sliderWrapper);
                    }
                    if (settings.arrowsID == 'true') {
                        $('<div class="custom-slideshow-flexslider__arrows my-a-slider-arrows-1"><a href="#" class="custom-slideshow-flexslider__arrows--prev">' + prevTxt + '</a><a href="#" class="custom-slideshow-flexslider__arrows--next">' + nextTxt + '</a></div>').insertAfter($sliderWrapper);
                    }



                    //Images loaded
                    //-------------------------------------	
                    var images = [];
                    $items.each(function () {
                        var imgURL = $(this).find('img').attr('src');
                        if (typeof imgURL != typeof undefined) {
                            images.push(imgURL);
                        }
                    });

                    loader(images, loadImage, function () {
                        $sliderWrapper.addClass('is-loaded');
                    });



                    //Autoplay times
                    var playTimes;
                    //A function called "timer" once every second (like a digital watch).
                    $sliderWrapper[0].animatedSlides;


                    setTimeout(function () {

                        //The speed of movement between elements.
                        // Avoid the error that getTransitionDuration takes 0
                        animDelay = getTransitionDuration($first[0]);

                    }, 100);



                    //Initialize the first item container
                    //-------------------------------------		
                    $items.addClass('next');
                    setTimeout(function () {
                        $first.addClass('is-active');
                    }, animDelay);


                    if ($first.find('video').length > 0) {

                        //Returns the dimensions (intrinsic height and width ) of the video
                        var video = document.getElementById($first.find('video').attr('id')),
                            videoURL = $first.find('source:first').attr('src');

                        video.addEventListener('loadedmetadata', function (e) {
                            $sliderWrapper.css('height', this.videoHeight * ($sliderWrapper.width() / this.videoWidth) + 'px');

                            nativeItemW = this.videoWidth;
                            nativeItemH = this.videoHeight;

                            //Initialize all the items to the stage
                            addItemsToStage($sliderWrapper, nativeItemW, nativeItemH, dataControlsPagination, dataControlsArrows, dataLoop, dataDraggable, dataDraggableCursor, dataCountTotal, dataCountCur);

                        }, false);

                        video.src = videoURL;


                    } else {

                        var imgURL = $first.find('img').attr('src');

                        if (typeof imgURL != typeof undefined) {
                            var img = new Image();

                            img.onload = function () {
                                $sliderWrapper.css('height', $sliderWrapper.width() * (this.height / this.width) + 'px');

                                nativeItemW = this.width;
                                nativeItemH = this.height;

                                //Initialize all the items to the stage
                                addItemsToStage($sliderWrapper, nativeItemW, nativeItemH, dataControlsPagination, dataControlsArrows, dataLoop, dataDraggable, dataDraggableCursor, dataCountTotal, dataCountCur);

                            };

                            img.src = imgURL;
                        }



                    }



                    //Autoplay Slider
                    //-------------------------------------		
                    if (!resize) {


                        if (dataAuto && !isNaN(parseFloat(dataTiming)) && isFinite(dataTiming)) {

                            sliderAutoPlay(playTimes, dataTiming, dataLoop, $sliderWrapper, dataCountTotal, dataCountCur, dataControlsPagination, dataControlsArrows);

							const autoplayEnter = function() {
								clearInterval($sliderWrapper[0].animatedSlides);
							};
		
							const autoplayLeave = function() {
								sliderAutoPlay(playTimes, dataTiming, dataLoop, $sliderWrapper, dataCountTotal, dataCountCur, dataControlsPagination, dataControlsArrows);
							};
		
							// Do not use the `off()` method, otherwise it will cause the second mouseenter to be invalid
							$sliderWrapper.on( 'mouseenter', autoplayEnter );
							$sliderWrapper.on( 'mouseleave', autoplayLeave );  

							// To determine if it is a touch screen.
							if (isTouchCapable) {
								$sliderWrapper.on( 'pointerenter', autoplayEnter );
								$sliderWrapper.on( 'pointerleave', autoplayLeave );  
							}

                        }


                    }

                    //Prevents front-end javascripts that are activated with AJAX to repeat loading.
                    $sliderWrapper.data('activated', 1);

                }//endif activated



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
             * @param  {Boolean} paginationID           - Navigation ID for paging control of each slide.
             * @param  {Boolean} arrowsID               - Previous/Next arrow navigation ID.
             * @return {Void}                          - The constructor.
             */
            function sliderAutoPlay( playTimes, timing, loop, slider, countTotalID, countCurID, paginationID, arrowsID ) {	

                var items = slider.find( '.item' ),
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
             * @param  {Boolean} paginationID           - Navigation ID for paging control of each slide.
             * @param  {Boolean} arrowsID               - Previous/Next arrow navigation ID.
             * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop. 
             * @param  {Boolean} draggable             - Allow drag and drop on the slider.
             * @param  {String} draggableCursor        - Drag & Drop Change icon/cursor while dragging.
             * @param  {String} countTotalID           - Total number ID or class of counter.
             * @param  {String} countCurID             - Current number ID or class of counter.
             * @return {Void}
             */
            function addItemsToStage( slider, nativeItemW, nativeItemH, paginationID, arrowsID, loop, draggable, draggableCursor, countTotalID, countCurID ) {

                var $this                    = slider,
                    $items                   = $this.find( '.item' ),
                    $first                   = $items.first(),
                    itemsTotal               = $items.length;


                //If arrows does not exist on the page, it will be added by default, 
                //and the drag and drop function will be activated.
                if ( $( arrowsID ).length == 0 ) {
                    $( 'body' ).prepend( '<div style="display:none;" class="uix-slideshow__arrows '+arrowsID.replace('#','').replace('.','')+'"><a href="#" class="custom-slideshow-flexslider__arrows--prev"></a><a href="#" class="custom-slideshow-flexslider__arrows--next"></a></div>' );
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

                    _dot += '<li><a '+_dotActive+' data-index="'+i+'" href="#"></a></li>';
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
                var _prev = $( arrowsID ).find( '.custom-slideshow-flexslider__arrows--prev' ),
                    _next = $( arrowsID ).find( '.custom-slideshow-flexslider__arrows--next' );

                $( arrowsID ).find( 'a' ).attr( 'href', '#' );

                $( arrowsID ).find( 'a' ).removeClass( 'is-disabled' );
                if ( !loop ) {
                    _prev.addClass( 'is-disabled' );
                }



                _prev.off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();
    
                    //Pause the auto play event
                    clearInterval( $this[0].animatedSlides );
    
                    //Move animation
                    prevMove();
                });
    
                _next.off( 'click' ).on( 'click', function( e ) {
                    e.preventDefault();
    
                    //Pause the auto play event
                    clearInterval( $this[0].animatedSlides );
    
                    //Move animation
                    nextMove();
                });
    
                
                function prevMove() {
                    //Prevent buttons' events from firing multiple times
                    if ( _prev.attr( 'aria-disabled' ) == 'true' ) return false;
                    _prev.attr( 'aria-disabled', 'true' );
                    setTimeout( function() {
                        _prev.attr( 'aria-disabled', 'false' );
                    }, animDelay );
                    
    
                    //
                    if ( _prev.hasClass( 'is-disabled' ) ) return false;
                    
                    //
                    sliderUpdates( parseFloat( $items.filter( '.is-active' ).index() ) - 1, $this, 'prev', countTotalID, countCurID, paginationID, arrowsID, loop );
    
                }
                
                function nextMove() {
                    //Prevent buttons' events from firing multiple times
                    if ( _next.attr( 'aria-disabled' ) == 'true' ) return false;
                    _next.attr( 'aria-disabled', 'true' );
                    setTimeout( function() {
                        _next.attr( 'aria-disabled', 'false' );
                    }, animDelay );
                    
    
                    //
                    if ( _next.hasClass( 'is-disabled' ) ) return false;
    
                    //
                    sliderUpdates( parseFloat( $items.filter( '.is-active' ).index() ) + 1, $this, 'next', countTotalID, countCurID, paginationID, arrowsID, loop );
                } 
                
                //Added touch method to mobile device and desktop
                //-------------------------------------	
                const $dragTrigger = $this.find( '.custom-slideshow-slides' );
                let mouseX, mouseY;
                let isMoving = false;
                
                //Avoid images causing mouseup to fail
                $dragTrigger.find( 'img' ).css({
                    'pointer-events': 'none',
                    'user-select': 'none'
                });
                
                
                //Make the cursor a move icon when a user hovers over an item
                if ( draggable && draggableCursor != '' && draggableCursor != false ) $dragTrigger.css( 'cursor', draggableCursor );
                
                
                $dragTrigger[0].removeEventListener( 'mousedown', dragStart );
                document.removeEventListener( 'mouseup', dragEnd );
                
                $dragTrigger[0].removeEventListener( 'touchstart', dragStart );
                document.removeEventListener( 'touchend', dragEnd );
                
                
                //
                $dragTrigger[0].addEventListener( 'mousedown', dragStart );
                $dragTrigger[0].addEventListener( 'touchstart', dragStart );
                
                
                function dragStart(e) {
                    //Do not use "e.preventDefault()" to avoid prevention page scroll on drag in IOS and Android
                    const touches = e.touches;
                
                    if ( touches && touches.length ) {	
                        mouseX = touches[0].clientX;
                        mouseY = touches[0].clientY;
                    } else {
                        mouseX = e.clientX;
                        mouseY = e.clientY;
                    } 
                
                    document.addEventListener( 'mouseup', dragEnd );
                    document.addEventListener( 'mousemove', dragProcess );
                
                    document.addEventListener( 'touchend', dragEnd );
                    document.addEventListener( 'touchmove', dragProcess ); 
                
                }
                
                function dragProcess(e) {
                
                    const touches = e.touches;
                    let offsetX, offsetY;
                
                
                    if ( touches && touches.length ) {	
                        offsetX = mouseX - touches[0].clientX,
                        offsetY = mouseY - touches[0].clientY;
                    } else {
                        offsetX = mouseX - e.clientX,
                        offsetY = mouseY - e.clientY;
                    } 
                
                
                    //--- left
                    if ( offsetX >= 50) {
                        if ( draggable || ( touches && touches.length ) ) {
                            if ( !isMoving ) {
                                isMoving = true;
                                nextMove();
                            }
                        }
                    }
                
                    //--- right
                    if ( offsetX <= -50) {
                        if ( draggable || ( touches && touches.length ) ) {
                            if ( !isMoving ) {
                                isMoving = true;
                                prevMove();
                            }
                        }
                    }
                
                    //--- up
                    if ( offsetY >= 50) { 
                
                    }
                
                    //--- down
                    if ( offsetY <= -50) {
                
                    }
                }
                
                function dragEnd(e) {
                    document.removeEventListener( 'mousemove', dragProcess);
                    document.removeEventListener( 'touchmove', dragProcess);
                
                    //restore move action status
                    setTimeout( function() {
                        isMoving = false;
                    }, animDelay);
                }
    

            }




            /*
             * Transition Between Slides
             *
             * @param  {Number} elementIndex           - Index of current slider.
             * @param  {Object} slider                 - Selector of the slider .
             * @param  {String} dir                    - Switching direction indicator.
             * @param  {String} countTotalID           - Total number ID or class of counter.
             * @param  {String} countCurID             - Current number ID or class of counter.
             * @param  {Boolean} paginationID           - Navigation ID for paging control of each slide.
             * @param  {Boolean} arrowsID               - Previous/Next arrow navigation ID.
             * @param  {Boolean} loop                  - Gives the slider a seamless infinite loop.
             * @return {Void}
             */
            function sliderUpdates( elementIndex, slider, dir, countTotalID, countCurID, paginationID, arrowsID, loop ) {

                var $items                   = slider.find( '.item' ),
                    $current                 = $items.eq( elementIndex ),
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
                    if ( elementIndex == total - 1 ) $( arrowsID ).find( '.custom-slideshow-flexslider__arrows--next' ).addClass( 'is-disabled' );
                    if ( elementIndex == 0 ) $( arrowsID ).find( '.custom-slideshow-flexslider__arrows--prev' ).addClass( 'is-disabled' );
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
                            $( arrowsID ).find( '.custom-slideshow-flexslider__arrows--prev' ).addClass( 'is-disabled' );
                        }

                        //last item
                        if ( elementIndex == total - 1 ) {
                            $( arrowsID ).find( '.custom-slideshow-flexslider__arrows--next' ).addClass( 'is-disabled' );
                        }	
                    }


                }


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
                slider.find( '.item.is-active' ).removeClass( 'is-active' ).addClass( 'leave ' + dirIndicatorClass );
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

                    video.addEventListener( 'loadedmetadata', function( e ) {

                        slider.css( 'height', this.videoHeight*(currentLlement.closest( '.custom-slideshow-flexslider' ).width()/this.videoWidth) + 'px' );	

                    }, false);	

                    video.src = videoURL;


                } else {

                    var imgURL   = currentLlement.find( 'img' ).attr( 'src' );


                    if ( typeof imgURL != typeof undefined ) {
                        var img = new Image();

                        img.onload = function() {

                            slider.css( 'height', currentLlement.closest( '.custom-slideshow-flexslider' ).width()*(this.height/this.width) + 'px' );		

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





