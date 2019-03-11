<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('user_agent');
		$this->load->helper('directory');
		$this->load->helper('security');
		
		
		}
	public function index()
	{	
	$this->load->view('html/index');
	}
	public function contactpost(){
		$post=$this->input->post();
		$add=array(
		'name'=>isset($post['name'])?$post['name']:'',
		'email'=>isset($post['email'])?$post['email']:'',
		'mobile'=>isset($post['mobile'])?$post['mobile']:'',
		'msg'=>isset($post['message'])?$post['message']:'',
		'date'=>date('Y-m-d H:i:s')
		);
		$this->load->model('Admin_model');
		$save=$this->Admin_model->sent_message($add);
					
					if(count($save)>0){
						$this->load->library('email');
							$this->email->set_newline("\r\n");
							$this->email->set_mailtype("html");
							$this->email->from($post['email']);
							$this->email->to('info@hospil.com');
							$this->email->subject('Message - Request');
							$msg='Name:'.$post['name'].' <br> Mobile:'.$post['mobile'].' '.'<br> Email :'.$post['email'].'<br> Message :'.$post['message'];
							$this->email->message($msg);
							$this->email->send();
							$this->session->set_flashdata('success',"Message successfully sent.");
							redirect('');
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('');
					}
	}
	
	
}
