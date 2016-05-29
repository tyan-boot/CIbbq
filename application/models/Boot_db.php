<?php

	/**
	 * Created by PhpStorm.
	 * User: Administrator
	 * Date: 15-1-25
	 * Time: 下午3:59
	 */
	class Boot_db extends CI_Model
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		public function get_max_id($table,$field)
		{
			$this->db->select($field);
			$this->db->order_by("$field",'desc');
			$this->db->limit('1');
			
			$max_id = $this->db->get("$table");
			$max_id = $max_id->row();
			$max_id = $max_id->$field;

			return $max_id;
		}

		public function get_comment($id = 0)
		{
			$this->db->query("SET NAMES 'utf8'");
			$this->db->select('comment_id,time,nick,comment');
			$this->db->where('parent_id',"$id");
			
			$comment = $this->db->get('bbq_comment');

			return $comment;
		}

		public function get_ano_msg_single($id)
		{
			$this->db->query("SET NAMES 'utf8'");
			$this->db->select('nick,id,time,txt');
			$this->db->where('id',"$id");
			
			$msg = $this->db->get('bbq');

			return $msg;
		}

		public function get_comment_num($id)
		{
			$this->db->select('comment_id');
			$this->db->where('parent_id',"$id");
			$comment = $this->db->get("bbq_comment");

			return $comment;
		}

		public function get_msg($id_start)
		{
			$this->db->query("SET NAMES utf8");
			$this->db->select('nick,id,time,txt');
			$this->db->where('hide!=','t');
			$this->db->order_by('id','desc');
			$this->db->limit("5","$id_start");
			$msg = $this->db->get('bbq');
			
			return $msg;
		}

		public function get_sum()
		{
			$this->db->select('id');
			$sum = $this->db->get('bbq');
			$sum = $sum->num_rows();

			return $sum;
		}

		public function insert_bbq($table,$sql_dat)
		{
			$this->db->query("SET NAMES utf8");
			$this->db->insert($table, $sql_dat);
		}
	}