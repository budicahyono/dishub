<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluar extends CI_Controller {

	
	function __construct(){
		
		parent::__construct();	
		
		
		
			
	}
	
	function index(){
			echo "error:";
			if ($this->session->has_userdata('keluar')) {	
				echo $_SESSION['keluar'];
			}
	}
 
	
}
