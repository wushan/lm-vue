<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkagent extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_agent_model', 'agt');
        $this->load->model('tb_product_model', 'product');
    }

    public function index()
    {
        $data = array(
            'agent' => $this->agt->get_agent()
        );
        $this->get_view('agent', $data);
    }

    public function add_agent()
    {
        $this->db->insert('tb_agent', array('is_add' => 0,'create_time'=>date('Y-m-d H:i:s')));
        $AID = $this->db->insert_id();
        redirect('bkagent/edit_agent/' . $AID);
    }

    public function edit_agent($AID = false)
    {
        $agent = $this->agt->get_agent_by_aid($AID);
        if(!$agent){
            redirect('bkagent');
        }
        if ($post = $this->input->post(null, true)) {
            $post['update_time'] = date('Y-m-d H:i:s');
            $post['is_add'] = 1;
            $post['buy'] = json_encode(array_unique($post['buy']));
            $this->db->update('tb_agent', $post, array('AID' => $AID));
            $this->db->delete('tb_agent', array('is_add' => 0));
            redirect('bkagent');
        }
        $data = array(
            'agent' => $agent,
            'order' => $this->agt->get_order($AID),
            'product'=>  $this->product->get_products()
        );
        $this->get_view('edit_agent', $data);
    }

    public function delete_agent($AID=false){
        $agent = $this->agt->get_agent_by_aid($AID);
        if($agent){
            $this->db->delete('tb_agent', array('AID' => $AID));
        }
        redirect('bkagent');
    }

    public function add_order($AID=false)
    {
        $this->db->insert('tb_order', array('is_add' => 0,'AID'=>$AID,'create_time'=>date('Y-m-d H:i:s')));
        $OID = $this->db->insert_id();
        redirect('bkagent/edit_order/' . $OID);
    }

    public function edit_order($OID = false)
    {
        $order = $this->agt->get_order_by_oid($OID);
        if(!$order){
            redirect('bkagent/edit_agent/'.$order->AID.'#1');
        }
        if ($post = $this->input->post(null, true)) {
            $post['update_time'] = date('Y-m-d H:i:s');
            $post['is_add'] = 1;
            $this->db->update('tb_order', $post, array('OID' => $OID));
            $this->db->delete('tb_order', array('is_add' => 0));
            redirect('bkagent/edit_agent/'.$order->AID.'#1');
        }
        $data = array(
            'order' => $order,
            'order_detail' => $this->agt->get_order_detail($OID)
        );
        $this->get_view('edit_order', $data);
    }

    public function delete_order($OID=false){
        $order = $this->agt->get_order_by_oid($OID);
        if($order){
            $this->db->delete('tb_order', array('OID' => $OID));
        }
        redirect('bkagent/edit_agent/'.$order->AID.'#1');
    }

    public function add_order_detail($OID=false)
    {
        $this->db->insert('tb_order_detail', array('is_add' => 0,'OID'=>$OID,'create_time'=>date('Y-m-d H:i:s')));
        $ODID = $this->db->insert_id();
        redirect('bkagent/edit_order_detail/' . $ODID);
    }

    public function edit_order_detail($ODID = false)
    {
        $order_detail = $this->agt->get_order_detail_by_odid($ODID);

        if(!$order_detail){
            redirect('bkagent/edit_order/'.$order_detail->$OID.'#1');
        }

        if ($post = $this->input->post(null, true)) {

            if (isset($_FILES['orderFile']) && !$_FILES['orderFile']['error']):
                $file = $this->upload('order', false, 'order');
                $post['file_path'] = $file['file_path'];
                $post['file_name'] = $file['file_name'];
                if ($order_detail && file_exists($order_detail->file_path)) {
                    unlink($order_detail->file_path);
                }
            endif;

            $post['update_time'] = date('Y-m-d H:i:s');
            $post['is_add'] = 1;
            $this->db->update('tb_order_detail', $post, array('ODID' => $ODID));
            $this->db->delete('tb_order_detail', array('is_add' => 0));
            redirect('bkagent/edit_order/'.$order_detail->OID.'#1');
        }

        $data = array(
            'order_detail' => $order_detail
        );
        $this->get_view('edit_order_detail', $data);
    }

    public function delete_order_detail($ODID=false){

        $order_detail = $this->agt->get_order_detail_by_odid($ODID);
        if($order_detail){
            if (file_exists($order_detail->file_path)) {
                unlink($order_detail->file_path);
            }
            $this->db->delete('tb_order_detail', array('ODID' => $ODID));
        }
        redirect('bkagent/edit_order/'.$order_detail->OID.'#1');
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('agent/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}