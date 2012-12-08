<?php
class Post_model extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_comment_by_topic($topic_id, $new = false) {
		$this->db
			->where("topics.topic_id", $topic_id)
			->select("user.user_name, images.img_name,post.post_content, post.post_date")
			->from("post")
			->join("topics","post.post_topic=topics.topic_id")
			->join("user","user.user_id=post.post_by")
			->join("images","images.img_by=user.user_id");
		if($new) {
			$this->db->order_by("post.post_date","desc");
			$this->db->limit(1);
		}else {
			$this->db->order_by("post.post_date","asc");
		}

		$query = $this->db->get();

		if($query->num_rows() > 0){
			if($new){
				return $query->row_array();
			}else{
				return $query->result();
			}
		}
		return false;
			
	}

	public function add_comment($data_komen) {
		$data = array(
			"post_by" => $data_komen['user'],
			"post_topic" => $data_komen['topic'],
			"post_content" => $data_komen['komen']
			);
		$this->db->insert("post", $data);
	}

	public function add_message($data_msg) {
		$data = array(
			"contact_name" => $data_msg['nama'],
			"contact_email" => $data_msg['email'],
			"contact_subject" => $data_msg['subjek'],
			"contact_content" => $data_msg['pesan']
			);
		$this->db->insert("contacts", $data);
	}


}