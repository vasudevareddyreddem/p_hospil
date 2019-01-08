<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cardnumber_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function check_email_already_already_exits($email_id){
	$this->db->select('*')->from('card_sellers');
	$this->db->where('email_id',$email_id);
	return $this->db->get()->row_array();
	}
	public  function save_appointment_user($data){
		$this->db->insert('card_sellers',$data);
		return $this->db->insert_id();
		
	}
	public  function check_login_details($email_id,$password){
		$this->db->select('s_id,name,email_id,mobile,profile_pic,address,bank_account,bank_name,ifsccode,bank_holder_name,kyc')->from('card_sellers');
		$this->db->where('email_id',$email_id);
		$this->db->where('password',md5($password));
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	public  function check_user_details($id){
		$this->db->select('*')->from('card_sellers');
		$this->db->where('s_id',$id);
		return $this->db->get()->row_array();
	}
	public  function update_user_password($id,$pass){
		$data=array('password'=>md5($pass),'org_password'=>$pass);
		$this->db->where('s_id',$id);
		return $this->db->update('card_sellers',$data);
		
	}
	public  function update_user_pushnotification_token($id,$data){
		$this->db->where('s_id',$id);
		return $this->db->update('card_sellers',$data);
		
	}
	public  function update_seller_profile_details($id,$data){
		$this->db->where('s_id',$id);
		return $this->db->update('card_sellers',$data);
		
	}
	public  function get_card_seller_details($s_id){
		$this->db->select('kyc')->from('card_sellers');
		$this->db->where('s_id',$s_id);
		return $this->db->get()->row_array();
	}
	public function get_seller_card_list($s_id){
		$this->db->select('c_id,card_number')->from('card_numbers');
		$this->db->where('assign_seller',$s_id);
		$this->db->where('assign_customer',0);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public  function update_cardnumber_assign_to_customer($s_id,$c_id,$data){
		$this->db->where('assign_seller',$s_id);
		$this->db->where('c_id',$c_id);
		return $this->db->update('card_numbers',$data);
	}
	public  function check_c_id_seller($s_id,$c_id){
		$this->db->select('c_id')->from('card_numbers');
		$this->db->where('assign_seller',$s_id);
		$this->db->where('c_id',$c_id);
		return $this->db->get()->row_array();
	}
	public function get_assign_cardnumber_list($s_id){
		$this->db->select('c_id,card_number,cust_name,mobile,whatsapp_number,aadhar_number,email_id,gender')->from('card_numbers');
		$this->db->where('assign_seller',$s_id);
		$this->db->where('assign_customer',1);
		return $this->db->get()->result_array();
	}
	public function get_seller_details($s_id){
		$this->db->select('s_id,name,email_id,mobile,profile_pic,address,bank_account,bank_name,ifsccode,bank_holder_name,kyc')->from('card_sellers');
			$this->db->where('s_id',$s_id);

		return $this->db->get()->row_array();	
	}
	
	/* seller different flow  purpose*/
	public  function save_seller_card_limit($data){
		$this->db->insert('seller_card_count',$data);
		return $this->db->insert_id();
	}
	public  function save_card_number_details($data){
		$this->db->insert('seller_card_assign_munber_list',$data);
		return $this->db->insert_id();
	}
	public  function mobile_number_exists($mobile){
		
		$this->db->select('*')->from('seller_card_assign_munber_list');
		$this->db->where('mobile_num',$mobile);
		$this->db->where('mobile_verified',1);
		return $this->db->get()->row_array();
	}
	
	public  function get_opt_details($s_id,$card_assign_number){
		
		$this->db->select('card_id,s_id,card_number,otp,mobile_num')->from('seller_card_assign_munber_list');
		$this->db->where('s_id',$s_id);
		$this->db->where('card_id',$card_assign_number);
		return $this->db->get()->row_array();
	}
	public function update_otp_verification($s_id,$card_assign_number,$data){
		$this->db->where('s_id',$s_id);
		$this->db->where('card_id',$card_assign_number);
		return $this->db->update('seller_card_assign_munber_list',$data);
	}
	public function get_Card_number_count($s_id){
		$this->db->select("COUNT(seller_card_assign_munber_list.card_id) as c_count")->from('seller_card_assign_munber_list');
		$this->db->where('s_id',$s_id);
		return $this->db->get()->row_array();
	}
	public function get_seller_count_limit($s_id){
		$this->db->select("SUM(seller_card_count.limit)as total_limit,s_id")->from('seller_card_count');
		$this->db->where('s_id',$s_id);
		return $this->db->get()->row_array();
	}
	public  function get_card_number(){
		$this->db->select("card_number")->from('seller_card_assign_munber_list');
		$this->db->order_by('card_id','desc');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	
	
	
}