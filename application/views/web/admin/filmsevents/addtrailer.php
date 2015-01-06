<div class="page-header">
	<h1>Add <?php echo $filmevent_item['title']; ?> Trailer</h1>
</div>
<?php
    $attributes = array(
    	'role'  => 'form'
    );
    echo form_open_multipart('admin/filmsevents/addtrailer/' . $filmevent_item['filmevent_id'], $attributes);
?>

	<div class="row">

		<div class="col-sm-10">

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
					<span class="input-group-addon">birthplaceofcinema.com/filmsevents/<?php echo $filmevent_item['slug']; ?>/</span>
					<input type="text" id="slug" class="form-control" name="slug" value="<?php echo set_value('slug'); ?>">
					<?php if (form_error('slug') !== '') { ?>
						<span class="icon icon-alert form-control-feedback"></span>
					<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label for="userfile_trailer">Trailer</label>
				<?php if (isset($error_trailer)) { ?>
					<div class="alert alert-danger">
						<p><?php echo $error_trailer; ?></p>
					</div>
				<?php } ?>
				<input type="file" id="userfile_trailer" class="form-control" name="userfile_trailer" value="<?php echo set_value('userfile_trailer'); ?>">
			</div>
			<div class="form-group">
				<label for="userfile_placeholder">Placeholder Image</label>
				<?php if (isset($error_placeholder)) { ?>
					<div class="alert alert-danger">
						<p><?php echo $error_placeholder; ?></p>
					</div>
				<?php } ?>
				<input type="file" id="userfile_placeholder" class="form-control" name="userfile_placeholder" value="<?php echo set_value('userfile_placeholder'); ?>">
			</div>

		</div>

		<div class="col-sm-2">

			<div class="form-group">
				<button type="submit" class="btn btn-block btn-primary">Save</button>
			</div>

		</div>

	</div>

<?php echo form_close(); ?>