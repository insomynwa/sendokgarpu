<?php $this->load->view('pages/basic'); ?>
<script>
	$(document).ready(function(){
		$("title").html("<?php echo strtoupper($general['title']).' | Sendok Garpu' ?>");
	}); </script>
<!--<section id="logo"><img class="news-img" src="<?php //echo base_url().'images/pages/logo.png' ?>" /></section>-->
<section id="content-wrapper">
	<article id="headline-news">
		<section id="hn-img"><img src="<?php echo base_url().'images/resep/'.$specific['headline']->img_name ?>" /></section>
		<hgroup>
			<h3 id="hn-judul"><?php echo $specific['headline']->topic_subject ?></h3>
			<footer id="hn-info"><?php echo $specific['headline']->topic_date ?></footer>
		</hgroup>
		<section id="hn-desk"><?php echo substr($specific['headline']->topic_desc,0,200).'...' ?><a class="fullread" onClick="goToArticle('<?php echo $specific['headline']->topic_cat ?>', '<?php echo $specific['headline']->topic_id ?>')" >baca selengkapnya</a></section>
	</article>
	<?php $this->load->view('pages/news') ?>
</section>
