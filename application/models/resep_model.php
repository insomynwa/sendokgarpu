<?php
class Resep_model extends CI_Model{

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_resep_by_id($topic_id) {
		$query = $this->db
			->where("topics.topic_id", $topic_id)
			->select("topics.*,
				images.img_name,
				receipt.receipt_bahan,receipt.receipt_cara, receipt.receipt_sumber")
			->from("topics")
			->join("receipt","receipt.receipt_topic = topics.topic_id")
			->join("images","images.img_topic=topics.topic_id")
			->get();
		
		if($query->num_rows() > 0){
			$q2 = $query->row_array();
			$user = $this->_get_user_by($q2['topic_by']);
			$q2['penulis'] = $user['user_name'];
			return $q2;//$query->row_array();
		}
		return false;
	}

	private function _get_user_by($id) {
		$this->db
		->select('user.user_name')
		->where('user.user_id',$id);
		$query = $this->db->get('user');
		if($query->num_rows() == 1)
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

	public function get_reseps($user_id) {
		if($user_id != 1) {
			$this->db->where('topics.topic_by', $user_id);
		} 
		$query =
			$this->db
				->select("topics.topic_id, topics.topic_date, categories.cat_id, categories.cat_name, topics.topic_subject, user.user_name")
				->from("topics")
				->join("user","user.user_id=topics.topic_by")
				->join("categories","categories.cat_id=topics.topic_cat")
				->order_by("topics.topic_date", "desc")
				->get();
		if($query->num_rows() > 0)
			return $query->result();
		return false;
	}

	public function add_resep($data) {
		$data_topic = array(
			'topic_subject' => $data['judul'],
			'topic_cat' => $data['kategori'],
			'topic_by' => $data['penulis']
			);
		$this->db->insert('topics', $data_topic);
		$id=$this->_get_last_topic_id();
		$data_receipt = array(
			'receipt_bahan' => $data['bahan'],
			'receipt_cara' => $data['cara'],
			'receipt_sumber' => $data['sumber'],
			'receipt_topic' => $id['topic_id']
			);
		$this->db->insert('receipt', $data_receipt);
		$data_image = array(
			'img_name' => $data['gambar'],
			'img_topic' => $id['topic_id']
			);
		$this->db->insert('images', $data_image);
	}

	private function _get_last_topic_id() {
		$query = $this->db
				->select('topics.topic_id')
				->order_by('topics.topic_date','desc')
				->limit(1)
				->get('topics');
		if($query->num_rows()==1) {
			return $query->row_array();
		}
	}

	public function update_resep($id,$data) {
		$data_topic = array(
			'topic_subject' => $data['judul'],
			'topic_cat' => $data['kategori']
			//'topic_by' => $data['penulis']
			);
		$this->db->where('topics.topic_id', $id);
		$this->db->update('topics', $data_topic);

		$data_receipt = array(
			'receipt_bahan' => $data['bahan'],
			'receipt_cara' => $data['cara'],
			'receipt_sumber' => $data['sumber']
			);
		$this->db->where('receipt.receipt_topic', $id);
		$this->db->update('receipt', $data_receipt);

		$data_image = array(
			'img_name' => $data['gambar'],
			);
		$this->db->where('images.img_topic', $id);
		$this->db->update('images', $data_image);

	}

	public function delete_resep($id) {
		$this->db->where('topics.topic_id',$id);
		$this->db->delete('topics');
	}

	public function get_image_by($id) {
		$this->db->where('images.img_topic', $id);
		$query = $this->db
			->select('images.img_name')
			->get('images');
		if($query->num_rows()==1){
			return $query->row_array();
		}
		return false;
	}
}