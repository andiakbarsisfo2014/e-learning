<?php

	/**
	* 
	*/
	class Dashboard extends MX_Controller
	{
		function __construct()
		{
			$this->load->library('ubah');
			if (!$this->session->userdata('data_id')) {
				redirect(base_url('user/login'));
			}
			// else{
			// 	if ($this->session->userdata('level') != 'admin') {
			// 		$this->load->view('error404');
			// 	}
			// }
		}
		public function index()
		{
			$this->load->view('_head');
			$this->load->view('index');
			$this->load->view('_foot');
		}
	}
?>