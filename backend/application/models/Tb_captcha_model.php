<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_captcha_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_captcha()
    {
        $query = $this->db->get('tb_captcha');
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function delete_captcha()
    {
        $this->db->where('create_time<',date('Y-m-d H:i:s', strtotime('now')-180));
        $this->db->delete('tb_captcha');

        return false;
    }

    public function get_login_captcha($captcha=false){
        $this->db->where('cap',$captcha);
        $query = $this->db->get('tb_captcha');
        if ($query->num_rows() > 0) return $query->row();
        return false;
    }


}