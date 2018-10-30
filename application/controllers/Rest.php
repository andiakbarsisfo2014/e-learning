<?php

	/**
	* 
	*/
	use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
	class Rest extends REST_Controller
	{
		function __construct($config = 'rest')
		{
			parent::__construct($config);
			parent::__construct($config);

	        header('Access-Control-Allow-Origin: *');
	        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
	        header('Content-Type: application/json');
	        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	        $method = $_SERVER['REQUEST_METHOD'];
	        if ($method == "OPTIONS") {
	            die();
	        }
		}
		
		public function akbar_get()
		{
			header('Content-Type: application/json');
			$data = ['username' => 'andiakbar','pos' => 'admin'];
	        echo json_encode(array('data' =>$data));
		}
	}
?>