<!DOCTYPE HTML>
<html lang="en">
<head>
	<?php $this->load->view('templates/header'); ?>
	<script>
		$(document).ready(function() {

			function loadpage(page) {
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

			$("a").css("cursor","pointer");
			$("a:contains('masakan')").click( function() { loadpage('1'); });
			$("a:contains('minuman')").click( function() { loadpage('2'); });
			$("a:contains('tentang')").click( function() { loadpage('3'); });
			$("a:contains('kontak')").click( function() { loadpage('4'); });
			$("a:contains('resep')").click( function() { loadpage('5'); });
			$("a:contains('login')").click( function() { loadpage('6'); });
			$("a:contains('beranda')").click( function() { loadpage('7'); });

			<?php if($this->session->userdata('is_logged_in')): ?>
			$("a:contains('profil')").click( function() { loadpage('8'); });
			$("a:contains('profil')").click( loadpage('8'));
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
	
</body>
</html>