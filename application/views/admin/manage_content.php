<?php echo anchor('administrator/create', 'Buat resep baru'); ?>
<table border="1">
<tr>
	<td>Tanggal Upload</td>
	<td>ID</td>
	<td>Kategori</td>
	<td>Judul</td>
	<td></td>
	<td></td>
</tr>
<?php foreach ($resep_datas as $dt): ?>
	<tr>
		<td><?php echo $dt->uploaded ?></td>
		<td><?php echo $dt->id ?></td>
		<td><?php echo $dt->kategori ?></td>
		<td><?php echo anchor('resep/'.$dt->kategori.'/'.$dt->id, $dt->nama, 'target="_blank"'); ?></td>
		<td><?php echo anchor('administrator/update/'.$dt->id, 'edit'); ?></td>
		<td><?php echo anchor('administrator/delete/'.$dt->id, 'delete'); ?></td>
	</tr>
<?php endforeach ?>