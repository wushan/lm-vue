<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_about_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function about_get()
    {
        $query = $this->db->get('tb_about');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function about_banner_get()
    {
        $query = $this->db->order_by('ABID','desc')->get('tb_about_banner');

        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function about_banner_get_by_abid($ABID=false)
    {
        $query = $this->db->where('ABID',$ABID)->get('tb_about_banner');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }
}