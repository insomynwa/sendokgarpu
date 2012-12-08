<!DOCTYPE HTML>
<html lang="en">
<head>
	<?php $this->load->view('templates/header', $title); ?>
</head>
<body>
	<div id="wrapper">
		<header id="header">
			<nav id="navi">
				<?php $this->load->view('templates/navi') ?>
			</nav>
		</header>
		<section id="content">
			<?php if($content === 'beranda'): ?>
				<section id="acc-area">
					<?php if($this->session->userdata('is_logged_in')): ?>
						<?php echo $this->session->userdata('user_id'); ?>
					<?php else: ?>
						<?php $this->load->view('pages/login') ?>
					<?php endif; ?>
				</section>
				<section id="news">
					<h2>Resep Terbaru</h2>
					<?php $this->load->view('pages/news', $news); ?>
				</section>
			<?php else: ?>
				<?php $this->load->view('pages/'.$content); ?>
			<?php endif ?>
		</section>
		<footer id="footer">
			<?php $this->load->view('templates/footer'); ?>
		</footer>
	</div>
</body>
</html>