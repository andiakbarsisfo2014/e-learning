<?php
	
	include_once APPPATH.'/third_party/pdf/fpdf.php';

class F_pdf
{
	
	var $pdf;

	function __construct()
	{
		$this->pdf = new fpdf();
	}
}
?>