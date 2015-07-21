<!-- Sign In -->
<div class="signin">

	<?php
		/**
		 * Sign In Form
		 * 
		 * Controls:
		 *  - Email
		 *  - Password
		 */
		echo form_open('auth');
	?>
		<?php echo validation_errors(); ?>
		<label for="user" class="ui-hidden-accessible">Username</label>
		<input type="email" id="user" name="user" placeholder="Email" value="<?php echo set_value('user'); ?>" required autofocus>
		<label for="pass" class="ui-hidden-accessible">Password</label>
		<input type="password" id="pass" name="pass" placeholder="Password" required>
		<button type="submit">Sign In</button>
		<a href="<?php echo site_url('auth/signup'); ?>" class="signup ui-btn" data-transition="slide">Sign Up</a>
	<?php echo form_close(); ?>

</div>
<!-- / Sign In -->

<!-- Sign Up -->
<div class="signup">

	<?php
		/**
		 * Sign Up Form
		 * 
		 * Controls:
		 *  - First Name
		 *  - Last Name
		 *  - Email
		 *  - Passsword
		 *  - Confirm Password
		 *  - Profile Image
		 */
		$attributes = array(
			'data-ajax'  => 'false'
		);
		echo form_open_multipart('auth/signup');
	?>
		<label for="first_name" class="ui-hidden-accessible">First Name</label>
		<input type="text" id="first_name" name="first_name" placeholder="First Name" value="<?php echo set_value('first_name'); ?>" required>
		<label for="last_name" class="ui-hidden-accessible">Last Name</label>
		<input type="text" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>" required>
		<label for="user" class="ui-hidden-accessible">Username</label>
		<input type="email" id="user" name="user" placeholder="Email" value="<?php echo set_value('user'); ?>" required>
		<label for="pass1" class="ui-hidden-accessible">Password</label>
		<input type="password" id="pass1" name="pass1" placeholder="Password" required>
		<label for="pass2" class="ui-hidden-accessible">Confirm Password</label>
		<input type="password" id="pass2"  name="pass2" placeholder="Confirm Password" required>
		<label for="userfile" class="ui-hidden-accessible">Profile Image</label>
		<?php if (isset($error)) { ?>
			<p><?php echo $error; ?></p>
		<?php } ?>
		<input type="file" id="userfile" name="userfile" value="<?php echo set_value('userfile'); ?>">
		<button type="submit">Sign Up</button>
	<?php echo form_close(); ?>

</div>
<!-- / Sign Up -->