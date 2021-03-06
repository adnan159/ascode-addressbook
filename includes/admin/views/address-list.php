<div class="wrap">  
	<h1 class="wp-heading-inline"><?php _e( 'Addressbook', 'asscode-addressbook'); ?></h1>

	<?php if( isset( $_GET['inserted']) ) { ?>
		<div class="notice notice-success">
			<p><?php _e( 'Address has been added successfully', 'asscode-addressbook' ); ?></p>
		</div>
	<?php } ?>

	<a class="page-title-action" href="<?php echo admin_url( 'admin.php?page=ascode-addressbook-home&action=new' ); ?>"> <?php _e( 'Add New', 'asscode-addressbook' ); ?> </a>

	<form action="" method="post">
		<?php
		$table = new AsCode\Addressbook\Admin\Address_List();
		$table->prepare_items();
		$table->display();
		?>
	</form>
</div>