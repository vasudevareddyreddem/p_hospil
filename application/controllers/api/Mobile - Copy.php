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
class Mobile extends REST_Controller {

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

  public function appointment_userregister_post(){
		
		
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
		}if(strlen($password)<8){
			$message = array('status'=>0,'message'=>'Passwords must be at least 8 characters long');
			$this->response($message, REST_Controller::HTTP_OK);
		}if(strlen($confirmpassword)<8){
			$message = array('status'=>0,'message'=>'Confirm passwords must be at least 8 characters long');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(md5($password) == md5($confirmpassword)){
				$check_email=$this->Mobile_model->check_email_already_already_exits($email);
				if(count($check_email)>0){
					$message = array('status'=>0,'message'=>'Email Id already exists. Please use another email id');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
					$add=array(
					'name'=>isset($name)?$name:'',
					'email'=>isset($email)?$email:'',
					'mobile'=>isset($mobile)?$mobile:'',
					'password'=>isset($confirmpassword)?md5($confirmpassword):'',
					'org_password'=>isset($confirmpassword)?$confirmpassword:'',
					'profile_pic'=>isset($img)?$img:'',
					'status'=>1,
					'create_at'=>date('Y-m-d H:i:s')
					);
					$save=$this->Mobile_model->save_appointment_user($add);
					if(count($save)>0){
						$token_data=array('token'=>$token);
						$update_token=$this->Mobile_model->update_user_pushnotification_token($save,$token_data);
			
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
	
	public function appointment_userlogin_post(){
		$email=$this->post('email');
		$password=$this->post('password');
		$token=$this->post('token');
		if($email==''){
			$message = array('status'=>0,'message'=>'Email Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($password==''){
			$message = array('status'=>0,'message'=>'Password is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($token==''){
			$message = array('status'=>0,'message'=>'token id required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(strlen($password)<8){
			$message = array('status'=>0,'message'=>'Passwords must be at least 8 characters long');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$select=$this->Mobile_model->check_login_details($email,$password);
		
		
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
	public function appointment_changepassword_post(){
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
		if(strlen($password)<8){
			$message = array('status'=>0,'message'=>'Passwords must be at least 8 characters long');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($confirmpassword==''){
			$message = array('status'=>0,'message'=>'Confirm password is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if(strlen($confirmpassword)<8){
			$message = array('status'=>0,'message'=>'Confirm password  must be at least 8 characters long');
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
	
	public function appointment_forgotpassword_post(){
		$email=$this->post('email');
		if($email==''){
			$message = array('status'=>0,'message'=>'Email Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
			$check_email=$this->Mobile_model->check_email_already_already_exits($email);
				if(count($check_email)>0){
					$message = array('status'=>1,'a_u_id'=>$check_email['a_u_id'],'message'=>'Your login password is '.$check_email['org_password']);
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Entered Email id not registered.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public  function appointment_hospital_citys_post(){
			$districts=$this->Mobile_model->get_hospital_citys_list();
				if(count($districts)>0){
					$message = array('status'=>1,'list'=>$districts,'message'=>'Citys List are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Citys List not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	
	public  function appointment_hospital_department_list_post(){
		$city=$this->post('city');
		if($city==''){
			$message = array('status'=>0,'message'=>'City is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
			$department_list=$this->Mobile_model->get_hospital_department_list($city);
				if(count($department_list)>0){
					$message = array('status'=>1,'list'=>$department_list,'message'=>'Departments List are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Departments List not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}	
	public  function appointment_hospital_specialist_list_post(){
		$city=$this->post('city');
		$department_name=$this->post('department_name');
		if($city==''){
			$message = array('status'=>0,'message'=>'City Name is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}if($department_name==''){
			$message = array('status'=>0,'message'=>'Department Name is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
			$specialist_list=$this->Mobile_model->get_hospital_department_specialist_list($department_name,$city);
				
				if(count($specialist_list)>0){
					foreach($specialist_list as $list){
						if(isset($list['specialist_name']) && $list['specialist_name']!='')
						{
							$list[]=$list['specialist_name'];
						}
					}
				}else{
					$list=array();
				}
				//echo $this->db->last_query();
				
				//echo '<pre>';print_r($list);exit;
				if(count($list)>0){
					$message = array('status'=>1,'list'=>$list,'message'=>'specialist List are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'specialist List not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	
	public  function appointment_hospital_list_post(){
		$specialist_name=$this->post('specialist_name');
		$city=$this->post('city');
		if($city==''){
			$message = array('status'=>0,'message'=>'City Name is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($specialist_name==''){
			$message = array('status'=>0,'message'=>'Specialist name is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
			$hospital_list=$this->Mobile_model->get_hospital_list($specialist_name,$city);
				if(count($hospital_list)>0){
					$message = array('status'=>1,'list'=>$hospital_list,'message'=>'Hospital List are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Hospital List not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public  function appointment_hospital_doctors_list_post(){
		$s_id=$this->post('s_id');
		if($s_id==''){
			$message = array('status'=>0,'message'=>'Specialist Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}$doctor_list=$this->Mobile_model->get_hospital_specialist_doctors_list($s_id);
				if(count($doctor_list)>0){
					$message = array('status'=>1,'list'=>$doctor_list,'message'=>'Doctors List are found');
					$this->response($message, REST_Controller::HTTP_OK);
			
				}else{
				$message = array('status'=>0,'message'=>'Doctors List not found.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public  function appointment_add_post(){
		$a_u_id=$this->post('a_u_id');
		$city=$this->post('city');
		$hos_id=$this->post('hos_ids');
		$department_id=$this->post('department_name');
		$s_id=$this->post('specialist_name');
		$doctor_id=$this->post('a_id');
		$patient_age=$this->post('patient_age');
		$date=$this->post('date');
		$time=$this->post('time');
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
			$message = array('status'=>0,'message'=>'Department Name is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($s_id==''){
			$message = array('status'=>0,'message'=>'Specialist Name is required');
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
		}
		$details=$this->Mobile_model->get_appointment_user_details($a_u_id);
		//echo '<pre>';print_r($details);
		if(count($details)>0){
			
		$hospital_ids=explode(',',$hos_id);
		foreach($hospital_ids as $list){
			$depart_id=$this->Mobile_model->get_department_name_id($list,$department_id);
			$specilist_id=$this->Mobile_model->get_specilist_name_id($list,$s_id);
			if($depart_id['t_id']!='' && $specilist_id['s_id']!=''){
				$add=array(
					'hos_id'=>isset($list)?$list:'',
					'city'=>isset($city)?$city:'',
					'patinet_name'=>isset($details['name'])?$details['name']:'',
					'age'=>isset($patient_age)?$patient_age:'',
					'mobile'=>isset($details['mobile'])?$details['mobile']:'',
					'department'=>isset($depart_id['t_id'])?$depart_id['t_id']:'',
					'specialist'=>isset($specilist_id['s_id'])?$specilist_id['s_id']:'',
					'date'=>isset($date)?$date:'',
					'time'=>isset($time)?$time:'',
					'status'=>0,
					'create_at'=>date('Y-m-d H:i:s'),
					'coming_through'=>0,
					'create_by'=>$a_u_id,
					);
				$save_app=$this->Mobile_model->appointment_bidding_list($add);
				//echo $this->db->last_query();exit;
			
				}
			}
				if(count($save_app)>0){
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
	
	public  function appointment_statu_list_post(){
		$a_u_id=$this->post('a_u_id');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		$aapointment_list=$this->Mobile_model->get_bidding_appointment_list($a_u_id);
		if(count($aapointment_list)>0){
						$message = array('status'=>1,'list'=>$aapointment_list,'a_u_id'=>$a_u_id,'message'=>'Appointment list are found');
						$this->response($message, REST_Controller::HTTP_OK);
				}else{
						$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Appointment list are not found');
						$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public  function appointment_user_statu_accept_post(){
		$a_u_id=$this->post('a_u_id');
		$b_id=$this->post('b_id');
		$status=$this->post('status');
		if($a_u_id==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($b_id==''){
			$message = array('status'=>0,'message'=>'Temporary Appointment Id is required');
			$this->response($message, REST_Controller::HTTP_OK);
		}
		if($status==0){
			$status_reject=array(
			'status'=>2
			);
			$update=$this->Mobile_model->update_appointment_bidding_statu($b_id,$status_reject);
			//echo $this->db->last_query();exit;
			if(count($update)>0){
				$message = array('status'=>1,'Appointment Temp id'=>$b_id,'a_u_id'=>$a_u_id,'message'=>'Appointment successfully rejected');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Technical problem will occured. Please try again.');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}
		$appointment_details=$this->Mobile_model->get_bidding_appointment_details($b_id);
			if(count($appointment_details)>0){
				$add=array(
					'hos_id'=>isset($appointment_details['hos_id'])?$appointment_details['hos_id']:'',
					'patinet_name'=>isset($appointment_details['patinet_name'])?$appointment_details['patinet_name']:'',
					'city'=>isset($appointment_details['city'])?$appointment_details['city']:'',
					'age'=>isset($appointment_details['age'])?$appointment_details['age']:'',
					'mobile'=>isset($appointment_details['mobile'])?$appointment_details['mobile']:'',
					'department'=>isset($appointment_details['department'])?$appointment_details['department']:'',
					'specialist'=>isset($appointment_details['specialist'])?$appointment_details['specialist']:'',
					'doctor_id'=>'',
					'date'=>isset($appointment_details['date'])?$appointment_details['date']:'',
					'time'=>isset($appointment_details['time'])?$appointment_details['time']:'',
					'status'=>1,
					'create_at'=>date('Y-m-d H:i:s'),
					'create_by'=>$a_u_id,
					'coming_through'=>0,
					);
				$save_appointment=$this->Mobile_model->save_appointment($add);
				$get_coupon=$this->Mobile_model->get_hospital_counpon_code($appointment_details['hos_id']);
				if(count($save_appointment)>0){
					
						$remaing_temp_appoint=$this->Mobile_model->get_remaining_appointment_list($appointment_details['date'],$appointment_details['time'],$appointment_details['department'],$appointment_details['specialist']);
							if(count($remaing_temp_appoint)>0){
								foreach($remaing_temp_appoint as $list){
									$this->Mobile_model->delete_temp_appointment($list['b_id']);
								}
							}
							/*push notification */
					$details=$this->Mobile_model->get_appointment_user_details($a_u_id);
					$url = "https://fcm.googleapis.com/fcm/send";
					$token=$details['token'];
					$serverKey = $this->config->item('server_key_push');
					$title = "Appointment Confirmation";
					//$body = "Hello ".$details['name']." you have an appointment booked";
					$body = "Hello ".$details['name']." you have an appointment booked for ".$appointment_details['hos_bas_name'].", on ".$appointment_details['date'].$appointment_details['time'].". use this  coupon code ".$get_coupon['coupon_code'];
					$notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
					$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
					$json = json_encode($arrayToSend);
					$headers = array();
					$headers[] = 'Content-Type: application/json';
					$headers[] = 'Authorization: key='. $serverKey;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);

					curl_setopt($ch, CURLOPT_CUSTOMREQUEST,

					"POST");
					curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
					curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
					//Send the request
					$response = curl_exec($ch);
					//Close request
					if ($response === FALSE) {
					die('FCM Send Error: ' . curl_error($ch));
					}
					curl_close($ch);
					/*push notification */
								$message = array('status'=>1,'Appointment id'=>$save_appointment,'a_u_id'=>$a_u_id,'message'=>'Appointment successfully added');
								$this->response($message, REST_Controller::HTTP_OK);
					}else{
								$message = array('status'=>0,'a_u_id'=>$a_u_id,'message'=>'Technical problem will occured. Please try again.');
								$this->response($message, REST_Controller::HTTP_OK);
					}
			}else{
				$message = array('status'=>0,'a_u_id'=>$a_u_id,'b_id'=>$b_id,'message'=>'It is not accepted in hospital.Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	
	public  function appointment_userprofile_post(){
		
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

}
