<?php
class Resep_c extends CI_Controller {

	public function __construct() { parent::__construct(); $this->load->model("resep_model"); }

	public function load_content() {
		if($_GET['topic']) { $topic_id = $_GET['topic'];
			$receipt = $this->resep_model->get_resep_by_id($topic_id);
			if($receipt) {
				$output =
					'{ "nama":"'.$receipt['topic_subject'].'",
						"tanggal":"'.$receipt['topic_date'].'",
						"penulis":"'.$receipt['penulis'].'",
						"gambar":"'.base_url().'images/resep/'.$receipt['img_name'].'",
						"bahan":"'.$this->_remove_line_break($receipt['receipt_bahan']).'",
						"cara":"'.$this->_remove_line_break($receipt['receipt_cara']).'",
						"sumber":"'.$receipt['receipt_sumber'].'" }';
				echo $output; } } }

	private function _remove_line_break($content) {
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content); $new_lines = array();
		foreach ($lines as $i => $line) {
		    if(!empty($line)) $new_lines[] = trim($line); }
		return implode($new_lines); }

	public function create_resep() {
		$is_logged_in = false;
		if($this->session->userdata('is_logged_in')) { $is_logged_in = true; }
		else { $is_logged_in = false; }
		if($is_logged_in == FALSE) { redirect(base_url()); }
		if($_POST['judul']=='' || $_POST['kategori']=='' || $_POST['bahan']=='' ||
			$_POST['cara']=='' || $_POST['sumber']=='') {
			$message = array('status' => false, 'msg' => 'field harus diisi semua'); }
		else {
			$judul = mysql_real_escape_string($_POST['judul']);
			$kategori = mysql_real_escape_string($_POST['kategori']);
			$bahan = mysql_real_escape_string($_POST['bahan']);
			$cara = mysql_real_escape_string($_POST['cara']);
			$sumber = mysql_real_escape_string($_POST['sumber']);
			$data = array(
					'judul' => $judul,
					'kategori' => $kategori,
					'bahan' => $bahan,
					'cara' => $cara,
					'gambar' => 'no-image.jpg',
					'sumber' => $sumber,
					'penulis' => $this->session->userdata('user_id') );
			$message = $this->_upload_img($judul);
			if($message['status']) { $data['gambar'] = $message['file']; }
			else { $message = array('status'=> true, 'msg' => 'sukses'); }
			$this->resep_model->add_resep($data); }
		echo json_encode($message); }

	public function update_resep() {
		$is_logged_in = false;
		if($this->session->userdata('is_logged_in')) { $is_logged_in = true; }
		else { $is_logged_in = false; }
		if($is_logged_in == FALSE) { redirect(base_url()); }
		if($_POST['judul']=='' || $_POST['kategori']==''
			|| $_POST['bahan']=='' || $_POST['cara']=='' || $_POST['sumber']=='') {
			$message = array('status' => false, 'msg' => 'field harus diisi semua');
		}else {
			$judul = mysql_real_escape_string($_POST['judul']);
			$kategori = mysql_real_escape_string($_POST['kategori']);
			$bahan = mysql_real_escape_string($_POST['bahan']);
			$cara = mysql_real_escape_string($_POST['cara']);
			$sumber = mysql_real_escape_string($_POST['sumber']);
			$image = $this->resep_model->get_image_by(mysql_real_escape_string($_POST['id']));
			$data = array(
					'judul' => $judul,
					'kategori' => $kategori,
					'bahan' => $bahan,
					'cara' => $cara,
					'gambar' => $image['img_name'],
					'sumber' => $sumber );
			$message = $this->_upload_img($judul);
			if($message['status']) { $data['gambar'] = $message['file']; }
			else { $message = array('status'=> true, 'msg' => 'sukses'); }
			$this->resep_model->update_resep(mysql_real_escape_string($_POST['id']),$data); }
		echo json_encode($message); }

	private function _upload_img($filename) {
		$config['file_name'] = $filename.'_'.time();
		$config['upload_path'] = './images/resep/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('gambar')){ $status = array('status'=> false, 'msg' => 'gagal'); }
		else{ $data = $this->upload->data();
			$status = array('status'=> true, 'msg' => 'sukses', 'file'=> $data['file_name']); }
		return $status; }

	public function delete_resep() {
		$is_logged_in = false;
		if($this->session->userdata('is_logged_in')) { $is_logged_in = true; }
		else { $is_logged_in = false; }
		if($is_logged_in == FALSE) { redirect(base_url()); }
		if($_POST['resep']) {
			$resep_id = mysql_real_escape_string($_POST['resep']);
			$this->resep_model->delete_resep($resep_id); } }
}