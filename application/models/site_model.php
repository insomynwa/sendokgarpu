<?php
class Site_model extends CI_Model {
	//used
	public function __construct() { parent::__construct(); $this->load->database(); }
	//used
	public function get_page_by($id) {
		$query= $this->db->where("categories.cat_id", $id)
				->select("categories.cat_name,categories.cat_description,templates.template_name")
				->from("categories")
				->join("templates","templates.template_id=categories.cat_template")
				->get();
		if($query->num_rows()>0) return $query->row_array();
		return false; }
	//used
	public function check_page($id) {
		$query = $this->db->where('categories.cat_id', $id)->get('categories');
		if($query->num_rows() == 1) return true;
		return false; }
	//used
	public function get_topics_by($id) {
		$query= $this->db->where("topics.topic_cat", $id)
				->select("topics.topic_subject,topics.topic_id")->order_by('topics.topic_subject','asc')->get("topics");
		if($query->num_rows() > 0) return $query->result();
		return false; }
	//used
	public function get_categories($type) {
		$this->db->where('categories.cat_navi',$type)
			->select('categories.cat_id, categories.cat_name, images.img_name')
			->from('categories')
			->join('images','images.img_cat=categories.cat_id')
			->order_by('categories.cat_id','asc');
		return $this->db->get()->result();
	}
}