<script type="text/javascript">
	$(document).ready(function(){

		$(".member-n:contains('artikel')").click(function(){ goToContent('9','resep'); });
		$(".member-n:contains('profil')").click(function(){ $("#form-profil").show();$("#form-akun").hide(); });
		$(".member-n:contains('akun')").click(function(){ $("#form-profil").hide();$("#form-akun").show(); });
		$(".member-n:contains('buat resep baru')").click(function(){ goToContent('10',''); });

		$("#member-navi").css('width','300');
		$("#member-navi").accordion({ collapsible: true, active: 3 });

		$(".mh-accord").click(function(){
			$("#member-content").html('');
			$("#form-profil").hide();
			$("#form-akun").hide();$(".info").html('');
		});
		$(".member-n").css("cursor","pointer");
	});
</script>
<section id="member-wrapper">
	<ul id="member-navi">
		<li><a href="#" class="mh-accord">Konten</a>
			<ul>
				<li><a class="member-n">buat resep baru</a></li>
			</ul>
		</li>
		<li><a href="#" class="mh-accord">Pengelolaan</a>
			<ul>
				<li><a class="member-n">artikel</a><li>
			</ul>
		</li>
		<li><a href="#" class="mh-accord">Pengaturan</a>
			<ul>
				<li><a class="member-n">profil</a></li>
				<li><a class="member-n">akun</a></li>
			</ul>
		</li>
	</ul>
	<section id="member-content"></section>
</section>