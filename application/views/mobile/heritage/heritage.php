<!-- Heritage -->
<div class="heritage">

	<!-- Content -->
	<div class="content">

		<h2>Playing host to invention and wonder</h2>
		<?php if ($this->input->cookie($this->config->item('cookie_prefix') . 'question_9', TRUE) !== FALSE) { ?>
			<p>The Polytechnic Institution was founded in 1838 and rapidly established itself as a London landmark known for demonstrating technical innovations of the day. Visitors could be submerged underwater in the newly developed diving bell or have their portrait taken in Europe’s first photography studio. The Polytechnic became the University of Westminster in 1992 and today we boast a vibrant learning environment attracting more than 20,000 students from over 150 nations.</p>
		<?php } ?>
		<h2>A revolution in moving image</h2>
		<?php if ($this->input->cookie($this->config->item('cookie_prefix') . 'question_2', TRUE) !== FALSE) { ?>
			<p>In 1848 a theatre was added to the Polytechnic building at 309 Regent Street, purpose built for optical exhibitions it pioneered the popular Victorian Magic Lantern Shows. In 1896 the building transitioned from lantern theatre to cinema when it was the chosen venue to bring the Cinématographe-Lumière to London.  For the cost of a shilling, 54 people gathered in the Regent Street Theatre to witness the pioneering Lumière brothers’ Cinématographe screen the first performance of moving image to a paying British audience, visitors were said to have stepped back in alarm as a train hurtled towards them. As the curtain fell British Cinema was born. London audiences continued to be drawn to the theatre for popular entertainment and the path was paved for a century of cinematographic innovation.</p>
		<?php } ?>
		<?php if ($this->input->cookie($this->config->item('cookie_prefix') . 'question_7', TRUE) !== FALSE) { ?>
			<p>Up until 1980 the theatre was used as a public cinema, with programmes ranging from wartime newsreels, to foreign language and avant-garde films. A new chapter begins as the University of Westminster leads a major campaign to restore the Regent Street Cinema to its former Victorian grandeur.</p>
		<?php } ?>
		<p>Explore the timeline below and find out more about these exciting landmark events and the development of British cinema.</p>

	</div>
	<!-- / Content -->

	<div class="ui-grid-b">
		<div class="ui-block-a">
			<!-- Timeline button -->
			<a href="<?php echo site_url('heritage/timeline'); ?>" class="ui-btn" data-transition="slide">Timeline</a>
		</div>
		<div class="ui-block-b">
			<!-- Artefacts button -->
			<a href="<?php echo site_url('heritage/artefacts'); ?>" class="ui-btn" data-transition="slide">Artefacts</a>
		</div>
		<div class="ui-block-b">
			<!-- Game button -->
			<a href="<?php echo site_url('heritage/game'); ?>" class="ui-btn" data-transition="slide">Game</a>
		</div>
	</div>

</div>
<!-- / Heritage -->