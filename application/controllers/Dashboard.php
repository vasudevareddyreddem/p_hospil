<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');

class Dashboard extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		
	}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']==1){
				$data['hospital_list']=$this->Admin_model->get_hospitals_list_monthwise(date('Y'));
				
				$sevendays_list=$this->Admin_model->get_last_sevendays_hospital_list();
				//echo '<pre>';print_r($data);exit;
				if(count($sevendays_list)>0){
				$data['sevendays_list']=count($sevendays_list);
				}else{
					$data['sevendays_list']='';
				}
				$this->load->view('admin/dashboard',$data);
			}else if($admindetails['role_id']==2){
				$hos_details=$this->Admin_model->get_hospital_details($admindetails['a_id']);
				$up_details=array('hos_curent_login'=>1);
				$update=$this->Admin_model->update_login_details($admindetails['a_id'],$up_details);
			
				$data['patients_list']=$this->Admin_model->get_hospitals_patient_list_monthwise($hos_details['hos_id'],date('Y'));
				$data['new_patients_list']=$this->Admin_model->get_hospitals_new_patient_list_monthwise($hos_details['hos_id'],date('Y'));
				$data['reschudle_patients_list']=$this->Admin_model->get_hospitals_reschudle_patient_list_monthwise($hos_details['hos_id'],date('Y'));
                 //echo'<pre>';print_r($data);exit;
				$new_patient_sevendays_list=$this->Admin_model->get_last_sevendays_hospital_new_patient_list($hos_details['hos_id']);
				$new_all_patient_list=$this->Admin_model->get_hospital_new_patient_list($hos_details['hos_id']);

				$reschedulepatient_sevendays_list=$this->Admin_model->get_last_sevendays_hospital_reschedule_patient_list($hos_details['hos_id']);

				$reschedule_all_patient_list=$this->Admin_model->get_hospital_reschedule_patient_list($hos_details['hos_id']);

				$edit_prescriptions_list=$this->Admin_model->get_hospital_edit_prescriptions_list($hos_details['hos_id']);
				
				
				if(count($new_patient_sevendays_list)>0){
				$data['newpatient_last_seven']=count($new_patient_sevendays_list);
				}else{
					$data['newpatient_last_seven']='';
				}
				if(count($new_all_patient_list)>0){
				$data['total_newpatient_list']=count($new_all_patient_list);
				}else{
					$data['total_newpatient_list']='';
				}
				if(count($reschedulepatient_sevendays_list)>0){
				$data['reschedule_last_seven']=count($reschedulepatient_sevendays_list);
				}else{
					$data['reschedule_last_seven']='';
				}if(count($reschedule_all_patient_list)>0){
				$data['total_reschudle_patient_list']=count($reschedule_all_patient_list);
				}else{
					$data['total_reschudle_patient_list']='';
				}
				if(count($edit_prescriptions_list)>0){
				$data['prescriptions_list']=count($edit_prescriptions_list);
				}else{
					$data['prescriptions_list']='';
				}
				//echo '<pre>';print_r($data);exit;

				$this->load->view('hospital/dashboard',$data);
			}else if($admindetails['role_id']==3){
				redirect('resources/desk');
			}else if($admindetails['role_id']==4){
				redirect('users');
			}else if($admindetails['role_id']==5){
				redirect('lab/patient_list');
			}else if($admindetails['role_id']==6){
				redirect('resources/worksheet');
			}else if($admindetails['role_id']==8){
				redirect('admin/chat');
			}else if($admindetails['role_id']==9){
				$login_details=$this->session->userdata('userdetails');
				$hos_details=$this->Resources_model->get_all_resouce_details($login_details['a_id']);
				$data['total_admit_patients']=$this->Admin_model->get_total_admit_patients_list($hos_details['hos_id']);
				$data['total_discharge_patients']=$this->Admin_model->get_total_discharge_patients_list($hos_details['hos_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('ward/dashboard',$data);
			}else if($admindetails['role_id']==10){
				redirect('nurse/patient_follow_ups');
			}
			$this->load->view('html/footer');

		}else{
			$this->session->set_flashdata('loginerror','Please login to continue');
			redirect('admin');
		}
	}
	public function changepassword()
	{
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
				$this->load->view('html/changepassword');
				$this->load->view('html/footer');
			
		}else{
			$this->session->set_flashdata('loginerror','Please login to continue');
			redirect('admin');
		}
	}
	public function changepasswordpost(){
	 
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			$post=$this->input->post();
			$admin_details = $this->Admin_model->get_adminpassword_details($admindetails['a_id']);
			if($admin_details['a_password']== md5($post['oldpassword'])){
				if(md5($post['password'])==md5($post['confirmpassword'])){
						$updateuserdata=array(
						'a_password'=>md5($post['confirmpassword']),
						'a_org_password'=>$post['confirmpassword'],
						'a_updated_at'=>date('Y-m-d H:i:s'),
						);
						//echo '<pre>';print_r($updateuserdata);exit;
						$upddateuser = $this->Admin_model->update_admin_details($admindetails['a_id'],$updateuserdata);
						if(count($upddateuser)>0){
							$this->session->set_flashdata('success',"password successfully updated");
							redirect('dashboard/changepassword');
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('dashboard/changepassword');
						}
					
				}else{
					$this->session->set_flashdata('error',"Password and Confirm password are not matched");
					redirect('dashboard/changepassword');
				}
				
			}else{
				$this->session->set_flashdata('error',"Old password are not matched");
				redirect('dashboard/changepassword');
			}
				
			
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
	 
	}
	public function logout(){
		$admindetails=$this->session->userdata('userdetails');
		$up_details=array('hos_curent_login'=>0);
		$update=$this->Admin_model->update_login_details($admindetails['a_id'],$up_details);
		$userinfo = $this->session->userdata('userdetails');
        $this->session->unset_userdata($userinfo);
		$this->session->sess_destroy('userdetails');
		$this->session->unset_userdata('userdetails');
        redirect('admin');
	}
	
	public function emps(){
		
		
		/*test*/
		$this->zend->load('Zend/Barcode');
		//generate barcode
		
		/*test*/
		
		$filename = $this->security->sanitize_filename($this->input->post('name'), TRUE);
		$data=array('d_name'=>$filename);
		$logindatasave = $this->Doctor_model->save_doctors($data);
		
		
		
		$file = Zend_Barcode::draw('code128', 'image', array('text' => $logindatasave), array());
		$code = time().$logindatasave;
		 $store_image1 = imagepng($file, $this->config->item('documentroot')."assets/barcodes/{$code}.png");
			
		$this->Doctor_model->update_doctors_details($logindatasave,$code);
		//echo '<pre>';print_r($test);
		
		
	}
	
	
	
}
