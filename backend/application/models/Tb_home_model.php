<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_home_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function home_get()
    {
        $query = $this->db->get('tb_home');

        if ($query->num_rows() > 0) return $query->row();
        return false;
    }
}