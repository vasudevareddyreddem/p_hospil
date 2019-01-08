<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Medicine_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function get_all_medicine_list($hos_id){
		$this->db->select('medicine_name.medicine_name')->from('medicine_name');		
		$this->db->where('medicine_name.hos_id',$hos_id);
		$this->db->where('medicine_name.status',1);
        return $this->db->get()->result_array();	
	}
	public function get_all_medicine_lists($hos_id){
		$this->db->select('*')->from('medicine_list');		
		$this->db->where('medicine_list.hos_id',$hos_id);
		$this->db->order_by('medicine_list.id',"DESC");
        return $this->db->get()->result_array();	
	}
	public function get_medicine_details($value){
		$this->db->select('medicine_name.medicine_name')->from('medicine_name');		
		$this->db->where('medicine_name.medicine_name',$value);
        return $this->db->get()->row_array();	
	}
	public function save_new_medicine($data){
		$this->db->insert('medicine_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function save_medicine_name($data){
		$this->db->insert('medicine_name', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function update_medicine_details($med_id,$data){
		$this->db->where('id',$med_id);
    	return $this->db->update("medicine_list",$data);
	}
	public function get_medicine_list_details($id){
		$this->db->select('medicine_list.total_amount,medicine_list.sgst,medicine_list.cgst,medicine_list.amount')->from('medicine_list');		
		$this->db->where('medicine_list.id',$id);
        return $this->db->get()->row_array();	
	}
	
	public function delete_medicine($m_id){
	  $this->db->where('id', $m_id);
     return $this->db->delete('medicine_list');
	}
	
	public function insert_data_pramacy($data){
	$this->db->insert('medicine_list', $data);
     return  $this->db->insert_id();
	}

}