<!DOCTYPE HTML>
<html lang="en">
<head>
	<?php $this->load->view('templates/header'); ?>
	<script>
		$(document).ready(function() {
			$("a").css("cursor","pointer");
			<?php if($this->session->userdata('is_logged_in')): ?>
			loadPage('8');
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
			<section id="banner"><img class="news-img" src="<?php echo base_url().'images/pages/logo.png' ?>" /></section>
		</header>
		<section id="content">
			<article id="main-content">
				<?php $this->load->view('pages/'.$main_content) ?>
			</article>
			<div id="del-dialog" hidden="hidden">Yakin ingin dihapus?</div> 
		</section>
		<div id="footer">
			<?php $this->load->view('templates/footer'); ?>
		</div>
	</div>
	<script type="text/javascript">
		function loadComment() {
			$.get(
				"index.php/comment",
				{ topic:topic_id },
				function(komen) {
					var kmntr = "";
					if(komen.jumlah=="kosong") {
						$("#comm-area").html("<p>"+komen.pesan+"</p>");
					}else {
						for(i=0; i<(komen.komentar).length; i++) {
							kmntr = kmntr+"<article class='komen'><section class='img-komen'>\
											<img class='img-kom' src='<?php echo base_url() ?>images/users/"+komen.foto[i]+"' />\
											<span class='user-komen'>"+komen.user[i]+"</span>\
											</section>\
											<section class='komentar'>\
											<footer class='tgl-komentar'>"+komen.tanggal[i]+"</footer>\
											<section class='text-komentar'><p>"+komen.komentar[i]+"</p></section>\
											</section>"+komen.del[i]+"</article>";
						}

						$("#comm-area").html(kmntr);
					}
				},
				"json"
			); }
		<?php if($this->session->userdata('is_logged_in')): ?>
		function yesNoDialog(content,id){
			$("#del-dialog").dialog({
				title: "Hapus "+content,
				modal: true,
				draggable: false,
				resizable: false,
				dialogClass: "dialog-yesno-style",
				closeOnEscape: true,
				buttons: [
					{
						text: "Ya", 'class': 'yes-btn',
						click: function() {
							if(content=='resep') {
								$.ajax({ type: "POST", url: "index.php/delete-resep", data: "resep="+id,
									success: function(data) { loadContent(''+content); $("#del-dialog").dialog("close"); }
								}); }
							<?php if($this->session->userdata('user_id')==1): ?>
							if(content=='comment') {
								$.ajax({ type: "POST", url: "index.php/delete-comment", data: "komentar="+id,
									success: function(data) { loadComment(); $("#del-dialog").dialog("close"); }
								}); }
							if(content=='member') {
								$.ajax({ type: "POST", url: "index.php/delete-member", data: "member="+id,
									success: function(data) { loadContent(''+content); $("#del-dialog").dialog("close"); }
								}); }
							<?php endif; ?>
						}
					},
					{
						text: "Tidak", click: function() { $("#del-dialog").dialog("close"); }
					}
				]
				}); }
		<?php endif; ?>
	</script>
	<?php echo smiley_js(); ?>
	<script language="javascript" src="<?php echo base_url(); ?>js/sendokgarpu.js"></script>
</body>
</html>