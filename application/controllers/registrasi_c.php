<?php
class Registrasi_c extends CI_Controller {

	public function __construct() { parent::__construct(); }

	public function validation() {
		//$username = mysql_real_escape_string($_POST['username']);
		//$email = mysql_real_escape_string($_POST['email']);
		//$pass1 = mysql_real_escape_string($_POST['password']);
		//$pass2 = mysql_real_escape_string($_POST['password2']);
		$username = $_POST['username'];
		$email = $_POST['email'];
		$pass1 = $_POST['password'];
		$pass2 = $_POST['password2'];
		if($username==""||$email==""||$pass1==""||$pass2=="") { $output = "lengkapi field yang tersedia."; }
		else {
			if(strlen($username)<8 || strlen($pass1)<8 || strlen($email)<8){
				$output = 'username/email/password minimal 8 karakter.'; }
			else{
				if($pass1 != $pass2) { $output = "password tidak sama."; }
				else { $data = array( 'username' => $username, 'email' => $email, 'password' => $pass1 );
					$this->load->model("membership");
					$temp = $this->membership->add_user($data);
					if($temp) {
						$is_valid = $this->membership->validate($data);
						if($is_valid) {
							$user_id = $this->membership->get_user_id();
							$this->membership->set_default_photo($user_id);
							$data['user'] = $this->membership->get_user($user_id);
							$sess_data = array(
									'user_id' => $user_id,
									'username' => $data['user']['user_name'],
									'is_logged_in' => true );
							$this->session->set_userdata($sess_data); 
							$output = true; }
					}else { $output = "username telah digunakan."; } } } }
		echo $output; }
}