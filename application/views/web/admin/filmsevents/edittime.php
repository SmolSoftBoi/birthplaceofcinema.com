<div class="page-header">
	<h1>Edit <?php echo $filmevent_item['title']; ?> Time</h1>
</div>
<?php
    $attributes = array(
    	'role'  => 'form'
    );
    echo form_open('admin/filmsevents/edittime/' . $filmevent_item['filmevent_id'] . '/' . $filmevent_time_item['filmevent_time_id'], $attributes);
?>

	<div class="row">

		<div class="col-sm-10">

			<div class="form-group col-xs-6 <?php if (form_error('date') !== '') echo 'has-error has-feedback'; ?>">
			    <label class="sr-only" for="title">Date</label>
			    <input type="date" id="date" class="form-control" name="date" placeholder="Date" value="<?php echo set_value('date', date('j M Y', strtotime($filmevent_time_item['datetime']))); ?>" min="<?php echo date('Y-m-d', now()); ?>" required autofocus>
			    <?php if (form_error('date') !== '') { ?>
					<span class="icon icon-alert form-control-feedback"></span>
				<?php } ?>
				<span class="help-block">Date in <var><?php echo date('j M Y', now()); ?></var> format.</span>
			</div>
			<div class="form-group col-xs-6 <?php if (form_error('time') !== '') echo 'has-error has-feedback'; ?>">
			    <label class="sr-only" for="title">Time</label>
			    <input type="time" id="time" class="form-control" name="time" placeholder="Time" value="<?php echo set_value('time', date('g:i a', strtotime($filmevent_time_item['datetime']))); ?>" required>
			    <?php if (form_error('time') !== '') { ?>
					<span class="icon icon-alert form-control-feedback"></span>
				<?php } ?>
				<span class="help-block">Time in <var><?php echo date('g:i a', now()); ?></var> format.</span>
			</div>

		</div>

		<div class="col-sm-2">

			<div class="form-group">
				<button type="submit" class="btn btn-block btn-primary">Save</button>
				<a class="btn btn-block btn-danger" href="<?php echo base_url('admin/filmsevents/deletetime/' . $filmevent_item['filmevent_id'] . '/' . $filmevent_time_item['filmevent_time_id']); ?>">Delete</a>
			</div>
			<div class="form-group">
				<p><?php
					if (is_null($filmevent_time_item['u_date'])) {
						echo date('j F Y g:i a', strtotime($filmevent_time_item['c_date']));
					} else {
						echo date('j F Y g:i a', strtotime($filmevent_time_item['u_date']));
					}
				?></p>
			</div>

		</div>

	</div>

<?php echo form_close(); ?>