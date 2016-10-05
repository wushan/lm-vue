<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_inventory_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_inventory(){
        $query = $this->db->order_by('INID','desc')->get('tb_inventory');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_inventory_by_inid($INID=false){
        $this->db->where('INID',$INID);
        $query = $this->db->get('tb_inventory');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }
}