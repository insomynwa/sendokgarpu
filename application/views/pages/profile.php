<script>
	<?php if($this->session->userdata('user_id')==1): ?>
	var section_id='#adm-content';
	var url_content = 'adminpage';
	var navi_content = '#adm-navi';
	var list_content =  'daftar-konten';
	<?php else: ?>
	var url_content = 'memberpage';
	var section_id='#member-content';
	var navi_content = '#member-navi';
	var list_content =  'daftar-konten-member';
	<?php endif; ?>
	$(document).ready(function() {
		$("title").html("<?php echo $general['title']; ?>");
		$(".profil-content").hide();
		$("#form-profil").hide();
		$("#form-akun").hide();
		$("#profil-submit").attr('disabled','disabled');
		$(".profil-n").css("cursor","pointer");
		$(".profil-navi").accordion({ collapsible: true, active: 3 });
		$.ajax({
			url: 'index.php/profil', type: 'GET',
			data: "user_id="+<?php echo $this->session->userdata('user_id'); ?>,
			dataType: 'json', cache: false,
			success:
				function(profile) {
					$("#my-img").attr("src","<?php echo base_url() ?>images/users/"+profile.foto);
					$("#my-email").html(profile.email);
					$("#my-name").html(profile.name);
				} });

		$(".profil-n:contains('profil')").click(function(){ dialogForm("#form-profil","#form-akun","Profil"); });
		$(".profil-n:contains('akun')").click(function(){ dialogForm("#form-akun","#form-profil", "Akun"); });

		$(".profil-accord").click(function(){ $(".profil-content").html(''); $(".profil-content").fadeOut('slow');$(".info").html(''); });
		$("#profil-gambar").live('change', function(){ $("#profil-submit").removeAttr('disabled'); });
		$("#profil-submit").click(function(){ updateUser("#form-profil"); });
		$("#akun-submit").click(function(){ updateUser("#form-akun"); });	

		function updateUser(form_id) {
			$(".info-prof-akun").html('');
			$(".info-prof-akun").html('<img src="./styles/images/loader.gif" />');
			$(form_id).hide();
			$(form_id).ajaxForm({
				dataType: 'json',
				success:
					function(data) {
						if(data.status) {
							location.reload();
						}else {
							$(".error-message").html(data.msg).fadeIn('slow');
							timer = window.setTimeout(function(){
								$(".info-prof-akun").html('');
								$(form_id).show();
								window.clearTimeout(timer);
							}, 3000);
						}
					}
			}).submit(); } });
</script>
<?php $this->load->view('pages/basic'); ?>
<section id="profil-wrapper">
	<section id="kolom-profil">
		<img id="my-img" src="" />
		<table id="my-profil">
			<tr><td>Username:</td><td id="my-name"></td></tr>
			<tr><td>E-mail:</td><td id="my-email"></td></tr>
			<tr><td>Tanggal bergabung:</td><td id="join-date"><?php echo date('d F Y',strtotime($specific['profile']['user_join'])); ?></td></tr>
		</table>
	</section>
	<ul class="profil-navi"  id="aldm-navi">
		<li><a href="#" class="profil-accord">Konten</a>
			<ul>
				<li><a class="profil-n" onclick="naviProfil('10','')" >buat resep baru</a></li>
			</ul>
		</li>
		<li><a href="#" class="profil-accord">Pengelolaan</a>
			<ul>
				<li><a class="profil-n" onclick="naviProfil('9','resep')">artikel</a><li>
			<?php if($this->session->userdata('user_id') ==1 && $this->session->userdata('is_logged_in')): ?>
				<li><a class="profil-n" onclick="naviProfil('9','member')">user</a><li>
			<?php endif; ?>
			</ul>
		</li>
		<li><a href="#" class="profil-accord">Pengaturan</a>
			<ul>
				<li><a class="profil-n">profil</a></li>
				<li><a class="profil-n">akun</a></li>
			</ul>
		</li>
	</ul>
	<section class="profil-content"></section>
	<section class="info"></section>
	<section id="dialog-form" hidden="hidden">
		<section class="info-prof-akun"></section>
		<?php echo form_open('update-profil','id="form-profil"'); ?>
			<section class="error-message" hidden="hidden"></section>
			<p>
				<label for="profil-gambar">foto profil:</label>
				<input type="file" name="profil-gambar" id="profil-gambar" />
			</p>
			<p>
				<input type="button" id="profil-submit" value="Ubah Foto" />
			</p>
		<?php echo form_close(); ?>
		<?php echo form_open_multipart('update-profil', 'id="form-akun"') ?>
			<section class="error-message" hidden="hidden"></section>
			<p>
				<label for="akun-old-pass">password lama</label>
				<input type="password" name="akun-old-pass" id="akun-old-pass" />
			</p>
			<p>
				<label for="akun-new-pass">password baru</label>
				<input type="password" name="akun-new-pass" id="akun-new-pass" />
			</p>
			<p>
				<label for="akun-new-pass2">ketik ulang password baru</label>
				<input type="password" name="akun-new-pass2" id="akun-new-pass2" />
			</p>
			<p>
				<input type="button" id="akun-submit" value="Ubah Password" />
			</p>
		<?php echo form_close(); ?>
	</section> </section>
	<script type="text/javascript">
		function naviProfil(c,t) { $(".profil-content").fadeIn('slow'); goToContent(c,t); }</script>
	<script language="javascript" src="<?php echo base_url(); ?>js/profile.js"></script>