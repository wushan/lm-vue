<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_inquiry_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_inquiry()
    {
        $query = $this->db->get('tb_inquiry');

        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_inquiry_by_iqid($IQID=false){
        $this->db->where('IQID',$IQID);
        $query = $this->db->get('tb_inquiry');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }
}