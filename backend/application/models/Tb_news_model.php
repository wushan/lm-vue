<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_news_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_news($is_home=false){
        if($is_home){
            $this->db->limit(4);
        }
        $query = $this->db->order_by('date','desc')->get('tb_news');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_news_by_nid($NID=false){
        $this->db->where('NID',$NID);
        $query = $this->db->get('tb_news');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_news_prev($date=false){
        $this->db->where('date<',$date);
        $query = $this->db->order_by('date','desc')->get('tb_news');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_news_next($date=false){
        $this->db->where('date>',$date);
        $query = $this->db->order_by('date','asc')->get('tb_news');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }
}