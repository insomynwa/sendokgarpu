<?php
class Adminpage_c extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("site_model");
	}

	public function load_content() {
		if($_GET['content']) {
			$content_id = $_GET['content'];
			$content = $this->site_model->get_page_by($content_id);
			if($content) {
				$this->load->view('admin/'.$content['template_name']);
			}
		}
	}

	private function _set_content($content_id) {
		
	}
}