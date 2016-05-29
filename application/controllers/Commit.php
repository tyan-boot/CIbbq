<?php

	class Commit extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->load->library('user_agent');
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('email');
			$this->load->library('form_validation');
			$this->load->model('boot_db');
		}

		public function index()
		{
			session_start();
			if ($this->agent->is_mobile()) {
				$_SESSION['view'] = "wap";
			} else $_SESSION['view'] = "pc";

			$data['css_url'] = base_url('application/' . 'CSS');
			$data['image_url'] = base_url('application/' . 'image');
			$data['title'] = "表白墙--写下祝福";
			$data['f_nick'] = "* 必填，将会显示";
			$data['f_txt'] = "亲，你想对Ta说点什么呢";

			if ($_SESSION['view'] == "pc") {
				$this->load->view('write', $data);
			} else $this->load->view('wap_write', $data);
		}

		public function save()
		{

			$bbq_db = new boot_db();

			session_start();
			if ($this->agent->is_mobile()) {
				$_SESSION['view'] = "wap";
			} else $_SESSION['view'] = "pc";

			$data['css_url'] = base_url('application/' . 'CSS');
			$data['image_url'] = base_url('application/' . 'image');
			$data['title'] = "表白墙";
			$this->form_validation->set_rules('n_name', 'nick', 'required');
			$this->form_validation->set_rules('txt', 'txt', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data['f_nick'] = "必须填写";
				$data['f_txt'] = "必须填写";

				if ($_SESSION['view'] == "pc") {
					$this->load->view('write', $data);
				} else {
					$this->load->view('wap_write', $data);
				}
			} else {
				$txt = $this->security->xss_clean($this->input->post('txt'));
				$nick = $this->security->xss_clean($this->input->post('n_name'));

				if ($this->input->post('email') && valid_email($this->input->post('email'))) {
					$mail = $_POST['email'];
				} else $mail = "NULL";

				$id = $bbq_db->get_max_id('bbq','id') + 1;
				$ip = $this->input->ip_address();

				$sql_dat = array(
					'nick'    => "$nick",
					'txt'     => "$txt",
					'id'      => "$id",
					'time'    => time(),
					'ip'	  => "$ip",
					'to_mail' => "$mail",
					'is_send' => "f",
					'hide'	  => "f"
				);
				$bbq_db->insert_bbq('bbq',$sql_dat);
				redirect(site_url());
			}
		}

		public function comment($page = 0)
		{
			$bbq_db = new boot_db();

			$p_id = $this->input->post('parent_id');

			$this->form_validation->set_rules('comment_nick', 'nick', 'required');
			$this->form_validation->set_rules('comment_txt', 'txt', 'required');

			if ($this->form_validation->run() == FALSE) {
				redirect(site_url("/bbq/pid/$p_id"));
			} else {
				session_start();
				$id = $bbq_db->get_max_id('bbq_comment','comment_id') + 1;

				$nick = $this->security->xss_clean($this->input->post('comment_nick'));
				$txt = $this->security->xss_clean($this->input->post('comment_txt'));

				$comment = array(
					'nick'       => "$nick",
					'comment_id' => "$id",
					'comment'    => "$txt",
					'time'       => time(),
					'parent_id'  => "$p_id"
				);

				$bbq_db->insert_bbq('bbq_comment',$comment);
				redirect(site_url("/bbq/pid/$page/$p_id"));
			}
		}
	}

?>