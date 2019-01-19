<?php

	/**
	* 
	*/
	class M_master extends CI_Model
	{
		
		public function get_where($tbl,$kondisi)
		{
			return $this->db->get_where($tbl,$kondisi);
		}

		public function save($tbl,$data)
		{
			return $this->db->insert($tbl,$data);
		}

		public function update($tbl,$data,$kondisi)
		{
			return $this->db->update($tbl,$data,$kondisi);
		}

		public function delete($tbl,$kondisi)
		{
			return $this->db->delete($tbl,$kondisi);
		}

		public function get_penduduk($id)
		{
			$field = array('no_kk','kepala_keluarga');
			for ($i=0; $i < count($field); $i++) { 
				if ($i===0) {
					$this->db->like($field[$i],$id);
				}
				else{
					$this->db->or_like($field[$i],$id);
				}
			}
			$this->db->limit(10);
			return $this->db->get('tbl_kk')->result();
		}

		public function get_join($tbl,$to,$on,$kondisi)
		{
			return $this->db->from($tbl)->join($to,$on,'inner')->where($kondisi)->get();
		}
	}
?>