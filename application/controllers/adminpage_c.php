<?php
class Adminpage_c extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("site_model");
	}

	public function load_content() {
		if($_GET['page']) {
			$page_id = $_GET['page'];
			$page = $this->site_model->get_page_by($page_id);
			if($page) {
				$data = $this->_set_content($page['template_name'],$page_id);
				$this->load->view('admin/'.$page['template_name'], $data);
			}
		}
	}

	private function _set_content($page, $page_id) {
		$d['title'] = strtoupper($page);
		switch ($page) {
			case 'manage':
				if($_GET['content']=='artikel'){

					$this->load->model('resep_model');
					$d['list_resep'] = $this->resep_model->get_resep();
				}
				if($_GET['content']=='user') {
					$this->load->model('membership');
					$d['list_user'] = $this->membership->get_users();
				}
				$d['content'] = $_GET['content'];
				break;
			
			default:
				# code...
				break;
		}

		return $d;
	}
}