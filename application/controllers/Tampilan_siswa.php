<?php

	/**
	* 
	*/
	class Tampilan_siswa extends CI_Controller
	{
		
		public function index()
		{
			$model = $this->m_umum->get('tbl_mapel');
			$this->load->view('siswa_template/_head');
			$this->load->view('siswa_template/index',['model' => $model]);
			$this->load->view('siswa_template/_foot');
		}
	}
?>