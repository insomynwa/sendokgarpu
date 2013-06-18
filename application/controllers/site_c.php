<?php
class Site_c extends CI_Controller {

	private $_op;

	public function __construct() {
		parent::__construct();
		$this->_op = '';
	}

	public function index() {
		$this->load->view('pages/site_v');
	}

	public function load_page() {
		$hlm = $_GET['halaman'];
		$content = 'page not found.';
		$this->_set_data($hlm);
		//$output = '{ "halaman": "'.$content.'" }';
		echo $this->_op;
	}

	private function _set_data($halaman) {
		$d['title'] = strtoupper($halaman);
		switch ($halaman) {
			case 'kontak':
				$d['konten'] = "halaman kontak";
				break;
			case 'tentang':
				$d['konten'] = "halaman tentang";
				break;
			case 'resep':
				$d['konten'] = "halaman resep";
				break;
			default:
				$d['konten'] = "page not found.";
				break;
		}
		$this->_set_output($d);
	}

	private function _set_output($data) {
		$this->_op = '{ "judul":"'.$data['title'].'", "konten":"'.$data['konten'].'"}';

	}
}