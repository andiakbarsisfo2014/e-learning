<?php

	/**
	* 
	*/
	class Dashboard extends MX_Controller
	{
		function __construct()
		{
			$this->load->library('ubah');
			if (is_null($this->session->userdata('data_id'))) {
				
			}
		}
		public function index()
		{
			$this->load->view('_head');
			$this->load->view('index');
			$this->load->view('_foot');
		}
	}
?>