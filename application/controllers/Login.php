<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	function __construct(){
		
		parent::__construct();	
		
		
		
		$this->load->model('m_admin');
		$this->load->model('m_user');
			
	}
	
	function index(){
		
			$this->load->view('login/v_loading');
	}
	
	function form(){
		if ($this->session->has_userdata('web')) {
			if ($this->session->userdata('web') == base_url()) {
				if ($this->session->has_userdata('username')) {
					redirect("home"); 
				}
			}		
		}	
			$this->load->view('login/v_admin');
	}
 
	function proses(){
		if ($this->session->has_userdata('web')) {
			if ($this->session->userdata('web') == base_url()) {
				if ($this->session->has_userdata('username')) {
					redirect("home"); 
				}
			}		
		}
		if (isset($_POST['submit'])) {
			$username = $this->input->post('username', TRUE);
			$password = md5($this->input->post('password', TRUE));
			$where = array(
				'username' => $username,
				'password' => $password
				);
			$cek = $this->m_admin->cek_login($where)->num_rows();
			$data = $this->m_admin->cek_login($where);
			if($cek > 0){
				foreach ($data->result() as $r) {
					$id_admin = $r->id_admin;
				$data_session = array(
					'username' 		=> $username,
					'id_admin' 		=> $r->id_admin,
					'level' 		=> $r->level,
					'nama' 			=> $r->nama,
					'web' 			=> base_url()
					);
				}
				$data_login = array(
					'last_login' 	=> date("Y-m-d H:i:s"),
					'is_login' 		=> 1,
					'ip_address' 	=> get_client_ip(),
					'browser' 		=> get_client_browser(),
					'operating_system' 		=> get_client_os(),
					);
				
					$this->m_user->update($id_admin, $data_login);
					$this->session->set_userdata($data_session);
					$this->session->set_flashdata('status', 'Berhasil Login');
					redirect("home");
				
			}else{	
				$this->session->set_flashdata('status', 'Gagal Login');
				redirect("login/form");
			}
		} 
	
	}	
 
	function logout(){
		$id_admin = $_SESSION['id_admin']; 
		$data_login = array(
					'is_login' 		=> 0,
					);
		$this->m_user->update($id_admin, $data_login);			
		echo "<script>localStorage.removeItem('id_admin');</script>";
		$this->session->sess_destroy();
		redirect("login");
	}
}
