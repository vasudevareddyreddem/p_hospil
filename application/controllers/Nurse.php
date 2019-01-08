<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Nurse extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('Nurse_model');
		}
	public function index()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('nurse/index');
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			//$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function patient_follow_ups()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['admit_patient_list']=$this->Nurse_model->get_admited_patient_list($userdetails['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('nurse/patient_follow_ups',$data);
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			//$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function consultation()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				//echo '<pre>';print_r($logindetails);exit;
				if($admindetails['role_id']==10){
					$patient_id=base64_decode($this->uri->segment(3));
					if($patient_id==''){
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
					}
					$data['patient_id']=isset($patient_id)?$patient_id:'';
					$data['billing_id']=base64_decode($this->uri->segment(4));
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['encounters_list']=$this->Resources_model->get_vitals_list($patient_id);
					$data['patient_details']=$this->Resources_model->get_patient_details($patient_id);
					$data['patient_medicine_list']=$this->Resources_model->get_patient_medicine_details_list($patient_id,$data['billing_id']);
					$data['patient_privious_medicine_list']=$this->Resources_model->get_patient_previous_medicine_details_list($patient_id);
					$data['patient_privious_alternate_medicine_list']=$this->Resources_model->get_patient_previous_alternate_medicine_details_list($patient_id);
					$data['patient_investigation_list']=$this->Resources_model->get_patient_investigation_details_list($patient_id,$data['billing_id']);
					$data['medicine_list']=$this->Resources_model->get_hospital_medicine_list($userdetails['hos_id']);
					$data['doctors_list']=$this->Resources_model->get_hospital_doctors_list($userdetails['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('nurse/start_consultation',$data);
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			//$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function bed_transfer()
	{	
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				if($admindetails['role_id']==10){
					$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$data['ip_admitted_patient_list'] =$this->Ward_model->get_admitted_patient_list($hos_ids['hos_id']);
					
					/* transfor patient */
							$roomno = base64_decode($this->uri->segment(3));
							$data['bed_details_list']= $this->Ward_model->get_admitted_patients_details($roomno);
							$a=$this->Ward_model->get_admitted_patients_details($roomno);
							$admindetails=$this->session->userdata('userdetails');
							$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
							$data['ward_list'] =$this->Ward_model->get_ward_list_details($hos_ids['hos_id']);	
							$data['wardtype_list'] =$this->Ward_model->get_wardtype_list_details($hos_ids['hos_id']);
							$data['floor_list'] =$this->Ward_model->get_floor_list_details($hos_ids['hos_id']);
							$data['roomtype_list'] =$this->Ward_model->get_roomtype_list_details($hos_ids['hos_id']);
							$data['roomnum_list'] =$this->Ward_model->get_roomnumber_list_detailss($a['floor_no'],$hos_ids['hos_id']);	
							$data['bed_list'] =$this->Ward_model->get_bed_list_details($a['room_no'],$hos_ids['hos_id']);	
					/* transfor patient */
					//echo '<pre>';print_r($data);exit;
					$this->load->view('nurse/bed_transfer',$data);
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
	
	public function transferpatientseditpost()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['tab']=base64_decode($this->uri->segment(3));
					$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;			
					//echo '<pre>';print_r($data);exit;	
					$admitted_patients_details=array(
					'previous_bed_id'=>isset($post['previous_bed_id'])?$post['previous_bed_id']:'',
					'hos_id'=>isset($hos_ids['hos_id'])?$hos_ids['hos_id']:'',
					'pt_id'=>isset($post['pid'])?$post['pid']:'',
					'bill_id'=>isset($post['bid'])?$post['bid']:'',
					'w_name'=>isset($post['ward_name'])?$post['ward_name']:'',
					'w_type'=>$post['ward_type'],
					'room_type'=>$post['room_type'],
					'floor_no'=>$post['floor_number'],
					'room_no'=>$post['room_num'],
					'bed_no'=>$post['bed_number'],
					'status'=>0,
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$admindetails['a_id']
				);
				echo '<pre>';print_r($admitted_patients_details);exit;
				$transfor_patient= $this->Nurse_model->save_transfor_patinet($admitted_patients_details);
				if(count($transfor_patient)>0){
					$this->session->set_flashdata('success',"admitted patient details updated successfully");
					redirect('ward_management/transfer/'.base64_encode(3));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/transfer');
				}											
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
    public function patient_discharge()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('nurse/patient_discharge');
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			//$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
    public function reports()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('nurse/reports');
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			//$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function reports_view()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('nurse/reports_view');
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			//$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	
	public  function addvitals(){
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				if($admindetails['role_id']==10){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$billing=array(
						'p_id'=>isset($post['p_id'])?$post['p_id']:'',
						'b_id'=>isset($post['b_id'])?$post['b_id']:'',
						'bp'=>isset($post['bp'])?$post['bp']:'',
						'pulse'=>isset($post['pulse'])?$post['pulse']:'',
						'fbs_rbs'=>isset($post['fbs_rbs'])?$post['fbs_rbs']:'',
						'temp'=>isset($post['temp'])?$post['temp']:'',
						'weight'=>isset($post['weight'])?$post['weight']:'',
						'create_at'=>date('Y-m-d H:i:s'),
						'date'=>date('Y-m-d')
					);
					//echo '<pre>';print_r($billing);exit;
						$update=$this->Resources_model->saving_patient_vital_details($billing);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Vitals successfully added.");
							redirect('nurse/consultation/'.base64_encode($post['p_id']).'/'.base64_encode($post['b_id']));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('nurse/consultation/'.base64_encode($post['p_id']).'/'.base64_encode($post['b_id']));
						}
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			//$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	
	
	
	
}
