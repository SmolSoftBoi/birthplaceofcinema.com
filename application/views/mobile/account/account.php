<!-- Account -->
<div class="account">

	<!-- User Image -->
	<div class="user-img">
		<?php if ($session['user_media_loc'] !== '') { ?>
			<div><img src="<?php echo base_url('media/users/' . $session['user_media_loc']); ?>" alt="<?php echo $session['first_name'] . ' ' . $session['last_name']; ?>"></div>
			<a href="<?php echo site_url('account/userimg'); ?>" class="ui-btn">Edit Profile Image</a>
		<?php } else { ?>
			<a href="<?php echo site_url('account/userimg'); ?>" class="ui-btn">Add Profile Image</a>
		<?php } ?>
	</div>
	<!-- / User Image -->

	<!-- Content -->
	<div class="content">

		<!-- User full name and email -->
		<p><?php echo $session['first_name'] . ' ' . $session['last_name']; ?></p>
		<p><?php echo $session['user']; ?></p>

		<!-- Booked Films and Events button -->
		<a href="<?php echo site_url('account/bookedfilmsevents'); ?>" class="ui-btn" data-transition="slide">Booked Films & Events</a>

		<!-- Newsletter Subscription -->
		<div class="ui-field-contain">
			<label for="newsletter">Newsletter Subscription</label>
			<select data-role="flipswitch" id="newsletter" name="newsletter">
				<?php
					/**
					 * If newsletter subscription is on, set to on
					 */
				?>
				<option value="off" <?php if (isset($newsletter)) if ($newsletter == FALSE) echo 'selected'; ?>>Off</option>
				<option value="on" <?php if (isset($newsletter)) if ($newsletter == TRUE) echo 'selected'; ?>>On</option>
			</select>
		</div>
		<!-- / Newsletter Subscription -->

		<!-- Favoruties Subscription -->
		<div class="ui-field-contain">
			<label for="favorites">Favourites Subscription</label>
			<select data-role="flipswitch" id="favorites" name="favorites">
				<?php
					/**
					 * If favourites subscription is on, set to on
					 */
				?>
				<option value="off" <?php if (isset($favorites)) if ($favorites == FALSE) echo 'selected'; ?>>Off</option>
				<option value="on" <?php if (isset($favorites)) if ($favorites == TRUE) echo 'selected'; ?>>On</option>
			</select>
		</div>
		<!-- / Favourites Subscriptions -->

	</div>
	<!-- / Content -->

</div>
<!-- / Account -->