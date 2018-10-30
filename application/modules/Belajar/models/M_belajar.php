<?php

	/**
	* 
	*/
	class M_belajar extends CI_Model
	{
		
		public function get_where($tbl,$kondisi)
		{
			return $this->db->get_where($tbl,$kondisi);
		}


		public function join($tbl,$to,$on,$kondisi)
		{
			return $this->db->from($tbl)->join($to,$on,'inner')->where($kondisi)->get();
		}

		public function join2($tbl,$to,$on,$kondisi,$limit)
		{
			$this->db->select(' b.id_soal, b.soal, b.a, b.b, b.c, b.d, b.img_soal, b.img_a, b.img_b, b.img_c, b.img_d');
			return $this->db->from($tbl)->join($to,$on,'inner')->where($kondisi)->limit(10,$limit)->get();
		}

		public function insert($tbl,$data)
		{
			return $this->db->insert($tbl,$data);
		}

		public function join3($tbl,$to,$on,$to1,$on1,$to2,$on2,$kondisi)
		{
			return $this->db->from($tbl)->join($to,$on,'inner')->join($to1,$on1,'inner')->join($to2,$on2,'inner')->where($kondisi)->get();
		}
	}
?>