<script>
	$(document).ready(function(){

		$("#resep-submit").click(function(){
			$.post(
				"index.php/create-resep",
				{ 
					nama:$("#resep-nama").val(),
					kategori:$("#resep-kategori").val(),
					bahan:$("#resep-bahan").val(),
					cara:$("#resep-cara").val(),
					sumber:$("#resep-sumber").val()
				 },
				function(data) {
					if(data.status){
                        //$("#create-resep").html(data.msg).fadeIn("slow");
                        //window.setTimeout(function(){location.reload();},3000);
                    }else {
                        $(".error-message").html(data.msg).fadeIn("slow");
                    }
				},
				"json"
			);
			return false;
		});

		$("#resep-gambar").live("change", function(){
			$("#img-preview").html("");
			$("#img-preview").html('<img src="./styles/images/loader.gif" />');
			$("#img-form").ajaxForm({
				target: '#img-preview'
			}).submit();
		});

	});
</script>
<section id="create-resep">
<?php echo form_open('create-resep','id="form-resep"') ?>
	<section class="error-message"></section>
	<p><label>Nama Resep:</label>
	<input id="resep-nama" type="text" name="judul" placeholder="input judul" size="30"/></p>
	<p><label>Kategori:</label>
	<select id="resep-kategori" name="kategori">
		<option value="">Pilih kategori</option>
		<option value="masakan">Resep Masakan</option>
		<option value="minuman">Resep Minuman</option>
	</select></p>
	<p><label>Bahan:</label><br>
	<textarea id="resep-bahan" name="bahan" rows="8" cols="80"></textarea></p>
	<p><label>Cara Membuat:</label><br>
	<textarea id="resep-cara" name="cara" rows="8" cols="80"></textarea></p>
	<p><label>Sumber:</label>
	<input type="text" id="resep-sumber" name="sumber" placeholder="input sumber" size="50"/></p>
	<input type="submit" id="resep-submit" value="Submit" />
<?php echo form_close(); ?>
<form id="img-form" method="post" enctype="multipart/form-data" action='index.php/upload-img-resep'>
	<label>Gambar:</label>
	<input type="file" name="gambar" id="resep-gambar" />
	<div id="img-preview"></div>
</form>
</section>