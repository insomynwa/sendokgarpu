<section id='news'>
	<section class="news-col" id='news-resep-masakan'>
		<h3>Resep Masakan Terbaru</h3>
	<?php foreach($specific['news_masakan'] as $msk): ?>
		<article>
			<img class="news-img" src="<?php echo base_url().'images/resep/'.$msk->img_name ?>" />
			<ul>
				<li class="news-topic"><?php echo $msk->topic_subject ?></li>
				<li><?php echo date('h:i a, d M Y',strtotime($msk->topic_date)); ?></li>
				<li>oleh: <?php echo $msk->user_name ?></li>
				<li><a onClick="goToArticle('1', '<?php echo $msk->topic_id ?>')" >baca selengkapnya</a></li>
			</ul>
		</article>
	<?php endforeach; ?>
	</section>
	<section class="news-col" id='news-resep-minuman'>
		<h3>Resep Minuman Terbaru</h3>
	<?php foreach($specific['news_minuman'] as $mnm): ?>
		<article>
			<img class="news-img" src="<?php echo base_url().'images/resep/'.$mnm->img_name ?>" />
			<ul>
				<li class="news-topic"><?php echo $mnm->topic_subject ?></li>
				<li><?php echo date('h:i a, d M Y',strtotime($mnm->topic_date)); ?></li>
				<li>oleh: <?php echo $mnm->user_name ?></li>
				<li><a onClick="goToArticle('2', '<?php echo $mnm->topic_id ?>')" >baca selengkapnya</a></li>
			</ul>
		</article>
	<?php endforeach; ?>
	</section>
</section>