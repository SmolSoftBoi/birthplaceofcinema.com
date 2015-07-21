<div class="page-header">
	<h1>Edit <?php echo $filmevent_item['title'] ?> Times <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/add'); ?>">Add Film or Event</a> <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/addtime/' . $filmevent_item['filmevent_id']); ?>">Add <?php if ($filmevent_item['type_slug'] == 'film') { echo 'Film'; } else if ($filmevent_item['type_slug'] == 'event') { echo 'Event'; } ?> Time</a><?php if ($filmevent_item['type_slug'] == 'film') { ?> <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/addtrailer/' . $filmevent_item['filmevent_id']); ?>">Add <?php if ($filmevent_item['type_slug'] == 'film') { echo 'Film'; } else if ($filmevent_item['type_slug'] == 'event') { echo 'Event'; } ?> Trailer</a><?php } ?></h1>
</div>
<?php if (isset($filmevent_times)) { ?>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Date</th>
					<th>Time</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($filmevent_times as $filmevent_time_item) { ?>
				<tr>
					<td><?php echo date('l, j F Y', strtotime($filmevent_time_item['datetime'])); ?></td>
					<td><?php echo date('g:i a', strtotime($filmevent_time_item['datetime'])); ?></td>
					<td>
						<a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/edittime/' . $filmevent_item['filmevent_id'] . '/' . $filmevent_time_item['filmevent_time_id']); ?>">Edit</a>
						<a class="btn btn-xs btn-danger" href="<?php echo site_url('admin/filmsevents/deletetime/' . $filmevent_item['filmevent_id'] . '/' . $filmevent_time_item['filmevent_time_id']); ?>">Delete</a>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
<?php } else { ?>
	<div class="alert alert-warning">
		<p class="lead">No <?php if ($filmevent_item['type_slug'] == 'film') { echo 'film'; } else if ($filmevent_item['type_slug'] == 'event') { echo 'event'; } ?> times.</p>
	</div>
<?php } ?>