<div class="ascode-enquery-form" id="ascode-enquery-form" > 

	<form action="" method="post">

		<div class="form-row">
			<label for="name"> <?php _e( 'Name', 'asscode-addressbook' ); ?></label>

			<input type="text" name="name" id="name" value="" required>
		</div>

		<div class="form-row">
			<label for="email"> <?php _e( 'Email', 'asscode-addressbook' ); ?></label>

			<input type="email" name="email" id="email" value="" required>			
		</div>

		<div class="form-row">
			<label for="message"> <?php _e( 'Message', 'asscode-addressbook' ); ?></label>

			<textarea type="text" name="message" id="message" value="" required ></textarea>			
		</div>

		<div class="form-row	">
			<?php wp_nonce_field( 'ascode-enquery-from-1' ); ?>

			<input type="submit" name="send_enquery" value="<?php _e('Send Enquery', 'asscode-addressbook' ); ?>">	
		</div>
		
	</form>
	
</div>