<div class="page-header">
	<h1>Edit <?php echo $filmevent_item['title'] ?> Trailers <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/add'); ?>">Add Film or Event</a> <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/addtime/' . $filmevent_item['filmevent_id']); ?>">Add <?php if ($filmevent_item['type_slug'] == 'film') { echo 'Film'; } else if ($filmevent_item['type_slug'] == 'event') { echo 'Event'; } ?> Time</a><?php if ($filmevent_item['type_slug'] == 'film') { ?> <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/addtrailer/' . $filmevent_item['filmevent_id']); ?>">Add <?php if ($filmevent_item['type_slug'] == 'film') { echo 'Film'; } else if ($filmevent_item['type_slug'] == 'event') { echo 'Event'; } ?> Trailer</a><?php } ?></h1>
</div>
<?php if (isset($film_trailers)) { ?>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Title</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($film_trailers as $film_trailer_item) { ?>
				<tr>
					<td><?php echo $film_trailer_item['title']; ?></td>
					<td>
						<a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/edittrailer/' . $filmevent_item['filmevent_id'] . '/' . $film_trailer_item['film_trailer_id']); ?>">Edit</a>
						<a class="btn btn-xs btn-danger" href="<?php echo site_url('admin/filmsevents/deletetrailer/' . $filmevent_item['filmevent_id'] . '/' . $film_trailer_item['film_trailer_id']); ?>">Delete</a>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
<?php } else { ?>
	<div class="alert alert-warning">
		<p class="lead">No film trailers.</p>
	</div>
<?php } ?>