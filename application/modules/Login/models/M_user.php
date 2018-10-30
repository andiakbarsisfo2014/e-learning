<?php
	/**
	* 
	*/
	class M_user extends CI_Model
	{
		
		public function get_exist_user($tbl,$kondisi)
		{
			return $this->db->get_where($tbl,$kondisi);
		}
	}
?>