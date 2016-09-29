<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tb_admin_model extends CI_Model
{
    public function check_admin($account, $password)
    {
        $query = $this->db->where('account', $account)->where('password', md5($password))->where('is_enable', 1)->get('tb_admin');

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function get_admin_by_id($adminId)
    {
        $query = $this->db->where('adminId', $adminId)->get('tb_admin');

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    public function admin_insert($data)
    {
        return $this->db->insert('tb_admin', $data);
    }

    public function admin_update($adminId, $data)
    {
        return $this->db->update('tb_admin', $data, array('adminId' => $adminId));
    }

    public function admin_select()
    {
        $query = $this->db->get('tb_admin');

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
}