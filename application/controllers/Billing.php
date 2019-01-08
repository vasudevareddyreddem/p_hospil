<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Billing extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('Billing_model');
		$this->load->model('Resources_model');
	}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['tab']=base64_decode($this->uri->segment(3));
					$data['billing_list']=$this->Billing_model->get_all_billing_list($userdetails['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('billing/billing',$data);
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
	public  function check_coupon_code(){
		$post=$this->input->post();
		$admindetails=$this->session->userdata('userdetails');
		$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
		//echo '<pre>';print_r($userdetails);exit;
		$details=$this->Billing_model->get_coupon_code_details($post['coupon_code'],$post['coupon_id'],$userdetails['hos_id']);
		//echo $this->db->last_query();
		//echo '<pre>';print_r($details);exit;				
		if(count($details)>0){
							$current_time=$details['created_at'];
							$date=date('Y-m-d H:i:s');
							$datetime1 = new DateTime($current_time);
							$datetime2 = new DateTime($date);
							$interval = $datetime1->diff($datetime2);
							//echo '<pre>';print_r($interval);exit;
							$diff_in_hrs =$interval->format('%h');
				if($diff_in_hrs >=0 && $diff_in_hrs <2){
					$wallet_detials=$this->Billing_model->get_wallet_amt_details($details['created_by']);
					//echo '<pre>';print_r($wallet_detials);
					$billing_id=$this->Billing_model->get_lastest_patient_billing_details($post['patient_id']);
					//echo '<pre>';print_r($billing_id);exit;
					$percent=($post['bill_amount'])*($details['ip_amount_percentage']);
					$percen_amount=$percent/100;
					$amount=($post['bill_amount'])-($percen_amount);
					//echo $percen_amount;
					if($wallet_detials['remaining_wallet_amount']>=$percen_amount){
							$data['msg']=1;
							$data['amt']=$amount;
							$data['billing_id']=$billing_id['b_id'];
							$data['cou_amt']=$details['ip_amount_percentage'];
							$data['appointment_user_id']=$details['created_by'];
							echo json_encode($data);exit;
					}else{
						$data['msg']=4;
						echo json_encode($data);exit;
					}
			
			}else{
				$data['msg']=5;
				echo json_encode($data);exit;
			}
		}else{
			$data['msg']=3;
			echo json_encode($data);exit;
		}
		//echo $this->db->last_query();
		//echo '<pre>';print_r($details);exit;
		
	}
	public  function check_labcoupon_code(){
		$post=$this->input->post();
		$admindetails=$this->session->userdata('userdetails');
		$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
		//echo '<pre>';print_r($userdetails);exit;
		$details=$this->Billing_model->get_labcoupon_code_details($post['coupon_code'],$post['coupon_id'],$userdetails['hos_id']);
		//echo $this->db->last_query();
		//echo '<pre>';print_r($details);exit;				
		if(count($details)>0){
							$current_time=$details['created_at'];
							$date=date('Y-m-d H:i:s');
							$datetime1 = new DateTime($current_time);
							$datetime2 = new DateTime($date);
							$interval = $datetime1->diff($datetime2);
							//echo '<pre>';print_r($interval);exit;
							$diff_in_hrs =$interval->format('%h');
				if($diff_in_hrs >=0 && $diff_in_hrs <2){
					$wallet_detials=$this->Billing_model->get_wallet_amt_details($details['created_by']);
					//echo '<pre>';print_r($wallet_detials);
					$billing_id=$this->Billing_model->get_lastest_patient_billing_details($post['patient_id']);
					//echo '<pre>';print_r($billing_id);exit;
					$percent=($post['bill_amount'])*($details['lab_amount_percentage']);
					$percen_amount=$percent/100;
					$amount=($post['bill_amount'])-($percen_amount);
					//echo $percen_amount;
					if($wallet_detials['remaining_wallet_amount']>=$percen_amount){
							$data['msg']=1;
							$data['amt']=$amount;
							$data['billing_id']=$billing_id['b_id'];
							$data['cou_amt']=$details['lab_amount_percentage'];
							$data['appointment_user_id']=$details['created_by'];
							echo json_encode($data);exit;
					}else{
						$data['msg']=4;
						echo json_encode($data);exit;
					}
			
			}else{
				$data['msg']=5;
				echo json_encode($data);exit;
			}
		}else{
			$data['msg']=3;
			echo json_encode($data);exit;
		}
		//echo $this->db->last_query();
		//echo '<pre>';print_r($details);exit;
		
	}
	
	public  function addpost(){
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			$add=array(
				'hos_id'=>isset($userdetails['hos_id'])?$userdetails['hos_id']:'',
				'patient_id'=>isset($post['patient_id'])?$post['patient_id']:'',
				'billing_id'=>isset($post['b_id'])?$post['b_id']:'',
				'card_number'=>isset($post['card_number'])?$post['card_number']:'',
				'p_name'=>isset($post['p_name'])?$post['p_name']:'',
				'p_mobile'=>isset($post['p_mobile'])?$post['p_mobile']:'',
				'p_amount'=>isset($post['p_amount'])?$post['p_amount']:'',
				'coupon_code'=>isset($post['coupon_code'])?$post['coupon_code']:'',
				'pay_amount'=>isset($post['coupon_discount_amount'])?$post['coupon_discount_amount']:'',
				'category_type'=>isset($post['category_type'])?$post['category_type']:'',
				'payment_type'=>isset($post['payment_type'])?$post['payment_type']:'',
			);
			//echo '<pre>';print_r($add);exit;
			$save_billing=$this->Billing_model->save_billing_data($add);
			if(count($save_billing)>0){
				if(isset($post['appointment_user_id']) && $post['appointment_user_id']!=''){
						if($post['category_type']==2){
							$ip="IP";
						}else{
							$ip="Lab";
						}
							$code_details=array(
								'b_id'=>isset($post['b_id'])?$post['b_id']:'',
								'type'=>$ip,
								'type_id'=>isset($post['category_type'])?$post['category_type']:'',
								'amount'=>$post['p_amount'],
								'p_id'=>$post['patient_id'],
								'coupon_code'=>$post['coupon_code'],
								'coupon_code_amount'=>(($post['p_amount'])-($post['coupon_discount_amount'])),
								'purpose'=>'Ip billing Purpose',
								'created_at'=>date('Y-m-d H:i:s'),
								'created_by'=>$admindetails['a_id'],
								'appointment_user_id'=>$post['appointment_user_id'],
								);
								$this->Billing_model->save_coupon_code_history($code_details);
								$wallet_detials=$this->Billing_model->get_wallet_amt_details($post['appointment_user_id']);
								if($post['category_type']==3){
									$amt_data=array('remaining_wallet_amount'=>(($wallet_detials['remaining_wallet_amount'])-(($post['p_amount'])-($post['coupon_discount_amount']))));

								}else{
									$amt_data=array('remaining_wallet_amount'=>(($wallet_detials['remaining_wallet_amount'])-(($post['p_amount'])-($post['coupon_discount_amount']))));

								}
								$amount_update=$this->Billing_model->update_op_wallet_amt_details($post['appointment_user_id'],$amt_data);
						
				
				}
				
				$this->session->set_flashdata('success',"Billing data successfully added");
				redirect('billing/index/'.base64_encode(1));
				
			}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect('billing/index/');
			}
			//echo '<pre>';print_r($post);exit;
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
		
	}
	
	
	
}
