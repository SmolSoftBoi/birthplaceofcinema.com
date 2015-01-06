<div class="page-header">
	<h1>Newsletter</h1>
</div>
<?php if (isset($sent)) if ($sent) { ?>
	<div class="alert alert-success">
		<p class="lead">Newsletter sent.</p>
	</div>
<?php } ?>
<?php if (isset($users)) { ?>
	<?php
	    $attributes = array(
	    	'role'  => 'form'
	    );
	    echo form_open_multipart('admin/newsletter', $attributes);
	?>

		<div class="row">

			<div class="col-sm-10">

				<div class="form-group <?php if (form_error('subject') !== '') echo 'has-error has-feedback'; ?>">
					<label class="sr-only" for="subject">Subject</label>
					<input type="text" id="subject" class="form-control" name="subject" placeholder="Subject" value="<?php echo set_value('subject'); ?>">
					<?php if (form_error('subject') !== '') { ?>
						<span class="icon icon-alert form-control-feedback"></span>
					<?php } ?>
				</div>
				<div class="form-group <?php if (form_error('message') !== '') echo 'has-error has-feedback'; ?>">
				<textarea id="message" class="form-control" name="message" rows="10" placeholder="Message"><?php echo set_value('message'); ?></textarea>
					<?php if (form_error('message') !== '') { ?>
						<span class="icon icon-alert form-control-feedback"></span>
					<?php } ?>
				</div>

			</div>

			<div class="col-sm-2">

				<div class="form-group">
					<button type="submit" class="btn btn-block btn-primary">Send</button>
				</div>

			</div>

		</div>

	<?php echo form_close(); ?>
<?php } else { ?>
	<div class="alert alert-warning">
		<p class="lead">No users to send to.</p>
	</div>
<?php } ?>