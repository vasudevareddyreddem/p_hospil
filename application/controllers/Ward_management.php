<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class ward_management extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('Ward_model');
		
		}
public function index()
	{			
		if($this->session->userdata('userdetails'))
		{	
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']==9){									
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/index');
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
	
	public function admitdetails()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']==9){
				$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
				$data['tab']=base64_decode($this->uri->segment(3));
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);					
				//echo '<pre>';print_r($post);exit;				
				//echo $this->db->last_query();exit;
				//echo '<pre>';print_r($data);exit;
				$admitted_patients_details=array(
					'hos_id'=>$hos_ids['hos_id'],
					'pt_id'=>$post['p_id'],
					'bill_id'=>$post['b_id'],
					'd_id'=>$post['d_id'],
					'w_name'=>$post['ward_name'],
					'w_type'=>$post['ward_type'],
					'room_type'=>$post['room_type'],
					'floor_no'=>$post['floor_number'],
					'room_no'=>$post['room_num'],
					'date_of_admit'=>date('Y-m-d H:i:s'),
					'bed_no'=>$post['bed'],
					'created_by'=>$userdetails['r_id']
				);
					//echo '<pre>';print_r($admitted_patients_details);exit;
				$ward = $this->Ward_model->admitted_patients($admitted_patients_details);

				if(count($ward)>0){
					$this->session->set_flashdata('success',"admitted patient details added successfully");
					redirect('ward_management/admit/'.base64_encode(3));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/admit');
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
	
	
	
	
	public function admit()
	{			
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
				if($admindetails['role_id']==9){
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['tab']=base64_decode($this->uri->segment(3));
					$data['p_id']=base64_decode($this->uri->segment(4));
					$data['b_id']=base64_decode($this->uri->segment(5));
					$data['d_id']=base64_decode($this->uri->segment(6));
					$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					//echo '<pre>';print_r($hos_ids);exit;
					$data['ip_patient_list']=$this->Ward_model->get_ip_patient_list($hos_ids['hos_id']);
					$data['ip_admitted_patient_list'] =$this->Ward_model->get_admitted_patient_list($hos_ids['hos_id']);
					//echo $this->db->last_query();exit;
				    //echo '<pre>';print_r($data);exit;
					$data['ward_list'] =$this->Ward_model->get_ward_list_details($hos_ids['hos_id']);					
					$data['wardtype_list'] =$this->Ward_model->get_wardtype_list_details($hos_ids['hos_id']);
					$data['floor_list'] =$this->Ward_model->get_floor_list_details($hos_ids['hos_id']);
					$data['roomtype_list'] =$this->Ward_model->get_roomtype_list_details($hos_ids['hos_id']);
					$data['roomnum_list'] =$this->Ward_model->get_roomnumber_list_details($hos_ids['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/admit-patients',$data);
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
	
	public function admitted_patients_status()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$ward_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($ward_id!=''){
						$stusdetails=array(
							'status'=>$statu,
														
							);
							$statusdata= $this->Ward_model->update_admitted_patient_details(base64_decode($ward_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){									
								$this->session->set_flashdata('success',"admitted_patients_details successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"admitted_patients_details successfully activated.");
								}
									redirect('ward_management/admit/'.base64_encode(3));;
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/admit/'.base64_encode(3));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/admit/'.base64_encode(3));
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
	
	public function admitpatientsdelete()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$admitted_patient_id=$this->uri->segment(3);
					if($admitted_patient_id!=''){
						$deletdata=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							
							);
							$deletedata= $this->Ward_model->update_admitted_patient_details(base64_decode($admitted_patient_id),$deletdata);
							if(count($deletedata)>0){
								$this->session->set_flashdata('success',"admitted_patients_details successfully removed.");
								redirect('ward_management/admit/'.base64_encode(3));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/admit/'.base64_encode(3));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/admit/'.base64_encode(3));
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
	
	public function admittedpatientsedit()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$roomno = base64_decode($this->uri->segment(3));
				$data['list']= $this->Ward_model->get_admitted_patients_details($roomno);
				$a=$this->Ward_model->get_admitted_patients_details($roomno);
				$admindetails=$this->session->userdata('userdetails');
				$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$data['ward_list'] =$this->Ward_model->get_ward_list_details($hos_ids['hos_id']);	
				$data['wardtype_list'] =$this->Ward_model->get_wardtype_list_details($hos_ids['hos_id']);
				$data['floor_list'] =$this->Ward_model->get_floor_list_details($hos_ids['hos_id']);
				$data['roomtype_list'] =$this->Ward_model->get_roomtype_list_details($hos_ids['hos_id']);
				$data['roomnum_list'] =$this->Ward_model->get_roomnumber_list_detailss($a['floor_no'],$hos_ids['hos_id']);	
				$data['bed_list'] =$this->Ward_model->get_bed_list_details($a['room_no'],$hos_ids['hos_id']);	
				//echo $this->db->last_query();exit;
				//echo '<pre>';print_r($data);exit;
				$this->load->view('ward/admit-patients-edit',$data);
				$this->load->view('html/footer');
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	
	public function admitpatientseditpost()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['tab']=base64_decode($this->uri->segment(3));
					$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$post=$this->input->post();
					//echo '<pre>';print_r($hos_ids);exit;					
					//echo '<pre>';print_r($data);exit;	
					$admitted_patients_details=array(
					'w_name'=>$post['ward_name'],
					'w_type'=>$post['ward_type'],
					'room_type'=>$post['room_type'],
					'floor_no'=>$post['floor_number'],
					'room_no'=>$post['room_num'],
					'bed_no'=>$post['bed'],
					'updated_at'=>date('Y-m-d H:i:s')
				);
					//echo '<pre>';print_r($admitted_patients_details);exit;
				$ward = $this->Ward_model->update_admitted_patient_details($post['wardname'],$admitted_patients_details);
				if(count($ward)>0){
					$this->session->set_flashdata('success',"admitted patient details updated successfully");
					redirect('ward_management/admit/'.base64_encode(3));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/admit');
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

	public function discharge()
	{			
		if($this->session->userdata('userdetails'))
		{	$admindetails=$this->session->userdata('userdetails');
				if($admindetails['role_id']=1){
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$data['discharge_patient_list'] =$this->Ward_model->get_admited_discharge_patient_list($hos_ids['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/discharge',$data);
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
	public function transfer()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				if($admindetails['role_id']=1){
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$data['ip_admitted_patient_list'] =$this->Ward_model->get_admitted_patient_list($hos_ids['hos_id']);
					//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/transfer',$data);
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

	public function transferpatientsedit()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$roomno = base64_decode($this->uri->segment(3));
				$data['list']= $this->Ward_model->get_admitted_patients_details($roomno);
				$a=$this->Ward_model->get_admitted_patients_details($roomno);
				$admindetails=$this->session->userdata('userdetails');
				$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$data['ward_list'] =$this->Ward_model->get_ward_list_details($hos_ids['hos_id']);	
				$data['wardtype_list'] =$this->Ward_model->get_wardtype_list_details($hos_ids['hos_id']);
				$data['floor_list'] =$this->Ward_model->get_floor_list_details($hos_ids['hos_id']);
				$data['roomtype_list'] =$this->Ward_model->get_roomtype_list_details($hos_ids['hos_id']);
				$data['roomnum_list'] =$this->Ward_model->get_roomnumber_list_detailss($a['floor_no'],$hos_ids['hos_id']);	
				$data['bed_list'] =$this->Ward_model->get_bed_list_details($a['room_no'],$hos_ids['hos_id']);	
				//echo $this->db->last_query();exit;
				//echo '<pre>';print_r($data);exit;
				$this->load->view('ward/transfer_patients_edit',$data);
				$this->load->view('html/footer');
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
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
					//echo '<pre>';print_r($hos_ids);exit;					
					//echo '<pre>';print_r($data);exit;	
					$admitted_patients_details=array(
					'w_name'=>$post['ward_name'],
					'w_type'=>$post['ward_type'],
					'room_type'=>$post['room_type'],
					'floor_no'=>$post['floor_number'],
					'room_no'=>$post['room_num'],
					'bed_no'=>$post['bed'],
					'updated_at'=>date('Y-m-d H:i:s')
				);
					//echo '<pre>';print_r($admitted_patients_details);exit;
				$ward = $this->Ward_model->update_admitted_patient_details($post['wardname'],$admitted_patients_details);
				if(count($ward)>0){
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
	
	public function bed_chart()
	{			
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==9){
					$hos_ids =$this->Ward_model->get_resources_hospital_id($login_details['a_id'],$login_details['a_email_id']);
					
					$data['red_chart_list']=$this->Ward_model->get_bed_empty_list_count($hos_ids['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/bed-chart',$data);
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
	public function observation()
	{			
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				if($admindetails['role_id']=1){					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/observation');
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
	public function admit_discharge_statistics()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){										
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/admit-discharge-statistics');
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
	
	public function patient_history_post()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=1){
				$post=$this->input->post();
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$admitted_patientid=$this->uri->segment(3);
					if($admitted_patientid!=''){
						$updatedata=array(
							'completed'=>1,
							'amount_status'=>1,	
							'discharge_date'=>date('Y-m-d H:i:s')	
							);
							$editdata= $this->Ward_model->update_discharge_patient_list(base64_decode($admitted_patientid),$updatedata);
						if(count($editdata)>0){
								$this->session->set_flashdata('success',"patient successfully dicharged.");
								redirect('ward_management/patient_history/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/patient_history/'.base64_encode(1));
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
	
	}
	
	public function patient_history()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				if($admindetails['role_id']=1){
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$hos_ids =$this->Ward_model->get_resources_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$data['patient_history'] =$this->Ward_model->get_discharge_patient_history($hos_ids['hos_id']);
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/patient-history',$data);
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
	public function discharge_report()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/discharge-report');
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
	public function wardnamepost()
	{	
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					//echo '<pre>'; print_r($hos_ids);exit;
				//echo '<pre>';print_r($post);exit;
					$exits_treatment = $this->Ward_model->get_saved_wardname($post['ward_name'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"ward name already exists .please use another name");
						redirect('ward_management/wardname/');
					}
				$ward_details=array(
					'hos_id'=>$hos_ids['hos_id'],
					'ward_name'=>$post['ward_name'],
					'status'=>1,
					'create_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$hos_ids['a_id']
					);
					//echo '<pre>';print_r($ward_details);exit;
				$ward = $this->Ward_model->save_wardname($ward_details);
				if(count($ward)>0){
					$this->session->set_flashdata('success',"Ward added successfully");
					redirect('ward_management/wardname/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/wardname');
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

	public function wardname()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
				$data['tab']=base64_decode($this->uri->segment(3));
				$admindetails=$this->session->userdata('userdetails');
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$data['ward_list'] =$this->Ward_model->get_ward_list($hos_ids['a_id'],$hos_ids['hos_id']);					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/wardname',$data);
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
	
	public function wardnamedelete()
	{
		
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$treatment_id=$this->uri->segment(3);
					if($treatment_id!=''){
						$deletdata=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							
							$deletedata= $this->Ward_model->update_ward_details(base64_decode($treatment_id),$deletdata);
							if(count($deletedata)>0){
								$this->session->set_flashdata('success',"Treatment successfully removed.");
								redirect('ward_management/wardname/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/wardname/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/wardname/'.base64_encode(1));
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

	public function wardnameeditpost()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				$editdata_check= $this->Ward_model->get_ward_details($post['wardid']);
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);

				if($editdata_check['ward_name']!=$post['w_name']){
					$exits_treatment = $this->Ward_model->get_saved_wardname($post['w_name'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"ward name already exists .please use another name");
						redirect('ward_management/wardname/'.base64_encode(1));
					}
				}
				$editward_details=array(
					'ward_name'=>$post['w_name'],
					'updated_at'=>date('Y-m-d H:i:s')					
					);
					//echo '<pre>';print_r($post);exit;
				$editdata= $this->Ward_model->update_ward_details($post['wardid'],$editward_details);
				//echo '<pre>';print_r($editdata);exit;
				if(count($editdata)>0){
					$this->session->set_flashdata('success',"wardname successfully updated");
					redirect('ward_management/wardname/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/wardname');
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
	
	public function wardnamestatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$ward_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($ward_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Ward_model->update_ward_details(base64_decode($ward_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"wardname successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"wardname successfully activated.");
								}
									redirect('ward_management/wardname/'.base64_encode(1));;
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/wardname/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/wardname/'.base64_encode(1));
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
	
	public function wardtypepost()
	{	
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					//echo '<pre>'; print_r($hos_ids);exit;
				//echo '<pre>';print_r($post);exit;
					$exits_treatment = $this->Ward_model->get_saved_wardtype($post['ward_name'],$post['ward_type'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"wardtype already exists .please use another name");
						redirect('ward_management/wardtype/');
					}
				$ward_details=array(
					'hos_id'=>$hos_ids['hos_id'],
					'wid'=>$post['ward_name'],
					'ward_type'=>$post['ward_type'],
					'status'=>1,
					'create_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$hos_ids['a_id']
					);
					//echo '<pre>';print_r($ward_details);exit;
				$ward = $this->Ward_model->save_wardtype($ward_details);
				if(count($ward)>0){
					$this->session->set_flashdata('success',"Ward added successfully");
					redirect('ward_management/wardtype/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/wardtype');
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

	public function wardtype()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$data['tab']=base64_decode($this->uri->segment(3));
				$admindetails=$this->session->userdata('userdetails');
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);	
				$data['ward_list'] =$this->Ward_model->get_ward_list($hos_ids['a_id'],$hos_ids['hos_id']);		
				$data['wardtype_list'] =$this->Ward_model->get_wardtype_list($hos_ids['a_id'],$hos_ids['hos_id']);				
					//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/wardtype',$data);
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
	
	public function wardtypestatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$ward_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($ward_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							
							);
							$statusdata= $this->Ward_model->update_wardtype_details(base64_decode($ward_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"wardtype successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"wardtype successfully activated.");
								}
									redirect('ward_management/wardtype/'.base64_encode(1));;
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/wardtype/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/wardtype/'.base64_encode(1));
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
	
	public function wardtypeeditpost()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				$editdata_check= $this->Ward_model->get_wardtype_details($post['ward_type']);
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				//echo '<pre>';print_r($editdata_check);exit;
				if($editdata_check['ward_type']!=$post['wt_name'] || $editdata_check['ward_name']!=$post['wid']){
					$exits_treatment = $this->Ward_model->get_saved_wardtype($post['ward_name'],$post['wt_name'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"wardtype already exists .please use another name");
						redirect('ward_management/wardtype/'.base64_encode(1));
					}
				}
				
				$editward_details=array(
					'wid'=>$post['ward_name'],
					'ward_type'=>$post['wt_name'],
					'updated_at'=>date('Y-m-d H:i:s')
					);
					//echo '<pre>';print_r($post);exit;
				$editdata= $this->Ward_model->update_wardtype_details($post['ward_type'],$editward_details);
				//echo '<pre>';print_r($editdata);exit;
				if(count($editdata)>0){
					$this->session->set_flashdata('success',"wardtype successfully updated");
					redirect('ward_management/wardtype/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/wardtype');
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
	
	public function wardtypedelete()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$ward_id=$this->uri->segment(3);
					if($ward_id!=''){
						$deletdata=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							
							);
							$deletedata= $this->Ward_model->update_wardtype_details(base64_decode($ward_id),$deletdata);
							if(count($deletedata)>0){
								$this->session->set_flashdata('success',"wardtype successfully removed.");
								redirect('ward_management/wardtype/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/wardtype/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/wardtype/'.base64_encode(1));
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
	
	public function floornumberpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					//echo '<pre>'; print_r($hos_ids);exit;
				//echo '<pre>';print_r($post);exit;
					$exits_treatment = $this->Ward_model->get_saved_floor($post['room_type'],$post['floor_number'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"floornumber already exists .please use another name");
						redirect('ward_management/floornumber/');
					}
				$floor_details=array(
					'hos_id'=>$hos_ids['hos_id'],
					'w_r_type_id'=>$post['room_type'],
					'ward_floor'=>$post['floor_number'],
					'status'=>1,
					'create_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$hos_ids['a_id']
					);
					//echo '<pre>';print_r($floor_details);exit;
				$ward = $this->Ward_model->floornumber($floor_details);
				if(count($ward)>0){
					$this->session->set_flashdata('success',"floornumber added successfully");
					redirect('ward_management/floornumber/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/floornumber');
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

	public function floornumber()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$data['tab']=base64_decode($this->uri->segment(3));
				$admindetails=$this->session->userdata('userdetails');
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$data['roomtype_list'] =$this->Ward_model->get_roomtype_list($hos_ids['a_id'],$hos_ids['hos_id']);
				$data['floor_list'] =$this->Ward_model->get_floor_list($hos_ids['a_id'],$hos_ids['hos_id']);
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/floornumber',$data);
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

	public function floornumberstatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$ward_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($ward_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')							
							);
							$statusdata= $this->Ward_model->update_floor_details(base64_decode($ward_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){									
								$this->session->set_flashdata('success',"floornumber successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"floornumber successfully activated.");
								}
									redirect('ward_management/floornumber/'.base64_encode(1));;
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/floornumber/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/floornumber/'.base64_encode(1));
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

	public function floornumbereditpost()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$post=$this->input->post();
				$editdata_check= $this->Ward_model->get_floor_details($post['floorid']);
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				//echo '<pre>';print_r($editdata_check);exit;
				
				if($editdata_check['ward_floor']!=$post['floor_name'] || $editdata_check['room_type']!=$post['w_r_type_id']){
					$exits_treatment = $this->Ward_model->get_saved_floor($post['room_type'],$post['floor_name'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"floornumber already exists .please use another name");
						redirect('ward_management/floornumber/'.base64_encode(1));
					}
				}
				$editward_details=array(
					'w_r_type_id'=>$post['room_type'],
					'ward_floor'=>$post['floor_name'],
					'updated_at'=>date('Y-m-d H:i:s')
					);
					//echo '<pre>';print_r($post);exit;
				$editdata= $this->Ward_model->update_floor_details($post['floorid'],$editward_details);
				//echo '<pre>';print_r($editdata);exit;
				if(count($editdata)>0){
					$this->session->set_flashdata('success',"floornumber successfully updated");
					redirect('ward_management/floornumber/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/floornumber');
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
	
	public function floornumberdelete()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$ward_id=$this->uri->segment(3);
					if($ward_id!=''){
						$deletdata=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$deletedata= $this->Ward_model->update_floor_details(base64_decode($ward_id),$deletdata);
							if(count($deletedata)>0){
								$this->session->set_flashdata('success',"floornumber successfully removed.");
								redirect('ward_management/floornumber/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/floornumber/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/floornumber/'.base64_encode(1));
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

	public function roomtypepost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$post=$this->input->post();
					$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					//echo '<pre>'; print_r($hos_ids);exit;
				//echo '<pre>';print_r($post);exit;
					$exits_treatment = $this->Ward_model->get_saved_roomtype($post['ward_type'],$post['room_type'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"roomtype already exists .please use another name");
						redirect('ward_management/roomtype/');
					}
				$floor_details=array(
					'hos_id'=>$hos_ids['hos_id'],
					'w_type_id'=>$post['ward_type'],
					'room_type'=>$post['room_type'],
					'status'=>1,
					'create_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$hos_ids['a_id']
					);
					//echo '<pre>';print_r($floor_details);exit;
				$ward = $this->Ward_model->roomtype($floor_details);
				if(count($ward)>0){
					$this->session->set_flashdata('success',"roomtype added successfully");
					redirect('ward_management/roomtype/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/roomtype');
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

	public function roomtype()
	{			
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$data['tab']=base64_decode($this->uri->segment(3));
				$admindetails=$this->session->userdata('userdetails');
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$data['wardtype_list'] =$this->Ward_model->get_wardtype_list($hos_ids['a_id'],$hos_ids['hos_id']);				
				$data['roomtype_list'] =$this->Ward_model->get_roomtype_list($hos_ids['a_id'],$hos_ids['hos_id']);
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/roomtype',$data);
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

	public function roomtypestatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$ward_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($ward_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')							
							);
							$statusdata= $this->Ward_model->update_roomtype_details(base64_decode($ward_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"roomtype successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"roomtype successfully activated.");
								}
									redirect('ward_management/roomtype/'.base64_encode(1));;
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/roomtype/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/roomtype/'.base64_encode(1));
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
	
	public function roomtypeeditpost()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$post=$this->input->post();
				$editdata_check= $this->Ward_model->get_roomtype_details($post['rtypeid']);
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);

				//echo '<pre>';print_r($editdata_check);exit;
			
				if($editdata_check['room_type']!=$post['rtype_name'] || $editdata_check['wardtype']!=$post['w_type_id']){
					$exits_treatment = $this->Ward_model->get_saved_roomtype($post['wardtype'],$post['rtype_name'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"roomtype already exists .please use another name");
						redirect('ward_management/roomtype/'.base64_encode(1));
					}
				}
				$editward_details=array(
					'w_type_id'=>$post['wardtype'],
					'room_type'=>$post['rtype_name'],
					'updated_at'=>date('Y-m-d H:i:s')
					);
					//echo '<pre>';print_r($post);exit;
				$editdata= $this->Ward_model->update_roomtype_details($post['rtypeid'],$editward_details);
				//echo '<pre>';print_r($editdata);exit;
				if(count($editdata)>0){
					$this->session->set_flashdata('success',"roomtype successfully updated");
					redirect('ward_management/roomtype/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/roomtype');
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
	
	public function roomtypedelete()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$ward_id=$this->uri->segment(3);
					if($ward_id!=''){
						$deletdata=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$deletedata= $this->Ward_model->update_roomtype_details(base64_decode($ward_id),$deletdata);
							if(count($deletedata)>0){
								$this->session->set_flashdata('success',"roomtype successfully removed.");
								redirect('ward_management/roomtype/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('ward_management/roomtype/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/roomtype/'.base64_encode(1));
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
	
	public function roomnumberpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']==2){
				$post=$this->input->post();					
					$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					//echo '<pre>'; print_r($hos_ids);exit;
					//echo '<pre>';print_r($post);exit;					
					$exits_roomnumber = $this->Ward_model->get_saved_roomnumber($post['floor_number'],$post['room_num'],$hos_ids['hos_id']);
					//echo '<pre>';print_r($exits_roomnumber);exit;
					if(count($exits_roomnumber)>0){
						$this->session->set_flashdata('error',"roomnumber already exists. please use another name");
						redirect('ward_management/roomnumber/');
					}
				
				$roomno_details=array(
					'hos_id'=>$hos_ids['hos_id'],
					'f_id'=>$post['floor_number'],
					'room_num'=>$post['room_num'],
					'bed_count'=>$post['bed_num'],
					'status'=>1,
					'create_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$hos_ids['a_id']
					);
					
					//echo '<pre>';print_r($roomno_details);exit;
				$ward = $this->Ward_model->roomnumber($roomno_details);
				if(count($ward)>0){				
					for($i=1;$i<=$post['bed_num'];$i++){						
						$bed_details=array(
						'hos_id'=>$hos_ids['hos_id'],
						'w_r_n_id'=>$ward,
						'bed'=>$i,
						'status'=>1,
						'create_at'=>date('Y-m-d H:i:s'),
						'created_by'=>$hos_ids['a_id']
						);									
						//echo '<pre>';print_r($bed_details);exit;
						$wards = $this->Ward_model->bednumber($bed_details);
					}
					if(count($wards)>0){
						$this->session->set_flashdata('success',"Room number and bedcount added successfully");
						redirect('ward_management/roomnumber/'.base64_encode(1));
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/roomnumber');
					}			
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

	public function roomnumber()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$data['tab']=base64_decode($this->uri->segment(3));
				$admindetails=$this->session->userdata('userdetails');
				$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$data['floor_list'] =$this->Ward_model->get_floor_list($hos_ids['a_id'],$hos_ids['hos_id']);
				$data['roomnum_list'] =$this->Ward_model->get_roomnumber_list($hos_ids['a_id'],$hos_ids['hos_id']);
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('ward/roomnumber',$data);
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
	
	
	public function roomnumberedit()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$roomno = base64_decode($this->uri->segment(3));
				$data['list']= $this->Ward_model->get_roomnumber_details($roomno);
								$admindetails=$this->session->userdata('userdetails');
								$hos_ids =$this->Ward_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
								$data['floor_list'] =$this->Ward_model->get_floor_list($hos_ids['a_id'],$hos_ids['hos_id']);

				//echo '<pre>';print_r($data);exit;
				$this->load->view('ward/roomnumberedit',$data);
				$this->load->view('html/footer');
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	
	public function roomnumbereditpost()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$post=$this->input->post();				
				//echo '<pre>';print_r($post);
				$editdata_check= $this->Ward_model->get_roomnumber_details($post['rnoid']);
				$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				//echo '<pre>';print_r($editdata_check);exit;			
				if($editdata_check['room_num']!=$post['room_num'] || $editdata_check['f_id']!=$post['floor_number']){
					$exits_treatment = $this->Ward_model->get_saved_roomnumber($post['floor_number'],$post['room_num'],$hos_ids['hos_id']);
					//echo '<pre>';print_r($exits_treatment);exit;			
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"Room number already exists .please use another name");
						redirect('ward_management/roomnumberedit/'.base64_encode(1));
					}
				}
				$editroomno_details=array(
					'f_id'=>$post['floor_number'],
					'room_num'=>$post['room_num'],
					'bed_count'=>$post['bed_num'],
					'updated_at'=>date('Y-m-d H:i:s')
					);
					//echo '<pre>';print_r($post);exit;					
				$editdata= $this->Ward_model->update_roomnumber_details($post['rnoid'],$editroomno_details);
				if(count($editdata)>0){									
							$beds_count= $this->Ward_model->get_room_number_wise_beds_list($post['rnoid']);
							foreach($beds_count as $list){
								$dele_dat=array(
								'status'=>2,
								'updated_at'=>date('Y-m-d H:i:s')
								);
								$this->Ward_model->update_room_wise_beds_list($list['r_b_id'],$dele_dat);
							}
							//echo '<pre>';print_r($a);exit;
							if(count($post['bed_num'])>0){								      
										for($i=1;$i<=$post['bed_num'];$i++){										
											$bed_details=array(
											'hos_id'=>$hos_ids['hos_id'],
											'w_r_n_id'=>$post['rnoid'],
											'bed'=>$i,
											'status'=>1,
											'create_at'=>date('Y-m-d H:i:s'),
											'created_by'=>$hos_ids['a_id']
											);									
											//echo '<pre>';print_r($bed_details);exit;
											$this->Ward_model->bednumber($bed_details);
										}
							}					
					$this->session->set_flashdata('success',"Room number details successfully updated");
					redirect('ward_management/roomnumber/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/roomnumberedit');
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

	public function roomnumberdelete()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$roomno_id=$this->uri->segment(3);
					if($roomno_id!=''){
						$deletdata=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$deletedata= $this->Ward_model->update_roomnumber_details(base64_decode($roomno_id),$deletdata);
							if(count($deletedata)>0){								
								$bedno_id=$this->uri->segment(3);
								if($bedno_id!=''){
									$deletdatas=array(
										'status'=>2,
										'updated_at'=>date('Y-m-d H:i:s')
										);
									$deletedatas= $this->Ward_model->update_bednumber_details(base64_decode($bedno_id),$deletdatas);
									if(count($deletedatas)>0){
										$this->session->set_flashdata('success',"Room number details successfully removed.");
										redirect('ward_management/roomnumber/'.base64_encode(1));
									}else{
										$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
										redirect('ward_management/roomnumber/'.base64_encode(1));
									}
								}
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/roomnumber/'.base64_encode(1));
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

	public function roomnumberstatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$ward_id=$this->uri->segment(3);
				$status=base64_decode($this->uri->segment(4));
				if($status==1){
					$statu=0;
				}else{
					$statu=1;
				}
				if($ward_id!=''){
					$stusdetails=array(
						'status'=>$statu,
						'updated_at'=>date('Y-m-d H:i:s')
						);
					$statusdata= $this->Ward_model->update_roomnumber_details(base64_decode($ward_id),$stusdetails);
					if(count($statusdata)>0){							
						$bed_ids=$this->uri->segment(3);
					    $bednostatus=base64_decode($this->uri->segment(4));
					    if($bednostatus==1){
							$statu=0;
							}else{
								$statu=1;
							}
						if($bed_ids!=''){
							$statusdetails=array(
								'status'=>$statu,	
								'updated_at'=>date('Y-m-d H:i:s')
								);
							$bedstatus= $this->Ward_model->update_bednumber_details(base64_decode($bed_ids),$statusdetails);
							if(count($bedstatus)>0){
								if($bednostatus==1){
									$this->session->set_flashdata('success',"roomnumber successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"roomnumber successfully activated.");
								}
								redirect('ward_management/roomnumber/'.base64_encode(1));;
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('ward_management/roomnumber/'.base64_encode(1));
							}
						}								
								if($status==1){
									$this->session->set_flashdata('success',"roomnumber successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"roomnumber successfully activated.");
								}
						redirect('ward_management/roomnumber/'.base64_encode(1));;
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('ward_management/roomnumber/'.base64_encode(1));
					}
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('ward_management/roomnumber/'.base64_encode(1));
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

	public  function get_roomno_list(){
		$post=$this->input->post();
		$details=$this->Ward_model->get_f_id_wise_roomno_list($post['dep_id']);
		//echo $this->db->last_query();exit;
		//echo '<pre>';print_r($details);exit;
		if(count($details) > 0){
			$data['msg']=1;
			$data['list']=$details;
			echo json_encode($data);exit;			
		}else{
			$data['msg']=2;
			echo json_encode($data);exit;
		}
	}
	
	public  function get_bedcount_list(){
		$post=$this->input->post();
		$details=$this->Ward_model->get_w_r_n_id_wise_bedcount($post['b_id']);
		//echo $this->db->last_query();exit;
		//echo '<pre>';print_r($details);exit;
		if(count($details) > 0){
			$data['msg']=1;
			$data['list']=$details;
			echo json_encode($data);exit;				
		}else{
			$data['msg']=2;
			echo json_encode($data);exit;
		}
	}
}
