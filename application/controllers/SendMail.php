<?php

	/**
	 * Created by PhpStorm.
	 * User: Administrator
	 * Date: 15-1-24
	 * Time: 下午4:20
	 */
	class SendMail extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

		}

		public function index()
		{


			echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>' . "\n";

			$this->load->library('php_mailer');

			$this->db->query("SET NAMES utf8");

			$this->db->where('is_send', "f");
			$this->db->where('to_mail !=', "NULL");
			$this->db->limit('2');
			
			$this->db->select('nick,txt,id,to_mail,');

			$to_mail = $this->db->get('bbq');

			foreach ($to_mail->result() as $row) {

				echo "<br />" . "\n";
				$result = $this->php_mailer->send_mail($row->to_mail, $row->nick, $row->txt, $row->id);
				if ($result == true) {
					$is_send = array('is_send' => "t");
					$this->db->update('bbq', $is_send, "id = $row->id");
					echo $row->to_mail . "   ok" . '<br />' . "\n";
				}
			}

		}
	}