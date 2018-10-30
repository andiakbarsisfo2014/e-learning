<?php

	/**
	* 
	*/
	class M_profile extends CI_Model
	{
		
		public function update($tbl,$data,$kondisi)
		{
			return $this->db->update($tbl,$data,$kondisi);
		}

		public function get_where($tbl,$kondisi)
		{
			return $this->db->get_where($tbl,$kondisi);
		}
	}
?>