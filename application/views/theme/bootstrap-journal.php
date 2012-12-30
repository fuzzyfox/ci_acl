<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
	<head>
		<!-- document meta data -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title></title>
		
		<!-- document styles -->
		<?php if(ENVIRONMENT !== 'production'): ?>
			<!-- development css -->
			<link href="<?php echo base_url('./asset/css/bootstrap.css'); ?>" rel="stylesheet">
			<style>
				body {
					padding-top: 60px; /* 60px to make container sit under topbar */
				}
			</style>
			<link href="<?php echo base_url('./asset/css/bootstrap-responsive.css'); ?>" rel="stylesheet">
		<?php else: ?>
			<!-- production (minified) css -->
			<link href="<?php echo base_url('./asset/css/bootstrap.min.css'); ?>" rel="stylesheet">
			<style>body { padding-top: 60px; } .table-sortable th[data-sort] { cursor: pointer; } ul.unstyled.dots li { border-bottom:1px dotted #ccc;padding-bottom:10px;padding-top:10px; } ul.unstyled.dots li:last-child { border-bottom:0; }</style>
			<link href="<?php echo base_url('./asset/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet">
		<?php endif;?>
		
		<!-- HTML5 shim, for IE6-8 support -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<!-- favicon and touch icons -->
		<link rel="shortcut icon" href="<?php echo base_url('./assets/ico/favicon.ico'); ?>">
	    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('./assets/ico/apple-touch-icon-144-precomposed.png'); ?>">
	    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('./assets/ico/apple-touch-icon-114-precomposed.png'); ?>">
	    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('./assets/ico/apple-touch-icon-72-precomposed.png'); ?>">
	    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('./assets/ico/apple-touch-icon-57-precomposed.png'); ?>">
		
		<!-- javascript libraries -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="<?php echo base_url('./asset/js/jquery.min.js'); ?>"><\/script>')</script>
		<script src="<?php echo base_url('./asset/js/bootstrap.min.js'); ?>"></script>
	</head>
	<body>
		<div id="wrap">
			<?php $this->load->view('theme/bootstrap-journal/header'); ?>
		
			<div class="container">
				<?php echo $ci_view; ?>
			</div>
		</div>
		
		<?php $this->load->view('theme/bootstrap-journal/footer'); ?>
	</body>
</html>