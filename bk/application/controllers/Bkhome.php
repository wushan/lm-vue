<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkhome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_home_model','home');
    }

    public function index()
    {
        $home=$this->home->home_get();
        if($post=$this->input->post(null,true)){
            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['image']=$this->upload('homepage', 850);
            endif;
            if($home && file_exists($home->image)){
                unlink($home->image);
            }
            $post['update_time']=date('Y-m-d H:i:s');
            $this->db->update('tb_home',$post,array('HID'=>1));
            redirect('backend/bkhome');
        }
        $data=array(
            'home'=>$home
        );
        $this->get_view('home',$data);
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('backend/home/' . $page, $data, true);
        $this->load->view('backend/index', $this->get_page_nav($content), false);
    }
}