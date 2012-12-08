<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Cek_login {

	public function is_logged_in($is_logged_in) {
		$login = $is_logged_in;
		if(!isset($login) || $login != true) {
			return false;
		}
		return true;
	}
}