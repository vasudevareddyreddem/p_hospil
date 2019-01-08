<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

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
		$this->load->library('zend');
	
		$this->load->model('Cron_model');
		$this->load->model('Appointments_model');
		$this->load->library('zend');
			
		}
		
	public function index()
	{	
		
		$all_appointments=$this->Cron_model->get_all_appointments();
		if(count($all_appointments)>0){
			foreach($all_appointments as $list){
				
				$curent_date=date('Y-m-d');
				$c_time=date('H:i');
				$current_time=date("g:i a", strtotime($c_time));
				$current_date=$curent_date.' '.$current_time;
				$appoint_date=$list['date'].' '.$list['time'];
				if($current_date > $appoint_date){
					$this->Cron_model->delete_old_pending_appointment_bidding($list['b_id']);
					
				}
				
			}
		}
	}
	public  function appointment_remainder(){
		$all_appointments=$this->Cron_model->get_all_appoinment_remainder_list();
		
		foreach($all_appointments as $list){
			$appointment_time=$list['date'].' '.$list['time'];
			$date = date("Y-m-d H:i:s", strtotime($appointment_time)); 
			$today = date("Y-m-d H:i:s");

			if ($date < $today) {
				//echo "fast date";
			}else{
					if($list['remainder_sent']=='0000-00-00 00:00:00'){
										$current_time=date('Y-m-d H:i:s');
									}else{
										$current_time=$list['remainder_sent'];
									}
							
							
							$datetime1 = new DateTime($current_time);
							$datetime2 = new DateTime($date);
							$interval = $datetime1->diff($datetime2);
							//echo '<pre>';print_r($interval );
							$diff_in_hrs =$interval->format('%h');
							$username=$this->config->item('smsusername');
							$pass=$this->config->item('smspassword');
							$sender=$this->config->item('sender');
							if($diff_in_hrs > 0 && $interval->days==0 && $diff_in_hrs <=2){
								$get_coupon=$this->Appointments_model->get_hospital_counpon_code($list['hos_id']);
								$hos_conatct=$this->Appointments_model->get_appoinment_hospital_details($list['hos_id']);
														
								
								if($list['remainder_sent']=='0000-00-00 00:00:00'){
									
									$msg = "Remainder, dear ".$list['patinet_name'].", you have appointment at ".$hos_conatct['hos_bas_name'].", on ".$list['date'].$list['time'].".Any queries call ".$hos_conatct['hos_rep_contact'];
									$ch2 = curl_init();
									curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
									curl_setopt($ch2, CURLOPT_POST, 1);
									curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$list['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
									curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
									//echo '<pre>';print_r($ch);exit;
									$server_output = curl_exec ($ch2);
									curl_close ($ch2);
										/* update time*/
										$remain_update=array('remainder_sent'=>date('Y-m-d H:i:s'));
										$this->Cron_model->update_reminader_date_sent_otp($list['id'],$remain_update);
										/* update time*/
								}else{
									$c_date = date("Y-m-d H:i:s");
									$datetime1 = new DateTime($c_date);
									$datetime2 = new DateTime($list['remainder_sent']);
									$msg_interval = $datetime1->diff($datetime2);
									if($msg_interval->h >=1){
											$msg = "Remainder, dear ".$list['patinet_name'].", you have appointment at ".$hos_conatct['hos_bas_name'].", on ".$list['date'].$list['time'].".Any queries call ".$hos_conatct['hos_rep_contact'];
											$ch2 = curl_init();
											curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
											curl_setopt($ch2, CURLOPT_POST, 1);
											curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$list['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
											curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
											//echo '<pre>';print_r($ch);exit;
											$server_output = curl_exec ($ch2);
											curl_close ($ch2);
												/* update time*/
											$remain_update=array('remainder_sent'=>date('Y-m-d H:i:s'));
											$this->Cron_model->update_reminader_date_sent_otp($list['id'],$remain_update);
											/* update time*/
									}
								}
								
								
							}else if($diff_in_hrs > 4 && $interval->days==0){
								$get_coupon=$this->Appointments_model->get_hospital_counpon_code($list['hos_id']);
								$hos_conatct=$this->Appointments_model->get_appoinment_hospital_details($list['hos_id']);
								
								
								if($list['remainder_sent']=='0000-00-00 00:00:00'){
									$msg = "Remainder, dear ".$list['patinet_name'].", you have appointment at ".$hos_conatct['hos_bas_name'].", on ".$list['date'].$list['time'].".Any queries call ".$hos_conatct['hos_rep_contact'];
									$ch2 = curl_init();
									curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
									curl_setopt($ch2, CURLOPT_POST, 1);
									curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$list['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
									curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
									//echo '<pre>';print_r($ch);exit;
									$server_output = curl_exec ($ch2);
									curl_close ($ch2);
									/* update time*/
									$remain_update=array('remainder_sent'=>date('Y-m-d H:i:s'));
									$this->Cron_model->update_reminader_date_sent_otp($list['id'],$remain_update);
									/* update time*/
								}else{
									$c_date = date("Y-m-d H:i:s");
									$datetime1 = new DateTime($c_date);
									$datetime2 = new DateTime($list['remainder_sent']);
									$msg_interval = $datetime1->diff($datetime2);
									if($msg_interval->h >=6){
											$msg = "Remainder, dear ".$list['patinet_name'].", you have appointment at ".$hos_conatct['hos_bas_name'].", on ".$list['date'].$list['time'].".Any queries call ".$hos_conatct['hos_rep_contact'];
											$ch2 = curl_init();
											curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
											curl_setopt($ch2, CURLOPT_POST, 1);
											curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$list['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
											curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
											//echo '<pre>';print_r($ch);exit;
											$server_output = curl_exec ($ch2);
											curl_close ($ch2);
											
											/* update time*/
											$remain_update=array('remainder_sent'=>date('Y-m-d H:i:s'));
											$this->Cron_model->update_reminader_date_sent_otp($list['id'],$remain_update);
											/* update time*/
									}
								}
								
								
							}else if($interval->days > 24 && $interval->days <=72){
								$get_coupon=$this->Appointments_model->get_hospital_counpon_code($list['hos_id']);
								$hos_conatct=$this->Appointments_model->get_appoinment_hospital_details($list['hos_id']);
								
								if($list['remainder_sent']=='0000-00-00 00:00:00'){
									$msg = "Remainder, dear ".$list['patinet_name'].", you have appointment at ".$hos_conatct['hos_bas_name'].", on ".$list['date'].$list['time'].".Any queries call ".$hos_conatct['hos_rep_contact'];
									$ch2 = curl_init();
									curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
									curl_setopt($ch2, CURLOPT_POST, 1);
									curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$list['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
									curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
									//echo '<pre>';print_r($ch);exit;
									$server_output = curl_exec ($ch2);
									curl_close ($ch2);
											/* update time*/
											$remain_update=array('remainder_sent'=>date('Y-m-d H:i:s'));
											$this->Cron_model->update_reminader_date_sent_otp($list['id'],$remain_update);
											/* update time*/
								}else{
									$c_date = date("Y-m-d H:i:s");
									$datetime1 = new DateTime($c_date);
									$datetime2 = new DateTime($list['remainder_sent']);
									$msg_interval = $datetime1->diff($datetime2);
									if($msg_interval->h >=24){
											$msg = "Remainder, dear ".$list['patinet_name'].", you have appointment at ".$hos_conatct['hos_bas_name'].", on ".$list['date'].$list['time'].".Any queries call ".$hos_conatct['hos_rep_contact'];
											$ch2 = curl_init();
											curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
											curl_setopt($ch2, CURLOPT_POST, 1);
											curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$list['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
											curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
											//echo '<pre>';print_r($ch);exit;
											$server_output = curl_exec ($ch2);
											curl_close ($ch2);
											/* update time*/
											$remain_update=array('remainder_sent'=>date('Y-m-d H:i:s'));
											$this->Cron_model->update_reminader_date_sent_otp($list['id'],$remain_update);
											/* update time*/
									}
								}
							}else  if($interval->days > 72){
								$get_coupon=$this->Appointments_model->get_hospital_counpon_code($list['hos_id']);
								$hos_conatct=$this->Appointments_model->get_appoinment_hospital_details($list['hos_id']);
								
								
								if($list['remainder_sent']=='0000-00-00 00:00:00'){
									$msg = "Remainder, dear ".$list['patinet_name'].", you have appointment at ".$hos_conatct['hos_bas_name'].", on ".$list['date'].$list['time'].".Any queries call ".$hos_conatct['hos_rep_contact'];
									$ch2 = curl_init();
									curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
									curl_setopt($ch2, CURLOPT_POST, 1);
									curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$list['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
									curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
									//echo '<pre>';print_r($ch);exit;
									$server_output = curl_exec ($ch2);
									curl_close ($ch2);
										/* update time*/
											$remain_update=array('remainder_sent'=>date('Y-m-d H:i:s'));
											$this->Cron_model->update_reminader_date_sent_otp($list['id'],$remain_update);
											/* update time*/
								}else{
									$c_date = date("Y-m-d H:i:s");
									$datetime1 = new DateTime($c_date);
									$datetime2 = new DateTime($list['remainder_sent']);
									$msg_interval = $datetime1->diff($datetime2);
									if($msg_interval->h >=72){
											$msg = "Remainder, dear ".$list['patinet_name'].", you have appointment at ".$hos_conatct['hos_bas_name'].", on ".$list['date'].$list['time'].".Any queries call ".$hos_conatct['hos_rep_contact'];
											$ch2 = curl_init();
											curl_setopt($ch2, CURLOPT_URL,"http://trans.smsfresh.co/api/sendmsg.php");
											curl_setopt($ch2, CURLOPT_POST, 1);
											curl_setopt($ch2, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender='.$sender.'&phone='.$list['mobile'].'&text='.$msg.'&priority=ndnd&stype=normal');
											curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
											//echo '<pre>';print_r($ch);exit;
											$server_output = curl_exec ($ch2);
											curl_close ($ch2);
											/* update time*/
											$remain_update=array('remainder_sent'=>date('Y-m-d H:i:s'));
											$this->Cron_model->update_reminader_date_sent_otp($list['id'],$remain_update);
											/* update time*/
									}
								}
								
							}
				
				}
				
			
			//echo '<pre>';print_r($list);exit;
		}
		
		
	}

	
	
	
}
