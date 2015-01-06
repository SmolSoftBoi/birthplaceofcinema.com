<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<!-- Title -->
		<title>Regent Street Cinema - 404 Page Not Found</title>
		<!-- iOS web-app -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
		<!-- CSS -->
		<link href="/resources/css/themes/rsc.min.css" rel="stylesheet" rel="stylesheet">
		<link href="//code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" rel="stylesheet">
		<link href="/resources/css/themes/rsc-custom.css" rel="stylesheet">

		<!-- JavaScript -->
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	</head>

	<body>

		<!-- Page -->
		<div data-role="page" id="404">

			<!-- Header -->
			<div data-role="header" data-position="fixed" data-tap-toggle="false" data-add-back-btn="true" data-direction="reverse">

				<h1><?php echo $heading; ?></h1>

			</div>
			<!-- / Header -->

			<!-- Content -->
			<div data-role="main" class="ui-content">

				<?php echo $message; ?>

			</div>
			<!-- / Content -->

			<!-- Footer -->
			<div data-role="footer" data-position="fixed" data-tap-toggle="false">

				<!-- Navbar -->
				<div data-role="navbar" data-grid="d">
					<ul>
						<li><a href="/" class="ui-icon-home ui-nodisc-icon" data-icon="custom" data-transition="none">Home</a></li>
						<li><a href="/filmsevents" class="ui-icon-filmsevents ui-nodisc-icon" data-icon="custom" data-transition="none">Films & Events</a></li>
						<li><a href="/heritage" class="ui-icon-heritage ui-nodisc-icon" data-icon="custom" data-transition="none">Heritage</a></li>
						<li><a href="/nameseat" class="ui-icon-nameseat ui-nodisc-icon" data-icon="custom" data-transition="none">Name a Seat</a></li>
						<li><a href="/info" class="ui-icon-info ui-nodisc-icon" data-icon="custom" data-transition="none">Information</a></li>
					</ul>
				</div>
				<!-- / Navbar -->

			</div>
			<!-- / Footer -->

		</div>
		<!-- / Page -->

		<!-- JavaScript -->
		<script src="//checkout.stripe.com/checkout.js"></script>
		<script src="/resources/js/rsc.js"></script>

	</body>

</html>