<!-- Ticket -->
<div class="ticket">

	<!-- Promo -->
	<div class="promo promo-iphone" <?php if ($booked_filmevent_item['promo_iphone_media_loc'] !== '') { ?>style="background-image: url(<?php echo base_url('media/' . $booked_filmevent_item['promo_iphone_media_loc']); ?>);"<?php } ?>></div>
	<div class="promo promo-ipad" <?php if ($booked_filmevent_item['promo_ipad_media_loc'] !== '') { ?>style="background-image: url(<?php echo base_url('media/' . $booked_filmevent_item['promo_ipad_media_loc']); ?>);"<?php } ?>></div>
	<!-- / Promo -->

	<!-- Content -->
	<div class="content">

		<h2><?php echo $booked_filmevent_item['title']; ?></h2>
		<p class="datetime"><?php echo date('l, j F Y', strtotime($booked_filmevent_item['datetime'])); ?><br><?php echo date('g:i a', strtotime($booked_filmevent_item['datetime'])); ?></p>
		<ul>
			<?php
				/**
				 * Show quantity of tickets booked.
				 */
			?>
			<?php if ($booked_filmevent_item['adult_qty'] > 0) { ?>
				<?php if ($booked_filmevent_item['adult_qty'] == 1) { ?>
					<li>1 Adult</li>
				<?php } else { ?>
					<li><?php echo $booked_filmevent_item['adult_qty']; ?> Adults</li>
				<?php } ?>
			<?php } ?>
			<?php if ($booked_filmevent_item['child_qty'] > 0) { ?>
				<?php if ($booked_filmevent_item['child_qty'] == 1) { ?>
					<li>1 Child</li>
				<?php } else { ?>
					<li><?php echo $booked_filmevent_item['child_qty']; ?> Children</li>
				<?php } ?>
			<?php } ?>
			<?php if ($booked_filmevent_item['student_qty'] > 0) { ?>
				<?php if ($booked_filmevent_item['student_qty'] == 1) { ?>
					<li>1 Student</li>
				<?php } else { ?>
					<li><?php echo $booked_filmevent_item['student_qty']; ?> Students</li>
				<?php } ?>
			<?php } ?>
		</ul>

		<!-- Poster -->
		<div class="poster" <?php if ($booked_filmevent_item['poster_media_loc'] !== '') { ?>style="background-image: url(<?php echo base_url('media/' . $booked_filmevent_item['poster_media_loc']); ?>);"<?php } ?>></div>
		<!-- / Poster -->

		<!-- Barcode -->
		<div class="barcode" style="background-image: url(<?php echo 'http://www.racoindustries.com/barcodegenerator/2d/barcode-image.axd?S=Pdf417&BR=4&BW=0.02&BM=0.25&C=' . $booked_filmevent_item['booked_filmevent_id'] . '&IFMT=Gif&PDFC=0&PDFCT=Auto&PDFEC=Level0&PDFR=0&QZ=0.25&TM=0.25'; ?>);"></div>
		<!-- / Barcode -->

	</div>
	<!-- / Content -->

</div>
<!-- / Ticket -->