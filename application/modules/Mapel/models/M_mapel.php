<?php
	/**
	* 
	*/
	class M_mapel extends CI_Model
	{
		
		public function get_where($tbl,$kondisi)
		{
			return $this->db->get_where($tbl,$kondisi);
		}

		public function get($tbl)
		{
			return $this->db->get($tb);
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


		public function get_guru($search)
		{
			$this->db->from('tbl_guru');
			$field = ['id_guru','nama_guru'];
			$this->db->group_start();
			for ($i=0; $i < count($field) ; $i++) { 
				if ($i===0) {
					$this->db->like($field[$i],$search);
				}
				else{
					$this->db->or_like($field[$i],$search);
				}
			}
			$this->db->group_end();
			$this->db->limit(10);
			return $this->db->get()->result();
		}
	}
?>