<?php
	/**
	* 
	*/
	class Antrian extends CI_Model
	{
		
		public function setNumber()
		{
			$d = $this->db->get('antrian')->row();
			if (is_null($d)) {
				$this->db->insert('antrian',['aktif' => 0]);
			}
			else{
				$this->db->insert('antrian',['aktif' => 0]);
				$this->db->select_max('id');
				return $this->db->get('antrian')->row();
			}
		}

		

		public function panggil()
		{
			$this->db->select_min('id');
			$r = $this->db->get('antrian')->row();
			if (!is_null($r->id)) {
				$ff = $r;
				$this->db->delete('antrian',['id' => $r->id]);
				return $ff;
			}
			else{
				return $r;
			}
		}
	}

?>