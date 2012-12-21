<?php
class Resep_c extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("resep_model");
	}

	public function load_content() {
		if($_GET['topic']) {
			$topic_id = $_GET['topic'];
			$receipt = $this->resep_model->get_resep_by_id($topic_id);
			
			if($receipt) {
				$output =
					'{
						"nama":"'.$receipt['topic_subject'].'",
						"tanggal":"'.$receipt['topic_date'].'",
						"gambar":"'.base_url().'images/resep/'.$receipt['img_name'].'",
						"bahan":"'.$this->_remove_line_break($receipt['receipt_bahan']).'",
						"cara":"'.$this->_remove_line_break($receipt['receipt_cara']).'",
						"sumber":"'.$receipt['receipt_sumber'].'"
					}';
				echo $output;
			}
		}
	}

	private function _remove_line_break($content) {
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();

		foreach ($lines as $i => $line) {
		    if(!empty($line))
		        $new_lines[] = trim($line);
		}
		return implode($new_lines);
	}

	public function create_resep() {

		if($_POST['judul']=='' || $_POST['kategori']==''
			|| $_POST['bahan']=='' || $_POST['cara']=='' || $_POST['sumber']=='') {
			$message = array('status' => false, 'msg' => 'field harus diisi semua');
			//$message = "field masih ada yang kosong";
		}else {

			$judul = $_POST['judul'];
			$kategori = $_POST['kategori'];
			$bahan = $_POST['bahan'];
			$cara = $_POST['cara'];
			$sumber = $_POST['sumber'];
			$message = $this->_upload_img($judul);
			if($message['status']) {
				$data = array(
						'judul' => $judul,
						'gambar' => $message['file'],
						'kategori' => $kategori,
						'bahan' => $bahan,
						'cara' => $cara,
						'sumber' => $sumber,
						'penulis' => $this->session->userdata('user_id')
					);
				$this->resep_model->add_resep($data);
			}
			//$message = $judul.$kategori.$bahan.$cara.$sumber.$this->upload_img();
			
			
		}
		echo json_encode($message);
		//echo $message;
	}

	private function _upload_img($filename) {
		$config['file_name'] = $filename;
		$config['upload_path'] = './images/resep/';
		$config['allowed_types'] = 'gif|jpg|png';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('gambar')){
			//$status = "file gambar tidak sesuai";
			$status = array('status'=> false, 'msg' => 'gagal');
		}else{
			$data = $this->upload->data();
			//$status = '<img src="'.base_url().'images/resep/'.$data['file_name'].'" width="100" />';
			$status = array('status'=> true, 'msg' => 'sukses', 'file'=> $data['file_name']);
		}
		return $status;
	}
}