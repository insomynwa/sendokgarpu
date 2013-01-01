<?php $this->load->view('pages/basic'); ?>
<script>
	$(document).ready(function(){
		$("title").html("<?php echo strtoupper($general['title']).' | Sendok Garpu' ?>");
	}); </script>
<section id="logo"><img class="news-img" src="<?php echo base_url().'images/pages/logo.png' ?>" /></section>
<?php $this->load->view('pages/news') ?>