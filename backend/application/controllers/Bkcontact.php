<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkcontact extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_contact_model','contact');
    }

    public function index()
    {
        $contact=$this->contact->contact_get();
        if($post=$this->input->post(null,true)){
            $post['update_time']=date('Y-m-d H:i:s');
            $this->db->update('tb_contact',$post,array('CID'=>1));
            redirect('bkcontact');
        }
        $data=array(
            'contact'=>$contact
        );
        $this->get_view('contact',$data);
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('contact/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}