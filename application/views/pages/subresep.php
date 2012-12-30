<script>
	$(document).ready(function() {

		var topic_id;
		if(topic!=0) {
			topic_id=topic;
			topic=0;
			loadArticle(topic_id);
		}
		$("a").css("cursor","pointer");
		$("a[name='topic']").click(function(){
			$("#comm-area").empty();
			$("button[id='btn-toggle-comm']").text("Tampilkan Komentar");
			$("#post-komen").hide();
			topic_id = this.id;
			$("#topic").val(topic_id);
			loadArticle(topic_id);
		});

		$("button[id='btn-toggle-comm']").click(function(){
			var btn_text = $(this).text();
			if(btn_text=="Tampilkan Komentar"){
				$("#comm-area").show();
				$("#post-komen").show();
				$(this).text("Sembunyikan Komentar");
				loadComment();
			}else {
				$("#comm-area").hide();
				$("#post-komen").hide();
				$(this).text("Tampilkan Komentar");
			}
		});

		function loadArticle(t) {
			$.get(
				"index.php/subcat", { topic:t},
				function(resep) {
					$("#nama-resep").html(resep.nama);
					$("#info-resep").html(resep.tanggal+' oleh '+resep.penulis);
					$("#img-rsp").attr("src",""+resep.gambar);
					$("#bahan").html("<p>"+resep.bahan+"</p>");
					$("#cara").html("<p>"+resep.cara+"</p>");
					$("#sumber").html("<p>"+resep.sumber+"</p>");
					$("#btn-toggle-comm").show();
				},
				"json"
				);
		}

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
							kmntr = kmntr+"<section id='img-komen'>\
											<img id='img-kom' src='<?php echo base_url() ?>images/users/"+komen.foto[i]+"' />\
											<span id='user-komen'>"+komen.user[i]+"</span>\
											</section>\
											<section id='komentar'>\
											<footer id='tgl-komentar'>"+komen.tanggal[i]+"</footer>\
											<section id='text-komentar'><p>"+komen.komentar[i]+"</p></section>\
											</section>";
						}

						$("#comm-area").html(kmntr);
					}
				},
				"json"
			);
		}

	});
</script>
<?php $this->load->view('pages/basic'); ?>
<section id="subresep">
	<section id="topics-list">
		<h4>Daftar Resep</h4>
		<ul id='daftar-resep'>
		<?php foreach($list as $l):?>
			<li><a name="topic" id="<?php echo $l->topic_id ?>"><?php echo $l->topic_subject ?></a></li>
		<?php endforeach; ?>
		</ul>
	</section>
	<section id="slide"></section>
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
		<section id="comm-area" hidden="hidden">
		</section>
	</section>
	<?php if($this->session->userdata("is_logged_in")): ?>
	<section id="post-komen" hidden="hidden">
		<form id="komen-form" method="post">
			<p id="error-msg"></p>
			<label for="msg-komen">Komentar:</label>
			<textarea name="msg-komen" id="msg-komen"></textarea>
			<input name="user" type="hidden" value="<?php echo $this->session->userdata("user_id"); ?>" id="user"/>
			<input name="topic" type="hidden" value="" id="topic" />
			<input type="submit" value="Beri Komentar" id="btn-submit-komen" />
		</form>
		<script>
			$(document).ready(function(){

				$("#btn-submit-komen").click(function(){
					var topic = $("#topic").val();
					var user = $("#user").val();
					var komentar = $("#msg-komen").val();

					$.post(
						"index.php/post-comment", { topic:topic, user:user, comment:komentar},
						function (komen) {
							if(komen.is_true==true) {
								$("#msg-komen").val("");
								kmntr = "<section id='img-komen'>\
											<img id='img-kom' src='<?php echo base_url() ?>images/users/"+komen.foto+"' />\
											<span id='user-komen'>"+komen.user+"</span>\
										</section>\
										<section id='komentar'>\
											<footer id='tgl-komentar'>"+komen.tanggal+"</footer>\
											<section id='text-komentar'><p>"+komen.komentar+"</p></section>\
										</section>";
								$("#comm-area").append(kmntr);
							}else {
								$("#error-msg").html(komen.is_true).fadeIn("slow");
							}
						},
						"json"
						);
					return false;
				});

			});
		</script>
	</section>
	<?php endif; ?>
</section>