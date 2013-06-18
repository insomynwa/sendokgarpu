<?php if(empty($datas) || $datas == '') {
	echo '<p id="no-konten">Mohon maaf, resep yang anda maksud tidak ada.</p>';
} else { ?>
<?php foreach ($datas as $resep): ?>
	<article id="artikel-resep" class="konten">
		<hgroup>
			<h3 id="judul"><?php echo anchor('resep/'.$resep->kategori.'/'.$resep->id, $resep->nama); ?></h3>
			<footer id="tgl-upload">
				<p>dipublikasikan pada:<br><span><?php echo $resep->uploaded; ?></span></p>
			</footer>
		</hgroup>
		<?php echo '<img id="img-artikel" src="'. $resep->gambar .'" />'; ?>
		<section>
			<h5 class="sub-judul">Bahan:</h5>
			<p class="konten-sj"><?php echo $resep->bahan; ?></p>
		</section>
		<section>
			<h5 class="sub-judul">Cara Membuat:</h5>
			<p class="konten-sj"><?php echo $resep->cara; ?></p>
		</section>
		<footer>
			<?php echo '<a href="'. $resep->sumber .'" >sumber</a>';?>
		</footer>
	</article>
<?php endforeach; } ?>
