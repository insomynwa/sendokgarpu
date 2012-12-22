<?php
class Post_c extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->model("post_model");
	}

	public function load_post() {
		if($_GET['topic']) {
			$topic_id = $_GET['topic'];
			$komen = $this->post_model->get_comment_by_topic($topic_id, false);
			if($komen) {
				foreach ($komen as $k) {
					$output['foto'][] = $k->img_name;
					$output['user'][] = $k->user_name;
					$output['tanggal'][] = $k->post_date;
					$output['komentar'][] = $k->post_content;
				}
				
			}else {
				$output['jumlah'] = "kosong";
				$output['pesan'] = "Belum ada komentar yang dikirim.";
			}
			echo json_encode($output);
		}
	}

	public function add_post() {
		$is_logged_in = false;
		if($this->session->userdata('is_logged_in')) {
			$is_logged_in = true;
		}else {
			$is_logged_in = false;
		}
		if($is_logged_in == FALSE) {
			redirect(base_url());
		}
		if($_POST['topic'] && $_POST['user'] && $_POST['comment']) {
			$data_komen = array(
				"topic" => $_POST['topic'],
				"user"	=> $_POST['user'],
				"komen" => $_POST['comment']
				);
			$topic_id = $_POST['topic'];

			$this->post_model->add_comment($data_komen);
			//echo json_encode($data_komen);die;
			$komen = $this->post_model->get_comment_by_topic($topic_id, true);
			$last_komen['foto'] = $komen['img_name'];
			$last_komen['user'] = $komen['user_name'];
			$last_komen['tanggal'] = $komen['post_date'];
			$last_komen['komentar'] = $komen['post_content'];
			$last_komen['is_true'] = true;
		}else {
			$last_komen['is_true'] = "lengkapi field yang tersedia.";
		}
		echo json_encode($last_komen);
	}

	public function add_message() {
		if($_POST['nama']=="" || $_POST['email']=="" || $_POST['subjek']=="" || $_POST['pesan']=="") {
			$output = false;
		}else {
			$data_msg = array(
				"nama" => $_POST['nama'],
				"email" => $_POST['email'],
				"subjek" => $_POST['subjek'],
				"pesan" => $_POST['pesan']
				);

			$this->post_model->add_message($data_msg);
			$output = "Sukses";
		}

		echo json_encode($output);
	}
}