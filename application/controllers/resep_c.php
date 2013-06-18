<?php
class Resep_c extends CI_Controller {

	private $_permited;
	private $_full_permitted;

	public function __construct() {
		parent::__construct();
		$this->load->model("resep_model");
		$this->_verifikasi(); }

	public function load_content() {
		if($_GET['topic']) { $topic_id = $_GET['topic'];
			$receipt = $this->resep_model->get_resep_by_id($topic_id);
			if($receipt) {
				$output['nama'] = $receipt['topic_subject'];
				$output['tanggal'] = date('h:i a, d M Y', strtotime($receipt['topic_date']));
				$output['penulis'] = $receipt['penulis'];
				$output['gambar'] = base_url().'images/resep/'.$receipt['img_name'];
				$output['deskripsi'] = parse_smileys(str_replace(array('\r\n', '\r'), '<br>', $receipt['topic_desc']), base_url().'images/smileys/');
				$output['bahan'] = parse_smileys(str_replace(array('\r\n', '\r'), '<br>', $receipt['receipt_bahan']), base_url().'images/smileys/');
				$output['cara'] = parse_smileys(str_replace(array('\r\n', '\r'), '<br>', $receipt['receipt_cara']), base_url().'images/smileys/');
				$output['sumber'] = $receipt['receipt_sumber'];
				echo json_encode($output); } } }

	public function create_or_update_resep() {
		if(! $this->_permited ) redirect(base_url());
		if($_POST['judul']=='' || $_POST['kategori']=='' || $_POST['deskripsi']==''
			|| $_POST['bahan']=='' || $_POST['cara']=='' || $_POST['sumber']=='') {
			$message = array('status' => false, 'msg' => 'field harus diisi semua'); }
		else {
			//$judul = mysql_real_escape_string($_POST['judul']);
			//$kategori = mysql_real_escape_string($_POST['kategori']);
			//$deskripsi = mysql_real_escape_string($_POST['deskripsi']);
			//$bahan = mysql_real_escape_string($_POST['bahan']);
			//$cara = mysql_real_escape_string($_POST['cara']);
			//$sumber = mysql_real_escape_string($_POST['sumber']);
			$judul = $_POST['judul'];
			$kategori = $_POST['kategori'];
			$deskripsi = $_POST['deskripsi'];
			$bahan = $_POST['bahan'];
			$cara = $_POST['cara'];
			$sumber = $_POST['sumber'];
			$data['judul'] = $judul;
			$data['kategori'] = $kategori;
			$data['deskripsi'] = $deskripsi;
			$data['bahan'] = $bahan;
			$data['cara'] = $cara;
			$data['sumber'] = $sumber;
			if($_POST['type']=='create-resep') {
				$data['gambar'] = 'no-image.jpg';
				$data['penulis'] = $this->session->userdata('user_id');
				$data['tipe'] = 'create'; }
			if($_POST['type']=='update-resep') {
				//$data['resep_id'] = mysql_real_escape_string($_POST['id']);
				$data['resep_id'] = $_POST['id'];
				$image = $this->resep_model->get_image_by($data['resep_id']);
				$data['gambar'] = $image['img_name'];
				$data['tipe'] = 'update'; }
			$message = $this->_upload_img($judul);
			if($message['status']) { $data['gambar'] = $message['file']; }
			else { $message = array('status'=> true, 'msg' => 'sukses'); }
			$this->_resep_do($data); } echo json_encode($message); }

	private function _resep_do($data) {
		if($data['tipe']=='create') { $this->resep_model->add_resep($data); }
		else if($data['tipe']=='update') { $this->resep_model->update_resep($data['resep_id'],$data); } }

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
		if(! $this->_permited ) redirect(base_url());
		if($_POST['resep']) {
			//$resep_id = mysql_real_escape_string($_POST['resep']);
			$resep_id = $_POST['resep'];
			$this->resep_model->delete_resep($resep_id); } }

	private function _verifikasi() {
		if($this->session->userdata('is_logged_in')) $this->_permited=true; else $this->_permited=false;
		if($this->session->userdata('user_id') == 1) $this->_full_permitted=true; else $this->_full_permitted=false; }
}