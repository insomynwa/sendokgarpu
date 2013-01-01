<script>
	var timer;
	$(document).ready(function(){
		$("#resep-submit").click(function(){
			$("#info").html('<img src="./styles/images/loader.gif" />');
			$("#form-resep").hide();
			$("#form-resep").ajaxForm({
				dataType: 'json',
				success: function(data){
					if(data.status) { goToContent('9','resep'); }
					else { $(".error-message").html(data.msg);
						timer = window.setTimeout(failed,2000); } } }).submit(); });

		function failed() { $("#info").html(''); $("#form-resep").show(); window.clearTimeout(timer); } }); </script>
<section id="update-resep">
<section id="info"></section>
	<?php echo form_open_multipart('update-resep','id="form-resep"') ?>
	<section class="error-message"></section>
	<p><label>Nama Resep:</label>
	<input id="resep-judul" value="<?php echo $content['topic_subject'] ?>" type="text" name="judul" placeholder="input judul" size="30"/></p>
	<p>
		<label>Gambar:</label>
		<img src="<?php echo base_url().'images/resep/'.$content['img_name'] ?>" width="100" />
		<input type="file" name="gambar" id="resep-gambar" />
	</p>
	<p><label>Kategori:</label>
	<select id="resep-kategori" name="kategori">
		<option value="" >Pilih kategori</option>
		<option value="1" <?php if($content['topic_cat']==1) echo 'selected="selected"' ?> >Resep Masakan</option>
		<option value="2" <?php if($content['topic_cat']==2) echo 'selected="selected"' ?> >Resep Minuman</option>
	</select></p>
	<p><label>Bahan:</label><br>
	<textarea id="resep-bahan" name="bahan" rows="8" cols="80"><?php echo $content['receipt_bahan'] ?></textarea></p>
	<p><label>Cara Membuat:</label><br>
	<textarea id="resep-cara" name="cara" rows="8" cols="80"><?php echo $content['receipt_cara'] ?></textarea></p>
	<p><label>Sumber:</label>
	<input type="text" id="resep-sumber" value="<?php echo $content['receipt_sumber'] ?>" name="sumber" placeholder="input sumber" size="50"/></p>
	<input type="hidden" name="id" value="<?php echo $content['topic_id'] ?>" />
	<input type="button" id="resep-submit" value="Submit" />
	<?php echo form_close(); ?> </section>