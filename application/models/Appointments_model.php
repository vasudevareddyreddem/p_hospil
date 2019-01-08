<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointments_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function save_appointments($data){
		$this->db->insert('appointments',$data);
		return $this->db->insert_id();
	}
	public  function get_hospital_name_details($hos_id){
		$this->db->select('hos_id,hos_bas_name')->from('hospital');
		$this->db->where('hos_id',$hos_id);
		return $this->db->get()->row_array();	
	}
	public  function get_website_appintmenr_list($hos_id){
		$this->db->select('appointments.*,treament.t_name,specialist.specialist_name,resource_list.resource_name')->from('appointments');
		$this->db->join('treament', 'treament.t_id = appointments.department', 'left');
		$this->db->join('specialist', 'specialist.s_id = appointments.specialist', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = appointments.doctor_id', 'left');
		$this->db->where('appointments.hos_id',$hos_id);
		$this->db->where('appointments.status !=',2);
		$this->db->where('appointments.patient_id =',0);
		$this->db->order_by('appointments.id','desc');
		return $this->db->get()->result_array();
	}
public  function get_app_appointment_list($hos_id){
  $this->db->select('appointment_bidding_list.*,appointment_bidding_list.b_id,appointment_bidding_list.status,treament.t_name,specialist.specialist_name,resource_list.resource_name')->from('appointment_bidding_list');
  $this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
  $this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
  $this->db->join('resource_list', 'resource_list.a_id = appointment_bidding_list.doctor_id', 'left');
  $this->db->where('appointment_bidding_list.hos_id',$hos_id);
  $this->db->where('appointment_bidding_list.status',0);
  $this->db->order_by('appointment_bidding_list.b_id','desc');
  return $this->db->get()->result_array();
 }
 public  function get_app_appointment_list_count($hos_id){
  $this->db->select('appointment_bidding_list.*,treament.t_name,specialist.specialist_name')->from('appointment_bidding_list');
  $this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
  $this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
  $this->db->where('appointment_bidding_list.hos_id',$hos_id);
  $this->db->where('appointment_bidding_list.status',0);
  $this->db->order_by('appointment_bidding_list.b_id','desc');
  return $this->db->get()->result_array();
 }
 public  function update_appointment_status_details($b_id,$data){
  $this->db->where('b_id',$b_id);
  return $this->db->update('appointment_bidding_list',$data);
 }
	public  function get_appointment_id_details($b_id){
		$this->db->select('*')->from('appointment_bidding_list');
		$this->db->where('b_id',$b_id);
		return $this->db->get()->row_array();
	}
	public  function get_appointment_user_details($b_id){
		$this->db->select('appointment_bidding_list.*,appointment_users.name,appointment_users.token,hospital.hos_bas_name')->from('appointment_bidding_list');
		$this->db->join('appointment_users', 'appointment_users.a_u_id = appointment_bidding_list.create_by', 'left');
		$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');
		$this->db->where('appointment_bidding_list.b_id',$b_id);
		return $this->db->get()->row_array();
	}
	public  function get_hospital_counpon_code($hos_id){
		$this->db->select('coupon_codes.coupon_code')->from('coupon_codes');
		$this->db->where('hospital_id',$hos_id);
		$this->db->where('status',1);
		$this->db->order_by('coupon_codes.id',"desc");
		return $this->db->get()->row_array();
	}
	public  function get_appoinment_hospital_details($hos_id){
		$this->db->select('hospital.hos_rep_contact,hospital.hos_bas_email,hospital.hos_bas_name')->from('hospital');
		$this->db->where('hos_id',$hos_id);
		return $this->db->get()->row_array();
	}
	public  function get_apapointment_user_email($u_id){
		$this->db->select('*')->from('appointment_users');
		$this->db->where('a_u_id',$u_id);
		return $this->db->get()->row_array();
		
	}
	public function update_app_reason($b_id,$data){
		$this->db->where('b_id',$b_id);
		return $this->db->update('appointment_bidding_list',$data);
	
	}
public function update_app_acept_data($b_id,$data){
$this->db->where('b_id',$b_id);
return $this->db->update('appointment_bidding_list',$data);	
	
	
}



}