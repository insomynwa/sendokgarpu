<ul id="menu">
	<li><?php echo anchor(base_url(), '<img src="'.base_url().'styles/images/home.png" /><span>beranda</span>') ?></li>
	<li><?php echo anchor('resep', '<img src="'.base_url().'styles/images/receipt.png" /><span>resep</span>') ?>
		<ul id="dropdown">
			<li><?php echo anchor('resep/masakan', '<img src="'.base_url().'styles/images/masakan.png" /><span>masakan</span>') ?></li>
			<li><?php echo anchor('resep/minuman', '<img src="'.base_url().'styles/images/minuman.png" /><span>minuman</span>') ?></li>
		</ul>
	</li>
	<li><?php echo anchor('tentang', '<img src="'.base_url().'styles/images/about.png" /><span>tentang</span>') ?></li>
	<li><?php echo anchor('kontak', '<img src="'.base_url().'styles/images/contact.png" /><span>kontak</span>') ?></li>
	<?php if($this->session->userdata('is_logged_in')): ?>
	<li><?php echo anchor('logout', '<img src="'.base_url().'styles/images/logout.png" /><span>Logout</span>') ?></li>
	<?php endif ?>
</ul>

