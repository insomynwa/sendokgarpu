<?php
class Site extends CI_Controller {

	public function __construct() { parent::__construct(); $this->load->model('site_model'); }
	//used
	public function index() {
		$data['navigation'] = $this->_get_navi(1);
		$data['general'] = $this->_set_general_content(7);
		$data['specific'] = $this->_set_specific_content($data['general']['template'], 7);
		$data['main_content'] = $data['general']['template'];
		$this->load->view('pages/page', $data); }
	//used
	public function load_page() {
		if($_GET['page']){
			$page_id = $_GET['page']; $cek_page = $this->site_model->check_page($page_id);
			if($cek_page){
				$data['general'] = $this->_set_general_content($page_id);
				$data['specific'] = $this->_set_specific_content($data['general']['template'], $page_id);
				$this->load->view('pages/'.$data['general']['template'], $data); }
			else{ $this->load->view('page/page_not_found'); } }
		else { $this->load->view('pages/beranda'); } }
	//used
	private function _set_general_content($page_id) {
		$p = $this->site_model->get_page_by($page_id);
		$content['title'] = $p['cat_name'];
		$content['description'] = $p['cat_description'];
		$content['template'] = $p['template_name'];
		return $content; }
	//used
	private function _set_specific_content($page_name,$page_id) {
		$content = array();
		switch ($page_name) {
			case 'beranda':
				$this->load->model('resep_model');
				$content['news_minuman'] = $this->resep_model->get_news_resep(2);
				$content['news_masakan'] = $this->resep_model->get_news_resep(1); break;
			case 'resep': break;
			case 'subresep':
				$this->load->library('table');
				$image_array = get_clickable_smileys(base_url().'images/smileys/','msg-komen');
				$col_array = $this->table->make_columns($image_array,15);
				$content['smiley_table'] = $this->table->generate($col_array);
				$content['list_cat'] = $this->site_model->get_topics_by($page_id); break;
			case 'profile':
				$this->load->model('membership');
				$content['profile'] = $this->membership->get_profile($this->session->userdata('user_id')); break;
			case 'beranda': break;
			case 'beranda': break;
			case 'beranda': break;
			default: break; }
		return $content; }
	//used
	private function _get_navi($t){
		$n = $this->site_model->get_categories($t);
		foreach ($n as $n2) {
			$navi['sg'][] = '<a class="main-nav" onclick="loadPage(\''.$n2->cat_id.'\')">
				<img src="'.base_url().'styles/images/'.$n2->img_name.'">
				<span>'.$n2->cat_name.'</span></a>';
		}
		return $navi;
	}
}