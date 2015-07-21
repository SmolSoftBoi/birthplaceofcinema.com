<div class="page-header">
	<h1>Edit <?php echo $filmevent_item['title']; ?> <?php echo $film_trailer_item['title']; ?></h1>
</div>
<?php
    $attributes = array(
    	'role'  => 'form'
    );
    echo form_open_multipart('admin/filmsevents/edittrailer/' . $filmevent_item['filmevent_id'] . '/' . $film_trailer_item['film_trailer_id'], $attributes);
?>

	<div class="row">

		<div class="col-sm-10">

			<div class="form-group <?php if (form_error('title') !== '') echo 'has-error has-feedback'; ?>">
			    <label class="sr-only" for="title">Title</label>
			    <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="<?php echo set_value('title', $film_trailer_item['title']); ?>">
			    <?php if (form_error('title') !== '') { ?>
					<span class="icon icon-alert form-control-feedback"></span>
				<?php } ?>
			</div>
			<div class="form-group <?php if (form_error('slug') !== '') echo 'has-error has-feedback'; ?>">
				<?php echo form_error('slug', '<div class="alert alert-warning">', '</div>'); ?>
				<label class="sr-only" for="slug">Slug</label>
				<div class="input-group input-group-sm">
					<span class="input-group-addon">birthplaceofcinema.com/filmsevents/<?php echo $filmevent_item['slug']; ?>/</span>
					<input type="text" id="slug" class="form-control" name="slug" value="<?php echo set_value('slug', $film_trailer_item['slug']); ?>">
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

			<?php if ($film_trailer_item['placeholder_media_loc'] !== '') { ?>
				<div class="form-group">
					<img src="<?php echo base_url('media/' . $film_trailer_item['placeholder_media_loc']); ?>" class="img-thumbnail" alt="<?php echo $film_trailer_item['title']; ?>">
				</div>
			<?php } ?>
			<div class="form-group">
				<button type="submit" class="btn btn-block btn-primary">Save</button>
				<a class="btn btn-block btn-danger" href="<?php echo site_url('admin/filmsevents/deletetrailer/' . $filmevent_item['filmevent_id'] . '/' . $film_trailer_item['film_trailer_id']); ?>">Delete</a>
			</div>
			<div class="form-group">
				<p><?php
					if (is_null($film_trailer_item['u_date'])) {
						echo date('j F Y g:i a', strtotime($film_trailer_item['c_date']));
					} else {
						echo date('j F Y g:i a', strtotime($film_trailer_item['u_date']));
					}
				?></p>
			</div>

		</div>

	</div>

<?php echo form_close(); ?>