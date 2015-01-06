<?php
	/**
	 * Sign In Form
	 * 
	 * Controls:
	 *  - Email
	 *  - Password
	 */
	echo form_open('nameseat/requestseat/' . $seat);
?>
	<?php echo validation_errors(); ?>
	<label for="title" class="ui-hidden-accessible">Title</label>
	<input type="text" id="title" name="title" placeholder="Title" value="<?php echo set_value('title'); ?>" required autofocus>
	<label for="first_name" class="ui-hidden-accessible">First Name</label>
	<input type="text" id="first_name" name="first_name" placeholder="First Name" value="<?php echo set_value('first_name', $default['first_name']); ?>" required>
	<label for="last_name" class="ui-hidden-accessible">Last Name</label>
	<input type="text" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo set_value('last_name', $default['last_name']); ?>" required>
	<label for="address" class="ui-hidden-accessible">Address</label>
	<textarea id="address" name="address" rows="2" placeholder="Address" required><?php echo set_value('address'); ?></textarea>
	<label for="phone" class="ui-hidden-accessible">Phone</label>
	<input type="tel" id="phone" name="phone" placeholder="Phone" value="<?php echo set_value('phone'); ?>" required>
	<label for="email" class="ui-hidden-accessible">Email</label>
	<input type="email" id="email" name="email" placeholder="Email" value="<?php echo set_value('email', $default['email']); ?>" required>
	<label for="message" class="ui-hidden-accessible">Name or Message</label>
	<input type="text" id="message" name="message" placeholder="Name or Message" value="<?php echo set_value('message'); ?>" required>
	<button type="submit">Request Seat</button>
<?php echo form_close(); ?>