<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Executive extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		
		}
	public function index()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$admindetails=$this->session->userdata('userdetails');
					$data['tab']=base64_decode($this->uri->segment(3));
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					//echo'<pre>';print_r($userdetails);exit;
					$data['executive_name']=$this->Admin_model->executive_name_list_data($admindetails['a_id']);
					//echo'<pre>';print_r($data);exit;
					$data['executive_location']=$this->Admin_model->executive_location_list_data($admindetails['a_id']);
					$data['executive_list']=$this->Admin_model->executive_list_data($admindetails['a_id']);
					$user_details=$this->Admin_model->get_basic_agent_details_location($admindetails['a_id']);
						//echo'<pre>';print_r($user_details);exit;
						
						  $data['appointments']=$this->Admin_model->get_appointment_list_data_patient_overall($user_details['location']);
						//echo'<pre>';print_r($data['appointments']);exit;
			
	
			
			
			
					$this->load->view('executive/index',$data);
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
	
	public function indexpost()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
			$admindetails=$this->session->userdata('userdetails');
			//echo '<pre>';print_r($admindetails);exit;
			$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
			//echo '<pre>';print_r($userdetails);exit;
			$checking=$this->Admin_model->executive_check_email_exits($post['email_id']);
				//echo '<pre>';print_r($checking);exit;
				if(count($checking)>0){
					$this->session->set_flashdata('error',"Email already exits");
					redirect('executive/index/');
				}
			if($_FILES['kyc']['name']!=''){
					$catimg=$_FILES['kyc']['name'];
					move_uploaded_file($_FILES['kyc']['tmp_name'], "assets/kyc_documents/" . $_FILES['kyc']['name']);

					}else{
					$catimg='';
					}
			    if($_FILES['profile_pic']['name']!=''){
					$cat=$_FILES['profile_pic']['name'];
					move_uploaded_file($_FILES['profile_pic']['tmp_name'], "assets/adminprofilepic/" . $_FILES['profile_pic']['name']);

					}else{
					$cat='';
					}
			
			
				$save_data=array(
				'name'=>isset($post['name'])?$post['name']:'',
				'mobile'=>isset($post['mobile'])?$post['mobile']:'',
				'email_id'=>isset($post['email_id'])?$post['email_id']:'',
		        'password'=>isset($post['org_password'])?md5($post['org_password']):'',	
				'org_password'=>isset($post['org_password'])?$post['org_password']:'',
				'address'=>isset($post['address'])?$post['address']:'',
				'bank_account'=>isset($post['bank_account'])?$post['bank_account']:'',
				'bank_name'=>isset($post['bank_name'])?$post['bank_name']:'',
				'ifsccode'=>isset($post['ifsccode'])?$post['ifsccode']:'',
				'bank_holder_name'=>isset($post['bank_holder_name'])?$post['bank_holder_name']:'',
				'kyc'=>$catimg,
				'profile_pic'=>$cat,
				'location'=>isset($post['location'])?$post['location']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'added_by'=>$userdetails['a_id']
				 );
			//echo '<pre>';print_r($save_data);exit;
				$save=$this->Admin_model->executive_details($save_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success',"Executive details are successfully added");	
					redirect('executive/index/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('executive/index/');
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
	
	public function edit()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					 $this->uri->segment(3);
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($admindetails);exit;
					
					$data['edit_executive_list']=$this->Admin_model->edit_executive_list_data(base64_decode($this->uri->segment(3)));
					//echo $this->db->last_query();exit;
				//echo '<pre>';print_r($data['edit_executive_list']);exit;
				
					$this->load->view('executive/index-edit',$data);
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

	public function edit_indexpost()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
				$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
				
				$user_save=$this->Admin_model->saver_user($post['e_id']);
			//echo'<pre>';print_r($user_save);exit;
			
			if($user_save['email_id']!=$post['email_id']){
			$check=$this->Admin_model->saver_user_details($post['email_id']);
			//echo'<pre>';print_r($check);exit;
			if(count($check)>0){
					 $this->session->set_flashdata('error',"email alreay to exit");
					 redirect('executive/index/'.base64_encode(1));
			      }	
			}
				
				
			if($_FILES['kyc']['name']!=''){
					$catimg=$_FILES['kyc']['name'];
					move_uploaded_file($_FILES['kyc']['tmp_name'], "assets/kyc_documents/" . $_FILES['kyc']['name']);

					}else{
					$catimg=$user_save['kyc'];
					}
			  if($_FILES['profile_pic']['name']!=''){
					$cat=$_FILES['profile_pic']['name'];
					move_uploaded_file($_FILES['profile_pic']['tmp_name'], "assets/adminprofilepic/" . $_FILES['profile_pic']['name']);

					}else{
					$cat=$user_save['profile_pic'];
					}
			
			
				$update_data=array(
				'name'=>isset($post['name'])?$post['name']:'',
				'mobile'=>isset($post['mobile'])?$post['mobile']:'',
				'email_id'=>isset($post['email_id'])?$post['email_id']:'',
				'address'=>isset($post['address'])?$post['address']:'',
				'bank_account'=>isset($post['bank_account'])?$post['bank_account']:'',
				'bank_name'=>isset($post['bank_name'])?$post['bank_name']:'',
				'ifsccode'=>isset($post['ifsccode'])?$post['ifsccode']:'',
				'bank_holder_name'=>isset($post['bank_holder_name'])?$post['bank_holder_name']:'',
				'kyc'=>$catimg,
				'profile_pic'=>$cat,
				'location'=>isset($post['location'])?$post['location']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'added_by'=>$userdetails['a_id']
				 );
					//echo'<pre>';print_r($update_data);exit;	
				$update=$this->Admin_model->update_executive_details($post['e_id'],$update_data);	
					//echo'<pre>';print_r($update);exit;
					if(count($update)>0){
					$this->session->set_flashdata('success',"Executive details are successfully updated");	
					redirect('executive/index/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('executive/index/',$post['e_id']);
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
	
	public function executivestatus()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==1){
					$e_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($e_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							//echo'<pre>';print_r($stusdetails);exit;
							$statusdata=$this->Admin_model->update_executive_details($e_id,$stusdetails);
							//echo $this->db->last_query();exit;	
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"executive successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"executive successfully Activate.");
								}
								redirect('executive/index/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('executive/index/'.base64_encode(1));
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
	
	
	public function delete()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==1){
					$e_id=base64_decode($this->uri->segment(3));
					
					
							$delete_data=$this->Admin_model->delete_executive_details($e_id);
							if(count($delete_data)>0){
								$this->session->set_flashdata('success',"executive details successfully deleted.");
								
								 redirect('executive/index/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('executive/index/'.base64_encode($e_id));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
					
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		
		
	}
	public function patientlist()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

				if($login_details['role_id']==1){
					$city=base64_decode($this->uri->segment(3));
					$data['patient_list']=$this->Admin_model->get_patient_history_list_data(base64_decode($this->uri->segment(3)));
					//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
				
					$this->load->view('executive/patient_list',$data);
					$this->load->view('html/footer');
					//echo $city;exit;
					
				}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
					
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		
		
	}
	public function notreceived_patientlist()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

				if($login_details['role_id']==1){
					$city=base64_decode($this->uri->segment(4));
					$data['patient_list']=$this->Admin_model->get_city_wise_not_recived_count(base64_decode($this->uri->segment(4)));
					//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
				
					$this->load->view('executive/not_patient_list',$data);
					$this->load->view('html/footer');
					//echo $city;exit;
					
				}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
					
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		
		
	}
	
	
	
	
}
