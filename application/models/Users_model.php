<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function get_all_patients_lists($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,resource_list.resource_name as created_by,patient_billing.create_at,patient_billing.b_id')->from('patient_billing');	
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list ', 'resource_list.a_id = patient_billing.create_by', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->where('patient_billing.completed_type',1);
		$this->db->where('patient_billing.payment_updated_by ',0);
        return $this->db->get()->result_array();	
	}
	public function get_all_patients_completed_lists($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,resource_list.resource_name as created_by,patient_billing.create_at,patient_billing.b_id')->from('patient_billing');	
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list ', 'resource_list.a_id = patient_billing.create_by', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->where('patient_billing.completed_type',1);
		$this->db->order_by('patient_billing.create_at',"DESc");
		$this->db->where('patient_billing.payment_updated_by !=',0);
        return $this->db->get()->result_array();	
	}
	public function get_manu_prescription_details($pid,$bid){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.bloodgroup,patients_list_1.age,patients_list_1.martial_status,patients_list_1.dob,patients_list_1.mobile,patients_list_1.name,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_zipcode,patients_list_1.p_country_name,patients_list_1.perment_address,resource_list.resource_name as created_by,patient_billing.b_id,patient_billing.medicine_payment_mode,patient_billing.sheet_prescription,patient_billing.sheet_prescription_file,patient_billing.payment_createed_by,hospital.hos_bas_logo,hospital.hos_bas_name,hospital.hos_bas_add1,hospital.hos_bas_add2,hospital.hos_bas_city,hospital.hos_bas_state,hospital.hos_bas_country,hospital.hos_bas_zipcode,hospital.hos_con_number,hospital.hos_bas_email')->from('patient_billing');	
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list ', 'resource_list.a_id = patient_billing.create_by', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->where('patients_list_1.pid', $pid);
		$this->db->where('patient_billing.b_id', $bid);
		return $this->db->get()->row_array();
		
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
		return $details;
	}
	
	public function get_medicine_list($pid,$bid){
		$this->db->select('patient_medicine_list.*,medicine_list.dosage')->from('patient_medicine_list');
		$this->db->join('medicine_list ', 'medicine_list.id = patient_medicine_list.medicine_id', 'left');
		
		$this->db->where('patient_medicine_list.p_id', $pid);
		$this->db->where('patient_medicine_list.b_id', $bid);
        return $this->db->get()->result_array();
	}
	public function get_patient_prescription_details($pid,$bid){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.bloodgroup,patients_list_1.age,patients_list_1.martial_status,patients_list_1.dob,patients_list_1.mobile,patients_list_1.name,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_zipcode,patients_list_1.p_country_name,patients_list_1.perment_address,resource_list.resource_name as created_by,patient_billing.b_id,patient_billing.medicine_payment_mode,patient_billing.sheet_prescription,patient_billing.sheet_prescription_file,patient_billing.payment_createed_by,hospital.hos_bas_logo,hospital.hos_bas_name,hospital.hos_bas_add1,hospital.hos_bas_add2,hospital.hos_bas_city,hospital.hos_bas_state,hospital.hos_bas_country,hospital.hos_bas_zipcode,hospital.hos_con_number,hospital.hos_bas_email')->from('patient_billing');	
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list ', 'resource_list.a_id = patient_billing.create_by', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->where('patients_list_1.pid', $pid);
		$this->db->where('patient_billing.b_id', $bid);
        return $return=$this->db->get()->row_array();
		
	}
	
	public  function get_manualbillprescription_list($id,$p_id,$b_id){
		$this->db->select('*')->from('manual_prescription_list');	
		$this->db->where('manual_prescription_list.p_id', $id);
        return $this->db->get()->result_array();
	}
	
	public function prescriptionschanges($m_id,$data){
		$this->db->where('m_id',$m_id);
    	return $this->db->update("patient_medicine_list",$data);
	}
	public function update_billing_prescription_file($p_id,$b_id,$data){
		$this->db->where('p_id',$p_id);
		$this->db->where('b_id',$b_id);
    	return $this->db->update("patient_billing",$data);
	}
	public function updated_medicne_billing($b_id,$data){
		$this->db->where('b_id',$b_id);
    	return $this->db->update("patient_billing",$data);
	}
	public function get_meidicine_details($m_id){
		$this->db->select('*')->from('patient_medicine_list');	
		$this->db->where('patient_medicine_list.m_id', $m_id);
        return $this->db->get()->row_array();
	}
	
	public function get_alternate_prescription_details($p_id,$b_id){
		$this->db->select('sheet_prescription_file')->from('patient_billing');	
		$this->db->where('patient_billing.b_id', $b_id);
		$this->db->where('patient_billing.p_id', $p_id);
        return $this->db->get()->row_array();
	}
	
	public  function saveprescription_details($data){
		$this->db->insert('prescription_manual', $data);
		return $insert_id = $this->db->insert_id();
		
	}
	public  function saveprescription_list($data){
		$this->db->insert('manual_prescription_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	
	public  function get_all_prescription_lists($hos_id,$a_id){
		
		$this->db->select('prescription_manual.*,patients_list_1.pid,patients_list_1.card_number,patients_list_1.dob,,patients_list_1.mobile as mobile_number')->from('prescription_manual');	
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = prescription_manual.p_id', 'left');
		$this->db->where('prescription_manual.hos_id', $hos_id);
		$this->db->where('prescription_manual.create_by', $a_id);
        $return=$this->db->get()->result_array();
		foreach($return as $list){
			$bill_id=$this->get_patient_billing_id($list['pid']);
			$data[$list['pid']]=$list;
			$data[$list['pid']]['b_id']=$bill_id['b_id'];
		}
		if(!empty($data)){
			return $data;
		}
	}
	
	public  function get_patient_billing_id($id){
		$this->db->select('b_id')->from('patient_billing');	
		$this->db->where('patient_billing.p_id', $id);
		$this->db->order_by('patient_billing.b_id','desc');
		$this->db->limit(1);
        return $this->db->get()->row_array();	
	}
	
	public  function get_prescroption_list($id){
		$this->db->select('manual_prescription_list.*')->from('manual_prescription_list');	
		$this->db->where('manual_prescription_list.p_id', $id);
        return $this->db->get()->result_array();
	}
	public  function get_user_details($id){
		$this->db->select('prescription_manual.*,patients_list_1.pid,patients_list_1.card_number,patients_list_1.dob,,patients_list_1.mobile as mobile_number')->from('prescription_manual');	
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = prescription_manual.p_id', 'left');
		$this->db->where('prescription_manual.p_id', $id);
		$this->db->order_by('prescription_manual.id', 'desc');
        return $this->db->get()->row_array();
	}
	public  function get_user_id($id){
		$this->db->select('prescription_manual.p_id')->from('prescription_manual');	
		$this->db->where('prescription_manual.id', $id);
        return $this->db->get()->row_array();
	}
	
	public  function get_medicine_name($id){
		$this->db->select('*')->from('medicine_list');	
		$this->db->where('medicine_list.id', $id);
        return $this->db->get()->row_array();
	}
	public function update_medicine_qty($id,$data){
		$this->db->where('id',$id);
    	return $this->db->update("medicine_list",$data);
	}
	
	public  function get_medicine_details($m_id){
		$this->db->select('expiry_date,amount,total_amount')->from('medicine_list');	
		$this->db->where('medicine_list.id', $m_id);
        return $this->db->get()->row_array();
	}
	
	

}