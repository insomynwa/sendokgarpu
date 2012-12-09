<?php
class Site extends CI_Controller {

	public function __construct() {
			parent::__construct();
			$this->load->model('site_model');
		}

	public function index() {
		$data['main_content'] = 'beranda';
		$data['title'] = 'BERANDA | Sendok Garpu';

		$this->load->view('pages/page', $data);
	}

	public function load_page() {//echo $this->input->get("page"); die;
		if($_GET['page']){
			$page_id = $_GET['page'];
			$page = $this->site_model->get_page_by($page_id);
			if($page){
				
				$data = $this->_set_content($page['template_name'], $page_id);
				//print_r($data);die;

				$this->load->view('pages/'.$page['template_name'], $data);
			}else{
				$this->load->view('page/page_not_found');
			}
		}else {
			$this->load->view('pages/beranda');
		}
	}

	private function _set_content($page, $page_id) {
		$d['title'] = strtoupper($page).' | Sendok Garpu';
		switch ($page) {
			case 'profile':
				$this->load->model('membership');
				$d['konten'] = $this->membership->get_profile($this->session->userdata('user_id'));
				break;
			case 'kontak':

				break;
			case 'tentang':
				$konten = "halaman tentang";
				break;
			case 'subresep':
				$d['list'] = $this->site_model->get_topics_by($page_id);
				break;
			default:
				$konten = "page not found.";
				break;
		}
		return $d;
	}
	
}