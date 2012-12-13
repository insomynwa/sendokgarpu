<?php
class Administrator extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$is_admin = false;
		if($this->session->userdata('is_logged_in') && $this->session->userdata('user_id') == 1) {
			$is_admin = true;
		}else {
			$is_admin = false;
		}
		if($is_admin == FALSE) {
			redirect(base_url());
		}
		$this->load->model('site_model');
	}

	public function index() {
		$data = $this->_set_data('home','home');
		$this->load->view('admin/adm_page', $data);
	}

	public function manage() {
		$data = $this->_set_data('manage content','manage_content');

		$data['resep_datas'] = $this->site_model->get_records();

		$this->load->view('admin/adm_page', $data);
	}

	private function _set_data($title, $content) {
		$d['title'] = strtoupper($title);
		$d['content'] = $content;
		return $d;
	}

	public function create() {
		$data = $this->_set_data('Create','create_content');
		$this->load->view('admin/adm_page', $data);
	}

	public function delete() {
		$data = $this->_set_data('Delete','delete_content');
		$this->load->view('admin/adm_page', $data);
	}

	public function update($id) {
		$data = $this->_set_data('Update','update_content');

		$data['datas'] = $this->site_model->get_record_by_id($id);

		$this->load->view('admin/adm_page', $data);
	}
}