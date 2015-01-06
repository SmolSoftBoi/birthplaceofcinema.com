<div class="page-header">
	<h1>Add <?php echo $filmevent_item['title']; ?> Time</h1>
</div>
<?php
    $attributes = array(
    	'role'  => 'form'
    );
    echo form_open('admin/filmsevents/addtime/' . $filmevent_item['filmevent_id'], $attributes);
?>

	<div class="row">

		<div class="col-sm-10">

			<div class="form-group col-xs-6 <?php if (form_error('date') !== '') echo 'has-error has-feedback'; ?>">
			    <label class="sr-only" for="title">Date</label>
			    <input type="date" id="date" class="form-control" name="date" placeholder="Date" value="<?php echo set_value('date'); ?>" min="<?php echo date('Y-m-d', now()); ?>" required autofocus>
			    <?php if (form_error('date') !== '') { ?>
					<span class="icon icon-alert form-control-feedback"></span>
				<?php } ?>
				<span class="help-block">Date in <var><?php echo date('j M Y', now()); ?></var> format.</span>
			</div>
			<div class="form-group col-xs-6 <?php if (form_error('time') !== '') echo 'has-error has-feedback'; ?>">
			    <label class="sr-only" for="title">Time</label>
			    <input type="time" id="time" class="form-control" name="time" placeholder="Time" value="<?php echo set_value('time'); ?>" required>
			    <?php if (form_error('time') !== '') { ?>
					<span class="icon icon-alert form-control-feedback"></span>
				<?php } ?>
				<span class="help-block">Time in <var><?php echo date('g:i a', now()); ?></var> format.</span>
			</div>

		</div>

		<div class="col-sm-2">

			<div class="form-group">
				<button type="submit" class="btn btn-block btn-primary">Save</button>
			</div>

		</div>

	</div>

<?php echo form_close(); ?>