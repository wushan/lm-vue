<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkspec extends MY_Controller
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
        $this->get_view('spec',$data);
    }

    public function spec_form($PLID=false)
    {

        $spec=$this->product->get_spec($PLID);

        $data=array(
            'spec'=>$spec,
            'PLID'=>$PLID,
        );
        $this->get_view('spec_form',$data);
    }

    public function add_spec_form($PLID=false)
    {

        $plist=$this->product->get_product_list_by_plid($PLID);
        if ($post = $this->input->post(null, true)) {
            $post['PLID'] = $PLID;
            $post['PID'] = json_encode($post['PID']);
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_spec', $post);
            redirect('bkspec/spec_form/'.$PLID);
        }
        $data = array(
            'order'=>$this->product->select_spec_order($PLID),
            'PLID'=>$PLID,
            'plist'=>$plist,
            'product'=>  $this->product->get_products($PLID)
        );
        $this->get_view('add_spec_form', $data);
    }

    public function edit_spec_form($PLID=false,$SPID=false)
    {

        $plist=$this->product->get_product_list_by_plid($PLID);
        $spec=$this->product->get_spec_by_spid($PLID,$SPID);
        if ($post = $this->input->post(null, true)) {
            $post['PLID'] = $PLID;
            $post['PID'] = json_encode($post['PID']);
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_spec', $post,array('SPID'=>$SPID));
            redirect('bkspec/spec_form/'.$PLID);
        }
        $data = array(
            'order'=>$this->product->select_spec_order($PLID),
            'PLID'=>$PLID,
            'plist'=>$plist,
            'spec'=>$spec,
            'product'=>  $this->product->get_products($PLID)
        );
        $this->get_view('edit_spec_form', $data);
    }

    public function delete_spec_form($PLID = false,$SPID=false)
    {
        $spec=$this->product->get_spec_by_spid($PLID,$SPID);
        if ($spec) {
            $this->db->delete('tb_spec', array('SPID' => $SPID));
        }
        redirect('bkspec/spec_form/'.$PLID);
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('product/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}