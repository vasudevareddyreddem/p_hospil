<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospital_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function save_hospital_step_one($data){
		$this->db->insert('hospital', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function save_resource($data){
		$this->db->insert('resource_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function check_email_exits($email){
		$sql = "SELECT admin.a_id FROM admin WHERE a_email_id ='".$email."' and a_status !=2";
		return $this->db->query($sql)->row_array();	
	}
	public function update_hospital_details($hos_id,$data){
		$this->db->where('hos_id',$hos_id);
    	return $this->db->update("hospital",$data);
	}
	public function update_admin_detais($hos_id,$data){
		$this->db->where('a_id',$hos_id);
    	return $this->db->update("admin",$data);
	}
	public function update_adminhospital_details($a_id,$data){
		$this->db->where('a_id',$a_id);
    	return $this->db->update("admin",$data);
	}
	public function get_hospital_details($hos_id){
		$this->db->select('*')->from('hospital');		
		$this->db->where('hos_id',$hos_id);
        return $this->db->get()->row_array();
	}
	public function get_hospital_detailsfor_profile($a_id){
		$this->db->select('*')->from('hospital');		
		$this->db->where('a_id',$a_id);
        return $this->db->get()->row_array();
	}
	public function get_hospital_id($a_id,$email){
		$this->db->select('hospital.a_id,hospital.hos_id')->from('hospital');		
		$this->db->where('a_id',$a_id);
		$this->db->where('hos_email_id',$email);
        return $this->db->get()->row_array();
	}
	public function get_hospital_list_details(){
		$this->db->select('hospital.hos_id,hospital.hos_con_number,hospital.hos_bas_name,hospital.hos_status,hospital.hos_curent_login')->from('hospital');		
        $this->db->where('hos_undo',0);
		return $this->db->get()->result_array();
	}
	public function get_total_patient_list($hos_id){
		
		$this->db->select('patients_list_1.pid')->from('patient_billing');	
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');		
		//$this->db->where('patient_billing.patient_type',1);
		$this->db->where('patients_list_1.hos_id',$hos_id);
		return $this->db->get()->result_array();
	}
	public function get_op_total_patient_list($hos_id){
		
		$this->db->select('patients_list_1.pid')->from('patient_billing');	
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');		
		$this->db->where('patient_billing.patient_type',0);
		$this->db->where('patients_list_1.hos_id',$hos_id);
		return $this->db->get()->result_array();
	}
	public function get_ip_total_patient_list($hos_id){
		
		$this->db->select('patients_list_1.pid')->from('patient_billing');	
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');		
		$this->db->where('patient_billing.patient_type',1);
		$this->db->where('patients_list_1.hos_id',$hos_id);
		return $this->db->get()->result_array();
	}
	public function get_appointment_total_patient_list($hos_id){
		
		$this->db->select('patients_list_1.pid')->from('appointments');	
		$this->db->join('patients_list_1', 'patients_list_1.pid = appointments.patient_id', 'left');		
		$this->db->where('appointments.patient_id !=',0);
		$this->db->where('patients_list_1.hos_id',$hos_id);
		return $this->db->get()->result_array();
	}
	public function get_resources_list($a_id,$hos_id){
		$this->db->select('resource_list.r_id,resource_list.a_id,roles.r_name,resource_list.resource_name,resource_list.role_id,resource_list.resource_contatnumber,resource_list.r_status,resource_list.r_created_at,resource_list.resource_email,resource_list.r_create_by,resource_list.resource_mobile')->from('resource_list');		
        $this->db->join('roles', 'roles.r_id = resource_list.role_id', 'left');
		$this->db->where('resource_list.r_create_by',$a_id);
		$this->db->where('resource_list.hos_id',$hos_id);
		$this->db->where('resource_list.role_id !=',6);
		$this->db->where('resource_list.r_status!=',2);
		
		return $this->db->get()->result_array();
	}
	public function get_doctor_resources_list($a_id,$hos_id){
		$this->db->select('resource_list.r_id,resource_list.a_id,roles.r_name,resource_list.resource_name,resource_list.role_id,resource_list.resource_contatnumber,resource_list.r_status,resource_list.r_created_at,resource_list.resource_email,resource_list.resource_mobile')->from('resource_list');		
        $this->db->join('roles', 'roles.r_id = resource_list.role_id', 'left');
		$this->db->where('resource_list.r_create_by',$a_id);
		$this->db->where('resource_list.hos_id',$hos_id);
		$this->db->where('resource_list.role_id',6);
		$this->db->where('resource_list.r_status !=',2);
		return $this->db->get()->result_array();
	}
	public function get_resourse_data($r_id){
		$this->db->select('*')->from('resource_list');		
		$this->db->where('a_id',$r_id);
		return $this->db->get()->row_array();
	}
	/*resource*/
	public function update_resourse_details($hos_id,$data){
		$this->db->where('r_id',$hos_id);
    	return $this->db->update("resource_list",$data);
	}
	public function get_resourse_details($r_id){
		$this->db->select('*')->from('resource_list');		
		$this->db->where('r_id',$r_id);
		return $this->db->get()->row_array();
	}
	/*treatment*/
	public function save_treatment($data){
		$this->db->insert('treament', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function save_addspecialist($data){
		$this->db->insert('specialist', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_saved_treatment($name,$hos_id){
		$this->db->select('*')->from('treament');		
		$this->db->where('t_name',$name);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('treament.t_status !=',2);
		return $this->db->get()->row_array();
	}
	public function get_saved_specialist_name($d_id,$name,$hos_id){
		$this->db->select('*')->from('specialist');		
		$this->db->where('specialist_name',$name);
		$this->db->where('d_id',$d_id);
		$this->db->where('hos_id',$hos_id);
		$this->db->where('specialist.t_status !=',2);
		return $this->db->get()->row_array();
	}
	public function get_treatment_details($t_id){
		$this->db->select('*')->from('treament');		
		$this->db->where('t_id',$t_id);
		return $this->db->get()->row_array();
	}
	public function get_treatment_list($a_id,$hos_id){
		$this->db->select('treament.t_id,treament.t_name,treament.t_status,treament.t_create_at')->from('treament');		
		//$this->db->join('resource_list', 'resource_list.r_id = treatmentwise_doctors.t_d_doc_id', 'left');

		$this->db->where('treament.t_create_by',$a_id);
		$this->db->where('treament.hos_id',$hos_id);
		$this->db->where('treament.t_status !=',2);
		return $this->db->get()->result_array();
	}
	public function get_active_treatment_list($a_id,$hos_id){
		$this->db->select('treament.t_id,treament.t_name,treament.t_status,treament.t_create_at')->from('treament');		
		//$this->db->join('resource_list', 'resource_list.r_id = treatmentwise_doctors.t_d_doc_id', 'left');

		$this->db->where('treament.t_create_by',$a_id);
		$this->db->where('treament.hos_id',$hos_id);
		$this->db->where('treament.t_status',1);
		return $this->db->get()->result_array();
	}
	public function get_all_treatment_list($a_id,$hos_id){
		$this->db->select('treament.t_id,treament.t_name,treament.t_status,treament.t_create_at')->from('treament');		
		//$this->db->join('resource_list', 'resource_list.r_id = treatmentwise_doctors.t_d_doc_id', 'left');

		$this->db->where('treament.t_create_by',$a_id);
		$this->db->where('treament.hos_id',$hos_id);
		$this->db->where('treament.t_status',1);
		return $this->db->get()->result_array();
	}
	
	public  function get_specialist_list($a_id,$hos_id){
		$this->db->select('specialist.*,treament.t_name')->from('specialist');		
		$this->db->join('treament', 'treament.t_id = specialist.d_id', 'left');

		$this->db->where('specialist.t_create_by',$a_id);
		$this->db->where('specialist.hos_id',$hos_id);
		$this->db->where('specialist.t_status !=',2);
		return $this->db->get()->result_array();
	}
	public function get_doctors_list($a_id,$hos_id){
		$this->db->select('resource_list.a_id,resource_list.resource_name')->from('resource_list');		
		$this->db->where('resource_list.r_create_by',$a_id);
		$this->db->where('resource_list.hos_id',$hos_id);
		$this->db->where('resource_list.r_status !=',2);
		$this->db->where('resource_list.r_status',1);
		$this->db->where('resource_list.role_id',6);
		return $this->db->get()->result_array();
	}
	public function update_treatment_details($t_id,$data){
		$this->db->where('t_id',$t_id);
    	return $this->db->update("treament",$data);
	}
	/*treatment*/
	/*specilist*/
	public  function delete_specialist_details($id){
		$this->db->where('specialist.s_id',$id);
		return $this->db->delete('specialist');
	}
	public function update_specialist_details($s_id,$data){
		$this->db->where('s_id',$s_id);
    	return $this->db->update("specialist",$data);
	}
	public function get_specialist_details($s_id,$data){
		$this->db->select('specialist.*')->from('specialist');		
		$this->db->where('s_id',$s_id);
		return $this->db->get()->row_array();
	}
	public function get_d_id_wise_specialist_list($d_id){
		$this->db->select('specialist.s_id,specialist.specialist_name')->from('specialist');		
		$this->db->where('d_id',$d_id);
		$this->db->where('t_status',1);
		return $this->db->get()->result_array();
	}
	
	/*specilist*/
	/*add treament*/
		public function save_addtreatment($data){
		$this->db->insert('treatmentwise_doctors', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_all_doctor_treatment_list($a_id,$hos_id){
		$this->db->select('treatmentwise_doctors.t_d_id,treament.t_name,treatmentwise_doctors.t_d_status,resource_list.resource_name,specialist.specialist_name')->from('treatmentwise_doctors');		
		$this->db->join('resource_list', 'resource_list.a_id = treatmentwise_doctors.t_d_doc_id', 'left');
		$this->db->join('treament', 'treament.t_id = treatmentwise_doctors.t_d_name', 'left');
		$this->db->join('specialist', 'specialist.s_id = treatmentwise_doctors.s_id', 'left');
		$this->db->where('treatmentwise_doctors.t_d_create_by',$a_id);
		$this->db->where('treatmentwise_doctors.hos_id',$hos_id);
		$this->db->where('treatmentwise_doctors.t_d_status !=',2);
		return $this->db->get()->result_array();
	}
	public function update_addtreatment_details($t_d_id,$data){
		$this->db->where('t_d_id',$t_d_id);
    	return $this->db->update("treatmentwise_doctors",$data);
	}
	public  function treatment_exist($t_id,$s_id,$d_id){
		$this->db->select('*')->from('treatmentwise_doctors');		
		$this->db->where('t_d_doc_id',$t_id);
		$this->db->where('t_d_name',$d_id);
		$this->db->where('s_id',$s_id);
		$this->db->where('treatmentwise_doctors.t_d_status !=',2);
		return $this->db->get()->row_array();
	}
	
	/*add treament*/
	/*lab details*/
	public function get_labassistents_list($a_id,$hos_id){
		$this->db->select('resource_list.r_id,resource_list.resource_name')->from('resource_list');		
		$this->db->where('resource_list.r_create_by',$a_id);
		$this->db->where('resource_list.hos_id',$hos_id);
		$this->db->where('resource_list.r_status !=',2);
		$this->db->where('resource_list.r_status',1);
		$this->db->where('resource_list.role_id',5);
		return $this->db->get()->result_array();
	}
	public function save_addlabdetails($data){
		$this->db->insert('lab_detailes', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_all_lab_details_list($a_id,$hos_id){
		$this->db->select('lab_detailes.l_id,lab_detailes.l_investigation,lab_detailes.l_code,lab_detailes.l_name,lab_detailes.l_status,resource_list.resource_name')->from('lab_detailes');		
		$this->db->join('resource_list', 'resource_list.r_id = lab_detailes.l_assistent_id', 'left');
		$this->db->where('lab_detailes.l_create_by',$a_id);
		$this->db->where('lab_detailes.hos_id',$hos_id);
		$this->db->where('lab_detailes.l_status !=',2);
		return $this->db->get()->result_array();
	}
	public function update_lab_details($l_id,$data){
		$this->db->where('l_id',$l_id);
    	return $this->db->update("lab_detailes",$data);
	}
	/*lab details*/
	/* hospital*/
	public function save_announcements_list($data){
		$this->db->insert('hospital_announcements', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_all_sent_notification_details($a_id){
		$this->db->select('hospital_announcements.*')->from('hospital_announcements');		
		$this->db->where('sent_by', $a_id);
		$this->db->group_by('hospital_announcements.comment');
        $return=$this->db->get()->result_array();
		foreach( $return as $Lis){
			
			$msg=$this->get_sent_announcements_resouces_list($Lis['comment']);
			$data[$Lis['int_id']]=$Lis;
			$data[$Lis['int_id']]['r_list']=$msg;
		}
		if(!empty($data))
		{
		return $data;
		}
	}
	
	public function get_sent_announcements_resouces_list($msg){
		$this->db->select('hospital_announcements.res_id,resource_list.resource_name')->from('hospital_announcements');	
		$this->db->join('resource_list', 'resource_list.a_id = hospital_announcements.res_id', 'left');
		$this->db->where('comment', $msg);
        return $this->db->get()->result_array();
	}
	
	
	public function get_modified_prescription_list($h_id){
		$this->db->select('patients_list_1.pid,patients_list_1.name,patients_list_1.card_number,patient_medicine_list.b_id')->from('patient_medicine_list');	
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_medicine_list.p_id', 'left');
		$this->db->where('patients_list_1.hos_id', $h_id);
		$this->db->where('patient_medicine_list.edited', 1);
		$this->db->group_by('patient_medicine_list.b_id', 1);
        return $this->db->get()->result_array();
	}
	public function get_prescription_details($pid,$bid){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.bloodgroup,patients_list_1.age,patients_list_1.martial_status,patients_list_1.dob,patients_list_1.mobile,patients_list_1.name,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_zipcode,patients_list_1.p_country_name,patients_list_1.perment_address,resource_list.resource_name as created_by,patient_billing.b_id,patient_billing.medicine_payment_mode,patient_billing.sheet_prescription,patient_billing.sheet_prescription_file,patient_billing.payment_createed_by,hospital.hos_bas_logo,hospital.hos_bas_name,hospital.hos_bas_add1,hospital.hos_bas_add2,hospital.hos_bas_city,hospital.hos_bas_state,hospital.hos_bas_country,hospital.hos_bas_zipcode,hospital.hos_con_number,hospital.hos_bas_email')->from('patient_billing');	
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list ', 'resource_list.a_id = patient_billing.create_by', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->where('patients_list_1.pid', $pid);
		$this->db->where('patient_billing.b_id', $bid);
        $return=$this->db->get()->row_array();
		$details['information']=$return;
		$details['medicine']=$this->get_medicine_list($return['pid'],$return['b_id']);
		if(!empty($details))
		{
		return $details;
		}
	}
	public function get_medicine_list($pid,$bid){
		$this->db->select('*')->from('patient_medicine_list');	
		$this->db->where('patient_medicine_list.p_id', $pid);
		$this->db->where('patient_medicine_list.b_id', $bid);
        return $this->db->get()->result_array();
	}
	
	public function get_patient_list($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,patients_list_1.mobile,patients_list_1.age,patients_list_1.hos_id,patients_list_1.registrationtype,patients_list_1.patient_category,patients_list_1.dob,patients_list_1.nationali_id,patients_list_1.create_at')->from('patients_list_1');		
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->order_by('patients_list_1.pid', "DESC");
        return $this->db->get()->result_array();	
	}
	public function get_patient_list_with_billing_wise($hos_id){
		$this->db->select('patient_billing.patient_type,patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,patients_list_1.mobile,patients_list_1.age,patients_list_1.hos_id,patients_list_1.registrationtype,patients_list_1.patient_category,patients_list_1.dob,patients_list_1.nationali_id,patients_list_1.create_at')->from('patient_billing');		
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');

		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->order_by('patient_billing.b_id', "DESC");
        return $this->db->get()->result_array();	
	}
	
	public  function get_patient_lab_details($p_id){
		$this->db->select('patient_lab_reports.*,patients_list_1.card_number,patients_list_1.name,')->from('patient_lab_reports');
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_lab_reports.p_id', 'left');
		
		$this->db->where('patient_lab_reports.p_id', $p_id);
        return $this->db->get()->result_array();
	}
	public  function get_patient_medicine_details($p_id){
		$this->db->select('patient_medicine_list.*,patients_list_1.card_number,patients_list_1.name,')->from('patient_medicine_list');
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_medicine_list.p_id', 'left');
		
		$this->db->where('patient_medicine_list.p_id', $p_id);
        return $this->db->get()->result_array();
	}
	
	public  function get_hospital_id_details($hos_id){
		$this->db->select('hospital.a_id')->from('hospital');		
		$this->db->where('hospital.hos_id', $hos_id);
        return $this->db->get()->row_array();
	}
	
	/* resource*/
	public  function get_hos_resources_list($hos_id){
		$this->db->select('a_id,r_id')->from('resource_list');		
		$this->db->where('resource_list.hos_id', $hos_id);
		$this->db->where('resource_list.r_status !=',2);
        return $this->db->get()->result_array();
	}
	public function resouces_status_update($r_id,$data){
		$this->db->where('r_id',$r_id);
    	return $this->db->update("resource_list",$data);
	}
	public function resouces_login_status_update($a_id,$data){
		$this->db->where('a_id',$a_id);
    	return $this->db->update("admin",$data);
	}
	
	/* hospital patients list purposr */
	public  function get_hospital_wise_patient_list($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.registrationtype,patients_list_1.name,patients_list_1.mobile,patients_list_1.age,patients_list_1.email,patient_billing.patient_type,patient_billing.type,patient_billing.patient_payer_deposit_amount as total_amt,patient_billing.bill_amount,resource_list.resource_name,specialist.specialist_name,treament.t_name,patient_billing.create_at')->from('patient_billing');
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('specialist', 'specialist.s_id = patient_billing.specialist_id', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->order_by('patient_billing.b_id', "DESC");
        return $this->db->get()->result_array();	
	}
	public  function get_hospital_patient_list_date_wise($hos_id,$from_date,$to_date){
		$to_date1=strtotime("1 day", strtotime($to_date));
		$plusone= date("d-m-Y", $to_date1);
		$this->db->select('patients_list_1.pid,patients_list_1.registrationtype,patients_list_1.name,patients_list_1.mobile,patients_list_1.age,patients_list_1.email,patient_billing.patient_type,patient_billing.type,patient_billing.patient_payer_deposit_amount as total_amt,patient_billing.bill_amount,resource_list.resource_name,specialist.specialist_name,treament.t_name,patient_billing.create_at')->from('patient_billing');
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('specialist', 'specialist.s_id = patient_billing.specialist_id', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->where('patient_billing.create_at BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($plusone)).'"');
		//$this->db->where('date_format(patient_billing.create_at,"%m-%d-%Y") BETWEEN '".$from_date."' AND '".$todate."'');
		$this->db->order_by('patient_billing.b_id', "DESC");
        return $this->db->get()->result_array();	
	}
	public  function get_specialist_doctor_id($treatment_name,$hos_id){
		$this->db->select('specialist.s_id')->from('specialist');		
		$this->db->where('specialist.hos_id', $hos_id);
		$this->db->where('specialist.d_id', $treatment_name);
        return $this->db->get()->row_array();
	}
	
	public  function op_treatment_exist($d_id,$t_id){
		$this->db->select('*')->from('treatmentwise_doctors');		
		$this->db->where('t_d_doc_id',$t_id);
		$this->db->where('t_d_name',$d_id);
		$this->db->where('treatmentwise_doctors.t_d_status !=',2);
		return $this->db->get()->row_array();
	}
	/* new op purpose */
	public  function get_spec_doctors_list($t_d_name){
		$this->db->select('resource_list.resource_name,resource_list.current_status,treatmentwise_doctors.t_d_doc_id,treatmentwise_doctors.t_d_name')->from('treatmentwise_doctors');		
		$this->db->join('resource_list', 'resource_list.a_id = treatmentwise_doctors.t_d_doc_id', 'left');
		$this->db->where('treatmentwise_doctors.t_d_name',$t_d_name);
		$this->db->where('treatmentwise_doctors.t_d_status',1);
		$this->db->where('resource_list.r_status',1);
        return $this->db->get()->result_array();
	}
	public  function get_doctor_time_list($doctor_id){
		$this->db->select('in_time,out_time')->from('resource_list');		
		$this->db->where('a_id',$doctor_id);
        return $this->db->get()->row_array();
	}
	public  function get_hospital_wise_patient_list_export($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.name,patients_list_1.age,resource_list.resource_name,if("patient_billing.patient_type==0","IP","OP") as ptype,patient_billing.create_at,patient_billing.patient_payer_deposit_amount as total_amt')->from('patient_billing');
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('specialist', 'specialist.s_id = patient_billing.specialist_id', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->order_by('patient_billing.b_id', "DESC");
        return $this->db->get()->result_array();	
	}
	public  function get_hospital_wise_patient_list_total_amout($hos_id){
		$this->db->select('SUM(patient_billing.patient_payer_deposit_amount) as total_amt')->from('patient_billing');
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('specialist', 'specialist.s_id = patient_billing.specialist_id', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->order_by('patient_billing.b_id', "DESC");
        return $this->db->get()->row_array();	
	}
	
	public  function get_hospital_patient_list_date_wise_export_amt($hos_id,$from_date,$to_date){
		$to_date1=strtotime("1 day", strtotime($to_date));
		$plusone= date("d-m-Y", $to_date1);
		$this->db->select('SUM(patient_billing.patient_payer_deposit_amount) as total_amt')->from('patient_billing');
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('specialist', 'specialist.s_id = patient_billing.specialist_id', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->where('patient_billing.create_at BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($plusone)).'"');
		//$this->db->where('date_format(patient_billing.create_at,"%m-%d-%Y") BETWEEN '".$from_date."' AND '".$todate."'');
		$this->db->order_by('patient_billing.b_id', "DESC");
        return $this->db->get()->row_array();	
	}
	public  function get_hospital_patient_list_date_wise_export($hos_id,$from_date,$to_date){
		$to_date1=strtotime("1 day", strtotime($to_date));
		$plusone= date("d-m-Y", $to_date1);
		$this->db->select('patients_list_1.pid,patients_list_1.name,patients_list_1.age,resource_list.resource_name,if("patient_billing.patient_type==0","IP","OP") as ptype,patient_billing.create_at,patient_billing.patient_payer_deposit_amount as total_amt')->from('patient_billing');
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->join('specialist', 'specialist.s_id = patient_billing.specialist_id', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->where('patient_billing.create_at BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($plusone)).'"');
		//$this->db->where('date_format(patient_billing.create_at,"%m-%d-%Y") BETWEEN '".$from_date."' AND '".$todate."'');
		$this->db->order_by('patient_billing.b_id', "DESC");
        return $this->db->get()->result_array();	
	}
	
	

}