<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_product_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function select_product_list_order()
    {
        $this->db->select_max('order');
        $query = $this->db->get('tb_product_list');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function select_products_order()
    {
        $this->db->select_max('order');
        $query = $this->db->get('tb_products');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_product_list(){

        $query = $this->db->order_by('order','desc')->get('tb_product_list');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_product_list_by_plid($PLID=false){
        $this->db->where('PLID',$PLID);
        $query = $this->db->get('tb_product_list');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_products(){

        $query = $this->db->order_by('order','desc')->get('tb_products');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }
    public function get_products_by_pid($PID=false){
        $this->db->where('PID',$PID);
        $query = $this->db->get('tb_products');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

}