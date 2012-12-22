<script>
	function goto_content(page , content) {
			$.get(
				"index.php/adminpage",
				{ page:page, content:content  },
				function(data) {
					$("#adm-content").html(data);
				}
			);
		}
	$(document).ready(function(){
		$(".adm-n").css("cursor","pointer");
		$(".adm-n:contains('artikel')").click(function(){ goto_content('9','resep'); });
		$(".adm-n:contains('user')").click(function(){ goto_content('9','member'); });
		$(".adm-n:contains('buat resep baru')").click(function(){ goto_content('10',''); });
	});
</script>
<section id="adm-wrapper">
	<nav id="adm-navi">
		<?php $this->load->view('adm_templates/navi') ?>
	</nav>
	<section id="adm-content"></section>
</section>