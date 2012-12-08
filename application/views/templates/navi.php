<ul id="menu">
	<li><a><img src="<?php echo base_url() ?>styles/images/home.png"><span>beranda</span></a></li>
	<li><a><img src="<?php echo base_url() ?>styles/images/receipt.png"><span>resep</span></a>
		<ul id="dropdown">
			<li><a><img src="<?php echo base_url() ?>styles/images/masakan.png"><span>masakan</span></a></li>
			<li><a><img src="<?php echo base_url() ?>styles/images/minuman.png"><span>minuman</span></a></li>
		</ul>
	</li>
	<li><a><img src="<?php echo base_url() ?>styles/images/about.png"><span>tentang</span></a></li>
	<li><a><img src="<?php echo base_url() ?>styles/images/contact.png"><span>kontak</span></a></li>
	<?php if($this->session->userdata('is_logged_in')): ?>
	<li></li>
	<li><a><img src="<?php echo base_url() ?>styles/images/profile.png"><span>profil</span></a></li>
	<li><?php echo anchor('index.php/logout', '<img src="'.base_url().'styles/images/logout.png" /><span>Logout</span>') ?></li>
	<?php else: ?>
	<li><a><img src="<?php echo base_url() ?>styles/images/login.png"><span>login</span></a></li>
	<?php endif ?>
</ul>





