<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function login_details($email,$pass){
		$sql = "SELECT * FROM customers WHERE (cust_email ='".$email."' AND cust_password='".$pass."') OR (cust_mobile ='".$email."' AND cust_password='".$pass."')";
		return $this->db->query($sql)->row_array();	
	}
	public function update_doctors_details($d_id,$barcode){
		$sql1="UPDATE doctore_list SET d_barcode ='".$barcode."' WHERE d_id = '".$d_id."'";
       	return $this->db->query($sql1);
	}


}