				</div>

			</div>

		</div>

		<!-- JS -->
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
		<script src="/resources/js/bootstrap.min.js"></script>
		<script src="/resources/js/codeforge.min.js"></script>
		<?php
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

	</body>

</html>