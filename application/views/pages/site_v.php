<!DOCTYPE HTML>
<html lang="en">
<head>
	<title></title>
	<!--<link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>-->
	<link rel="icon" href="<?php echo base_url().'styles/images/3.png' ?>" />
	<link rel="stylesheet" href="<?php echo base_url().'styles/css/style.css' ?>" />
	<link rel="stylesheet" href="<?php echo base_url().'styles/css/navi-style.css' ?>" />
	<link rel="stylesheet" href="<?php echo base_url().'styles/css/form-style.css' ?>" />
	<script language="javascript" src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script>
	<script language="javascript" src="<?php echo base_url(); ?>js/ajax_get.js"></script>
</head>
<body>
	<div id="wrapper">
		<header id="header">
			<span>tentang</span>
			<span>kontak</span>
		</header>
		<section id="content">
			<article id="main-content">
				<h2></h2>
			</article>
		</section>
		<footer id="footer">
			<?php $this->load->view('templates/footer'); ?>
		</footer>
	</div>
</body>
</html>