<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

//Controller: application/controllers/createpdf.php
class reportes extends CI_Controller {	
	function factura()
	{
	    //$this->load->helper('pdf_helper');
	    /*
	        ---- ---- ---- ----
	        your code here
	        ---- ---- ---- ----
	    */	        
	    $this->load->view($this->views->FACTURA, NULL);
	}
}
?>