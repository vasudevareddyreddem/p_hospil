<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Appointments extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('Appointments_model');
		}
		public function index(){
			if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');

				if($admindetails['role_id']=3){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['departments_list']=$this->Resources_model->get_hospital_deportments($userdetails['hos_id']);
					
					$data['tab']= base64_decode($this->uri->segment(3));
					$data['appointment_list']=$this->Appointments_model->get_website_appintmenr_list($userdetails['hos_id']);
					//echo '<pre>';print_r($data['appointment_list']);exit; 
					$data['app_appointment_list']=$this->Appointments_model->get_app_appointment_list($userdetails['hos_id']);
					//echo '<pre>';print_r($data['app_appointment_list']);exit; 
					$data['app_appointment_list_count']=$this->Appointments_model->get_app_appointment_list_count(
					$userdetails['hos_id']);
					//echo count($data['app_appointment_list_count']);
					//echo '<pre>';print_r($data['app_appointment_list_count']);exit; 
					//echo $this->db->last_query();
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/appointments',$data);
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
		}
		
		public function reasonpost()
				
			 {
				
			 if($this->session->userdata('userdetails'))
					{
					$admindetails=$this->session->userdata('userdetails');
					
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$explode=explode('/',$post['b_id']);
					//echo'<pre>';print_r($explode);exit;
					$b_id=$explode[0];
					$add=array(
					'reason'=>isset($post['rea_son'])?$post['rea_son']:'',
					'status'=>2,
					);
					//echo'<pre>';print_r($add);exit;
					$update=$this->Appointments_model->update_app_reason($b_id,$add);
					//echo $this->db->last_query();exit;
					if(count($update)>0){
						$details=$this->Appointments_model->get_appointment_user_details($b_id);
										$user_details=$this->Appointments_model->get_apapointment_user_email($details['create_by']);
											
											//$this->db->last_query();
											$get_coupon=$this->Appointments_model->get_hospital_counpon_code($details['hos_id']);
											$hos_conatct=$this->Appointments_model->get_appoinment_hospital_details($details['hos_id']);
											
											$this->load->library('email');
											$this->email->set_newline("\r\n");
											$this->email->set_mailtype("html");
											$this->email->to($user_details['email']);
											$this->email->from('customerservice@ealthinfra.com', 'Ehealthinfra'); 
											$this->email->subject('Appointment rejected'); 
											$body = "Dear ".$details['name'].", your appointment  is rejected, for the  ".$details['hos_bas_name'].", on ".$details['date'].$details['time'].".Reason  ".$post['rea_son']." .Any queries call ".$hos_conatct['hos_rep_contact'];
											//echo $body;exit;
											$this->email->message($body);
											$this->email->send();
											$username=$this->config->item('smsusername');
											$pass=$this->config->item('smspassword');
											$sender=$this->config->item('sender');
											$msg = "Dear ".$details['name'].", your appointment  is rejected, for the  ".$details['hos_bas_name'].", on ".$details['date'].$details['time'].".Reason  ".$post['rea_son']." .Any queries call ".$hos_conatct['hos_rep_contact'];

											
											$ch2 = curl_init();
											curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
											curl_setopt($ch2, CURLOPT_POST, 1);
											curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$user_details['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
											curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
											//echo '<pre>';print_r($ch);exit;
											$server_output = curl_exec ($ch2);
											curl_close ($ch2);
						 $this->session->set_flashdata('success','Appointment successfully rejected');
						redirect('appointments/index/');
					}else{
							$this->session->set_flashdata('error','Technical problem will occured. try again once');
						redirect('appointments/index/');
					}
					
			
			
			
		
		}
		
		
	}
		
		
		
		
		
		
		
		
		
		public  function add(){
			
			if($this->session->userdata('userdetails'))
			{
				$admindetails=$this->session->userdata('userdetails');
				$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);

				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$add=array(
					'hos_id'=>isset($userdetails['hos_id'])?$userdetails['hos_id']:'',
					'patinet_name'=>isset($post['patinet_name'])?strtoupper($post['patinet_name']):'',
					'age'=>isset($post['age'])?$post['age']:'',
					'mobile'=>isset($post['mobile'])?$post['mobile']:'',
					'department'=>isset($post['department'])?$post['department']:'',
					'specialist'=>isset($post['specialist'])?$post['specialist']:'',
					'doctor_id'=>isset($post['doctor_id'])?$post['doctor_id']:'',
					'date'=>isset($post['date'])?$post['date']:'',
					'time'=>isset($post['time'])?$post['time']:'',
					'status'=>1,
					'create_at'=>date('Y-m-d H:i:s'),
					'create_by'=>$admindetails['a_id'],
					'coming_through'=>1,
					);
					//echo '<pre>';print_r($add);exit;
					$save=$this->Appointments_model->save_appointments($add);
					if(count($save)>0){
							   $hospital_details=$this->Appointments_model->get_hospital_name_details($userdetails['hos_id']);
								$username=$this->config->item('smsusername');
								$pass=$this->config->item('smspassword');
								$sender=$this->config->item('sender');
								$static_number=$this->config->item('static_number');
								$msg = "An appointment is booked for ".$hospital_details['hos_bas_name'].", on ".$post['date'].$post['time']." patient name" .$post['patinet_name']. " and patient mobile ".$post['mobile'];
								$ch2 = curl_init();
								curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
								curl_setopt($ch2, CURLOPT_POST, 1);
								curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$static_number.'&text='.$msg.'&priority=ndnd&stype=normal');
								curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
								//echo '<pre>';print_r($ch);exit;
								$server_output = curl_exec ($ch2);
								curl_close ($ch2);
								//echo '<pre>';print_r($hospital_details);
								//echo '<pre>';print_r($server_output);exit;
							$this->session->set_flashdata('success',"Appointment successfully added");
							redirect('appointments/index/'.base64_encode(3));
						}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('appointments');
						}
					//echo '<pre>';print_r($add);exit;
				}else{
				$this->session->set_flashdata('error','Please login to continue');
				redirect('admin');
				}
			}else{
				$this->session->set_flashdata('error','Please login to continue');
				redirect('admin');
			}
		}
		
		public function accept_status()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');
             $post=$this->input->post();
			 $bid=explode("/",$post['b_id']);
			// echo '<pre>';print_r($post);
			// echo '<pre>';print_r($bid);exit;
			if($login_details['role_id']==3){
				
					$b_id=$bid[0];
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=2;
					}else{
						$statu=1;
					}
					if($b_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'create_at'=>date('Y-m-d H:i:s')
							);
							//echo'<pre>';print_r($stusdetails);exit;
									$statusdata= $this->Appointments_model->update_appointment_status_details($b_id,$stusdetails);
							//echo $this->db->last_query();exit;
                        						
							if(count($statusdata)>0){
								/*push notification */
											$details=$this->Appointments_model->get_appointment_user_details(base64_decode($b_id));
											$get_coupon=$this->Appointments_model->get_hospital_counpon_code($details['hos_id']);

											/*$url = "https://fcm.googleapis.com/fcm/send";
											$token=$details['token'];
											$serverKey = $this->config->item('server_key_push');
											$title = "Appointment Confirmation";
											//$body = "Hello ".$details['name']." you have an appointment booked";
											$body = "Hello ".$details['name']." you have an appointment booked from ".$details['hos_bas_name'].", on ".$details['date'].$details['time'].". use this  coupon code ".$get_coupon['coupon_code'];
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
											
											echo '<pre>';print_r($response);exit;
											//Close request
											if ($response === FALSE) {
											die('FCM Send Error: ' . curl_error($ch));
											}
											curl_close($ch);*/
											/*push notification */
											
											//echo $status;exit;
								$this->session->set_flashdata('success',"Patient details successfully  accepted.");
								
								redirect('appointments/index/'.base64_encode(2));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('appointments/index/'.base64_encode(2));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
					
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
		
		
	}
	
	
		
		public function change_time(){
			
						$post=$this->input->post();
						 $bid=explode("/",$post['b_id']);
							
								$b_id=$bid[0];
								$status=base64_decode($bid[1]);
								if($status==1){
									$statu=2;
								}else{
									$statu=1;
								}
							//echo '<pre>';print_r($post); 
								$stusdetails=array(
									'date'=>$post['date_val'],
									'time'=>$post['time_val'],
									'status'=>$statu,
									);
									$statusdata= $this->Appointments_model->update_appointment_status_details($b_id,$stusdetails);
									//echo $this->db->last_query();exit;
									if(count($statusdata)>0){
										$details=$this->Appointments_model->get_appointment_user_details($b_id);
										//echo '<pre>';print_r($details);exit;
										$add_app=array(
											'hos_id'=>isset($details['hos_id'])?$details['hos_id']:'',
											'city'=>isset($details['city'])?strtoupper($details['city']):'',
											'patinet_name'=>isset($details['patinet_name'])?strtoupper($details['patinet_name']):'',
											'age'=>isset($details['age'])?$details['age']:'',
											'mobile'=>isset($details['mobile'])?$details['mobile']:'',
											'department'=>isset($details['department'])?$details['department']:'',
											'specialist'=>isset($details['specialist'])?$details['specialist']:'',
											'doctor_id'=>isset($details['doctor_id'])?$details['doctor_id']:'',
											'date'=>isset($details['date'])?$details['date']:'',
											'time'=>isset($details['time'])?$details['time']:'',
											'status'=>1,
											'create_at'=>date('Y-m-d H:i:s'),
											'create_by'=>$details['create_by'],
											'coming_through'=>0,
											'b_id'=>isset($details['b_id'])?$details['b_id']:'',
											);
										
										$save=$this->Appointments_model->save_appointments($add_app);
										
										$user_details=$this->Appointments_model->get_apapointment_user_email($details['create_by']);
											
											//$this->db->last_query();
											$get_coupon=$this->Appointments_model->get_hospital_counpon_code($details['hos_id']);
											$hos_conatct=$this->Appointments_model->get_appoinment_hospital_details($details['hos_id']);
											//echo '<pre>';print_r($get_coupon);exit;
											$this->load->library('email');
											$this->email->set_newline("\r\n");
											$this->email->set_mailtype("html");
											$this->email->to($user_details['email']);
											$this->email->from($hos_conatct['hos_bas_email'], $hos_conatct['hos_bas_name']); 
											$this->email->subject('Appointment Confirmation'); 
											$body = "Dear ".$details['name'].", your appointment  is confirmed, for the ".$details['hos_bas_name'].", on ".$details['date'].$details['time'].".Use coupon code <b>".$get_coupon['coupon_code']."</b> to avail discounts.Any queries call ".$hos_conatct['hos_rep_contact'];
											//echo $body;exit;
											$this->email->message($body);
											$this->email->send();
											$mobile=$user_details['mobile'];
											
											
											$username=$this->config->item('smsusername');
											$pass=$this->config->item('smspassword');
											$sender=$this->config->item('sender');
											$msg = "Dear ".$details['name'].", your appointment  is confirmed, for the ".$details['hos_bas_name'].", on ".$details['date'].$details['time'].".Use coupon code ".ucfirst($get_coupon['coupon_code'])." to avail discounts.Any queries call ".$hos_conatct['hos_rep_contact'];
											/* seller purpose*/
											$ch2 = curl_init();
											curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
											curl_setopt($ch2, CURLOPT_POST, 1);
											curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$mobile.'&text='.$msg.'&priority=ndnd&stype=normal');
											curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
											//echo '<pre>';print_r($ch);exit;
											$server_output = curl_exec ($ch2);
											curl_close ($ch2);
											
											
											
											//echo '<pre>';print_r($server_output);exit;
										//echo '<pre>';print_r($user_details);
										//echo '<pre>';print_r($details);exit;
										/*push notification */
											
											/*$url = "https://fcm.googleapis.com/fcm/send";
											$token=$details['token'];
											$serverKey = $this->config->item('server_key_push');
											$title = "Appointment Confirmation";
											//$body = "Hello ".$details['name']." you have an appointment booked";
											$body = "Hello ".$details['name']." you have an appointment booked from ".$details['hos_bas_name'].", on ".$details['date'].$details['time'].". use this  coupon code ".$get_coupon['coupon_code'];
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
											
											//echo '<pre>';print_r($response);exit;
											//Close request
											if ($response === FALSE) {
											die('FCM Send Error: ' . curl_error($ch));
											}
											curl_close($ch*/
											/*push notification */
										$this->session->set_flashdata('success',"Appointment successfully accepted.");
										
										redirect('appointments/index/'.base64_encode(2));
									}else{
											$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
											redirect('appointments/index/'.base64_encode(2));
									}
			//echo '<pre>';print_r($post);exit;
		}
	
	
	
	
	
}
