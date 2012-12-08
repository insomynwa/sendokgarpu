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
			<footer id="tgl-resep"></footer>
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

					$.ajax({
						type: "POST",
						url: "index.php/post-comment",
						data: "topic="+topic+"&user="+user+"&comment="+komentar,
						dataType: "json",
						cache: false,
						success:
							function(komen) {
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
								
							}
					});
					return false;
				});

			});
		</script>
	</section>
	<?php endif; ?>
</section>
<script>
	$(document).ready(function() {

		var topic_id;

		$("a[name='topic']").click(function(){
			$("#comm-area").empty();
			$("button[id='btn-toggle-comm']").text("Tampilkan Komentar");
			$("#post-komen").hide();
			topic_id = this.id;
			$("#topic").val(topic_id);
			load_article();
		});

		$("button[id='btn-toggle-comm']").click(function(){
			var btn_text = $(this).text();
			if(btn_text=="Tampilkan Komentar"){
				$("#comm-area").show();
				$("#post-komen").show();
				$(this).text("Sembunyikan Komentar");
			}else {
				$("#comm-area").hide();
				$("#post-komen").hide();
				$(this).text("Tampilkan Komentar");
			}
			show_comment();
		});

		function load_article() {
			$.ajax({
				url: "index.php/subcat",
				type: "GET",
				data: "topic="+topic_id,
				dataType: "json",
				cache: false,
				success:
					function(resep) {//alert(resep);
						$("#nama-resep").html(resep.nama);
						$("#tgl-resep").html(resep.tanggal);
						$("#img-rsp").attr("src",""+resep.gambar);
						$("#bahan").html("<p>"+resep.bahan+"</p>");
						$("#cara").html("<p>"+resep.cara+"</p>");
						$("#sumber").html("<p>"+resep.sumber+"</p>");
						$("#btn-toggle-comm").show();
					}
			});
		}

		function show_comment() {
			$.ajax({
				url: "index.php/comment",
				type: "GET",
				data: "topic="+topic_id,
				dataType: "json",
				timeout: 2000,
				cache: false,
				success:
					function(komen) {//alert((komen.foto).length);
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
							window.setTimeout(show_comment, 30000);
						}
					}
			});
		}

	});
</script>