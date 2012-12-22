<?php
class Adminpage_c extends CI_Controller {

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

	public function get_content() {

	}

	public function get_list_contents() {
		if($_GET['content']) {
			$output = '';
			$content = $_GET['content'];
			if($content=="resep") {
				$this->load->model('resep_model');
				$resep = $this->resep_model->get_reseps();
				if($resep) {
					$output['type'] = 'resep';
					foreach ($resep as $r) {
						$output['tanggal'][] = $r->topic_date;
						$output['kategori'][] = $r->cat_name;
						$output['judul'][] = $r->topic_subject;
						$output['penulis'][] = $r->user_name;
						$output['id'][] = $r->topic_id;
					}
				}
			}
			if($content=="member") {
				$this->load->model('membership');
				$member = $this->membership->get_users();
				if($member) {
					$output['type'] = 'member';
					foreach ($member as $m) {
						$output['join'][] = $m->user_join;
						$output['name'][] = $m->user_name;
						$output['email'][] = $m->user_email;
						$output['id'][] = $m->user_id;
					}
				}
			}
			echo json_encode($output);
		}
	}

	private function _set_content($page, $page_id) {
		$d['title'] = strtoupper($page);
		switch ($page) {
			case 'manage':
				//if($_GET['content']=='artikel'){

					//$this->load->model('resep_model');
					//$d['list_resep'] = $this->resep_model->get_reseps();
				//}
				//if($_GET['content']=='user') {
					//$this->load->model('membership');
					//$d['list_user'] = $this->membership->get_users();
				//}
				$d['content'] = $_GET['content'];
				break;
			case 'update_content':
				$this->load->model('resep_model');
				$d['content'] = $this->resep_model->get_resep_by_id($_GET['content']);
				break;
			default:
				# code...
				break;
		}

		return $d;
	}
}