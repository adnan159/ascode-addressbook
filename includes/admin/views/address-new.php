<div class="wrap">  
	<h1 class="wp-heading-inline"><?php _e( 'New Addressbook', 'asscode-addressbook'); ?></h1>

	<form method="post" action="">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="name"><?php _e( 'Name', 'asscode-addressbook' ); ?></label>
					</th>
					<td>
						<input type="text" name="name" id="name" class="regular-text">
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="address"><?php _e( 'Address', 'asscode-addressbook' ); ?></label>
					</th>
					<td>
						<textarea type="text" name="address" id="address" class="regular-text"></textarea>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="contact"><?php _e( 'Contact', 'asscode-addressbook' ); ?></label>
					</th>
					<td>
						<input type="text" name="contact" id="contact" class="regular-text">
					</td>
				</tr>
			</tbody>			
		</table>

		<?php wp_nonce_field('new-address'); ?>

		<?php submit_button( __( 'Submit', 'asscode-addressbook' ), 'primary', 'submit_address'); ?>
	</form>
</div>