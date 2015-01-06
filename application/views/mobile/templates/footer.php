			</div>
			<!-- / Content -->

			<!-- Footer -->
			<div data-role="footer" data-position="fixed" data-tap-toggle="false">

				<!-- Navbar -->
				<div data-role="navbar" data-grid="d">
					<ul>
						<?php
							/**
							 * If section is active, set active state.
							 */
						?>
						<li><a href="<?php echo base_url(); ?>" class="ui-icon-home ui-nodisc-icon <?php if (isset($nav)) if ($nav === 'home') echo ' ui-btn-active'; ?>" data-icon="custom" data-transition="none">Home</a></li>
						<li><a href="<?php echo base_url('filmsevents'); ?>" class="ui-icon-filmsevents ui-nodisc-icon <?php if (isset($nav)) if ($nav === 'filmsevents') echo ' ui-btn-active'; ?>" data-icon="custom" data-transition="none">Films & Events</a></li>
						<li><a href="<?php echo base_url('heritage'); ?>" class="ui-icon-heritage ui-nodisc-icon <?php if (isset($nav)) if ($nav === 'heritage') echo ' ui-btn-active'; ?>" data-icon="custom" data-transition="none">Heritage</a></li>
						<li><a href="<?php echo base_url('nameseat'); ?>" class="ui-icon-nameseat ui-nodisc-icon <?php if (isset($nav)) if ($nav === 'nameseat') echo ' ui-btn-active'; ?>" data-icon="custom" data-transition="none">Name a Seat</a></li>
						<li><a href="<?php echo base_url('info'); ?>" class="ui-icon-info ui-nodisc-icon <?php if (isset($nav)) if ($nav === 'info') echo ' ui-btn-active'; ?>" data-icon="custom" data-transition="none">Information</a></li>
					</ul>
				</div>
				<!-- / Navbar -->

			</div>
			<!-- / Footer -->

		</div>
		<!-- / Page -->

		<!-- JavaScript -->
		<script src="//checkout.stripe.com/checkout.js"></script>
		<?php
			/**
			 * Adds additional JavaScript scripts.
			 */
			if (isset($scripts)) {
				if (is_array($scripts)) {
					foreach ($scripts as $script) {
						echo '<script src="' . $script . '"></script>';
					}
				} else {
					echo '<script src="' . $scripts . '"></script>';
				}
			}
		?>
		<script src="<?php echo base_url('resources/js/rsc.js'); ?>"></script>

	</body>

</html>