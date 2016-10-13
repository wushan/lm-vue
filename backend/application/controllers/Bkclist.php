<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class bkclist extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_contact_model','contact');
    }

    public function index(){

        $data=array(
            'clist'=>$this->contact->get_contact_list()
        );
        $this->get_view('clist', $data);
    }

    public function view_contact_list($CLID=false){

        $clist=$this->contact->get_contact_list_by_clid($CLID);

        if(!$clist){
            js_warn('資料不存在');
            redirect('bkclist');
        }

        $data=array(
            'clist'=>$clist
        );
        $this->get_view('view_contact_list', $data);
    }

    public function delete_contact_list($CLID=false){

        $clist=$this->contact->get_contact_list_by_clid($CLID);
        if($clist){
            $this->db->delete('tb_contact_list',array('CLID'=>$CLID));
        }
        redirect('bkclist');
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('clist/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}