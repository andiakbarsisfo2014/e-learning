<?php
/**
* 
*/
class M_datatables extends CI_Model
{
	
	var $table 	= 'tbl_resi a';
		var $join 	= 'tbl_penduduk b';
		var $join1 	= 'tbl_kk c';
		var $join2 	= 'tbl_pelayanan d';
		var $column_search = ['b.no_ktp','c.no_kk','b.nama','d.nama_berkas','a.status','a.tgl_stor'];
		var $column_order = ['b.no_ktp','c.no_kk','b.nama','d.nama_berkas','a.status','a.tgl_stor'];

		private function _get_datatables_query()
		{
			$i = 0;
			$this->db->from($this->table);
			$this->db->join($this->join,'a.id_penduduk = b.kode_penduduk','inner');
			$this->db->join($this->join1,'b.no_kk = c.no_kk','inner');
			$this->db->join($this->join2,'a.id_pelayanan = d.id_pelayanan','inner');
			foreach ($this->column_search as $item) // loop column 
			{
				if($_POST['search']['value']) // if datatable send POST for search
				{
					
					if($i===0) // first loop
					{
						$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
						$this->db->like($item, $_POST['search']['value']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']['value']);
					}

					if(count($this->column_search) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
				}
				$i++;
			}
			
			if(isset($_POST['order'])) // here order processing
			{
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}

		function get_datatables()
		{
			$this->_get_datatables_query();
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}

		function count_filtered()
		{
			$this->_get_datatables_query();
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function count_all()
		{
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
}
?>