<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkinquiry extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_inquiry_model','inquiry');
    }

    public function index(){

        $data=array(
            'inquiry'=>$this->inquiry->get_inquiry()
        );
        $this->get_view('inquiry', $data);
    }

    public function view_inquiry($IQID=false){

        $inquiry=$this->inquiry->get_inquiry_by_iqid($IQID);

        if(!$inquiry){
            js_warn('資料不存在');
            redirect('bkinquiry');
        }

        $data=array(
            'inquiry'=>$inquiry
        );
        $this->get_view('view_inquiry', $data);
    }

    public function delete_inquiry($IQID=false){

        $inquiry=$this->inquiry->get_inquiry_by_iqid($IQID);
        if($inquiry){
            $this->db->delete('tb_inquiry',array('IQID'=>$IQID));
        }
        redirect('bkinquiry');
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('inquiry/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}