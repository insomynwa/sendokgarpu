<!DOCTYPE HTML>
<html lang="en">
<head>
	<?php $this->load->view('templates/header'); ?>
	<script>
		$(document).ready(function() {
			$("a").css("cursor","pointer");
			$("li:has(ul)").click(function(){
				$("#dropdown").slideToggle("slow");
			});
			$("li:not(:has(ul))").click(function(){
				$("#dropdown").slideUp("slow");
			});
			$("#vid-area a").click(function(){
				$("#vid-area").toggleClass("vid-translate");
			});
		<?php if($this->session->userdata('is_logged_in')): ?>
			loadPage('8');
		<?php endif ?>
			$(".main-nav").click(function(){
				var snd = document.getElementById("clicked");
				snd.play();
			});
		});
	</script>
</head>
<body>
	<div id="vid-area">
		<a>video</a>
		<video id="sg-vid" controls>
			<source src="<?php echo base_url().'public/videos/' ?>sg_vid.mp4" type="video/mp4" />
		</video>
	</div>
	<audio id="clicked">
		<source src="<?php echo base_url().'public/sounds/' ?>clicked.mp3" type="audio/mp3">
		<source src="<?php echo base_url().'public/sounds/' ?>clicked.ogg" type="audio/ogg">
		Your browser does not support the audio element.
	</audio>
	<div id="wrapper">
		<header id="header">
			<section id="banner"><img class="news-img" src="<?php echo base_url().'images/pages/logo.png' ?>" /></section>
			<nav id="navi">
				<?php $this->load->view('templates/navi') ?>
			</nav>
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
	<audio id="backsound" controls  loop>
		<source src="<?php echo base_url().'public/sounds/' ?>beranda_snd.ogg" type="audio/ogg">
		Your browser does not support the audio element.
	</audio>
	
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
	<script type="text/javascript">
		
		setInterval(
			function(){
				$.ajax({
					type: "GET",
					url: "index.php/chkses",
					cache: false,
					success:
						function(data){
							if((data==false && $("#logout").length>0) || (data==true && $("#logout").length<1))
								window.location.reload();
						}
				});
				
				},5000);
	</script>
	
</body>
</html>