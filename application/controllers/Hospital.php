<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Hospital extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
				$this->load->model('Hospital_model');

		}
	public function index()
	{	
		
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$hospital_list= $this->Hospital_model->get_hospital_list_details();
					if(count($hospital_list)>0){
					foreach($hospital_list as $list){
						$patient_list=$this->Hospital_model->get_total_patient_list($list['hos_id']);
						$op_patient_list=$this->Hospital_model->get_op_total_patient_list($list['hos_id']);
						$ip_patient_list=$this->Hospital_model->get_ip_total_patient_list($list['hos_id']);
						$appointment_patient_list=$this->Hospital_model->get_appointment_total_patient_list($list['hos_id']);
						$hos_dat[$list['hos_id']]=$list;
						$hos_dat[$list['hos_id']]['patient_list']=count($patient_list);
						$hos_dat[$list['hos_id']]['op_patient_list']=count($op_patient_list);
						$hos_dat[$list['hos_id']]['ip_patient_list']=count($ip_patient_list);
						$hos_dat[$list['hos_id']]['appoint_patient_list']=count($appointment_patient_list);
						//echo '<pre>';print_r($list);exit;
					}
					$data['hospital_list']=$hos_dat;
					}else{
						$data['hospital_list']=array();
					}
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('admin/hospital_list',$data);
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
	public function add()
	{
		if($this->session->userdata('userdetails'))
		{
				$data['tab']=base64_decode($this->uri->segment(3));
				$data['hospital_id']=$this->uri->segment(4);
				if(isset($data['hospital_id']) && $data['hospital_id']!=''){
					$data['hospital_details']= $this->Hospital_model->get_hospital_details(base64_decode($this->uri->segment(4)));
				}else{
					$data['hospital_details']=array();
				}
				//echo '<pre>';print_r($data);exit;
				$this->load->view('admin/addhospital',$data);
				$this->load->view('html/footer');
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function addpostone()
	{
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					$post=$this->input->post();

					//echo '<pre>';print_r($post);exit;
					if(isset($post['hospital_id']) && $post['hospital_id']!=''){
						$hospital_details= $this->Hospital_model->get_hospital_details(base64_decode($post['hospital_id']));
						if($hospital_details['hos_email_id']==$post['hos_email_id']){
								$onedata=array(
										'hos_con_number'=>$post['hos_con_number'],
										'hos_email_id'=>$post['hos_email_id'],
										'hos_updated_at'=>date('Y-m-d H:i:s')
										);
								$onedata1=array(
										'a_mobile'=>$post['hos_con_number'],
										'a_email_id'=>$post['hos_email_id'],
										'a_updated_at'=>date('Y-m-d H:i:s')
										);
								$this->Hospital_model->update_adminhospital_details($hospital_details['a_id'],$onedata1);
								$stepone= $this->Hospital_model->update_hospital_details(base64_decode($post['hospital_id']),$onedata);
								if(count($stepone)>0){
									$this->session->set_flashdata('success',"Hospital Representative Details are successfully updated");
									redirect('hospital/add/'.base64_encode(2).'/'.$post['hospital_id']);
								}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital/add/'.base64_encode(1).'/'.$post['hospital_id']);
								}
						}else{
							
								$emailcheck= $this->Hospital_model->check_email_exits($post['hos_email_id']);
								if(count($emailcheck)>0){
									$this->session->set_flashdata('error','Email Id already exists. Please use another Email Id');
									redirect('hospital/add/'.base64_encode(1).'/'.$post['hospital_id']);
								}else{
									$hospital_id= $this->Hospital_model->get_hospital_details(base64_decode($post['hospital_id']));
									$onedata=array(
									'hos_con_number'=>$post['hos_con_number'],
									'hos_email_id'=>$post['hos_email_id'],
									'hos_updated_at'=>date('Y-m-d H:i:s')
									);
									$onedata1=array(
										'a_mobile'=>$post['hos_con_number'],
										'a_email_id'=>$post['hos_email_id'],
										'a_updated_at'=>date('Y-m-d H:i:s')
										);
									$this->Hospital_model->update_adminhospital_details($hospital_id['a_id'],$onedata1);
									$stepone= $this->Hospital_model->update_hospital_details(base64_decode($post['hospital_id']),$onedata);
									if(count($stepone)>0){
									$this->session->set_flashdata('success',"Hospital Representative Details are successfully updated");
									redirect('hospital/add/'.base64_encode(2).'/'.$post['hospital_id']);
									}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital/add/'.base64_encode(1).'/'.$post['hospital_id']);
									}
								}
							
						}

						
					}else{
							if(md5($post['hos_password'])==md5($post['hos_confirmpassword'])){
								$emailcheck= $this->Hospital_model->check_email_exits($post['hos_email_id']);
								if(count($emailcheck)>0){
									$this->session->set_flashdata('error','Email Id already exists. Please use another Email Id');
									redirect('hospital/add/'.base64_encode(1));
								}else{
									
									
									$admindetails=array(
									'role_id'=>2,
									'a_name'=>'Hospital Admin',
									'a_email_id'=>$post['hos_email_id'],
									'a_password'=>md5($post['hos_confirmpassword']),
									'a_org_password'=>$post['hos_confirmpassword'],
									'a_mobile'=>$post['hos_con_number'],
									'a_status'=>1,
									'a_create_at'=>date('Y-m-d H:i:s')
									);
									$addhospitaladmin= $this->Admin_model->save_admin($admindetails);
										/* barcode*/
										$this->zend->load('Zend/Barcode');
										$file = Zend_Barcode::draw('code128', 'image', array('text' => $addhospitaladmin), array());
										$code = time().$addhospitaladmin;
										$store_image1 = imagepng($file, $this->config->item('documentroot')."assets/hospital_barcodes/{$code}.png");

										/* barcode*/
									
									
									$onedata=array(
									'a_id'=>$addhospitaladmin,
									'hos_con_number'=>$post['hos_con_number'],
									'hos_email_id'=>$post['hos_email_id'],
									'barcode'=>$code.'.png',
									'hos_status'=>1,
									'hos_created'=>date('Y-m-d H:i:s'),
									'hos_updated_at'=>date('Y-m-d H:i:s')
									);
									//echo '<pre>';print_r($onedata);exit;
									$stepone= $this->Hospital_model->save_hospital_step_one($onedata);
									if(count($stepone)>0){
										$this->session->set_flashdata('success',"Hospital Credentials are successfully created");
										redirect('hospital/add/'.base64_encode(2).'/'.base64_encode($stepone));
									}else{
										$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
										redirect('hospital/add/'.base64_encode(1));
									}
								}
								
							}else{
								$this->session->set_flashdata('error',"password and  Confirmpassword are not matched");
								redirect('hospital/add/'.base64_encode(1));
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
	public function addposttwo()
	{
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$twodata=array(
							'hos_representative'=>strtoupper($post['hos_representative']),
							'hos_rep_contact'=>$post['hos_rep_contact'],
							'mob_country_code'=>$post['mob_country_code'],
							'hos_rep_mobile'=>$post['hos_rep_mobile'],
							'hos_rep_email'=>$post['hos_rep_email'],
							'hos_rep_nationali_id'=>$post['hos_rep_nationali_id'],
							'hos_rep_add1'=>$post['hos_rep_add1'],
							'hos_rep_add2'=>$post['hos_rep_add2'],
							'hos_rep_zipcode'=>$post['hos_rep_zipcode'],
							'hos_rep_city'=>ucfirst($post['hos_rep_city']),
							'hos_rep_state'=>$post['hos_rep_state'],
							'hos_rep_country'=>ucfirst($post['hos_rep_country']),
							'hos_updated_at'=>date('Y-m-d H:i:s')
							);
							$steptwo= $this->Hospital_model->update_hospital_details(base64_decode($post['hospital_id']),$twodata);
							if(count($steptwo)>0){
								$this->session->set_flashdata('success',"Hospital Credentials are successfully updated");
								redirect('hospital/add/'.base64_encode(3).'/'.$post['hospital_id']);
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('hospital/add/'.base64_encode(2).'/'.$post['hospital_id']);
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
	public function addpostthree()
	{
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					$post=$this->input->post();
						if(isset($_FILES['hos_bas_document']['name']) && $_FILES['hos_bas_document']['name']!=''){
							$hospital_details= $this->Hospital_model->get_hospital_details(base64_decode($post['hospital_id']));
							unlink("assets/hospital_basic_documents/".$hospital_details['hos_bas_document']);
							$temp = explode(".", $_FILES["hos_bas_document"]["name"]);
							$hos_bas_document = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['hos_bas_document']['tmp_name'], "assets/hospital_basic_documents/" . $hos_bas_document);
						}else{
							$hos_bas_document='';
						}
					$threedata=array(
							'hos_bas_name'=>strtoupper($post['hos_bas_name']),
							'hos_bas_contact'=>$post['hos_bas_contact'],
							'hos_bas_email'=>$post['hos_bas_email'],
							'hos_bas_nationali_id'=>$post['hos_bas_nationali_id'],
							'hos_bas_add1'=>$post['hos_bas_add1'],
							'hos_bas_add2'=>$post['hos_bas_add2'],
							'hos_bas_zipcode'=>$post['hos_bas_zipcode'],
							'hos_bas_city'=>ucfirst($post['hos_bas_city']),
							'hos_bas_state'=>$post['hos_bas_state'],
							'hos_bas_country'=>ucfirst($post['hos_bas_country']),
							'hos_bas_document'=>$hos_bas_document,
							'hos_updated_at'=>date('Y-m-d H:i:s')
							);
							$stepthree= $this->Hospital_model->update_hospital_details(base64_decode($post['hospital_id']),$threedata);
							if(count($stepthree)>0){
								$this->session->set_flashdata('success',"Hospital Basic Details are successfully updated");
								redirect('hospital/add/'.base64_encode(4).'/'.$post['hospital_id']);
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('hospital/add/'.base64_encode(3).'/'.$post['hospital_id']);
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
	public function addpostfour()
	{
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					$post=$this->input->post();
					//echo '<pre>';print_r($_FILES);exit;
						if(isset($_FILES['bank_documents']['name']) && $_FILES['bank_documents']['name']!=''){
							$hospital_details= $this->Hospital_model->get_hospital_details(base64_decode($post['hospital_id']));
							unlink("assets/bank_documents/".$hospital_details['bank_document']);
							$temp = explode(".", $_FILES["bank_documents"]["name"]);
							$bank_document = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['bank_documents']['tmp_name'], "assets/bank_documents/" . $bank_document);
						}else{
							$bank_document='';
						}
					$fourdata=array(
							'bank_holder_name'=>$post['bank_holder_name'],
							'bank_acc_no'=>$post['bank_acc_no'],
							'bank_name'=>$post['bank_name'],
							'bank_ifsc'=>$post['bank_ifsc'],
							'bank_document'=>$bank_document,
							'hos_updated_at'=>date('Y-m-d H:i:s')
							);
							$stepfour= $this->Hospital_model->update_hospital_details(base64_decode($post['hospital_id']),$fourdata);
							if(count($stepfour)>0){
								$this->session->set_flashdata('success',"Hospital Financial Details are successfully updated");
								redirect('hospital/add/'.base64_encode(5).'/'.$post['hospital_id']);
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('hospital/add/'.base64_encode(4).'/'.$post['hospital_id']);
							}
				}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}public function addpostfive()
	{
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					$post=$this->input->post();
					//echo '<pre>';print_r($_FILES);exit;
						$hospital_details= $this->Hospital_model->get_hospital_details(base64_decode($post['hospital_id']));

						if(isset($_FILES['kyc_file1']['name']) && $_FILES['kyc_file1']['name']!=''){
							unlink("assets/kyc_documents/".$hospital_details['kyc_file1']);
							$temp = explode(".", $_FILES["kyc_file1"]["name"]);
							$file1 = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['kyc_file1']['tmp_name'], "assets/kyc_documents/" . $file1);
						}else{
							$file1='';
						}
						if(isset($_FILES['kyc_file2']['name']) && $_FILES['kyc_file2']['name']!=''){
							unlink("assets/kyc_documents/".$hospital_details['kyc_file2']);
							$temp = explode(".", $_FILES["kyc_file2"]["name"]);
							$file2 =base64_decode($post['hospital_id']).round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['kyc_file2']['tmp_name'], "assets/kyc_documents/" . $file2);
						}else{
							$file2='';
						}
						if(isset($_FILES['kyc_file3']['name']) && $_FILES['kyc_file3']['name']!=''){
							unlink("assets/kyc_documents/".$hospital_details['kyc_file3']);
							$temp = explode(".", $_FILES["kyc_file3"]["name"]);
							$file3 =base64_decode($post['hospital_id']).'1'.round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['kyc_file3']['tmp_name'], "assets/kyc_documents/" . $file3);
						}else{
							$file3='';
						}
					$fivedata=array(
							'kyc_doc1'=>isset($post['kyc_doc1'])?$post['kyc_doc1']:'',
							'kyc_doc2'=>isset($post['kyc_doc2'])?$post['kyc_doc2']:'',
							'kyc_doc3'=>isset($post['kyc_doc3'])?$post['kyc_doc3']:'',
							'kyc_file1'=>$file1,
							'kyc_file2'=>$file2,
							'kyc_file3'=>$file3,
							'hos_updated_at'=>date('Y-m-d H:i:s')
							);
							$stepfive= $this->Hospital_model->update_hospital_details(base64_decode($post['hospital_id']),$fivedata);
							if(count($stepfive)>0){
								$this->session->set_flashdata('success',"Hospital Details are successfully saved");
								redirect('hospital');
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('hospital/add/'.base64_encode(5).'/'.$post['hospital_id']);
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
	public function edit()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']==1 || $admindetails['role_id']==2){
					$data['tab']=base64_decode($this->uri->segment(4));
					$data['hospital_id']=$this->uri->segment(3);
					$hospital_id=base64_decode($this->uri->segment(3));
					$data['hospital_details']= $this->Hospital_model->get_hospital_details($hospital_id);
					//echo '<pre>';print_r($data['hospital_details']);exit;
					$admindetails=$this->session->userdata('userdetails');
					$data['userdetails']=$this->Admin_model->get_all_admin_details($admindetails['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('admin/edithospital',$data);
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
	public function view()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=1){
					$data['tab']=base64_decode($this->uri->segment(4));
					$data['hospital_id']=$this->uri->segment(3);
					$hospital_id=base64_decode($this->uri->segment(3));
					$data['hospital_details']= $this->Hospital_model->get_hospital_details($hospital_id);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('admin/hospitalview',$data);
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
	public function editpost(){
		if($this->session->userdata('userdetails'))
		{		$admindetails=$this->session->userdata('userdetails');
				if($admindetails['role_id']==1 || $admindetails['role_id']==2){
					$post=$this->input->post();
					
					//echo '<pre>';print_r($post);
						$hospital_details= $this->Hospital_model->get_hospital_details(base64_decode($post['hospital_id']));
						if($hospital_details['hos_email_id']!= $post['hos_email_id']){
							$emailcheck= $this->Hospital_model->check_email_exits($post['hos_email_id']);
								if(count($emailcheck)>0){
									$this->session->set_flashdata('error','Email Id already exists. Please use another Email Id');
									redirect('hospital/edit/'.$post['hospital_id']);
								}
						}
						if(isset($_FILES['hos_bas_logo']['name']) && $_FILES['hos_bas_logo']['name']!=''){
							//unlink("assets/hospital_logos/".$hospital_details['hos_bas_logo']);
							$temp = explode(".", $_FILES["hos_bas_logo"]["name"]);
							$hos_bas_logo = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['hos_bas_logo']['tmp_name'], "assets/hospital_logos/" . $hos_bas_logo);
						}else{
							$hos_bas_logo=$hospital_details['hos_bas_logo'];
						}
						if(isset($_FILES['hos_bas_logo']['name']) && $_FILES['hos_bas_logo']['name']!=''){
							//unlink("assets/adminprofilepic/".$hospital_details['hos_bas_logo']);
							$temp = explode(".", $_FILES["hos_bas_logo"]["name"]);
							$hos_bas_logo = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['hos_bas_logo']['tmp_name'], "assets/adminprofilepic/" . $hos_bas_logo);
						}else{
							$hos_bas_logo=$hospital_details['hos_bas_logo'];
						}
						if(isset($_FILES['hos_bas_document']['name']) && $_FILES['hos_bas_document']['name']!=''){
							$hospital_details= $this->Hospital_model->get_hospital_details(base64_decode($post['hospital_id']));
							unlink("assets/hospital_basic_documents/".$hospital_details['hos_bas_document']);
							$temp = explode(".", $_FILES["hos_bas_document"]["name"]);
							$hos_bas_document = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['hos_bas_document']['tmp_name'], "assets/hospital_basic_documents/" . $hos_bas_document);
						}else{
							$hos_bas_document=$hospital_details['hos_bas_document'];
						}
						if(isset($_FILES['bank_documents']['name']) && $_FILES['bank_documents']['name']!=''){
							$hospital_details= $this->Hospital_model->get_hospital_details(base64_decode($post['hospital_id']));
							unlink("assets/bank_documents/".$hospital_details['bank_document']);
							$temp = explode(".", $_FILES["bank_documents"]["name"]);
							$bank_document = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['bank_documents']['tmp_name'], "assets/bank_documents/" . $bank_document);
						}else{
							$bank_document=$hospital_details['bank_document'];
						}
						if(isset($_FILES['kyc_file1']['name']) && $_FILES['kyc_file1']['name']!=''){
							unlink("assets/kyc_documents/".$hospital_details['kyc_file1']);
							$temp = explode(".", $_FILES["kyc_file1"]["name"]);
							$file1 = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['kyc_file1']['tmp_name'], "assets/kyc_documents/" . $file1);
						}else{
							$file1=$hospital_details['kyc_file1'];
						}
						if(isset($_FILES['kyc_file2']['name']) && $_FILES['kyc_file2']['name']!=''){
							unlink("assets/kyc_documents/".$hospital_details['kyc_file2']);
							$temp = explode(".", $_FILES["kyc_file2"]["name"]);
							$file2 =base64_decode($post['hospital_id']).round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['kyc_file2']['tmp_name'], "assets/kyc_documents/" . $file2);
						}else{
							$file2=$hospital_details['kyc_file2'];
						}
						if(isset($_FILES['kyc_file3']['name']) && $_FILES['kyc_file3']['name']!=''){
							unlink("assets/kyc_documents/".$hospital_details['kyc_file3']);
							$temp = explode(".", $_FILES["kyc_file3"]["name"]);
							$file3 =base64_decode($post['hospital_id']).'1'.round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['kyc_file3']['tmp_name'], "assets/kyc_documents/" . $file3);
						}else{
							$file3=$hospital_details['kyc_file3'];
						}
						
						
						//echo '<pre>';print_r($post);
						$onedata1=array(
							'a_name'=>isset($post['hos_bas_name'])?$post['hos_bas_name']:$hospital_details['hos_bas_name'],
							'a_mobile'=>isset($post['hos_bas_contact'])?$post['hos_bas_contact']:$hospital_details['hos_bas_contact'],
							'a_updated_at'=>date('Y-m-d H:i:s')
							);
							$this->Hospital_model->update_adminhospital_details($hospital_details['a_id'],$onedata1);
						$editdata=array(
							'reschedule_date'=>isset($post['reschedule_date'])?$post['reschedule_date']:$hospital_details['reschedule_date'],
							'hos_con_number'=>isset($post['hos_con_number'])?$post['hos_con_number']:$hospital_details['hos_con_number'],
							'hos_email_id'=>isset($post['hos_email_id'])?$post['hos_email_id']:$hospital_details['hos_email_id'],
							'hos_representative'=>isset($post['hos_representative'])?$post['hos_representative']:$hospital_details['hos_representative'],
							'hos_rep_contact'=>isset($post['hos_rep_contact'])?$post['hos_rep_contact']:$hospital_details['hos_rep_contact'],
							'mob_country_code'=>isset($post['mob_country_code'])?$post['mob_country_code']:$hospital_details['mob_country_code'],
							'hos_rep_mobile'=>isset($post['hos_rep_mobile'])?$post['hos_rep_mobile']:$hospital_details['hos_rep_mobile'],
							'hos_rep_email'=>isset($post['hos_rep_email'])?$post['hos_rep_email']:$hospital_details['hos_rep_email'],
							'hos_rep_nationali_id'=>isset($post['hos_rep_nationali_id'])?$post['hos_rep_nationali_id']:$hospital_details['hos_rep_nationali_id'],
							'hos_rep_add1'=>isset($post['hos_rep_add1'])?$post['hos_rep_add1']:$hospital_details['hos_rep_add1'],
							'hos_rep_add2'=>isset($post['hos_rep_add2'])?$post['hos_rep_add2']:$hospital_details['hos_rep_add2'],
							'hos_rep_zipcode'=>isset($post['hos_rep_zipcode'])?$post['hos_rep_zipcode']:$hospital_details['hos_rep_zipcode'],
							'hos_rep_city'=>isset($post['hos_rep_city'])?$post['hos_rep_city']:$hospital_details['hos_rep_city'],
							'hos_rep_state'=>isset($post['hos_rep_state'])?$post['hos_rep_state']:$hospital_details['hos_rep_state'],
							'hos_rep_country'=>isset($post['hos_rep_country'])?$post['hos_rep_country']:$hospital_details['hos_rep_country'],
							'hos_bas_name'=>isset($post['hos_bas_name'])?$post['hos_bas_name']:$hospital_details['hos_bas_name'],
							'hos_bas_contact'=>isset($post['hos_bas_contact'])?$post['hos_bas_contact']:$hospital_details['hos_bas_contact'],
							'hos_bas_email'=>isset($post['hos_bas_email'])?$post['hos_bas_email']:$hospital_details['hos_bas_email'],
							'hos_bas_nationali_id'=>isset($post['hos_bas_nationali_id'])?$post['hos_bas_nationali_id']:$hospital_details['hos_bas_nationali_id'],
							'hos_bas_add1'=>isset($post['hos_bas_add1'])?$post['hos_bas_add1']:$hospital_details['hos_bas_add1'],
							'hos_bas_add2'=>isset($post['hos_bas_add2'])?$post['hos_bas_add2']:$hospital_details['hos_bas_add2'],
							'hos_bas_zipcode'=>isset($post['hos_bas_zipcode'])?$post['hos_bas_zipcode']:$hospital_details['hos_bas_zipcode'],
							'hos_bas_city'=>isset($post['hos_bas_city'])?$post['hos_bas_city']:$hospital_details['hos_bas_city'],
							'hos_bas_state'=>isset($post['hos_bas_state'])?$post['hos_bas_state']:$hospital_details['hos_bas_state'],
							'hos_bas_country'=>isset($post['hos_bas_country'])?$post['hos_bas_country']:$hospital_details['hos_bas_country'],
							'hos_bas_document'=>$hos_bas_document,
							'hos_bas_logo'=>$hos_bas_logo,
							'appointment_fee'=>isset($post['appointment_fee'])?$post['appointment_fee']:$hospital_details['appointment_fee'],
							'bank_holder_name'=>isset($post['bank_holder_name'])?$post['bank_holder_name']:$hospital_details['bank_holder_name'],
							'bank_acc_no'=>isset($post['bank_acc_no'])?$post['bank_acc_no']:$hospital_details['bank_acc_no'],
							'bank_name'=>isset($post['bank_name'])?$post['bank_name']:$hospital_details['bank_name'],
							'bank_ifsc'=>isset($post['bank_ifsc'])?$post['bank_ifsc']:$hospital_details['bank_ifsc'],
							'bank_document'=>$bank_document,
							'kyc_doc1'=>isset($post['kyc_doc1'])?$post['kyc_doc1']:$hospital_details['kyc_doc1'],
							'kyc_doc2'=>isset($post['kyc_doc2'])?$post['kyc_doc2']:$hospital_details['kyc_doc2'],
							'kyc_doc3'=>isset($post['kyc_doc3'])?$post['kyc_doc3']:$hospital_details['kyc_doc3'],
							'kyc_file1'=>$file1,
							'kyc_file2'=>$file2,
							'kyc_file3'=>$file3,
							'hos_updated_at'=>date('Y-m-d H:i:s')
							);
							//echo '<pre>';print_r($editdata);exit;
							$editdetails= $this->Hospital_model->update_hospital_details(base64_decode($post['hospital_id']),$editdata);
							if(count($editdetails)>0){
								$email_details=array(
								'a_email_id'=>isset($post['hos_email_id'])?$post['hos_email_id']:$hospital_details['hos_bas_name'],
								'a_updated_at'=>date('Y-m-d H:i:s')
								);
							$this->Hospital_model->update_adminhospital_details($hospital_details['a_id'],$email_details);
							//echo $this->db->last_query();exit;
									$this->session->set_flashdata('success',"Hospital Details are successfully saved");
									if($post['tab_id']==2){
										$this->session->set_flashdata('success',"Hospital Credentials Details are successfully updated");
										redirect('hospital/edit/'.$post['hospital_id'].'/'.base64_encode($post['tab_id']));
									}elseif($post['tab_id']==3){
										$this->session->set_flashdata('success',"Hospital Credentials are successfully updated");
										redirect('hospital/edit/'.$post['hospital_id'].'/'.base64_encode($post['tab_id']));
									}else if($post['tab_id']==4){
										$this->session->set_flashdata('success',"Hospital Basic Details are successfully updated");
										redirect('hospital/edit/'.$post['hospital_id'].'/'.base64_encode($post['tab_id']));
									}else if($post['tab_id']==5){
										$this->session->set_flashdata('success'," Hospital Financial Details  are successfully updated");
											redirect('hospital/edit/'.$post['hospital_id'].'/'.base64_encode($post['tab_id']));	
									}else if($post['tab_id']==6){
										$this->session->set_flashdata('success'," Hospital Other Details are successfully updated");
											if($admindetails['role_id']==2){
												redirect('profile');
											}else {
												redirect('hospital');
											}
									}
							
								
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('hospital/add/'.base64_encode($post['backtab_id']).'/'.$post['hospital_id']);
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
	public function deletes()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=1){
					$hospital_id=$this->uri->segment(3);
					
					if($hospital_id!=''){
						$deletdata=array(
							'hos_undo'=>1,
							'hos_updated_at'=>date('Y-m-d H:i:s')
							);
							$deletedata= $this->Hospital_model->update_hospital_details(base64_decode($hospital_id),$deletdata);
							if(count($deletedata)>0){
								$hos_details=$this->Hospital_model->get_hospital_id_details(base64_decode($hospital_id));
								$admin_stusdetails=array(
								'a_status'=>2,
								'a_updated_at'=>date('Y-m-d H:i:s')
								);
								$this->Hospital_model->update_admin_detais($hos_details['a_id'],$admin_stusdetails);
								$resources_list=$this->Hospital_model->get_hos_resources_list(base64_decode($hospital_id));
								if(isset($resources_list) &&count($resources_list)>0){
									foreach($resources_list as $lis){
										$da=array('r_status'=>2);
										$a_da=array('a_status'=>2);
										$this->Hospital_model->resouces_status_update($lis['r_id'],$da);
										$this->Hospital_model->resouces_login_status_update($lis['a_id'],$a_da);
									}
								}
								
								$this->session->set_flashdata('success',"Hospital successfully removed.");
								redirect('hospital');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital');
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital');
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
	public function status()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			//echo '<pre>';print_r($admindetails);exit;
			if($admindetails['role_id']=1){
					$hospital_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($hospital_id!=''){
						$stusdetails=array(
							'hos_status'=>$statu,
							'hos_updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Hospital_model->update_hospital_details(base64_decode($hospital_id),$stusdetails);
							if(count($statusdata)>0){
								$hos_details=$this->Hospital_model->get_hospital_id_details(base64_decode($hospital_id));
								$admin_stusdetails=array(
								'a_status'=>$statu,
								'a_updated_at'=>date('Y-m-d H:i:s')
								);
								$this->Hospital_model->update_admin_detais($hos_details['a_id'],$admin_stusdetails);
								
								
								/* resouces list*/
								$resources_list=$this->Hospital_model->get_hos_resources_list(base64_decode($hospital_id));
								//echo $this->db->last_query();exit;
								//echo '<pre>';print_r($resources_list);exit;
								if(isset($resources_list) &&count($resources_list)>0){
									foreach($resources_list as $lis){
										$da=array('r_status'=>$statu);
										$a_da=array('a_status'=>$statu);
										$this->Hospital_model->resouces_status_update($lis['r_id'],$da);
										//echo $this->db->last_query();exit;
										$this->Hospital_model->resouces_login_status_update($lis['a_id'],$a_da);
									}
								}
								/* resouces list*/
								//echo $this->db->last_query();exit;
								if($status==1){
								$this->session->set_flashdata('success',"Hospital successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Hospital successfully activated.");
								}
								redirect('hospital');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital');
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital');
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
	
	public function resource()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
					$data['tab']=base64_decode($this->uri->segment(3));
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					//echo '<pre>';print_r($hos_ids);exit;
					$data['resource_list']=$this->Hospital_model->get_resources_list($hos_ids['a_id'],$hos_ids['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('hospital/resource',$data);
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
	public function adddoctor()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
					$data['tab']=base64_decode($this->uri->segment(3));
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$data['resource_list']=$this->Hospital_model->get_doctor_resources_list($hos_ids['a_id'],$hos_ids['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('hospital/add_doctor',$data);
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
	public function resourcepost()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					if(md5($post['resource_password'])==md5($post['resource_cinformpaswword'])){
								$emailcheck= $this->Hospital_model->check_email_exits($post['resource_email']);
								if(count($emailcheck)>0){
									$this->session->set_flashdata('error','Email Id already exists. Please use another Email Id');
									if($post['designation']==6){
										redirect('hospital/adddoctor');
									}else{
										redirect('hospital/resource');
									}
									
								}else{
									if(isset($_FILES['resource_photo']['name']) && $_FILES['resource_photo']['name']!=''){
									$temp = explode(".", $_FILES["resource_photo"]["name"]);
									$photo =round(microtime(true)) . '.' . end($temp);
									move_uploaded_file($_FILES['resource_photo']['tmp_name'], "assets/adminprofilepic/" . $photo);
									}else{
									$photo='';
									}if(isset($_FILES['resource_document']['name']) && $_FILES['resource_document']['name']!=''){
									$temp = explode(".", $_FILES["resource_document"]["name"]);
									$resource_document ='1'.round(microtime(true)) . '.' . end($temp);
									move_uploaded_file($_FILES['resource_document']['tmp_name'], "assets/resourse_doc/" . $resource_document);
									}else{
									$resource_document='';
									}if(isset($_FILES['resource_other_document']['name']) && $_FILES['resource_other_document']['name']!=''){
									$temp = explode(".", $_FILES["resource_document"]["name"]);
									$resource_other_document =round(microtime(true)) . '.' . end($temp);
									move_uploaded_file($_FILES['resource_other_document']['tmp_name'], "assets/resourse_doc/" . $resource_other_document);
									}else{
									$resource_other_document='';
									}
									$admindetails=$this->session->userdata('userdetails');
									$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
									//echo '<pre>';print_r($statusdata);exit;
									$admindetails=array(
									'role_id'=>$post['designation'],
									'a_name'=>strtoupper($post['resource_name']),
									'a_email_id'=>$post['resource_email'],
									'a_password'=>md5($post['resource_cinformpaswword']),
									'a_org_password'=>$post['resource_cinformpaswword'],
									'a_mobile'=>$post['resource_mobile'],
									'a_status'=>1,
									'a_create_at'=>date('Y-m-d H:i:s')
									);
									$addresourcedmin = $this->Admin_model->save_admin($admindetails);
									$resourcedata=array(
									'a_id'=>$addresourcedmin,
									'role_id'=>$post['designation'],
									'hos_id'=>$hos_ids['hos_id'],
									'resource_name'=>strtoupper($post['resource_name']),
									'resource_mobile'=>$post['resource_mobile'],
									'resource_add1'=>$post['resource_add1'],
									'resource_add2'=>$post['resource_add2'],
									'resource_city'=>ucfirst($post['resource_city']),
									'resource_state'=>$post['resource_state'],
									'resource_zipcode'=>$post['resource_zipcode'],
									'resource_other_details'=>$post['resource_other_details'],
									'resource_contatnumber'=>$post['resource_contatnumber'],
									'resource_email'=>$post['resource_email'],
									'in_time'=>$post['in_time'],
									'out_time'=>$post['out_time'],
									'resource_photo'=>$photo,
									'resource_document'=>$resource_document,
									'resource_bank_holdername'=>$post['resource_bank_holdername'],
									'resource_bank_accno'=>$post['resource_bank_accno'],
									'resource_ifsc_code'=>$post['resource_ifsc_code'],
									'resource_other_document'=>$resource_other_document,
									'consultation_fee'=>$post['consultation_fee'],
									'r_status'=>1,
									'r_create_by'=>$hos_ids['a_id'],
									'r_created_at'=>date('Y-m-d H:i:s')
									);
									//echo '<pre>';print_r($resourcedata);exit;
									$saveresource =$this->Hospital_model->save_resource($resourcedata);
									if(count($saveresource)>0){
										$this->session->set_flashdata('success',"Resource  successfully created");
										if($post['designation']==6){
											redirect('hospital/adddoctor/'.base64_encode(1));
										}else{
											redirect('hospital/resource/'.base64_encode(1));
										}
										
									}else{
										$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
										if($post['designation']==6){
											redirect('hospital/adddoctor');
										}else{
											redirect('hospital/resource');
										}
										
									}
								}
								
							}else{
								$this->session->set_flashdata('error',"password and  Confirmpassword are not matched");
								redirect('hospital/resource');
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
	public function resourcestatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=1){
					$resourse_id=$this->uri->segment(3);
					$resouse_detail= $this->Hospital_model->get_resourse_details(base64_decode($resourse_id));

					$status=base64_decode($this->uri->segment(4));
					$a_id=$this->uri->segment(5);
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($resourse_id!=''){
						$stusdetails=array(
							'r_status'=>$statu,
							'r_updated_at'=>date('Y-m-d H:i:s')
							);
							$admin_stusdetails=array(
							'a_status'=>$statu,
							'a_updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Hospital_model->update_resourse_details(base64_decode($resourse_id),$stusdetails);
							$this->Admin_model->update_resourse_details(base64_decode($a_id),$admin_stusdetails);
							
							//echo $this->db->last_query();exit;
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Resource successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Resource successfully activated.");
								}
								if($resouse_detail['role_id']==6){
									redirect('hospital/adddoctor/'.base64_encode(1));
								}else{
									redirect('hospital/resource/'.base64_encode(1));
								}
								
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									if($resouse_detail['role_id']==6){
										redirect('hospital/adddoctor/'.base64_encode(1));
									}else{
										redirect('hospital/resource/'.base64_encode(1));
									}
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/resource/'.base64_encode(1));
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
	public function resourcedelete()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=1){
					$resourse_id=$this->uri->segment(3);
					$resouse_detail= $this->Hospital_model->get_resourse_details(base64_decode($resourse_id));
					//echo '<pre>';print_r($resouse_detail);exit;
					if($resourse_id!=''){
						$deletdata=array(
							'r_status'=>2,
							'r_updated_at'=>date('Y-m-d H:i:s')
							);
							$deletedata= $this->Hospital_model->update_resourse_details(base64_decode($resourse_id),$deletdata);
							if(count($deletedata)>0){
								
								$admin_stusdetails=array(
									'a_status'=>2,
									'a_updated_at'=>date('Y-m-d H:i:s')
									);
								$this->Admin_model->update_resourse_details($resouse_detail['a_id'],$admin_stusdetails);
							
								$this->session->set_flashdata('success',"Resource successfully removed.");
									if($resouse_detail['role_id']==6){
										redirect('hospital/adddoctor/'.base64_encode(1));
									}else{
										redirect('hospital/resource/'.base64_encode(1));
									}
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									if($resouse_detail['role_id']==6){
										redirect('hospital/adddoctor/'.base64_encode(1));
									}else{
										redirect('hospital/resource/'.base64_encode(1));
									}
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/resource/'.base64_encode(1));
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
	
	public function treatment()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
					$data['tab']=base64_decode($this->uri->segment(3));
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$data['treatment_list']=$this->Hospital_model->get_active_treatment_list($hos_ids['a_id'],$hos_ids['hos_id']);
					$data['doctors_list']=$this->Hospital_model->get_doctors_list($hos_ids['a_id'],$hos_ids['hos_id']);
					//echo $this->db->last_query();exit;
					$data['hospital_treatment_list']=$this->Hospital_model->get_all_doctor_treatment_list($hos_ids['a_id'],$hos_ids['hos_id']);
					//echo '<pre>';print_r($data);exit;
					//echo '<pre>';print_r($data);exit;
					$this->load->view('hospital/treament',$data);
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
	public function resourceedit()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$resourseId = base64_decode($this->uri->segment(3));
				$data['resouse_detail']= $this->Hospital_model->get_resourse_details($resourseId);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('hospital/resouceedit',$data);
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
	public function resourceditepost()
	{
		if($this->session->userdata('userdetails'))
		{
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$resouse_detail= $this->Hospital_model->get_resourse_details($post['resource_id']);
					
					$resouse_email= $this->Hospital_model->get_resourse_details($post['resource_id']);
					if($resouse_email['resource_email'] !=$post['resource_email']){
								$emailcheck= $this->Hospital_model->check_email_exits($post['resource_email']);
								if(count($emailcheck)>0){
									$this->session->set_flashdata('error','Email Id already exists. Please use another Email Id');
									redirect('hospital/resourceedit/'.base64_encode($post['resource_id']));
								}else{
											if(isset($_FILES['resource_photo']['name']) && $_FILES['resource_photo']['name']!=''){
												unlink("assets/adminprofilepic/".$resouse_detail['resource_photo']);
												$temp = explode(".", $_FILES["resource_photo"]["name"]);
												$photo =round(microtime(true)) . '.' . end($temp);
												move_uploaded_file($_FILES['resource_photo']['tmp_name'], "assets/adminprofilepic/" . $photo);
											}else{
												$photo=$resouse_detail['resource_photo'];
											}
											if(isset($_FILES['resource_document']['name']) && $_FILES['resource_document']['name']!=''){
												unlink("assets/resourse_doc/".$resouse_detail['resource_document']);
												$temp = explode(".", $_FILES["resource_document"]["name"]);
												$resource_document ='1'.round(microtime(true)) . '.' . end($temp);
												move_uploaded_file($_FILES['resource_document']['tmp_name'], "assets/resourse_doc/" . $resource_document);
											}else{
												$resource_document=$resouse_detail['resource_document'];
											}
											if(isset($_FILES['resource_other_document']['name']) && $_FILES['resource_other_document']['name']!=''){
												unlink("assets/resourse_doc/".$resouse_detail['resource_other_document']);
												$temp = explode(".", $_FILES["resource_document"]["name"]);
												$resource_other_document =round(microtime(true)) . '.' . end($temp);
												move_uploaded_file($_FILES['resource_other_document']['tmp_name'], "assets/resourse_doc/" . $resource_other_document);
											}else{
												$resource_other_document=$resouse_detail['resource_other_document'];
											}
									$admindetails=$this->session->userdata('userdetails');
									$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
									//echo '<pre>';print_r($statusdata);exit;
									$admin_details=array(
									'role_id'=>$post['designation'],
									'a_name'=>$post['resource_name'],
									'a_email_id'=>$post['resource_email'],
									'a_mobile'=>$post['resource_mobile'],
									'a_updated_at'=>date('Y-m-d H:i:s')
									);
									$addresourcedmin = $this->Admin_model->update_admin_details($post['admin_id'],$admin_details);
									
									$resourcedata=array(
									'role_id'=>$post['designation'],
									'resource_name'=>$post['resource_name'],
									'resource_mobile'=>$post['resource_mobile'],
									'resource_add1'=>$post['resource_add1'],
									'resource_add2'=>$post['resource_add2'],
									'resource_city'=>$post['resource_city'],
									'resource_state'=>$post['resource_state'],
									'resource_zipcode'=>$post['resource_zipcode'],
									'resource_other_details'=>$post['resource_other_details'],
									'resource_contatnumber'=>$post['resource_contatnumber'],
									'resource_email'=>$post['resource_email'],
									'resource_photo'=>$photo,
									'resource_document'=>$resource_document,
									'resource_bank_holdername'=>$post['resource_bank_holdername'],
									'resource_bank_accno'=>$post['resource_bank_accno'],
									'resource_ifsc_code'=>$post['resource_ifsc_code'],
									'consultation_fee'=>$post['consultation_fee'],
									'resource_other_document'=>$resource_other_document,
									'r_created_at'=>date('Y-m-d H:i:s')
									);
									//echo '<pre>';print_r($resourcedata);exit;
									$saveresource =$this->Hospital_model->update_resourse_details($post['resource_id'],$resourcedata);
									//echo $this->db->last_query();exit;
									if(count($saveresource)>0){
										$this->session->set_flashdata('success',"Resource details are successfully updated");
										if($admindetails['role_id']=2){
											
												redirect('hospital/resourceview/'.base64_encode($post['resource_id']));

										}else{
											redirect('profile');
										}
									}else{
										$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
										redirect('hospital/resourceedit/'.base64_encode($post['resource_id']));
									}
								}
								
					}else{
						if(isset($_FILES['resource_photo']['name']) && $_FILES['resource_photo']['name']!=''){
								if($resouse_detail['resource_photo']!=''){
									unlink("assets/adminprofilepic/".$resouse_detail['resource_photo']);
								}
								$temp = explode(".", $_FILES["resource_photo"]["name"]);
								$photo =round(microtime(true)) . '.' . end($temp);
								move_uploaded_file($_FILES['resource_photo']['tmp_name'], "assets/adminprofilepic/" . $photo);
							}else{
								$photo=$resouse_detail['resource_photo'];
							}
							if(isset($_FILES['resource_document']['name']) && $_FILES['resource_document']['name']!=''){
								if($resouse_detail['resource_document']!=''){
								unlink("assets/resourse_doc/".$resouse_detail['resource_document']);
								}
								$temp = explode(".", $_FILES["resource_document"]["name"]);
								$resource_doc ='1'.round(microtime(true)) . '.' . end($temp);
								move_uploaded_file($_FILES['resource_document']['tmp_name'], "assets/resourse_doc/" . $resource_doc);
							}else{
								$resource_doc=$resouse_detail['resource_document'];
							}
							if(isset($_FILES['resource_other_document']['name']) && $_FILES['resource_other_document']['name']!=''){
								if($resouse_detail['resource_other_document']!=''){
								unlink("assets/resourse_doc/".$resouse_detail['resource_other_document']);
								}
								$temp = explode(".", $_FILES["resource_other_document"]["name"]);
								$resource_other_docu =round(microtime(true)) . '.' . end($temp);
								move_uploaded_file($_FILES['resource_other_document']['tmp_name'], "assets/resourse_doc/" . $resource_other_docu);
							}else{
								$resource_other_docu=$resouse_detail['resource_other_document'];
							}
						$admin_details=array(
									'role_id'=>$post['designation'],
									'a_email_id'=>$post['resource_email'],
									'a_name'=>$post['resource_name'],
									'a_mobile'=>$post['resource_mobile'],
									'a_updated_at'=>date('Y-m-d H:i:s')
									);
									$addresourcedmin = $this->Hospital_model->update_adminhospital_details($post['admin_id'],$admin_details);
									$resourcedata=array(
									'role_id'=>$post['designation'],
									'resource_name'=>$post['resource_name'],
									'resource_mobile'=>$post['resource_mobile'],
									'resource_add1'=>$post['resource_add1'],
									'resource_add2'=>$post['resource_add2'],
									'resource_city'=>$post['resource_city'],
									'resource_state'=>$post['resource_state'],
									'resource_zipcode'=>$post['resource_zipcode'],
									'in_time'=>$post['in_time'],
									'out_time'=>$post['out_time'],
									'resource_other_details'=>isset($post['resource_other_details'])?$post['resource_other_details']:'',
									'resource_contatnumber'=>$post['resource_contatnumber'],
									'resource_email'=>$post['resource_email'],
									'resource_photo'=>$photo,
									'resource_document'=>$resource_doc,
									'resource_bank_holdername'=>$post['resource_bank_holdername'],
									'resource_bank_accno'=>$post['resource_bank_accno'],
									'resource_ifsc_code'=>$post['resource_ifsc_code'],
									'resource_other_document'=>$resource_other_docu,
									'consultation_fee'=>$post['consultation_fee'],
									'r_created_at'=>date('Y-m-d H:i:s')
									);
									//echo '<pre>';print_r($resourcedata);exit;
									$saveresource =$this->Hospital_model->update_resourse_details($post['resource_id'],$resourcedata);
									//echo $this->db->last_query();exit;
									if(count($saveresource)>0){
										$this->session->set_flashdata('success',"Resource details are successfully updated");
										if($admindetails['role_id']=2){
										redirect('hospital/resourceview/'.base64_encode($post['resource_id']));
										}else{
											redirect('profile');
										}
									}else{
										$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
										redirect('hospital/resourceedit/'.base64_encode($post['resource_id']));
									}
					}
						
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function resourceview()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$resourseId = base64_decode($this->uri->segment(3));
				$data['resouse_detail']= $this->Hospital_model->get_resourse_details($resourseId);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('hospital/resouceview',$data);
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
	public function addtreatment()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$data['tab']=base64_decode($this->uri->segment(3));
				$admindetails=$this->session->userdata('userdetails');
				$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$data['treatment_list'] =$this->Hospital_model->get_treatment_list($hos_ids['a_id'],$hos_ids['hos_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('hospital/addtreament',$data);
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
	public function addspecialist()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$data['tab']=base64_decode($this->uri->segment(3));
				$admindetails=$this->session->userdata('userdetails');
				$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$data['treatment_list'] =$this->Hospital_model->get_all_treatment_list($hos_ids['a_id'],$hos_ids['hos_id']);
				$data['specialist_list'] =$this->Hospital_model->get_specialist_list($hos_ids['a_id'],$hos_ids['hos_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('hospital/addspecialist',$data);
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
	public function specialistpost()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				//echo '<pre>';print_r($post);exit;
					$exits_treatment = $this->Hospital_model->get_saved_specialist_name($post['department'],$post['specialist_name'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"Speciality name already exists .please use another name");
						redirect('hospital/addspecialist/'.base64_encode(1));
					}
				$spc_details=array(
					'hos_id'=>$hos_ids['hos_id'],
					'd_id'=>$post['department'],
					'specialist_name'=>$post['specialist_name'],
					't_status'=>1,
					't_create_at'=>date('Y-m-d H:i:s'),
					't_create_by'=>$hos_ids['a_id']
					);
					//echo '<pre>';print_r($treatment_details);exit;
				$treatment = $this->Hospital_model->save_addspecialist($spc_details);
				if(count($treatment)>0){
					$this->session->set_flashdata('success',"Speciality added successfully");
					redirect('hospital/addspecialist/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('hospital/addspecialist');
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
	public function treatmentpost()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					//echo '<pre>'; print_r($hos_ids);exit;
			//	echo '<pre>';print_r($post);exit;
					$exits_treatment = $this->Hospital_model->get_saved_treatment($post['treatment_name'],$hos_ids['hos_id']);
					//echo '<pre>';print_r($exits_treatment);exit;
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"Treatment name already exists .please use another name");
						redirect('hospital/addtreatment/'.base64_encode(1));
					}
				$treatment_details=array(
					'hos_id'=>$hos_ids['hos_id'],
					't_name'=>$post['treatment_name'],
					't_status'=>1,
					't_create_at'=>date('Y-m-d H:i:s'),
					't_create_by'=>$hos_ids['a_id']
					);
					//echo '<pre>';print_r($treatment_details);exit;
				$treatment = $this->Hospital_model->save_treatment($treatment_details);
				if(count($treatment)>0){
					$this->session->set_flashdata('success',"Department added successfully");
					redirect('hospital/addtreatment/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('hospital/addtreatment');
				}
									
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}public function treatmenteditpost()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$post=$this->input->post();
				$editdata_check= $this->Hospital_model->get_treatment_details($post['treamentid']);
				$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);

				if($editdata_check['t_name']!=$post['treatment_name']){
					$exits_treatment = $this->Hospital_model->get_saved_treatment($post['treatment_name'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"Department name already exists .please use another name");
						redirect('hospital/addtreatment/'.base64_encode(1));
					}
				}
				$edittreatment_details=array(
					't_name'=>$post['treatment_name'],
					't_updated_at'=>date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($post);exit;
				$editdata= $this->Hospital_model->update_treatment_details($post['treamentid'],$edittreatment_details);
				if(count($editdata)>0){
					$this->session->set_flashdata('success',"Department successfully updated");
					redirect('hospital/addtreatment/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('hospital/addtreatment');
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
	public function treatmentdelete()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=1){
					$treatment_id=$this->uri->segment(3);
					if($treatment_id!=''){
						$deletdata=array(
							't_status'=>2,
							't_updated_at'=>date('Y-m-d H:i:s')
							);
							$deletedata= $this->Hospital_model->update_treatment_details(base64_decode($treatment_id),$deletdata);
							if(count($deletedata)>0){
								$this->session->set_flashdata('success',"Department successfully removed.");
								redirect('hospital/addtreatment/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital/addtreatment/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/addtreatment/'.base64_encode(1));
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
	public function treatmentstatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$treament_id=$this->uri->segment(3);
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($treament_id!=''){
						$stusdetails=array(
							't_status'=>$statu,
							't_updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Hospital_model->update_treatment_details(base64_decode($treament_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Department successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Department successfully activated.");
								}
									redirect('hospital/addtreatment/'.base64_encode(1));;
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital/addtreatment/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/addtreatment/'.base64_encode(1));
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
	public function treatmenaddtpost()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$specialist_doctor_id=$this->Hospital_model->get_specialist_doctor_id($post['treatment_name'],$hos_ids['hos_id']);
					//echo '<pre>';print_r($specialist_doctor_id);exit;
					
					$check=$this->Hospital_model->op_treatment_exist($post['treatment_name'],$post['assign_doctor']);
					if(count($check)>0){
						$this->session->set_flashdata('error',"Department Wise Consultant Names already exists. Please try again");
						redirect('hospital/treatment');
					}
					//echo '<pre>';print_r($post);exit;
				//echo '<pre>';print_r($key);exit;
							$addtreatment_details=array(
							'hos_id'=>$hos_ids['hos_id'],
							's_id'=>$specialist_doctor_id['s_id'],
							't_d_doc_id'=>$post['assign_doctor'],
							't_d_name'=>$post['treatment_name'],
							't_d_status'=>1,
							't_d_create_at'=>date('Y-m-d H:i:s'),
							't_d_updated_at'=>date('Y-m-d H:i:s'),
							't_d_create_by'=>$hos_ids['a_id']
							);
							//echo '<pre>';print_r($addtreatment_details);exit;
						$treatment = $this->Hospital_model->save_addtreatment($addtreatment_details);
						
						if(count($treatment)>0){
							$this->session->set_flashdata('success',"Department assigned to consultant successfully");
							redirect('hospital/treatment/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('hospital/treatment');
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
	public function addtreatmentstatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$treament_id=$this->uri->segment(3);
					$status =base64_decode($this->uri->segment(4));
					if($status ==1){
						$statu=0;
					}else{
						$statu=1;
					}
					echo $statu;
					if($treament_id!=''){
						$stusdetails=array(
							't_d_status'=>$statu,
							't_d_updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Hospital_model->update_addtreatment_details(base64_decode($treament_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Department wise doctor successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Department wise doctor successfully activated.");
								}
									redirect('hospital/treatment/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital/treatment/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/treatment/'.base64_encode(1));
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
	public function addtreatmentdeletes()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=1){
					$treatment_id=$this->uri->segment(3);
					if($treatment_id!=''){
						$deletdata=array(
							't_d_status'=>2,
							't_d_updated_at'=>date('Y-m-d H:i:s')
							);
							$deletedata= $this->Hospital_model->update_addtreatment_details(base64_decode($treatment_id),$deletdata);
							if(count($deletedata)>0){
								$this->session->set_flashdata('success',"Department assigned to consultant successfully removed.");
								redirect('hospital/treatment/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('hospital/treatment/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/addtreatment/'.base64_encode(1));
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
	
	/*specialist*/
	public function specialistdelete()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$specialist_id=$this->uri->segment(3);
					if($specialist_id!=''){
						$deletedata= $this->Hospital_model->delete_specialist_details(base64_decode($specialist_id));
							if(count($deletedata)>0){
								$this->session->set_flashdata('success',"Speciality successfully removed.");
								redirect('hospital/addspecialist/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital/addspecialist/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/addspecialist/'.base64_encode(1));
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
	public function specialisttstatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$specialist_id=$this->uri->segment(3);
					$status =base64_decode($this->uri->segment(4));
					if($status ==1){
						$statu=0;
					}else{
						$statu=1;
					}
					$statu;
					if($specialist_id!=''){
						$stusdetails=array(
							't_status'=>$statu,
							't_updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Hospital_model->update_specialist_details(base64_decode($specialist_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Speciality successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Speciality successfully activated.");
								}
									redirect('hospital/addspecialist/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital/addspecialist/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/addspecialist/'.base64_encode(1));
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
	public function specialisteditpost()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$post=$this->input->post();
				
				//echo '<pre>';print_r($post);exit;
				$editdata_check= $this->Hospital_model->get_specialist_details($post['specialistid']);
				$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);

				if($editdata_check['specialist_name']!=$post['specialist_name'] || $editdata_check['department']!=$post['d_id']){
					$exits_treatment = $this->Hospital_model->get_saved_specialist_name($post['department'],$post['specialist_name'],$hos_ids['hos_id']);
					if(count($exits_treatment)>0){
						$this->session->set_flashdata('error',"Speciality name already exists .please use another name");
						redirect('hospital/addspecialist/'.base64_encode(1));
					}
				}
				$edittreatment_details=array(
					'd_id'=>$post['department'],
					'specialist_name'=>$post['specialist_name'],
					't_updated_at'=>date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($post);exit;
				$editdata= $this->Hospital_model->update_specialist_details($post['specialistid'],$edittreatment_details);
				if(count($editdata)>0){
					$this->session->set_flashdata('success',"Speciality Details successfully updated");
					redirect('hospital/addspecialist/'.base64_encode(1));
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('hospital/addspecialist');
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
	
	/*specialist*/
	public function labdetails()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
					$data['tab']=base64_decode($this->uri->segment(3));
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
					$data['labassistents_list']=$this->Hospital_model->get_labassistents_list($hos_ids['a_id'],$hos_ids['hos_id']);
					$data['labdetails_list']=$this->Hospital_model->get_all_lab_details_list($hos_ids['a_id'],$hos_ids['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('hospital/labdetails',$data);
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
	public function tabdetailspost()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
				$post=$this->input->post();
					$admindetails=$this->session->userdata('userdetails');
					$hos_ids =$this->Hospital_model->get_hospital_id($admindetails['a_id'],$admindetails['a_email_id']);
				$labdetails_list=array_combine($post['lab_code'],$post['lab_name']);
				if(count($labdetails_list)>0){
						//echo '<pre>';print_r($treamts_list);
						$c=0;foreach($labdetails_list as $key=>$list){
							$li[$c]['code']=$key;
							$li[$c]['name']=$list;
							$li[$c]['lab_assistent']=$post['lab_assistent'][$c];
							$li[$c]['investigation']=$post['investigation'][$c];
							
						$c++;}
						
						foreach($li as $l){
							if($l['code']!='' && $l['name']!='' && $l['lab_assistent']!=''){
								$addlab_details=array(
								'hos_id'=>$hos_ids['hos_id'],
								'l_code'=>$l['code'],
								'l_name'=>$l['name'],
								'l_assistent_id'=>$l['lab_assistent'],
								'l_investigation'=>$l['investigation'],
								'l_status'=>1,
								'l_create_at'=>date('Y-m-d H:i:s'),
								'l_updated_at'=>date('Y-m-d H:i:s'),
								'l_create_by'=>$hos_ids['a_id']
								);
								//echo '<pre>';print_r($addtreatment_details);
								$labdetails = $this->Hospital_model->save_addlabdetails($addlab_details);
							}
						}
						
						if(count($labdetails)>0){
							$this->session->set_flashdata('success',"Lab Details are successfully added");
							redirect('hospital/labdetails/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('hospital/labdetails');
						}
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('hospital/labdetails');
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
	public function labdetailsstatus()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=2){
					$lab_id=$this->uri->segment(3);
					$status =base64_decode($this->uri->segment(4));
					if($status ==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($lab_id!=''){
						$stusdetails=array(
							'l_status'=>$statu,
							'l_updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->Hospital_model->update_lab_details(base64_decode($lab_id),$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Lab Assistent successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Lab Assistent successfully activated.");
								}
									redirect('hospital/labdetails/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('hospital/labdetails/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/labdetails/'.base64_encode(1));
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
	public function labdetailsdeletes()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=1){
					$lab_id=$this->uri->segment(3);
					if($lab_id!=''){
						$deletdata=array(
							'l_status'=>2,
							'l_updated_at'=>date('Y-m-d H:i:s')
							);
							$deletedata= $this->Hospital_model->update_lab_details(base64_decode($lab_id),$deletdata);
							if(count($deletedata)>0){
								$this->session->set_flashdata('success',"Lab Assistent successfully removed.");
								redirect('hospital/labdetails/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('hospital/labdetails/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hospital/labdetails/'.base64_encode(1));
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
	public function announcement()
	{
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Admin_model->get_hospital_details($admindetails['a_id']);
					$data['resources_list']=$this->Admin_model->get_resource_list($userdetails['hos_id']);
					$admindetails=$this->session->userdata('userdetails');
					$data['userdetails']=$this->Admin_model->get_all_admin_details($admindetails['a_id']);
					$hos_details=$this->Admin_model->get_hospital_details($admindetails['a_id']);
					$data['notification']=$this->Admin_model->get_all_announcement($hos_details['hos_id']);
					$data['notification_sent_list']=$this->Hospital_model->get_all_sent_notification_details($admindetails['a_id']);
					$data['tab']=base64_decode($this->uri->segment(3));
					//echo '<pre>';print_r($data['tab']);exit;
					$this->load->view('hospital/announcement',$data);
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
	public function sendannouncements()
	{
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				$post=$this->input->post();
				if(isset($post['hospitals_ids']) && $post['hospitals_ids']!=''){
				foreach(explode(",",$post['hospitals_ids']) as $lists){
					if($lists !=''){
					$addcomments=array(
					'res_id'=>$lists,
					'comment'=>isset($post['comments'])?$post['comments']:'',
					'create_at'=>date('Y-m-d H:i:s'),
					'status'=>1,
					'sent_by'=>$admindetails['a_id']
					);
					$saveNotification=$this->Hospital_model->save_announcements_list($addcomments);
					//echo $this->db->last_query();exit;
					}
				}
				
				if(count($saveNotification)>0){
					$this->session->set_flashdata('success',"Notification successfully send.");
					redirect('hospital/announcement');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('hospital/announcement');
				}
				
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('hospital/announcement');
				}
			
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}
	}
	
	public  function modified_prescription(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Admin_model->get_hospital_details($admindetails['a_id']);
					$data['get_m_precption_list']=$this->Hospital_model->get_modified_prescription_list($userdetails['hos_id']);
					//echo '<pre>';print_r($get_m_precption_list);exit;
					$this->load->view('hospital/modified_prescription_list',$data);
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
	public  function viewprescription(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$billing_id=base64_decode($this->uri->segment(4));
					$patient_id=base64_decode($this->uri->segment(3));
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Admin_model->get_hospital_details($admindetails['a_id']);
					$data['prescriptions']=$this->Hospital_model->get_prescription_details($patient_id,$billing_id);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('hospital/prescription_view',$data);
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
	public  function patient_list(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Admin_model->get_hospital_details($admindetails['a_id']);

					$data['patient_list']=$this->Hospital_model->get_patient_list_with_billing_wise($userdetails['hos_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('hospital/patient_list',$data);
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
	
	// reports
	public  function reports(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);

					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Admin_model->get_hospital_details($admindetails['a_id']);
					if(isset($post['to_date']) && $post['to_date']!==''){
						$data['patients_list']=$this->Hospital_model->get_hospital_patient_list_date_wise($userdetails['hos_id'],$post['from_date'],$post['to_date']);
					}else{
					    $data['patients_list']=$this->Hospital_model->get_hospital_wise_patient_list($userdetails['hos_id']);
					}
					$data['search_list']=$post;
					//echo $this->db->last_query();
					//echo '<pre>';print_r($data);exit;
					$this->load->view('hospital/reports',$data);
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
	public  function patient_labdetails(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$admindetails=$this->session->userdata('userdetails');
					$p_id=base64_decode($this->uri->segment(3));
					$userdetails=$this->Admin_model->get_hospital_details($admindetails['a_id']);
					$data['patient_details']=$this->Hospital_model->get_patient_lab_details($p_id);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('hospital/patient_labdetails',$data);
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
	public  function patient_medicinedetails(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=2){
					$admindetails=$this->session->userdata('userdetails');
					$p_id=base64_decode($this->uri->segment(3));
					$userdetails=$this->Admin_model->get_hospital_details($admindetails['a_id']);
					$data['patient_details']=$this->Hospital_model->get_patient_medicine_details($p_id);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('hospital/patient_medicinedetails',$data);
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
	
	
	/* new op form purpose */
	
	public  function get_specialists_list(){
		$post=$this->input->post();
		$details=$this->Hospital_model->get_d_id_wise_specialist_list($post['dep_id']);
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
	public  function get_op_doctors_list(){
		$post=$this->input->post();
		$details=$this->Hospital_model->get_spec_doctors_list($post['treate_ment_id']);
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
	public  function get_hospital_time_list(){
		$post=$this->input->post();
		
		$doctor_list=$this->Hospital_model->get_doctor_time_list($post['doctor_id']);
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
					if(count($ddd) > 0)
						{
						$data['msg']=1;
						$data['list']=$ddd;
						echo json_encode($data);exit;	
						}else{
							$data['msg']=2;
							echo json_encode($data);exit;
						}
				}else{
							$data['msg']=2;
							echo json_encode($data);exit;
						}
		
	}
	
	
	
	
}
