<?php
/**
* 
*/
class M_server extends CI_Model
{
	
	var $table = 'tbl_mapel a';
	var $join = 'tbl_materi b';
	var $kondisi = array();
	var $posisi;
	
	public function initialize($kondisi,$posisi)
	{
		$this->kondisi = $kondisi;
		$this->posisi = $posisi;
	}

	public function _initialize()
	{
		$this->db->from($this->table);
		$this->db->join($this->join,'a.id_mapel = b.id_mapel','left');
	}

	public function get_data()
	{
		$this->_initialize();
		$this->db->where($this->kondisi);
		$this->db->limit(10,$this->posisi);
		return $this->db->get();
		// return $this->posisi;
	}

	public function count()
	{
		$this->_initialize();
		$this->db->where($this->kondisi);
		return $this->db->count_all_results();
	}

}
?>