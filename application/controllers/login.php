<?php
class Login extends CI_Controller {

	public function __construct() { parent::__construct(); }

	public function validation() {
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$this->load->model('membership');
		if($username=="" || $password=="") { $message = "Lengkapi field yang tersedia."; }
		else {
			$data = array( 'username' => $username, 'password' => $password );
			$is_valid = $this->membership->validate($data);
			if($is_valid) {
				$user_id = $this->membership->get_user_id();
				$data['user'] = $this->membership->get_user($user_id);
				$sess_data = array(
						'user_id' => $user_id,
						'username' => $data['user']['user_name'],
						'is_logged_in' => true );
				$this->session->set_userdata($sess_data);
				$message = true; }
			else {
				$message = "Username dan password tidak sesuai."; } }
		echo $message; }
	
}