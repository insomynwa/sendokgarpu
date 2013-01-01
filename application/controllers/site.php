<?php
class Site extends CI_Controller {

	public function __construct() { parent::__construct(); $this->load->model('site_model'); }

	public function index() {
		$data['general'] = $this->_set_general_content(7);
		$data['specific'] = $this->_set_specific_content($data['general']['template'], 7);
		$data['main_content'] = $data['general']['template'];
		$this->load->view('pages/page', $data); }

	public function load_page() {
		if($_GET['page']){
			$page_id = $_GET['page']; $cek_page = $this->site_model->check_page($page_id);
			if($cek_page){
				$data['general'] = $this->_set_general_content($page_id);
				$data['specific'] = $this->_set_specific_content($data['general']['template'], $page_id);
				$this->load->view('pages/'.$data['general']['template'], $data); }
			else{ $this->load->view('page/page_not_found'); } }
		else { $this->load->view('pages/beranda'); } }

	private function _set_general_content($page_id) {
		$p = $this->site_model->get_page_by($page_id);
		$content['title'] = $p['cat_name'];
		$content['description'] = $p['cat_description'];
		$content['template'] = $p['template_name'];
		return $content; }

	private function _set_specific_content($page_name,$page_id) {
		$content = array();
		switch ($page_name) {
			case 'beranda':
				$this->load->model('resep_model');
				$content['news_minuman'] = $this->resep_model->get_news_resep(2);
				$content['news_masakan'] = $this->resep_model->get_news_resep(1); break;
			case 'resep':
				# code...
				break;
			case 'subresep':
				$content['list_cat'] = $this->site_model->get_topics_by($page_id); break;
			case 'profile':
				$this->load->model('membership');
				$content['profile'] = $this->membership->get_profile($this->session->userdata('user_id')); break;
			case 'beranda': break;
			case 'beranda': break;
			case 'beranda': break;
			default: break; }
		return $content; }}