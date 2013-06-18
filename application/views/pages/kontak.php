<script>
	$(document).ready(function(){
		$("#k-oth-subj").hide();

		<?php if($this->session->userdata("is_logged_in")): ?>
		$.ajax({
			url: 'index.php/user-contact', type: 'GET',
			data: 'user_id='+<?php echo $this->session->userdata('user_id'); ?>,
			dataType: 'json', cache: false,
			success: function(user) { $("#k-nama").val(user.name); $("#k-email").val(user.email);
						$("#k-nama, #k-email").attr("disabled", true); } });
		<?php endif; ?>

		$("#k-subjek").change(function(){
			if(this.value=="other") { $("#k-oth-subj").show(); }
			else { $("#k-oth-subj").hide(); } });
		$("#k-submit").click(function(){
			var nama = $("#k-nama").val(); var email = $("#k-email").val(); var subjek ;
			var pesan = $("#k-pesan").val();
			if($("#k-subjek").val()=="other") subjek = $("#k-oth-subj").val();
			else subjek = $("#k-subjek").val();
			$.ajax({
				url: "index.php/contact", type: "POST",
				data: "nama="+nama+"&email="+email+"&subjek="+subjek+"&pesan="+pesan,
				dataType: "json", cache: false,
				success: function(kontak) {
							if(! kontak.status){ $(".error-message").html(kontak.msg).fadeIn("slow"); }
							else { $("#k-conf").html("<p>"+kontak.msg+"</p>"); $("#k-form").remove();
							} } }); return false; }); }); </script>
<?php $this->load->view('pages/basic'); ?>
<p><?php //echo $general['description'] ?></p>
<section id="k-conf"></section>
<form id='k-form' method='post'>
	<section class="error-message" hidden="hidden"></section>
	<label for='name'>Nama:</label>
	<input name='name' type='text' id="k-nama" />
	<label for='email' >E-mail:</label>
	<input name='email' type='email' id="k-email" />
	<label for='subject'>Subjek:</label>
	<select name='subject' id="k-subjek">
		<option value='feedback'>Site Feedback</option>
		<option value='other'>Lainnya</option>
	</select>
	<input name='oth-subject' id="k-oth-subj" type='text' placeholder="subjek lainnya" />
	<label for='message'>Pesan:</label>
	<textarea name='message' id="k-pesan"></textarea><br>
	<input type='submit' value='Submit' id='k-submit' /> </form>