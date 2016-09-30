<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkproductlist extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_product_model','product');
    }

    public function index()
    {

        $plist=$this->product->get_product_list();

        $data=array(
            'plist'=>$plist
        );
        $this->get_view('product_list',$data);
    }

    public function add_product_list()
    {

        if ($post = $this->input->post(null, true)) {
            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['image']=$this->upload('product_list', 850);
            endif;
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_product_list', $post);
            redirect('bkproductlist');
        }
        $data = array(
            'order'=>$this->product->select_product_list_order()
        );
        $this->get_view('add_product_list', $data);
    }

    public function edit_product_list($PLID = false)
    {

        $plist = $this->product->get_product_list_by_plid($PLID);

        if (!$plist) {
            redirect('bkproductlist');
        }

        if ($post = $this->input->post(null, true)) {
            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['image']=$this->upload('product_list', 850);
                if($plist && file_exists($plist->image)){
                    unlink($plist->image);
                }
            endif;
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_product_list', $post, array('PLID' => $PLID));
            redirect('bkproductlist');
        }

        $data = array(
            'order'=>$this->product->select_product_list_order(),
            'plist' => $plist
        );
        $this->get_view('edit_product_list', $data);
    }

    public function delete_product_list($PLID = false)
    {
        $plist = $this->product->get_product_list_by_plid($PLID);
        if ($plist) {
            if($plist && file_exists($plist->image)){
                unlink($plist->image);
            }
            $this->db->delete('tb_product_list', array('PLID' => $PLID));
        }
        redirect('bkproductlist');
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('product/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}