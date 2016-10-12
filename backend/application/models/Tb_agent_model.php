<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_agent_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_agent(){

        $query = $this->db->where('is_add',1)->order_by('aid','desc')->get('tb_agent');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_agent_by_aid($AID=false){
        $this->db->where('AID',$AID);
        $query = $this->db->get('tb_agent');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_order($AID=false){

        $query = $this->db->where('is_add',1)->where('AID',$AID)->order_by('oid','desc')->get('tb_order');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_order_by_oid($OID=false){
        $this->db->where('OID',$OID);
        $query = $this->db->get('tb_order');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_order_detail($OID=false){

        $query = $this->db->where('is_add',1)->where('OID',$OID)->order_by('odid','desc')->get('tb_order_detail');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_order_detail_by_odid($ODID=false){
        $this->db->where('ODID',$ODID);
        $query = $this->db->get('tb_order_detail');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_login_agent($account=false,$password=false){
        $this->db->where('account',$account);
        $this->db->where('password',$password);
        $query = $this->db->get('tb_agent');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_is_login($AID=false,$is_login=false){
        $this->db->where('AID',$AID);
        $this->db->where('is_login',$is_login);
        $query = $this->db->get('tb_agent');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }
}