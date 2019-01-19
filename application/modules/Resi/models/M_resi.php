<?php
	/**
	* 
	*/
	class M_resi extends CI_Model
	{
		
		public function get_layanan($id)
		{
			$field = array('jenis_pelayanan');
			for ($i=0; $i < count($field); $i++) { 
				if ($i===0) {
					$this->db->like($field[$i],$id);
				}
				else{
					$this->db->or_like($field[$i],$id);
				}
			}
			$this->db->limit(10);
			return $this->db->get('tbl_pelayanan')->result();

		}

		public function save($tbl,$data)
		{
			return $this->db->insert($tbl,$data);
		}

		public function get_where($tbl,$kondisi)
		{
			return $this->db->get_where($tbl,$kondisi);
		}

		public function update($tbl,$data,$kondisi)
		{
			return $this->db->update($tbl,$data,$kondisi);
		}

		public function delete($tbl,$kondisi)
		{
			return $this->db->delete($tbl,$kondisi);
		}

		public function get_join($tbl,$join,$on,$kondisi)
		{
			$this->db->from($tbl);
			for ($i=0; $i < count($join) ; $i++) { 
				$this->db->join($join[$i],$on[$i],'inner');
			}
			$this->db->where($kondisi);
			return $this->db->get();
		}

		public function truncate()
		{
			$this->db->truncate('antrian');
		}

	}
?>