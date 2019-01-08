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
	public  function save_appointment_user($data){
		$this->db->insert('appointment_users',$data);
		return $this->db->insert_id();
		
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
		$this->db->where('hos_bas_city!=','') ;
		$this->db->group_by('hospital.hos_bas_city') ;
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
	public  function get_hospital_department_list($city){
		$this->db->select('treament.t_name as department_name')->from('hospital');
		$this->db->join('treament', 'treament.hos_id = hospital.hos_id', 'left');
		$this->db->where('hospital.hos_bas_city',$city);
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
	public  function get_hospital_department_specialist_list($department,$city){
		$this->db->select('treament.t_name,treament.t_id')->from('treament');
		$this->db->join('specialist', 'specialist.hos_id = treament.hos_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = treament.hos_id', 'left');
		$this->db->where('treament.t_name',$department);
		$this->db->where('hospital.hos_bas_city',$city);
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
	
	
	public function get_specilist_names_list($t_id){
		$this->db->select('specialist.specialist_name')->from('specialist');
		$this->db->group_by('specialist.s_id');
		$this->db->where('specialist.d_id',$t_id);
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
	public  function get_hospital_specialist_doctors_list($s_id){
		$this->db->select('resource_list.a_id,resource_list.resource_name')->from('treatmentwise_doctors');		
		$this->db->join('resource_list', 'resource_list.a_id = treatmentwise_doctors.t_d_doc_id', 'left');
		$this->db->where('treatmentwise_doctors.s_id',$s_id);
		$this->db->where('resource_list.r_status',1);
        return $this->db->get()->result_array();
	}
	
	public  function get_appointment_user_details($a_u_id){
		$this->db->select('name,email,mobile,a_u_id,token')->from('appointment_users');
		$this->db->where('a_u_id',$a_u_id);
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
	
	public  function appointment_bidding_list($data){
		$this->db->insert('appointment_bidding_list',$data);
		return $this->db->insert_id();
		
	}
	public  function get_bidding_appointment_list($a_id){
		$this->db->select('appointment_bidding_list.b_id,appointment_bidding_list.hos_id,appointment_bidding_list.patinet_name,appointment_bidding_list.age,appointment_bidding_list.mobile,appointment_bidding_list.date,appointment_bidding_list.time,appointment_bidding_list.status,appointment_bidding_list.city,treament.t_name as department,specialist.specialist_name,hospital.hos_bas_name,hospital.hos_bas_add1,hospital.hos_bas_add2,hospital.hos_bas_city,hospital.hos_bas_state,hospital.hos_bas_state,hospital.hos_bas_zipcode')->from('appointment_bidding_list');
		$this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
		$this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
		$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');

		$this->db->where('appointment_bidding_list.create_by',$a_id);
		$this->db->order_by('appointment_bidding_list.b_id','desc');
		return $this->db->get()->result_array();	
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
	
}