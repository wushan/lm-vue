<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public $uploadPath = 'assets/uploads/';

    /******************** Frontend Function ********************/
    public function get_frontend_view($page, $data = array())
    {
        $this->load->model('tb_category_model', 'category');
        return array(
            'head' => $this->load->view('common/head', '', true),
            'goodbyeie' => $this->load->view('common/goodbyeie', '', true),
            'header' => $this->load->view('common/header', array('category' => $this->category->get_category()), true),
            'slidebar' => $this->load->view('common/slidebar', array('category' => $this->category->get_category()), true),
            'script' => $this->load->view('common/script', '', true),
            'main' => $this->load->view($page, $data, true)
        );
    }

    /******************** Backend Function ********************/
    public function set_active_status($status, $message)
    {
        set_cookie('active[status]', $status, 2);
        set_cookie('active[message]', $message, 2);
    }

    public function get_page_nav($content = false)
    {
        $page_title = "";
        $breadcrumbs = $menuList = $lv = array();

        $menus = $this->menu->menu_get();
        if ($menus) {
            foreach ($menus as $mrow) {
                $menuList[$mrow->menuId] = array(
                    'title' => $mrow->menuTitle,
                    'icon' => $mrow->menuIcon,
                    'url' => !empty($mrow->menuUrl) ? site_url($mrow->menuUrl) : "javascript:;",
                    'active' => strstr(uri_string(), $mrow->menuUrl) ? "active" : false,
                    'prevId' => $mrow->prevId,
                    'is_parent' => false
                );

                if ($mrow->is_enable) {
                    $menuList[$mrow->prevId]['sub'][] = $mrow->menuId;
                    $menuList[$mrow->prevId]['is_parent'] = true;
                }

                if ($menuList[$mrow->menuId]['active']) {
                    $lv[$mrow->lv] = $mrow->menuId;
                }
            }

            if (!empty($lv)) {
                $page_title = $menuList[end($lv)]['title'];
                $prevId = $menuList[end($lv)]['prevId'];
                while ($prevId) {
                    $breadcrumbs[$prevId] = $menuList[$prevId];
                    $menuList[$prevId]['active'] = 'active open';
                    $prevId = $menuList[$prevId]['prevId'];
                }
            }
        }

        return array(
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title,
            'menuList' => $menuList,
            'content' => $content
        );
    }

    public function upload($name, $width = false,$nickname=false)
    {
        $this->uploadPath= 'assets/uploads/';
        if (!is_dir($this->uploadPath)) mkdir($this->uploadPath, 0777);
        if (!is_dir($this->uploadPath .= $name)) mkdir($this->uploadPath, 0777);

        $filePath = null;
        $config['upload_path'] = $this->uploadPath;
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);

        if (isset($_FILES['image'.$nickname]) && $this->upload->do_upload('image'.$nickname)):
            $uploadData = $this->upload->data();
            $filePath = $config['upload_path'] . '/' . uniqid($name) . $uploadData['file_ext'];

            if (is_numeric($width)):
                $temp = getimagesize($uploadData['full_path']);
                $thumbWidth = $temp[0] > $width ? $width : $temp[0];
                $thumbHeight = $temp[0] > $width ? ($width / $temp[0]) * $temp[1] : $temp[1];
                $thumbPath = $filePath;

                if ($temp[0] > $width):
                    if (in_array($uploadData['file_ext'], array('.png', '.gif'))):
                        image_resize_transparent($uploadData['full_path'], $thumbPath, $thumbWidth, $thumbHeight);
                    else:
                        $this->load->library("image_moo");
                        $this->image_moo->load($uploadData['full_path'])->resize($thumbWidth, $thumbHeight)->save($thumbPath);
                    endif;

                    @unlink($uploadData['full_path']);
                    return $thumbPath;
                endif;
            endif;
            @rename($uploadData['full_path'], $filePath);
        elseif (isset($_FILES['file']) && $this->upload->do_upload('file')):
            $uploadData = $this->upload->data();
            $filePath = $config['upload_path'] . '/'. uniqid($name) . $uploadData['file_ext'];
            @rename($uploadData['full_path'], $filePath);
            return $data=array('file_path'=>$filePath,'file_name'=>$uploadData['file_name']);
        else:
            js_warn($this->upload->display_errors('', ''));
        endif;

        return $filePath;
    }
}