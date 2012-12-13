<script>
	$(document).ready(function(){

		function load_content(content) {
			$.get(
				"index.php/adminpage",
				{ content:content },
				function(data) {
					$("#adm-content").html(data);
				}
			);
		}
		$(".adm-n").css("cursor","pointer");
		$(".adm-n:contains('manage')").click(function(){ load_content('9'); });
	});
</script>
<section id="adm-wrapper">
	<nav id="adm-navi">
		<?php $this->load->view('adm_templates/navi') ?>
	</nav>
	<section id="adm-content">
		<?php $this->load->view('admin/home') ?>
	</section>
</section>