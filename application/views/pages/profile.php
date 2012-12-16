<script>
	$(document).ready(function() {
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
<?php if($this->session->userdata('user_id')==1) {
	$this->load->view('admin/adm_page');
}
?>