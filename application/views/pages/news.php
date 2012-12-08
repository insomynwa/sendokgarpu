<?php for($i=0; $i<sizeof($news); $i++): ?>
	<?php
		$rsp = '';
		if($i==0) {
			$rsp = 'masakan';
		}else if($i==1) {
			$rsp = 'minuman';
		}
	?>
	<article id="artikel-news">
	<h3><?php echo $rsp; ?></h3>
	<?php foreach($news[$rsp] as $r): ?>
		<img id="img-news" src="<?php echo $r->gambar ?>" />
		<article id="info-news">
			<h5><?php echo $r->nama ?></h5>
			<p>diunggah pada: <?php echo $r->uploaded ?> </p>
			<p>konten</p>
		</article>
		<footer><?php echo anchor("resep/$r->kategori/$r->id",'baca selengkapnya ..'); ?>
		</footer>
	<?php endforeach ?>
	</article>
<?php endfor; ?>