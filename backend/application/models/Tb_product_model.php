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

    public function select_column_order($PLID=false)
    {
        $this->db->where('PLID', $PLID);
        $this->db->select_max('order');
        $query = $this->db->get('tb_spec_column');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function select_spec_order($PLID=false)
    {
        $this->db->where('PLID', $PLID);
        $this->db->select_max('order');
        $query = $this->db->get('tb_spec');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_product_list()
    {

        $query = $this->db->order_by('order', 'desc')->get('tb_product_list');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_product_list_by_plid($PLID = false)
    {
        $this->db->where('PLID', $PLID);
        $query = $this->db->get('tb_product_list');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_products($PLID=false)
    {
        $this->db->select('list.name as list_name,tb_products.*');
        $this->db->join('tb_product_list as list', 'list.PLID=tb_products.PLID', 'left');
        if($PLID){
            $this->db->where('tb_products.PLID', $PLID);
        }
        $query = $this->db->order_by('order', 'desc')->get('tb_products');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_products_by_pid($PID = false)
    {
        $this->db->where('PID', $PID);
        $query = $this->db->get('tb_products');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function product_show($is_home = false, $is_product_page = false)
    {
        if ($is_home) {
            $this->db->select_sum('is_home');
        }
        if ($is_product_page) {
            $this->db->select_sum('is_product_page');
        }
        $query = $this->db->get('tb_products');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }
    public function get_spec_column($PLID=false)
    {
        $query = $this->db->where('PLID', $PLID)->order_by('order', 'desc')->get('tb_spec_column');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_spec_column_by_sid($PLID=false,$SID = false)
    {
        $this->db->where('PLID', $PLID);
        $this->db->where('SID', $SID);
        $query = $this->db->get('tb_spec_column');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_spec($PLID=false)
    {
        $this->db->select('list.name as list_name,list.order as list_order,tb_spec.*');
        $this->db->join('tb_product_list as list', 'list.PLID=tb_spec.PLID', 'left');
        $query = $this->db->where('tb_spec.PLID', $PLID)->order_by('tb_spec.order', 'desc')->get('tb_spec');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }
    public function get_spec_by_spid($PLID=false,$SPID = false)
    {
        $this->db->where('PLID', $PLID);
        $this->db->where('SPID', $SPID);
        $query = $this->db->get('tb_spec');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }



}