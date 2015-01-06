<div class="page-header">
	<h1>Add Film or Event</h1>
</div>
<?php
    $attributes = array(
    	'role'  => 'form'
    );
    echo form_open_multipart('admin/filmsevents/add', $attributes);
?>

	<div class="row">

		<div class="col-sm-10">

			<div class="form-group <?php if (form_error('type') !== '') echo 'has-error has-feedback'; ?>">
				<div class="btn-group btn-group-justified" data-toggle="buttons">
					<label class="btn btn-default active">
						<input type="radio" id="film" name="type" value="film" checked> Film
					</label>
					<label class="btn btn-default">
						<input type="radio" id="event" name="type" value="event"> Event
					</label>
				</div>
			</div>
			<div class="form-group <?php if (form_error('title') !== '') echo 'has-error has-feedback'; ?>">
			    <label class="sr-only" for="title">Title</label>
			    <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="<?php echo set_value('title'); ?>">
			    <?php if (form_error('title') !== '') { ?>
					<span class="icon icon-alert form-control-feedback"></span>
				<?php } ?>
			</div>
			<div class="form-group <?php if (form_error('slug') !== '') echo 'has-error has-feedback'; ?>">
				<?php echo form_error('slug', '<div class="alert alert-warning">', '</div>'); ?>
				<label class="sr-only" for="slug">Slug</label>
				<div class="input-group input-group-sm">
					<span class="input-group-addon">birthplaceofcinema.com/filmsevents/</span>
					<input type="text" id="slug" class="form-control" name="slug" value="<?php echo set_value('slug'); ?>">
					<?php if (form_error('slug') !== '') { ?>
						<span class="icon icon-alert form-control-feedback"></span>
					<?php } ?>
				</div>
			</div>
			<div class="form-group <?php if (form_error('description') !== '') echo 'has-error has-feedback'; ?>">
			    <textarea id="description" class="form-control" name="description" rows="10" placeholder="Description"><?php echo set_value('description'); ?></textarea>
			    <?php if (form_error('description') !== '') { ?>
					<span class="icon icon-alert form-control-feedback"></span>
				<?php } ?>
			</div>
			<div class="form-group">
				<label for="userfile_poster">Poster Image</label>
				<?php if (isset($error_poster)) { ?>
					<div class="alert alert-danger">
						<p><?php echo $error_poster; ?></p>
					</div>
				<?php } ?>
				<input type="file" id="userfile_poster" class="form-control" name="userfile_poster" value="<?php echo set_value('userfile_poster'); ?>">
			</div>
			<div class="form-group">
				<label for="userfile_promo_iphone">Promo iPhone Image</label>
				<?php if (isset($error_promo_iphone)) { ?>
					<div class="alert alert-danger">
						<p><?php echo $error_promo_iphone; ?></p>
					</div>
				<?php } ?>
				<input type="file" id="userfile_promo_iphone" class="form-control" name="userfile_promo_iphone" value="<?php echo set_value('userfile_promo_iphone'); ?>">
			</div>
			<div class="form-group">
				<label for="userfile_promo_ipad">Promo iPad Image</label>
				<?php if (isset($error_promo_ipad)) { ?>
					<div class="alert alert-danger">
						<p><?php echo $error_promo_ipad; ?></p>
					</div>
				<?php } ?>
				<input type="file" id="userfile_promo_ipad" class="form-control" name="userfile_promo_ipad" value="<?php echo set_value('userfile_promo_ipad'); ?>">
			</div>

		</div>

		<div class="col-sm-2">

			<div class="form-group">
				<button type="submit" class="btn btn-block btn-primary">Save</button>
			</div>

		</div>

	</div>

<?php echo form_close(); ?>