<section id='news'>
	<section class="news-col" id='news-resep-masakan'>
		<h3>Resep Masakan Terbaru</h3>
		<div id="slideshow1">
	<?php foreach($specific['news_masakan'] as $msk): ?>
		<article>
			<img class="news-img" src="<?php echo base_url().'images/resep/'.$msk->img_name ?>" />
			<ul>
				<li class="news-topic"><?php echo $msk->topic_subject ?></li>
				<li><?php echo date('h:i a, d M Y',strtotime($msk->topic_date)); ?></li>
				<li>oleh: <?php echo $msk->user_name ?></li>
				<li><a class="fullread" onClick="goToArticle('1', '<?php echo $msk->topic_id ?>')" >baca selengkapnya</a></li>
			</ul>
		</article>
	<?php endforeach; ?>
		</div>
	</section>
	<section class="news-col" id='news-resep-minuman'>
		<h3>Resep Minuman Terbaru</h3>
		<div id="slideshow2">
	<?php foreach($specific['news_minuman'] as $mnm): ?>
		<article>
			<img class="news-img" src="<?php echo base_url().'images/resep/'.$mnm->img_name ?>" />
			<ul>
				<li class="news-topic"><?php echo $mnm->topic_subject ?></li>
				<li><?php echo date('h:i a, d M Y',strtotime($mnm->topic_date)); ?></li>
				<li>oleh: <?php echo $mnm->user_name ?></li>
				<li><a class="fullread" onClick="goToArticle('2', '<?php echo $mnm->topic_id ?>')" >baca selengkapnya</a></li>
			</ul>
		</article>
	<?php endforeach; ?>
		</div>
	</section>
</section>
<!--<div id="salideshow">
	   <div>
	     <img src="http://farm6.static.flickr.com/5224/5658667829_2bb7d42a9c_m.jpg">
	   </div>
	   <div>
	     <img src="http://farm6.static.flickr.com/5230/5638093881_a791e4f819_m.jpg">
	   </div>
	   <div>
	     Pretty cool eh? This slide is proof the content can be anything.
	   </div>
	</div>-->
<script type="text/javascript">
$(document).ready(function(){
	$("#slideshow1 > article:gt(0)").hide();
	$("#slideshow2 > article:gt(0)").hide();

	setInterval(function(){
		$('#slideshow1 > article:first')
				    .fadeOut(1000)
				    .next()
				    .fadeIn(1000)
				    .end()
				    .appendTo('#slideshow1');
				$('#slideshow2 > article:first')
				    .fadeOut(1000)
				    .next()
				    .fadeIn(1000)
				    .end()
				    .appendTo('#slideshow2');
	},5000);
});

</script>