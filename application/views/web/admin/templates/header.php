<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Regent Street Cinema - Admin<?php if (isset($title)) echo ' - ' . $title; ?></title>
	
		<!-- CSS -->
		<link href="/resources/css/codeforge.min.css" rel="stylesheet">
	
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body id="body-dashboard" class="body-navbar-fixed-top">

		<nav class="navbar navbar-fixed-top navbar-default navbar-inverse" role="navigation">
		    <div class="container-fluid">
		    	<div class="navbar-header">
		    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#epickris-navbar-collapse">
		    			<span class="sr-only">Toggle navigation</span>
		    			<span class="icon-bar"></span>
		    			<span class="icon-bar"></span>
		    			<span class="icon-bar"></span>
		    		</button>
		    		<a class="navbar-brand" href="<?php echo site_url(); ?>">Regent Street Cinema</a>
		    	</div>

		    	<div class="collapse navbar-collapse" id="epickris-navbar-collapse">
		    		<p class="navbar-text navbar-right"><?php echo $session['first_name'] . ' ' . $session['last_name']; ?></p>
		    	</div>
		    </div>
		</nav>

		<div class="container-fluid">

			<div class="row">

				<div class="sidebar sidebar-nav-fixed-top">

					<ul class="nav nav-sidebar">
						<li<?php if (isset($nav)) if ($nav === 'dashboard') echo ' class="active"'; ?>><a href="<?php echo site_url('admin'); ?>"><span class="icon icon-dashboard"></span> Dashboard</a></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li <?php if (isset($nav)) if ($nav === 'filmsevents') echo ' class="active"'; ?>><a href="<?php echo site_url('admin/filmsevents'); ?>"><span class="icon icon-film"></span> Films & Events</a></li>
						<li <?php if (isset($nav)) if ($nav === 'newsletter') echo ' class="active"'; ?>><a href="<?php echo site_url('admin/newsletter'); ?>"><span class="icon icon-mail"></span> Newsletter</a></li>
						<li <?php if (isset($nav)) if ($nav === 'favorites') echo ' class="active"'; ?>><a href="<?php echo site_url('admin/favorites'); ?>"><span class="icon icon-mail"></span> Favourites</a></li>
					</ul>

				</div>

				<div class="main" role="main">