<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bknews extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_news_model','news');
    }

    public function index()
    {

        $news=$this->news->get_news();

        $data=array(
            'news'=>$news
        );
        $this->get_view('news',$data);
    }

    public function add_news()
    {
        if ($post = $this->input->post(null, true)) {
            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['bgimage']=$this->upload('news', 850);
            endif;
            if (isset($_FILES['imageA']) && !$_FILES['imageA']['error']):
                $post['newsimageA']=$this->upload('news', 850,'A');
            endif;
            if (isset($_FILES['imageB']) && !$_FILES['imageB']['error']):
                $post['newsimageB']=$this->upload('news', 850,'B');
            endif;
            if (isset($_FILES['imageC']) && !$_FILES['imageC']['error']):
                $post['newsimageC']=$this->upload('news', 850,'C');
            endif;
            if (isset($_FILES['imageD']) && !$_FILES['imageD']['error']):
                $post['newsimageD']=$this->upload('news', 850,'D');
            endif;
            $post['create_time'] = date('Y-m-d H:i:s');
            $post['date'] .= date(' H:i:s');
            $this->db->insert('tb_news', $post);
            redirect('bknews');
        }
        $data = array();
        $this->get_view('add_news', $data);
    }

    public function edit_news($NID = false)
    {

        $news = $this->news->get_news_by_nid($NID);

        if ($post = $this->input->post(null, true)) {
            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['bgimage']=$this->upload('news', 850);
                if($news && file_exists($news->bgimage)){
                    unlink($news->bgimage);
                }
            endif;
            if (isset($_FILES['imageA']) && !$_FILES['imageA']['error']):
                $post['newsimageA']=$this->upload('news', 850,'A');
                if($news && file_exists($news->newsimageA)){
                    unlink($news->newsimageA);
                }
            endif;
            if (isset($_FILES['imageB']) && !$_FILES['imageB']['error']):
                $post['newsimageB']=$this->upload('news', 850,'B');
                if($news && file_exists($news->newsimageB)){
                    unlink($news->newsimageB);
                }
            endif;
            if (isset($_FILES['imageC']) && !$_FILES['imageC']['error']):
                $post['newsimageC']=$this->upload('news', 850,'C');
                if($news && file_exists($news->newsimageC)){
                    unlink($news->newsimageC);
                }
            endif;
            if (isset($_FILES['imageD']) && !$_FILES['imageD']['error']):
                $post['newsimageD']=$this->upload('news', 850,'D');
                if($news && file_exists($news->newsimageD)){
                    unlink($news->newsimageD);
                }
            endif;
            $post['update_time'] = date('Y-m-d H:i:s');
            $post['date'] .= date(' H:i:s');
            $this->db->update('tb_news', $post, array('NID' => $NID));
            redirect('bknews');
        }
        if (!$news) {
            redirect('bknews');
        }

        $data = array(
            'news' => $news
        );
        $this->get_view('edit_news', $data);
    }

    public function delete_news($NID = false)
    {
        $news = $this->news->get_news_by_nid($NID);
        if ($NID) {
            if($news && file_exists($news->bgimage)){
                unlink($news->bgimage);
            }
            if($news && file_exists($news->newsimageA)){
                unlink($news->newsimageA);
            }
            if($news && file_exists($news->newsimageB)){
                unlink($news->newsimageB);
            }
            if($news && file_exists($news->newsimageC)){
                unlink($news->newsimageC);
            }
            if($news && file_exists($news->newsimageD)){
                unlink($news->newsimageD);
            }
            $this->db->delete('tb_news', array('NID' => $NID));
        }
        redirect('bknews');
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('news/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}