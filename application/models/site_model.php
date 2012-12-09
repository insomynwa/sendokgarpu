<?php
class Site_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_page_by($id) {
		$query=
			$this->db
				->where("categories.cat_id", $id)
				->select("categories.cat_name,templates.template_name")
				->from("categories")
				->join("templates","templates.template_id=categories.cat_template")
				->get();
		if($query->num_rows()>0)
			return $query->row_array();
		return false;
	}

	public function get_topics_by($id) {
		$query=
			$this->db
				->where("topics.topic_cat", $id)
				->select("topics.topic_subject,topics.topic_id")
				->get("topics");
		if($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	private function _get_records_by_cat($cat_id, $temp) {
		$this->db
			->select("categories.cat_name, categories.cat_description,templates.template_id,templates.template_name")
			->from("categories")
			->join("templates","templates.template_id=categories.cat_template")
			->where("categories.cat_id", $cat_id);
		$query = $this->db->get();

		$data = $query->row_array();

		if($query->num_rows()==1) {
			if($temp=='konten') {
				$tpc = $this->_get_topics_for($cat_id);//print_r($tpc); die;
				if( $tpc != false) {
					return $konten = array(
						"description" => $data['cat_description'],
						"topics" => $tpc
						);
				}
				return $data['cat_description'];
			}
			if($temp=='template') {
				$d = array(
					'template'=>$data['template_name'],
					'cat_name'=>$data['cat_name'],
					'style' =>$this->_get_styles_for($data['template_id'])
					);
				return $d;
			}
		}

		return false;
	}

	public function get_template_for($cat_id) {
		$template = $this->db
							->select("templates.template_name")
							->where("templates.template_cat", $cat_id)
							->get("templates");
		if($template->num_rows()==0)
			return false;
		return $template->row_array();
		/*$data = $this->_get_records_by_cat($cat_id, 'template');
		return $data;*/
	}

	public function get_styles_for($cat_id) {
		$styles = $this->db
							->select("styles.styles_name")
							->from("categories")
							->join("templates","templates.template_cat=categories.cat_id")
							->join("styles","styles.styles_template=templates.template_id")
							->where("categories.cat_id", $cat_id)
							->get();
		if($styles->num_rows()==0)
			return false;
		return $styles->row_array();
	}

	public function get_cat_by($cat_id) {
		$cat = $this->db
						->where("categories.cat_id", $cat_id)
						->get("categories");
		if($cat->num_rows()==0)
			return false;
		return $cat->row_array();
	}

	public function get_scripts_for($cat_id) {
		$scripts = $this->db
							->select("scripts.script_name")
							->where("scripts.script_cat", $cat_id)
							->get("scripts");
		if($scripts->num_rows()==0)
			return false;
		return $scripts->row_array();
	}

	private function _get_topics_for($cat_id) {
		$this->db
			->select("topics.topic_subject")
			->where("topics.topic_cat", $cat_id);
		$query = $this->db->get("topics");
		//print_r($query->result());die;
		if($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

}