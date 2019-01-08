<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Wallet extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Wallet_model');	
		}
	public function addpost()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$admindetails=$this->session->userdata('userdetails');
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$add=array(
					'hospital_id'=>isset($post['hospital_id'])?$post['hospital_id']:'',
					'wallet_amount'=>isset($post['wallet_amount'])?$post['wallet_amount']:'',
					'ip_amount_percentage'=>isset($post['ip_amount_percentage'])?$post['ip_amount_percentage']:'',
					'op_amount_percentage'=>isset($post['op_amount_percentage'])?$post['op_amount_percentage']:'',
					'lab_amount_percentage'=>isset($post['lab_amount_percentage'])?$post['lab_amount_percentage']:'',
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$admindetails['a_id'],
					);
					$save=$this->Wallet_model->add_wallet_money_percentage($add);
					if(count($save)>0){
						$this->session->set_flashdata('success',"Wallet amount successfully added");
						redirect('admin/couponcodes/'.base64_encode(1));
						
					}else{
						$this->session->set_flashdata('error',"Technical problem will occured. Please try again ");
						redirect('admin/couponcodes/');
						
					}
					//echo '<pre>';print_r($data);exit;
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public  function status(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$admindetails=$this->session->userdata('userdetails');
					$w_id=base64_decode($this->uri->segment(3));
					$hospital_id=base64_decode($this->uri->segment(4));
					$status=base64_decode($this->uri->segment(5));
					if($status==1){
						$sta=0;
					}else{
						$sta=1;
					}
					if($status==0){
						$check=$this->Wallet_model->check_amount_active_ornot($hospital_id);
						if(count($check)>0){
							$this->session->set_flashdata('error',"Before activating  the new wallet amount, deactivate the existing one.");
							redirect('admin/couponcodes/'.base64_encode(1));
						}
						
					}
					$details=array(
						'status'=>$sta,
						'updated_at'=>date('Y-m-d H:i:s')
						);
					//echo '<pre>';print_r($billing);exit;
						$updated=$this->Wallet_model->update_wallet_amount_details($w_id,$details);
						if(count($updated)>0){
							if($status==1){
							$this->session->set_flashdata('success',"Wallet amount successfully deactivated.");
							}else{
								$this->session->set_flashdata('success',"Wallet amount successfully activated.");
							}
							redirect('admin/couponcodes/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('admin/couponcodes/'.base64_encode(1));
						}
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function delete()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$admindetails=$this->session->userdata('userdetails');
					$w_id=base64_decode($this->uri->segment(3));
					$details=array(
						'status'=>2,
						'updated_at'=>date('Y-m-d H:i:s')
						);
					//echo '<pre>';print_r($billing);exit;
						$updated=$this->Wallet_model->update_wallet_amount_details($w_id,$details);
						if(count($updated)>0){
							$this->session->set_flashdata('success',"Wallet amount successfully deleted.");
							redirect('admin/couponcodes/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('admin/couponcodes/'.base64_encode(1));
						}
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	
	public  function checking_coupon_code(){
		$post=$this->input->post();
		$admindetails=$this->session->userdata('userdetails');
		$details=$this->Wallet_model->get_coupon_code_details($post['coupon_code'],$post['patient_id'],$post['hospital_id']);
							
		if(count($details)>0){
							$current_time=$details['created_at'];
							$date=date('Y-m-d H:i:s');
							$datetime1 = new DateTime($current_time);
							$datetime2 = new DateTime($date);
							$interval = $datetime1->diff($datetime2);
							//echo '<pre>';print_r($interval);
							$diff_in_hrs =$interval->format('%h');
				if($diff_in_hrs >=0 && $diff_in_hrs <2){
					$wallet_detials=$this->Wallet_model->get_wallet_amt_details($details['create_by']);
					//echo '<pre>';print_r($wallet_detials);
					
					$percent=($post['bill_amount'])*($details['op_amount_percentage']);
					$percen_amount=$percent/100;
					$amount=($post['bill_amount'])-($percen_amount);
					//echo $percen_amount;
					if($wallet_detials['remaining_wallet_amount']>=$percen_amount){
						
							$data['msg']=1;
							$data['amt']=$amount;
							$data['appointment_user_id']=$details['create_by'];
							$data['cou_amt']=$details['op_amount_percentage'];
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
	public function addamountpost()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$admindetails=$this->session->userdata('userdetails');
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$add=array(
					'wallet_amount'=>isset($post['wallet_amount'])?$post['wallet_amount']:'',
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$admindetails['a_id'],
					);
					$save=$this->Wallet_model->add_wallet_money($add);
					if(count($save)>0){
						$this->session->set_flashdata('success',"Wallet amount successfully added");
						redirect('admin/couponcodes/'.base64_encode(3));
						
					}else{
						$this->session->set_flashdata('error',"Technical problem will occured. Please try again ");
						redirect('admin/couponcodes/'.base64_encode(2));
						
					}
					//echo '<pre>';print_r($data);exit;
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public  function amt_status(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$admindetails=$this->session->userdata('userdetails');
					$w_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$sta=0;
					}else{
						$sta=1;
					}
					if($status==0){
						$check=$this->Wallet_model->check_wallet_amount_active_ornot();
						if(count($check)>0){
							$this->session->set_flashdata('error',"Before activating  the new wallet amount, deactivate the existing one.");
							redirect('admin/couponcodes/'.base64_encode(3));
						}
						
					}
					$details=array(
						'status'=>$sta,
						'updated_at'=>date('Y-m-d H:i:s')
						);
					//echo '<pre>';print_r($billing);exit;
						$updated=$this->Wallet_model->update_wallet_am_details($w_id,$details);
						if(count($updated)>0){
							if($status==1){
							$this->session->set_flashdata('success',"Wallet amount successfully deactivated.");
							}else{
								$this->session->set_flashdata('success',"Wallet amount successfully activated.");
							}
							redirect('admin/couponcodes/'.base64_encode(3));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('admin/couponcodes/'.base64_encode(3));
						}
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	
		

		
		
  }