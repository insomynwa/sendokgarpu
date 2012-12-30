<script>
	var timer;
	<?php if($this->session->userdata('user_id')==1): ?>
	var section_id='#adm-content';
	var url_content = 'adminpage';
	var list_content =  'daftar-konten';
	var navi_content = '#adm-navi';
	<?php else: ?>
	var section_id='#member-content';
	var url_content = 'memberpage';
	var list_content =  'daftar-konten-member';
	var navi_content = '#member-navi';
	<?php endif; ?>
	function goToContent(page , content) {
			$.get(
				"index.php/"+url_content,
				{ page:page, content:content  },
				function(data) {
					$(section_id).html(data);
				}
			);
		}
	$(document).ready(function() {
		$("#profil-submit").attr('disabled','disabled');
		$("#profil-gambar").live('change', function(){ $("#profil-submit").removeAttr('disabled');});
		$("#form-profil").hide();
		$("#form-akun").hide();

		$("#profil-submit").click(function(){updateUser("#form-profil");});
		$("#akun-submit").click(function(){updateUser("#form-akun");});

		function updateUser(form_id) {
			$(".info").html('');
			$(".info").html('<img src="./styles/images/loader.gif" />');
			$(form_id).hide();
			
			$(form_id).ajaxForm({
				dataType: 'json',
				success:
					function(data) {
						if(data.status) {
							location.reload();
						}else {
							$(".error-msg").html(data.msg);
							timer = window.setTimeout(function(){
								$(".info").html('');
								$(form_id).show();
								window.clearTimeout(timer);
							}, 3000);
						}
					}
			}).submit();
		}

		$("title").html("<?php echo $title; ?>");
		$.ajax({
			url: 'index.php/profil',
			type: 'GET',
			data: "user_id="+<?php echo $this->session->userdata('user_id'); ?>,
			dataType: 'json',
			cache: false,
			success:
				function(profile) {
					$("#my-img").attr("src","<?php echo base_url() ?>images/users/"+profile.foto);
					$("#my-email").html(profile.email);
					$("#my-name").html(profile.name);
				}
		});
	});
	
</script>
<img id="my-img" src="" />
<p id="my-email"><?php echo $konten['user_email']; ?></p>
<p id="my-name"><?php echo $konten['user_name']; ?></p>
<p id="join-date"><?php echo $konten['user_join']; ?></p>

<?php 
	if($this->session->userdata('is_logged_in')) {
		if($this->session->userdata('user_id')==1) {
			$this->load->view('admin/adm_page');
		}else {
			$this->load->view('pages/member_v');
		}
	}

?>
<section class="info"></section>
<?php echo form_open('update-profil','id="form-profil"'); ?>
	<section class="error-msg"></section>
	<p>
		<label for="profil-gambar">foto profil:</label>
		<input type="file" name="profil-gambar" id="profil-gambar" />
	</p>
	<p>
		<input type="button" id="profil-submit" value="Ubah Foto" />
	</p>
<?php echo form_close(); ?>
<?php echo form_open_multipart('update-profil', 'id="form-akun"') ?>
	<section class="error-msg"></section>
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