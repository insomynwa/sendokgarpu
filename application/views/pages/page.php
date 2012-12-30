<!DOCTYPE HTML>
<html lang="en">
<head>
	<?php $this->load->view('templates/header'); ?>
	<script>
		
		$(document).ready(function() {

			

			$("a").css("cursor","pointer");
			$("a:contains('masakan')").click( function() { loadPage('1'); });
			$("a:contains('minuman')").click( function() { loadPage('2'); });
			$("a:contains('tentang')").click( function() { loadPage('3'); });
			$("a:contains('kontak')").click( function() { loadPage('4'); });
			$("a:contains('resep')").click( function() { loadPage('5'); });
			$("a:contains('login')").click( function() { loadPage('6'); });
			$("a:contains('beranda')").click( function() { loadPage('7'); });

			<?php if($this->session->userdata('is_logged_in')): ?>
			$("a:contains('profil')").click( function() { loadPage('8'); });
			$("a:contains('profil')").click( loadPage('8'));
			<?php endif ?>
		});
		
	</script>
</head>
<body>
	<div id="wrapper">
		<header id="header">
			<nav id="navi">
				<?php $this->load->view('templates/navi') ?>
			</nav>
		</header>
		<section id="content">
			<article id="main-content">
				<?php $this->load->view('pages/'.$main_content) ?>
			</article>
		</section>
		<footer id="footer">
			<?php $this->load->view('templates/footer'); ?>
		</footer>
	</div>
	<script type="text/javascript">
		function loadPage(page) {
			$.ajax({
					type: "GET",
					url: "index.php/cat",
					data: "page="+page,
					cache: false,
					success:
						function(data) {
							$("#main-content").html(data);
						}
				});
		}
		
		var topic = 0;
	</script>
</body>
</html>