<!-- Films and Events -->
<div class="filmsevents">

	<!-- Films -->
	<div class="films">

		<h2>Films</h2>

		<?php
			/**
			 * If film(s) are available, show film(s).
			 */
			if (isset($films)) foreach ($films as $film_item) {
		?>

			<!-- Content -->
			<div class="content film">

				<!-- Info -->
				<div class="info">

					<?php
						/**
						 * If booked film or event links to the ticket, otherwise links to the film or event page.
						 */
					?>
					<!-- Poster -->
					<a href="<?php if ( ! isset($film_item['booked_filmevent_id'])) { echo base_url('filmsevents/' . $film_item['slug']); } else { echo base_url('filmsevents/ticket/' . $film_item['booked_filmevent_id']); } ?>"><div class="poster" <?php if ($film_item['poster_media_loc'] !== '') { ?>style="background-image: url(<?php echo base_url('media/' . $film_item['poster_media_loc']); ?>);"<?php } ?>></div></a>
					<!-- / Poster -->
					<h3><a href="<?php if ( ! isset($film_item['booked_filmevent_id'])) { echo base_url('filmsevents/' . $film_item['slug']); } else { echo base_url('filmsevents/ticket/' . $film_item['booked_filmevent_id']); } ?>"><?php echo $film_item['title']; ?></a></h3>

				</div>
				<!-- / Info -->

				<!-- Actions -->
				<div class="actions">

					<p><?php echo nl2br_except_pre($film_item['description']); ?></p>
					<?php
						/**
						 * If a user is NOT signed in, show Book Tickets button.
						 */
						if (isset($session)) {
					?>
						<?php
							/**
							 * If booked film or event, show View Ticket button, otherwise show Favourites and Book Tickets buttons.
							 */
							if ( ! isset($film_item['booked_filmevent_id'])) {
						?>
							<div class="ui-grid-a">
								<div class="ui-block-a">
									<?php if (isset($film_item['favorite'])) if ($film_item['favorite'] === TRUE) { ?>
										<!-- Remove from Favourites button -->
										<a href="#" class="ui-btn favorite" data-action="remove" data-filmevent-id="<?php echo $film_item['filmevent_id']; ?>">Remove from Favourites</a>
									<?php } else { ?>
										<!-- Add to Favourites button -->
										<a href="#" class="ui-btn favorite" data-action="add" data-filmevent-id="<?php echo $film_item['filmevent_id']; ?>">Add to Favourites</a>
									<?php } ?>
								</div>
								<div class="ui-block-b">
									<!-- Book Tickets button -->
									<a href="<?php echo base_url('filmsevents/' . $film_item['slug'] . '/book'); ?>" class="ui-btn" data-transition="slide">Book Tickets</a>
								</div>
							</div>
						<?php } else { ?>
							<!-- View Ticket button -->
							<a href="<?php echo base_url('filmsevents/ticket/' . $film_item['booked_filmevent_id']); ?>" class="ui-btn" data-transition="slide">View Ticket</a>
						<?php } ?>
					<?php } else { ?>
						<!-- Book Tickets button -->
						<a href="<?php echo base_url('filmsevents/' . $film_item['slug'] . '/book'); ?>" class="ui-btn" data-transition="slide">Book Tickets</a>
					<?php } ?>

				</div>
				<!-- / Actions -->

			</div>
			<!-- / Content -->

		<?php } ?>

	</div>
	<!-- / Films -->

	<!-- Events -->
	<div class="events">

		<h2>Events</h2>

		<?php
			/**
			 * If event(s) are available, show event(s).
			 */
			if (isset($events)) foreach ($events as $event_item) {
		?>

			<!-- Content -->
			<div class="content event">

				<!-- Info -->
				<div class="info">

					<?php
						/**
						 * If booked film or event links to the ticket, otherwise links to the film or event page.
						 */
					?>
					<!-- Poster -->
					<a href="<?php if ( ! isset($event_item['booked_filmevent_id'])) { echo base_url('filmsevents/' . $event_item['slug']); } else { echo base_url('filmsevents/ticket/' . $film_item['booked_filmevent_id']); } ?>"><div class="poster" <?php if ($event_item['poster_media_loc'] !== '') { ?>style="background-image: url(<?php echo base_url('media/' . $event_item['poster_media_loc']); ?>);"<?php } ?>></div></a>
					<!-- / Poster -->
					<h3><a href="<?php echo base_url('filmsevents/' . $event_item['slug']); ?>"><?php echo $event_item['title']; ?></a></h3>

				</div>
				<!-- / Info -->

				<!-- Actions -->
				<div class="actions">

					<p><?php echo nl2br_except_pre($event_item['description']); ?></p>
					<?php
						/**
						 * If a user is NOT signed in, show Book Tickets button.
						 */
						if (isset($session)) {
					?>
						<?php
							/**
							 * If booked film or event, show View Ticket button, otherwise show Favourites and Book Tickets buttons.
							 */
							if ( ! isset($film_item['booked_filmevent_id'])) {
						?>
							<div class="ui-grid-a">
								<div class="ui-block-a">
									<?php if (isset($event_item['favorite'])) if ($event_item['favorite'] === TRUE) { ?>
										<!-- Remove from Favourites button -->
										<a href="#" class="ui-btn favorite" data-action="remove" data-filmevent-id="<?php echo $event_item['filmevent_id']; ?>">Remove from Favourites</a>
									<?php } else { ?>
										<!-- Add to Favourites button -->
										<a href="#" class="ui-btn favorite" data-action="add" data-filmevent-id="<?php echo $event_item['filmevent_id']; ?>">Add to Favourites</a>
									<?php } ?>
								</div>
								<div class="ui-block-b">
									<!-- Book Tickets button -->
									<a href="<?php echo base_url('filmsevents/' . $event_item['slug'] . '/book'); ?>" class="ui-btn" data-transition="slide">Book Tickets</a>
								</div>
							</div>
						<?php } else { ?>
							<!-- View Ticket button -->
							<a href="<?php echo base_url('filmsevents/ticket/' . $event_item['booked_filmevent_id']); ?>" class="ui-btn" data-transition="slide">View Ticket</a>
						<?php } ?>
					<?php } else { ?>
						<!-- Book Tickets button -->
						<a href="<?php echo base_url('filmsevents/' . $event_item['slug'] . '/book'); ?>" class="ui-btn" data-transition="slide">Book Tickets</a>
					<?php } ?>

				</div>
				<!-- / Actions -->

			</div>
			<!-- / Content -->

		<?php } ?>

	</div>
	<!-- / Events -->

</div>
<!-- / Films and Events -->