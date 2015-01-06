<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<!-- Title -->
		<title>Regent Street Cinema<?php if (isset($title)) echo ' - ' . $title; ?></title>
		<!-- iOS web-app -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
		<!-- CSS -->
		<link href="<?php echo base_url('resources/css/themes/rsc.min.css'); ?>" rel="stylesheet" rel="stylesheet">
		<link href="//code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" rel="stylesheet">
		<link href="<?php echo base_url('resources/css/themes/rsc-custom.css'); ?>" rel="stylesheet">

		<!-- JavaScript -->
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	</head>

	<body>

		<!-- Page -->
		<div data-role="page" <?php if (isset($page_id)) { ?>id="<?php echo $page_id; ?>"<?php } ?>>

			<!-- Header -->
			<div data-role="header" data-position="fixed" data-tap-toggle="false" <?php
				/**
				 * Adds automatic back button.
				 * 
				 * Condition: $back === TRUE
				 */
				if (isset($back)) if ($back === TRUE) echo 'data-add-back-btn="true" data-direction="reverse"';
			?>>

				<h1><?php
					/**
					 * Adds header.
					 */
					if (isset($header)) echo $header;
				?></h1>

				<?php
					/**
					 * Adds account button.
					 * If a user is signed in links to their account, otherwise links to the sign up / in page.
					 * 
					 * Condition: $account === TRUE
					 */
					if (isset($account)) if ($account === TRUE) {
				?>
					<a href="<?php if (isset($session)) { echo base_url('account'); } else { echo base_url('auth'); } ?>" class="ui-icon-account ui-btn ui-btn-icon-right ui-btn-right ui-nodisc-icon" data-icon="custom" data-transition="slide">Account</a>
				<?php } ?>

				<?php
					/**
					 * Adds sign out button.
					 * 
					 * Condition: $signout === TRUE
					 */
					if (isset($signout)) if ($signout === TRUE) {
				?>
					<a href="<?php echo base_url('auth/signout'); ?>" class="ui-icon-account ui-btn ui-btn-icon-right ui-btn-right ui-nodisc-icon" data-icon="custom" data-transition="slide">Sign Out</a>
				<?php } ?>

				<?php
					/**
					 * Adds favourites button.
					 * 
					 * Condition: $favorites === TRUE
					 */
					if (isset($favorites)) if ($favorites === TRUE) {
				?>
					<a href="<?php echo base_url('filmsevents/favorites'); ?>" class="ui-icon-favorite ui-btn ui-btn-icon-left ui-btn-left ui-nodisc-icon" data-icon="custom" data-transition="slide">Favourites</a>
				<?php } ?>

			</div>
			<!-- / Header -->

			<!-- Content -->
			<div data-role="main" class="ui-content">