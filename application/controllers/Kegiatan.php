<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan extends CI_Controller
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
		
		
        $this->load->model('M_kegiatan');
        $this->load->library('form_validation');
		
		function tgl_indo($date)
		{
			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		 
			$tahun = substr($date, 0, 4);
			$bulan = substr($date, 5, 2);
			$tgl   = substr($date, 8, 2);
		 
			$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
			return $result;
		}
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/kegiatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/kegiatan/index/';
            $config['first_url'] = base_url() . 'index.php/kegiatan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->M_kegiatan->total_rows($q);
        $kegiatan = $this->M_kegiatan->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
			"menu" => "kegiatan",
            'kegiatan_data' => $kegiatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','kegiatan/kegiatan_list', $data);
    }

    public function upload($id) 
    {
       if (!isset($id)) {
		   redirect("kegiatan"); 
	   }
	   

		$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
		
		if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/kegiatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/kegiatan/index/';
            $config['first_url'] = base_url() . 'index.php/kegiatan/index/';
        }
		
		$config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->M_kegiatan->total_rows($q);
        $kegiatan = $this->M_kegiatan->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);
		
		$upload = $this->M_kegiatan->get_uploads_id($id);
        $data['upload_data'] = $upload;
		$row = $this->M_kegiatan->get_by_id($id);
       
        $data['menu'] = "kegiatan";
		$data['id_kegiatan'] = $row->id_kegiatan;
		$data['nama_kegiatan'] = $row->nama_kegiatan;
		$data['tgl_kegiatan'] = $row->tgl_kegiatan;
		$data['tgl_akhir'] = $row->tgl_akhir;
		$data['lokasi'] = $row->lokasi;
		$data['mata_anggaran'] = $row->mata_anggaran;
		$data['pelaksana_kegiatan'] = $row->pelaksana_kegiatan;
		$data['q'] = $q;
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $config['total_rows'];
		$data['start'] = $start;
		
		
		
		
        $this->template->load('template','upload/upload_list', $data);
			
       
    }

    public function create() 
    {
        $data = array(
			"menu" => "kegiatan",
            'button' => 'Create',
            'action' => site_url('kegiatan/create_action'),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'nama_kegiatan' => set_value('nama_kegiatan'),
	    'tgl_kegiatan' => set_value('tgl_kegiatan'),
	    'tgl_akhir' => set_value('tgl_akhir'),
	    'lokasi' => set_value('lokasi'),
	    'mata_anggaran' => set_value('mata_anggaran'),
	    'pelaksana_kegiatan' => set_value('pelaksana_kegiatan'),
	);
        $this->template->load('template','kegiatan/kegiatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
			$tgl_kegiatan   		=  date("Y-m-d", strtotime($this->input->post('tgl_kegiatan',TRUE)));
			$tgl_akhir   			=  date("Y-m-d", strtotime($this->input->post('tgl_akhir',TRUE)));
            $data = array(
		'id_kegiatan' => $this->input->post('id_kegiatan',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'tgl_kegiatan' => $tgl_kegiatan,
		'tgl_akhir'	 => $tgl_akhir,
		'lokasi' => $this->input->post('lokasi',TRUE),
		'mata_anggaran' => $this->input->post('mata_anggaran',TRUE),
		'pelaksana_kegiatan' => $this->input->post('pelaksana_kegiatan',TRUE),
	    );

            $this->M_kegiatan->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function update($id) 
    {
        
		
		$row = $this->M_kegiatan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
				"menu" => "kegiatan",
                'action' => site_url('kegiatan/update_action'),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
		'tgl_kegiatan' => set_value('tgl_kegiatan', $row->tgl_kegiatan),
		'tgl_akhir' => set_value('tgl_akhir', $row->tgl_akhir),
		'lokasi' => set_value('lokasi', $row->lokasi),
		'mata_anggaran' => set_value('mata_anggaran', $row->mata_anggaran),
		'pelaksana_kegiatan' => set_value('pelaksana_kegiatan', $row->pelaksana_kegiatan),
	    );
            $this->template->load('template','kegiatan/kegiatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kegiatan', TRUE));
        } else {
			$tgl_kegiatan   		=  date("Y-m-d", strtotime($this->input->post('tgl_kegiatan',TRUE)));
			$tgl_akhir   			=  date("Y-m-d", strtotime($this->input->post('tgl_akhir',TRUE)));
            $data = array(
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'tgl_kegiatan' => $tgl_kegiatan,
		'tgl_akhir' => $tgl_akhir,
		'lokasi' => $this->input->post('lokasi',TRUE),
		'mata_anggaran' => $this->input->post('mata_anggaran',TRUE),
		'pelaksana_kegiatan' => $this->input->post('pelaksana_kegiatan',TRUE),
	    );

            $this->M_kegiatan->update($this->input->post('id_kegiatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function delete($id) 
    {
        if (!isset($id)) {
		   redirect("kegiatan"); 
	    }
		
		$row = $this->M_kegiatan->get_by_id($id);

        if ($row) {
			$path = "./doc/$id/";
			$cekfile = $this->M_kegiatan->get_uploads_id($id);
			foreach ($cekfile->result() as $r) {
				$file = $r->file;
				unlink($path.$file);
				rmdir($path);
			}
            $this->M_kegiatan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kegiatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kegiatan', 'nama kegiatan', 'trim|required');
	$this->form_validation->set_rules('tgl_kegiatan', 'tanggal kegiatan', 'trim|required');
	$this->form_validation->set_rules('tgl_akhir', 'tanggal akhir', 'trim|required');
	$this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
	$this->form_validation->set_rules('mata_anggaran', 'mata anggaran', 'trim|required');
	$this->form_validation->set_rules('pelaksana_kegiatan', 'pelaksana kegiatan', 'trim|required');

	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kegiatan.php */
/* Location: ./application/controllers/Kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-09-24 11:50:12 */
/* http://harviacode.com */