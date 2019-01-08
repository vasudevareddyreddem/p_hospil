<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Medicine extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->model('Medicine_model');
		
		}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$medicine_list=$this->medicine_model->get_all_medicine_list($userdetails['hos_id']);
					
					if(count($medicine_list)>0){
							foreach($medicine_list as $lists){
							$list[]=$lists["medicine_name"];
							}
						$data['medicine_lists'] ="'" . implode ( "', '", $list ) . "'";
					}else{
						$data['medicine_lists']=array();
					}
					$this->load->view('resource/medicine',$data);
					$this->load->view('html/footer1');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function lists()
	{	
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					$data['medicine_list']=$this->medicine_model->get_all_medicine_lists($userdetails['hos_id']);
					//echo'<pre>';print_r($data['medicine_list']);exit;
					$this->load->view('resource/medicine_list',$data);
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
	public function addpost(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$admindetails=$this->session->userdata('userdetails');
					$userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
					
					foreach($post['addmedicn'] as $list){
						
						$st_percentage= $list['sgst'] + $list['cgst'];
						$percen_amount= ($list['amount'] * $st_percentage)/100;
						$total_amount=$list['amount'] + $percen_amount;
						
						$addmedicines=array(
						'hos_id'=>$userdetails['hos_id'],
						'hsn'=>$list['hsn'],
						'othercode'=>$list['othercode'],
						'batchno'=>$list['batchno'],
						'medicine_name'=>$list['medicine'],
						'medicine_type'=>$list['medicine_type'],
						'expiry_date'=>$list['expiry_date'],
						'dosage'=>$list['dosage'],
						'qty'=>$list['qty'],
						'amount'=>$list['amount'],
						'total_amount'=>$total_amount,
						'sgst'=>$list['sgst'],
						'cgst'=>$list['cgst'],
						'other'=>isset($list['other'])?$list['other']:'',
						'create_at'=>date('Y-m-d H:i:s'),
						'status'=>1,
						'added_by'=>$userdetails['a_id']
						);
						//echo '<pre>';print_r($addmedicines);exit;
						$save_medicine=$this->medicine_model->save_new_medicine($addmedicines);
							if(count($post['addmedicn'])==1){
								if(count($save_medicine)>0){
									
									$medicines=array(
									'hos_id'=>$userdetails['hos_id'],
									'medicine_name'=>$list['medicine'],
									'create_at'=>date('Y-m-d H:i:s'),
									'status'=>1,
									'added_by'=>$userdetails['a_id']
									);
									$get_medicine=$this->medicine_model->get_medicine_details($list['medicine']);
									if(count($get_medicine)>0){
									}else{
										$this->medicine_model->save_medicine_name($medicines);
									}
									$this->session->set_flashdata('success',"Medicine details successfully added.");
									redirect('medicine');
								}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('medicine');
									}
							
							}else{
								$medicines=array(
									'hos_id'=>$userdetails['hos_id'],
									'medicine_name'=>$list['medicine'],
									'create_at'=>date('Y-m-d H:i:s'),
									'status'=>1,
									'added_by'=>$userdetails['a_id']
									);
									$get_medicine=$this->medicine_model->get_medicine_details($list['medicine']);
									if(count($get_medicine)>0){
									}else{
										$this->medicine_model->save_medicine_name($medicines);
									}
							}
						
					}
					if(isset($save_medicine) && count($save_medicine)>0){
						$this->session->set_flashdata('success',"Medicine details successfully added.");
						redirect('medicine');
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('medicine');
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
	public function editmedicine_details(){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					$details=$this->medicine_model->get_medicine_list_details($post['med_id']);
					if($post['field_name']=='hsn'){
						$update=array(
						'hsn'=>$post['med_name'],
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}if($post['field_name']=='othercode'){
						$update=array(
						'othercode'=>$post['med_name'],
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}
					if($post['field_name']=='batchno'){
						$update=array(
						'batchno'=>$post['med_name'],
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}if($post['field_name']=='medicine_name'){
						$update=array(
						'medicine_name'=>$post['med_name'],
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}if($post['field_name']=='qty'){
						$update=array(
						'qty'=>$post['med_name'],
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}if($post['field_name']=='amount'){
						$st_percentage= $details['sgst'] + $details['cgst'];
						$percen_amount= ($post['med_name'] * $st_percentage)/100;
						$total_amount=$post['med_name'] + $percen_amount;
						$update=array(
						'amount'=>$post['med_name'],
						'total_amount'=>$total_amount,
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}
					if($post['field_name']=='sgst'){
						
						$st_percentage= $post['med_name'] + $details['cgst'];
						$percen_amount= ($details['amount'] * $st_percentage)/100;
						$total_amount=$details['amount'] + $percen_amount;
						$update=array(
						'sgst'=>$post['med_name'],
						'total_amount'=>$total_amount,
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}if($post['field_name']=='cgst'){
						$st_percentage= $details['sgst'] + $post['med_name'];
						$percen_amount= ($details['amount'] * $st_percentage)/100;
						$total_amount=$details['amount'] + $percen_amount;
						$update=array(
						'cgst'=>$post['med_name'],
						'total_amount'=>$total_amount,
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}if($post['field_name']=='other'){
						$update=array(
						'other'=>$post['med_name'],
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}if($post['field_name']=='dosage'){
						$update=array(
						'dosage'=>$post['med_name'],
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}if($post['field_name']=='medicine_type'){
						$update=array(
						'medicine_type'=>$post['med_name'],
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}if($post['field_name']=='expiry_date'){
						$update=array(
						'expiry_date'=>$post['med_name'],
						'updated_at'=>date('Y-m-d H:i:s')
						);
					}
					$updatedata=$this->medicine_model->update_medicine_details($post['med_id'],$update);
					if(count($updatedata) > 0)
					{
						$amt=$this->medicine_model->get_medicine_list_details($post['med_id']);
						$data['msg']=1;
						$data['t_amt']=$amt['total_amount'];
						echo json_encode($data);exit;	
					}else{
						$data['msg']=2;
						echo json_encode($data);exit;
					}
					
				}else{
					$data['msg']=3;
					echo json_encode($data);exit;
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('admin');
		}
	}
	public function search(){
		$post=$this->input->post();
		$details=$this->medicine_model->get_search_post($post['searchdata']);
		//	echo $this->db->last_query();exit;
		if(count($details) > 0)
				{
				$data['msg']=1;
				$data['text']=$details;
				echo json_encode($data);exit;	
				}else{
					$data['msg']=2;
					echo json_encode($data);exit;
				}
		
	}
	
	public  function delete($id){
		if($this->session->userdata('userdetails'))
		{
				if($admindetails['role_id']=4){
					$post=$this->input->post();
					echo $m_id=base64_decode($this->uri->segment(3));
					
					if($m_id!=''){
						$Delete=$this->medicine_model->delete_medicine($m_id);
						if(count($Delete)>0){
								$this->session->set_flashdata('success',"Medicine successfully deleted.");
								redirect('medicine/lists');
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('medicine/lists');
							}
						
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('medicine/lists');
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
	                                public function exelupload(){
										if($this->session->userdata('userdetails'))
		                                 {
				                      if($admindetails['role_id']=4){
										   //echo '<pre>';print_r($admindetails);exit;
					                 $post=$this->input->post();
					                      
					                 $admindetails=$this->session->userdata('userdetails');
					                 $userdetails=$this->Resources_model->get_all_resouce_details($admindetails['a_id']);
										
		                                include_once('simplexlsx.class.php');
												$getWorksheetName = array();
												$xlsx = new SimpleXLSX( $_FILES['uploadfile']['tmp_name'] );
												$getWorksheetName = $xlsx->getWorksheetName();
												//echo $xlsx->sheetsCount();exit;
														for($j=1;$j <= $xlsx->sheetsCount();$j++){
														$cnt=$xlsx->sheetsCount()-1;
														$arry=$xlsx->rows($j);
														unset($arry[0]);

						                                 //echo "<pre>";print_r($arry);exit;
																foreach($arry as $key=>$fields)
																{   
		                                                         $data=array(
																'hos_id'=>$userdetails['hos_id'],
																'hsn'=>$fields[0],
																'othercode'=>$fields[1],		
																'medicine_name'=>$fields[2],		
																'medicine_type'=>$fields[3],		
																'batchno'=>$fields[4],		
																'expiry_date'=>$fields[5],		
																'dosage'=>$fields[6],		
																'qty'=>$fields[7],		
																'amount'=>$fields[8],		
																'sgst'=>$fields[9]*$fields[8],		
																'cgst'=>$fields[10]*$fields[8],
                                                                'total_amount'=>$fields[9]*$fields[8]+$fields[10]*$fields[8]+$fields[8],																
																'create_at'=>date('Y-m-d H:i:s'),		
																'status'=>1,		
																'added_by'=>$userdetails['a_id'],		
																'updated_at'=>date('Y-m-d H:i:s'),		
																);
	
																	$save=$this->medicine_model->insert_data_pramacy($data);
																}
														}
														//echo'<pre>';print_r($data);exit;
														 if(count($save)>0){
														$this->session->set_flashdata('success',"Medicine successfully added.");
														redirect('medicine');
													}else{
														$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
														redirect('medicine');
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
		
	