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
class Appointment extends REST_Controller {

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

	  public function cardnumberdata_post(){
			$card_number=$this->post('card_number');
			if($card_number==''){
				$message = array('status'=>0,'message'=>'Card Number is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			$card_data=$this->Mobile_model->get_card_number_data($card_number);
				if(count($card_data)>0){
				$message = array('status'=>1,'details'=>$card_data,'message'=>'Card details are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Card number not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	  }
	public function register_post(){
		
		
		$name=$this->post('name');
		$email=$this->post('email');
		$mobile=$this->post('mobile');
		$token=$this->post('token');
		$password=$this->post('password');
		$confirmpassword=$this->post('confirmpassword');
		if($name==''){
			$message = array('status'=>0,'message'=>'Name is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($email==''){
			$message = array('status'=>0,'message'=>'Email Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($mobile==''){
			$message = array('status'=>0,'message'=>'Mobile Number is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($token==''){
			$message = array('status'=>0,'message'=>'token id required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($password==''){
			$message = array('status'=>0,'message'=>'Password is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($confirmpassword==''){
			$message = array('status'=>0,'message'=>'Confirm Password is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if(strlen($password)<6){
			$message = array('status'=>0,'message'=>'Passwords must be at least 6 characters long');
			$this->response($message, REST_Controller::HTTP_OK);
		}if(strlen($confirmpassword)<6){
			$message = array('status'=>0,'message'=>'Confirm passwords must be at least 6 characters long');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		
		if(md5($password) == md5($confirmpassword)){
				$check_email=$this->Mobile_model->check_email_already_already_exits($email);
				$check_mobile=$this->Mobile_model->check_mobile_already_already_exits($mobile);
				if(count($check_email)>0 || count($check_mobile)>0){
					if(count($check_email)>0){
						$message = array('status'=>0,'message'=>'Email Id already exists. Please use another email id');
						$this->response($message, REST_Controller::HTTP_OK);
					}else{
						$message = array('status'=>0,'message'=>'Mobile Number already exists. Please use another Mobile Number');
						$this->response($message, REST_Controller::HTTP_OK);
					}
					
			
				}else{
					$wallet_amt_list=$this->Mobile_model->get_wallet_amount();
					$add=array(
					'name'=>isset($name)?$name:'',
					'email'=>isset($email)?$email:'',
					'mobile'=>isset($mobile)?$mobile:'',
					'password'=>isset($confirmpassword)?md5($confirmpassword):'',
					'org_password'=>isset($confirmpassword)?$confirmpassword:'',
					'profile_pic'=>isset($img)?$img:'',
					'wallet_amount'=>isset($wallet_amt_list['wallet_amount'])?$wallet_amt_list['wallet_amount']:'',
					'wallet_amount_id'=>isset($wallet_amt_list['w_a_id'])?$wallet_amt_list['w_a_id']:'',
					'remaining_wallet_amount'=>isset($wallet_amt_list['wallet_amount'])?$wallet_amt_list['wallet_amount']:'',
					'status'=>1,
					'create_at'=>date('Y-m-d H:i:s')
					);
					//echo '<pre>';print_r($wallet_amt_list);
					//echo '<pre>';print_r($add);exit;
					$save=$this->Mobile_model->save_appointment_user($add);
					if(count($save)>0){
						$token_data=array('token'=>$token);
						$update_token=$this->Mobile_model->update_user_pushnotification_token($save,$token_data);
						
						$get_userdata=$this->Mobile_model->get_user_mobile_details($mobile);
						if(count($get_userdata)>0){
							$update=array('a_u_id'=>$save);
							$this->Mobile_model->update_user_mobile_data($get_userdata['card_id'],$update);
							
						}
			
						$message = array('status'=>1,'a_u_id'=>$save,'message'=>'User successfully created');
						$this->response($message, REST_Controller::HTTP_OK);
					}else{
						$message = array('status'=>0,'message'=>'Technical problem will occured. Please try again.');
						$this->response($message, REST_Controller::HTTP_OK);
					}
				
				}
		}else{
				$message = array('status'=>0,'message'=>'Your password and confirmation password do not match');
				$this->response($message, REST_Controller::HTTP_OK);
		}
		
	}
	
	public function login_post(){
		$mobile=$this->post('mobile');
		$password=$this->post('password');
		$token=$this->post('token');
		if($mobile==''){
			$message = array('status'=>0,'message'=>'Mobile Number is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($password==''){
			$message = array('status'=>0,'message'=>'Password is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($token==''){
			$message = array('status'=>0,'message'=>'token id required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(strlen($password)<6){
			$message = array('status'=>0,'message'=>'Passwords must be at least 6 characters long');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$select=$this->Mobile_model->check_login_details_with_mobile($mobile,$password);
		
		
		//echo '<pre>';print_r($select);exit;
		if(count($select)>0){
			$token_data=array('token'=>$token);
			$update_token=$this->Mobile_model->update_user_pushnotification_token($select['a_u_id'],$token_data);
			$message = array('status'=>1,'details'=>$select,'pic_path'=>base_url('assets/adminprofilepic/'),'message'=>'User Successfully login');
			$this->response($message, REST_Controller::HTTP_OK);
		}else{
			$message = array('status'=>0,'message'=>'Invalid login details.Please try again');
			$this->response($message, REST_Controller::HTTP_OK);
		}
	}
	public function changepassword_post(){
		$a_u_id=$this->post('a_u_id');
		$oldpassword=$this->post('oldpassword');
		$password=$this->post('password');
		$confirmpassword=$this->post('confirmpassword');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($password==''){
			$message = array('status'=>0,'message'=>'Password is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(strlen($password)<6){
			$message = array('status'=>0,'message'=>'Passwords must be at least 6 characters long');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($confirmpassword==''){
			$message = array('status'=>0,'message'=>'Confirm password is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(strlen($confirmpassword)<6){
			$message = array('status'=>0,'message'=>'Confirm password  must be at least 6 characters long');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(md5($password)==md5($confirmpassword)){
			
			$check_user=$this->Mobile_model->check_user_details($a_u_id);
			if(count($check_user)>0){
				
				if(md5($oldpassword)==$check_user['password']){
						$update=$this->Mobile_model->update_user_password($a_u_id,$confirmpassword);
						if(count($update)>0){
								$message = array('status'=>1,'a_u_id'=>$a_u_id,'message'=>'Password Successfully Updated');
								$this->response($message, REST_Controller::HTTP_OK);
						}else{
								$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Technical problem will occured. Please try again.');
								$this->response($message, REST_Controller::HTTP_OK);
						}
				}else{
					$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Old password does not match. Please try again');
					$this->response($message, REST_Controller::HTTP_OK);
				}
				
			}else{
				$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Invalid User id.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			
		}else{
			$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Your password and confirmation password do not match');
				$this->response($message, REST_Controller::HTTP_OK);
		}
		
	}
	
	public function forgotpassword_post(){
		$email=$this->post('email');
		if($email==''){
			$message = array('status'=>0,'message'=>'Email Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
			$check_email=$this->Mobile_model->check_email_already_exits($email);
				if(count($check_email)>0){
					$this->load->library('email');
					$this->email->set_newline("\r\n");
					$this->email->set_mailtype("html");
					$this->email->to($check_email['email']);
					$this->email->from('admin@Ehealthinfra', 'Ehealthinfra'); 
					$this->email->subject($check_email['name'].' - Forgot password'); 
					$body = "<b> Your Account login Password is </b> : ".$check_email['org_password'];
					$this->email->message($body);
					$this->email->send();
					$message = array('status'=>1,'a_u_id'=>$check_email['a_u_id'],'message'=>'Password sent to your registered email address. Please Check your registered email address');
					$this->response($message, REST_Controller::HTTP_OK);
					
			
				}else{
				$message = array('status'=>0,'message'=>'Entered Email id not registered.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public  function citys_post(){
			$districts=$this->Mobile_model->get_hospital_citys_list();
			if(count($districts)>0){
				$message = array('status'=>1,'list'=>$districts,'message'=>'Citys List are found');
				$this->response($message, REST_Controller::HTTP_OK);
		
			}else{
			$message = array('status'=>0,'message'=>'Citys List not found.Please try again');
			$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public  function hospital_list_post(){
			$city=$this->post('city');
			if($city==''){
				$message = array('status'=>0,'message'=>'City is required');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			$hosital_list=$this->Mobile_model->get_hospital_lists($city);
			if(count($hosital_list)>0){
				$message = array('status'=>1,'list'=>$hosital_list,'message'=>'Hospital List are found');
				$this->response($message, REST_Controller::HTTP_OK);
		
			}else{
			$message = array('status'=>0,'message'=>'Hospital List not found.Please try again');
			$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	
	public  function department_list_post(){
		$hos_id=$this->post('hos_id');
		if($hos_id==''){
			$message = array('status'=>0,'message'=>'Hospital id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
			$department_list=$this->Mobile_model->get_hospital_department_list($hos_id);
				if(count($department_list)>0){
					$message = array('status'=>1,'list'=>$department_list,'message'=>'Departments List are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Departments List not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}	
	public  function specialist_list_post(){
		$department_id=$this->post('department_id');
		$hos_id=$this->post('hos_id');
		if($hos_id==''){
			$message = array('status'=>0,'message'=>'Hospital Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($department_id==''){
			$message = array('status'=>0,'message'=>'Department Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
			$specialist_list=$this->Mobile_model->get_specilist_names_list($hos_id,$department_id);
			
				//echo '<pre>';print_r($list);exit;
				if(count($specialist_list)>0){
					$message = array('status'=>1,'list'=>$specialist_list,'message'=>'specialist List are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'specialist List not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	
	public  function doctors_list_post(){
		$specialist_id=$this->post('specialist_id');
		$hos_id=$this->post('hos_id');
		if($hos_id==''){
			$message = array('status'=>0,'message'=>'Hospital Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($specialist_id==''){
			$message = array('status'=>0,'message'=>'Specialist Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$doctor_list=$this->Mobile_model->get_hospital_specialist_doctors_list($hos_id,$specialist_id);
				if(count($doctor_list)>0){
					$message = array('status'=>1,'list'=>$doctor_list,'message'=>'Doctors List are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Doctors List not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public  function doctors_consultation_fee_post(){
		$doctor_id=$this->post('doctor_id');
		if($doctor_id==''){
			$message = array('status'=>0,'message'=>'Doctor Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$consultation_fee=$this->Mobile_model->get_doctors_consultation_fee($doctor_id);
				if(count($consultation_fee)>0){
					$message = array('status'=>1,'consultation_fee'=>$consultation_fee['consultation_fee'],'message'=>'Doctor consultation fee');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Technical problem will occured. Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public  function doctors_time_slot_post(){
		$doctor_id=$this->post('doctor_id');
		$hos_id=$this->post('hos_id');
		if($hos_id==''){
			$message = array('status'=>0,'message'=>'Hospital Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($doctor_id==''){
			$message = array('status'=>0,'message'=>'Doctor Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$doctor_list=$this->Mobile_model->get_doctor_time_list($hos_id,$doctor_id);
		//echo '<pre>';print_r($doctor_list);
		if(count($doctor_list)>0){
			$time_list=array("12:00 am","12:30 am","01:00 am","01:30 am","02:00 am","02:30 am","03:00 am","03:30 am","04:00 am","04:30 am","05:00 am","05:30 am","06:00 am","06:30 am","07:00 am","07:30 am","08:00 am","08:30 am","09:00 am","09:30 am","10:00 am","10:30 am","11:00 am","11:30 am","12:00 pm","12:30 pm","01:00 pm","01:30 pm","02:00 pm","02:30 pm","03:00 pm","03:30 pm","04:00 pm","04:30 pm","05:00 pm","05:30 pm","06:00 pm","06:30 pm","07:00 pm","07:30 pm","08:00 pm","08:30 pm","09:00 pm","09:30 pm","10:00 pm","10:30 pm","11:00 pm","11:30 pm");
			$start_date =$doctor_list['in_time'];
			$end_date = $doctor_list['out_time'];
			$interval = '30 mins';
			$format = '12';
			$startTime = strtotime($start_date); 
			$endTime   = strtotime($end_date);
			$returnTimeFormat = ($format == '12')?'h:i a':'G:i:s';

			$current   = time(); 
			$addTime   = strtotime('+'.$interval, $current); 
			$diff      = $addTime - $current;

			$times = array(); 
			while ($startTime < $endTime) { 
			$times[] = date($returnTimeFormat, $startTime); 
			$startTime += $diff; 
			} 
			$times[] = date($returnTimeFormat, $startTime);
			
	
		}		
		
		
				if(count($doctor_list)>0){
					if(isset($times) && count($times)>0){
						foreach($times as $lis){
							$ddd[]=array('timeslot'=>$lis);
						}
					}else{
						$ddd='';
					}
					
					//echo '<pre>';print_r($ddd);exit;
					
					$message = array('status'=>1,'doctor_id'=>$doctor_id,'time_list'=>$ddd,'message'=>'Doctor time slot are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Doctors time slot not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public  function add_post(){
		$a_u_id=$this->post('a_u_id');
		$city=$this->post('city');
		$hos_id=$this->post('hos_id');
		$department_id=$this->post('department_id');
		$specialist_id=$this->post('specialist_id');
		$doctor_id=$this->post('doctor_id');
		$date=$this->post('date');
		$time=$this->post('time');
		$patient_age=$this->post('age');
		$name=$this->post('name');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($city==''){
			$message = array('status'=>0,'message'=>'City is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($hos_id==''){
			$message = array('status'=>0,'message'=>'Hospital Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($department_id==''){
			$message = array('status'=>0,'message'=>'Department id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($specialist_id==''){
			$message = array('status'=>0,'message'=>'Specialist Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($doctor_id==''){
			$message = array('status'=>0,'message'=>'Doctor Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($patient_age==''){
			$message = array('status'=>0,'message'=>'Age is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($date==''){
			$message = array('status'=>0,'message'=>'date is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($date!=''){
			if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
				//return true;
			} else {
				$message = array('status'=>0,'message'=>'Date formate is wrog.example is 2018-06-24');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}if($time==''){
			$message = array('status'=>0,'message'=>'Time is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($name==''){
			$message = array('status'=>0,'message'=>'Name is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$details=$this->Mobile_model->get_appointment_user_details($a_u_id);
		//echo '<pre>';print_r($details);
		if(count($details)>0){
			$add=array(
					'hos_id'=>isset($hos_id)?$hos_id:'',
					'city'=>isset($city)?$city:'',
					'patinet_name'=>isset($name)?$name:'',
					'age'=>isset($patient_age)?$patient_age:'',
					'mobile'=>isset($details['mobile'])?$details['mobile']:'',
					'department'=>isset($department_id)?$department_id:'',
					'specialist'=>isset($specialist_id)?$specialist_id:'',
					'doctor_id'=>isset($doctor_id)?$doctor_id:'',
					'date'=>isset($date)?$date:'',
					'time'=>isset($time)?$time:'',
					'status'=>0,
					'create_at'=>date('Y-m-d H:i:s'),
					'coming_through'=>0,
					'create_by'=>$a_u_id,
					);
				//echo '<pre>';print_r($add);exit;
				$save_app=$this->Mobile_model->save_appointment_bidding($add);
				//echo $this->db->last_query();exit;
				if(count($save_app)>0){
						$hospital_details=$this->Mobile_model->get_hospital_name_details($hos_id);
						$username=$this->config->item('smsusername');
						$pass=$this->config->item('smspassword');
						$sender=$this->config->item('sender');
						$static_number=$this->config->item('static_number');
						$msg = "An appointment is booked for ".$hospital_details['hos_bas_name'].", on ".$date.$time." patient name" .$name. " and patient mobile ".$details['mobile'];
						$ch2 = curl_init();
						curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
						curl_setopt($ch2, CURLOPT_POST, 1);
						curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$static_number.'&text='.$msg.'&priority=ndnd&stype=normal');
						curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
						//echo '<pre>';print_r($ch);exit;
						$server_output = curl_exec ($ch2);
						curl_close ($ch2);
						/* hospital reception */
						$msg1 = "Alert! Appointment request was send to your ".$hospital_details['hos_bas_name'].", on ".$date.$time." by patient name" .$name. " and patient mobile ".$details['mobile'].".Please, accept the appointment.";
						$ch3 = curl_init();
						curl_setopt($ch3, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
						curl_setopt($ch3, CURLOPT_POST, 1);
						curl_setopt($ch3, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$hospital_details['hos_rep_contact'].'&text='.$msg1.'&priority=ndnd&stype=normal');
						curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
						//echo '<pre>';print_r($ch);exit;
						$server_output = curl_exec ($ch3);
						curl_close ($ch3);
						/* hospital reception */
					//echo "dfsd";exit;
					/*push notification */
					$url = "https://fcm.googleapis.com/fcm/send";
					$token=$details['token'];
					$serverKey = $this->config->item('server_key_push');
					$title = "Appointment Bidding Confirmation";
					//$body = "Hello ".$details['name']." you have an appointment booked";
					$body = "Hello ".$details['name']." your appointment's bidding sent successfully";
					$notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
					$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
					$json = json_encode($arrayToSend);
					$headers = array();
					$headers[] = 'Content-Type: application/json';
					$headers[] = 'Authorization: key='. $serverKey;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, true);


					curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
					$output = curl_exec($ch);
					$info = curl_getinfo($ch);
					curl_close($ch);
					/*push notification */
						$message = array('status'=>1,'a_u_id'=>$a_u_id,'message'=>'Appointment Successfully added');
						$this->response($message, REST_Controller::HTTP_OK);
				}else{
						$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Technical problem will occured. Please try again.');
						$this->response($message, REST_Controller::HTTP_OK);
				}
					
		}else{
			$message = array('status'=>0,'message'=>'User not found. Please try again');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		
	}
	
	public  function statu_list_post(){
		$a_u_id=$this->post('a_u_id');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$aapointment_list=$this->Mobile_model->get_bidding_appointment_list($a_u_id);
		if(count($aapointment_list)>0){
			
			foreach($aapointment_list as $li){
				$a_list[]=$li;
			}
			
		}else{
			$a_list=array();
		}
		//echo '<pre>';print_r($aapointment_list);exit;
		if(count($a_list)>0){
						$message = array('status'=>1,'list'=>$a_list,'a_u_id'=>$a_u_id,'message'=>'Appointment list are found');
						$this->response($message, REST_Controller::HTTP_OK);
				}else{
						$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Appointment list are not found');
						$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public  function card_number_generator_post(){
		
		$card_num=$this->Mobile_model->get_card_number();
		if(count($card_num)>0){
				$number=preg_replace("/[^0-9]/", "", $card_num['card_number']);
				$num=($number)+1;
				$message = array('status'=>1,'Cardnumber'=>$num,'message'=>'Card number successfully generated');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$num='450054021000';
				$message = array('status'=>1,'Cardnumber'=>$num,'message'=>'Card number successfully generated');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		
		//echo '<pre>';print_r($card_number);exit;
	}
	public  function take_cardnumber_post(){
		$a_u_id=$this->post('a_u_id');
		$card_number=$this->post('card_number');
		$patient_name=$this->post('patient_name');
		$mobile_num=$this->post('mobile_num');
		$whatsapp_num=$this->post('whatsapp_num');
		$city=$this->post('city');
		$email_id=$this->post('email_id');
		$gender=$this->post('gender');
		
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($card_number==''){
			$message = array('status'=>0,'message'=>'Card Number is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($patient_name==''){
			$message = array('status'=>0,'message'=>'Patient Name is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($mobile_num==''){
			$message = array('status'=>0,'message'=>'Mobile Number is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($whatsapp_num==''){
			$message = array('status'=>0,'message'=>'Whatsapp Number is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($city==''){
			$message = array('status'=>0,'message'=>'City is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($email_id==''){
			$message = array('status'=>0,'message'=>'Email Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($gender==''){
			$message = array('status'=>0,'message'=>'Gender is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$check_mobile=$this->Mobile_model->check_mobile_number_exist($mobile_num);
		if(count($check_mobile)>0){
			$message = array('status'=>0,'message'=>'Mobile Number already exists. Please use another Mobile Number');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		
		$add=array(
		'a_u_id'=>isset($a_u_id)?$a_u_id:'',
		'card_number'=>isset($card_number)?$card_number:'',
		'patient_name'=>isset($patient_name)?$patient_name:'',
		'mobile_num'=>isset($mobile_num)?$mobile_num:'',
		'whatsapp_num'=>isset($whatsapp_num)?$whatsapp_num:'',
		'city'=>isset($city)?$city:'',
		'email_id'=>isset($email_id)?$email_id:'',
		'gender'=>isset($gender)?$gender:'',
		'created_at'=>date('Y-m-d H:i:s'),
		'updated_at'=>date('Y-m-d H:i:s'),
		'created_by'=>isset($s_id)?$s_id:'',
		);
		$card_assign=$this->Mobile_model->save_card_number_details($add);
		if(count($card_assign)>0){
				
				$message = array('status'=>1,'card_assign_number'=>$card_assign,'a_u_id'=>$a_u_id,'message'=>'Card Number successfully added');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0, 'a_u_id'=>$a_u_id,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public  function cardnumber_payment_post(){
		$a_u_id=$this->post('a_u_id');
		$card_assign_number=$this->post('card_assign_number');
		$razorpay_payment_id=$this->post('razorpay_payment_id');
		$razorpay_order_id=$this->post('razorpay_order_id');
		$razorpay_signature=$this->post('razorpay_signature');
		$amount=$this->post('amount');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($card_assign_number==''){
			$message = array('status'=>0,'message'=>'Card assign Number is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($razorpay_payment_id==''){
			$message = array('status'=>0,'message'=>'Razorpay Payment Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($amount==''){
			$message = array('status'=>0,'message'=>'Amount is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$update=array(
		'razorpay_payment_id'=>isset($razorpay_payment_id)?$razorpay_payment_id:'',
		'razorpay_order_id'=>isset($razorpay_order_id)?$razorpay_order_id:'',
		'razorpay_signature'=>isset($razorpay_signature)?$razorpay_signature:'',
		'amount'=>isset($amount)?$amount:'',
		'payment_date'=>date('Y-m-d H:i:s'),
		'payment_statu'=>1,
		'mobile_verified'=>1,
		
		);
		$take_mobile=$this->Mobile_model->get_mobile_number_details($card_assign_number);
		if(count($take_mobile)>0){
			$get_details=$this->Mobile_model->get_card_number_details($take_mobile['card_number']);
			if(count($get_details)>0){
					$card_num=$this->Mobile_model->get_card_number();
						if(count($card_num)>0){
							$number=preg_replace("/[^0-9]/", "", $card_num['card_number']);
							$num=($number)+1;
							$a_data=array('card_number'=>$num);
							$update_mobile=$this->Mobile_model->update_card_number($a_u_id,$card_assign_number,$a_data);
						}else{
							$num='450054021000';
							$a_data=array('card_number'=>$num);
							$update_mobile=$this->Mobile_model->update_card_number($a_u_id,$card_assign_number,$a_data);
						}
			}
			
		}
		$card_payment=$this->Mobile_model->update_card_payment_details($a_u_id,$card_assign_number,$update);
		if(count($card_payment)>0){
				$get_card_mobile=$this->Mobile_model->get_mobile_number($a_u_id,$card_assign_number);
			/*sms purpose */
				$username=$this->config->item('smsusername');
				$pass=$this->config->item('smspassword');
				$sender=$this->config->item('sender');
				$msg = "Greetings from Medspace, you have successfully registered for health card with Medspace. Avail offers on booking doctor appointments, ordering medicines, health checkups by using Medspace online appointment app.";
				$ch2 = curl_init();
				curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
				curl_setopt($ch2, CURLOPT_POST, 1);
				curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$get_card_mobile['mobile_num'].'&text='.$msg.'&priority=ndnd&stype=normal');
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				//echo '<pre>';print_r($ch);exit;
				$server_output = curl_exec ($ch2);
				curl_close ($ch2);
			/*sms purpose */
			
			
			$details=$this->Mobile_model->get_card_details($card_assign_number);
				$message = array('status'=>1,'a_u_id'=>$a_u_id,'details'=>$details,'message'=>'Card number payment successfully updated');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0, 'a_u_id'=>$a_u_id,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	
	public  function card_list_details_post(){
		$a_u_id=$this->post('a_u_id');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$details=$this->Mobile_model->get_user_card_details($a_u_id);
		if(count($details)>0){
				$message = array('status'=>1,'a_u_id'=>$a_u_id,'details'=>$details,'message'=>'Card number list deatils');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0, 'a_u_id'=>$a_u_id,'message'=>'Card number list deatils not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public  function cardamount_post(){
		$message = array('status'=>1,'amount'=>1,'message'=>'Card amount details');
		$this->response($message, REST_Controller::HTTP_OK);
	}
	
	public  function profile_post(){
		
		$a_u_id=$this->post('a_u_id');
		$name=$this->post('name');
		$email=$this->post('email');
		$mobile=$this->post('mobile');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($name==''){
			$message = array('status'=>0,'message'=>'Name is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($email==''){
			$message = array('status'=>0,'message'=>'Email Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($mobile==''){
			$message = array('status'=>0,'message'=>'Mobile Number is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$details=$this->Mobile_model->get_appointment_user_details($a_u_id);
		if(count($details)>0){
			if($details['email']!=$email){
				$check_email=$this->Mobile_model->check_email_already_already_exits($email);
				if(count($check_email)>0){
					$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Email Id already exists. Please use another email id');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}
			}
			$update=array(
			'name'=>isset($name)?$name:'',
			'email'=>isset($email)?$email:'',
			'mobile'=>isset($mobile)?$mobile:'',
			);
			$update_details=$this->Mobile_model->udate_profile($a_u_id,$update);
			if(count($update_details)>0){
				$message = array('status'=>1,'a_u_id'=>$a_u_id,'message'=>'Profile successfully updated.');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Technical problem will occured. Please try again.');
				$this->response($message, REST_Controller::HTTP_OK);
			}			
			
			
		}else{
			$message = array('status'=>0,'message'=>'User not found. Please try again');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		
	}
	
	public  function appointment_list_post(){
		$a_u_id=$this->post('a_u_id');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$appoint_list=$this->Mobile_model->get_user_aapointment_list($a_u_id);
		if(isset($appoint_list) && count($appoint_list)>0){
			foreach($appoint_list as $list){
				$app_list[]=$list;
				
			}
		}else{
			$app_list=array();
		}
		//echo '<pre>';print_r($appoint_list);exit;
		if(count($app_list)>0){
					$message = array('status'=>1,'list'=>$app_list,'message'=>'Appointment List are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Appointment List not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public  function uploadpic_post(){
		$a_u_id=$this->post('a_u_id');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(count($_FILES)==0){
			$message = array('status'=>0,'message'=>'upload image is required');
			$this->response($message, REST_Controller::HTTP_OK);	
		}
		$pic=$_FILES['profile_pic']['name'];
		$picname = str_replace(" ", "", $pic);
		$imagename=microtime().basename($picname);
		$imgname = str_replace(" ", "", $imagename);
		if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], 'assets/adminprofilepic/'.$imgname)){
			$addimg=array(
			'profile_pic'=>$imgname,
			);
			$save_img=$this->Mobile_model->udate_profile($a_u_id,$addimg);
			if(count($save_img)>0){
					
					$message = array('status'=>1,'a_u_id'=>$a_u_id,'message'=>'Image successfully sent');
					$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			
			
			
			
		}else{
			
			$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
		}
	}
	public  function user_details_post(){
		$a_u_id=$this->post('a_u_id');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		
		$details=$this->Mobile_model->get_userdetails($a_u_id);
			if(count($details)>0){
					
					$message = array('status'=>1,'details'=>$details,'pic_path'=>base_url('assets/adminprofilepic/'),'message'=>'User Details are found');
					$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'User Id is  wrong.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			
			
	}public  function update_token_post(){
		$a_u_id=$this->post('a_u_id');
		$token=$this->post('token');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($token==''){
			$message = array('status'=>0,'message'=>'Token is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$token_data=array('token'=>$token);
		$update_token=$this->Mobile_model->update_user_pushnotification_token($a_u_id,$token_data);
			
			if(count($update_token)>0){
					
					$message = array('status'=>1,'a_u_id'=>$a_u_id,'message'=>'Token Successfully updated');
					$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'User Id is  wrong.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			
			
	}
	public  function uploadprescription_post(){
		$a_u_id=$this->post('a_u_id');
		$hos_id=$this->post('hos_id');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($hos_id==''){
			$message = array('status'=>0,'message'=>'Hospital id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(count($_FILES)==0){
			$message = array('status'=>0,'message'=>'upload image is required');
			$this->response($message, REST_Controller::HTTP_OK);	
		}
		$pic=$_FILES['prescription']['name'];
		$picname = str_replace(" ", "", $pic);
		$imagename=microtime().basename($picname);
		$imgname = str_replace(" ", "", $imagename);
		if(move_uploaded_file($_FILES['prescription']['tmp_name'], 'assets/appointment_user_prescription/'.$imgname)){
			$addimg=array(
			'a_u_id'=>$a_u_id,
			'hos_id'=>$hos_id,
			'prescription'=>$imgname,
			'created_at'=>date('Y-m-d H:i:s'),
			);
			$save_img=$this->Mobile_model->save_appointment_user_prescription($addimg);
			if(count($save_img)>0){
					
					$message = array('status'=>1,'a_u_id'=>$a_u_id,'message'=>'Image successfully sent');
					$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
			
			
			
			
		}else{
			
			$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
		}
	}
	public  function prescription_list_post(){
		$a_u_id=$this->post('a_u_id');
		$hos_id=$this->post('hos_id');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($hos_id==''){
			$message = array('status'=>0,'message'=>'Hospital id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$prescription_list=$this->Mobile_model->get_prescription_list($a_u_id,$hos_id);
			if(count($prescription_list)>0){
					
					$message = array('status'=>1,'hos_id'=>$hos_id,'a_u_id'=>$a_u_id,'list'=>$prescription_list,'path'=>base_url('assets/appointment_user_prescription/'),'message'=>'Prescription list are found');
					$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Prescription list are not found .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}

}
