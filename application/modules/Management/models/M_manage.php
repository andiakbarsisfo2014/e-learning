<?php

	/**
	* 
	*/
	class M_manage extends CI_Model
	{
		
		public function update($tbl,$data,$kondisi)
		{
			return $this->db->update($tbl,$data,$kondisi);
		}

		public function get_where($tbl,$kondisi)
		{
			return $this->db->get_where($tbl,$kondisi);
		}

		public function save($tbl,$data)
		{
			return $this->db->insert($tbl,$data);
		}

		public function delete($tbl,$kondisi)
		{
			return $this->db->delete($tbl,$kondisi);
		}
	}
?>