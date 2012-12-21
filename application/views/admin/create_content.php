<script>
	var timer;
	$(document).ready(function(){
		/*$("#resep-submit").click(function(){
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
		});*/

		/*$("#resep-gambar").live("change", function(){
			$("#img-preview").html("");
			$("#img-preview").html('<img src="./styles/images/loader.gif" />');
			$("#img-form").ajaxForm({
				target: '#img-preview'
			}).submit();
		});*/
		$("#resep-submit").click(function(){
			//var dataString = "nama="+$("#resep-nama").val()+"&kategori="+$("#resep-kategori").val()+"&bahan="+$("#resep-bahan").val()+"&cara="+$("#resep-cara").val()+"&sumber="+$("#resep-sumber").val();
			$("#info").html('');
			$("#info").html('<img src="./styles/images/loader.gif" />');
			$("#form-resep").hide();
			$("#form-resep").ajaxForm({//alert("woi");
				dataType: 'json',
				//data: dataString,
				//target: '#info',
				success: function(data){
					if(data.status) {
						//$("#info").html(data.msg);
						load_content('9','resep');
					}else {
						$(".error-message").html(data.msg);
						timer = window.setTimeout(failed,2000);
					}
				}
			}).submit();
		});

		function failed() {
			$("#info").html('');
			$("#form-resep").show();
			window.clearTimeout(timer);
		}

	});
</script>
<section id="create-resep">
<section id="info"></section>
<?php echo form_open_multipart('create-resep','id="form-resep"') ?>
	<section class="error-message"></section>
	<p><label>Nama Resep:</label>
	<input id="resep-judul" type="text" name="judul" placeholder="input judul" size="30"/></p>
	<p>
		<label>Gambar:</label>
		<input type="file" name="gambar" id="resep-gambar" />
		<!--<div id="gambar">silahkan upload gambar yang berkaitan</div>-->
	</p>
	<p><label>Kategori:</label>
	<select id="resep-kategori" name="kategori">
		<option value="">Pilih kategori</option>
		<option value="1">Resep Masakan</option>
		<option value="2">Resep Minuman</option>
	</select></p>
	<p><label>Bahan:</label><br>
	<textarea id="resep-bahan" name="bahan" rows="8" cols="80"></textarea></p>
	<p><label>Cara Membuat:</label><br>
	<textarea id="resep-cara" name="cara" rows="8" cols="80"></textarea></p>
	<p><label>Sumber:</label>
	<input type="text" id="resep-sumber" name="sumber" placeholder="input sumber" size="50"/></p>
	<input type="button" id="resep-submit" value="Submit" />
<?php echo form_close(); ?>
<!--<form id="img-form" method="post" enctype="multipart/form-data" action='index.php/upload-img-resep'>
	<label>Gambar:</label>
	<input type="file" name="gambar" id="resep-gambar" />
	<div id="img-preview"></div>
</form>-->
</section>