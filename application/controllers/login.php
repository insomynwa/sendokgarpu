<?php
class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function validation() {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$this->load->model('membership');

		if($username=="" || $password=="") {
			$message = "Please fill up blank fields";
			echo $message;
		}else {
			$data = array(
				'username' => $username,
				'password' => $password
				);

			$is_valid = $this->membership->validate($data);

			if($is_valid) {
				$user_id = $this->membership->get_user_id();
				$data['user'] = $this->membership->get_user($user_id);
				$sess_data = array(
						'user_id' => $user_id,
						'username' => $data['user']['user_name'],
						'is_logged_in' => true
					);
				$this->session->set_userdata($sess_data);
				if($user_id==1) {
					
				}else {
					//$data['main-content'] = 'profile';
					echo true;
				}

				$message = 'You are logged in as '.$data['user']['user_name'] ;
			}else {
				$message = "Username and password do not match.";
				echo $message;
			}
			
		}
		//$output = '{ "message":"'.$message.'" , "logged_in":"'.$this->session->userdata("is_logged_in").'" }';
		//echo $message;

		

		/*$this->load->model('membership');
		$data = array(
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			'email' => $_POST['email']
			);
		$login = $this->membership->validate($data);

		if($login) {
			$user_id = $this->membership->get_user_id();
			$dt = array(
				'user_id' => $user_id,
				'username' => $_POST['username'],
				'is_logged_in' => true
				);
			$this->session->set_userdata($dt);
			if($user_id==1)
				redirect('administrator');
			else
				redirect(base_url());
		}else {
			redirect(base_url());
		}*/
	}
	
}