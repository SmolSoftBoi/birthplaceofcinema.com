<div class="page-header">
	<h1>Favourites</h1>
</div>
<?php if (isset($sent)) if ($sent) { ?>
	<div class="alert alert-success">
		<p class="lead">Favourites sent.</p>
	</div>
<?php } ?>
<?php if (isset($users)) if ($users) { ?>
	<a href="<?php echo base_url('admin/favorites/send'); ?>" class="btn btn-block btn-primary">Send</a>
<?php } else { ?>
	<div class="alert alert-warning">
		<p class="lead">No users to send to.</p>
	</div>
<?php } ?>