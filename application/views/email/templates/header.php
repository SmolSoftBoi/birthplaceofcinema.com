<!DOCTYPE html>
<html lang="en" class="ui-mobile">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title><?php echo $subject; ?></title>
	
		<!-- CSS -->
		<link href="<?php echo base_url('resources/css/themes/rsc.min.css'); ?>" rel="stylesheet" rel="stylesheet">
		<link href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" rel="stylesheet">
		<link href="<?php echo base_url('resources/css/themes/rsc-custom.css'); ?>" rel="stylesheet">

		<!-- JavaScript -->
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	</head>

	<body class="ui-mobile-viewport ui-overlay-a">

		<div data-role="page" <?php if (isset($page_id)) { ?>id="<?php echo $page_id; ?>"<?php } ?> class="ui-page ui-page-theme-a ui-page-header-fixed ui-page-footer-fixed ui-page-active" style="padding-top: 44px; padding-bottom: 58px; min-height: 336px;">

			<div data-role="header" data-position="fixed" data-tap-toggle="false" class="ui-header ui-bar-inherit ui-header-fixed slidedown">

				<h1 class="ui-title">Regent Street Cinema</h1>

			</div>

			<div data-role="main" class="ui-content">