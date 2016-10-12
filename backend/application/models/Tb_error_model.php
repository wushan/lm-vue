<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_error_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_error_code()
    {

        $query = $this->db->order_by('ECID', 'desc')->get('tb_error_code');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_error_by_ecid($ECID = false)
    {
        $this->db->where('ECID', $ECID);
        $query = $this->db->get('tb_error_code');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_error($errorCodeID = false, $parentID = false, $get_search_error = false)
    {
        if ($get_search_error) {
            $this->db->select('tb_error.EID as id,tb_error.title as name,tb_error.content as description,tb_error.image,tb_error.file_path as downloads,tb_error.errorCodeID');
        }
        $this->db->join('tb_error_code', 'tb_error_code.ECID=tb_error.errorCodeID');
        $this->db->where('errorCodeID', $errorCodeID);
        $this->db->where('parentID', $parentID);
        $query = $this->db->order_by('EID', 'desc')->get('tb_error');
        if ($query->num_rows() > 0) {
            if ($error = $query->result()) {
                if ($get_search_error) {
                    foreach ($query->result() as $row) {
                        $this->db->select('tb_error.EID as id,tb_error.title as name,tb_error.content as description,tb_error.image,tb_error.file_path as downloads,tb_error.errorCodeID');
                        $row->image=base_url( $row->image);
                        $row->downloads=base_url( $row->downloads);
                        $row->steps = $this->get_error($row->errorCodeID, $row->id,true);
                    }
                }
            }
            return $error;
        }
        return false;
    }

    public function get_error_by_eid($EID = false)
    {
        $this->db->where('EID', $EID);
        $query = $this->db->get('tb_error');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function count_error($errorCodeID = false, $parentID = false)
    {
        $this->db->where('errorCodeID', $errorCodeID);
        $this->db->where('parentID', $parentID);
        $this->db->from('tb_error');
        return $this->db->count_all_results();
    }

    public function get_search_error_code($errorCode = false)
    {
        $this->db->where('errorCode', $errorCode);
        $query = $this->db->order_by('ECID', 'desc')->get('tb_error_code');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }
}