<?php
class Resep_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_resep_by_id($topic_id) {
		$query = $this->db
			->where("topics.topic_id", $topic_id)
			->select("topics.topic_subject, topics.topic_date,
				images.img_name,
				receipt.receipt_bahan,receipt.receipt_cara, receipt.receipt_sumber")
			->from("topics")
			->join("receipt","receipt.receipt_topic = topics.topic_id")
			->join("images","images.img_topic=topics.topic_id")
			->get();
		if($query->num_rows() > 0)
			return $query->row_array();
		return false;
	}

	public function get_resep_by_cat($cat_id) {
		$query = $this->db
			->where("topics.topic_cat", $cat_id)
			->select("topics.topic_id,topics.topic_subject")
			->get("topics");
		if($query->num_rows() > 0)
			return $query->result();
		return false;
	}

	public function get_resep() {
		$query =
			$this->db
				->select("topics.topic_id, topics.topic_date, categories.cat_name, topics.topic_subject, user.user_name")
				->from("topics")
				->join("user","user.user_id=topics.topic_by")
				->join("categories","categories.cat_id=topics.topic_cat")
				->order_by("topics.topic_date", "desc")
				->get();
		if($query->num_rows() > 0)
			return $query->result();
		return false;
	}
}