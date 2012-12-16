<script>
	$(document).ready(function(){
		$("title").html("<?php echo $title; ?>");
	});
</script>
<table>
	<tr>
	<?php if($content=='artikel'): ?>
		<td>No</td>
		<td>Tanggal</td>
		<td>Kategori</td>
		<td>Judul</td>
		<td>Penulis</td>
	<?php endif; ?>
	<?php if($content=='user'): ?>
		<td>No</td>
		<td>Tanggal Join</td>
		<td>Username</td>
		<td>Email</td>
	<?php endif; ?>
	</tr>
	<?php if($content=='artikel'): ?>
	<?php $i=0; foreach($list_resep as $lr): ?>
		<tr>
			<td><?php echo $i+1; ?></td>
			<td><?php echo $lr->topic_date ?></td>
			<td><?php echo $lr->cat_name ?></td>
			<td><?php echo $lr->topic_subject ?></td>
			<td><?php echo $lr->user_name ?></td>
		</tr>
	<?php $i++; endforeach; ?>
	<?php endif; ?>
	<?php if($content=='user'): ?>
	<?php $i=0; foreach($list_user as $lu): ?>
		<tr>
			<td><?php echo $i+1; ?></td>
			<td><?php echo $lu->user_join ?></td>
			<td><?php echo $lu->user_name ?></td>
			<td><?php echo $lu->user_email ?></td>
		</tr>
	<?php $i++; endforeach; ?>
	<?php endif; ?>
</table>