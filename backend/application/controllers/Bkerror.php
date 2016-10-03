<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bkerror extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!is_logged_in(true)) {
            redirect("admin");
        }
        $this->load->model('tb_error_model','error');
    }

    public function index()
    {

        $error_code=$this->error->get_error_code();

        $data=array(
            'error_code'=>$error_code
        );
        $this->get_view('error_code',$data);
    }

    public function add_error_code()
    {
        if ($post = $this->input->post(null, true)) {

            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_error_code', $post);
            redirect('bkerror');
        }
        $data = array();
        $this->get_view('add_error_code', $data);
    }

    public function edit_error_code($ECID = false)
    {

        $error_code = $this->error->get_error_by_ecid($ECID);
        if (!$error_code) {
            redirect('bkerror');
        }

        if ($post = $this->input->post(null, true)) {
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_error_code', $post,array('ECID'=>$ECID));
            redirect('bkerror');
        }

        $data = array(
            'error_code' => $error_code
        );
        $this->get_view('edit_error_code', $data);
    }

    public function delete_error_code($ECID = false)
    {
        $error_code = $this->error->get_error_by_ecid($ECID);

        if ($error_code) {
            $this->db->delete('tb_error_code', array('ECID' => $ECID));
        }
        redirect('bkerror');
    }


    public function error_solution($errorCodeID=false,$parentID=false,$back=false){

        $error=$this->error->get_error($errorCodeID,$parentID);
        if(!$parentID){
            $parentID=0;
        }
        $counterror=$this->error->count_error($errorCodeID,$parentID);
        $data=array(
            'error'=>$error,
            'errorCodeID'=>$errorCodeID,
            'counterror'=>$counterror,
            'parentID'=>$parentID,
            'back'=>$back
        );
        $this->get_view('error',$data);
    }

    public function add_error($errorCodeID=false,$parentID=false)
    {
        if(!$parentID){
            $parentID=0;
        }
        $counterror=$this->error->count_error($errorCodeID,$parentID);
        if($counterror==4){
            redirect('bkerror/error_solution/'.$errorCodeID);
        }
        if ($post = $this->input->post(null, true)) {
            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['image']=$this->upload('error', 850);
            endif;
            if (isset($_FILES['errorFile']) && !$_FILES['errorFile']['error']):
              $file=$this->upload('error', false,'error');
                $post['file_path'] = $file['file_path'];
                $post['file_name'] = $file['file_name'];
            endif;
            $post['errorCodeID'] = $errorCodeID;
            $post['parentID'] = $parentID;
            $post['create_time'] = date('Y-m-d H:i:s');
            $this->db->insert('tb_error', $post);
            redirect('bkerror/error_solution/'.$errorCodeID.'/'.$parentID);
        }
        $data = array(
            'errorCodeID'=>$errorCodeID,
            'counterror'=>$counterror,
            'parentID'=>$parentID
        );
        $this->get_view('add_error', $data);
    }

    public function edit_error($errorCodeID=false,$EID = false,$parentID=false)
    {

        $error = $this->error->get_error_by_eid($EID);

        if ($post = $this->input->post(null, true)) {
            if (isset($_FILES['image']) && !$_FILES['image']['error']):
                $post['image']=$this->upload('error', 850);
                if($error && file_exists($error->image)){
                    unlink($error->image);
                }
            endif;
            if (isset($_FILES['errorFile']) && !$_FILES['errorFile']['error']):
                $file=$this->upload('error', false,'error');
                $post['file_path'] = $file['file_path'];
                $post['file_name'] = $file['file_name'];
                if($error && file_exists($error->file_path)){
                    unlink($error->file_path);
                }
            endif;
            $post['update_time'] = date('Y-m-d H:i:s');
            $this->db->update('tb_error', $post,array('EID'=>$EID));
            redirect('bkerror/error_solution/'.$errorCodeID.'/'.$parentID);
        }
        if (!$error) {
            redirect('bkerror/error_solution/'.$errorCodeID.'/'.$parentID);
        }

        $data = array(
            'error' => $error,
            'errorCodeID'=>$errorCodeID,
            'parentID'=>$parentID
        );
        $this->get_view('edit_error', $data);
    }

    public function delete_error($errorCodeID=false,$EID = false,$parentID=false)
    {
        $error = $this->error->get_error_by_eid($EID);

        if ($error) {
            if($error && file_exists($error->image)){
                unlink($error->image);
            }
            if($error && file_exists($error->file_path)){
                unlink($error->file_path);
            }
            $this->db->delete('tb_error', array('EID' => $EID));
        }
        redirect('bkerror/error_solution/'.$errorCodeID.'/'.$parentID);
    }

    private function get_view($page, $data = '')
    {
        $content = $this->load->view('error_shooting/' . $page, $data, true);
        $this->load->view('index', $this->get_page_nav($content), false);
    }
}