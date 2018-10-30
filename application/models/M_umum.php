<?php
	/**
	* 
	*/
	class M_umum extends CI_Model
	{
		
		public function get_where($tbl,$kondisi)
		{
			return $this->db->get_where($tbl,$kondisi);
		}

		public function get($tbl)
		{
			return $this->db->get($tbl);
		}
	}
?>