<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
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
						if ($this->session->userdata('level') == "operator") {
							redirect("home"); 
						} 
					}	
				} 
			}
		}	
		
        $this->load->model('M_user');
        $this->load->library('form_validation');
    }

    public function index()
    {
        
		
		$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/user/index/';
            $config['first_url'] = base_url() . 'index.php/user/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->M_user->total_rows($q);
        $user = $this->M_user->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
			"menu" => "user",
            'user_data' => $user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','user/admin_list', $data);
    }

    
    public function create() 
    {
        $data = array(
		"menu" => "user",
            'button' => 'Create',
            'action' => site_url('user/create_action'),
	    'id_admin' => set_value('id_admin'),
	    'nama' => set_value('nama'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'level' => set_value('level'),
	);
        $this->template->load('template','user/admin_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		'level' => $this->input->post('level',TRUE),
	    );

            $this->M_user->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_user->get_by_id($id);

        if ($row) {
            $data = array(
			"menu" => "user",
                'button' => 'Update',
                'action' => site_url('user/update_action'),
		'id_admin' => set_value('id_admin', $row->id_admin),
		'nama' => set_value('nama', $row->nama),
		'username' => set_value('username', $row->username),
		'level' => set_value('level', $row->level),
	    );
            $this->template->load('template','user/admin_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_admin', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		'level' => $this->input->post('level',TRUE),
	    );
		$pass = $this->input->post('password',TRUE);
		$id = $this->input->post('id_admin',TRUE);
            $this->M_user->update($this->input->post('id_admin', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->session->set_flashdata('password', $pass);
            $this->session->set_flashdata('id_admins', $id);
            redirect(site_url('user'));
        }
    }

	
   
    public function delete($id) 
    {
        
		$row = $this->M_user->get_by_id($id);

        if ($row) {
            $this->M_user->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required',
	array('required' => 'Nama harus di isi!!'));
	$this->form_validation->set_rules('username', 'username', 'trim|required',
	array('required' => 'Username harus di isi!!'));
	$this->form_validation->set_rules('password', 'password', 'trim|required',
	array('required' => 'Password harus di isi!!'));
	$this->form_validation->set_rules('level', 'level', 'trim|required',
	array('required' => 'Level harus di isi!!'));

	$this->form_validation->set_rules('id_admin', 'id_admin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-09-24 11:32:48 */
/* http://harviacode.com */