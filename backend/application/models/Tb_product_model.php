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

    public function select_column_order($PID=false)
    {
        $this->db->where('PID', $PID);
        $this->db->select_max('order');
        $query = $this->db->get('tb_spec_column');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function select_spec_order($PID=false)
    {
        $this->db->where('PID', $PID);
        $this->db->select_max('order');
        $query = $this->db->get('tb_spec');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function select_pd_order()
    {
        $this->db->select_max('order');
        $query = $this->db->get('tb_pd');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_product_list()
    {

        $query = $this->db->order_by('order', 'desc')->get('tb_product_list');
        if ($query->num_rows() > 0){
            if($query->result()){
                foreach($list=$query->result() as $row){
                    $row->products=$this->get_products($row->PLID);
                }
                return $list;
            }
        }


        return false;
    }

    public function get_product_list_by_plid($PLID = false)
    {
        $this->db->where('PLID', $PLID);
        $query = $this->db->get('tb_product_list');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_products($PLID=false,$is_home=false,$is_product_page=false)
    {
        $this->db->select('list.name as list_name,tb_products.*');
        $this->db->join('tb_product_list as list', 'list.PLID=tb_products.PLID', 'left');
        if($PLID){
            $this->db->where('tb_products.PLID', $PLID);
        }
        if($is_home){
            $this->db->where('tb_products.is_home', 1);
        }
        if($is_product_page){
            $this->db->where('tb_products.is_product_page', 1);
        }
        $query = $this->db->order_by('order', 'desc')->get('tb_products');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_products_by_pid($PID = false)
    {
        $this->db->select('list.BGimage as list_image,list.name as list_name,tb_products.*');
        $this->db->where('PID', $PID);
        $this->db->join('tb_product_list as list', 'list.PLID=tb_products.PLID', 'left');
        $query = $this->db->get('tb_products');
        if ($query->num_rows() > 0){
            if($row=$query->row()){
                $row->columns=$this->get_spec_column($row->PID);
                return $row;
            }
        }
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
    public function get_spec_column($PID=false)
    {
        $query = $this->db->where('PID', $PID)->order_by('order', 'desc')->get('tb_spec_column');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function get_spec_column_by_sid($PID=false,$SID = false)
    {
        $this->db->where('PID', $PID);
        $this->db->where('SID', $SID);
        $query = $this->db->get('tb_spec_column');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_spec($PID=false)
    {
        $this->db->select('cate.name as cate_name,cate.order as cate_order,tb_spec.*');
        $this->db->join('tb_products as cate', 'cate.PID=tb_spec.PID', 'left');
        $query = $this->db->where('tb_spec.PID', $PID)->order_by('tb_spec.order', 'desc')->get('tb_spec');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }
    public function get_spec_by_spid($PID=false,$SPID = false)
    {
        $this->db->where('PID', $PID);
        $this->db->where('SPID', $SPID);
        $query = $this->db->get('tb_spec');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }

    public function get_pd($PID=false)
    {
        $this->db->select('cate.name as cate_name,tb_pd.*');
        $this->db->join('tb_products as cate', 'cate.PID=tb_pd.PID', 'left');
        if($PID){
            $this->db->where('tb_pd.PID', $PID);
        }
        $query = $this->db->order_by('tb_pd.order', 'desc')->get('tb_pd');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }
    public function get_pd_by_pdid($PDID=false)
    {
        $this->db->where('PDID', $PDID);
        $query = $this->db->get('tb_pd');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }



}