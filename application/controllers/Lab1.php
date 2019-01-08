<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab1 extends CI_Controller {

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
		$this->load->model('Admin_model');
		$this->load->model('Lab_model');
		$this->load->model('Resources_model');
		$this->load->model('Users_model');
			if($this->session->userdata('userdetails'))
			{
			$admindetails=$this->session->userdata('userdetails');
			$data['userdetails']=$this->Admin_model->get_all_admin_details($admindetails['a_id']);
			$hos_details=$this->Admin_model->get_hospital_details($admindetails['a_id']);
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
						$data['area_list']=$location_list;
						$areas=implode('","', $location_list);
						$data['patient_id']=$p_id;
						$data['billing_id']=$b_id;
						$tests_list=$this->Lab_model->get_all_patients_out_souces_test_lists($p_id,$b_id);
						$out_source_list=$this->Lab_model->get_out_source_lab_test_list($p_id,$b_id);
						if(count($out_source_list)>0){
							foreach($out_source_list as $source_list){
								$lists[]=$source_list['p_l_t_id'];
							}
							$data['out_source_list']=$lists;
						}else{
							$data['out_source_list']=array();
						}
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
								//echo $this->db->last_query();
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
						$patient_ids=$this->Lab_model->get_search_result_patient_ids($admindetails['a_id'],$this->input->ip_address());
						$data['patient_id']=$patient_ids[0]['p_id'];
							$data['billing_id']=$patient_ids[0]['b_id'];
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
							//echo '<pre>';print_r($data);exit;
							if(isset($tests_list) && count($tests_list)>0){
								foreach($tests_list as $Lis){
									if($Lis['hos_id'] != $userdetails['hos_id']){
									$li[]=$Lis;
									}
								}
								if(isset($li) && count($li)>0){
									foreach($li as $l){
										$data['test_list'][$l['id']]=$l;
										$data['test_list'][$l['id']]['lab_adress']=$this->Lab_model->get_all_patients_all_out_souces_test_lists($l['t_name']);
										//echo '<pre>';print_r($l);	
									}
								}else{
									$data['test_list']=array();
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
							$data['bidding_test_list']=$this->Lab_model->get_all_bidding_test_list($admindetails['a_id']);
							$data['userdetails']=$userdetails;
						
					}
					
					//echo '<pre>';print_r($patient_ids);exit;
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
	
	
	
	
}
