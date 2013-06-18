<?php
	class Site extends CI_Controller {

		private $_op;

		public function __construct() {
			parent::__construct();
			$this->load->model('site_model');
			$this->_op = '';
		}

		public function index() {
			$this->load->view('pages/page');
		}

		public function load_page() {
			$cat_id = '';
			if(isset($_GET['page'])) {
				$cat_id = $_GET['page'];
				$cat = array(
						"data"		=> $this->_get_cat_data($cat_id),
						"styles"	=> $this->_get_styles($cat_id),
						"template"	=> $this->_get_templates($cat_id),
						"scripts"	=> $this->_get_scripts($cat_id)
					);
				//print_r($page); die;
				$this->_op =
					'{ "judul":"'.strtoupper($cat['data']['cat_name']).'",
						 "css":"'.str_replace('"',"'",$cat['styles']).'", 
						 "template":"'.str_replace('"',"'",$cat['template']).'", 
						 "script":"'.str_replace('"',"'",$cat['scripts']).'" 
					}';
			}else if(isset($_GET['content'])) {
				$cat_id = $_GET['content'];
				$cat = array(
					"data"	=> $this->_get_cat_data($cat_id)
					);
				$this->_op =
					'{
						"konten":"'.$cat['data']['cat_description'].'"
					}';
			}
			echo $this->_op;
		}

		private function _get_cat_data($page_id){
			return $this->site_model->get_cat_by($page_id);
		}

		private function _get_styles($page_id){
			$styles = $this->site_model->get_styles_for($page_id);

			$style_path = './styles/css/'.$styles['styles_name'].'.css';
			if(($styles!=false || $styles!=null) && file_exists($style_path)) {
				$styles = $this->_remove_line_break(file_get_contents($style_path));
			}else {
				$styles = '';
			}
			return $styles;
		}
		private function _get_templates($page_id){
			$basic_template = $this->_remove_line_break($this->load->view('pages/basic','',true));
			$template = $this->site_model->get_template_for($page_id);
			$template = $basic_template.$this->_remove_line_break($this->load->view('pages/'.$template['template_name'],'',true));
			return $template;
		}
		private function _get_scripts($cat_id){
			$scripts = $this->site_model->get_scripts_for($cat_id);

			$scripts_path = './js/'.$scripts['script_name'].'.js';//print_r($scripts_path);die;
			
			if(($scripts!=false || $scripts!=null) && file_exists($scripts_path)) {
				$scr = $this->_remove_line_break(file_get_contents($scripts_path));
			}else {
				$scr = '';
			}
			return $scr;
		}

		/*public function load_page() {
			$datareq = '';
			if(isset($_GET['halaman'])){
				$datareq = $_GET['halaman'];
				$this->_set_template_for($datareq);
			}
			if(isset($_GET['konten'])){
				$datareq = $_GET['konten'];
				$this->_set_content_for($datareq);
			}

			//$output = '{ "halaman": "'.$content.'" }';
			echo $this->_op;
		}*/

		/*private function _set_template_for($halaman_id) {
			$data = $this->site_model->get_template_for($halaman_id);
			$basic_template = $this->_remove_line_break($this->load->view('pages/basic','',true));

			if($halaman_id==1 || $halaman_id==2) {
				$basic_template = $basic_template.$this->_remove_line_break($this->load->view('pages/subresep','',true));
			}

			if($data==false) {
				$data = $this->site_model->get_template_for(13);
			}
			//echo $data['halaman']['template_name']; die;
			//print_r($data); die;
			$title = strtoupper($data['cat_name']);
			$template = $basic_template.$this->_remove_line_break($this->load->view('pages/'.$data['template'],'',true));
			$style_path = base_url().'styles/css/'.$data['style'].'.css';
			if(($data['style']!=false || $data['style'] != null) && file_exists($style_path)) {
				$style = $this->_remove_line_break(file_get_contents($style_path));
			}else {
				$style = '';
			}

			$this->_op = '{ "judul":"'.$title.'", "template":"'.str_replace('"',"'",$template).'", "css":"'.str_replace('"',"'",$style).'" }';
		}*/

		/*private function _set_content_for($konten_id) {
			$data = $this->site_model->get_description_for($konten_id);
			//print_r($data); die;
			if(isset($data['topics'])) {
				$topics = "Daftar Resep:";
				foreach($data['topics'] as $t) {
					$topics = $topics.'<li><a>'.$t->topic_subject.'</a></li>';
				}
				$this->_op = '{ "konten": "'.$data['description'].'", "topics":"'.str_replace('"',"'",$topics).'" }';
			}else {
				$this->_op = '{ "konten": "'.$data.'" }';
			}

			
		}*/

		/*private function _set_template($halaman) {
			$d['title'] = strtoupper($halaman);
			switch ($halaman) {
				case 'login': case 'kontak': case 'tentang': case 'resep': case 'beranda':
					$data['konten'] = $this->site_model->get_records_by_cat($halaman);
					$d['template'] =
						$this->_set_template($this->load->view('pages/basic','',true)).
						$this->_set_template($this->load->view('pages/'.$data['konten']['template_name'],'',true));
					$d['konten'] = $data['konten']['cat_description'];
					break;
				default:
					$d['konten'] = "page not found.";
					break;
			}
			$this->_set_output($d);
		}*/

		/*private function _set_output($data) {
			$this->_op = '{ "judul":"'.$data['title'].'", "template":"'.str_replace('"',"'",$data['template']).'", "konten":"'.$data['konten'].'"}';

		}*/

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

		/*public function index() {
			$data = $this->_set_data('home', 'beranda');
			$data['news'] = array(
				'masakan' => $this->_news('masakan'),
				'minuman' => $this->_news('minuman')
				);
			$this->load->view('pages/page', $data);
		}

		private function _news($cat) {
			$d = $this->site_model->get_records_by_cat($cat, 1);

			return $d;
		}

		public function resep($cat = '', $id = '') {

			$data = $this->_set_data('resep', 'resep');
			if(!empty($cat)) {
				if(!empty($id)) {
					$data['datas'] = $this->site_model->get_record_by_id($id);
				}else {
					$data['datas'] = $this->site_model->get_records_by_cat($cat, 3);
				}
			}else {
				$data['datas'] = $this->site_model->get_records();
			}

			$this->load->view('pages/page', $data);

		}

		public function pages($p='') {
			$data = $this->_set_data($p, $p);
			

			$this->load->view('pages/page', $data);
		}

		private function _set_data($title, $content) {
			$d['title'] = strtoupper($title);
			$d['content'] = $content;
			return $d;
		}
*/
	}