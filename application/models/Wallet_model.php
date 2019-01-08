<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wallet_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public  function add_wallet_money_percentage($data){
		$this->db->insert('wallet_amount_percentage',$data);
		return $this->db->insert_id();
	}
	public  function update_wallet_amount_details($w_id,$data){
		$this->db->where('w_id',$w_id);
		return $this->db->update('wallet_amount_percentage',$data);
	}
	public  function delete_wallet_amount($w_id){
		$this->db->where('w_id',$w_id);
		return $this->db->delete('wallet_amount_percentage');
	}
	public  function check_amount_active_ornot($hos_id){
			$this->db->select('*')->from('wallet_amount_percentage');
			$this->db->where('hospital_id',$hos_id);
			$this->db->where('status',1);
			return $this->db->get()->row_array(); 
	}
	
	public  function get_coupon_code_details($code,$patient_id,$hos_id){
		$this->db->select('coupon_code_list.c_c_l_id,coupon_code_list.op_amount_percentage,coupon_code_list.op_amount_percentage,appointments.create_by,coupon_code_list.created_at')->from('coupon_code_list');
		$this->db->join('appointments','appointments.b_id = coupon_code_list.appointment_id','left');
		$this->db->where('coupon_code_list.hos_id',$hos_id);
		$this->db->where('appointments.patient_id',$patient_id);
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
	
	/* add  wallet amount */
	public  function add_wallet_money($data){
		$this->db->insert('wallet_amount',$data);
		return $this->db->insert_id();
	}
	public function check_wallet_amount_active_ornot(){
		$this->db->select('*')->from('wallet_amount');
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	public  function update_wallet_am_details($w_a_id,$data){
		$this->db->where('w_a_id',$w_a_id);
		return $this->db->update('wallet_amount',$data);
	}
}

	
