<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ward_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public  function get_ip_patient_list($hos_id){
		$this->db->select('patients_list_1.pid,patient_billing.b_id,patients_list_1.card_number,patients_list_1.gender,patients_list_1.problem,patients_list_1.name,patients_list_1.registrationtype,patients_list_1.age,patients_list_1.mobile,patient_billing.create_at,resource_list.resource_name,resource_list.a_id,treament.t_name')->from('patient_billing');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('admitted_patient_list', 'admitted_patient_list.pt_id = patient_billing.p_id', 'left');
		$this->db->where('patient_billing.patient_type',1);
		$this->db->where('patients_list_1.hos_id',$hos_id);	
		$this->db->where('patient_billing.completed_type',0);
		//$this->db->where('admitted_patient_list.pt_id','NULL');
		return $this->db->get()->result_array();
	}
		
	public  function get_saved_ip_patient_list($pid,$hos_id){
		$this->db->select('*')->from('patient_billing');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->where('patients_list_1.pid',$pid);
		$this->db->where('patients_list_1.hos_id',$hos_id);		
		$this->db->where('patient_billing.patient_type',1);
		$this->db->where('patient_billing.completed_type',0);
		return $this->db->get()->row_array();
	}
	public function save_wardname($data){
		$this->db->insert('ward_name', $data);
		return $insert_id = $this->db->insert_id();
	}
	
	public function get_saved_wardname($name,$hos_id){
		$this->db->select('*')->from('ward_name');		
		$this->db->where('ward_name',$name);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('ward_name.status !=',2);
		return $this->db->get()->row_array();
	}

	public function get_ward_list($a_id,$hos_id){
		$this->db->select('ward_name.w_id,ward_name.ward_name,ward_name.status,ward_name.create_at')->from('ward_name');				
		$this->db->where('ward_name.created_by',$a_id);
		$this->db->where('ward_name.hos_id',$hos_id);
		$this->db->where('ward_name.status !=',2);
		return $this->db->get()->result_array();
	}
	
	public function get_ward_list_details($hos_id){
		$this->db->select('ward_name.w_id,ward_name.ward_name,ward_name.status,ward_name.create_at')->from('ward_name');						
		$this->db->where('ward_name.hos_id',$hos_id);
		$this->db->where('ward_name.status !=',2);
		return $this->db->get()->result_array();
	}
	
	public function get_ward_details($w_id){
		$this->db->select('*')->from('ward_name');		
		$this->db->where('w_id',$w_id);
		return $this->db->get()->row_array();
	}
	
	public function update_ward_details($w_id,$data){
		$this->db->where('w_id',$w_id);
		return $this->db->update("ward_name",$data);
	}

	public function get_hospital_id($a_id,$email){
		$this->db->select('hospital.a_id,hospital.hos_id')->from('hospital');		
		$this->db->where('a_id',$a_id);
		$this->db->where('hos_email_id',$email);
        return $this->db->get()->row_array();
	}
	
	public function get_resources_hospital_id($a_id,$email){
		$this->db->select('resource_list.a_id,resource_list.hos_id')->from('resource_list');		
		$this->db->where('a_id',$a_id);
		$this->db->where('resource_email',$email);
        return $this->db->get()->row_array();
	}
	
	public  function get_hospital_id_details($hos_id){
		$this->db->select('hospital.a_id')->from('hospital');		
		$this->db->where('hospital.hos_id', $hos_id);
        return $this->db->get()->row_array();
	}
	 
	public function save_wardtype($data){
		$this->db->insert('ward_type',$data);
		return $insert_id = $this->db->insert_id();
	}
	
	public function get_saved_wardtype($wid,$name,$hos_id){
		$this->db->select('*')->from('ward_type');
		$this->db->where('wid',$wid);
		$this->db->where('ward_type',$name);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('ward_type.status !=',2);
		return $this->db->get()->row_array();
	}
	
	public function get_wardtype_list($a_id,$hos_id){
		$this->db->select('ward_type.ward_id,ward_type.wid,ward_name.ward_name,ward_type.ward_type,ward_type.status,ward_type.create_at')->from('ward_type');		
		$this->db->join('ward_name', 'ward_name.w_id = ward_type.wid', 'left');
		$this->db->where('ward_type.created_by',$a_id);
		$this->db->where('ward_type.hos_id',$hos_id);
		$this->db->where('ward_type.status !=',2);
		return $this->db->get()->result_array();
	}
	
	public function get_wardtype_list_details($hos_id){
		$this->db->select('ward_type.ward_id,ward_type.ward_type,ward_type.status,ward_type.create_at')->from('ward_type');				
		$this->db->where('ward_type.hos_id',$hos_id);
		$this->db->where('ward_type.status !=',2);
		return $this->db->get()->result_array();
	}
	
	public function get_wardtype_details($ward_id){
		$this->db->select('*')->from('ward_type');		
		$this->db->where('ward_id',$ward_id);
		return $this->db->get()->row_array();
	}
	
	public function update_wardtype_details($ward_id,$data){
		$this->db->where('ward_id',$ward_id);
		return $this->db->update("ward_type",$data);
	}
	
	public function floornumber($data){
		$this->db->insert('ward_floors',$data);
		return $insert_id = $this->db->insert_id();
	}
	
	public function get_saved_floor($w_r_type_id,$name,$hos_id){
		$this->db->select('*')->from('ward_floors');		
		$this->db->where('w_r_type_id',$w_r_type_id);
		$this->db->where('ward_floor',$name);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('ward_floors.status !=',2);
		return $this->db->get()->row_array();
	}
	
	public function get_floor_list($a_id,$hos_id){
		$this->db->select('ward_floors.w_f_id,ward_floors.w_r_type_id,ward_room_type.room_type,ward_floors.ward_floor,ward_floors.status,ward_floors.create_at')->from('ward_floors');		
		$this->db->join('ward_room_type', 'ward_room_type.w_r_t_id = ward_floors.w_r_type_id', 'left');
		$this->db->where('ward_floors.created_by',$a_id);
		$this->db->where('ward_floors.hos_id',$hos_id);
		$this->db->where('ward_floors.status !=',2);
		return $this->db->get()->result_array();
	}
	
	public function get_floor_list_details($hos_id){
		$this->db->select('ward_floors.w_f_id,ward_floors.ward_floor,ward_floors.status,ward_floors.create_at')->from('ward_floors');			
		$this->db->where('ward_floors.hos_id',$hos_id);
		$this->db->where('ward_floors.status !=',2);
		return $this->db->get()->result_array();
	}
	
	public function get_floor_details($w_f_id){
		$this->db->select('*')->from('ward_floors');		
		$this->db->where('w_f_id',$w_f_id);
		return $this->db->get()->row_array();
	}
	
	public function update_floor_details($w_f_id,$data){
		$this->db->where('w_f_id',$w_f_id);
		return $this->db->update("ward_floors",$data);
	}
	
	public function roomtype($data){
		$this->db->insert('ward_room_type',$data);
		return $insert_id = $this->db->insert_id();
	}
	
	public function get_saved_roomtype($w_type_id,$name,$hos_id){
		$this->db->select('*')->from('ward_room_type');		
		$this->db->where('w_type_id',$w_type_id);
		$this->db->where('room_type',$name);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('ward_room_type.status !=',2);
		return $this->db->get()->row_array();
	}
	
	public function get_roomtype_list($a_id,$hos_id){
		$this->db->select('ward_room_type.w_r_t_id,ward_room_type.w_type_id,ward_type.ward_type,ward_room_type.room_type,ward_room_type.status,ward_room_type.create_at')->from('ward_room_type');		
		$this->db->join('ward_type', 'ward_type.ward_id = ward_room_type.w_type_id', 'left');
		$this->db->where('ward_room_type.created_by',$a_id);
		$this->db->where('ward_room_type.hos_id',$hos_id);
		$this->db->where('ward_room_type.status !=',2);
		return $this->db->get()->result_array();
	}
	
	public function get_roomtype_list_details($hos_id){
		$this->db->select('ward_room_type.w_r_t_id,ward_room_type.room_type,ward_room_type.status,ward_room_type.create_at')->from('ward_room_type');			
		$this->db->where('ward_room_type.hos_id',$hos_id);
		$this->db->where('ward_room_type.status !=',2);
		return $this->db->get()->result_array();
	}
		
	public function get_roomtype_details($w_r_t_id){
		$this->db->select('*')->from('ward_room_type');		
		$this->db->where('w_r_t_id',$w_r_t_id);
		return $this->db->get()->row_array();
	}

	public function update_roomtype_details($w_r_t_id,$data){
		$this->db->where('w_r_t_id',$w_r_t_id);
		return $this->db->update("ward_room_type",$data);
	}
	
	public function roomnumber($data){
		$this->db->insert('ward_room_number',$data);
		return $this->db->insert_id();
	}
	
	public function get_saved_roomnumber($f_id,$name,$hos_id){
		$this->db->select('*')->from('ward_room_number');		
		$this->db->where('room_num',$name);
		$this->db->where('f_id',$f_id);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('ward_room_number.status !=',2);
		return $this->db->get()->row_array();
	}
	
	public function get_roomnumber_list($a_id,$hos_id){
		$this->db->select('ward_room_number.*,ward_floors.ward_floor')->from('ward_room_number');
		$this->db->join('ward_floors','ward_floors.w_f_id=ward_room_number.f_id','left');
		$this->db->where('ward_room_number.created_by',$a_id);
		$this->db->where('ward_room_number.hos_id',$hos_id);
		$this->db->where('ward_room_number.status !=',2);
		return $this->db->get()->result_array();
	}
		
	public function get_roomnumber_list_details($hos_id){
		$this->db->select('ward_room_number.*,ward_floors.ward_floor')->from('ward_room_number');
		$this->db->join('ward_floors','ward_floors.w_f_id=ward_room_number.f_id','left');				
		$this->db->where('ward_room_number.hos_id',$hos_id);
		$this->db->where('ward_room_number.status !=',2);
		return $this->db->get()->result_array();
	}	
		
	public function get_roomnumber_list_detailss($f_id,$hos_id){
		$this->db->select('ward_room_number.*,ward_floors.ward_floor')->from('ward_room_number');
		$this->db->join('ward_floors','ward_floors.w_f_id=ward_room_number.f_id','left');		
		$this->db->where('ward_room_number.f_id',$f_id);
		$this->db->where('ward_room_number.hos_id',$hos_id);
		$this->db->where('ward_room_number.status !=',2);
		return $this->db->get()->result_array();
	}
	
	public function get_roomnumber_details($w_r_n_id){
		$this->db->select('*')->from('ward_room_number');		
		$this->db->where('w_r_n_id',$w_r_n_id);
		return $this->db->get()->row_array();
	}	
	
	public function update_roomnumber_details($w_r_n_id,$data){
		$this->db->where('w_r_n_id',$w_r_n_id);
		return $this->db->update("ward_room_number",$data);
	}

	public function bednumber($data){
		$this->db->insert('ward_room_beds',$data);
		return $insert_id = $this->db->insert_id();
	}
	
	public function get_saved_bednumber($name,$hos_id){
		$this->db->select('*')->from('ward_room_beds');		
		$this->db->where('bed',$name);
		$this->db->where('hos_id',$hos_id);
		return $this->db->get()->row_array();
	}
	
	public function get_bednumber_details($r_b_id){
		$this->db->select('*')->from('ward_room_beds');		
		$this->db->where('r_b_id',$r_b_id);
		return $this->db->get()->row_array();
	}
	
	public function get_bed_list_details($w_r_n_id,$hos_id){
		$this->db->select('ward_room_beds.r_b_id,ward_room_beds.w_r_n_id,ward_room_beds.bed,ward_room_beds.status,ward_room_beds.create_at')->from('ward_room_beds');			
		$this->db->where('ward_room_beds.w_r_n_id',$w_r_n_id);
		$this->db->where('ward_room_beds.hos_id',$hos_id);
		$this->db->where('ward_room_beds.status !=',2);
		return $this->db->get()->result_array();
	}	
	
	public function update_bednumber_details($w_r_n_id,$data){
		$this->db->where('w_r_n_id',$w_r_n_id);
		return $this->db->update("ward_room_beds",$data);
	}
	
	public  function get_room_number_wise_beds_list($w_r_n_id){
		$this->db->select('*')->from('ward_room_beds');		
		$this->db->where('w_r_n_id',$w_r_n_id);
		return $this->db->get()->result_array();
	}
	
	public  function update_room_wise_beds_list($r_b_id,$data){
		$this->db->where('r_b_id',$r_b_id);
		return $this->db->update("ward_room_beds",$data);
	}
	
	public function get_f_id_wise_roomno_list($f_id){
		$this->db->select('ward_room_number.w_r_n_id,ward_room_number.room_num')->from('ward_room_number');		
		$this->db->where('f_id',$f_id);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	
	public function get_w_r_n_id_wise_bedcount($w_r_n_id){
		$this->db->select('ward_room_beds.r_b_id,ward_room_beds.bed,admitted_patient_list.a_p_id,admitted_patient_list.completed')->from('ward_room_beds');	
		$this->db->join('admitted_patient_list','admitted_patient_list.bed_no=ward_room_beds.r_b_id','left');				
		
		$this->db->where('ward_room_beds.w_r_n_id',$w_r_n_id);
		$this->db->where('ward_room_beds.status',1);
		//$this->db->where('admitted_patient_list.completed',0);
		return $this->db->get()->result_array();
	}
	
	public function admitted_patients($data){
		$this->db->insert('admitted_patient_list',$data);
		return $insert_id = $this->db->insert_id();
	}
	
	public function get_saved_admitted_patients($name,$hos_id){
		$this->db->select('*')->from('admitted_patient_list');		
		$this->db->where('p_name',$name);
		$this->db->where('hos_id',$hos_id);
		return $this->db->get()->row_array();
	}
	
	public function get_admitted_patients_details($a_p_id){
		$this->db->select('*')->from('admitted_patient_list');		
		$this->db->where('a_p_id',$a_p_id);
		return $this->db->get()->row_array();
	}
	
	public function get_admitted_patient_list($hos_id){
		$this->db->select('admitted_patient_list.a_p_id,admitted_patient_list.pt_id,patients_list_1.name,ward_name.ward_name,ward_type.ward_type,ward_room_type.room_type,ward_floors.ward_floor,ward_room_number.room_num,ward_room_beds.bed,admitted_patient_list.date_of_admit,admitted_patient_list.status')->from('admitted_patient_list');				
		$this->db->join('patients_list_1', 'patients_list_1.pid = admitted_patient_list.pt_id', 'left');
		$this->db->join('ward_name', 'ward_name.w_id = admitted_patient_list.w_name', 'left');
		$this->db->join('ward_type', 'ward_type.ward_id = admitted_patient_list.w_type', 'left');
		$this->db->join('ward_room_type', 'ward_room_type.w_r_t_id = admitted_patient_list.room_type', 'left');
		$this->db->join('ward_floors', 'ward_floors.w_f_id = admitted_patient_list.floor_no', 'left');
		$this->db->join('ward_room_number', 'ward_room_number.w_r_n_id = admitted_patient_list.room_no', 'left');
		$this->db->join('ward_room_beds', 'ward_room_beds.r_b_id = admitted_patient_list.bed_no', 'left');
		$this->db->where('admitted_patient_list.hos_id',$hos_id);
		$this->db->where('admitted_patient_list.status !=',2);
		return $this->db->get()->result_array();
	}
	
	public function get_discharge_patient_list($hos_id){
		$this->db->select('admitted_patient_list.a_p_id,admitted_patient_list.pt_id,patients_list_1.name,patients_list_1.mobile,resource_list.resource_name,patient_billing.create_at,admitted_patient_list.status')->from('admitted_patient_list');				
		$this->db->join('patients_list_1', 'patients_list_1.pid = admitted_patient_list.pt_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admitted_patient_list.d_id', 'left');
		$this->db->join('patient_billing', 'patient_billing.p_id = admitted_patient_list.pt_id', 'left');
		$this->db->where('admitted_patient_list.hos_id',$hos_id);
		$this->db->where('admitted_patient_list.status !=',2);
		$this->db->where('admitted_patient_list.completed',0);
		return $this->db->get()->result_array();
	}
	public function get_admited_discharge_patient_list($hos_id){
		$this->db->select('admitted_patient_list.a_p_id,admitted_patient_list.pt_id,admitted_patient_list.bill_id,patients_list_1.name,patients_list_1.mobile,resource_list.resource_name,patient_billing.create_at,admitted_patient_list.status')->from('admitted_patient_list');				
		$this->db->join('patients_list_1', 'patients_list_1.pid = admitted_patient_list.pt_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admitted_patient_list.d_id', 'left');
		$this->db->join('patient_billing', 'patient_billing.p_id = admitted_patient_list.pt_id', 'left');
		$this->db->where('admitted_patient_list.hos_id',$hos_id);
		$this->db->where('admitted_patient_list.status !=',2);
		$this->db->where('admitted_patient_list.completed',0);
		return $this->db->get()->result_array();
	}

	public function get_discharge_patient_history($hos_id){
		$this->db->select('admitted_patient_list.a_p_id,admitted_patient_list.pt_id,admitted_patient_list.bill_id,patients_list_1.card_number,patients_list_1.name,resource_list.resource_name,treament.t_name,patients_list_1.mobile,admitted_patient_list.date_of_admit,admitted_patient_list.discharge_date,admitted_patient_list.amount_status')->from('admitted_patient_list');				
		$this->db->join('patients_list_1', 'patients_list_1.pid = admitted_patient_list.pt_id', 'left');
		$this->db->join('patient_billing', 'patient_billing.p_id = admitted_patient_list.pt_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admitted_patient_list.d_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->group_by('admitted_patient_list.a_p_id');
		$this->db->where('admitted_patient_list.hos_id',$hos_id);
		$this->db->where('admitted_patient_list.completed',1);
		return $this->db->get()->result_array();
	}
	
	public function update_discharge_patient_list($a_p_id,$data){
		$this->db->where('a_p_id',$a_p_id);
		return $this->db->update("admitted_patient_list",$data);
	}
	
	public function update_admitted_patient_details($a_p_id,$data){
		$this->db->where('a_p_id',$a_p_id);
		return $this->db->update("admitted_patient_list",$data);
	}
	
	
	/* bed  chart  purpose */
	public  function get_bed_empty_list_count($hos_id){
		$this->db->select('ward_room_beds.w_r_n_id,ward_room_number.room_num,ward_room_number.bed_count,ward_floors.ward_floor,ward_room_type.room_type,ward_type.ward_type,ward_name.ward_name')->from('ward_room_beds');
		$this->db->join('ward_room_number','ward_room_number.w_r_n_id=ward_room_beds.w_r_n_id','left');				
		$this->db->join('ward_floors','ward_floors.w_f_id=ward_room_number.f_id','left');				
		$this->db->join('ward_room_type','ward_room_type.w_r_t_id=ward_floors.w_r_type_id','left');				
		$this->db->join('ward_type','ward_type.ward_id=ward_room_type.w_r_t_id','left');				
		$this->db->join('ward_name','ward_name.w_id=ward_type.wid','left');				
		
		$this->db->where('ward_room_beds.hos_id',$hos_id);
		$this->db->where('ward_room_beds.status',1);
		$this->db->group_by('ward_room_beds.w_r_n_id');
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			$beds_nums=$this->get_bed_numbers_list($list['w_r_n_id']);
			$data[$list['w_r_n_id']]=$list;
			$data[$list['w_r_n_id']]['bed_num']=isset($beds_nums)?$beds_nums:'';
			
		}
		if(!empty($data)){
			return $data;
		}
	}
	public  function get_bed_numbers_list($w_r_n_id){
		$this->db->select('ward_room_beds.r_b_id,ward_room_beds.w_r_n_id,ward_room_beds.bed,admitted_patient_list.pt_id,admitted_patient_list.completed')->from('ward_room_beds');
		$this->db->join('admitted_patient_list','admitted_patient_list.bed_no=ward_room_beds.r_b_id','left');				
		$this->db->where('ward_room_beds.w_r_n_id',$w_r_n_id);
		$this->db->where('ward_room_beds.status',1);
		return $this->db->get()->result_array();
	}
	
}

	
