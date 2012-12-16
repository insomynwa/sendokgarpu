<script>
	$(document).ready(function(){

		function load_content(page , content) {
			$.get(
				"index.php/adminpage",
				{ page:page, content:content,  },
				function(data) {
					$("#adm-content").html(data);
				}
			);
		}
		$(".adm-n").css("cursor","pointer");
		$(".adm-n:contains('artikel')").click(function(){ load_content('9','artikel'); });
		$(".adm-n:contains('user')").click(function(){ load_content('9','user'); });
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