<?php
class Post_c extends CI_Controller{

	private $_permited;
	private $_full_permitted;

	public function __construct() { parent::__construct(); $this->load->model("post_model"); $this->_verifikasi(); }

	public function load_post() {
		if($_GET['topic']) {
			$topic_id = $_GET['topic'];
			$komen = $this->post_model->get_comment_by_topic($topic_id, false);
			if($komen) {
				foreach ($komen as $k) {
					$output['id'][] = $k->post_id;
					$output['foto'][] = $k->img_name;
					$output['user'][] = $k->user_name;
					$output['tanggal'][] = date('h:i a, d M Y', strtotime($k->post_date));
					$output['komentar'][] = parse_smileys(str_replace('\n', '<br>', $k->post_content), base_url().'images/smileys/'); 
					if($this->session->userdata('is_logged_in') && $this->session->userdata('user_id')==1) {
						$output['del'][] = '<section class="delete-komentar" ><a onclick="yesNoDialog(\'comment\',\''.$k->post_id.'\')">Delete</a></section>';			
					}else{
						$output['del'][] = '';
					}
				} 
			}
			else {
				$output['jumlah'] = "kosong";
				$output['pesan'] = "Belum ada komentar yang dikirim."; }
			echo json_encode($output); } }

	public function add_post() {
		if(! $this->_permited ) redirect(base_url());
		$topic = mysql_real_escape_string($_POST['topic']);
		$user = mysql_real_escape_string($_POST['user']);
		$comment = mysql_real_escape_string($_POST['comment']);
		if($topic=='' || $user=='' || $comment=='') {
			$output = array('status'=>false,'msg'=>'lengkapi field yang tersedia.'); }
		else {
			if(strlen($comment)<6) { $output = array('status'=>false,'msg'=>'komen terlalu pendek.'); }
			else{ $data_komen = array( "topic" => $topic, "user"=> $user , "komen" => $comment );
				$this->post_model->add_comment($data_komen);
				$output = array('status'=>true,'msg'=>'sukses.'); } }
		echo json_encode($output); }

	public function add_message() {
		$nama = mysql_real_escape_string($_POST['nama']);
		$email = mysql_real_escape_string($_POST['email']);
		$subjek = mysql_real_escape_string($_POST['subjek']);
		$pesan = mysql_real_escape_string($_POST['pesan']);
		if($nama=="" || $email=="" || $subjek=="" || $pesan=="") {
			$output = array('status'=>false,'msg'=>'lengkapi field yang tersedia.'); }
		else {
			if(strlen($nama)<3 || strlen($email)<8 || strlen($subjek)<5 || strlen($pesan)<1) {
				$output = array('status'=>false,'msg'=>'kesalahan pada pengisian field.'); }
			else { $data_msg = array( "nama" => $nama, "email" => $email, "subjek" => $subjek, "pesan" => $pesan );
				$this->post_model->add_message($data_msg);
				$output = array('status'=>true,'msg'=>'terima kasih.'); } }
		echo json_encode($output); }
	public function delete_post() {
		if(! $this->_permited ) redirect(base_url());
		if($_POST['komentar']) {
			$post_id = mysql_real_escape_string($_POST['komentar']);
			$this->post_model->delete_comment($post_id); }  }

	private function _verifikasi() {
		if($this->session->userdata('is_logged_in')) $this->_permited=true; else $this->_permited=false;
		if($this->session->userdata('user_id') == 1) $this->_full_permitted=true; else $this->_full_permitted=false; }
}