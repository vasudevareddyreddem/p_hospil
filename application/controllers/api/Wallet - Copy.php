<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Wallet extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->model('Mobile_model');
    }

	  public function wallet_post(){
			$a_u_id=$this->post('a_u_id');
			if($a_u_id==''){
				$message = array('status'=>0,'message'=>'User Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			$wallet_detail=$this->Mobile_model->get_wallet_amount_details($a_u_id);
				if(count($wallet_detail)>0){
					if($wallet_detail['remaining_wallet_amount']!=''){
						$usedamt=(($wallet_detail['wallet_amount'])-($wallet_detail['remaining_wallet_amount']));
					}else{
						$usedamt='';
					}
				$message = array('status'=>1,'totalbalance'=>$wallet_detail['wallet_amount'],'remainingwalletamount'=>$wallet_detail['remaining_wallet_amount'],'usedbalanceamount'=>"$usedamt",'message'=>'Wallet Details are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Appointment list not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	  } 
	  public function op_post(){
			$a_u_id=$this->post('a_u_id');
			if($a_u_id==''){
				$message = array('status'=>0,'message'=>'User Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			$appoinment_list=$this->Mobile_model->get_user_appointment_list($a_u_id);
				if(count($appoinment_list)>0){
				$message = array('status'=>1,'list'=>$appoinment_list,'message'=>'Appointment list are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Appointment list not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	  } 
	  public function generateopcoupon_post(){
			$b_id=$this->post('b_id');
			$a_u_id=$this->post('a_u_id');
			if($a_u_id==''){
				$message = array('status'=>0,'message'=>'User Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			if($b_id==''){
				$message = array('status'=>0,'message'=>'Bidding Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
				$appoinment_details=$this->Mobile_model->get_appointment_details($b_id);
				$hos_name=mb_substr($appoinment_details['hos_bas_name'], 0, 2);
				$hos_id=$appoinment_details['hos_id'];
				$op='op';
				$coupon_code=$hos_name.$hos_id.$op.$b_id;
				$wallet_amt_list=$this->Mobile_model->get_wallet_amount_percentages($appoinment_details['hos_id']);
				//echo '<pre>';print_r($wallet_amt_list);exit;
					$add=array(
						'hos_id'=>isset($appoinment_details['hos_id'])?$appoinment_details['hos_id']:'',
						'appointment_id'=>isset($b_id)?$b_id:'',
						'couponcode_name'=>isset($coupon_code)?$coupon_code:'',
						'ip_amount_percentage'=>isset($wallet_amt_list['ip_amount_percentage'])?$wallet_amt_list['ip_amount_percentage']:'',
						'op_amount_percentage'=>isset($wallet_amt_list['op_amount_percentage'])?$wallet_amt_list['op_amount_percentage']:'',
						'lab_amount_percentage'=>isset($wallet_amt_list['lab_amount_percentage'])?$wallet_amt_list['lab_amount_percentage']:'',
						'statu'=>1,
						'created_at'=>date('Y-m-d H:i:s'),
						'created_by'=>$a_u_id,
					);
				$check=$this->Mobile_model->check_couponcode_exists_ornot($b_id,$appoinment_details['hos_id']);
				if(count($check)>0){
					$message = array('status'=>0,'b_id'=>$b_id,'message'=>"Your are already created coupon code. Use below code ".$check['couponcode_name']);
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$save=$this->Mobile_model->save_couponcode($add);
					if(count($save)>0){
						$message = array('status'=>1,'b_id'=>$b_id,'message'=>"Coupon code successfully created. Use below code ".$coupon_code);
						$this->response($message, REST_Controller::HTTP_OK);
					}else{
						$message = array('status'=>0,'b_id'=>$b_id,'message'=>"Technical problem will occurred. Please try again");
						$this->response($message, REST_Controller::HTTP_OK);
					}
				}
			
	  }
	  public function viewcoupon_code_post(){
			$b_id=$this->post('b_id');
			if($b_id==''){
				$message = array('status'=>0,'message'=>'Bidding Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			$details=$this->Mobile_model->get_coupon_code_details($b_id);
			if(count($details)>0){
				$message = array('status'=>1,'b_id'=>$b_id,'couponcode_name'=>$details['couponcode_name'],'message'=>" Copy the code and use it at the checkout to get the discount. It's valid for two hours only ( created Time : ".$details['created_at']."). ");
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0, 'b_id'=>$b_id,'message'=>'Having no coupon code');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	  }
	   public function ip_post(){
			$a_u_id=$this->post('a_u_id');
			if($a_u_id==''){
				$message = array('status'=>0,'message'=>'User Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			$coupon_code_list=$this->Mobile_model->get_ip_coupon_code_list($a_u_id);
				if(count($coupon_code_list)>0){
					
				$message = array('status'=>1,'list'=>$coupon_code_list,'message'=>'Coupon Code list are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Coupon code list not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	  }
	   public function generateipcoupon_post(){
			$hos_id=$this->post('hos_id');
			$a_u_id=$this->post('a_u_id');
			if($a_u_id==''){
				$message = array('status'=>0,'message'=>'User Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			if($hos_id==''){
				$message = array('status'=>0,'message'=>'Hospital Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
				$time=time();
				$hospital_details=$this->Mobile_model->get_hospital_details($hos_id);
				$hos_name=mb_substr($hospital_details['hos_bas_name'], 0, 2);
				$hos_id=$hospital_details['hos_id'];
				$ip='Ip';
				$coupon_code=$hos_name.$hos_id.$ip.$time;
				$wallet_amt_list=$this->Mobile_model->get_wallet_amount_percentages($hospital_details['hos_id']);

					$add=array(
						'hos_id'=>isset($hos_id)?$hos_id:'',
						'appointment_id'=>isset($b_id)?$b_id:'',
						'couponcode_name'=>isset($coupon_code)?$coupon_code:'',
						'ip_amount_percentage'=>isset($wallet_amt_list['ip_amount_percentage'])?$wallet_amt_list['ip_amount_percentage']:'',
						'op_amount_percentage'=>isset($wallet_amt_list['op_amount_percentage'])?$wallet_amt_list['op_amount_percentage']:'',
						'lab_amount_percentage'=>isset($wallet_amt_list['lab_amount_percentage'])?$wallet_amt_list['lab_amount_percentage']:'',
						'statu'=>1,
						'created_at'=>date('Y-m-d H:i:s'),
						'created_by'=>$a_u_id,
						'type'=>2,
					);
				$check=$this->Mobile_model->check_ip_couponcode_exists_ornot($hos_id,$coupon_code);
				if(count($check)>0){
					$message = array('status'=>0,'a_u_id'=>$a_u_id, 'couponcode_name'=>$check['couponcode_name'],'message'=>"Your are already created coupon code. Use below code ");
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$save=$this->Mobile_model->save_couponcode($add);
					if(count($save)>0){
						$message = array('status'=>1,'a_u_id'=>$a_u_id,'couponcode_name'=>$coupon_code,'message'=>"Coupon code successfully created. Use below code ");
						$this->response($message, REST_Controller::HTTP_OK);
					}else{
						$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>"Technical problem will occurred. Please try again");
						$this->response($message, REST_Controller::HTTP_OK);
					}
				}
			
	  }
	    public function lab_post(){
			$a_u_id=$this->post('a_u_id');
			if($a_u_id==''){
				$message = array('status'=>0,'message'=>'User Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			$coupon_code_list=$this->Mobile_model->get_lab_coupon_code_list($a_u_id);
				if(count($coupon_code_list)>0){
					
				$message = array('status'=>1,'list'=>$coupon_code_list,'message'=>'Coupon Code list are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Coupon code list not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	  }
	   public function generatelabcoupon_post(){
			$hos_id=$this->post('hos_id');
			$a_u_id=$this->post('a_u_id');
			if($a_u_id==''){
				$message = array('status'=>0,'message'=>'User Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			if($hos_id==''){
				$message = array('status'=>0,'message'=>'Hospital Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
				$time=time();
				$hospital_details=$this->Mobile_model->get_hospital_details($hos_id);
				$hos_name=mb_substr($hospital_details['hos_bas_name'], 0, 2);
				$hos_id=$hospital_details['hos_id'];
				$ip='Lab';
				$coupon_code=$hos_name.$hos_id.$ip.$time;
				$wallet_amt_list=$this->Mobile_model->get_wallet_amount_percentages($hospital_details['hos_id']);
					$add=array(
						'hos_id'=>isset($hos_id)?$hos_id:'',
						'appointment_id'=>isset($b_id)?$b_id:'',
						'couponcode_name'=>isset($coupon_code)?$coupon_code:'',
						'ip_amount_percentage'=>isset($wallet_amt_list['ip_amount_percentage'])?$wallet_amt_list['ip_amount_percentage']:'',
						'op_amount_percentage'=>isset($wallet_amt_list['op_amount_percentage'])?$wallet_amt_list['op_amount_percentage']:'',
						'lab_amount_percentage'=>isset($wallet_amt_list['lab_amount_percentage'])?$wallet_amt_list['lab_amount_percentage']:'',
						'statu'=>1,
						'created_at'=>date('Y-m-d H:i:s'),
						'created_by'=>$a_u_id,
						'type'=>3,
					);
				$check=$this->Mobile_model->check_lab_couponcode_exists_ornot($hos_id,$coupon_code);
				if(count($check)>0){
					$message = array('status'=>0,'a_u_id'=>$a_u_id,'couponcode_name'=>$check['couponcode_name'],'message'=>"Your are already created coupon code. Use below code ");
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$save=$this->Mobile_model->save_couponcode($add);
					if(count($save)>0){
						$message = array('status'=>1,'a_u_id'=>$a_u_id, 'couponcode_name'=>$coupon_code,'message'=>"Coupon code successfully created. Use below code ");
						$this->response($message, REST_Controller::HTTP_OK);
					}else{
						$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>"Technical problem will occurred. Please try again");
						$this->response($message, REST_Controller::HTTP_OK);
					}
				}
			
	  }
	  public  function history_post(){
		  $a_u_id=$this->post('a_u_id');
			if($a_u_id==''){
				$message = array('status'=>0,'message'=>'User Id is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			$wallet_history=$this->Mobile_model->get_all_wallet_history($a_u_id);
				if(count($wallet_history)>0){
				$message = array('status'=>1,'list'=>$wallet_history,'message'=>'History list are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'History list not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	  }
	
	

}
