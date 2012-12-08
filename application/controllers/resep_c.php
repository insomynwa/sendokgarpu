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
}