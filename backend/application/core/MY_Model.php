<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function set_filter($filter)
    {
        if ($filter):
            foreach ($filter as $type => $row):
                if (!empty($row['value']) || is_numeric($row['value'])):
                    switch ($type):
                        case ($type == 'whereIn'):
                            $this->db->where_in($row['field'], $row['value']);
                            break;
                        case ($type == 'like'):
                            $this->db->like($row['field'], $row['value']);
                            break;
                        case ($type == 'other'):
                            $this->db->where($row['value']);
                            break;
                        default:
                            $this->db->where($row['field'], $row['value']);
                    endswitch;
                endif;
            endforeach;
        endif;
    }

    public function set_order($order)
    {
        if ($order):
            foreach ($order as $row) :
                $this->db->order_by($row['field'], $row['dir']);
            endforeach;
        else:
            $this->db->order_by('create_at', 'desc');
        endif;
    }

    public function set_limit($limit)
    {
        if ($limit):
            $this->db->limit($limit['limit'], $limit['start']);
        endif;
    }
}