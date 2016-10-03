<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontapi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tb_home_model', 'home');
    }

    public function get_home()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $home = $this->home->home_get();
        $data['introbrand'] = array(
            'title' => $home->title,
            'background' => base_url($home->image),
            'contentheader' => $home->content_title,
            'content' => $home->content
        );
        $data['introproduct'] = array(

        );
        $data['intronews'] = array();
        echo json_encode($data);
    }
}