<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		
		
		if (!$this->session->has_userdata('username')) {
			$this->session->sess_destroy();
			redirect("login");
		} else {
			if (!$this->session->has_userdata('web')) {
				$this->session->sess_destroy();
				redirect("login"); 
			} else {
				if ($this->session->userdata('web') == base_url()) {	
					if (file_exists(APPPATH."Controllers\Security.php")) {
					
						include  "Security.php";
						
					}	
				} 
			}
		}	
			
			
		
		$this->load->model('M_user');
		$this->load->model('M_kegiatan');
		$this->load->model('M_inbox');
		
	}
	
	public function index()
	{
		$data['menu'] = "home";
		$data['kegiatan']	=    $this->M_kegiatan->total_rows();
		$data['user']		=    $this->M_user->total_rows();
		$data['usul']		=    $this->M_inbox->total_rows_usul();
		$data['laporan']	=    $this->M_inbox->total_rows_laporan();
		$this->template->load('template','v_home', $data);
	}
	
	public function kill()
	{
		$this->session->sess_destroy();
		redirect("login/form"); 
	}
}
