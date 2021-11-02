<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	

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
		
		$this->load->model('m_admin');
		$this->load->model('m_user');
	}
	
	
	
	
	
	
	public function admin()
	{	
		
		
		$data['menu'] = "auth";
		$data['auth']=    $this->m_admin->get_auth();
		$this->template->load('template','auth/v_admin', $data);
		
	}
	
	public function proses_admin()
	{	
		if (!$this->session->has_userdata('username')) {
			redirect("login/form");
		} else {
			if ($this->session->userdata('level') != 'admin') {
				redirect("naik_pangkat");	
			}
		}	
		if(isset($_POST['submit'])){
			$id_admin   	 =  $this->input->post('id_admin');
			$nama       	 =  $this->input->post('nama');
			$username        =  $this->input->post('username');
			$password        =  md5($this->input->post('password'));
			
			$data           =  array('nama'     	=>$nama,
                                     'username'       =>$username,
                                     'password'       =>$password);
									 
			$this->m_admin->ganti($data, $id_admin);	
			$this->session->set_flashdata('status', 'Data berhasil diganti');
				redirect('auth/admin');
			
		}	
		
	}
	
	
	
	
	
	
	
	
	 
	
	
}
