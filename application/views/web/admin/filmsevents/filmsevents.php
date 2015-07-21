<div class="page-header">
	<h1>Films & Events <a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/add'); ?>">Add Film or Event</a></h1>
</div>
<?php if (isset($filmsevents)) { ?>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Title</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($filmsevents as $filmevent_item) { ?>
				<tr>
					<td><?php echo $filmevent_item['title']; ?></td>
					<td>
						<a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/edit/' . $filmevent_item['filmevent_id']); ?>">Edit</a>
						<a class="btn btn-xs btn-default" href="<?php echo site_url('admin/filmsevents/times/' . $filmevent_item['filmevent_id']); ?>">Times</a>
						<a class="btn btn-xs btn-default <?php if ($filmevent_item['type_slug'] != 'film') echo 'invisible'; ?>" href="<?php echo site_url('admin/filmsevents/trailers/' . $filmevent_item['filmevent_id']); ?>">Trailers</a>
						<a class="btn btn-xs btn-danger" href="<?php echo site_url('admin/filmsevents/delete/' . $filmevent_item['filmevent_id']); ?>">Delete</a>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
<?php } else { ?>
	<div class="alert alert-warning">
		<p class="lead">No films or events.</p>
	</div>
<?php } ?>