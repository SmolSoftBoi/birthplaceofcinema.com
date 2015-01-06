<!-- Book -->
<div class="book">

	<?php
		/**
		 * If film or event dates are available, allow booking.
		 */
		if (isset($dates)) {
	?>
		<?php
			/**
			 * Book Form
			 * 
			 * Controls:
			 *  - Date
			 *  - Time
			 *  - Adult Quantity
			 *  - Child Quantity
			 *  - Student Quantity
			 *  - Coupon
			 */
			echo form_open();
		?>
			<!-- Data and Time -->
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<label for="date" class="ui-hidden-accessible">Date</label>
					<select id="date" name="date" data-filmevent-id="<?php echo $filmevent_item['filmevent_id']; ?>" required autofocus>
						<?php foreach ($dates as $date) { ?>
							<option value="<?php echo $date['date_value']; ?>"><?php echo $date['date_human']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="ui-block-b">
					<label for="time" class="ui-hidden-accessible">Time</label>
					<select id="time" name="time" required>
						<?php foreach ($times as $time) { ?>
							<option value="<?php echo $time['time_value']; ?>"><?php echo $time['time_human']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<!-- / Date and Time -->

			<!-- Quantities -->
			<table>
				<thead>
					<tr>
						<td>Ticket</td>
						<td>Quantity</td>
						<td>Sub-Total</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Adult</td>
						<td>
							<label for="adult" class="ui-hidden-accessible">Adult</label>
							<input type="number" id="adult" class="ticket" name="adult" value="0" data-price="10.00">
						</td>
						<td class="price">£0.00</td>
					</tr>
					<tr>
						<td>Child</td>
						<td>
							<label for="child" class="ui-hidden-accessible">Child</label>
							<input type="number" id="child" class="ticket" name="child" value="0" data-price="7.00">
						</td>
						<td class="price">£0.00</td>
					</tr>
					<tr>
						<td>Student</td>
						<td>
							<label for="student" class="ui-hidden-accessible">Student</label>
							<input type="number" id="student" class="ticket" name="student" value="0" data-price="8.00">
						</td>
						<td class="price">£0.00</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2">Total</td>
						<td class="price">£0.00</td>
					</tr>
				</tfoot>
			</table>
			<!-- / Qunatities -->

			<!-- Coupon -->
			<label for="coupon" class="ui-hidden-accessible">Coupon</label>
			<input type="text" id="coupon" name="coupon" value="<?php echo set_value('coupon'); ?>" placeholder="Coupon">

			<!-- Pay button -->
			<button type="submit" id="pay">Pay</button>

		<?php echo form_close(); ?>
	<?php } else { ?>
		<p>No dates or times available.</p>
	<?php } ?>

</div>
<!-- / Book -->

<script>
	/**
	 * Header, session, and film or event item.
	 */
	var header = '<?php if (isset($header)) { echo $header; } else { echo 'Book Tickets'; } ?>';
	var session = <?php echo json_encode($session); ?>;
	var filmEventItem = <?php echo json_encode($filmevent_item); ?>;
</script>