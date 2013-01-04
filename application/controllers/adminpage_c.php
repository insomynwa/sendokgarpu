<?php
class Adminpage_c extends CI_Controller {

	private $_permited;
	private $_full_permitted;

	public function __construct() {
		parent::__construct();
		$this->_verifikasi();
		if(! $this->_full_permitted) redirect(base_url());
		$this->load->model("site_model"); }

	public function load_content() {
		if($_GET['page']) {
			$page_id = $_GET['page'];
			$page = $this->site_model->get_page_by($page_id);
			if($page) {
				$data = $this->_set_content($page['template_name'],$page_id);
				$this->load->view('admin/'.$page['template_name'], $data); } } }

	public function get_list_contents() {
		if($_GET['content']) {
			$output = '';
			$content = $_GET['content'];
			if($content=="resep") {
				$this->load->model('resep_model');
				$this->load->model('post_model');
				$resep = $this->resep_model->get_reseps($this->session->userdata('user_id'));
				$output['type'] = 'resep';
				if($resep) {
					foreach ($resep as $r) {
						$output['tanggal'][] = date('h:i a, d M Y', strtotime($r->topic_date));
						$output['kategori'][] = $r->cat_name;
						$output['kategori_id'][] = $r->cat_id;
						$output['judul'][] = $r->topic_subject;
						$output['komentar'][] = $this->post_model->get_num_comment($r->topic_id);
						$output['penulis'][] = $r->user_name;
						$output['id'][] = $r->topic_id;
						$output['edit_txt'][] = 'Edit';
						$output['edit_func'][] = 'goToContent("11" , '.$r->topic_id.')';
						$output['del_txt'][] = 'Delete';
						$output['del_func'][] = 'yesNoDialog("resep", '.$r->topic_id.')'; } }
				else {
					$output['tanggal'][] = '-';
					$output['kategori'][] = '-';
					$output['kategori_id'][] = '-';
					$output['judul'][] = '-';
					$output['komentar'][] = '-';
					$output['penulis'][] = '-';
					$output['id'][] = '-';
					$output['edit_txt'][] = '';
					$output['edit_func'][] = '';
					$output['del_txt'][] = '';
					$output['del_func'][] = ''; } }
			if($content=="member") {
				$this->load->model('membership');
				$member = $this->membership->get_users();
				if($member) {
					$output['type'] = 'member';
					foreach ($member as $m) {
						$output['join'][] = date('h:i a, d M Y', strtotime($m->user_join));
						$output['name'][] = $m->user_name;
						$output['email'][] = $m->user_email;
						$output['id'][] = $m->user_id;
						$output['del_txt'][] = 'Delete';
						$output['del_func'][] = 'yesNoDialog("member", '.$m->user_id.')'; } } }
			echo json_encode($output); } }

	private function _set_content($page, $page_id) {
		$d['title'] = strtoupper($page);
		switch ($page) {
			case 'manage': $d['content'] = $_GET['content']; break;
			case 'create_content':
				$this->load->library('table');
				$image_array = get_clickable_smileys(base_url().'images/smileys/','resep-bahan');
				$image_array2 = get_clickable_smileys(base_url().'images/smileys/','resep-cara');
				$image_array3 = get_clickable_smileys(base_url().'images/smileys/','resep-desk');
				$col_array = $this->table->make_columns($image_array,15);
				$col_array2 = $this->table->make_columns($image_array2,15);
				$col_array3 = $this->table->make_columns($image_array3,15);
				$d['smiley_table_bahan'] = $this->table->generate($col_array);
				$d['smiley_table_cara'] = $this->table->generate($col_array2);
				$d['smiley_table_desk'] = $this->table->generate($col_array3);
				break;
			case 'update_content': $this->load->model('resep_model');
				$this->load->library('table');
				$image_array = get_clickable_smileys(base_url().'images/smileys/','resep-bahan');
				$image_array2 = get_clickable_smileys(base_url().'images/smileys/','resep-cara');
				$image_array3 = get_clickable_smileys(base_url().'images/smileys/','resep-desk');
				$col_array = $this->table->make_columns($image_array,15);
				$col_array2 = $this->table->make_columns($image_array2,15);
				$col_array3 = $this->table->make_columns($image_array3,15);
				$d['smiley_table_bahan'] = $this->table->generate($col_array);
				$d['smiley_table_cara'] = $this->table->generate($col_array2);
				$d['smiley_table_desk'] = $this->table->generate($col_array3);
				$d['content'] = $this->resep_model->get_resep_by_id($_GET['content']); break;
			default:
				# code...
				break;
		} return $d; }

	private function _verifikasi() {
		if($this->session->userdata('is_logged_in')) $this->_permited=true; else $this->_permited=false;
		if($this->session->userdata('user_id') == 1) $this->_full_permitted=true; else $this->_full_permitted=false; }
}