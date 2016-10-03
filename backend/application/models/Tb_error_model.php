<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_error_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_error_code(){

        $query = $this->db->order_by('ECID','desc')->get('tb_error_code');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_error_by_ecid($ECID=false){
        $this->db->where('ECID',$ECID);
        $query = $this->db->get('tb_error_code');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_error($errorCodeID=false,$parentID=false){
        $this->db->join('tb_error_code','tb_error_code.ECID=tb_error.errorCodeID');
        $this->db->where('errorCodeID',$errorCodeID);
        $this->db->where('parentID',$parentID);
        $query = $this->db->order_by('EID','desc')->get('tb_error');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_error_by_eid($EID=false){
        $this->db->where('EID',$EID);
        $query = $this->db->get('tb_error');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function count_error($errorCodeID=false,$parentID=false){
        $this->db->where('errorCodeID', $errorCodeID);
        $this->db->where('parentID', $parentID);
        $this->db->from('tb_error');
        return $this->db->count_all_results();
    }
}