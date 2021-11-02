<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_inbox extends CI_Model
{

    public $table = 'inbox';
    public $id = 'id_inbox';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
		$this->db->where("status", "terkirim");
		$this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
	
	// get data by id
    function get_uploads_id($id)
    {
       return $this->db->query("SELECT * FROM inbox i, inboxfile f where i.id_inbox=f.id_inbox and i.id_inbox = $id");
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
		$this->db->like('judul', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        
		$this->db->order_by($this->id, $this->order);
		$this->db->join('admin', 'admin.id_admin = inbox.id_admin');
		$this->db->like('judul', $q);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
	
	 // get total rows
    function total_rows_usul($q = NULL) {
        $this->db->like('judul', $q);
		$this->db->where("jenis", "usul");
		if ($_SESSION['level'] == "admin") {
			$this->db->where("status", "terkirim");
		}
		if ($_SESSION['level'] == "operator") {
			$this->db->where("inbox.id_admin", $_SESSION['id_admin']);
		}
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data_usul($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
		$this->db->join('admin', 'admin.id_admin = inbox.id_admin');
		$this->db->like('judul', $q);
		$this->db->where("jenis", "usul");
		if ($_SESSION['level'] == "admin") {
			$this->db->where("status", "terkirim");
		}
		if ($_SESSION['level'] == "operator") {
			$this->db->where("inbox.id_admin", $_SESSION['id_admin']);
		}
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

	// get total rows
    function total_rows_laporan($q = NULL) {
        $this->db->like('judul', $q);
		$this->db->where("jenis", "usul");
		if ($_SESSION['level'] == "admin") {
			$this->db->where("status", "terkirim");
		}
		if ($_SESSION['level'] == "operator") {
			$this->db->where("inbox.id_admin", $_SESSION['id_admin']);
		}
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data_laporan($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
		$this->db->join('admin', 'admin.id_admin = inbox.id_admin');
		$this->db->like('judul', $q);
		$this->db->where("jenis", "laporan");
		if ($_SESSION['level'] == "admin") {
			$this->db->where("status", "terkirim");
		}
		if ($_SESSION['level'] == "operator") {
			$this->db->where("inbox.id_admin", $_SESSION['id_admin']);
		}
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }



    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file M_inbox.php */
/* Location: ./application/models/M_inbox.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-30 05:51:35 */
/* http://harviacode.com */