<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Billing_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	
	public  function get_coupon_code_details($code,$code_id,$hos_id){
		$this->db->select('coupon_code_list.c_c_l_id,coupon_code_list.op_amount_percentage,coupon_code_list.ip_amount_percentage,coupon_code_list.created_by,coupon_code_list.created_at')->from('coupon_code_list');
		$this->db->where('coupon_code_list.hos_id',$hos_id);
		$this->db->where('coupon_code_list.c_c_l_id',$code_id);
		$this->db->where('coupon_code_list.type',2);
		$this->db->where('coupon_code_list.couponcode_name',$code);
		return $this->db->get()->row_array();
	}
	public  function save_coupon_code_history($data){
		$this->db->insert('coupon_code_history',$data);
		return $this->db->insert_id();
	}
	
	/* appointment amount  details */
	public  function update_op_wallet_amt_details($a_u_id,$data){
		$this->db->where('a_u_id',$a_u_id);
		return $this->db->update('appointment_users',$data);
	}
	public  function get_wallet_amt_details($a_u_id){
		$this->db->select('wallet_amount,wallet_amount_id,remaining_wallet_amount')->from('appointment_users');
		$this->db->where('a_u_id',$a_u_id);
		return $this->db->get()->row_array();
	}
	
	public  function get_lastest_patient_billing_details($patient_id){
		$this->db->select('b_id,p_id')->from('patient_billing');
		$this->db->where('p_id',$patient_id);
		$this->db->order_by('b_id','desc');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	public  function save_billing_data($data){
		$this->db->insert('billing_history',$data);
		return $this->db->insert_id();
	}
	
	public  function get_all_billing_list($hos_id){
		$this->db->select('*')->from('billing_history');
		$this->db->where('hos_id',$hos_id);
		$this->db->order_by('b_h_id','desc');
		return $this->db->get()->result_array();
	}
	
	
	
	/* lab coupon  code  list purpose */
	public  function get_labcoupon_code_details($code,$code_id,$hos_id){
		$this->db->select('coupon_code_list.c_c_l_id,coupon_code_list.op_amount_percentage,coupon_code_list.lab_amount_percentage,coupon_code_list.created_by,coupon_code_list.created_at')->from('coupon_code_list');
		$this->db->where('coupon_code_list.hos_id',$hos_id);
		$this->db->where('coupon_code_list.c_c_l_id',$code_id);
		$this->db->where('coupon_code_list.type',3);
		$this->db->where('coupon_code_list.couponcode_name',$code);
		return $this->db->get()->row_array();
	}
	/* lab coupon  code  list purpose */
}

	
