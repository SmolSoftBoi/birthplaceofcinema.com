<div class="page-header">
	<h1>Edit <?php echo $filmevent_item['title'] ?> <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/add'); ?>">Add Film or Event</a> <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/addtime/' . $filmevent_item['filmevent_id']); ?>">Add <?php if ($filmevent_item['type_slug'] == 'film') { echo 'Film'; } else if ($filmevent_item['type_slug'] == 'event') { echo 'Event'; } ?> Time</a><?php if ($filmevent_item['type_slug'] == 'film') { ?> <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/addtrailer/' . $filmevent_item['filmevent_id']); ?>">Add <?php if ($filmevent_item['type_slug'] == 'film') { echo 'Film'; } else if ($filmevent_item['type_slug'] == 'event') { echo 'Event'; } ?> Trailer</a><?php } ?></h1>
</div>
<?php
    $attributes = array(
    	'role'  => 'form'
    );
    echo form_open_multipart('admin/filmsevents/edit/' . $filmevent_item['filmevent_id'], $attributes);
?>

	<div class="row">

		<div class="col-sm-10">

			<div class="form-group <?php if (form_error('title') !== '') echo 'has-error has-feedback'; ?>">
			    <label class="sr-only" for="title">Title</label>
			    <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="<?php echo set_value('title', $filmevent_item['title']); ?>">
			</div>
			<div class="form-group <?php if (form_error('slug') !== '') echo 'has-error has-feedback'; ?>">
				<?php echo form_error('slug', '<div class="alert alert-warning">', '</div>'); ?>
				<label class="sr-only" for="slug">Slug</label>
				<div class="input-group input-group-sm">
					<span class="input-group-addon">birthplaceofcinema.com/filmsevents/</span>
					<input type="text" id="slug" class="form-control" name="slug" value="<?php echo set_value('slug', $filmevent_item['slug']); ?>">
					<?php if (form_error('slug') !== '') { ?>
						<span class="icon icon-alert form-control-feedback"></span>
					<?php } ?>
				</div>
			</div>
			<div class="form-group <?php if (form_error('description') !== '') echo 'has-error has-feedback'; ?>">
			    <textarea id="description" class="form-control" name="description" rows="10" placeholder="Description"><?php echo set_value('description', nl2br_except_pre($filmevent_item['description'])); ?></textarea>
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

			<?php if ($filmevent_item['poster_media_loc'] !== '') { ?>
				<div class="form-group">
					<img src="<?php echo base_url('media/' . $filmevent_item['poster_media_loc']); ?>" class="img-thumbnail" alt="<?php echo $filmevent_item['title']; ?>">
				</div>
			<?php } ?>
			<div class="form-group">
				<button type="submit" class="btn btn-block btn-primary">Save</button>
				<a class="btn btn-block btn-default" href="<?php echo site_url('admin/filmsevents/times/' . $filmevent_item['filmevent_id']); ?>">Times</a>
				<?php if ($filmevent_item['type_slug'] == 'film') { ?>
					<a class="btn btn-block btn-default" href="<?php echo site_url('admin/filmsevents/trailers/' . $filmevent_item['filmevent_id']); ?>">Trailers</a>
				<?php } ?>
				<a class="btn btn-block btn-danger" href="<?php echo site_url('admin/filmsevents/delete/' . $filmevent_item['filmevent_id']); ?>">Delete</a>
			</div>
			<div class="form-group">
				<p><?php
					if (is_null($filmevent_item['u_date'])) {
						echo date('j F Y g:i a', strtotime($filmevent_item['c_date']));
					} else {
						echo date('j F Y g:i a', strtotime($filmevent_item['u_date']));
					}
				?></p>
			</div>

		</div>

	</div>

<?php echo form_close(); ?>