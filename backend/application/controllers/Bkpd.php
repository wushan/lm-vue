<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkpd extends MY_Controller
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

        $pd=$this->product->get_pd();

        if($post=$this->input->post(null,true)){
            if(isset($post['order'])){
                foreach($post['order'] as $i => $row){
                    $this->db->update('tb_pd', array('order'=>$row), array('PDID' => $i));
                }
            }
            redirect('bkpd');
        }

        $data=array(
            'pd'=>$pd
        );
        $this->get_view('pd_list',$data);
    }

    public function add_pd()
    {
        if ($post = $this->input->post(null, true)) {
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_pd', $post);
            redirect('bkpd');
        }
        $data = array(
            'order'=>$this->product->select_pd_order(),
            'category'=>$this->product->get_products()
        );
        $this->get_view('add_pd', $data);
    }

    public function edit_pd($PDID = false)
    {
        $pd = $this->product->get_pd_by_pdid($PDID);
        if (!$pd) {
            redirect('bkpd');
        }
        if ($post = $this->input->post(null, true)) {

            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_pd', $post, array('PDID' => $PDID));
            redirect('bkpd');
        }

        $data = array(
            'category'=>$this->product->get_products(),
            'pd' => $pd
        );
        $this->get_view('edit_pd', $data);
    }

    public function delete_pd($PDID = false)
    {
        $pd = $this->product->get_pd_by_pdid($PDID);
        if ($pd) {

            $this->db->delete('tb_pd', array('PDID' => $PDID));
        }
        redirect('bkpd');
    }

    public function add_spec($PDID = false)
    {
        $pd = $this->product->get_pd_by_pdid($PDID);
        if($pd){
            $column = $this->product->get_spec_column($pd->PID);
        }else{
            $column='';
        }


        if ($post = $this->input->post(null, true)) {
            $post['spec']=json_encode($post['spec']);
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_pd', $post, array('PDID' => $PDID));
            redirect('bkpd');
        }

        $data = array(
            'column' => $column,
            'PDID' => $PDID,
            'pd'=>$pd
        );

        $this->get_view('add_spec', $data);
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('product/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}