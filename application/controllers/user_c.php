<?php
class User_c extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$is_logged_in = false;
		if($this->session->userdata('is_logged_in')) {
			$is_logged_in = true;
		}else {
			$is_logged_in = false;
		}
		if($is_logged_in == FALSE) {
			redirect(base_url());
		}
		$this->load->model("membership");
	}

	public function get_user() {
		if($_GET['user_id']) {
			$user_id = $_GET['user_id'];
			$user = $this->membership->get_user($user_id);
			if($user) {
				$userdata['name'] = $user['user_name'];
				$userdata['email'] = $user['user_email'];

				echo json_encode($userdata);
			}
		}
	}

	public function get_profile() {
		if($_GET['user_id']) {
			$user_id = $_GET['user_id'];
			$user = $this->membership->get_profile($user_id);
			if($user) {
				$userdata['name'] = $user['user_name'];
				$userdata['email'] = $user['user_email'];
				$userdata['foto'] = $user['img_name'];
				
				echo json_encode($userdata);
			}
		}
	}
}