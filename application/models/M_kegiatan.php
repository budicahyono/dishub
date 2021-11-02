<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_kegiatan extends CI_Model
{

    public $table = 'kegiatan';
    public $id = 'id_kegiatan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_uploads_id($id)
    {
       return $this->db->query("SELECT * FROM kegiatan k, upload u where k.id_kegiatan=u.id_kegiatan and k.id_kegiatan = $id ");
    }
	
	 function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
	$this->db->like('id_kegiatan', $q);
	$this->db->or_like('nama_kegiatan', $q);
	$this->db->or_like('tgl_kegiatan', $q);
	$this->db->or_like('lokasi', $q);
	$this->db->or_like('mata_anggaran', $q);
	$this->db->or_like('pelaksana_kegiatan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
	$this->db->like('nama_kegiatan', $q);
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

/* End of file M_kegiatan.php */
/* Location: ./application/models/M_kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-09-24 11:50:12 */
/* http://harviacode.com */