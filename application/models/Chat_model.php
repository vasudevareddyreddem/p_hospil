<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	
	public function adding_team_chating($data){
		$this->db->insert('team_chating', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function adding_hospital_admin_chating($data){
		$this->db->insert('hospital_admin_chating', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function getget_team_replay_message_list($user_id){
		$this->db->select('team_chating.*,sentname.a_name as replayname,admin.a_name as replayedname')->from('team_chating');
		$this->db->join('admin as sentname', 'sentname.a_id = team_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = team_chating.replay_user_id', 'left');
		$this->db->where('team_chating.user_id',$user_id);
		$this->db->order_by('team_chating.id',"asc");
        return $this->db->get()->result_array();	
	}
	public function get_hospitaladmin_replay_message_list($user_id){
		$this->db->select('hospital_admin_chating.*,sentname.resource_name as replayname,sentname.resource_photo as replaypic,admin.a_name as replayedname,admin.a_profile_pic as replayedpic')->from('hospital_admin_chating');
		$this->db->join('resource_list as sentname', 'sentname.a_id = hospital_admin_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = hospital_admin_chating.replay_user_id', 'left');
		$this->db->where('hospital_admin_chating.user_id',$user_id);
		$this->db->order_by('hospital_admin_chating.id',"asc");
        return $this->db->get()->result_array();	
	}
	public function get_resource_list($hos_id){
		$this->db->select('resource_list.a_id,resource_list.resource_name')->from('resource_list');
		$this->db->where('resource_list.hos_id',$hos_id);
        return $this->db->get()->result_array();	
	}
	public function adding_resource_chating($data){
		$this->db->insert('resource_chating', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_resource_chating_list($user_id){
		$this->db->select('resource_chating.*,sentname.resource_name as sendername,sentname.resource_photo as senderpic,toname.resource_name as resourcename,toname.resource_photo as resourcepic,')->from('resource_chating');
		$this->db->join('resource_list as sentname', 'sentname.a_id = resource_chating.user_id', 'left');
		$this->db->join('resource_list as toname', 'toname.a_id = resource_chating.to', 'left');
		$this->db->like('resource_chating.to',$user_id);
		$this->db->or_like('resource_chating.user_id',$user_id);
		$this->db->order_by('resource_chating.id',"asc");
        return $this->db->get()->result_array();	
	}
	/* admin chating to hospital chating*/
	public function adding_adminchating_with_hospital_chating($data){
		$this->db->insert('admin_chating', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_sender_id($id){
		$this->db->select('admin_chating.sender_id,admin_chating.reciver_id')->from('admin_chating');		
		$this->db->where('reciver_id', $id);
		$this->db->order_by('admin_chating.id', "DESC");
        return $this->db->get()->row_array();
	}
	/* admin chating to hospital chating*/
	
	/* out  source lab testing */
	public function adding_adminchating_with_outsource_lab_chating($data){
		$this->db->insert('out_source_lab_chating', $data);
		return $insert_id = $this->db->insert_id();
	}
	/* out  source lab testing */
	

}