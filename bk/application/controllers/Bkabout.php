<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkabout extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_about_model','about');
    }

    public function index()
    {
        $about=$this->about->about_get();
        if($post=$this->input->post(null,true)){
            if (isset($_FILES['imageC']) && !$_FILES['imageC']['error']):
                $post['imageC']=$this->upload('about', 850,'C');
                if($about && file_exists($about->imageC)){
                    unlink($about->imageC);
                }
            endif;
            if (isset($_FILES['imageD']) && !$_FILES['imageD']['error']):
                $post['imageD']=$this->upload('about', 850,'D');
                if($about && file_exists($about->imageD)){
                    unlink($about->imageD);
                }
            endif;
            $post['update_time']=date('Y-m-d H:i:s');
            $this->db->update('tb_about',$post,array('AID'=>1));
            redirect('backend/bkabout');
        }

        $data=array(
            'about'=>$about,
            'banner'=>$this->about->about_banner_get()
        );
        $this->get_view('about',$data);
    }

    public function add_banner(){

        if($post=$this->input->post(null,true)){
            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['image']=$this->upload('about_banner', 850);
            endif;
            $post['create_time']=date('Y-m-d H:i:s');
            $this->db->insert('tb_about_banner',$post);
            redirect('backend/bkabout#5');
        }

        $data=array();
        $this->get_view('add_banner',$data);
    }

    public function edit_banner($ABID=false){

        $banner=$this->about->about_banner_get_by_abid($ABID);
        if(!$banner){
            redirect('backend/bkabout#5');
        }
        if($post=$this->input->post(null,true)){
            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['image']=$this->upload('about_banner', 850);
                if($banner && file_exists($banner->image)){
                    unlink($banner->image);
                }
            endif;
            $post['update_time']=date('Y-m-d H:i:s');
            $this->db->update('tb_about_banner',$post,array('ABID'=>$ABID));
            redirect('backend/bkabout#5');
        }

        $data=array(
            'banner'=>$banner
        );
        $this->get_view('edit_banner',$data);
    }

    public function delete_banner($ABID=false){

        $banner=$this->about->about_banner_get_by_abid($ABID);
        if($banner){
            $this->db->delete('tb_about_banner',array('ABID'=>$ABID));
            if($banner && file_exists($banner->image)){
                unlink($banner->image);
            }
        }
        redirect('backend/bkabout#5');
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('backend/about/' . $page, $data, true);
        $this->load->view('backend/index', $this->get_page_nav($content), false);
    }
}