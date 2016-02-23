(function( $ ) { 'use strict';
	// menu toggle

	$( '.menu-toggle' ).on( 'click', function() { 
		$( '.primary-menu nav .menu' ).toggle();
		var visible = $( '.primary-menu nav .menu' ).is( ':visible' );
		if ( visible ) {
			$(this).addClass( 'open' ).attr( 'aria-expanded', 'true' );
		} else {
			$(this).removeClass( 'open' ).attr( 'aria-expanded', 'false' );
		}
	} );
	
	var width = $( window ).width();
	
	if ( width < 800 ) {
		$( '.primary-menu nav ul' ).hide();
		$( '.primary-menu nav .sub-menu' ).hide();	
		$( '.primary-menu .menu-item-has-children > a' ).after( ' <button class="dropdown-toggle text-button" aria-expanded="false">' + milkyWay.expand + '</button> ' );
	}
	
	$( '.dropdown-toggle' ).on( 'click', function() {
		var visible = $( this ).next( '.sub-menu' ).is( ':visible' );
		console.log( $( this ).next( '.sub-menu' ) );
		if ( visible ) {
			$(this).attr( 'aria-expanded', 'false' );
			$(this).next( '.sub-menu' ).hide();
			$(this).html( milkyWay.expand );
		} else {
			$(this).attr( 'aria-expanded', 'true' );
			$(this).next( '.sub-menu' ).show();
			$(this).html( milkyWay.close );
		}
	});	
	
	if ( window.innerWidth > 800 ) {
		$( window ).resize(function() {
			if ( $(this).width() != width ) {
				var width = $( this ).width();
				if ( width <= 800 ) {
					$( '.primary-menu nav .menu').hide();
				} else {
					$( '.primary-menu nav .menu').show();
				}
			}
		});
	}
	
	$('.menu-item a').on('keydown', function(e) {

		// left key
		if(e.which === 37) {
			e.preventDefault();
			$(this).parent().prev().children('a').focus();
		}
		// right key
		else if(e.which === 39) {
			e.preventDefault();
			$(this).parent().next().children('a').focus();
		}
		// down key
		else if(e.which === 40) {
			e.preventDefault();
			if($(this).next().length){
				$(this).next().find('li:first-child a').first().focus();
			} else {
				$(this).parent().next().children('a').focus();
			}
		}
		// up key
		else if(e.which === 38) {
			e.preventDefault();
			if($(this).parent().prev().length){
				$(this).parent().prev().children('a').focus();
			}
			else {
				$(this).parents('ul').first().prev('a').focus();
			}
		}

	});

}(jQuery));