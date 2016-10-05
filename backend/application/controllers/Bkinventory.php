<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkinventory extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_inventory_model','inventory');
    }

    public function index()
    {

        $inventory=$this->inventory->get_inventory();

        $data=array(
            'inventory'=>$inventory
        );
        $this->get_view('inventory',$data);
    }

    public function add_inventory()
    {
        if ($post = $this->input->post(null, true)) {


            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['image']=$this->upload('inventory', 300);
            endif;

            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_inventory', $post);
            redirect('bkinventory');
        }
        $data = array();
        $this->get_view('add_inventory', $data);
    }

    public function edit_inventory($INID = false)
    {

        $inventory = $this->inventory->get_inventory_by_inid($INID);

        if ($post = $this->input->post(null, true)) {

            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['image']=$this->upload('inventory', 300);
                if($inventory && file_exists($inventory->image)){
                    unlink($inventory->image);
                }
            endif;
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_inventory', $post, array('INID' => $INID));
            redirect('bkinventory');
        }
        if (!$inventory) {
            redirect('bkinventory');
        }

        $data = array(
            'inventory' => $inventory
        );
        $this->get_view('edit_inventory', $data);
    }

    public function delete_inventory($INID = false)
    {
        $inventory = $this->inventory->get_inventory_by_inid($INID);
        if ($inventory) {
            if($inventory && file_exists($inventory->image)){
                unlink($inventory->image);
            }
            $this->db->delete('tb_inventory', array('INID' => $INID));
        }
        redirect('bkinventory');
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('inventory/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}