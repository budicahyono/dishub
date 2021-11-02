<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inboxfile extends CI_Controller
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
        $this->load->model('M_inboxfile');
        $this->load->model('M_inbox');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/inboxfile/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/inboxfile/index/';
            $config['first_url'] = base_url() . 'index.php/inboxfile/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->M_inboxfile->total_rows($q);
        $inboxfile = $this->M_inboxfile->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'inboxfile_data' => $inboxfile,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','inboxfile/inboxfile_list', $data);
    }

  public function download($id) 
    {
	   if (!isset($id)) {
		   redirect("home"); 
	    }
	   
	   $id_inbox = $_GET['id']; 
	   $menu = $_GET['jenis']; 

	   $row = $this->M_inboxfile->get_by_id($id);
		$path = "./inbox/$menu/$id_inbox/";
        if ($row) {
            
			$id_inboxfile 	= $row->id_inboxfile;
			$nm_file	= $row->nm_file;
			$file 		= $row->file;
			$ukuran 	= $row->ukuran;
			$jenis 		= $row->jenis;
			$tgl		= $row->tgl;
			$user 		= $row->user;
			
			force_download($path.$file,NULL);	
            
        } 
    }

    public function create($id) 
    {	
		if (!isset($id)) {
		   redirect("home"); 
	    }
		
		if (isset($_GET['jenis'])) { $jenis = $_GET['jenis']; }
		$row = $this->M_inbox->get_by_id($id);
        $_SESSION['id'] = $id;
		
		$data['button'] = 'Create';
		$data['menu'] = $jenis;
		$data['action'] = site_url('inboxfile/create_action');
		$data['id_inbox'] = $row->id_inbox;
		$data['judul'] = $row->judul;
		$data['tgl'] = $row->tgl;
		$data['waktu'] = $row->waktu;
		$data['id_admin'] = $row->id_admin;
		$data['id_inboxfile'] 	= 0;
       
        $this->template->load('template','inboxfile/inboxfile_form', $data);
    }
    
    public function create_action() 
    {
        
		
		
		if(isset($_POST['submit'])){
			
			$menu 	= $this->input->post('menu',TRUE);
			$id_inbox 	= $this->input->post('id_inbox',TRUE);
			$nm_file		= $this->input->post('nm_file',TRUE);
			$tgl_skrg 		= date("YmdHis");
			
			
			$path 							= "./inbox/$menu/$id_inbox/";
			$config['upload_path']          = $path;
			$config['allowed_types']        = 'pdf';
			$config['file_name']        	= $nm_file."_".$id_inbox."_".$tgl_skrg;
			$file_size						= 5048;
			$config['max_size']     		= '5048';
			$config['file_ext_tolower']     = true;
			$config['overwrite']     		= true;
			$config['remove_spaces']     	= true;
			
			
			
			$this->load->library('upload', $config);
			
			if (!file_exists($path)) {
				mkdir("./inbox/$menu/$id_inbox", 0755, TRUE);
			}
			
			
			
			 if ($this->upload->do_upload('dokumen')) {
				$file 		 	= $this->upload->data('file_name');
				$ukuran 		= $this->upload->data('file_size');
				$jenis 			= $this->upload->data('file_type');
				$tgl 			= date("Y-m-d H:i:s");
				$user 			= $_SESSION['username'];
				
				
				
			   
			
				$data = array(
					'id_inbox' => $id_inbox,
					'nm_file' => $nm_file,
					'file' => $file,
					'ukuran' => $ukuran,
					'jenis' => $jenis,
					'tgl' => $tgl,
					'user' => $user,
				);
				
				
				$this->M_inboxfile->insert($data);
				$this->session->set_flashdata('message', 'Create Record Success 2');
				redirect('inboxes/upload/'.$id_inbox.'?jenis='.$menu);
				
				
			
			
			} else {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error', $error['error']);
				redirect('inboxes/upload/'.$id_inbox.'?jenis='.$menu);
			} 
			
			
            
        } 
		if ($_SERVER['CONTENT_LENGTH'] > 125829120 ) {
			$this->session->set_flashdata('error', 'File yang diupload terlalu besar');
			redirect('inboxes/upload/'.$_SESSION['id'].'?jenis='.$menu);
		} 
    }
    
   
    public function delete($id) 
    {
       if (!isset($id)) {
		   redirect("home"); 
	    }
		
		$id_inbox = $_GET['id']; 
		$jenis = $_GET['jenis']; 
	   $row = $this->M_inboxfile->get_by_id($id);
		 

        if ($row) {
            $this->M_inboxfile->delete($id);
			$path = "./inbox/$jenis/$id_inbox/";
			$file 		= $row->file;
			unlink($path.$file);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect('inboxes/upload/'.$id_inbox.'?jenis='.$jenis);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('inboxes/upload/'.$id_inbox.'?jenis='.$jenis);
        }
    }
    

    public function _rules() 
    {
	$this->form_validation->set_rules('id_inbox', 'id inbox', 'trim|required');
	$this->form_validation->set_rules('nm_file', 'nm file', 'trim|required');
	$this->form_validation->set_rules('file', 'file', 'trim|required');
	$this->form_validation->set_rules('ukuran', 'ukuran', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
	$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
	$this->form_validation->set_rules('user', 'user', 'trim|required');

	$this->form_validation->set_rules('id_inboxfile', 'id_inboxfile', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "inboxfile.xls";
        $judul = "inboxfile";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Inbox");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm File");
	xlsWriteLabel($tablehead, $kolomhead++, "File");
	xlsWriteLabel($tablehead, $kolomhead++, "Ukuran");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl");
	xlsWriteLabel($tablehead, $kolomhead++, "User");

	foreach ($this->M_inboxfile->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_inbox);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_file);
	    xlsWriteLabel($tablebody, $kolombody++, $data->file);
	    xlsWriteNumber($tablebody, $kolombody++, $data->ukuran);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl);
	    xlsWriteLabel($tablebody, $kolombody++, $data->user);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=inboxfile.doc");

        $data = array(
            'inboxfile_data' => $this->M_inboxfile->get_all(),
            'start' => 0
        );
        
        $this->load->view('inboxfile/inboxfile_doc',$data);
    }

}

/* End of file Inboxfile.php */
/* Location: ./application/controllers/Inboxfile.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-30 05:51:54 */
/* http://harviacode.com */