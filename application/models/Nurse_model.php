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
	
}

	
