<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('user_agent');
		$this->load->helper('directory');
		$this->load->helper('security');
		$this->load->library('zend');
		$this->load->model('Customer_model');
		$this->load->library('zend');
		}
	public function index()
	{
		$this->load->view('admin/login');
	}
	public function loginpost()
	{
		if(!$this->session->userdata('userdetails'))
		{
			$post=$this->input->post();
			$details=array('email'=>$post['email_id'],'password'=>md5($post['password']));
			$this->customer_model->login_details($post['email'],$pass);
			echo '<pre>';print_r($post);exit;
		}else{
			redirect('admin');
		}
	}
	
	public function emps(){
		
		
		/*test*/
		$this->zend->load('Zend/Barcode');
		//generate barcode
		
		/*test*/
		
		$filename = $this->security->sanitize_filename($this->input->post('name'), TRUE);
		$data=array('d_name'=>$filename);
		$logindatasave = $this->Doctor_model->save_doctors($data);
		
		
		
		$file = Zend_Barcode::draw('code128', 'image', array('text' => $logindatasave), array());
		$code = time().$logindatasave;
		 $store_image1 = imagepng($file, $this->config->item('documentroot')."assets/barcodes/{$code}.png");
			
		$this->Doctor_model->update_doctors_details($logindatasave,$code);
		//echo '<pre>';print_r($test);
		
		
	}
	
	
	
}
