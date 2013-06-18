<!DOCTYPE html>
<html>
	<head><title><?php echo $title ?> | Administrator</title></head>
	<body>
		<div id="container">
			<header><?php $this->load->view('adm_templates/header'); ?></header>
			<section>
				<aside>
					<?php $this->load->view('adm_templates/navi') ?>
				</aside>
				<section>
					<?php $this->load->view('admin/'.$content) ?>
				</section>
			</section>
			<footer><?php $this->load->view('templates/footer'); ?></footer>
		</div>
	</body>
</html>