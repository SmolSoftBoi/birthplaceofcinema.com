<!-- Film or Event -->
<div class="filmevent">

	<!-- Promo -->
	<div class="promo promo-iphone" <?php if ($filmevent_item['promo_iphone_media_loc'] !== '') { ?>style="background-image: url(<?php echo base_url('media/' . $filmevent_item['promo_iphone_media_loc']); ?>);"<?php } ?>></div>
	<div class="promo promo-ipad" <?php if ($filmevent_item['promo_ipad_media_loc'] !== '') { ?>style="background-image: url(<?php echo base_url('media/' . $filmevent_item['promo_ipad_media_loc']); ?>);"<?php } ?>></div>
	<!-- / Promo -->

	<!-- Content -->
	<div class="content">

		<!-- Actions -->
		<div class="actions">

			<div class="poster" <?php if ($filmevent_item['poster_media_loc'] !== '') { ?>style="background-image: url(<?php echo base_url('media/' . $filmevent_item['poster_media_loc']); ?>);"<?php } ?>></div>
			<a href="#" class="ui-btn favorite" data-action="add" data-filmevent-id="<?php echo $filmevent_item['filmevent_id']; ?>">Add to Favourites</a>
			<a href="<?php echo base_url('filmsevents/' . $filmevent_item['slug'] . '/book'); ?>" class="ui-btn" data-transition="slide">Book Tickets</a>

		</div>
		<!-- / Actions -->

		<!-- Information -->
		<div class="info">

			<h2><?php echo $filmevent_item['title']; ?></h2>
			<p><?php echo nl2br_except_pre($filmevent_item['description']); ?></p>

			<?php
				/**
				 * If trailer(s) are available, show trailer(s).
				 */
				if (isset($film_trailers)) {
			?>
				<!-- Trailers -->
				<div class="trailers">

					<h3>Trailers</h3>
					<?php
						/**
						 * Show each trailer, if media is available.
						 */
						foreach ($film_trailers as $film_trailer_item) {
					?>
						<?php if ($film_trailer_item['trailer_media_loc'] !== '' && $film_trailer_item['placeholder_media_loc'] !== '') { ?>
							<video type="video/mp4" src="<?php echo base_url('media/' . $film_trailer_item['trailer_media_loc']); ?>" class="trailer" poster="<?php echo base_url('media/' . $film_trailer_item['placeholder_media_loc']); ?>" preload="auto" x-webkit-airplay="allow"></video>
						<?php } ?>
					<?php } ?>

				</div>
				<!-- / Trailers -->
			<?php } ?>

		</div>
		<!-- / Information -->

	</div>
	<!-- / Content -->

</div>
<!-- Film or Event -->