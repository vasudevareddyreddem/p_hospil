<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Lab extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		
		}
	public function outsources_labtests()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['outsources_labtests']=$this->Lab_model->get_all_outsources_labtests_details($admindetails['a_id']);
					//echo $this->db->last_query();
					$this->load->view('lab/outsources_labtests',$data);
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
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['labtest_list']=$this->Lab_model->get_lab_test_details($userdetails['hos_id'],$admindetails['a_id']);
					//echo '<pre>';print_r($data['labtest_list']);exit;
					$data['test_type_list']=$this->Lab_model->get_lab_test_type_details();
					//echo '<pre>';print_r($data['test_type_list']);exit;
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('lab/testsdetails',$data);
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
	public function edit()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['labtest_list']=$this->Lab_model->get_lab_test_details($userdetails['hos_id']);
					//echo '<pre>';print_r($data['labtest_list']);exit;
					$data['test_type_list']=$this->Lab_model->get_lab_test_type_details();
					//echo '<pre>';print_r($data['test_type_list']);exit;
					$test_id=base64_decode($this->uri->segment(3));
					$data['tet_details']=$this->Lab_model->get_test_details($test_id);
					
					//echo '<pre>';print_r($data['tet_details']);exit;
					$this->load->view('lab/edit_test',$data);
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
	public function addtest()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$admindetails=$this->session->userdata('userdetails');
					$test_exits=$this->Resources_model->check_test_exits($admindetails['a_id'],$post['test_name'],$post['type']);
					if(count($test_exits)>0){
						$this->session->set_flashdata('error',"Test Name already exists. please try another test name.");
						redirect('lab');
					}
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					//echo '<pre>';print_r($userdetails);exit;
					$adding=array(
						'hos_id'=>isset($userdetails['hos_id'])?$userdetails['hos_id']:'',
						't_name'=>isset($post['test_name'])?$post['test_name']:'',
						'test_type'=>isset($post['test_type'])?$post['test_type']:'',
						'type'=>isset($post['type'])?$post['type']:'',
						'modality'=>isset($post['modality'])?$post['modality']:'',
						'duration'=>isset($post['duration'])?$post['duration']:'',
						'amuont'=>isset($post['amuont'])?$post['amuont']:'',
						't_short_form'=>isset($post['short_form'])?$post['short_form']:'',
						't_description'=>isset($post['description'])?$post['description']:'',
						't_department'=>isset($post['department'])?$post['department']:'',
						'create_at'=>date('Y-m-d H:i:s'),
						'status'=>1,
						'create_by'=>$admindetails['a_id'],
						'out_source'=>$admindetails['out_source']
						);
					//echo '<pre>';print_r($adding);exit;
						$saveing=$this->Lab_model->save_tabtest_details($adding);
						if(count($saveing)>0){
							$this->session->set_flashdata('success',"Test Type successfully added.");
							redirect('lab/index/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/index/'.base64_encode(1));
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
	public function updatetest()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					//echo'<pre>';print_r($admindetails);exit;
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$admindetails=$this->session->userdata('userdetails');
					$details=$this->Lab_model->check_test_details($post['t_id']);
					
					if($details['t_name'] !=$post['test_name'] || $details['type'] !=$post['type']){
							$test_exits=$this->Resources_model->check_test_exits($admindetails['a_id'],$post['test_name'],$post['type']);
							if(count($test_exits)>0){
								$this->session->set_flashdata('error',"Test Name already exists. please try another test name.");
								redirect('lab');
							}
					
					}
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$adding=array(
						't_name'=>isset($post['test_name'])?$post['test_name']:'',
						'test_type'=>isset($post['test_type'])?$post['test_type']:'',
						'type'=>isset($post['type'])?$post['type']:'',
						'modality'=>isset($post['modality'])?$post['modality']:'',
						'duration'=>isset($post['duration'])?$post['duration']:'',
						'amuont'=>isset($post['amuont'])?$post['amuont']:'',
						't_short_form'=>isset($post['short_form'])?$post['short_form']:'',
						't_description'=>isset($post['description'])?$post['description']:'',
						't_department'=>isset($post['department'])?$post['department']:'',
						);
						//echo '<pre>';print_r($adding);exit;
						$saveing=$this->Lab_model->update_tabtest_details($post['t_id'],$adding);
						if(count($saveing)>0){
							$this->session->set_flashdata('success',"Test Type successfully updated.");
							redirect('lab/index/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/index/'.base64_encode(1));
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
	public function teststatus()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$test_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$sta=0;
					}else{
						$sta=1;
					}
					$details=array(
						'status'=>$sta,
						'update_by'=>$admindetails['a_id']
						);
					//echo '<pre>';print_r($billing);exit;
						$updated=$this->Lab_model->update_labtest_details($test_id,$details);
						if(count($updated)>0){
							if($status==1){
							$this->session->set_flashdata('success',"Test Type successfully deactivated.");
							}else{
								$this->session->set_flashdata('success',"Test Type successfully activated.");
							}
							redirect('lab/index/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/index/'.base64_encode(1));
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
		public function deletelab()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$test_id=base64_decode($this->uri->segment(3));
					$delete=$this->Lab_model->delete_labtest($test_id);
						if(count($delete)>0){
							$this->session->set_flashdata('success',"Test Type successfully deleted.");
							redirect('lab/index/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/index/'.base64_encode(1));
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
	public function patient_list()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					
					$data['userdetails']=$userdetails;
					$datalabtest_list=$this->Lab_model->get_all_patients_lists($userdetails['hos_id']);
					
					if(isset($datalabtest_list) && count($datalabtest_list)>0){
						foreach($datalabtest_list as $list){
							//echo $list['pid'];
							$tests_list=$this->Lab_model->get_all_patients_test_lists($list['pid'],$list['b_id']);
							//echo '<pre>';print_r($tests_list);
							$lis[$list['b_id']]=$list;
							$lis[$list['b_id']]['tests']=$tests_list;
						
						}
						$data['labtest_list']=$lis;
						
					}else{
						$data['labtest_list']=array();
					}
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('lab/patient_list',$data);
					$this->load->view('html/footer');
					//echo '<pre>';print_r($data);
					//exit;
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function patient_database()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$datapatient_list=$this->Lab_model->get_all_labreports_lists($userdetails['hos_id']);
					//echo '<pre>';print_r($datapatient_list);exit;
					if(isset($datapatient_list) && count($datapatient_list)>0){
						foreach($datapatient_list as $list){
							//echo '<pre>';print_r($list);exit;
							$tests_list=$this->Lab_model->get_all_patients_test_lists($list['pid'],$list['b_id']);
							//echo '<pre>';print_r($tests_list);exit;
							$lis[$list['b_id']]=$list;
							$lis[$list['b_id']]['tests']=$tests_list;
						
						}
						$data['patient_list']=$lis;
						//echo '<pre>';print_r($data['patient_list']);exit;
					}else{
						$data['patient_list']=array();
						//echo '<pre>';print_r($data['patient_list']);exit;
					}
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('lab/patient_database',$data);
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
	public function outsource()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					
					$data['patient_id']=base64_decode($this->uri->segment(3));
					$data['billing_id']=base64_decode($this->uri->segment(4));
					$data['tab']=base64_decode($this->uri->segment(5));
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$previousdata=$this->Lab_model->get_previous_search_data($admindetails['a_id'],$this->input->ip_address());
					if(isset($previousdata) && count($previousdata)>0){
						foreach($previousdata as $lis){
							$this->Lab_model->delete_get_previous_search_data($lis['id']);
						}
					}
					$out_source_list=$this->Lab_model->get_out_source_lab_test_list($data['patient_id'],$data['billing_id']);
					
					if(count($out_source_list)>0){
						foreach($out_source_list as $source_list){
						$lists[]=$source_list['p_l_t_id'];
					}
					$data['out_source_list']=$lists;
					}else{
						$data['out_source_list']=array();
					}
					//echo $this->db->last_query();
					$tests_list=$this->Lab_model->get_all_patients_out_souces_test_lists($data['patient_id'],$data['billing_id']);
					//echo '<pre>';print_r($tests_list);exit;
					if(isset($tests_list) && count($tests_list)>0){
						foreach($tests_list as $Lis){
							if($Lis['hos_id'] != $userdetails['hos_id']){
							$li[]=$Lis;
							}
						}
						//echo '<pre>';print_r($li);exit;
						if(isset($li) && count($li)>0){
							foreach($li as $l){
								$data['test_list'][$l['id']]=$l;
								$data['test_list'][$l['id']]['lab_adress']=$this->Lab_model->get_all_patients_all_out_souces_test_lists($l['t_name']);
							//echo '<pre>';print_r($data['test_list']);exit;
							}
						}else{
							$data['test_list']=array();
						}
						//echo '<pre>';print_r($data['test_list']);exit;
						
					}else{
						$data['test_list']=array();
					}
					if(isset($tests_list) && count($tests_list)>0){
						foreach($tests_list as $Lis){
							if($Lis['hos_id'] != $userdetails['hos_id']){
							 //$citylist[]=$Lis['t_name'];
								$citylist[]=$this->Lab_model->get_test_locaton_list($l['t_name']);
							 //echo '<pre>';print_r($citylist);exit;
							 }
						 }
						 //echo '<pre>';print_r($citylist);exit;
						 if(isset($citylist) && count($citylist)>0){
								 foreach( $citylist as $list){
							 foreach($list as $Li){
								$location_names[]=$Li['resource_city'];
								 
							 }
								 
						 }
							$data['location_list']=array_unique($location_names); 
						 }else{
							 $data['location_list']=array(); 
						 }
					
					 }else{
						 $data['location_list']=array();
					 }
					$data['bidding_test_list']=$this->Lab_model->get_all_bidding_test_list($admindetails['a_id']);
					$data['userdetails']=$userdetails;
					//echo '<pre>';print_r($data);exit;

					$this->load->view('lab/outsource_list',$data);
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
	public function select_out_source_test(){
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				if($admindetails['role_id']=5){
					$post=$this->input->post();
					
					//echo '<pre>';print_r($post);exit;
					foreach($post['lab_id'] as $List){
						$p_l_t_id=explode('_',$List);
						$details=array(
						'lab_id'=>$p_l_t_id[0],
						'p_l_t_id'=>$p_l_t_id[1],
						'p_id'=>$post['patient_id'],
						'b_id'=>$post['billing_id'],
						'status'=>0,
						'create_at'=>date('Y-m-d H:i:s'),
						'create_BY'=>$admindetails['a_id']
						);
						//echo '<pre>';print_r($details);exit;
						$out_source_list = $this->Lab_model->save_lab_tests($details);

					}
					if(count($out_source_list)>0){
						$this->session->set_flashdata('success',"Lab Test successfully added");
						redirect('lab/patient_list');
					}else{
						$this->session->set_flashdata('error',"Select atleast one Lab Test");
						redirect('lab/outsource/'.base64_encode($post['patient_id']).'/'.base64_encode($post['billing_id']));
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
					$this->load->view('lab/patient_report_list',$data);
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
	public function patient_details()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					//echo'<pre>';print_r($userdetails);exit;
					$data['patient_id']=base64_decode($this->uri->segment(3));
					$data['billing_id']=base64_decode($this->uri->segment(4));
					$data['patient_details']=$this->Lab_model->get_billing_details($data['patient_id'],$data['billing_id']);
					if($admindetails['out_source']==1){
						
						$data['labtest_list']=$this->Lab_model->get_all_patients_out_labtest_lists($data['patient_id'],$data['billing_id'],1,$admindetails['a_id']);
						$data['direct_labtest_list']=$this->Lab_model->get_all_with_bidding_patients_out_labtest_lists($data['patient_id'],$data['billing_id'],0);
						$data['report_lists']=$this->Lab_model->get_all_patients_out_source_lab_report_lists($data['patient_id'],$data['billing_id'],1,$admindetails['a_id']);
						//echo '<pre>';print_r($data['labtest_list']);exit;
					}else{
						
						
						$data['labtest_list']=$this->Lab_model->get_all_patients_in_labtest_lists($data['patient_id'],$data['billing_id'],0);
						$data['report_lists']=$this->Lab_model->get_all_patients_lab_report_lists($data['patient_id'],$data['billing_id']);
					}
					$this->load->view('lab/patient_details',$data);
					$this->load->view('html/footer');
					//echo '<pre>';print_r($data['labtest_list']);exit;
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function uploadreports()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					
					
				
					$labdetails_list=array_combine($post['problem_name'],$post['symptoms']);
						if(count($labdetails_list)>0){
							
							$count = 0;
							foreach ($_FILES['document']['name'] as $i => $name) {
								if (strlen($_FILES['document']['name'][$i]) > 1) {
									$pic=$_FILES['document']['name'][$i];
									$picname = str_replace(" ", "", $pic);
									$temp = explode(".", $_FILES['document']['name'][$i]);
									$imagename=round(microtime(true)) . '.' . end($temp);
									$imgname = str_replace(" ", "", $imagename);
										move_uploaded_file($_FILES['document']['tmp_name'][$i], 'assets/patient_reports/'.$imgname);
										
										$names_list[]=$imgname;
										$count++;
										
								}
							}
							$c=0;foreach($labdetails_list as $key=>$list){
								if($key!='' && $list!=''){
									$li[$c]['problem_name']=$key;
									$li[$c]['symptoms']=$list;
									$li[$c]['image']=$names_list[$c];
									$li[$c]['test_id']=$post['test_id'][$c];
									
								}
								$c++;}
								
								
								//echo '<pre>';print_r($li);exit;
								
								foreach($li as $imglist){
									$addreports=array(
										'p_id'=>$post['pid'],
										'b_id'=>$post['b_id'],
										'hos_id'=>$userdetails['hos_id'],
										'problem'=>$imglist['problem_name'],
										'symptoms'=>$imglist['symptoms'],
										'image'=>$imglist['image'],
										'test_id'=>$imglist['test_id'],
										'create_at'=>date('Y-m-d H:i:s'),				
										'status'=>1,				
										'create_by'=>$admindetails['a_id']
										);
										$test_deatils=$this->Lab_model->get_previous_report_details($post['pid'],$post['b_id'],$imglist['test_id']);
										//echo '<pre>';print_r($test_deatils);
										if(count($test_deatils)>0){
											 unlink("assets/patient_reports/".$test_deatils['image']);
											$this->Lab_model->delete_previous_report_details($post['pid'],$post['b_id'],$imglist['test_id']);
										}
										
										//echo '<pre>';print_r($addreports);exit;
									$savereports = $this->Lab_model->save_patient_reports($addreports);
									/*delete out source lab bidding list */
										$delete_accept_bidding_tests=$this->Lab_model->delete_accept_bidding_remaining_tests($imglist['test_id']);
										if(isset($delete_accept_bidding_tests) && count($delete_accept_bidding_tests)>0){
											foreach($delete_accept_bidding_tests as $List){
												$this->Lab_model->delete_accept_bidding_test($List['id']);
											}
											
										}

									$compledata=array(
									'report_completed'=>1
									);
									$this->Lab_model->update_patient_billingreport_status($imglist['test_id'],$post['pid'],$post['b_id'],$compledata);
									$compledata=array(
									'status'=>1
									);
									$this->Lab_model->update_without_bidding_patient_billingreport_status($imglist['test_id'],$post['pid'],$post['b_id'],$compledata);

								}
								if(count($savereports)>0){
										$check_report_all_geting=$this->Lab_model->check_report_all_geting($post['pid'],$post['b_id']);
										//echo $this->db->last_query();exit;
										if(count($check_report_all_geting)==0){
											$compledata=array(
											'report_completed'=>1
											);
											$this->Lab_model->update_billingreport_status($post['pid'],$post['b_id'],$compledata);
	
										}
								$this->session->set_flashdata('success',"Reports are successfully added");
								redirect('lab/patient_details/'.base64_encode($post['pid']).'/'.base64_encode($post['b_id']));
								}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('lab/patient_details/'.base64_encode($post['pid']).'/'.base64_encode($post['b_id']));
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
	public function testtype()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					$admindetails=$this->session->userdata('userdetails');
					$data['tab']=base64_decode($this->uri->segment(3));
					$data['test_list']=$this->Lab_model->get_all_test_list($admindetails['a_id']);
					$this->load->view('admin/lab_tests',$data);
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
	public function oursource()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					
					$admindetails=$this->session->userdata('userdetails');
					$data['tab']=base64_decode($this->uri->segment(3));
					$data['out_sourcelab_list']=$this->Lab_model->out_sourcelab_list($admindetails['a_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('admin/oursource',$data);
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
	public function addtest_type()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$admindetails=$this->session->userdata('userdetails');
					$post=$this->input->post();
					$check=$this->Lab_model->check_lab_test_type($post['test_type'],$post['type']);
					if(count($check)>0){
						$this->session->set_flashdata('error',"Test Type name already exists. Please use another name.");
						redirect('lab/testtype/'.base64_encode(1));
					}
					//echo '<pre>';print_r($post);exit;
					$add=array(
						'type_name'=>$post['test_type'],
						'type'=>$post['type'],
						'create_at'=>date('Y-m-d H:i:s'),
						'status'=>1,
						'created_by'=>$admindetails['a_id']
						);
					//echo '<pre>';print_r($billing);exit;
						$save=$this->Lab_model->add_lab_test_type($add);
						if(count($save)>0){
							$this->session->set_flashdata('success',"Test Type successfully added.");
							redirect('lab/testtype/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/testtype/'.base64_encode(1));
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
	public function update_test_type()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$admindetails=$this->session->userdata('userdetails');
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$check=$this->Lab_model->check_get_lab_test_type_details($post['test_id']);
					if($check['type_name']!= $post['editname'] || $check['type']!= $post['type']){
						if(count($check)>0){
							$this->session->set_flashdata('error',"Test Type name already exists .please use another name.");
							redirect('lab/testtype/'.base64_encode(1));
						}
					}
					$add=array(
						'type_name'=>$post['editname'],
						'type'=>$post['type'],
						'updated_time'=>$admindetails['a_id']
						);
					//echo '<pre>';print_r($billing);exit;
						$save=$this->Lab_model->update_testtype_details($post['test_id'],$add);
						if(count($save)>0){
							$this->session->set_flashdata('success',"Test Type successfully updated.");
							redirect('lab/testtype/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/testtype/'.base64_encode(1));
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
	public function deletetest_type()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=1){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$test_id=base64_decode($this->uri->segment(3));
					$detail=array('status'=>2);
					$delete=$this->Lab_model->delete_test_type($test_id,$detail);
						if(count($delete)>0){
							$this->session->set_flashdata('success',"Test Type successfully deleted.");
							redirect('lab/testtype/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/testtype/'.base64_encode(1));
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
	public function test_type_status()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$test_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$sta=0;
					}else{
						$sta=1;
					}
					$details=array(
						'status'=>$sta,
						'updated_time'=>date('Y-m-d H:i:s')
						);
					//echo '<pre>';print_r($billing);exit;
						$updated=$this->Lab_model->update_testtype_details($test_id,$details);
						if(count($updated)>0){
							if($status==1){
							$this->session->set_flashdata('success',"Test Type successfully deactivated.");
							}else{
								$this->session->set_flashdata('success',"Test Type successfully activated.");
							}
							redirect('lab/testtype/'.base64_encode(1));
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/testtype/'.base64_encode(1));
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
	public function location_search()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					if($post['post_type']=='check'){
					$deails=array(
					'ip_address'=>$this->input->ip_address(),
					'p_id'=>$post['patient_id'],
					'b_id'=>$post['billing_id'],
					'location'=>$post['location_name'],
					'create_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$admindetails['a_id']
					);
					$updated=$this->Lab_model->save_search_data($deails);
					}else{
							$list=$this->Lab_model->getprevious_search_data($admindetails['a_id'],$post['location_name']);
							if(count($list)>0){
								foreach($list as $Li){
									$da=array('location'=>'');
									$updated=$this->Lab_model->delete_previous_search_data($Li['id'],$da);
									//echo $this->db->last_query();exit;
								}
							}
							
							//echo '<pre>';print_r($list);exit;
						
					}
					if(count($updated)>0){
						redirect('lab1/location_search_result');
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
	public function location_search_result()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$serach_result=$this->Lab_model->get_search_result($admindetails['a_id']);
					if(isset($serach_result) && count($serach_result)>0){
						foreach($serach_result as $list){
							$location_list[]=$list['location'];
							$p_id=$list['p_id'];
							$b_id=$list['b_id'];
						}
						$areas="'" . implode("','", $location_list). "'";
						$tests_list=$this->Lab_model->get_all_patients_out_souces_test_lists($p_id,$b_id);
					//echo '<pre>';print_r($data);exit;
						if(isset($tests_list) && count($tests_list)>0){
							foreach($tests_list as $Lis){
								if($Lis['hos_id'] != $userdetails['hos_id']){
								$li[]=$Lis;
								}
							}
							foreach($li as $l){
								$data['test_list'][$l['id']]=$l;
								$data['test_list'][$l['id']]['lab_adress']=$this->Lab_model->get_all_patients_all_out_souces_test_lists_with_areawise($l['t_name'],$areas);
								//echo $this->db->last_query();exit;
							}
							//echo '<pre>';print_r($data);exit;
							
						}else{
							$data['test_list']=array();
						}
						if(isset($tests_list) && count($tests_list)>0){
						foreach($tests_list as $Lis){
							if($Lis['hos_id'] != $userdetails['hos_id']){
							 //$citylist[]=$Lis['t_name'];
							 $citylist[]=$this->Lab_model->get_test_locaton_list($l['t_name']);
							 }
						 }
						 foreach( $citylist as $list){
							 foreach($list as $Li){
								$location_names[]=$Li['resource_city'];
								 
							 }
								 
						 }
						$data['location_list']=array_unique($location_names);
					 }else{
						 $data['location_list']=array();
					 }
						
					}else{
						
					}
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('lab/outsource_list_result',$data);
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
	public function sendbid()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$post=$this->input->post();
					
					//echo '<pre>';print_r($post);exit;
					foreach($post['test_id'] as $li){
						$ids=explode('_',$li);
					$test_list=$this->Lab_model->get_test_names($ids[0]);
					$lab_ids=$this->Lab_model->get_test_lab_ids($test_list['t_name']);
						foreach($lab_ids as $l){
								$details=array(
								'b_id'=>$post['billing_id'],
								'test_id'=>$test_list['t_id'],
								'p_l_t_id'=>$ids[1],
								'lab_id'=>$l['a_id'],
								'status'=>1,
								'create_at'=>date('Y-m-d H:i:s'),
								'create_by'=>$admindetails['a_id']
								);
								$bidding=$this->Lab_model->sent_bidding_for_test($details);
							}
					}
					if(count($bidding)>0){
							$this->session->set_flashdata('success',"Bid successfully sent.");
							redirect('lab/outsource/'.base64_encode($post['patient_id']).'/'.base64_encode($post['billing_id']).'/'.base64_encode(3));
					}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/outsource/'.base64_encode($post['patient_id']).'/'.base64_encode($post['billing_id']).'/'.base64_encode(3));
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
	public function bidding_list()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['bidding_test_list']=$this->Lab_model->get_bidding_test_list($admindetails['a_id']);
					$this->load->view('lab/bidding',$data);
					$this->load->view('html/footer');
					//echo '<pre>';print_r($data);exit;
					//echo '<pre>';print_r($admindetails);exit;
					
					
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function bidding_post()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$post=$this->input->post();
					$details=array(
								'amount'=>isset($post['amount'])?$post['amount']:'',
								'duration'=>isset($post['duration'])?$post['duration']:'',
								'status'=>2,
								'send_by'=>$admindetails['a_id'],
								);
								$bidding=$this->Lab_model->update_bidding_details($post['bid_id'],$details);
					if(count($bidding)>0){
							$this->session->set_flashdata('success',"Bid successfully updated.");
							redirect('lab/bidding_list');
					}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/bidding_list');
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
	public function bidding_decline()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$post=$this->input->post();
					$b_id=base64_decode($this->uri->segment(3));
					$details=array(
								'amount'=>isset($post['amount'])?$post['amount']:'',
								'duration'=>isset($post['duration'])?$post['duration']:'',
								'status'=>3,
								'send_by'=>$admindetails['a_id'],
								);
								$bidding=$this->Lab_model->update_bidding_details($b_id,$details);
					if(count($bidding)>0){
							$this->session->set_flashdata('success',"Bid successfully updated.");
							redirect('lab/bidding_list');
					}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/bidding_list');
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
	public function bidding_approved()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$post=$this->input->post();
					$b_id=base64_decode($this->uri->segment(3));
					$p_id=$this->uri->segment(4);
					$billing_id=$this->uri->segment(5);
					$change=base64_decode($this->uri->segment(6));
					if(isset($change) && $change==22){
							$details=array(
								'status'=>2,
								);
					}else{
					$details=array(
								'status'=>4,
								);
								
					}
					$bidding=$this->Lab_model->update_bidding_details($b_id,$details);
					$get_bidding_details=$this->Lab_model->get_bidding_details($b_id);
					if(count($bidding)>0){
						if(isset($change) && $change !=22){
							$details=array(
							'lab_id'=>$get_bidding_details['lab_id'],
							'p_l_t_id'=>$get_bidding_details['p_l_t_id'],
							'p_id'=>base64_decode($p_id),
							'b_id'=>base64_decode($billing_id),
							'status'=>0,
							'create_at'=>date('Y-m-d H:i:s'),
							'create_BY'=>$admindetails['a_id']
							);
							//echo '<pre>';print_r($details);exit;
							$out_source_list = $this->Lab_model->save_lab_tests($details);
							}
						
							$this->session->set_flashdata('success',"Bid successfully approved.");
							redirect('lab/outsource/'.$p_id.'/'.$billing_id.'/'.base64_encode(3));
					}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('lab/outsource/'.$p_id.'/'.$billing_id.'/'.base64_encode(3));
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
	public function exelsheet()
		{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=5){
					//echo'<pre>';print_r($admindetails);exit;
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					//echo'<pre>';print_r($userdetails);exit;
					
					include_once('simplexlsx.class.php');
					$getWorksheetName = array();
					$xlsx = new SimpleXLSX( $_FILES['uploadfile']['tmp_name'] );
					$getWorksheetName = $xlsx->getWorksheetName();
					//echo $xlsx->sheetsCount();exit;
					/* start*/
					
					for($j=1;$j <= $xlsx->sheetsCount();$j++){
					$cnt=$xlsx->sheetsCount()-1;
					$arry=$xlsx->rows($j);
					unset($arry[0]);
					 //echo "<pre>";print_r($arry);exit;
					 
					foreach($arry as $key=>$fields)
					{   
						$save_data=array(
						'hos_id'=>isset($userdetails['hos_id'])?$userdetails['hos_id']:'',
						'test_type'=>$fields[0],
						't_name'=>$fields[2],
						'type'=>$fields[1],
						'duration'=>$fields[3],
						'amuont'=>$fields[4],
						'modality'=>isset($fields[5])?$fields[5]:'',
						'create_at'=>date('Y-m-d H:i:s'),
						'status'=>1,
						'create_by'=>$admindetails['a_id'],
						'out_source'=>isset($admindetails['out_source'])?$admindetails['out_source']:''	
						);
					//echo'<pre>';print_r($save_data);exit;
						$save=$this->Lab_model->insert_data_lab_detail_value($save_data);
						//echo'<pre>';print_r($save);exit;
						
					  }
					}
					
					//exit;
					
					/* end*/
					 
			if(count($save)>0){
				$this->session->set_flashdata('success',"Lab details  successfully inserted.");
				redirect('lab');
			}else{
			$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
			redirect('lab');
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