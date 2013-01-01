<script>
	$(document).ready(function() {
		$("#comm-area").hide();
		$("a").css("cursor","pointer");

		if(topic!=0) { topic_id=topic; topic=0; $("#konten-resep").show(); loadArticle(topic_id); }
		else { $("#konten-resep").hide(); }
		
		$("a[name='topic']").click(function(){
			$("#konten-resep").fadeIn('slow');
			$("#comm-area").hide();
			$("#post-komen").hide();
			$("#btn-toggle-comm").text("Tampilkan Komentar");
			topic_id = this.id;
			$("#topic").val(topic_id);
			loadArticle(topic_id); });
		$("#btn-toggle-comm").click(function(){
			var btn_text = $(this).text();
			if(btn_text=="Tampilkan Komentar"){ fadeComment(true,'#comm-area','#post-komen', 'Sembunyikan Komentar'); }
			else { fadeComment(false,'#comm-area','#post-komen', 'Tampilkan Komentar'); } });

		function loadArticle(t) {
			$.get(
				"index.php/subcat", { topic:t},
				function(resep) {
					$("#nama-resep").html(resep.nama);
					$("#info-resep").html("<span class='tgl-rilis'><?php echo date('h:i a, d M Y',time('"+resep.tanggal+"')); ?></span>"+" oleh <span class='penulis'>"+resep.penulis+"</span>");
					$("#img-rsp").attr("src",""+resep.gambar);
					$("#bahan").html("<p><strong>Bahan :</strong><br>"+resep.bahan+"</p>");
					$("#cara").html("<p><strong>Cara :</strong><br>"+resep.cara+"</p>");
					$("#sumber").html("<p><strong>Sumber :</strong><br>"+resep.sumber+"</p>");
					$("#btn-toggle-comm").show();
				},
				"json"
				); }
		function fadeComment(t,ca,pk,txt){
			if(t) { $(ca).fadeIn('slow'); $(pk).fadeIn('slow'); $("#btn-toggle-comm").text(txt); loadComment(); }
			else { $(ca).fadeOut('slow'); $(pk).fadeOut('slow'); $("#btn-toggle-comm").text(txt); } }

		<?php if($this->session->userdata("is_logged_in")): ?>
		$("#btn-submit-komen").click(function(){
			var topicid = topic_id;
			var user = $("#user").val();
			var komentar = $("#msg-komen").val();
			$.post(
				"index.php/post-comment", { topic:topicid, user:user, comment:komentar},
				function (komen) {
					if(komen.status) {
						$("#msg-komen").val("");
						$(".error-message").html('');
						$(".error-message").hide();
						loadComment();
					}else {
						$(".error-message").html(komen.msg).fadeIn("slow");
					}
				},
				"json"
				);
			return false; });
		<?php endif; ?> }); </script>
<?php $this->load->view('pages/basic'); ?>
<section id="subresep">
	<section id="topics-list">
		<h4>Daftar Resep</h4>
		<ul id='daftar-resep'>
		<?php foreach($specific['list_cat'] as $l):?>
			<li><a name="topic" id="<?php echo $l->topic_id ?>"><?php echo $l->topic_subject ?></a></li>
		<?php endforeach; ?>
		</ul>
	</section>
	<section id="konten-resep">
		<hgroup>
			<h3 id="nama-resep"></h3>
			<footer id="info-resep"></footer>
		</hgroup>
		<section id="img-resep"><img id="img-rsp" src="" /></section>
		<section id="bahan"></section>
		<section id="cara"></section>
		<section id="sumber"></section>
		<button id="btn-toggle-comm" hidden="hidden">Tampilkan Komentar</button>
		<section id="comm-area"></section>
		<?php if($this->session->userdata("is_logged_in")): ?>
		<section id="post-komen" hidden="hidden">
			<form id="komen-form" method="post">
				<section class="error-message" hidden="hidden"></section>
				<label for="msg-komen">Komentar:</label>
				<textarea name="msg-komen" id="msg-komen"></textarea><br>
				<input name="user" type="hidden" value="<?php echo $this->session->userdata("user_id"); ?>" id="user"/>
				<input name="topic" type="hidden" value="" id="topic" />
				<input type="submit" value="Beri Komentar" id="btn-submit-komen" />
			</form>
		</section>
		<?php endif; ?>
	</section> </section>
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
										<footer class='tgl-komentar'><?php echo date('h:i a, d M Y',time('"+komen.tanggal[i]+"')); ?></footer>\
										<section class='text-komentar'><p>"+komen.komentar[i]+"</p></section>\
										</section></article>";
					}

					$("#comm-area").html(kmntr);
				}
			},
			"json"
		); } </script>