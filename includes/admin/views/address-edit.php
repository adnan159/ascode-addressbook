<div class="wrap">  
	<h1 class="wp-heading-inline"><?php _e( 'Edit Addressbook', 'asscode-addressbook'); ?></h1>

	<?php if( isset( $_GET['address-updated']) ) { ?>
		<div class="notice notice-success">
			<p><?php _e( 'Address has been updated!!', 'asscode-addressbook' ); ?></p>
		</div>
	<?php } ?>

	<form method="post" action="">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="name"><?php _e( 'Name', 'asscode-addressbook' ); ?></label>
					</th>
					<td>
						<input type="text" name="name" id="name" class="regular-text" value="<?php echo esc_attr( $address->name ); ?>">
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="address"><?php _e( 'Address', 'asscode-addressbook' ); ?></label>
					</th>
					<td>
						<textarea type="text" name="address" id="address" class="regular-text"> <?php echo esc_attr( $address->address); ?> </textarea>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="contact"><?php _e( 'Contact', 'asscode-addressbook' ); ?></label>
					</th>
					<td>
						<input type="text" name="contact" id="contact" class="regular-text" value="<?php echo esc_attr( $address->phone ); ?>">
					</td>
				</tr>
			</tbody>			
		</table>

		<input type="hidden" name="id" value="<?php echo esc_attr( $address->id ); ?>">

		<?php wp_nonce_field('new-address'); ?>

		<?php submit_button( __( 'Update Address', 'asscode-addressbook' ), 'primary', 'submit_address'); ?>
	</form>
</div>