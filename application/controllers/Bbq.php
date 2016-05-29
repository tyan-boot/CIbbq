<?php

	class Bbq extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('email');
			$this->load->helper('url');
			$this->load->library('user_agent');
			$this->load->helper('form');

			$this->load->model('boot_db');

			//设置时区
			date_default_timezone_set('PRC');

		}

		/**
		 * @param int $page
		 */
		public function index($page = 1)
		{

			$bbq_db = new boot_db();

			session_start();
			if ($this->agent->is_mobile()) {
				$_SESSION['view'] = "wap";
			} else $_SESSION['view'] = "pc";

			$data['css_url'] = base_url('application/' . 'CSS');
			$data['image_url'] = base_url('application/' . 'image');
			$data['title'] = "表白墙";

			$msg_sum = $bbq_db->get_sum();
			if ($msg_sum == 0) $msg_sum = 1;
			
			//取得记录数
			$page_max = ceil($msg_sum / 5);

			if ($page >= $page_max) {
				$page = $page_max;
			} else if ($page <= 0) {
				$page = 1;
			}

			$data['page_p'] = $page - 1;
			$data['page_n'] = $page + 1;
			
			$data['page1'] = $page -2;
			$data['page2'] = $page -1;
			$data['page4'] = $page +1;
			$data['page5'] = $page +2;

			$data['page'] = $page;
			$data['page_max'] = $page_max;

			//取得匿名消息
			$id_start = ($page - 1) * 5;
			$data['ano'] = $bbq_db->get_msg($id_start);

			//获取评论数量
			foreach ($data['ano']->result() as $cid) {
				$comment = $bbq_db->get_comment_num($cid->id);
				$comment_num["$cid->id"] = $comment->num_rows();
			}
			$data['comment_num'] = $comment_num;

			if ($_SESSION['view'] == "pc") {
				$this->load->view('index_v', $data);
			} else if ($_SESSION['view'] == "wap") {
				$this->load->view('wap_index', $data);
			}
		}

		public function pid($page=1,$id = 0)
		{

			$data['css_url'] = base_url('application/' . 'CSS');
			$data['image_url'] = base_url('application/' . 'image');
			$data['title'] = "表白墙";
			$data['page'] = $page;

			//获取id
			if ($id == 0) {
				redirect(site_url());
			} else {

				$bbq_db = new boot_db();

				$max_id = $bbq_db->get_max_id('bbq', 'id');
				//计算ID所在页面

				//$data['page'] = ceil(($max_id - $id) / 5);

				if ($id > $max_id) {
					redirect(site_url());
				} else {

					//读取评论
					$data['comment'] = $bbq_db->get_comment($id);

					$sql = $bbq_db->get_ano_msg_single($id);

					$data['sql'] = $sql->row();
					session_start();
					if ($this->agent->is_mobile()) {
						$_SESSION['view'] = "wap";
					} else $_SESSION['view'] = "pc";

					if ($_SESSION['view'] == "pc") {
						$this->load->view('pid_v', $data);
					} else if ($_SESSION['view'] == "wap") {
						$this->load->view('wap_pid', $data);
					}
				}
			}
		}

		public function forcewap()
		{
			session_start();
			$_SESSION['view'] = "wap";
			redirect(site_url("/bbq/index"));
		}

		public function forcepc()
		{
			session_start();
			$_SESSION['view'] = "pc";
			redirect(site_url("/bbq/index"));
		}
	}