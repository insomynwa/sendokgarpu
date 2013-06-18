<ul id="menu">
	<li><?php echo $navigation['sg'][5] ?></li>
	<li><a class="main-nav submenu"><img src="<?php echo base_url() ?>styles/images/receipt.png"><span>resep</span></a>
		<ul id="dropdown">
			<li><?php echo $navigation['sg'][0] ?></li>
			<li><?php echo $navigation['sg'][1] ?></li>
		</ul>
	</li>
	<!--<li><a class="main-nav"><span>video</span></a></li>-->
	<li><?php echo $navigation['sg'][2] ?></li>
	<li><?php echo $navigation['sg'][3] ?></li>
	<?php if($this->session->userdata('is_logged_in')): ?>
	<li></li>
	<li><?php echo $navigation['sg'][6] ?></li>
	<li><?php echo anchor('logout', '<img src="'.base_url().'styles/images/logout.png" /><span>Logout</span>','class="main-nav" id="logout"') ?></li>
	<?php else: ?>
	<li><?php echo $navigation['sg'][4] ?></li>
	<?php endif ?>
</ul>