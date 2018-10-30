<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	function __construct(){

		parent::__construct();	   
	    $this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('upload');
		}

	function render_page($content, $datax = NULL){
		
        $datax['header']   = $this->load->view('template/admin/core/header', $datax, TRUE);
        $datax['content']  = $this->load->view($content, $datax, TRUE);
        $datax['footer']   = $this->load->view('template/admin/core/footer', $datax, TRUE);
		$datax['sidebar']   = $this->load->view('template/admin/core/sidemenu', $datax, TRUE);
		$datax['breadcrumb']   = $this->load->view('template/admin/core/breadcrumb', $datax, TRUE);


        $this->load->view('template/admin/core/index', $datax);
    }
   
}

?>

