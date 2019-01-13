<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nurse_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public  function get_admited_patient_list($hos_id){
		$this->db->select('admitted_patient_list.a_p_id,admitted_patient_list.pt_id,admitted_patient_list.bill_id,admitted_patient_list.date_of_admit,patients_list_1.name,patients_list_1.mobile,patients_list_1.email,patients_list_1.gender,patients_list_1.age,treament.t_name,specialist.specialist_name,resource_list.resource_name')->from('admitted_patient_list');
		$this->db->join('patients_list_1', 'patients_list_1.pid = admitted_patient_list.pt_id', 'left');
		$this->db->join('patient_billing', 'patient_billing.b_id = admitted_patient_list.bill_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('specialist', 'specialist.s_id = patient_billing.specialist_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->where('admitted_patient_list.hos_id',$hos_id);
		$this->db->where('admitted_patient_list.completed',0);
		return $this->db->get()->result_array();
		
	}
	
	public  function save_transfor_patinet($data){
		$this->db->insert('transfor_patient_list',$data);
		return $this->db->insert_id();
		
	}
	public  function check_trsfor_patient_exist_ornot($t_p_id,$hos_id){
		$this->db->select('*')->from('transfor_patient_list');
		$this->db->where('previous_bed_id',$t_p_id);
		$this->db->where('hos_id',$hos_id);
		return $this->db->get()->row_array();
		
	}
	public  function update_transfor_patinet($t_p_id,$hos_id,$data){
		$this->db->where('previous_bed_id',$t_p_id);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('status',0);
		return $this->db->update('transfor_patient_list',$data);
		
	}
	public function get_transfor_patient_list($hos_id){
		$this->db->select('transfor_patient_list.previous_bed_id,transfor_patient_list.pt_id,patients_list_1.name,ward_name.ward_name,ward_type.ward_type,ward_room_type.room_type,ward_floors.ward_floor,ward_room_number.room_num,ward_room_beds.bed,transfor_patient_list.status')->from('transfor_patient_list');				
		$this->db->join('patients_list_1', 'patients_list_1.pid = transfor_patient_list.pt_id', 'left');
		$this->db->join('ward_name', 'ward_name.w_id = transfor_patient_list.w_name', 'left');
		$this->db->join('ward_type', 'ward_type.ward_id = transfor_patient_list.w_type', 'left');
		$this->db->join('ward_room_type', 'ward_room_type.w_r_t_id = transfor_patient_list.room_type', 'left');
		$this->db->join('ward_floors', 'ward_floors.w_f_id = transfor_patient_list.floor_no', 'left');
		$this->db->join('ward_room_number', 'ward_room_number.w_r_n_id = transfor_patient_list.room_no', 'left');
		$this->db->join('ward_room_beds', 'ward_room_beds.r_b_id = transfor_patient_list.bed_no', 'left');
		$this->db->where('transfor_patient_list.hos_id',$hos_id);
		return $this->db->get()->result_array();
	}
	public function get_admitted_patient_list($hos_id){
		$this->db->select('patients_list_1.pid,patient_billing.b_id,patients_list_1.card_number,patients_list_1.gender,patients_list_1.problem,patients_list_1.name,patients_list_1.registrationtype,patients_list_1.age,patients_list_1.mobile,patient_billing.create_at,resource_list.resource_name,resource_list.a_id,treament.t_name,admitted_patient_list.a_p_id,admitted_patient_list.pt_id,patients_list_1.name,ward_name.ward_name,ward_type.ward_type,ward_room_type.room_type,ward_floors.ward_floor,ward_room_number.room_num,ward_room_beds.bed,admitted_patient_list.date_of_admit,admitted_patient_list.status')->from('admitted_patient_list');				
		$this->db->join('patients_list_1', 'patients_list_1.pid = admitted_patient_list.pt_id', 'left');
		$this->db->join('patient_billing', 'patient_billing.b_id = admitted_patient_list.bill_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('ward_name', 'ward_name.w_id = admitted_patient_list.w_name', 'left');
		$this->db->join('ward_type', 'ward_type.ward_id = admitted_patient_list.w_type', 'left');
		$this->db->join('ward_room_type', 'ward_room_type.w_r_t_id = admitted_patient_list.room_type', 'left');
		$this->db->join('ward_floors', 'ward_floors.w_f_id = admitted_patient_list.floor_no', 'left');
		$this->db->join('ward_room_number', 'ward_room_number.w_r_n_id = admitted_patient_list.room_no', 'left');
		$this->db->join('ward_room_beds', 'ward_room_beds.r_b_id = admitted_patient_list.bed_no', 'left');
		$this->db->where('admitted_patient_list.hos_id',$hos_id);
		$this->db->where('admitted_patient_list.completed',0);
		return $this->db->get()->result_array();
	}
	public function get_discharged_patient_list($hos_id){
		$this->db->select('patients_list_1.pid,patient_billing.b_id,patients_list_1.card_number,patients_list_1.gender,patients_list_1.problem,patients_list_1.name,patients_list_1.registrationtype,patients_list_1.age,patients_list_1.mobile,patient_billing.create_at,resource_list.resource_name,resource_list.a_id,treament.t_name,admitted_patient_list.a_p_id,admitted_patient_list.pt_id,patients_list_1.name,ward_name.ward_name,ward_type.ward_type,ward_room_type.room_type,ward_floors.ward_floor,ward_room_number.room_num,ward_room_beds.bed,admitted_patient_list.date_of_admit,admitted_patient_list.status,admitted_patient_list.discharge_date')->from('admitted_patient_list');				
		$this->db->join('patients_list_1', 'patients_list_1.pid = admitted_patient_list.pt_id', 'left');
		$this->db->join('patient_billing', 'patient_billing.b_id = admitted_patient_list.bill_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('ward_name', 'ward_name.w_id = admitted_patient_list.w_name', 'left');
		$this->db->join('ward_type', 'ward_type.ward_id = admitted_patient_list.w_type', 'left');
		$this->db->join('ward_room_type', 'ward_room_type.w_r_t_id = admitted_patient_list.room_type', 'left');
		$this->db->join('ward_floors', 'ward_floors.w_f_id = admitted_patient_list.floor_no', 'left');
		$this->db->join('ward_room_number', 'ward_room_number.w_r_n_id = admitted_patient_list.room_no', 'left');
		$this->db->join('ward_room_beds', 'ward_room_beds.r_b_id = admitted_patient_list.bed_no', 'left');
		$this->db->where('admitted_patient_list.hos_id',$hos_id);
		$this->db->where('admitted_patient_list.completed',1);
		return $this->db->get()->result_array();
	}
	
	public function update_admitted_patient_details($a_p_id,$data){
		$this->db->where('a_p_id',$a_p_id);
		return $this->db->update("admitted_patient_list",$data);
	}
	
	/* get patient  Midical list */
	public  function get_patient_medicine_list_details($p_id,$b_id){
		$this->db->select('medicine_name,medicine_type,no_of_days,qty,create_at,date')->from('patient_medicine_list');
		$this->db->where('patient_medicine_list.p_id',$p_id);
		$this->db->where('patient_medicine_list.b_id',$b_id);
		return $this->db->get()->result_array();
	}
	public  function get_patient_lab_test_list_details($p_id,$b_id){
		$this->db->select('patient_lab_reports.image,patient_lab_test_list.create_at,patient_lab_reports.problem,patient_lab_reports.symptoms,patients_list_1.name,patients_list_1.mobile,patients_list_1.email,patient_lab_test_list.id,patient_lab_test_list.p_id,patient_lab_test_list.b_id,lab_test_list.t_name,lab_test_list.test_type')->from('patient_lab_test_list');
		$this->db->join('patient_lab_reports', 'patient_lab_reports.l_t_id = patient_lab_test_list.id', 'left');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_test_list.test_id', 'left');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_lab_test_list.p_id', 'left');
		$this->db->where('patient_lab_test_list.p_id',$p_id);
		$this->db->where('patient_lab_test_list.b_id',$b_id);
		return $this->db->get()->result_array();
	}
	
}

	
