<script>
	
	$(document).ready(function(){
		$(".adm-n").css("cursor","pointer");
		$(".adm-n:contains('artikel')").click(function(){ goToContent('9','resep'); });
		$(".adm-n:contains('user')").click(function(){ goToContent('9','member'); });
		$(".adm-n:contains('buat resep baru')").click(function(){ goToContent('10',''); });

		$(".adm-n:contains('profil')").click(function(){ $("#form-profil").show();$("#form-akun").hide(); $(".error-msg").html(''); });
		$(".adm-n:contains('akun')").click(function(){ $("#form-profil").hide();$("#form-akun").show(); $(".error-msg").html(''); });

		$("#adm-navi").css('width','300');
		$("#adm-navi").accordion({ collapsible: true, active: 3 });

		$(".ah-accord").click(function(){
			$("#adm-content").html('');
			$("#form-profil").hide();
			$("#form-akun").hide();$(".info").html('');
		});
	});
</script>
<section id="adm-wrapper">
	<ul id="adm-navi">
		<li><a href="#" class="ah-accord">Konten</a>
			<ul>
				<li><a class="adm-n">buat resep baru</a></li>
			</ul>
		</li>
		<li><a href="#" class="ah-accord">Pengelolaan</a>
			<ul>
				<li><a class="adm-n">artikel</a><li>
				<li><a class="adm-n">user</a><li>
			</ul>
		</li>
		<li><a href="#" class="ah-accord">Pengaturan</a>
			<ul>
				<li><a class="adm-n">profil</a></li>
				<li><a class="adm-n">akun</a></li>
			</ul>
		</li>
	</ul>
	<section id="adm-content"></section>
</section>