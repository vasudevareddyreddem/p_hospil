<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Announcement extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		
	}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				$data['userdetails']=$this->Admin_model->get_all_admin_details($admindetails['a_id']);
				$data['notification']=$this->Admin_model->get_all_resource_announcement($admindetails['a_id']);
				$this->load->view('notification/notification_view',$data);
				$this->load->view('html/footer');
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}
	}
	
	
	
}
