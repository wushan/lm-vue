<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends MY_Controller
{

    public function index()
    {
        $this->load->view('backend/index', $this->get_page_nav());
    }

    public function logindo()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        if ($admin = $this->admin->check_admin($username, $password)) {
            $this->db->update('tb_admin', array('LLT' => date('Y-m-d H:i:s')));

            $this->session->set_userdata(
                array(
                    'adminId' => $admin->adminId,
                    'adminName' => $admin->name,
                    'logged_in' => true
                ));

            redirect("backend/panel");
        }
        redirect("admin");
    }

    public function logout()
    {
        $this->session->set_userdata(
            array(
                'adminId' => "",
                'adminName' => "",
                'logged_in' => false
            ));

        redirect("admin");
    }
}