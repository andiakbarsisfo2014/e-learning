<?php

	/**
	* 
	*/
	class M_data extends CI_Model
	{
		
		public function get_join($tbl,$to,$on,$kondisi)
		{
			$this->db->from($tbl);
			$this->db->join($to,$on);
			$this->db->where($kondisi);
			return $this->db->get();
		}

		public function get_where($tbl,$kondisi)
		{
			return $this->db->get_where($tbl,$kondisi);
		}

		public function insert($tbl,$data)
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

		public function get_materi($id,$another)
		{
			$field = array('a.id_mapel','a.nama_mapel');
			$this->db->from('tbl_mapel a');
			$this->db->join('tbl_materi b','a.id_mapel = b.id_mapel','inner');
			$this->db->group_start();
			$this->db->where($another);
			$this->db->group_end();
			for ($i=0; $i < count($field); $i++) { 
				if ($i===0) {
					$this->db->like($field[$i],$id);
				}
				else{
					$this->db->or_like($field[$i],$id);
				}
			}
			return $this->db->get()->result();
		}

		public function where_join($tbl,$to,$on,$kondisi)
		{
			return $this->db->from($tbl)->join($to,$on,'inner')->where($kondisi)->get();
		}
	}
?>