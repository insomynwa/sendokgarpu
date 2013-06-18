<?php
class Crud extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$is_logged_in = $this->session->userdata('is_logged_in');
		if($this->cek_login->is_logged_in($is_logged_in) == false) {
			redirect('login');
		}
		$this->load->model('site_model');
	}

	public function create() {
		$data = array(
			'nama' => $_POST['judul'],
			'bahan' => $_POST['bahan'],
			'cara' => $_POST['cara'],
			'gambar' => $_POST['gambar'],
			'sumber' => $_POST['sumber'],
			'kategori' => $_POST['kategori']
			);
		$this->site_model->add_record($data);
		redirect('administrator/manage');
	}

	public function delete() {

		if($_POST['confirm'] === 'yes') {
			$this->site_model->del_record($_POST['id']);
		}

		redirect('administrator/manage');
	}

	public function update() {
		$data = array(
			'nama' => $_POST['judul'],
			'bahan' => $_POST['bahan'],
			'cara' => $_POST['cara'],
			'gambar' => $_POST['gambar'],
			'sumber' => $_POST['sumber'],
			'kategori' => $_POST['kategori']
			);
		$this->site_model->update_record($data, $_POST['id']);
		redirect('administrator/manage');
	}
}