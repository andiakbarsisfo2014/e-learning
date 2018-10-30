<?php

	/**
	* 
	*/
	class Home extends MX_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
		}
		public function index()
		{
			$this->load->view('home/_head');
			$this->load->view('index');
			$this->load->view('home/_foot');
		}
	}
?>