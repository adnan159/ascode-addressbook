;(function( $ ) {

	$( '#ascode-enquery-form' ).on( 'submit', function( e ) {
		e.preventDefault();

		var fieldValue = $( this ).serialize();

		var data = {
			'action'	: 'ascode_enquery',
			'value'		: fieldValue
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post( AsCodeUrl.ajaxurl, data, function( response ) {
			if( response.success ) {
				console.log( response.success );
			} else {
				alert( response.data.message );
			}
		})
		.fail( function() {
			alert( AsCodeUrl.error );
		})
	})

})( jQuery );