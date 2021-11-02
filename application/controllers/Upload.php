<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller
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
		
        $this->load->model('M_upload');
        $this->load->model('M_kegiatan');
		
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
            $config['first_url'] = base_url() . 'index.php/upload/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/upload/index/';
            $config['first_url'] = base_url() . 'index.php/upload/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->M_upload->total_rows($q);
        $upload = $this->M_upload->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
			"menu" => "upload",
            'upload_data' => $upload,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','upload/upload_list', $data);
    }

    public function download($id) 
    {
	   $id_kegiatan = $_GET['id_kegiatan']; 

	   $row = $this->M_upload->get_by_id($id);
		$path = "./doc/$id_kegiatan/";
        if ($row) {
            
			$id_upload 	= $row->id_upload;
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
		   redirect("kegiatan"); 
	    }
		
		$row = $this->M_kegiatan->get_by_id($id);
        $_SESSION['id'] = $id;
       
		$data['action'] 			= site_url('upload/create_action');
		$data['menu'] 			= 'kegiatan';
		$data['button'] 		= 'Upload';
		$data['id_upload'] 	= 0;
		$data['id_kegiatan'] 	= $row->id_kegiatan;
		$data['nama_kegiatan'] 	= $row->nama_kegiatan;
		$data2['tgl_kegiatan'] 	= $row->tgl_kegiatan;
		$data2['lokasi']		= $row->lokasi;
		$data2['mata_anggaran'] = $row->mata_anggaran;
		$data2['pelaksana_kegiatan'] = $row->pelaksana_kegiatan;
		
		
		
		
		
		
		
        $this->template->load('template','upload/upload_form', $data);
    }
    
    public function create_action() 
    {
        
		
		
		if(isset($_POST['submit'])){
			
			$id_kegiatan 	= $this->input->post('id_kegiatan',TRUE);
			$nm_file		= $this->input->post('nm_file',TRUE);
			$tgl_skrg 		= date("YmdHis");
			
			
			$path 							= "./doc/$id_kegiatan/";
			$config['upload_path']          = $path;
			$config['allowed_types']        = 'jpg|jpeg|pdf|png';
			$config['file_name']        	= $nm_file."_".$id_kegiatan."_".$tgl_skrg;
			$file_size						= 5048;
			$config['max_size']     		= '5048';
			$config['file_ext_tolower']     = true;
			$config['overwrite']     		= true;
			$config['remove_spaces']     	= true;
			
			
			
			$this->load->library('upload', $config);
			
			if (!file_exists($path)) {
				mkdir("./doc/$id_kegiatan", 0755, TRUE);
			}
			
			
			
			 if ($this->upload->do_upload('dokumen')) {
				$file 		 	= $this->upload->data('file_name');
				$ukuran 		= $this->upload->data('file_size');
				$jenis 			= $this->upload->data('file_type');
				$tgl 			= date("Y-m-d H:i:s");
				$user 			= $_SESSION['username'];
				
				
				
			   
			
				$data = array(
					'id_kegiatan' => $id_kegiatan,
					'nm_file' => $nm_file,
					'file' => $file,
					'ukuran' => $ukuran,
					'jenis' => $jenis,
					'tgl' => $tgl,
					'user' => $user,
				);
				
				
				$this->M_upload->insert($data);
				$this->session->set_flashdata('message', 'Create Record Success 2');
				redirect('kegiatan/upload/'.$id_kegiatan);
				
				
			
			
			} else {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error', $error['error']);
				redirect('kegiatan/upload/'.$id_kegiatan);
			} 
			
			
            
        } 
		if ($_SERVER['CONTENT_LENGTH'] > 125829120 ) {
			$this->session->set_flashdata('error', 'File yang diupload terlalu besar');
			redirect('kegiatan/upload/'.$_SESSION['id']);
		} 
    }
	
	
	
	
    
    
    
    public function delete($id) 
    {
       
	   if (!isset($id)) {
		   redirect("kegiatan"); 
	    }
	   
		$id_kegiatan = $_GET['id_kegiatan']; 
	   $row = $this->M_upload->get_by_id($id);
		 

        if ($row) {
				
			
            $this->M_upload->delete($id);
			$path = "./doc/$id_kegiatan/";
			$file 		= $row->file;
			unlink($path.$file);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect('kegiatan/upload/'.$id_kegiatan);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('kegiatan/upload/'.$id_kegiatan);
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nm_file', 'nm file', 'trim|required');
	$this->form_validation->set_rules('dokumen', 'dokumen', 'trim|required');

	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "upload.xls";
        $judul = "upload";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nm File");
	xlsWriteLabel($tablehead, $kolomhead++, "File");
	xlsWriteLabel($tablehead, $kolomhead++, "Ukuran");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl");
	xlsWriteLabel($tablehead, $kolomhead++, "User");

	foreach ($this->M_upload->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
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
        header("Content-Disposition: attachment;Filename=upload.doc");

        $data = array(
            'upload_data' => $this->M_upload->get_all(),
            'start' => 0
        );
        
        $this->load->view('upload/upload_doc',$data);
    }

}

/* End of file Upload.php */
/* Location: ./application/controllers/Upload.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-09-24 12:02:56 */
/* http://harviacode.com */