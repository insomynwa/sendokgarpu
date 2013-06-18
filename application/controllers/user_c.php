<?php
class User_c extends CI_Controller {

	private $_permited;
	private $_full_permitted;

	public function __construct() {
		parent::__construct(); $is_logged_in = false;
		$this->_verifikasi();
		if(! $this->_permited ) redirect(base_url());
		$this->load->model("membership"); $this->load->model('site_model'); }

	public function load_content() {
		if($_GET['page']) { $page_id = $_GET['page'];
			$page = $this->site_model->get_page_by($page_id);
			if($page) {
				$data = $this->_set_content($page['template_name'],$page_id);
				$this->load->view('admin/'.$page['template_name'], $data); } } }

	public function get_user() {
		if($_GET['user_id']) { $user_id = $_GET['user_id'];
			$user = $this->membership->get_user($user_id);
			if($user) { $userdata['name'] = $user['user_name'];
				$userdata['email'] = $user['user_email'];
				echo json_encode($userdata); } } }

	public function get_profile() {
		if($_GET['user_id']) { $user_id = $_GET['user_id'];
			$user = $this->membership->get_profile($user_id);
			if($user) {
				$userdata['name'] = $user['user_name'];
				$userdata['email'] = $user['user_email'];
				$userdata['foto'] = $user['img_name'];
				echo json_encode($userdata); } } }

	public function update_profile() {
		$user_id = $this->session->userdata('user_id');
		$user_name = $this->session->userdata('username');
		if(isset($_POST['akun-old-pass']) && isset($_POST['akun-new-pass']) && isset($_POST['akun-new-pass2'])) {
			//$o_pass = mysql_real_escape_string($_POST['akun-old-pass']);
			//$n_pass = mysql_real_escape_string($_POST['akun-new-pass']);
			//$n2_pass = mysql_real_escape_string($_POST['akun-new-pass2']);
			$o_pass = $_POST['akun-old-pass'];
			$n_pass = $_POST['akun-new-pass'];
			$n2_pass = $_POST['akun-new-pass2'];
			if($o_pass == '' || $n_pass == '' || $n2_pass == '') {
				$output = array('status' => false, 'msg' => 'lengkapi field'); }
			else {
				$data = array( 'username' => $user_name, 'password' => $o_pass );
				$is_valid = $this->membership->validate($data);
				if($is_valid) {
					if($n_pass == $n2_pass) {
						$new_data = array( 'id' => $user_id, 'new_pass' => $n_pass );
						$this->membership->update_user($new_data);
						$output = array('status' => true, 'msg' => 'foto profil berhasil diubah'); }
					else { $output = array('status' => false, 'msg' => 'password baru tidak sesuai'); } }
				else { $output = array('status' => false, 'msg' => 'password salah'); } } }
		else {
			$profil_photo = $this->membership->get_user_photo($user_id);
			$profil['photo'] = $profil_photo['img_name'];
			$upl_img = $this->_upload_img($user_name);
			if($upl_img['status']) { $profil['photo'] = $upl_img['file'];
				$output = array('status' => true, 'msg' => 'foto profil berhasil diubah'); }
			else { $output = array('status' => false, 'msg' => 'foto profil gagal diubah'); }
			$this->membership->update_photo($user_id,$profil); } echo json_encode($output); }

	private function _upload_img($filename) {
		$config['file_name'] = $filename.'_'.time();
		$config['upload_path'] = './images/users/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('profil-gambar')){ $status = array('status'=> false, 'msg' => 'gagal'); }
		else{ $data = $this->upload->data();
			$status = array('status'=> true, 'msg' => 'sukses', 'file'=> $data['file_name']); } return $status; }

	public function delete_user() {
		//if($_POST['member']) { $member_id = mysql_real_escape_string($_POST['member']);
		if($_POST['member']) { $member_id = $_POST['member'];
			$this->membership->delete_user($member_id); } }

	private function _set_content($page, $page_id) {
		$d['title'] = strtoupper($page);
		switch ($page) {
			case 'manage': $d['content'] = $_GET['content']; break;
			case 'create_content':
				$d['smiley_table_bahan'] = $this->_set_smiley('bahan');
				$d['smiley_table_cara'] = $this->_set_smiley('cara');
				$d['smiley_table_desk'] = $this->_set_smiley('desk');
				break;
			case 'update_content':
				$this->load->model('resep_model');
				$d['smiley_table_bahan'] = $this->_set_smiley('bahan');
				$d['smiley_table_cara'] = $this->_set_smiley('cara');
				$d['smiley_table_desk'] = $this->_set_smiley('desk');
				$d['content'] = $this->resep_model->get_resep_by_id($_GET['content']); break;
			default: break; } return $d; }

	private function _set_smiley($smiley_table) {
		$this->load->library('table');
		$image_array = get_clickable_smileys(base_url().'images/smileys/','resep-'.$smiley_table);
		$col_array = $this->table->make_columns($image_array,15);
		return $this->table->generate($col_array);
	}

	public function get_list_contents() {
		if($_GET['content']) { $output = ''; $content = $_GET['content'];
			if($content=="resep") { $this->load->model('resep_model');
				$this->load->model('post_model');
				$resep = $this->resep_model->get_reseps($this->session->userdata('user_id'));
				$output['type'] = 'resep';
				if($resep) {
					foreach ($resep as $r) {
						$output['tanggal'][] = date('h:i a, d M Y', strtotime($r->topic_date));
						$output['kategori'][] = $r->cat_name;
						$output['kategori_id'][] = $r->cat_id; $output['judul'][] = $r->topic_subject;
						$output['komentar'][] = $this->post_model->get_num_comment($r->topic_id);
						$output['penulis'][] = $r->user_name; $output['id'][] = $r->topic_id;
						$output['edit_txt'][] = 'Edit'; $output['del_txt'][] = 'Delete';
						$output['edit_func'][] = 'goToContent("11" , '.$r->topic_id.')';
						$output['del_func'][] = 'yesNoDialog("resep", '.$r->topic_id.')'; } }
				else { $output['tanggal'][] = '-'; $output['kategori'][] = '-';
					$output['kategori_id'][] = '-'; $output['judul'][] = '-';
					$output['komentar'][] = '-';
					$output['penulis'][] = '-'; $output['id'][] = '-';
					$output['edit_txt'][] = ''; $output['edit_func'][] = '';
					$output['del_txt'][] = ''; $output['del_func'][] = ''; } }
			echo json_encode($output); } }
	private function _verifikasi() {
		if($this->session->userdata('is_logged_in')) $this->_permited=true; else $this->_permited=false;
		if($this->session->userdata('user_id') == 1) $this->_full_permitted=true; else $this->_full_permitted=false; } }