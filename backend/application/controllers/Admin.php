<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function index()
	{
		if(is_logged_in(true)){
			redirect("panel");
		}
		
		$this->login();
	}
	
	private function login()
	{
        $this->load->view('login');
	}
}