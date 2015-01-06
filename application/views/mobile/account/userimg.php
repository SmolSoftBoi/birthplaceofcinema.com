<?php
	/**
	 * User Image Form
	 * 
	 * Controls:
	 *  - Profile Image
	 */
	$attributes = array(
    	'data-ajax'  => 'false'
    );
	echo form_open_multipart('account/uploaduserimg', $attributes);
?>
	<label for="userfile" class="ui-hidden-accessible">Profile Image</label>
	<?php if (isset($error)) { ?>
		<p><?php echo $error; ?></p>
	<?php } ?>
	<input type="file" id="userfile" name="userfile" value="<?php echo set_value('userfile'); ?>">
	<button type="submit">Upload Profile Image</button>
<?php echo form_close(); ?>