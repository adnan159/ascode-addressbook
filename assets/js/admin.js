;(function( $ ){

	$( 'table.wp-list-table.contacts' ).on( 'click', 'a.submitdelete', function( e ) {
		e.preventDefault();

		if( ! confirm( AsCodeUrl.confirm ) ) {
			return;
		}

		var self = $( this ),
			id = self.data('id');

		wp.ajax.send( 'ascode-delete-contact', {
			data: {
				id: id,
				_wpnonce: AsCodeUrl.nonce
			}
		})
		.done( function( response ) {

			self.closest('tr')
				.css('background-color', 'red' )
				.hide( 400, function(){
					$( this ).remove();
				});

		})
		.fail( function() {
			alert( AsCodeUrl.error );
		})
	});

})( jQuery );