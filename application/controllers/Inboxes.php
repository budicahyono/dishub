<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inboxes extends CI_Controller
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
						
					}	
				} 
			}
		}	
        $this->load->model('M_inbox');
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
        redirect('home');
    }
	
	public function usul()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/inbox/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/inbox/index/';
            $config['first_url'] = base_url() . 'index.php/inbox/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->M_inbox->total_rows_usul($q);
        $inbox = $this->M_inbox->get_limit_data_usul($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'menu' 		 => "usul",
			'jenis' 	 => "USUL",
            'inbox_data' => $inbox,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','inbox/inbox_list', $data);
    }
	
	public function laporan()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/inbox/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/inbox/index/';
            $config['first_url'] = base_url() . 'index.php/inbox/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->M_inbox->total_rows_laporan($q);
        $inbox = $this->M_inbox->get_limit_data_laporan($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'menu' 		 => "laporan",
			'jenis' 	 => "LAPORAN",
            'inbox_data' => $inbox,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','inbox/inbox_list', $data);
    }

    
    public function upload($id) 
    {
		if (!isset($id)) {
		   redirect("home"); 
	    }
		
		if (isset($_GET['jenis'])) { $jenis = $_GET['jenis']; }
        
		$upload = $this->M_inbox->get_uploads_id($id);
        $data['inboxfile_data'] = $upload;
		$row = $this->M_inbox->get_by_id($id);
       
        $data['menu'] = $jenis;
		$data['id_inbox'] = $row->id_inbox;
		$data['judul'] = $row->judul;
		$data['tgl'] = $row->tgl;
		$data['waktu'] = $row->waktu;
		$data['id_admin'] = $row->id_admin;
		
		
		
		
        $this->template->load('template','inboxfile/inboxfile_list', $data);
			
       
    }

    public function create() 
    {
       if (isset($_GET['jenis'])) { $jenis = $_GET['jenis']; }
		
		$data = array(
            'button' => 'Create',
            'menu' => $jenis,
            'form' =>  strtoupper($jenis),
            'action' => site_url('inboxes/create_action'),
	    'id_inbox' => set_value('id_inbox'),
	    'judul' => set_value('judul'),
	    'tgl' => set_value('tgl'),
	    'jenis' => set_value('jenis'),
	    'id_admin' => set_value('id_admin'),
		);
        $this->template->load('template','inbox/inbox_form', $data);
    }
    
    public function create_action() 
    {
        $tgl   		=  date("Y-m-d", strtotime($this->input->post('tgl',TRUE)));
        $waktu   	=  date("H:i:s");

         $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'tgl' => $tgl,
		'waktu' => $waktu,
		'jenis' => $this->input->post('jenis',TRUE),
		'id_admin' => $_SESSION['id_admin'],
	    );
		
			$jenis = $this->input->post('jenis',TRUE);
            $this->M_inbox->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
			if ($jenis == "usul") {
				redirect(site_url('inboxes/usul'));
			} else {
				redirect(site_url('inboxes/laporan'));
			}	
        
    }
    
    public function update($id) 
    {
        
		$row = $this->M_inbox->get_by_id($id);
		if (isset($_GET['jenis'])) { $jenis = $_GET['jenis']; }

        if ($row) {
            $data = array(
                'button' => 'Update',
				'menu' => $jenis,
				'form' =>  strtoupper($jenis),
                'action' => site_url('inboxes/update_action'),
		'id_inbox' => set_value('id_inbox', $row->id_inbox),
		'judul' => set_value('judul', $row->judul),
		'tgl' => set_value('tgl', $row->tgl),
		'jenis' => set_value('jenis', $row->jenis),
		'id_admin' => set_value('id_admin', $row->id_admin),
	    );
            $this->template->load('template','inboxes/inbox_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('inboxes'));
        }
    }
    
    public function update_action() 
    {
        $tgl   		=  date("Y-m-d", strtotime($this->input->post('tgl',TRUE)));
        $waktu   	=  date("H:i:s");

            $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'tgl' => $tgl,
		'waktu' => $waktu,
		'jenis' => $this->input->post('jenis',TRUE),
		'id_admin' => $_SESSION['id_admin'],
	    );
			$jenis = $this->input->post('jenis',TRUE);
            $this->M_inbox->update($this->input->post('id_inbox', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
           if ($jenis == "usul") {
				redirect(site_url('inboxes/usul'));
			} else {
				redirect(site_url('inboxes/laporan'));
			}	
        
    }
    
    public function delete($id) 
    {
        if (!isset($id)) {
		   redirect("home"); 
	    }
		
		$row = $this->M_inbox->get_by_id($id);
		if (isset($_GET['jenis'])) { $jenis = $_GET['jenis']; }

        if ($row) {
			$path = "./inbox/$jenis/$id/";
			$cekfile = $this->M_inbox->get_uploads_id($id);
			foreach ($cekfile->result() as $r) {
				$file = $r->file;
				unlink($path.$file);
				rmdir($path);
			} 
			
            $this->M_inbox->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
        }
		if ($jenis == "usul") {
			redirect(site_url('inboxes/usul'));
		} else {
			redirect(site_url('inboxes/laporan'));
		}	
			
     
    }
	
	public function kirim($id) 
    {
        if (!isset($id)) {
		   redirect("home"); 
	    }
		
		
		if (isset($_GET['jenis'])) { $jenis = $_GET['jenis']; }
		
		$data = array(
			'status' => 'terkirim',
	    );
		
		$this->M_inbox->update($id, $data);
		
		
       
        $this->session->set_flashdata('message', 'Delete Record Success');
       
		if ($jenis == "usul") {
			redirect(site_url('inboxes/usul'));
		} else {
			redirect(site_url('inboxes/laporan'));
		}	
			
     
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
	$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
	$this->form_validation->set_rules('id_admin', 'id admin', 'trim|required');

	$this->form_validation->set_rules('id_inbox', 'id_inbox', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "inbox.xls";
        $judul = "inbox";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Judul");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Admin");

	foreach ($this->M_inbox->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->judul);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_admin);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=inbox.doc");

        $data = array(
            'inbox_data' => $this->M_inbox->get_all(),
            'start' => 0
        );
        
        $this->load->view('inbox/inbox_doc',$data);
    }

}

/* End of file Inbox.php */
/* Location: ./application/controllers/Inbox.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-30 05:51:35 */
/* http://harviacode.com */