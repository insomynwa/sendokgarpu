<?php echo form_open('crud/update'); ?>
<?php foreach($datas as $dt): ?>
	<p><label>Nama Resep:</label>
	<input type="text" name="judul" placeholder="input judul" value="<?php echo $dt->nama ?>" size="30"/></p>
	<p><label>Gambar:</label>
	<input type="text" name="gambar" placeholder="input sumber gambar" value="<?php echo $dt->gambar ?>" /></p>
	<p><label>Kategori:</label>
	<select name="kategori">
		<option value="masakan" <?php if($dt->kategori === 'masakan') echo 'selected="selected"' ?>>Resep Masakan</option>
		<option value="minuman" <?php if($dt->kategori === 'minuman') echo 'selected="selected"' ?>>Resep Minuman</option>
	</select></p>
	<p><label>Bahan:</label><br>
	<textarea name="bahan" rows="8" cols="80"><?php echo $dt->bahan ?></textarea></p>
	<p><label>Cara Membuat:</label><br>
	<textarea name="cara" rows="8" cols="80"><?php echo $dt->cara ?></textarea></p>
	<p><label>Sumber:</label>
	<input type="text" name="sumber" placeholder="input sumber" value="<?php echo $dt->sumber ?>" size="50"/></p>
	<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
	<input type="submit" value="Submit" />
<?php echo form_close(); ?>
<?php endforeach ?>