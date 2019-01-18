<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lab_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function save_tabtest_details($data){
		$this->db->insert('lab_test_list', $data);
		return $insert_id = $this->db->insert_id();	
	}
	public function save_patient_reports($data){
		$this->db->insert('patient_lab_reports', $data);
		return $insert_id = $this->db->insert_id();	
	}
	public function get_lab_test_details($hos_id){
		$this->db->select('lab_test_list.*')->from('lab_test_list');
		$this->db->where('lab_test_list.hos_id',$hos_id);
        return $this->db->get()->result_array();	
	}
	public function update_labtest_details($t_id,$data){
		$this->db->where('t_id',$t_id);
    	return $this->db->update("lab_test_list",$data);
	}
	public function update_billingreport_status($p_id,$b_id,$data){
		$this->db->where('p_id',$p_id);
		$this->db->where('b_id',$b_id);
    	return $this->db->update("patient_billing",$data);
	}
	public function update_patient_billingreport_status($test_id,$p_id,$b_id,$data){
		$this->db->where('test_id',$test_id);
		$this->db->where('p_id',$p_id);
		$this->db->where('b_id',$b_id);
    	return $this->db->update("patient_lab_test_list",$data);
	}
	public function update_without_bidding_patient_billingreport_status($test_id,$p_id,$b_id,$data){
		$this->db->where('p_l_t_id',$test_id);
		$this->db->where('b_id',$b_id);
		$this->db->where('p_id',$p_id);
    	return $this->db->update("out_source_lab_test_lists",$data);
	}
	public function delete_labtest($t_id){
			$sql1="DELETE FROM lab_test_list WHERE t_id = '".$t_id."'";
		return $this->db->query($sql1);
	}
	public function get_all_patients_lists($hos_id){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,patients_list_1.mobile,patients_list_1.perment_address,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_zipcode,patients_list_1.p_country_name,resource_list.resource_name as created_by,patient_billing.create_at,patient_billing.b_id')->from('patient_billing');	
		$this->db->join('patients_list_1 ', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('resource_list ', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->where('patients_list_1.hos_id', $hos_id);
		$this->db->where('patient_billing.completed_type',2);
		$this->db->where('patient_billing.report_completed',0);
        return $this->db->get()->result_array();	
	}
		public function get_billing_details($p_id,$b_id){
		$this->db->select('patient_billing.b_id,patients_list_1.pid,patients_list_1.card_number,patients_list_1.name,patients_list_1.age,patients_list_1.dob,patients_list_1.bloodgroup,patients_list_1.martial_status,patients_list_1.perment_address,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_country_name,patients_list_1.p_zipcode,patients_list_1.mobile,patients_list_1.barcode,hospital.hos_bas_logo,hospital.hos_email_id,hospital.hos_con_number,hospital.hos_bas_email,hospital.hos_bas_add1,hospital.hos_bas_add2,hospital.hos_bas_zipcode,hospital.hos_bas_city,hospital.hos_bas_state,hospital.hos_bas_country,hospital.hos_bas_name,hospital.hos_bas_contact,treament.t_name,resource_list.resource_name')->from('patient_billing');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = patients_list_1.hos_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = patient_billing.doct_id', 'left');
		$this->db->join('treament', 'treament.t_id = patient_billing.treatment_id', 'left');
		$this->db->where('p_id',$p_id);
		$this->db->where('b_id',$b_id);
        return $this->db->get()->row_array();
	}
	public function get_all_labreports_lists($hos_id){
		$this->db->select('patient_lab_reports.b_id,patients_list_1.pid,patients_list_1.card_number,patients_list_1.hos_id,patients_list_1.pid,patients_list_1.name,patients_list_1.age,patients_list_1.dob,patients_list_1.bloodgroup,patients_list_1.martial_status,patients_list_1.perment_address,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_country_name,patients_list_1.p_zipcode,patients_list_1.mobile,patients_list_1.barcode,patients_list_1.create_at')->from('patient_lab_reports');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_lab_reports.p_id', 'left');
		$this->db->group_by('patient_lab_reports.p_id');
		$this->db->where('patient_lab_reports.hos_id',$hos_id);
		return $this->db->get()->result_array();
	}
	public function get_all_patient_reports_lists($p_id){
		$this->db->select('patients_list_1.pid,patients_list_1.card_number,patients_list_1.hos_id,patients_list_1.pid,patients_list_1.name,patients_list_1.mobile,lab_test_list.t_name,patient_lab_reports.*')->from('patient_lab_reports');
		$this->db->join('patients_list_1', 'patients_list_1.pid = patient_lab_reports.p_id', 'left');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_reports.test_id', 'left');
		$this->db->where('patient_lab_reports.p_id',$p_id);
		return $this->db->get()->result_array();
	}
	public function get_all_patients_test_lists($p_id,$b_id){
		$this->db->select('lab_test_list.t_name,lab_test_list.out_source,lab_test_list.hos_id')->from('patient_lab_test_list');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_test_list.test_id', 'left');
		$this->db->where('patient_lab_test_list.p_id',$p_id);
		$this->db->where('patient_lab_test_list.b_id',$b_id);
		//$this->db->where('patient_lab_test_list.out_source',1);
		return $this->db->get()->result_array();
	}
	public function add_lab_test_type($add){
		$this->db->insert('lab_test_type', $add);
		return $insert_id = $this->db->insert_id();	
	}
	public function check_lab_test_type($name,$type){
		$this->db->select('*')->from('lab_test_type');
		$this->db->where('lab_test_type.type_name',$name);
		$this->db->where('lab_test_type.type',$type);
		$this->db->where('lab_test_type.status !=',2);
		return $this->db->get()->row_array();
	}
	public function check_get_lab_test_type_details($id){
		$this->db->select('*')->from('lab_test_type');
		$this->db->where('lab_test_type.id',$id);
		$this->db->where('lab_test_type.status !=',2);
		return $this->db->get()->row_array();
	}
	public function get_all_test_list($a_id){
		$this->db->select('*')->from('lab_test_type');
		$this->db->where('lab_test_type.created_by',$a_id);
		$this->db->where('lab_test_type.status !=',2);
		return $this->db->get()->result_array();
	}
	public function get_lab_test_type_details(){
		$this->db->select('*')->from('lab_test_type');
		$this->db->where('lab_test_type.status',1);
		$this->db->group_by('lab_test_type.type_name');
		return $this->db->get()->result_array();
	}
	public function update_testtype_details($t_id,$data){
		$this->db->where('id',$t_id);
    	return $this->db->update("lab_test_type",$data);
	}
	public function delete_test_type($t_id,$data){
			$this->db->where('id',$t_id);
    	return $this->db->update("lab_test_type",$data);
	}
	public function out_sourcelab_list($a_id){
		$this->db->select('admin.a_id,resource_list.*')->from('admin');
		$this->db->join('resource_list', 'resource_list.a_id = admin.a_id', 'left');
		$this->db->where('admin.out_source',1);
		$this->db->where('resource_list.r_create_by',$a_id);
		return $this->db->get()->result_array();
	}
	
	/*outsource*/
	public function get_all_patients_out_souces_test_lists($p_id,$b_id){
		$this->db->select('patient_lab_test_list.id,lab_test_list.t_name,lab_test_list.t_id,lab_test_list.t_name,lab_test_list.out_source,lab_test_list.hos_id,resource_list.a_id')->from('patient_lab_test_list');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_test_list.test_id', 'left');
		$this->db->join('admin', 'admin.a_id = lab_test_list.create_by', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admin.a_id', 'left');
		$this->db->where('patient_lab_test_list.p_id',$p_id);
		$this->db->where('patient_lab_test_list.b_id',$b_id);
		$this->db->where('patient_lab_test_list.out_source',1);
		return $this->db->get()->result_array();
	}
	public function get_all_patients_all_out_souces_test_lists($test_name){
		$this->db->select('lab_test_list.t_name,lab_test_list.t_id,lab_test_list.duration,lab_test_list.amuont,lab_test_list.out_source,lab_test_list.hos_id,admin.a_name,admin.a_id,resource_list.resource_name,resource_list.resource_add1,resource_list.resource_add2,resource_list.resource_city,resource_list.resource_state,resource_list.resource_zipcode')->from('lab_test_list');
		$this->db->join('admin', 'admin.a_id = lab_test_list.create_by', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admin.a_id', 'left');
		$this->db->where('lab_test_list.t_name',$test_name);
		//$this->db->where('lab_test_list.out_source',1);
		return $this->db->get()->result_array();
	}
	public function get_test_locaton_list($test_name){
		$this->db->select('lab_test_list.t_id,lab_test_list.t_name,resource_list.resource_city')->from('lab_test_list');
		$this->db->join('resource_list', 'resource_list.a_id = lab_test_list.create_by', 'left');
		$this->db->where('lab_test_list.t_name',$test_name);
		$this->db->group_by('resource_list.resource_city');
		return $this->db->get()->result_array();
		
	}
	
	public function save_lab_tests($data){
		$this->db->insert('out_source_lab_test_lists', $data);
		return $insert_id = $this->db->insert_id();	
	}
	public function get_out_source_lab_test_list($p_id,$b_id){
		$this->db->select('out_source_lab_test_lists.p_l_t_id,out_source_lab_test_lists.p_id,out_source_lab_test_lists.b_id')->from('out_source_lab_test_lists');
		$this->db->where('out_source_lab_test_lists.p_id',$p_id);
		$this->db->where('out_source_lab_test_lists.b_id',$b_id);
		$this->db->where('out_source_lab_test_lists.status',0);
		return $this->db->get()->result_array();
	}
	public function get_outsources_labtests_details($lab_id){
		$this->db->select('lab_test_list.t_name,patients_list_1.pid,patients_list_1.name,patients_list_1.mobile,patients_list_1.perment_address,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_zipcode,patients_list_1.p_country_name,out_source_lab_test_lists.*')->from('out_source_lab_test_lists');
		$this->db->join('patients_list_1', 'patients_list_1.pid = out_source_lab_test_lists.p_id', 'left');
		$this->db->join('patient_lab_test_list', 'patient_lab_test_list.id = out_source_lab_test_lists.p_l_t_id', 'left');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_test_list.test_id', 'left');
		$this->db->where('out_source_lab_test_lists.lab_id',$lab_id);
		return $this->db->get()->result_array();
	}
	public function get_all_outsources_labtests_details($lab_id){
		$this->db->select('lab_test_list.t_name,patients_list_1.pid,patients_list_1.name,patients_list_1.mobile,patients_list_1.perment_address,patients_list_1.p_c_name,patients_list_1.p_s_name,patients_list_1.p_zipcode,patients_list_1.p_country_name,out_source_lab_test_lists.*')->from('out_source_lab_test_lists');
		$this->db->join('patients_list_1', 'patients_list_1.pid = out_source_lab_test_lists.p_id', 'left');
		$this->db->join('patient_lab_test_list', 'patient_lab_test_list.id = out_source_lab_test_lists.p_l_t_id', 'left');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_test_list.test_id', 'left');
		$this->db->where('out_source_lab_test_lists.lab_id',$lab_id);
		$this->db->group_by('out_source_lab_test_lists.b_id');
		return $this->db->get()->result_array();
	}
	
	public function get_all_patients_location_wise_all_out_souces_test_lists($test_name,$location){
		$this->db->select('lab_test_list.t_name,lab_test_list.duration,lab_test_list.amuont,lab_test_list.out_source,lab_test_list.hos_id,admin.a_name,admin.a_id,resource_list.resource_name,resource_list.resource_add1,resource_list.resource_add2,resource_list.resource_city,resource_list.resource_state,resource_list.resource_zipcode')->from('lab_test_list');
		$this->db->join('admin', 'admin.a_id = lab_test_list.create_by', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admin.a_id', 'left');
		$this->db->where('lab_test_list.t_name',$test_name);
		$this->db->where_in('resource_list.resource_city',$location);
		return $this->db->get()->result_array();
	}
	public function save_search_data($data){
		$this->db->insert('out_source_lab_search', $data);
		return $insert_id = $this->db->insert_id();	
	}
	public function get_test_names($t_id){
		$this->db->select('lab_test_list.t_id,lab_test_list.t_name')->from('lab_test_list');
		$this->db->where('lab_test_list.t_id',$t_id);
		return $this->db->get()->row_array();
	}
	public function get_test_lab_ids($t_name){
		$this->db->select('lab_test_list.t_id,lab_test_list.t_name,resource_list.a_id')->from('lab_test_list');
		$this->db->join('admin', 'admin.a_id = lab_test_list.create_by', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admin.a_id', 'left');
		$this->db->where('lab_test_list.t_name',$t_name);
		return $this->db->get()->result_array();
	}
	public function sent_bidding_for_test($data){
		$this->db->insert('bidding_test', $data);
		return $insert_id = $this->db->insert_id();	
	}
	public function get_all_bidding_test_list($a_id){
		$this->db->select('bidding_test.id,bidding_test.test_id,bidding_test.duration,bidding_test.amount,bidding_test.status,bidding_test.create_at,lab_test_list.t_name')->from('bidding_test');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = bidding_test.test_id', 'left');
		$this->db->where('bidding_test.create_by',$a_id);
		$this->db->order_by('bidding_test.id',"DESC");
		return $this->db->get()->result_array();
	}
	public function get_bidding_test_list($a_id){
		$this->db->select('bidding_test.id,bidding_test.test_id,bidding_test.duration,bidding_test.amount,bidding_test.status,bidding_test.create_at,lab_test_list.t_name')->from('bidding_test');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = bidding_test.test_id', 'left');
		$this->db->where('bidding_test.lab_id',$a_id);
		$this->db->order_by('bidding_test.id',"DESC");
		return $this->db->get()->result_array();
	}
	public function update_bidding_details($b_id,$data){
			$this->db->where('id',$b_id);
    	return $this->db->update("bidding_test",$data);
	}
	public function get_bidding_details($b_id){
		$this->db->select('*')->from('bidding_test');
		$this->db->where('bidding_test.id',$b_id);
		return $this->db->get()->row_array();
	}
	/*outsource*/
	/* search result*/
	public function get_search_result($a_id){
		$this->db->select('*')->from('out_source_lab_search');
		$this->db->where('out_source_lab_search.created_by',$a_id);
		$this->db->group_by('out_source_lab_search.location');
		$this->db->where('out_source_lab_search.location !=','');
		return $this->db->get()->result_array();
		
	}
	public function get_search_result_patient_ids($a_id,$ip){
		$this->db->select('*')->from('out_source_lab_search');
		$this->db->where('out_source_lab_search.created_by',$a_id);
		$this->db->where('out_source_lab_search.ip_address',$ip);
		return $this->db->get()->result_array();
		
	}
	public function get_all_patients_all_out_souces_test_lists_with_areawise($test_name,$location){
		$this->db->select('lab_test_list.t_name,lab_test_list.t_id,lab_test_list.duration,lab_test_list.amuont,lab_test_list.out_source,lab_test_list.hos_id,admin.a_name,admin.a_id,resource_list.resource_name,resource_list.resource_add1,resource_list.resource_add2,resource_list.resource_city,resource_list.resource_state,resource_list.resource_zipcode')->from('lab_test_list');
		$this->db->join('admin', 'admin.a_id = lab_test_list.create_by', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admin.a_id', 'left');
		$this->db->where('lab_test_list.t_name',$test_name);
		//$this->db->where_in('resource_list.resource_city',$location);
		$this->db->where_in('resource_list.resource_city','"'.$location.'"',false);

		return $this->db->get()->result_array();
	}
	public function getprevious_search_data($a_id,$location_name){
		$this->db->select('*')->from('out_source_lab_search');
		$this->db->where('out_source_lab_search.created_by',$a_id);
		$this->db->where('out_source_lab_search.location',$location_name);
		return $this->db->get()->result_array();
	}
	public function delete_previous_search_data($id,$data){
		$this->db->where('id',$id);
    	return $this->db->update("out_source_lab_search",$data);
	}
	public function get_previous_search_data($a_id,$ip){
		$this->db->select('*')->from('out_source_lab_search');
		$this->db->where('out_source_lab_search.created_by',$a_id);
		$this->db->where('out_source_lab_search.ip_address',$ip);
		return $this->db->get()->result_array();
	}
	
	public function delete_get_previous_search_data($id){
		$sql1="DELETE FROM out_source_lab_search WHERE id = '".$id."'";
		return $this->db->query($sql1);
	}
	/* search result*/
	
	/* out lab patient report details looikng into in lab */
	public function get_all_patients_out_labtest_lists($p_id,$b_id,$out_source,$a_id){
		$this->db->select('lab_test_list.t_name,lab_test_list.t_id,lab_test_list.out_source,lab_test_list.hos_id')->from('patient_lab_test_list');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_test_list.test_id', 'left');
		$this->db->join('bidding_test', 'bidding_test.test_id = lab_test_list.t_id', 'left');
		$this->db->where('patient_lab_test_list.p_id',$p_id);
		$this->db->where('bidding_test.b_id',$b_id);
		$this->db->where('bidding_test.send_by',$a_id);
		$this->db->where('patient_lab_test_list.out_source',$out_source);
		$this->db->where('bidding_test.status',4);
		return $this->db->get()->result_array();	
	}
	public function get_all_patients_in_labtest_lists($p_id,$b_id,$out_source){
		$this->db->select('lab_test_list.t_name,lab_test_list.t_id,lab_test_list.out_source,lab_test_list.hos_id')->from('patient_lab_test_list');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_test_list.test_id', 'left');
		$this->db->where('patient_lab_test_list.p_id',$p_id);
		$this->db->where('patient_lab_test_list.b_id',$b_id);
		$this->db->where('patient_lab_test_list.out_source',$out_source);
		return $this->db->get()->result_array();	
	}
	
	public  function get_all_patients_lab_report_lists($pid,$bid){
		$this->db->select('patient_lab_reports.*,lab_test_list.t_name')->from('patient_lab_reports');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_reports.test_id', 'left');
		$this->db->where('patient_lab_reports.p_id',$pid);
		$this->db->where('patient_lab_reports.b_id',$bid);
		return $this->db->get()->result_array();
	}
	public  function get_all_patients_out_source_lab_report_lists($pid,$bid,$out_source,$a_id){
		$this->db->select('patient_lab_reports.*,lab_test_list.t_name')->from('patient_lab_reports');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = patient_lab_reports.test_id', 'left');
		$this->db->where('patient_lab_reports.p_id',$pid);
		$this->db->where('patient_lab_reports.b_id',$bid);
		$this->db->where('lab_test_list.out_source',$out_source);
		$this->db->where('patient_lab_reports.create_by',$a_id);
		return $this->db->get()->result_array();
	}
	public  function get_all_with_bidding_patients_out_labtest_lists($pid,$bid,$status){
		$this->db->select('lab_test_list.t_name,lab_test_list.t_id')->from('out_source_lab_test_lists');
		$this->db->join('lab_test_list', 'lab_test_list.t_id = out_source_lab_test_lists.p_l_t_id', 'left');
		$this->db->where('out_source_lab_test_lists.p_id',$pid);
		$this->db->where('out_source_lab_test_lists.b_id',$bid);
		$this->db->where('out_source_lab_test_lists.status',$status);
		return $this->db->get()->result_array();
	}
	public function get_previous_report_details($pid,$bid,$test_id){
		
		$this->db->select('patient_lab_reports.*')->from('patient_lab_reports');
		$this->db->where('patient_lab_reports.test_id',$test_id);
		$this->db->where('patient_lab_reports.p_id',$pid);
		$this->db->where('patient_lab_reports.b_id',$bid);
		return $this->db->get()->row_array();
	}
	public function delete_previous_report_details($pid,$bid,$test_id){
		$this->db->where('patient_lab_reports.test_id',$test_id);
		$this->db->where('patient_lab_reports.p_id',$pid);
		$this->db->where('patient_lab_reports.b_id',$bid);
		$this->db->delete('patient_lab_reports');
	}
	
	public function check_report_all_geting($pid,$bid){
		$this->db->select('patient_lab_test_list.*')->from('patient_lab_test_list');
		$this->db->where('patient_lab_test_list.p_id',$pid);
		$this->db->where('patient_lab_test_list.b_id',$bid);
		$this->db->where('patient_lab_test_list.report_completed',0);
		return $this->db->get()->result_array();
	}
	public function delete_accept_bidding_remaining_tests($t_id){
		$this->db->select('bidding_test.*')->from('bidding_test');
		$this->db->where('bidding_test.test_id',$t_id);
		$this->db->where('bidding_test.status !=',4);
		return $this->db->get()->result_array();
	}
	public function delete_accept_bidding_test($test_id){
		$this->db->where('bidding_test.id',$test_id);
		$this->db->delete('bidding_test');
	}
	public function get_test_details($t_id){
		$this->db->select('lab_test_list.*')->from('lab_test_list');
		$this->db->where('lab_test_list.t_id',$t_id);
		return $this->db->get()->row_array();
	}
	 public function check_test_details($t_id){
		$this->db->select('*')->from('lab_test_list');
		$this->db->where('t_id',$t_id);
		return $this->db->get()->row_array(); 
	}
	public function update_tabtest_details($t_id,$data){
		$this->db->where('t_id',$t_id);
		return $this->db->update('lab_test_list',$data);
		
	}
	public function insert_data_lab_detail_value($data){
	$this->db->insert('lab_test_list', $data);
     return  $this->db->insert_id();
	}
	public function get_labtest_type_id($type_name){
		$this->db->select('id')->from('lab_test_type');
		$this->db->where('lab_test_type.type_name',$type_name);
		return $this->db->get()->row_array();
	}
	
	public function get_lab_get_type_name($data){
	$this->db->insert('lab_test_list', $data);
     return  $this->db->insert_id();
	}
	
	public  function check_test_name_exits($t_name,$type){
		$this->db->select('t_name,type')->from('lab_test_list');
		$this->db->where('lab_test_list.t_name',$t_name);
		$this->db->where('lab_test_list.type',$type);
		return $this->db->get()->row_array();
	}
	
	
	

}