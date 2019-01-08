<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function check_email_already_already_exits($email){
	$this->db->select('*')->from('appointment_users');
	$this->db->where('email',$email);
	return $this->db->get()->row_array();
	}
	public function check_mobile_already_already_exits($mobile){
		$this->db->select('*')->from('appointment_users');
		$this->db->where('mobile',$mobile);
		return $this->db->get()->row_array();
	}
	public function check_email_already_exits($email){
		$this->db->select('*')->from('appointment_users');
		$this->db->where('email',$email);
		return $this->db->get()->row_array();
	}
	public  function get_card_number_data($card_num){
		$this->db->select('patient_name,email_id,mobile_num,whatsapp_num,card_number,card_id')->from('seller_card_assign_munber_list');
		$this->db->where('card_number',$card_num);
		return $this->db->get()->row_array();
	}
	public  function save_appointment_user($data){
		$this->db->insert('appointment_users',$data);
		return $this->db->insert_id();
		
	}
	public  function check_login_details_with_mobile($mobile,$password){
		$this->db->select('a_u_id,name,email,mobile,profile_pic')->from('appointment_users');
		$this->db->where('mobile',$mobile);
		$this->db->where('password',md5($password));
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	public  function check_login_details($email,$password){
		$this->db->select('a_u_id,name,email,mobile,profile_pic')->from('appointment_users');
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	public  function check_user_details($id){
		$this->db->select('*')->from('appointment_users');
		$this->db->where('a_u_id',$id);
		return $this->db->get()->row_array();
	}
	public  function update_user_password($id,$pass){
		$data=array('password'=>md5($pass),'org_password'=>$pass);
		$this->db->where('a_u_id',$id);
		return $this->db->update('appointment_users',$data);
		
	}
	public  function update_user_pushnotification_token($id,$data){
		$this->db->where('a_u_id',$id);
		return $this->db->update('appointment_users',$data);
		
	}
	
	public function get_hospital_citys_list(){
		$this->db->select('hospital.hos_bas_city')->from('hospital');
		$this->db->where('hos_status',1);
		$this->db->where('hos_undo',0);
		$this->db->where('hos_bas_city!=','') ;
		$this->db->group_by('hospital.hos_bas_city') ;
		return $this->db->get()->result_array();
	}
	public function get_hospital_lists($city){
		$this->db->select('hospital.hos_bas_name,hospital.hos_id,hospital.hos_bas_city,hospital.appointment_fee as consultationfee')->from('hospital');
		$this->db->where('hospital.hos_bas_city',$city) ;
		$this->db->where('hos_status',1);
		$this->db->where('hos_undo',0);
		return $this->db->get()->result_array();
	}
	public function get_hospital_list($specialist_name,$city){
		$this->db->select('hospital.hos_bas_name,hospital.hos_id')->from('specialist');
		$this->db->join('hospital', 'hospital.hos_id = specialist.hos_id', 'left');
		$this->db->where('specialist.specialist_name',$specialist_name);
		$this->db->where('hospital.hos_bas_city',$city) ;
		$this->db->group_by('hospital.hos_id');
		$this->db->where('specialist.t_status',1);
		return $this->db->get()->result_array();
	}
	public  function get_hospital_department_list($hos_id){
		$this->db->select('hospital.hos_id,treament.t_name as department_name,treament.t_id as department_id')->from('hospital');
		$this->db->join('treament', 'treament.hos_id = hospital.hos_id', 'left');
		$this->db->where('hospital.hos_id',$hos_id);
		$this->db->where('hospital.hos_status',1);
		$this->db->where('treament.t_status',1);
		$this->db->where('hospital.hos_bas_city!=','') ;
		$this->db->group_by('treament.t_name');
		return $this->db->get()->result_array();
	}
	/*testing*/
	public  function get_hospital_department_list_back($city){
		$this->db->select('treament.t_name,treament.t_id,treament.hos_id')->from('hospital');
		$this->db->where('hos_bas_city',$city);
		$this->db->where('t_status',1);
		return $this->db->get()->result_array();
	}
	/*testing*/
	public  function get_hospital_department_specialist_list($hos_id,$department_id){
		$this->db->select('treament.t_name,treament.t_id')->from('treament');
		$this->db->join('specialist', 'specialist.hos_id = treament.hos_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = treament.hos_id', 'left');
		$this->db->where('treament.t_id',$department_id);
		$this->db->where('hospital.hos_id',$hos_id);
		$this->db->group_by('treament.t_id');
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			
			$data[$list['t_id']]=$this->get_specilist_names_list($list['t_id']);
			
		}
		if(!empty($data)){
			return $data;
		}
		
		//echo '<pre>';print_r($data);exit;
	}
	
	
	public function get_specilist_names_list($hos_id,$d_id){
		$this->db->select('specialist.s_id as specialist_id ,specialist.specialist_name')->from('specialist');
		$this->db->group_by('specialist.s_id');
		$this->db->where('specialist.d_id',$d_id);
		$this->db->where('specialist.hos_id',$hos_id);
		return $this->db->get()->result_array();
	}
	public  function get_hospital_department_specialist_list_backup($department,$city){
		$this->db->select('specialist.specialist_name')->from('specialist');
		$this->db->join('treament', 'treament.hos_id = specialist.hos_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = specialist.hos_id', 'left');
		$this->db->where('treament.t_name',$department);
		$this->db->where('specialist.t_status',1);
		$this->db->where('hospital.hos_bas_city',$city);
		$this->db->group_by('specialist.specialist_name');
		return $this->db->get()->result_array();
	}
	public  function get_hospital_specialist_doctors_list($hos_id,$specialist_id){
		$this->db->select('resource_list.a_id as doctor_id,resource_list.resource_name as doctor_name,resource_list.in_time,resource_list.out_time')->from('treatmentwise_doctors');		
		$this->db->join('resource_list', 'resource_list.a_id = treatmentwise_doctors.t_d_doc_id', 'left');
		$this->db->where('treatmentwise_doctors.s_id',$specialist_id);
		$this->db->where('treatmentwise_doctors.hos_id',$hos_id);
		$this->db->where('resource_list.r_status',1);
        return $this->db->get()->result_array();
	}
	
	public  function get_appointment_user_details($a_u_id){
		$this->db->select('name,email,mobile,a_u_id,token')->from('appointment_users');
		$this->db->where('a_u_id',$a_u_id);
		return $this->db->get()->row_array();
	}
	public  function get_doctor_time_list($hos_id,$doctor_id){
		$this->db->select('in_time,out_time')->from('resource_list');		
		$this->db->where('a_id',$doctor_id);
		$this->db->where('hos_id',$hos_id);
        return $this->db->get()->row_array();
	}
	
	
	public  function get_department_name_id($hos_id,$department_name){
		$this->db->select('hos_id,t_id')->from('treament');
		$this->db->where('hos_id',$hos_id);
		$this->db->where('t_name',$department_name);
		return $this->db->get()->row_array();
	}
	public  function get_specilist_name_id($hos_id,$s_name){
		$this->db->select('hos_id,s_id')->from('specialist');
		$this->db->where('hos_id',$hos_id);
		$this->db->where('specialist_name',$s_name);
		return $this->db->get()->row_array();
	}
	
	public  function save_appointment_bidding($data){
		$this->db->insert('appointment_bidding_list',$data);
		return $this->db->insert_id();
		
	}
	public  function save_appointment_user_prescription($data){
		$this->db->insert('appointment_user_prescription',$data);
		return $this->db->insert_id();
		
	}
	public  function get_bidding_appointment_list($a_id){
		$this->db->select('appointment_bidding_list.b_id,appointment_bidding_list.hos_id,appointment_bidding_list.patinet_name,appointment_bidding_list.age,appointment_bidding_list.mobile,appointment_bidding_list.date,appointment_bidding_list.time,appointment_bidding_list.status,appointment_bidding_list.city,treament.t_name as department,specialist.specialist_name,resource_list.resource_name as doctor_name,hospital.hos_bas_name,hospital.hos_bas_add1,hospital.hos_bas_add2,hospital.hos_bas_city,hospital.hos_bas_state,hospital.hos_bas_state,hospital.hos_bas_zipcode')->from('appointment_bidding_list');
		$this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = appointment_bidding_list.doctor_id', 'left');
		$this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
		$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');
		$this->db->where('appointment_bidding_list.create_by',$a_id);
		$this->db->order_by('appointment_bidding_list.b_id','desc');
		$return=$this->db->get()->result_array();
		$couponces=$c_explode='';
		foreach($return as $lis){
			$c_explode='';
			$couponces=$this->get_coupon_codes($lis['hos_id']);
			if(count($couponces)>0){
				$c_coes=array();
				foreach($couponces as $li){
					$c_coes[]=$li['coupon_code'];
				}

				$c_explode=implode(",",$c_coes);
			}else{
				$c_explode='';
			}
			$detail[$lis['b_id']]=$lis;
			$detail[$lis['b_id']]['couponcodes']=$c_explode;

		}
			if(!empty($detail)){
				return $detail;
			}	
	}
	
	public  function get_coupon_codes($hos_id){
		$this->db->select("coupon_code")->from('coupon_codes');
		$this->db->where('hospital_id',$hos_id);
		$this->db->where('status',1);
		$this->db->limit(4);
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
	}
	public  function get_card_number(){
		$this->db->select("card_number")->from('seller_card_assign_munber_list');
		$this->db->order_by('card_id','desc');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	public  function save_card_number_details($data){
		$this->db->insert('seller_card_assign_munber_list',$data);
		return $this->db->insert_id();
	}
	public  function update_card_payment_details($a_u_id,$card_assign_number,$update){
		$this->db->where('a_u_id',$a_u_id);
		$this->db->where('card_id',$card_assign_number);
		return $this->db->update('seller_card_assign_munber_list',$update);
	}
	public function get_bidding_appointment_details($b_id){
		$this->db->select('appointment_bidding_list.*,hospital.hos_bas_name')->from('appointment_bidding_list');
		$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');

		$this->db->where('appointment_bidding_list.b_id',$b_id);
		$this->db->where('appointment_bidding_list.status',1);
		return $this->db->get()->row_array();
	}
	public  function save_appointment($data){
		$this->db->insert('appointments',$data);
		return $this->db->insert_id();
	}
	public  function get_remaining_appointment_list($date,$time,$dep,$spe){
		$this->db->select('*')->from('appointment_bidding_list');
		$this->db->where('date',$date);
		$this->db->where('time',$time);
		$this->db->where('department',$dep);
		$this->db->where('specialist',$spe);
		return $this->db->get()->result_array();
	}
	public  function delete_temp_appointment($b_id){
		$this->db->where('b_id',$b_id);
		return $this->db->delete('appointment_bidding_list');
		
	}
	public  function udate_profile($id,$data){
		$this->db->where('a_u_id',$id);
		return $this->db->update('appointment_users',$data);
		
	}
	public  function get_user_aapointment_list($a_u_id){
		$this->db->select('hospital.hos_bas_name,hospital.hos_bas_add1,hospital.hos_bas_add2,hospital.hos_bas_city,hospital.hos_bas_state,hospital.hos_bas_state,hospital.hos_bas_zipcode,appointments.id,appointments.hos_id,appointments.patinet_name,appointments.age,appointments.mobile,appointments.date,appointments.time,appointments.status,appointments.city,treament.t_name as department,specialist.specialist_name')->from('appointments');
		$this->db->join('hospital', 'hospital.hos_id = appointments.hos_id', 'left');
		$this->db->join('treament', 'treament.t_id = appointments.department', 'left');
		$this->db->join('specialist', 'specialist.s_id = appointments.specialist', 'left');
		$this->db->where('create_by',$a_u_id);
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			$coupon_code = $this->get_hospital_counpon_code($list['hos_id']);
			//echo '<pre>';print_r($coupon_code);exit;
			$data[$list['id']]=$list;
			$data[$list['id']]['coupon_code']=isset($coupon_code)?$coupon_code:'';
			
		}
		if(!empty($data)){
			
			return $data;
		}
		//echo '<pre>';print_r($data);exit;
		
	}
	
	public  function update_appointment_bidding_statu($id,$data){
		$this->db->where('b_id',$id);
		return $this->db->update('appointment_bidding_list',$data);
		
	}
	public  function get_userdetails($a_id){
		$this->db->select('appointment_users.*')->from('appointment_users');
		$this->db->where('a_u_id',$a_id);
		return $this->db->get()->row_array();
	}
	public  function get_hospital_counpon_code($hos_id){
		$this->db->select('coupon_codes.coupon_code')->from('coupon_codes');
		$this->db->where('hospital_id',$hos_id);
		$this->db->where('status',1);
		$this->db->order_by('coupon_codes.id',"desc");
		return $this->db->get()->row_array();
	}
	
	/* check  mobile  number exist*/
	public  function check_mobile_number_exist($mobile){
		$this->db->select('*')->from('seller_card_assign_munber_list');
		$this->db->where('mobile_num',$mobile);
		return $this->db->get()->row_array();
	}
	public  function get_card_details($num){
		$this->db->select('card_number,mobile_num,patient_name as name')->from('seller_card_assign_munber_list');
		$this->db->where('card_id',$num);
		return $this->db->get()->row_array();
	}
	
	public  function get_prescription_list($a_u_id,$hos_id){
		$this->db->select('prescription,created_at')->from('appointment_user_prescription');
		$this->db->where('a_u_id',$a_u_id);
		$this->db->where('hos_id',$hos_id);
		return $this->db->get()->result_array();
	}
	public  function get_user_card_details($a_u_id){
		$this->db->select('seller_card_assign_munber_list.card_number,mobile_num,patient_name as name')->from('seller_card_assign_munber_list');
		$this->db->where('a_u_id',$a_u_id);
		return $this->db->get()->result_array();
	}
	public  function get_mobile_number($a_u_id,$card_assign_number){
		$this->db->select('mobile_num,patient_name')->from('seller_card_assign_munber_list');
		$this->db->where('a_u_id',$a_u_id);
		$this->db->where('card_id',$card_assign_number);
		return $this->db->get()->row_array();
	}
	
	public  function get_user_mobile_details($mobile){
		$this->db->select('card_id,mobile_num')->from('seller_card_assign_munber_list');
		$this->db->where('mobile_num',$mobile);
		return $this->db->get()->row_array();
	}
	public  function update_user_mobile_data($id,$data){
		$this->db->where('card_id',$id);
		return $this->db->update('seller_card_assign_munber_list',$data);
	}
	
	/* card number  unique  purpose*/
	public  function get_mobile_number_details($card_assign_number){
		$this->db->select('card_id,mobile_num,card_number')->from('seller_card_assign_munber_list');
		$this->db->where('card_id',$card_assign_number);
		return $this->db->get()->row_array();
	}
	public  function get_card_number_details($card_num){
		$this->db->select('card_id,mobile_num,card_number')->from('seller_card_assign_munber_list');
		$this->db->where('card_number',$card_num);
		$this->db->where('mobile_verified',1);
		return $this->db->get()->row_array();
	}
	public  function update_card_number($a_u_id,$card_assign_number,$data){
		$this->db->where('card_id',$card_assign_number);
		$this->db->where('a_u_id',$a_u_id);
		return $this->db->update('seller_card_assign_munber_list',$data);
	}
	/* card number  unique  purpose*/
	
	/* docotor  consultation_fee*/
	public  function get_doctors_consultation_fee($a_id){
		$this->db->select('hos_id,a_id,consultation_fee')->from('resource_list');
		$this->db->where('a_id',$a_id) ;
		return $this->db->get()->row_array();	
	}
	/* appointment hospital details purpose*/
	public  function get_hospital_name_details($hos_id){
		$this->db->select('hos_id,hos_bas_name,hos_rep_contact')->from('hospital');
		$this->db->where('hos_id',$hos_id);
		return $this->db->get()->row_array();	
	}
	
	/* wallet amount purpose*/
	public  function get_wallet_amount(){
		$this->db->select('*')->from('wallet_amount');
		$this->db->where('status',1);
		return $this->db->get()->row_array(); 
	}
	public  function get_user_appointment_list($a_u_id){
		$this->db->select('appointment_bidding_list.create_by as a_u_id,appointment_bidding_list.b_id,appointment_bidding_list.hos_id,appointment_bidding_list.city,appointment_bidding_list.patinet_name,appointment_bidding_list.age,appointment_bidding_list.mobile,appointment_bidding_list.date,appointment_bidding_list.time,treament.t_name as department,specialist.specialist_name,resource_list.resource_name as doctorname,resource_list.consultation_fee,hospital.hos_bas_name')->from('appointment_bidding_list');
		$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');
		$this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
		$this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = appointment_bidding_list.doctor_id', 'left');
		$this->db->where('appointment_bidding_list.create_by',$a_u_id);
		return $this->db->get()->result_array();
	}
	public  function get_appointment_details($a_u_id){
		$this->db->select('hospital.hos_bas_name,hospital.hos_id')->from('appointment_bidding_list');
		$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');
		$this->db->where('b_id',$a_u_id);
		return $this->db->get()->row_array();
	}
	public  function check_couponcode_exists_ornot($appointment_id,$hos_id){
		$this->db->select('*')->from('coupon_code_list');
		$this->db->where('appointment_id',$appointment_id);
		$this->db->where('hos_id',$hos_id);
		return $this->db->get()->row_array();
	}
	public  function save_couponcode($data){
		$this->db->insert('coupon_code_list',$data);
		return $this->db->insert_id();
		
	}
	public  function get_coupon_code_details($b_id){
		$this->db->select('couponcode_name,created_at')->from('coupon_code_list');
		$this->db->where('appointment_id',$b_id);
		return $this->db->get()->row_array();
	}
	
	public  function get_wallet_amount_details($a_u_id){
		$this->db->select('wallet_amount,wallet_amount_id,remaining_wallet_amount')->from('appointment_users');
		$this->db->where('a_u_id',$a_u_id);
		return $this->db->get()->row_array();
	}
	
	public  function get_ip_coupon_code_list($a_u_id){
		$this->db->select('coupon_code_list.c_c_l_id,coupon_code_list.couponcode_name,hospital.hos_bas_name,hospital.hos_bas_city,coupon_code_list.created_at')->from('coupon_code_list');
		$this->db->join('hospital', 'hospital.hos_id = coupon_code_list.hos_id', 'left');
		$this->db->where('coupon_code_list.created_by',$a_u_id);
		$this->db->where('coupon_code_list.type',2);
		return $this->db->get()->result_array();
	}
	/* wallet amount purpose*/
	/* ip coupon code list */
	public  function check_ip_couponcode_exists_ornot($hos_id,$coupon_code){
		$this->db->select('*')->from('coupon_code_list');
		$this->db->where('couponcode_name',$coupon_code);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('type',2);
		return $this->db->get()->row_array();
	}
	public function get_hospital_details($hos_id){
		$this->db->select('hospital.hos_bas_name,hospital.hos_id')->from('hospital');
		$this->db->where('hos_id',$hos_id);
		return $this->db->get()->row_array();
	}
	/* ip coupon code list */
	/* lab coupon code list */
	public  function get_lab_coupon_code_list($a_u_id){
		$this->db->select('coupon_code_list.c_c_l_id,coupon_code_list.couponcode_name,hospital.hos_bas_name,hospital.hos_bas_city,coupon_code_list.created_at')->from('coupon_code_list');
		$this->db->join('hospital', 'hospital.hos_id = coupon_code_list.hos_id', 'left');
		$this->db->where('coupon_code_list.created_by',$a_u_id);
		$this->db->where('coupon_code_list.type',3);
		return $this->db->get()->result_array();
	}
	public  function check_lab_couponcode_exists_ornot($hos_id,$coupon_code){
		$this->db->select('*')->from('coupon_code_list');
		$this->db->where('couponcode_name',$coupon_code);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('type',3);
		return $this->db->get()->row_array();
	}
	/* lab coupon code list */
	/* history*/
	public  function get_all_wallet_history($a_u_id){
		$this->db->select('coupon_code_history.type,coupon_code_history.amount,coupon_code_history.coupon_code,coupon_code_history.coupon_code_amount,coupon_code_history.purpose,patients_list_1.name,patients_list_1.mobile,patients_list_1.email,resource_list.resource_name as doctorname,resource_list.consultation_fee,hospital.hos_bas_name,hospital.hos_bas_city,appointments.date,appointments.time')->from('coupon_code_history');
		$this->db->join('patients_list_1', 'patients_list_1.pid = coupon_code_history.p_id', 'left');
		$this->db->join('patient_billing', 'patient_billing.b_id = coupon_code_history.b_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('appointments', 'appointments.patient_id = coupon_code_history.p_id', 'left');
		$this->db->where('appointment_user_id',$a_u_id);
		return $this->db->get()->result_array();
	}
	/* history*/
	public  function get_wallet_amount_percentages($hos_id){
		$this->db->select('*')->from('wallet_amount_percentage');
		$this->db->where('hospital_id',$hos_id);
		//$this->db->where('hos_id',$hos_id);
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
}