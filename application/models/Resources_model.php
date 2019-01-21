<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resources_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function get_all_patients_database($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,patients_list_1.mobile,patients_list_1.age,patients_list_1.hos_id,patients_list_1.registrationtype,patients_list_1.patient_category,patients_list_1.dob,patients_list_1.nationali_id,patients_list_1.create_at')->from('patients_list_1');		
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->order_by('patients_list_1.pid', "DESC");
        return $this->db->get()->result_array();	
	}
	
	public  function get_patient_previous_alternate_medicine_details_list($pid){
		$this->db->select('sheet_prescription_file')->from('patient_billing');		
		$this->db->where('patient_billing.p_id', $pid);
		$this->db->where('sheet_prescription_file !=', '');
        return $this->db->get()->result_array();	
	}
	public function get_all_patients_lists($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,patients_list_1.mobile,patients_list_1.age,patients_list_1.hos_id,patients_list_1.registrationtype,patients_list_1.patient_category')->from('patients_list_1');		
		$this->db->where('patients_list_1.hos_id', $hos_id);
        return $this->db->get()->result_array();	
	}
	public function get_all_reschedule_patients_lists($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,patients_list_1.mobile,patients_list_1.age,patients_list_1.hos_id,hospital.reschedule_date,patients_list_1.registrationtype,patients_list_1.patient_category')->from('patients_list_1');		
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->order_by('patients_list_1.pid', "DESC");
        $return=$this->db->get()->result_array();	
		foreach($return as $Lis){
							$dat=$this->get_lastest_billing_id($Lis['pid']);
						$current=date('Y-m-d H:i:s');
						$date1=date_create($dat['create_at']);
						$date2=date_create($current);
						$diff=date_diff($date1,$date2);
						$now_date=$diff->format("%a");
						if($now_date<=$Lis['reschedule_date']){
							$reschedule=1;
						}else{
							$reschedule=0;
						}
				$data[$Lis['pid']]=$Lis;
				$data[$Lis['pid']]['patient_reschedule_date']=$reschedule;
		}
		if(!empty($data))
		{
		return $data;
		}
	}
	
	public function get_lastest_billing_id($p_id){
		$this->db->select('patient_billing.b_id,patient_billing.create_at')->from('patient_billing');		
		$this->db->where('patient_billing.p_id',$p_id);
		$this->db->order_by("patient_billing.b_id",'DESC');
		$this->db->limit(1);
        return $this->db->get()->row_array();
	}
	public function get_all_reschedule_patients_lists_back($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,patients_list_1.mobile,patients_list_1.age,patients_list_1.hos_id,hospital.reschedule_date,patients_list_1.registrationtype,patients_list_1.patient_category,patients_list_1.create_at')->from('patients_list_1');		
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
        return $this->db->get()->result_array();	
	}
	public function get_all_resouce_details($admin_id){
		$this->db->select('resource_list.r_id,resource_list.hos_id,admin.a_id,admin.role_id,admin.a_email_id,admin.a_name,roles.r_name,admin.a_profile_pic,resource_list.out_source_lab')->from('admin');		
		$this->db->join('roles', 'roles.r_id = admin.role_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admin.a_id', 'left');
		$this->db->where('admin.a_id', $admin_id);
		$this->db->where('admin.a_status', 1);
        return $this->db->get()->row_array();	
	}
	public function save_basic_details($data){
		$this->db->insert('patients_list_1', $data);
		return $insert_id = $this->db->insert_id();
	}
	
	public  function update_patient_medicine_details($pid,$bid,$data){
		$this->db->where('p_id',$pid);
		$this->db->where('b_id',$bid);
		return $this->db->update('patient_billing',$data);
		
	}
	
	public function update_patient_details($p_id,$barcode){
		$sql1="UPDATE patients_list_1 SET barcode ='".$barcode."' WHERE pid = '".$p_id."'";
       	return $this->db->query($sql1);
	}
	public function update_all_patient_details($pid,$data){
		$this->db->where('pid',$pid);
    	return $this->db->update("patients_list_1",$data);
	}
	public function get_details_details($pid){
		$this->db->select('*')->from('patients_list_1');		
		$this->db->where('pid',$pid);
        return $this->db->get()->row_array();
	}
	public function get_paitent_document($pid){
		$this->db->select('patients_list_1.patient_identifier')->from('patients_list_1');		
		$this->db->where('pid',$pid);
        return $this->db->get()->row_array();
	}
	
	/*patient billing details*/
	public function update_all_patient_billing_details($data){
		$this->db->insert('patient_billing', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function update_patient_billing_details($bid,$data){
		$this->db->where('b_id',$bid);
    	return $this->db->update("patient_billing",$data);
	}
	public function get_hospital_deportments($hop_id){
		$this->db->select('treament.t_id,treament.t_name')->from('treament');		
		$this->db->where('hos_id',$hop_id);
		$this->db->where('t_status',1);
        return $this->db->get()->result_array();
	}
	public function get_doctors_list($dep_id){
		$this->db->select('resource_list.resource_name,resource_list.current_status,treatmentwise_doctors.t_d_doc_id,treatmentwise_doctors.t_d_name')->from('treatmentwise_doctors');		
		$this->db->join('resource_list', 'resource_list.a_id = treatmentwise_doctors.t_d_doc_id', 'left');
		$this->db->where('treatmentwise_doctors.t_d_name',$dep_id);
		$this->db->where('resource_list.r_status',1);
        return $this->db->get()->result_array();
	}
	public function get_spec_doctors_list($spe_id){
		$this->db->select('resource_list.resource_name,resource_list.current_status,treatmentwise_doctors.t_d_doc_id,treatmentwise_doctors.t_d_name')->from('treatmentwise_doctors');		
		$this->db->join('resource_list', 'resource_list.a_id = treatmentwise_doctors.t_d_doc_id', 'left');
		$this->db->where('treatmentwise_doctors.s_id',$spe_id);
		$this->db->where('resource_list.r_status',1);
        return $this->db->get()->result_array();
	}
	public function get_card_number_list($card_num){
		$this->db->select('*')->from('patients_list_1');		
		$this->db->where('patients_list_1.card_number',$card_num);
        return $this->db->get()->row_array();
	}
	public function get_billing_details($p_id,$b_id){
		$this->db->select('patient_billing.*,patients_list_1.name,patients_list_1.problem,patients_list_1.age,patients_list_1.dob,patients_list_1.bloodgroup,patients_list_1.martial_status,patients_list_1.perment_address,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_country_name,patients_list_1.p_zipcode,patients_list_1.mobile,patients_list_1.barcode,hospital.hos_bas_logo,hospital.hos_email_id,hospital.hos_con_number,hospital.hos_bas_email,hospital.hos_bas_add1,hospital.hos_bas_add2,hospital.hos_bas_zipcode,hospital.hos_bas_city,hospital.hos_bas_state,hospital.hos_bas_country,hospital.hos_bas_name,hospital.hos_bas_contact,treament.t_name,resource_list.resource_name')->from('patient_billing');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->where('p_id',$p_id);
		$this->db->where('b_id',$b_id);
        return $this->db->get()->row_array();
	}
	public function get_billing_vital_details($p_id,$b_id){
		$this->db->select('*')->from('patient_vitals_list');
		$this->db->where('p_id',$p_id);
		$this->db->where('b_id',$b_id);
        return $this->db->get()->row_array();
	}
	/*patient billing details*/
	public function get_doctor_worksheet_list($hos_id,$doctor_id){
		$this->db->select('assignby.resource_name as assignbydoctor,assignto.resource_name as assigntodoctor,patient_billing.b_id,patient_billing.doctor_status,patient_billing.type,patient_billing.visit_type,patients_list_1.pid,patients_list_1.name,patients_list_1.age,patients_list_1.dob,patients_list_1.bloodgroup,patients_list_1.martial_status,patients_list_1.gender,patients_list_1.card_number,treament.t_name,resource_list.resource_name,patient_billing.patient_type,patient_billing.completed')->from('patient_billing');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('resource_list as assignto', 'assignto.a_id = patient_billing.assign_doctor_to', 'left');
		$this->db->join('resource_list as assignby', 'assignby.a_id = patient_billing.assign_doctor_by', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->where('patients_list_1.hos_id',$hos_id);
		$this->db->where('patient_billing.completed_type',0);
		$this->db->where('patient_billing.doct_id',$doctor_id);
        return $this->db->get()->result_array();
	}
	public function get_completed_doctor_worksheet_list($hos_id,$doctor_id){
		$this->db->select('assignby.resource_name as assignbydoctor,assignto.resource_name as assigntodoctor,patient_billing.b_id,patient_billing.doctor_status,patient_billing.type,patient_billing.visit_type,patients_list_1.pid,patients_list_1.name,patients_list_1.age,patients_list_1.dob,patients_list_1.bloodgroup,patients_list_1.martial_status,patients_list_1.gender,patients_list_1.card_number,treament.t_name,resource_list.resource_name,patient_billing.patient_type,patient_billing.completed')->from('patient_billing');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('resource_list as assignto', 'assignto.a_id = patient_billing.assign_doctor_to', 'left');
		$this->db->join('resource_list as assignby', 'assignby.a_id = patient_billing.assign_doctor_by', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->where('patients_list_1.hos_id',$hos_id);
		$this->db->where('patient_billing.completed_type !=',0);
		$this->db->where('patient_billing.doct_id',$doctor_id);
        return $this->db->get()->result_array();
	}
	public function get_doctor_refrrals_list($hos_id,$doctor_id){
		$this->db->select('assignby.resource_name as assignbydoctor,assignto.resource_name as assigntodoctor,patient_billing.b_id,patient_billing.doctor_status,patient_billing.type,patient_billing.visit_type,patients_list_1.pid,patients_list_1.name,patients_list_1.age,patients_list_1.dob,patients_list_1.bloodgroup,patients_list_1.martial_status,patients_list_1.gender,patients_list_1.card_number,treament.t_name,resource_list.resource_name,patient_billing.patient_type,patient_billing.completed')->from('patient_billing');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('resource_list as assignto', 'assignto.a_id = patient_billing.assign_doctor_to', 'left');
		$this->db->join('resource_list as assignby', 'assignby.a_id = patient_billing.assign_doctor_by', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->where('patients_list_1.hos_id',$hos_id);
		$this->db->where('patient_billing.assign_doctor_to',$doctor_id);
        return $this->db->get()->result_array();
	}
	public function get_patient_details($pid){
		$this->db->select('patient_billing.b_id,patient_billing.type,patient_billing.visit_type,patients_list_1.pid,patients_list_1.name,patients_list_1.gender,patients_list_1.age,patients_list_1.dob,patients_list_1.bloodgroup,patients_list_1.martial_status,patients_list_1.gender,patients_list_1.perment_address,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_country_name,patients_list_1.p_zipcode,patients_list_1.mobile,patients_list_1.barcode,patients_list_1.card_number,hospital.hos_bas_logo,hospital.hos_email_id,hospital.hos_con_number,hospital.hos_bas_email,hospital.hos_bas_add1,hospital.hos_bas_add2,hospital.hos_bas_zipcode,hospital.hos_bas_city,hospital.hos_bas_state,hospital.hos_bas_country,hospital.hos_bas_name,hospital.hos_bas_contact,treament.t_name,resource_list.resource_name')->from('patient_billing');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->where('patients_list_1.pid',$pid);
        return $this->db->get()->row_array();
	}
	public function get_billing_vitals_details($p_id){
		$this->db->select('*')->from('patient_vitals_list');
		$this->db->where('patient_vitals_list.p_id',$p_id);
		//$this->db->where('patient_vitals_list.b_id',$b_id);
		$this->db->order_by('patient_vitals_list.id',"DESC");
        return $this->db->get()->row_array();
	}
	public function get_vitals_list($p_id){
		$this->db->select('*')->from('patient_vitals_list');
		$this->db->where('patient_vitals_list.p_id',$p_id);
		$this->db->order_by('patient_vitals_list.id',"DESC");
        return $this->db->get()->result_array();
	}
	public function saving_patient_vital_details($data){
		$this->db->insert('patient_vitals_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function saving_patient_vital_comments($data){
		$this->db->insert('vital_comments', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function saving_patient_medicine($data){
		$this->db->insert('patient_medicine_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_patient_medicine_details_list($p_id,$bid){
		$this->db->select('*')->from('patient_medicine_list');
		$this->db->where('patient_medicine_list.p_id',$p_id);
		$this->db->where('patient_medicine_list.b_id',$bid);
        return $this->db->get()->result_array();
	}
	public function get_patient_investigation_details_list($p_id,$bid){
		$this->db->select('*')->from('investigation_patient_list');
		$this->db->where('investigation_patient_list.p_id',$p_id);
		$this->db->where('investigation_patient_list.b_id',$bid);
        return $this->db->get()->result_array();
	}
	public function get_hospital_medicine_list($hos_id){
		$this->db->select('medicine_list.medicine_name,medicine_list.id,medicine_list.qty,medicine_list.dosage,medicine_list.medicine_type')->from('medicine_list');
		$this->db->where('medicine_list.hos_id',$hos_id);
		$this->db->where('medicine_list.qty >=',1);
        return $this->db->get()->result_array();
	}
	public function get_investigation_list($hos_id,$val){
		$this->db->select('lab_test_type.type_name,lab_test_type.id')->from('lab_test_type');
		$this->db->where('lab_test_type.status',1);
		$this->db->where('lab_test_type.type',$val);
		//$this->db->where('lab_test_type.hos_id',$hos_id);
		$this->db->group_by('lab_test_type.type_name');
        return $this->db->get()->result_array();
	}
	public function get_investigation_basedon_testtypes_list($hos_id,$val){
		$this->db->select('lab_test_list.test_type,lab_test_list.t_id,lab_test_list.t_name')->from('lab_test_list');
		$this->db->where('lab_test_list.status',1);
		$this->db->where('lab_test_list.type',$val);
		$this->db->where('lab_test_list.hos_id',$hos_id);
		//$this->db->group_by('lab_test_list.test_type');
        return $this->db->get()->result_array();
	}
	public function get_investigation_basedon_testtypes_list_with_groupby($hos_id,$val){
		$this->db->select('lab_test_list.test_type,lab_test_list.t_id,lab_test_list.t_name')->from('lab_test_list');
		$this->db->where('lab_test_list.status',1);
		$this->db->where('lab_test_list.type',$val);
		$this->db->where('lab_test_list.hos_id',$hos_id);
		$this->db->group_by('lab_test_list.t_name');
        return $this->db->get()->result_array();
	}
	public function get_test_list($type,$test_type_id){
		$this->db->select('lab_test_list.t_id,lab_test_list.t_name,lab_test_list.modality,lab_test_list.type,lab_test_list.t_department,lab_test_list.t_description,lab_test_list.t_short_form,lab_test_list.out_source')->from('lab_test_list');
		$this->db->where('lab_test_list.type',$type);
		$this->db->where('lab_test_list.test_type',$test_type_id);
		$this->db->where('lab_test_list.status',1);
        return $this->db->get()->result_array();
	}
	public function get_test_list_hospital_wise($type,$test_type_id,$hos_id){
		$this->db->select('lab_test_list.t_id,lab_test_list.t_name,lab_test_list.modality,lab_test_list.type,lab_test_list.t_department,lab_test_list.t_description,lab_test_list.t_short_form,lab_test_list.out_source')->from('lab_test_list');
		$this->db->where('lab_test_list.type',$type);
		$this->db->where('lab_test_list.hos_id',$hos_id);
		$this->db->where('lab_test_list.t_id',$test_type_id);
		$this->db->where('lab_test_list.status',1);
        return $this->db->get()->result_array();
	}
	public function get_test_list_hospital_wise_with_name($type,$test_type_id,$hos_id){
		$this->db->select('lab_test_list.t_id,lab_test_list.t_name,lab_test_list.modality,lab_test_list.type,lab_test_list.t_department,lab_test_list.t_description,lab_test_list.t_short_form,lab_test_list.out_source')->from('lab_test_list');
		$this->db->where('lab_test_list.type',$type);
		//$this->db->where('lab_test_list.hos_id',$hos_id);
		$this->db->where('lab_test_list.test_type',$test_type_id);
		$this->db->where('lab_test_list.status',1);
        return $this->db->get()->result_array();
	}
	public function get_test_list_hospital_wise_with_name_test($type,$test_type_id,$hos_id){
		$this->db->select('lab_test_list.t_id,lab_test_list.t_name,lab_test_list.modality,lab_test_list.type,lab_test_list.t_department,lab_test_list.t_description,lab_test_list.t_short_form,lab_test_list.out_source')->from('lab_test_list');
		$this->db->where('lab_test_list.type',$type);
		$this->db->where('lab_test_list.hos_id',$hos_id);
		$this->db->where('lab_test_list.t_name',$test_type_id);
		$this->db->where('lab_test_list.status',1);
        return $this->db->get()->result_array();
	}
	public function get_patient_test_count($pid,$date){
		$this->db->select('*')->from('patient_lab_test_list');
		$this->db->where('p_id',$pid);
		$this->db->where('date',$date);
		$this->db->where('date',$date);
		$this->db->where('status',1);
		$this->db->group_by('test_id');
        return $this->db->get()->result_array();
	}
	function remove_attachment($id){
		$sql1="DELETE FROM patient_medicine_list WHERE m_id = '".$id."'";
		return $this->db->query($sql1);
	}
	function remove_investigation_attachment($id){
		$sql1="DELETE FROM investigation_patient_list WHERE id = '".$id."'";
		return $this->db->query($sql1);
	}
	public function add_addpatient_test($data){
		$this->db->insert('patient_lab_test_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	
	public  function check_test_already_exist($test_id,$p_id,$b_id,$date){
		$this->db->select('*')->from('patient_lab_test_list');
		$this->db->where('test_id',$test_id);
		$this->db->where('p_id',$p_id);
		$this->db->where('b_id',$b_id);
		$this->db->where('date',$date);
        return $this->db->get()->row_array();
	}
	public function saving_patient_investigation($data){
		$this->db->insert('investigation_patient_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_hospital_doctors_list($hos_id){
		$this->db->select('resource_list.a_id,resource_list.r_id,resource_list.resource_name')->from('resource_list');
		$this->db->where('hos_id',$hos_id);
		$this->db->where('role_id',6);
		$this->db->where('r_status',1);
        return $this->db->get()->result_array();
	}

	public function update_all_billing_compelted_details($pid,$b_id,$data){
		$this->db->where('p_id',$pid);
		$this->db->where('b_id',$b_id);
    	return $this->db->update("patient_billing",$data);
	}
	public function get_patient_previous_medicine_details_list($pid){
		$this->db->select('patient_medicine_list.medicine_type,patient_medicine_list.medicine_name,patient_medicine_list.batchno,patient_medicine_list.expiry_date,patient_medicine_list.amount,patient_medicine_list.org_amount,patient_medicine_list.qty,patient_medicine_list.substitute_name,patient_medicine_list.dosage,patient_medicine_list.frequency,patient_medicine_list.directions,patient_medicine_list.comments,patient_medicine_list.create_at,patient_medicine_list.condition,patient_medicine_list.edit_reason')->from('patient_medicine_list');
		$this->db->where('patient_medicine_list.p_id',$pid);
        return $this->db->get()->result_array();
	}
	public function get_old_test_list($pid,$bid){
		$this->db->select('*')->from('patient_lab_test_list');
		$this->db->where('patient_lab_test_list.p_id',$pid);
		$this->db->where('patient_lab_test_list.b_id',$bid);
        return $this->db->get()->result_array();
	}
	public function delete_billign_previous_data($t_id){
		$sql1="DELETE FROM patient_lab_test_list WHERE id = '".$t_id."'";
		return $this->db->query($sql1);
	}
	public function get_patient_lab_test_list($pid,$bid){
		
		$this->db->select('lab_test_list.*,lab_test_type.type_name,patient_lab_test_list.id as PLid')->from('patient_lab_test_list');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_test_list.test_id', 'left');
		$this->db->join('lab_test_type', 'lab_test_type.id = lab_test_list.test_type', 'left');
		$this->db->where('patient_lab_test_list.p_id',$pid);
		$this->db->where('patient_lab_test_list.b_id',$bid);
        return $this->db->get()->result_array();
	}
	function remove_treatment_attachment($id){
		$sql1="DELETE FROM patient_lab_test_list WHERE id = '".$id."'";
		return $this->db->query($sql1);
	}
	public function get_test_name($tid){
		$this->db->select('lab_test_type.type')->from('lab_test_type');
		$this->db->where('lab_test_type.id',$tid);
        return $this->db->get()->row_array();
	}
	public function get_test_name_details($t_id){
		$this->db->select('lab_test_list.type')->from('lab_test_list');
		$this->db->where('lab_test_list.t_id',$t_id);
        return $this->db->get()->row_array();
	}
	public function get_medicine_list_details($name){
		$this->db->select('medicine_list.id,medicine_list.total_amount,medicine_list.batchno,medicine_list.expiry_date,medicine_list.qty,medicine_list.medicine_type,medicine_list.cgst,medicine_list.amount,medicine_list.dosage')->from('medicine_list');		
		$this->db->where('medicine_list.medicine_name',$name);
        return $this->db->get()->row_array();	
	}
	public function get_medicine_list_details_with_id($id){
		$this->db->select('medicine_list.id,medicine_list.total_amount,medicine_list.batchno,medicine_list.expiry_date,medicine_list.qty,medicine_list.medicine_type,medicine_list.cgst,medicine_list.amount,medicine_list.dosage')->from('medicine_list');		
		$this->db->where('medicine_list.id',$id);
        return $this->db->get()->row_array();	
	}
	public function get_medicine_details_list_details($name,$hos_id){
		$this->db->select('medicine_list.id,medicine_list.total_amount,medicine_list.batchno,medicine_list.expiry_date,medicine_list.qty,medicine_list.medicine_type,medicine_list.cgst,medicine_list.amount,medicine_list.dosage')->from('medicine_list');		
		$this->db->where('medicine_list.medicine_name',$name);
		$this->db->where('medicine_list.hos_id',$hos_id);
        return $this->db->get()->row_array();	
	}
	public function update_medicine_details($med_id,$data){
		$this->db->where('id',$med_id);
    	return $this->db->update("medicine_list",$data);
	}
	
	 /*lab test exits*/
	 public function check_test_exits($a_id,$test,$type){
		$this->db->select('*')->from('lab_test_list');
		$this->db->where('t_name',$test);
		$this->db->where('type',$type);
		$this->db->where('create_by',$a_id);
		return $this->db->get()->row_array(); 
	}
	public  function get_test_details($tid){
		$this->db->select('lab_test_list.out_source')->from('lab_test_list');
		$this->db->where('t_id',$tid);
		return $this->db->get()->row_array(); 
		
	}
	 /*lab test exits*/
	 
	 /* appointment update*/
	 public  function update_appointment($id,$a_id){
		 $data=array('patient_id'=>$a_id);
		 $this->db->where('id',$id);
    	return $this->db->update("appointments",$data);
		}
	 /* appointment update*/
	 
	 /* card number details purpose */
	 public function get_cardnumber_details($card_num){
		$this->db->select('*')->from('seller_card_assign_munber_list');		
		$this->db->where('seller_card_assign_munber_list.card_number',$card_num);
		$this->db->where('seller_card_assign_munber_list.mobile_verified',1);
        return $this->db->get()->row_array();
	}
	 /* card number details purpose */
	 
	 /* convert op to ip patient */
	 public  function get_last_billing_id($p_id){
		 $this->db->select('b_id,p_id')->from('patient_billing');		
		 $this->db->where('patient_billing.p_id',$p_id);
		 $this->db->order_by('patient_billing.b_id',"desc");
		 $this->db->limit(1);
         return $this->db->get()->row_array();
	 }
	 /* convert op to ip patient */
	 
	 /* doctor */
	 public  function get_investigation_basedon_testtypes_list_with_groupby_testtypes($hos_id,$val){
		 $this->db->select('lab_test_list.test_type,lab_test_list.t_id,lab_test_list.t_name')->from('lab_test_list');
		$this->db->where('lab_test_list.status',1);
		$this->db->where('lab_test_list.type',$val);
		//$this->db->where('lab_test_list.hos_id',$hos_id);
		$this->db->group_by('lab_test_list.test_type');
        return $this->db->get()->result_array();
		 
	 }
	 public  function get_all_patient_vitals_list($p_id){
		 $this->db->select('patient_vitals_list.b_id,patient_vitals_list.bp,patient_vitals_list.pulse,patient_vitals_list.fbs_rbs,patient_vitals_list.temp,patient_vitals_list.weight,patient_vitals_list.date,patient_billing.patient_type,patient_billing.doct_id,patient_billing.treatment_id,resource_list.resource_name,treament.t_name')->from('patient_vitals_list');
		 $this->db->join('patient_billing', 'patient_billing.b_id = patient_vitals_list.b_id', 'left');
		 $this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		 $this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		 $this->db->where('patient_vitals_list.p_id',$p_id);
         return $this->db->get()->result_array();
	 }
	 public  function get_patient_vitals_list($p_id,$b_id){
		$this->db->select('*')->from('patient_vitals_list');
		$this->db->where('patient_vitals_list.p_id',$p_id);
		$this->db->where('patient_vitals_list.b_id',$b_id);
		$this->db->order_by('patient_vitals_list.id','desc');
        return $this->db->get()->row_array(); 
	 }

}