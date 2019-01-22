<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Resources extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->library('user_agent');
		$this->load->model('Wallet_model');
		
		}
	public function desk()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['patients_list']= $this->Resources_model->get_all_reschedule_patients_lists($userdetails['hos_id']);
					$data['departments_list']=$this->Resources_model->get_hospital_deportments($userdetails['hos_id']);
					//echo '<pre>';print_r($data);exit; 
					$patient_id= base64_decode($this->uri->segment(3));
					if(isset($patient_id) && $patient_id!=''){
								
						$appointment_tab= base64_decode($this->uri->segment(4));
						if($appointment_tab =='appointment'){
							$data['tab']=0;
							$data['pid']='';
							$data['bill_id']='';
							$data['patient_detailes']=array();
							$data['appointment_id']=base64_decode($this->uri->segment(5));
							$data['p_type']= base64_decode($this->uri->segment(5));
						}else{
								$data['patient_detailes']= $this->Resources_model->get_details_details($patient_id);
								$data['tab']= base64_decode($this->uri->segment(4));
								$data['pid']= base64_decode($this->uri->segment(3));
								$data['p_type']= base64_decode($this->uri->segment(5));
								if(is_numeric($data['p_type']))
									{
									$data['bill_id']= base64_decode($this->uri->segment(5));
									$data['billing_detailes']= $this->Resources_model->get_billing_details($data['pid'],$data['p_type']);
									$data['vitals_detailes']= $this->Resources_model->get_billing_vitals_details($data['pid']);
								}else{
									$data['billing_detailes']=array();
									$data['vitals_detailes']=array();
								}
								
							
						}
						
					}else{
						$data['patient_detailes']=array();
						$data['tab']=0;
						 $data['pid']='';
						 $data['bill_id']='';
						 $data['p_type']= base64_decode($this->uri->segment(5));
					}
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/desk',$data);
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
	
	public function transforto_ip()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$admindetails=$this->session->userdata('userdetails');
					$patient_id=base64_decode($this->uri->segment(3));
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$last_billing_address=$this->Resources_model->get_last_billing_id($patient_id);
					$post=$this->input->post();
					$update=array('patient_type'=>1);
					//echo '<pre>';print_r($last_billing_address);exit;
					$update=$this->Resources_model->update_patient_billing_details($last_billing_address['b_id'],$update);
					if(count($update)>0){
						 $this->session->set_flashdata('success',"Patient converted to ip");
						 redirect('resources/desk');
					}else{
						 $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						 redirect('resources/desk');
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
	
	public function vitals()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['patients_list']= $this->Resources_model->get_all_patients_database($userdetails['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/add_vitals_patient_list',$data);
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}public function patient_vitals_list()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$admindetails=$this->session->userdata('userdetails');
					$patient_id=base64_decode($this->uri->segment(3));
					$data['patients_vital_list']= $this->Resources_model->get_all_patient_vitals_list($patient_id);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/patient_vitals_list',$data);
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
	public function addvital()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$admindetails=$this->session->userdata('userdetails');
					$data['patient_id']=base64_decode($this->uri->segment(3));
					$last_billing_address=$this->Resources_model->get_last_billing_id($data['patient_id']);
					$data['bill_id']=$last_billing_address['b_id'];
					$this->load->view('resource/vitals',$data);
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
	public function addvitalspost()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$admindetails=$this->session->userdata('userdetails');
					$post=$this->input->post();
					$add=array(
						'p_id'=>isset($post['pid'])?$post['pid']:'',
						'b_id'=>isset($post['b_id'])?$post['b_id']:'',
						'bp'=>isset($post['bp'])?$post['bp']:'',
						'pulse'=>isset($post['pulse'])?$post['pulse']:'',
						'fbs_rbs'=>isset($post['fbs_rbs'])?$post['fbs_rbs']:'',
						'temp'=>isset($post['temp'])?$post['temp']:'',
						'weight'=>isset($post['weight'])?$post['weight']:'',
						'create_at'=>date('Y-m-d H:i:s'),
						'date'=>date('Y-m-d'),
						'created_by'=>$admindetails['a_id']
						);
						//echo '<pre>';print_r($updating);exit;
						$update=$this->Resources_model->saving_patient_vital_details($add);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Vitals details successfully updated.");
							redirect('resources/vitals');
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/addvital/'.base64_encode($post['pid']));
						}
					//echo '<pre>';print_r($post);exit;
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function patient_databse()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['patients_list']= $this->Resources_model->get_all_patients_database($userdetails['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/patient_database',$data);
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
	public function basic_details()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					//echo '<pre>';print_r($post);exit;
					$tab1=array(
					'hos_id'=>isset($userdetails['hos_id'])?$userdetails['hos_id']:'',
					'card_number'=>isset($post['patient_card_number'])?$post['patient_card_number']:'',
					'registrationtype'=>isset($post['registrationtype'])?$post['registrationtype']:'',
					'patient_category'=>isset($post['patient_category'])?$post['patient_category']:'',
					'problem'=>isset($post['problem'])?$post['problem']:'',
					'referred'=>isset($post['referred'])?$post['referred']:'',
					'name'=>isset($post['name'])?strtoupper($post['name']):'',
					'mobile'=>isset($post['mobile'])?$post['mobile']:'',
					'email'=>isset($post['email'])?$post['email']:'',
					'gender'=>isset($post['gender'])?$post['gender']:'',
					'dob'=>isset($post['dob'])?$post['dob']:'',
					'age'=>isset($post['age'])?$post['age']:'',
					'bloodgroup'=>isset($post['bloodgroup'])?$post['bloodgroup']:'',
					'martial_status'=>isset($post['martial_status'])?$post['martial_status']:'',
					'nationali_id'=>isset($post['nationali_id'])?$post['nationali_id']:'',
					'perment_address'=>isset($post['perment_address'])?$post['perment_address']:'',
					'p_c_name'=>isset($post['p_c_name'])?ucfirst($post['p_c_name']):'',
					'p_s_name'=>isset($post['p_s_name'])?$post['p_s_name']:'',
					'p_zipcode'=>isset($post['p_zipcode'])?$post['p_zipcode']:'',
					'p_country_name'=>isset($post['p_country_name'])?ucfirst($post['p_country_name']):'',
					'temp_address'=>isset($post['temp_address'])?$post['temp_address']:'',
					't_c_name'=>isset($post['t_c_name'])?ucfirst($post['t_c_name']):'',
					't_s_name'=>isset($post['t_s_name'])?$post['t_s_name']:'',
					't_zipcode'=>isset($post['t_zipcode'])?$post['t_zipcode']:'',
					't_country_name'=>isset($post['t_country_name'])?ucfirst($post['t_country_name']):'',
					'create_at'=>date('Y-m-d H:i:s'),
					'create_by'=>$userdetails['a_id']
					);
					//echo '<pre>';print_r($tab1);exit;
					$check_patient_card=$this->Resources_model->get_card_number_list($post['patient_card_number']);
					//echo count($check_patient_card);
					//echo '<pre>';print_r($check_patient_card);exit;
					if(isset($post['pid']) && $post['pid']!=''){
						$_detail=$this->Resources_model->get_details_details($post['pid']);
						if($_detail['card_number']!=$post['patient_card_number']){
										if(count($check_patient_card['card_number'])>0){
											$this->session->set_flashdata('error',"Patient Card Number already exist. Please  use  another Number");
											redirect('resources/desk');
										}
									
									
							}
					
					}else{
						if($post['patient_card_number']!=''){
							if(count($check_patient_card['card_number'])>0){
										$this->session->set_flashdata('error',"Patient Card Number already exist. Please  use  another Number");
										redirect('resources/desk');
							}
						}						
					}
					
					//exit;
					if(isset($post['pid']) && $post['pid']!=''){
						
						$update=$this->Resources_model->update_all_patient_details($post['pid'],$tab1);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Basic Details successfully updated.");
							if(isset($post['op']) && $post['op']==1){
								
									if(isset($post['verifying']) && $post['verifying']=='verify'){
										$type='Reschedule';
									}else{
										$type='Repeated';
									}
									$billing=array(
									'p_id'=>isset($post['pid'])?$post['pid']:'',
									'patient_type'=>0,
									'create_at'=>date('Y-m-d H:i:s'),
									'type'=>$type
									);
									//echo '<pre>';print_r($billing);exit;
									$update=$this->Resources_model->update_all_patient_billing_details($billing);
									//echo $this->db->last_query();exit;
									if(isset($post['verifying']) && $post['verifying']=='verify'){
										redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(11).'/'.base64_encode($update));
									}else{
										redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(11).'/'.base64_encode($update));

									}
							}else{
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(2));	
							}
							
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							if(isset($post['op']) && $post['op']==1){
								redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(11));
							}else{
								redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(1));
							
							}
						}
					}else{
							$addtab=$this->Resources_model->save_basic_details($tab1);
							if(count($addtab)>0){
									/* appointment*/
									if(isset($post['appointment_id']) && $post['appointment_id']!=''){
									$this->Resources_model->update_appointment($post['appointment_id'],$addtab);
									}
									/*appointment*/
								$dta=array(
								'pid'=>$addtab,
								'patient_type'=>0,
								'create_at'=>date('Y-m-d H:i:s')
								);
								$this->zend->load('Zend/Barcode');
								$file = Zend_Barcode::draw('code128', 'image', array('text' => $addtab), array());
								$code = time().$addtab.'.png';
								$store_image1 = imagepng($file, $this->config->item('documentroot')."assets/patient_barcode/{$code}");

								$this->Resources_model->update_patient_details($addtab,$code);
								$this->session->set_flashdata('success',"Basic Details successfully added.");
								if(isset($post['op']) && $post['op']==1){
									$billing=array(
									'p_id'=>isset($addtab)?$addtab:'',
									'patient_type'=>0,
									'create_at'=>date('Y-m-d H:i:s'),
									'type'=>'new'
									);
									//echo '<pre>';print_r($billing);exit;
									$update=$this->Resources_model->update_all_patient_billing_details($billing);
									redirect('resources/desk/'.base64_encode($addtab).'/'.base64_encode(11).'/'.base64_encode($update));
								}else{
								redirect('resources/desk/'.base64_encode($addtab).'/'.base64_encode(2));	
								}
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('resources/desk');
							}
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
	public function demographic()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					//echo '<pre>';print_r($post);exit;
					if(isset($_FILES['patient_identifier']['name']) && $_FILES['patient_identifier']['name']!=''){
							$patient_details= $this->Resources_model->get_paitent_document($post['pid']);
							if($patient_details['patient_identifier']!=''){
								unlink("assets/patient_documents/".$patient_details['patient_identifier']);
							}
							$temp = explode(".", $_FILES["patient_identifier"]["name"]);
							$patient_identifier = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['patient_identifier']['tmp_name'], "assets/hospital_basic_documents/" . $patient_identifier);
						}else{
							$patient_identifier='';
						}
					$tab2=array(
					'mothername'=>isset($post['mothername'])?$post['mothername']:'',
					'occupation'=>isset($post['occupation'])?$post['occupation']:'',
					'education'=>isset($post['education'])?$post['education']:'',
					'home_phone'=>isset($post['home_phone'])?$post['home_phone']:'',
					'patient_identifier'=>$patient_identifier,
					'updated_at'=>date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($tab2);exit;
						$update=$this->Resources_model->update_all_patient_details($post['pid'],$tab2);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Demographic Details successfully updated.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(3));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(2));
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
	public function next()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;
					$tab2=array(
					'relation'=>isset($post['relation'])?$post['relation']:'',
					'first_name'=>isset($post['first_name'])?$post['first_name']:'',
					'next_address1'=>isset($post['next_address1'])?$post['next_address1']:'',
					'next_address2'=>isset($post['next_address2'])?$post['next_address2']:'',
					'next_pincode'=>isset($post['next_pincode'])?$post['next_pincode']:'',
					'next_city'=>isset($post['next_city'])?$post['next_city']:'',
					'next_state'=>isset($post['next_state'])?$post['next_state']:'',
					'next_country'=>isset($post['next_country'])?$post['next_country']:'',
					'next_email'=>isset($post['next_email'])?$post['next_email']:'',
					'next_mobile'=>isset($post['next_mobile'])?$post['next_mobile']:'',
					'next_occupation'=>isset($post['next_occupation'])?$post['next_occupation']:'',
					'updated_at'=>date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($tab2);exit;
						$update=$this->Resources_model->update_all_patient_details($post['pid'],$tab2);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Next of kin details successfully updated.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(4));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(3));
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
	public function payer()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;
					$tab6=array(
					'payer_name'=>isset($post['payer_name'])?$post['payer_name']:'',
					'payer_mobile'=>isset($post['payer_mobile'])?$post['payer_mobile']:'',
					'payer_address'=>isset($post['payer_address'])?$post['payer_address']:'',
					'updated_at'=>date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($tab5);exit;
						$update=$this->Resources_model->update_all_patient_details($post['pid'],$tab6);
						if(count($update)>0){
							$billing=array('p_id'=>isset($post['pid'])?$post['pid']:'');
							$billing_id	=$this->Resources_model->update_all_patient_billing_details($billing);
							$this->session->set_flashdata('success',"Payer details successfully updated.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(5).'/'.base64_encode($billing_id));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(4));
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
	
	public function assign()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;
					$tab11=array(
						'treatment_id'=>$post['department_name'],
						'doct_id'=>$post['department_doctors'],
						'specialist_id'=>$post['specialist_doctor_id'],
						);
						
						$update=$this->Resources_model->update_patient_billing_details($post['b_id'],$tab11);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Assign details successfully updated.");
								if(isset($post['op']) && $post['op']==1){
										redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(12).'/'.base64_encode($post['b_id']));
									}else{
									redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(10).'/'.base64_encode($post['b_id']));
									}
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									if(isset($post['op']) && $post['op']==1){
										redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(11).'/'.base64_encode($post['b_id']));
									}else{
									redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(9).'/'.base64_encode($post['b_id']));
									}
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
	
	
	public function economicdetails()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;
					$tab7=array(
					'dependency'=>isset($post['dependency'])?$post['dependency']:'',
					'arrangement'=>isset($post['arrangement'])?$post['arrangement']:'',
					'incomegroup'=>isset($post['incomegroup'])?$post['incomegroup']:'',
					'description'=>isset($post['description'])?$post['description']:'',
					'confidential'=>isset($post['confidential'])?$post['confidential']:'',
					'student'=>isset($post['student'])?$post['student']:'',
					'updated_at'=>date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($tab5);exit;
						$update=$this->Resources_model->update_all_patient_details($post['pid'],$tab7);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Socio- economic details successfully updated.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(8));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(7));
						}
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}public function visitinfo()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);
					if($post['bill_id']=='reschedule'){
						$bill_type=$post['bill_id'];
					}else{
						$bill_type='new';
					}
					$billing=array(
					'p_id'=>isset($post['pid'])?$post['pid']:'',
					'visit_no'=>isset($post['visit_no'])?$post['visit_no']:'',
					'visit_desc'=>isset($post['visit_desc'])?$post['visit_desc']:'',
					'service_type'=>isset($post['service_type'])?$post['service_type']:'',
					'visit_type'=>isset($post['visit_type'])?$post['visit_type']:'',
					'create_at'=>date('Y-m-d H:i:s'),
					'type'=>isset($bill_type)?$bill_type:'new'
					);
					//echo '<pre>';print_r($billing);exit;
						$update=$this->Resources_model->update_patient_billing_details($post['bill_id'],$billing);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Visit info details successfully updated.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(10).'/'.base64_encode($post['bill_id']).'/'.base64_encode(2));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(10).'/'.base64_encode($post['bill_id']).'/'.base64_encode(1));
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
	public function bills()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;  
					$billing=array(
					'patient_payer_deposit_amount'=>isset($post['patient_payer_deposit_amount'])?$post['patient_payer_deposit_amount']:'',
					'payment_mode'=>isset($post['payment_mode'])?$post['payment_mode']:'',
					'bill_amount'=>isset($post['bill_amount'])?$post['bill_amount']:'',
					'received_form'=>isset($post['received_form'])?$post['received_form']:'',
					'completed'=>1,
					'updated_at'=>date('Y-m-d H:i:s')
					);
					//echo '<pre>';print_r($billing);exit;
						$update=$this->Resources_model->update_patient_billing_details($post['b_id'],$billing);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Bill details successfully updated.");
							if(isset($post['op'])&& $post['op']==1){
									redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(12).'/'.base64_encode($post['b_id']));
							}else{
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(10).'/'.base64_encode($post['b_id']).'/'.base64_encode(2));
							}
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");

							if(isset($post['op'])&& $post['op']==1){
									redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(11).'/'.base64_encode($post['b_id']));
							}else{
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(10).'/'.base64_encode($post['b_id']).'/'.base64_encode(2));
							}
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
	public function genrate_bill()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$pid=base64_decode($this->uri->segment(3));
					$bid=base64_decode($this->uri->segment(4));
					$admindetails=$this->session->userdata('userdetails');
					$data['details']=$this->Resources_model->get_billing_details($pid,$bid);
					//echo '<pre>';print_r($data);exit;
					$path = rtrim(FCPATH,"/");
					$file_name = $data['details']['p_id'].'_'.$data['details']['b_id'].'.pdf';                
					$data['page_title'] = $data['details']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/patient_bills/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('resource/bill', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("/assets/patient_bills/".$file_name);
					//redirect('resources/desk/'.base64_encode($pid).'/'.base64_encode(8).'/'.base64_encode($bid).'/'.base64_encode(4));

				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function print_patient_details()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$pid=base64_decode($this->uri->segment(3));
					$bid=base64_decode($this->uri->segment(4));
					$admindetails=$this->session->userdata('userdetails');
					$data['details']=$this->Resources_model->get_billing_details($pid,$bid);
					$data['vital_details']=$this->Resources_model->get_billing_vital_details($pid,$bid);
					//echo '<pre>';print_r($data);exit;
					$path = rtrim(FCPATH,"/");
					$file_name = $data['details']['p_id'].'_'.$data['details']['b_id'].'.pdf';                
					$data['page_title'] = $data['details']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/patient_information/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('resource/patient_details', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/patient_information/".$file_name);
					//redirect('resources/desk/'.base64_encode($pid).'/'.base64_encode(8).'/'.base64_encode($bid).'/'.base64_encode(4));

				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function print_op_patient_details()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$pid=base64_decode($this->uri->segment(3));
					$bid=base64_decode($this->uri->segment(4));
					$admindetails=$this->session->userdata('userdetails');
					$data['details']=$this->Resources_model->get_billing_details($pid,$bid);
					$data['vital_details']=$this->Resources_model->get_billing_vital_details($pid,$bid);
					//echo '<pre>';print_r($data);exit;
					$path = rtrim(FCPATH,"/");
					$file_name = $data['details']['p_id'].'_'.$data['details']['b_id'].'.pdf';                
					$data['page_title'] = $data['details']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/patient_information/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('resource/print_op_patient_details', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/patient_information/".$file_name);
					//redirect('resources/desk/'.base64_encode($pid).'/'.base64_encode(8).'/'.base64_encode($bid).'/'.base64_encode(4));

				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function op_print_patient_details()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$pid=base64_decode($this->uri->segment(3));
					$bid=base64_decode($this->uri->segment(4));
					$admindetails=$this->session->userdata('userdetails');
					$data['details']=$this->Resources_model->get_billing_details($pid,$bid);
					$data['vital_details']=$this->Resources_model->get_billing_vital_details($pid,$bid);
					//echo '<pre>';print_r($data);exit;
					$path = rtrim(FCPATH,"/");
					$file_name = $data['details']['p_id'].'_'.$data['details']['b_id'].'.pdf';                
					$data['page_title'] = $data['details']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/patient_information/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('resource/op_patient_details', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/patient_information/".$file_name);
					//redirect('resources/desk/'.base64_encode($pid).'/'.base64_encode(8).'/'.base64_encode($bid).'/'.base64_encode(4));

				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	
	public function get_doctors_list(){
		$post=$this->input->post();
		$details=$this->Resources_model->get_doctors_list($post['dep_id']);
		if(count($details) > 0)
				{
				$data['msg']=1;
				$data['list']=$details;
				echo json_encode($data);exit;	
				}else{
					$data['msg']=2;
					echo json_encode($data);exit;
				}
	}
	public function get_spec_doctors_list(){
		$post=$this->input->post();
		$details=$this->Resources_model->get_spec_doctors_list($post['spec_id']);
		//echo $this->db->last_query();exit;
		if(count($details) > 0)
				{
				$data['msg']=1;
				$data['list']=$details;
				echo json_encode($data);exit;	
				}else{
					$data['msg']=2;
					echo json_encode($data);exit;
				}
	}
	public function checking_card_number(){
		$post=$this->input->post();
		$details=$this->Resources_model->get_card_number_list($post['card_number']);
		//echo count($details);
		//echo $this->db->last_query();
		//echo '<pre>';print_r($details);exit;
		if(count($details)>0)
				{
				$data['msg']=1;
				$data['list']=$details;
				echo json_encode($data);exit;	
				}else{
					$data['msg']=0;
					echo json_encode($data);exit;
				}
	}
	public function get_cardnumber_details(){
		$post=$this->input->post();
		$details=$this->Resources_model->get_cardnumber_details($post['card_number']);
		//echo count($details);
		//echo $this->db->last_query();
		//echo '<pre>';print_r($details);exit;
		if(count($details)>0)
				{
				  $data['msg']=1;
				  $data['p_name']=$details['patient_name'];
				  $data['p_mobile']=$details['mobile_num'];
				  $data['p_email']=$details['email_id'];
				 echo json_encode($data);exit;	
				}else{
					$data['msg']=0;
					$data['p_name']='';
					$data['p_mobile']='';
					$data['p_email']='';
					echo json_encode($data);exit;
				}
	}
	public function assign_doctor(){
		$post=$this->input->post();
		$billing=array(
		'treatment_id'=>$post['depart_id'],
		'doct_id'=>$post['doct_id'],
		'completed'=>1
		);
		$update=$this->Resources_model->update_patient_billing_details($post['billing_id'],$billing);
		//echo $this->db->last_query();exit;
		if(count($update) > 0)
				{
				$data['msg']=1;
				echo json_encode($data);exit;	
				}else{
					$data['msg']=2;
					echo json_encode($data);exit;
				}
	}
	public function worksheet()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					
					$data['worksheet']=$this->Resources_model->get_doctor_worksheet_list($userdetails['hos_id'],$userdetails['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/worksheet',$data);
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
	public function completed_worksheet()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['worksheet']=$this->Resources_model->get_completed_doctor_worksheet_list($userdetails['hos_id'],$userdetails['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/completed_worksheet',$data);
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
	public function referrals()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					
					$data['worksheet']=$this->Resources_model->get_doctor_refrrals_list($userdetails['hos_id'],$userdetails['a_id']);
					//echo $this->db->last_query();
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/referrals',$data);
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
	public function consultation()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
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
					//echo '<pre>';print_r($data['patient_privious_medicine_list']);exit;
					$data['patient_privious_alternate_medicine_list']=$this->Resources_model->get_patient_previous_alternate_medicine_details_list($patient_id);
					$data['patient_investigation_list']=$this->Resources_model->get_patient_lab_test_list($patient_id,$data['billing_id']);
					$data['medicine_list']=$this->Resources_model->get_hospital_medicine_list($userdetails['hos_id']);
					$data['doctors_list']=$this->Resources_model->get_hospital_doctors_list($userdetails['hos_id']);
					//$data['patient_lab_list']=$this->Resources_model->get_patient_lab_test_list($patient_id,$data['billing_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/consultation',$data);
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
	public function addvitals()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;
					$billing=array(
						'p_id'=>isset($post['pid'])?$post['pid']:'',
						'b_id'=>isset($post['bid'])?$post['bid']:'',
						'assessment_type'=>isset($post['assessment_type'])?$post['assessment_type']:'',
						'vitaltype'=>isset($post['vitaltype'])?$post['vitaltype']:'',
						'tep_actuals'=>isset($post['tep_actuals'])?$post['tep_actuals']:'',
						'tep_range'=>isset($post['tep_range'])?$post['tep_range']:'',
						'temp_site_positioning'=>isset($post['temp_site_positioning'])?$post['temp_site_positioning']:'',
						'notes'=>isset($post['notes'])?$post['notes']:'',
						'pulse_actuals'=>isset($post['pulse_actuals'])?$post['pulse_actuals']:'',
						'pulse_range'=>isset($post['pulse_range'])?$post['pulse_range']:'',
						'pulse_rate_rhythm'=>isset($post['pulse_rate_rhythm'])?$post['pulse_rate_rhythm']:'',
						'pulse_rate_vol'=>isset($post['pulse_rate_vol'])?$post['pulse_rate_vol']:'',
						'notes1'=>isset($post['notes1'])?$post['notes1']:'',
						'create_at'=>date('Y-m-d H:i:s'),
						'date'=>date('Y-m-d')
					);
					//echo '<pre>';print_r($billing);exit;
						$update=$this->Resources_model->saving_patient_vital_details($billing);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Vitals successfully added.");
							redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']));
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
	public function vitalscomment()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;
					foreach($post['comments'] as $lists){
						$billing=array(
							'p_id'=>isset($post['pid'])?$post['pid']:'',
							'b_id'=>isset($post['bid'])?$post['bid']:'',
							'comments'=>$lists,
							'created_at'=>date('Y-m-d H:i:s'),
							'create_by'=>$admindetails['a_id']
						);
					$update=$this->Resources_model->saving_patient_vital_comments($billing);

					}
				
						if(count($update)>0){
							$this->session->set_flashdata('success',"Vitals Comments successfully added.");
							redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']));
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
	public function medicine(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					if(isset($post['cheking_value']) && $post['cheking_value']==0){
						$this->session->set_flashdata('error',"Some medicine having available quantity is less than given quantity");
						redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']).'#step-2');
					}
					$cnt=0;foreach($post['medicine_name'] as $list){
							if($list!=''){
										$m_name=explode("_",$post['medicine_name'][$cnt]);
										$qtys=$this->Resources_model->get_medicine_details_list_details($m_name[0],$userdetails['hos_id']);
											//echo '<pre>';print_r($list);exit;
											$freq=array();
											if(isset($post['Frequency'][$cnt]) && count($post['Frequency'][$cnt])>0){
											foreach($post['Frequency'][$cnt] as $li){
												$freq[]=$li;
												
											}
											$fr=implode(" ,", $freq);
											}
										$add=array(
											'p_id'=>isset($post['pid'])?$post['pid']:'',
											'b_id'=>isset($post['bid'])?$post['bid']:'',
											'medicine_id'=>isset($qtys['id'])?$qtys['id']:'',
											'medicine_type'=>isset($qtys['medicine_type'])?$qtys['medicine_type']:'',
											'batchno'=>isset($qtys['batchno'])?$qtys['batchno']:'',
											'dosage'=>isset($qtys['dosage'])?$qtys['dosage']:'',
											'expiry_date'=>isset($qtys['expiry_date'])?$qtys['expiry_date']:'',
											'org_amount'=>(($qtys['total_amount'])*($post['qty'][$cnt])),
											'amount'=>$qtys['total_amount'],
											'medicine_name'=>$m_name[0],
											'frequency'=>isset($fr)?$fr:'',
											'qty'=>$post['qty'][$cnt],
											'food'=>$post['food'][$cnt],
											'directions'=>$post['directions'],
											'no_of_days'=>$post['days'][$cnt],
											'create_at'=>date('Y-m-d H:i:s'),
											'date'=>date('Y-m-d'),
											'create_by'=>$admindetails['a_id']
										);
										//echo '<pre>';print_r($add);
										$medicine=$this->Resources_model->saving_patient_medicine($add);
										if(isset($medicine) && count($medicine)>0){
												$qty=(($qtys['qty'])-($post['qty'][$cnt]));
												$data=array('qty'=>$qty);
												$this->Resources_model->update_medicine_details($qtys['id'],$data);
										}
							}
							
					$cnt++;}
					
					//exit;
					
						if(count($medicine)>0){
							$update=array('completed_type'=>1,'doctor_status'=>1);
							$this->Resources_model->update_patient_medicine_details($post['pid'],$post['bid'],$update);
							$this->session->set_flashdata('success',"Medicines successfully added.");
							redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']).'#step-2');
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']).'#step-2');
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
	public function medicine_back(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$m_name=explode("_",$post['medicine_name']);
					$qtys=$this->Resources_model->get_medicine_details_list_details($m_name[0],$userdetails['hos_id']);
					//echo '<pre>';print_r($qtys);
						
						$addmedicine=array(
							'p_id'=>isset($post['pid'])?$post['pid']:'',
							'b_id'=>isset($post['bid'])?$post['bid']:'',
							'medicine_id'=>isset($qtys['id'])?$qtys['id']:'',
							'type_of_medicine'=>isset($post['type_of_medicine'])?$post['type_of_medicine']:'',
							'medicine_name'=>isset($m_name[0])?$m_name[0]:'',
							'medicine_type'=>isset($qtys['medicine_type'])?$qtys['medicine_type']:'',
							'batchno'=>isset($qtys['batchno'])?$qtys['batchno']:'',
							'substitute_name'=>isset($post['substitute_name'])?$post['substitute_name']:'',
							'condition'=>isset($post['condition'])?$post['condition']:'',
							'dosage'=>isset($qtys['dosage'])?$qtys['dosage']:'',
							'expiry_date'=>isset($qtys['expiry_date'])?$qtys['expiry_date']:'',
							'route'=>isset($post['route'])?$post['route']:'',
							'frequency'=>isset($post['frequency'])?$post['frequency']:'',
							'food'=>isset($post['food'])?$post['food']:'',
							'no_of_days'=>isset($post['days'])?$post['days']:'',
							'directions'=>isset($post['directions'])?$post['directions']:'',
							'formdate'=>isset($post['formdate'])?$post['formdate']:'',
							'todate'=>isset($post['todate'])?$post['todate']:'',
							'qty'=>isset($post['qty'])?$post['qty']:'',
							'org_amount'=>(($qtys['total_amount'])*($post['qty'])),
							'amount'=>$qtys['total_amount'],
							'units'=>isset($post['units'])?$post['units']:'',
							'comments'=>isset($post['comments'])?$post['comments']:'',
							'create_at'=>date('Y-m-d H:i:s'),
							'date'=>date('Y-m-d'),
							'create_by'=>$admindetails['a_id']
						);
						//echo '<pre>';print_r($addmedicine);exit;
					$medicine=$this->Resources_model->saving_patient_medicine($addmedicine);
					
					//echo $this->db->last_query();exit;
					if(count($medicine)>0){
						$qty=(($qtys['qty'])-($post['qty']));
						$data=array('qty'=>$qty);
							$this->Resources_model->update_medicine_details($qtys['id'],$data);
						//echo $this->db->last_query();exit;
							$this->session->set_flashdata('success',"Medicine successfully added.");
							redirect($this->agent->referrer());
							//redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']).'#step-2');
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect($this->agent->referrer());
							//redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']).'#step-2');
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
	public function investigation(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;
						$addmedicine=array(
							'p_id'=>isset($post['pid'])?$post['pid']:'',
							'b_id'=>isset($post['bid'])?$post['bid']:'',
							'investigation_type'=>isset($post['investigation_type'])?$post['investigation_type']:'',
							'countrycode'=>isset($post['countrycode'])?$post['countrycode']:'',
							'contact_number'=>isset($post['contact_number'])?$post['contact_number']:'',
							'frequency'=>isset($post['frequency'])?$post['frequency']:'',
							'priority'=>isset($post['priority'])?$post['priority']:'',
							'investigation_formdate'=>isset($post['investigation_formdate'])?$post['investigation_formdate']:'',
							'investigation_todate'=>isset($post['investigation_todate'])?$post['investigation_todate']:'',
							'associate_diagnosis'=>isset($post['associate_diagnosis'])?$post['associate_diagnosis']:'',
							'associate_problems'=>isset($post['associate_problems'])?$post['associate_problems']:'',
							'create_at'=>date('Y-m-d H:i:s'),
							'date'=>date('Y-m-d'),
							'create_by'=>$admindetails['a_id']
						);
					$investigation=$this->Resources_model->saving_patient_investigation($addmedicine);
					if(count($investigation)>0){
							$this->session->set_flashdata('success',"Investigation successfully added.");
							redirect($this->agent->referrer());
							//redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']).'#step-3');
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect($this->agent->referrer());
							//redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']).'#step-2');
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
	public function removemedicine_from_list(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);
					$removedattch=$this->Resources_model->remove_attachment($post['medicine_id']);
					if(count($removedattch) > 0)
					{
						
					$qtys=$this->Resources_model->get_medicine_list_details_with_id($post['org_medicine_id']);
					$qty=(($qtys['qty'])+($post['medicine_qty']));
					$up_data=array('qty'=>$qty);
					$this->Resources_model->update_medicine_details($qtys['id'],$up_data);
					$data['msg']=1;
					echo json_encode($data);exit;	
					}
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}public function removemedicine(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					echo '<pre>';print_r($post);exit;
			
					//$removedattch=$this->Resources_model->remove_attachment($post['medicine_id']);
					//if(count($removedattch) > 0)
					//{
						
					$qtys=$this->Resources_model->get_medicine_list_details_with_id($post['medicine_id']);
					echo $this->db->last_query();
					exit;
					$qty=(($qtys['qty'])+($post['medicine_qty']));
					$data=array('qty'=>$qty);
					$this->Resources_model->update_medicine_details($qtys['id'],$data);

					$data['msg']=1;
					echo json_encode($data);exit;	
					//}
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function removeinvestigation(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;
			
					$removedattch=$this->Resources_model->remove_investigation_attachment($post['investigation_id']);
					if(count($removedattch) > 0)
					{
					$data['msg']=1;
					echo json_encode($data);exit;	
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
	public function investigationsearch(){
		if($this->session->userdata('userdetails'))
		{ 
				if($admindetails['role_id']=6){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$details=$this->Resources_model->get_investigation_basedon_testtypes_list_with_groupby_testtypes($userdetails['hos_id'],$post['searchdata']);
					//echo $this->db->last_query();
					//echo '<pre>';print_r($details);exit;

					if(count($details) > 0)
					{
					$data['msg']=1;
					$data['text']=$details;
					echo json_encode($data);exit;	
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
	public function test_name_testsearch(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=6){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					//$name=$this->Resources_model->get_test_name_details($post['test_type_id']);
					$details=$this->Resources_model->get_test_list_hospital_wise_with_name($post['type'],$post['test_type_id'],$userdetails['hos_id']);
					//echo $this->db->last_query();
					//echo '<pre>';print_r($details);exit;
					if(count($details) > 0)
					{
					$data['msg']=1;
					$data['text']=$details;
					echo json_encode($data);exit;	
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
	public function testsearch(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=6){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$name=$this->Resources_model->get_test_name_details($post['test_type_id']);
					$details=$this->Resources_model->get_test_list_hospital_wise_with_name($name['type'],$post['test_type_id'],$userdetails['hos_id']);
					//echo $this->db->last_query();
					//echo '<pre>';print_r($details);exit;
					if(count($details) > 0)
					{
					$data['msg']=1;
					$data['text']=$details;
					echo json_encode($data);exit;	
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
	public function get_patinent_list(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=6){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$details=$this->Resources_model->get_patient_lab_test_list($post['patinet_id'],$post['patinet_bid']);
					//echo $this->db->last_query();
					//echo '<pre>';print_r($details);exit;
					if(count($details) > 0)
					{
					$data['msg']=1;
					$data['text']=$details;
					echo json_encode($data);exit;	
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
	public function remove_patient_treatment_id(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);exit;
			
					$removedattch=$this->Resources_model->remove_treatment_attachment($post['t_id']);
					//echo $this->db->last_query();exit;
					if(count($removedattch) > 0)
					{
					$testcount=$this->Resources_model->get_patient_test_count($post['patinet_id'],date('Y-m-d'));
					$data['count']=count($testcount);
					$data['msg']=1;
					echo json_encode($data);exit;	
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
	public function selected_test(){
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			$post=$this->input->post();
			
			//echo '<pre>';print_r($post);exit;
			/*$test_list=$this->Resources_model->get_old_test_list($post['patinet_id'],$post['patinet_bid']);
			if(isset($test_list) && count($test_list)>0){
				foreach($test_list as $List){
					$this->Resources_model->delete_billign_previous_data($List['id']);
				}
				
			}*/
			
			foreach($post['ids'] as $lists){
				
				$test_details=$this->Resources_model->get_test_details($lists);
					$test_list=array(
						'p_id'=>isset($post['patinet_id'])?$post['patinet_id']:'',
						'b_id'=>isset($post['patinet_bid'])?$post['patinet_bid']:'',
						'test_id'=>$lists,
						'create_at'=>date('Y-m-d H:i:s'),
						'date'=>date('Y-m-d'),
						'create_by'=>$admindetails['a_id'],
						'out_source'=>$test_details['out_source'],
						'status'=>1
						);
				$check=$this->Resources_model->check_test_already_exist($lists,$post['patinet_id'],$post['patinet_bid'],date('Y-m-d'));
				if(count($check)>0){
					$addtest=array(1);
				}else{
					$addtest=$this->Resources_model->add_addpatient_test($test_list);
				}
				
				}
				$testcount=$this->Resources_model->get_patient_test_count($post['patinet_id'],date('Y-m-d'));

				if(count($addtest) > 0)
				{
				$data['msg']=1;
				$data['count']=count($testcount);
				echo json_encode($data);exit;
				}
				
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function patient_completed(){
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			$post=$this->input->post();
			$complete=array(
			'doctor_status'=>1,
			'completed_type'=>isset($post['type'])?$post['type']:'',
			'assign_doctor_by'=>isset($post['assign_another_doctor'])?$admindetails['a_id']:'',
			'assign_doctor_to'=>isset($post['assign_another_doctor'])?$post['assign_another_doctor']:'',
			'create_by'=>$admindetails['a_id']
			);
			$completed=$this->Resources_model->update_all_billing_compelted_details($post['pid'],$post['billing_id'],$complete);
			if(count($completed)>0){
						$this->session->set_flashdata('success',"Patient successfully completed.");
						redirect('resources/worksheet');
			}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('resources/consultation/'.base64_encode($post['pid']).''/''.base64_encode($post['billing_id']).'#step-3');
			}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function skip_prescription(){
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			$post=$this->input->post();
			$pid=base64_decode($this->uri->segment(3));
			$billing_id=base64_decode($this->uri->segment(4));
			$complete=array(
			'sheet_prescription'=>1,
			);
			$completed=$this->Resources_model->update_all_billing_compelted_details($pid,$billing_id,$complete);
			if(count($completed)>0){
				$this->session->set_flashdata('success',"Patient details successfully updated.");
				redirect('resources/consultation/'.base64_encode($pid).'/'.base64_encode($billing_id).'#step-3');
			}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect('resources/consultation/'.base64_encode($pid).'/'.base64_encode($billing_id).'#step-2');
			}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function patient_report_details()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['patient']=base64_decode($this->uri->segment(3));
					$data['report_list']=$this->Lab_model->get_all_patient_reports_lists($data['patient']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('resource/patient_report_list',$data);
					$this->load->view('html/footer');
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
	public function billcompleted()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					//echo '<pre>';print_r($post);
					$billing=array(
					'patient_payer_deposit_amount'=>isset($post['patient_payer_deposit_amount'])?$post['patient_payer_deposit_amount']:'',
					'payment_mode'=>isset($post['payment_mode'])?$post['payment_mode']:'',
					'bill_amount'=>isset($post['bill_amount'])?$post['bill_amount']:'',
					'coupon_code'=>isset($post['coupon_code1'])?$post['coupon_code1']:'',
					'coupon_code_amount'=>$post['patient_payer_deposit_amount']-$post['bill_amount'],
					'with_out_coupon_code'=>isset($post['bill_amount'])?$post['bill_amount']:'',
					'received_form'=>isset($post['received_form'])?$post['received_form']:'',
					'completed'=>1,
					'updated_at'=>date('Y-m-d H:i:s')
					);
					//echo '<pre>';print_r($billing);exit;
						$update=$this->Resources_model->update_patient_billing_details($post['b_id'],$billing);
						if(count($update)>0){
							/* coupon code hostory*/
							$code_details=array(
								'b_id'=>$post['b_id'],
								'type'=>'Op',
								'type_id'=>1,
								'p_id'=>$post['pid'],
								'amount'=>$post['patient_payer_deposit_amount'],
								'coupon_code'=>$post['coupon_code1'],
								'coupon_code_amount'=>$post['patient_payer_deposit_amount']-$post['bill_amount'],
								'purpose'=>'Op appointment Purpose',
								'created_at'=>date('Y-m-d H:i:s'),
								'created_by'=>$admindetails['a_id'],
								'appointment_user_id'=>$post['appointment_user_id'],
								);
							$this->Wallet_model->save_coupon_code_history($code_details);
							$wallet_detials=$this->Wallet_model->get_wallet_amt_details($post['appointment_user_id']);
							$amt_data=array('remaining_wallet_amount'=>(($wallet_detials['remaining_wallet_amount'])-(($post['patient_payer_deposit_amount'])-($post['bill_amount']))));
							$amount_update=$this->Wallet_model->update_op_wallet_amt_details($post['appointment_user_id'],$amt_data);
							//echo $this->db->last_query();exit;
							/* hiostory*/
							
							$this->session->set_flashdata('success',"Bill details successfully updated.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(12).'/'.base64_encode($post['b_id']));
							
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(12).'/'.base64_encode($post['b_id']));
							
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
	
	/* new op */
	public function opregistration()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=3){
					$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					//echo '<pre>';print_r($post);exit;
					$tab1=array(
					'hos_id'=>isset($userdetails['hos_id'])?$userdetails['hos_id']:'',
					'card_number'=>isset($post['patient_card_number'])?$post['patient_card_number']:'',
					'registrationtype'=>isset($post['registrationtype'])?$post['registrationtype']:'',
					'patient_category'=>isset($post['patient_category'])?$post['patient_category']:'',
					'problem'=>isset($post['problem'])?$post['problem']:'',
					'referred'=>isset($post['referred'])?$post['referred']:'',
					'name'=>isset($post['name'])?strtoupper($post['name']):'',
					'mobile'=>isset($post['mobile'])?$post['mobile']:'',
					'email'=>isset($post['email'])?$post['email']:'',
					'gender'=>isset($post['gender'])?$post['gender']:'',
					'dob'=>isset($post['dob'])?$post['dob']:'',
					'age'=>isset($post['age'])?$post['age']:'',
					'bloodgroup'=>isset($post['bloodgroup'])?$post['bloodgroup']:'',
					'martial_status'=>isset($post['martial_status'])?$post['martial_status']:'',
					'nationali_id'=>isset($post['nationali_id'])?$post['nationali_id']:'',
					'perment_address'=>isset($post['perment_address'])?$post['perment_address']:'',
					'p_c_name'=>isset($post['p_c_name'])?ucfirst($post['p_c_name']):'',
					'p_s_name'=>isset($post['p_s_name'])?$post['p_s_name']:'',
					'p_zipcode'=>isset($post['p_zipcode'])?$post['p_zipcode']:'',
					'p_country_name'=>isset($post['p_country_name'])?ucfirst($post['p_country_name']):'',
					'temp_address'=>isset($post['temp_address'])?$post['temp_address']:'',
					't_c_name'=>isset($post['t_c_name'])?ucfirst($post['t_c_name']):'',
					't_s_name'=>isset($post['t_s_name'])?$post['t_s_name']:'',
					't_zipcode'=>isset($post['t_zipcode'])?$post['t_zipcode']:'',
					't_country_name'=>isset($post['t_country_name'])?ucfirst($post['t_country_name']):'',
					'create_at'=>date('Y-m-d H:i:s'),
					'create_by'=>$userdetails['a_id']
					);
					//echo '<pre>';print_r($tab1);exit;
					
					
					//exit;
					if(isset($post['pid']) && $post['pid']!=''){
						
						$update=$this->Resources_model->update_all_patient_details($post['pid'],$tab1);
						if(count($update)>0){
							$this->session->set_flashdata('success',"Basic Details successfully updated.");
							if(isset($post['op']) && $post['op']==1){
								
									if(isset($post['verifying']) && $post['verifying']=='reschedule'){
										$type='Reschedule';
									}else{
										$type='Repeated';
									}
									$billing=array(
									'p_id'=>isset($post['pid'])?$post['pid']:'',
									'patient_type'=>0,
									'treatment_id'=>$post['department_name'],
									'doct_id'=>$post['department_doctors'],
									'specialist_id'=>isset($post['specialist_doctor_id'])?$post['specialist_doctor_id']:'',	
									'patient_payer_deposit_amount'=>isset($post['patient_payer_deposit_amount'])?$post['patient_payer_deposit_amount']:'0',
									'payment_mode'=>isset($post['payment_mode'])?$post['payment_mode']:'',
									'bill_amount'=>isset($post['bill_amount'])?$post['bill_amount']:'0',
									'received_form'=>isset($post['received_form'])?$post['received_form']:'',
									'create_at'=>date('Y-m-d H:i:s'),
									'type'=>$type,
									'completed'=>1,
									);
									//echo '<pre>';print_r($billing);exit;
									$update=$this->Resources_model->update_all_patient_billing_details($billing);
									//echo $this->db->last_query();exit;
									if(isset($post['verifying']) && $post['verifying']=='reschedule'){
										redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(1).'/'.base64_encode($update));
									}else{
										redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(1).'/'.base64_encode($update));

									}
							}else{
							redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(1));	
							}
							
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							if(isset($post['op']) && $post['op']==1){
								redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(1));
							}else{
								redirect('resources/desk/'.base64_encode($post['pid']).'/'.base64_encode(1));
							
							}
						}
					}else{
							$addtab=$this->Resources_model->save_basic_details($tab1);
							if(count($addtab)>0){
									/* appointment*/
									if(isset($post['appointment_id']) && $post['appointment_id']!=''){
									$this->Resources_model->update_appointment($post['appointment_id'],$addtab);
									}
									/*appointment*/
								$dta=array(
								'pid'=>$addtab,
								'patient_type'=>0,
								'create_at'=>date('Y-m-d H:i:s')
								);
								$this->zend->load('Zend/Barcode');
								$file = Zend_Barcode::draw('code128', 'image', array('text' => $addtab), array());
								$code = time().$addtab.'.png';
								$store_image1 = imagepng($file, $this->config->item('documentroot')."assets/patient_barcode/{$code}");

								$this->Resources_model->update_patient_details($addtab,$code);
								$this->session->set_flashdata('success',"Basic Details successfully added.");
								if(isset($post['op']) && $post['op']==1){
									$billing=array(
									'p_id'=>isset($addtab)?$addtab:'',
									'patient_type'=>0,
									'treatment_id'=>$post['department_name'],
									'doct_id'=>$post['department_doctors'],
									'specialist_id'=>$post['specialist_doctor_id'],	
									'patient_payer_deposit_amount'=>isset($post['patient_payer_deposit_amount'])?$post['patient_payer_deposit_amount']:'',
									'payment_mode'=>isset($post['payment_mode'])?$post['payment_mode']:'',
									'bill_amount'=>isset($post['bill_amount'])?$post['bill_amount']:'',
									'received_form'=>isset($post['received_form'])?$post['received_form']:'',
									'completed'=>1,									
									'create_at'=>date('Y-m-d H:i:s'),
									'type'=>'new'
									);
									//echo '<pre>';print_r($billing);exit;
									$update=$this->Resources_model->update_all_patient_billing_details($billing);
									redirect('resources/desk/'.base64_encode($addtab).'/'.base64_encode(1).'/'.base64_encode($update));
								}else{
								redirect('resources/desk/'.base64_encode($addtab).'/'.base64_encode(1));	
								}
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('resources/desk');
							}
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
	
	public  function save_op_patient_lab_test_names(){
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				$post=$this->input->post();
				$cnt=0;foreach($post['investdation_serach'] as $list){
					if($list!=''){
						$test_details=$this->Resources_model->get_test_details($post['lab_test_name'][$cnt]);
						$add=array(
						'p_id'=>isset($post['pid'])?$post['pid']:'',
						'b_id'=>isset($post['bid'])?$post['bid']:'',
						'test_id'=>$post['lab_test_name'][$cnt],
						'create_at'=>date('Y-m-d H:i:s'),
						'date'=>date('Y-m-d'),
						'create_by'=>$admindetails['a_id'],
						'out_source'=>$test_details['out_source'],
						'status'=>1
						);
						$check=$this->Resources_model->check_test_already_exist($post['lab_test_name'][$cnt],$post['pid'],$post['bid'],date('Y-m-d'));
						if(count($check)>0){
							$addtest=array(1);
						}else{
							$addtest=$this->Resources_model->add_addpatient_test($add);
						}
						//echo '<pre>';print_r($add);
						
					}
					
				$cnt++;}
				if(count($addtest)>0){
						$update=array('completed_type'=>2,'doctor_status'=>1);
						$this->Resources_model->update_patient_medicine_details($post['pid'],$post['bid'],$update);
					$this->session->set_flashdata('success',"Tests successfully added.");
					redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']).'#step-3');
					
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('resources/consultation/'.base64_encode($post['pid']).'/'.base64_encode($post['bid']).'#step-3');
					
				}
				echo '<pre>';print_r($post);exit;
		}else{
				$this->session->set_flashdata('error','Please login to continue');
			    redirect('admin');
		}
	}
	public function patient_details_print()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$patient_id=base64_decode($this->uri->segment(3));
					if($patient_id==''){
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
					}
					$data['patient_id']=isset($patient_id)?$patient_id:'';
					$data['billing_id']=base64_decode($this->uri->segment(4));
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['patient_details']=$this->Resources_model->get_patient_details($patient_id);
					$data['patient_medicine_list']=$this->Resources_model->get_patient_medicine_details_list($patient_id,$data['billing_id']);
					$data['patient_investigation_list']=$this->Resources_model->get_patient_lab_test_list($patient_id,$data['billing_id']);
					$data['patient_vitals_list']=$this->Resources_model->get_patient_vitals_list($patient_id,$data['billing_id']);
					//echo $this->db->last_query();
					//echo '<pre>';print_r($data);exit;
					$path = rtrim(FCPATH,"/");
					$file_name = $data['patient_id'].'_'.$data['billing_id'].time().'.pdf';                
					$data['page_title'] = $data['patient_details']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/complete_patient_details/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('resource/complete_patient_details', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("/assets/complete_patient_details/".$file_name);
					
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
