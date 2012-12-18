<?php
class Membership extends CI_Model {

	private $_id;

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->_id = 0;
	}

	public function validate($data) {
		$query = $this->db
			->where('user.user_name', $data['username'])
			->where('user.user_pass', sha1($data['password']))
			->get('user');

		if($query->num_rows() == 1) {
			$this->_set_id($query);
			return true;
		}
	}

	private function _set_id($q) {
		foreach ($q->result() as $res) {
			$this->_id = $res->user_id;
		}
	}

	public function get_user_id() {
		
		return $this->_id;
	}

	public function get_users() {
		$query = $this->db
					->select("user.user_id, user.user_name, user.user_email, user.user_join")
					->order_by("user.user_join","desc")
					->get("user");
		if($query->num_rows() > 0)
			return $query->result();
		return false;
	}

	public function get_user($id) {
		$query =
			$this->db
				->where('user.user_id', $id)
				->select('user.user_name, user.user_email')
				->get('user');
		if($query->num_rows() == 1)
			return $query->row_array();
		return false;
	}

	public function get_profile($id) {
		$query =
			$this->db
				->where('user.user_id', $id)
				->select('user.user_name, user.user_email')
				->get('user');
		$photo = $this->_get_user_photo($id); 
		
		if($query->num_rows() == 1){
			$q2 = $query->row_array();
			$q2['img_name'] = $photo['img_name'];
			return $q2;
		}
		return false;
	}

	public function add_user($data) {
		$valid_username = $this->_cek_username($data['username']);
		if($valid_username) {
			$user = array(
				'user_name' => $data['username'],
				'user_email' => $data['email'],
				'user_pass' => sha1($data['password']),
				'user_level' => 3
				);
			$query =
				$this->db
					->insert('user', $user);

			return true;
		}

		return false;
	}

	public function set_default_photo($user_id) {
		$data = array(
			'img_name' => 'no-image.jpg',
			'img_by' => $user_id
			);
		$this->db->insert('images', $data);
	}

	private function _cek_username($username) {
		$query =
			$this->db
				->where('user.user_name', $username)
				->get('user');
		if($query->num_rows() == 0) {
			return true;
		}
		return false;
	}

	private function _get_user_photo($user_id) {
		$query = 
			$this->db
				->where('img_by',$user_id)
				->get('images');
		if($query->num_rows == 1)
			return $query->row_array();
		return false;
	}

}