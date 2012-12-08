<?php echo form_open('crud/create'); ?>
	<p><label>Nama Resep:</label>
	<input type="text" name="judul" placeholder="input judul" size="30"/></p>
	<p><label>Gambar:</label>
	<input type="text" name="gambar" placeholder="input sumber gambar" /></p>
	<p><label>Kategori:</label>
	<select name="kategori">
		<option value="masakan">Resep Masakan</option>
		<option value="minuman">Resep Minuman</option>
	</select></p>
	<p><label>Bahan:</label><br>
	<textarea name="bahan" rows="8" cols="80"></textarea></p>
	<p><label>Cara Membuat:</label><br>
	<textarea name="cara" rows="8" cols="80"></textarea></p>
	<p><label>Sumber:</label>
	<input type="text" name="sumber" placeholder="input sumber" size="50"/></p>
	<input type="submit" value="Submit" />
<?php echo form_close(); ?>