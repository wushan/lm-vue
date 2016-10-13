<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_contact_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function contact_get()
    {
        $query = $this->db->get('tb_contact');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_contact_list()
    {
        $query = $this->db->get('tb_contact_list');

        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_contact_list_by_clid($CLID=false){
        $this->db->where('CLID',$CLID);
        $query = $this->db->get('tb_contact_list');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }
}