<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function update_admin_details($a_id,$data){
		$this->db->where('a_id',$a_id);
    	return $this->db->update("admin",$data);
	}
	public function update_login_details($a_id,$data){
		$this->db->where('a_id',$a_id);
    	return $this->db->update("hospital",$data);
	}
	public function check_email_exits($email){
		$sql = "SELECT admin.a_id FROM admin WHERE a_email_id ='".$email."'";
		return $this->db->query($sql)->row_array();	
	}
	public  function get_hospital_details_list($a_id){
		$this->db->select('hospital.hos_id,hospital.a_id')->from('hospital');
		$this->db->where('hospital.a_id', $a_id);
		//$this->db->where('a_status', 1);
		return $this->db->get()->row_array();
	}
	public function get_adminpassword_details($admin_id){
		$this->db->select('admin.a_id,admin.a_password')->from('admin');
		$this->db->where('a_id', $admin_id);
		$this->db->where('a_status', 1);
		return $this->db->get()->row_array();	
	}
	public function get_admin_details_data($admin_id){
		$this->db->select('*')->from('admin');
		$this->db->where('a_id', $admin_id);
		return $this->db->get()->row_array();	
	}
	public function save_admin($data){
		$this->db->insert('admin', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function login_details($data){
		$sql = "SELECT * FROM admin WHERE (a_email_id ='".$data['email']."' AND a_password='".$data['password']."' AND a_status=1) OR (a_username ='".$data['email']."' AND a_password='".$data['password']."' AND a_status=1)";
		return $this->db->query($sql)->row_array();	
	}
	public function email_check_details($email){
		$sql = "SELECT * FROM admin WHERE a_email_id ='".$email."'";
		return $this->db->query($sql)->row_array();	
	}
	public function email_check_details_check($a_email_id){
		$this->db->select('*')->from('admin');		
		$this->db->where('a_email_id', $a_email_id);
		$this->db->where('a_status !=', 2);
        return $this->db->get()->row_array();	
	}
	public function get_admin_details($admin_id){
		$this->db->select('admin.a_id,admin.role_id,admin.a_email_id,admin.out_source')->from('admin');		
		$this->db->where('a_id', $admin_id);
		$this->db->where('a_status', 1);
        return $this->db->get()->row_array();	
	}
	public function get_all_admin_details($admin_id){
		$this->db->select('admin.a_id,admin.role_id,admin.a_email_id,admin.a_name,admin.out_source,roles.r_name,admin.a_profile_pic')->from('admin');		
		$this->db->join('roles', 'roles.r_id = admin.role_id', 'left');
		$this->db->where('a_id', $admin_id);
		$this->db->where('a_status', 1);
        return $this->db->get()->row_array();	
	}
	public function get_all_Hospital_details(){
		$this->db->select('hospital.hos_id,hospital.hos_bas_name')->from('hospital');		
		$this->db->where('hos_status', 1);
		$this->db->where('hos_undo',0);
        return $this->db->get()->result_array();	
	}
	public function get_all_out_source_lab_details($a_id){
		$this->db->select('resource_list.r_id,resource_list.a_id,resource_list.resource_name')->from('resource_list');		
		$this->db->where('resource_list.out_source_lab ', 1);
		$this->db->where('resource_list.r_create_by', $a_id);
        return $this->db->get()->result_array();	
	}
	
	public function getget_team_message_list(){
		$this->db->select('team_chating.*,sentname.a_name as replayname,sentname.a_profile_pic as replaypic,admin.a_name as replayedname,admin.a_profile_pic as replayedpic')->from('team_chating');
		$this->db->join('admin as sentname', 'sentname.a_id = team_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = team_chating.replay_user_id', 'left');
		$this->db->order_by('team_chating.id',"DESC");
		$this->db->group_by('team_chating.user_id');
        return $this->db->get()->result_array();	
	}
	public function get_resourse_message_list($hos_id){
		$this->db->select('hospital_admin_chating.*,sentname.resource_name as replayname,sentname.resource_photo as replaypic,admin.a_name as replayedname,admin.a_profile_pic as replayedpic')->from('hospital_admin_chating');
		$this->db->join('resource_list as sentname', 'sentname.a_id = hospital_admin_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = hospital_admin_chating.replay_user_id', 'left');
		$this->db->where('hospital_admin_chating.hos_id',$hos_id);
		$this->db->group_by('hospital_admin_chating.user_id');
		$this->db->order_by('hospital_admin_chating.id',"asc");
		return $this->db->get()->result_array();	
	}
	public function getget_team_replay_message_list($user_id){
		$this->db->select('team_chating.*,sentname.a_name as replayname,admin.a_name as replayedname')->from('team_chating');
		$this->db->join('admin as sentname', 'sentname.a_id = team_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = team_chating.replay_user_id', 'left');
		$this->db->where('team_chating.user_id',$user_id);
		$this->db->order_by('team_chating.id',"asc");
        return $this->db->get()->result_array();	
	}
	public function getget_resourse_replay_message_list($user_id){
		$this->db->select('hospital_admin_chating.*,sentname.a_name as replayname,admin.a_name as replayedname')->from('hospital_admin_chating');
		$this->db->join('admin as sentname', 'sentname.a_id = hospital_admin_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = hospital_admin_chating.replay_user_id', 'left');
		$this->db->where('hospital_admin_chating.user_id',$user_id);
		$this->db->order_by('hospital_admin_chating.id',"asc");
        return $this->db->get()->result_array();	
	}
	public function getget_lab_resourse_replay_message_list($user_id){
		$this->db->select('out_source_lab_chating.*,sentname.a_name as replayname,admin.a_name as replayedname')->from('out_source_lab_chating');
		$this->db->join('admin as sentname', 'sentname.a_id = out_source_lab_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = out_source_lab_chating.replay_user_id', 'left');
		$this->db->where('out_source_lab_chating.user_id',$user_id);
		$this->db->order_by('out_source_lab_chating.id',"asc");
        return $this->db->get()->result_array();	
	}
	public function get_Hospital_name($id){
		$this->db->select('hospital.hos_bas_name')->from('hospital');		
		$this->db->where('hos_id', $id);
        return $this->db->get()->row_array();
	}
	public function get_outsource_lab_name($r_id){
		$this->db->select('resource_list.resource_name')->from('resource_list');		
		$this->db->where('a_id', $r_id);
        return $this->db->get()->row_array();
	}
	public function get_resource_name($id){
		$this->db->select('resource_list.resource_name')->from('resource_list');		
		$this->db->where('a_id', $id);
        return $this->db->get()->row_array();
	}
	public function save_announcements_list($data){
		$this->db->insert('announcements', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_all_sent_notification_details($a_id){
		$this->db->select('announcements.*')->from('announcements');		
		$this->db->where('sent_by', $a_id);
		$this->db->group_by('announcements.comment');
        $return=$this->db->get()->result_array();
		foreach( $return as $Lis){
			
			$msg=$this->get_sent_announcements_resouces_list($Lis['comment']);
			$data[$Lis['int_id']]=$Lis;
			$data[$Lis['int_id']]['h_list']=$msg;
		}
		if(!empty($data))
		{
		return $data;
		}
	}
	public function get_sent_announcements_resouces_list($msg){
		$this->db->select('announcements.hos_id,hospital.hos_bas_name')->from('announcements');	
		$this->db->join('hospital', 'hospital.hos_id = announcements.hos_id', 'left');
		$this->db->where('comment', $msg);
        return $this->db->get()->result_array();
	}
	public function save_notification($data){
		$this->db->insert('notifications', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_all_announcements_details(){
		$this->db->select('announcements.*,hospital.hos_bas_name,admin.a_name as sentname')->from('announcements');
		$this->db->join('hospital', 'hospital.hos_id = announcements.hos_id', 'left');
		$this->db->join('admin', 'admin.a_id = announcements.sent_by', 'left');
		$this->db->group_by('announcements.hos_id');		
		$this->db->order_by('announcements.int_id',"DESC");		
        return $this->db->get()->result_array();	
	}
	
	public function get_hospital_details($a_id){
		$this->db->select('hospital.hos_bas_name,hospital.hos_id')->from('hospital');		
		$this->db->where('a_id', $a_id);
        return $this->db->get()->row_array();	
	}
	public function get_hospital_admin_chating($hos_id){
		$this->db->select('admin_chating.*,admin.a_name as sender_name,hospital.hos_bas_name as reciver_name')->from('admin_chating');
		$this->db->join('admin', 'admin.a_id = admin_chating.sender_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = admin_chating.reciver_id', 'left');
		$this->db->where('admin_chating.reciver_id', $hos_id);
		$this->db->or_where('admin_chating.sender_id', $hos_id);
        return $this->db->get()->result_array();	
	}
	public function get_outsourcelab_admin_chating($lab_id){
		
		$this->db->select('out_source_lab_chating.*,sentname.resource_name as replayname,sentname.resource_photo as replaypic,admin.a_name as replayedname,admin.a_profile_pic as replayedpic')->from('out_source_lab_chating');
		$this->db->join('resource_list as sentname', 'sentname.a_id = out_source_lab_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = out_source_lab_chating.replay_user_id', 'left');
		$this->db->where('out_source_lab_chating.user_id',$lab_id);
		$this->db->order_by('out_source_lab_chating.id',"asc");
        return $this->db->get()->result_array();

		
	}
	public function get_admin_chating_with_hospital(){
		$this->db->select('admin_chating.*,admin.out_source,admin.a_name as sender_name,hospital.hos_bas_name as reciver_name')->from('admin_chating');
		$this->db->join('admin', 'admin.a_id = admin_chating.sender_id', 'left');
		$this->db->join('hospital', 'hospital.hos_id = admin_chating.reciver_id', 'left');
		$this->db->group_by('admin_chating.create_at');
		$this->db->group_by('admin_chating.create_by');
        return $this->db->get()->result_array();	
	}
	public function get_all_resouce_details($admin_id){
		$this->db->select('resource_list.hos_id,admin.a_id,admin.role_id,admin.a_email_id,admin.a_name,roles.r_name,admin.a_profile_pic')->from('admin');		
		$this->db->join('roles', 'roles.r_id = admin.role_id', 'left');
		$this->db->join('resource_list', 'resource_list.a_id = admin.a_id', 'left');
		$this->db->where('admin.a_id', $admin_id);
		$this->db->where('admin.a_status', 1);
        return $this->db->get()->row_array();	
	}
	public function get_resource_list($hos_id){
		$this->db->select('resource_list.a_id,resource_list.resource_name')->from('resource_list');
		$this->db->where('resource_list.hos_id',$hos_id);
        return $this->db->get()->result_array();	
	}
	public function get_all_announcement($hos_id){
		$this->db->select('*')->from('announcements');
		$this->db->where('announcements.hos_id',$hos_id);
		$this->db->order_by('announcements.int_id',"DESC");
        return $this->db->get()->result_array();	
	}
	public function get_all_announcement_unread_count($hos_id){
		$this->db->select('announcements.int_id')->from('announcements');
		$this->db->where('announcements.hos_id',$hos_id);
		$this->db->where('announcements.readcount',1);
        return $this->db->get()->result_array();	
	}
	public function get_all_notification_details(){
		$this->db->select('*')->from('notifications');
        return $this->db->get()->result_array();	
	}
	public function get_announcements_comment($id){
		$this->db->select('announcements.comment,announcements.create_at')->from('announcements');
		$this->db->where('announcements.int_id',$id);
        return $this->db->get()->row_array();
	}
	public function get_announcement_comment_read($id,$read){
		$this->db->where('int_id', $id);
		return $this->db->update('announcements', $read);
	}
	public function get_hospitals_list_monthwise($date){
		$this->db->select('hospital.hos_id,hospital.hos_created')->from('hospital');
        $this->db->where("DATE_FORMAT(hos_created,'%Y')", $date);
		 $this->db->where('hos_undo ',0);
		return $this->db->get()->result_array();
	}
	public function get_last_sevendays_hospital_list(){
		$start_date = date("Y-m-d H:i:s", strtotime("-1 week"));
		$end_date = date("Y-m-d H:i:s");
		$this->db->select('hospital.hos_id,hospital.hos_created')->from('hospital');
		$this->db->where("hos_created >= '" . $start_date . "' AND hos_created <= '" . $end_date . "'");
		$this->db->where('hos_undo ',0);
		return $this->db->get()->result_array();
	}
	public function get_hospitals_patient_list_monthwise($hos_id,$date){
		$this->db->select('patient_billing.p_id,patient_billing.create_at')->from('patient_billing');
        $this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->where("DATE_FORMAT(patient_billing.create_at,'%Y')", $date);
		$this->db->where("patient_billing.completed", 1);
        $this->db->where("patients_list_1.hos_id", $hos_id);
		return $this->db->get()->result_array();
	}
	public function get_hospitals_reschudle_patient_list_monthwise($hos_id,$date){
		$this->db->select('patient_billing.p_id,patient_billing.create_at')->from('patient_billing');
        $this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->where("DATE_FORMAT(patient_billing.create_at,'%Y')", $date);
		$this->db->where("patient_billing.completed", 1);
		$this->db->where("patient_billing.type", "reschedule");
        $this->db->where("patients_list_1.hos_id", $hos_id);
		return $this->db->get()->result_array();
	}
	public function get_hospitals_new_patient_list_monthwise($hos_id,$date){
		$this->db->select('patient_billing.p_id,patient_billing.create_at')->from('patient_billing');
        $this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->where("DATE_FORMAT(patient_billing.create_at,'%Y')", $date);
		$this->db->where("patient_billing.completed", 1);
		$this->db->where("patient_billing.type", "New");
        $this->db->where("patients_list_1.hos_id", $hos_id);
		return $this->db->get()->result_array();
	}
	public function get_last_sevendays_hospital_new_patient_list($hos_id){
		$start_date = date("Y-m-d H:i:s", strtotime("-1 week"));
		$end_date = date("Y-m-d H:i:s");
		$this->db->select('patient_billing.b_id,patient_billing.p_id,patient_billing.create_at')->from('patient_billing');
        $this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->where("patient_billing.create_at >= '" . $start_date . "' AND patient_billing.create_at <= '" . $end_date . "'");
		$this->db->where("patients_list_1.hos_id", $hos_id);
		$this->db->where("patient_billing.completed", 1);
		$this->db->where("patient_billing.type", "New");
		return $this->db->get()->result_array();
	}
	public function get_hospital_new_patient_list($hos_id){
		$this->db->select('patient_billing.b_id,patient_billing.p_id,patient_billing.create_at')->from('patient_billing');
        $this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->where("patients_list_1.hos_id", $hos_id);
		$this->db->where("patient_billing.completed", 1);
		$this->db->where("patient_billing.type", "New");
		return $this->db->get()->result_array();
	}
	public function get_last_sevendays_hospital_reschedule_patient_list($hos_id){
		$start_date = date("Y-m-d H:i:s", strtotime("-1 week"));
		$end_date = date("Y-m-d H:i:s");
		$this->db->select('patient_billing.b_id,patient_billing.p_id,patient_billing.create_at')->from('patient_billing');
        $this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->where("patient_billing.create_at >= '" . $start_date . "' AND patient_billing.create_at <= '" . $end_date . "'");
		$this->db->where("patients_list_1.hos_id", $hos_id);
		$this->db->where("patient_billing.completed", 1);
		$this->db->where("patient_billing.type", "reschedule");
		return $this->db->get()->result_array();
	}
	public function get_hospital_reschedule_patient_list($hos_id){
		$this->db->select('patient_billing.b_id,patient_billing.p_id,patient_billing.create_at')->from('patient_billing');
        $this->db->join('patients_list_1', 'patients_list_1.pid = patient_billing.p_id', 'left');
		$this->db->where("patients_list_1.hos_id", $hos_id);
		$this->db->where("patient_billing.completed", 1);
		$this->db->where("patient_billing.type", "reschedule");
		return $this->db->get()->result_array();
	}
	public function get_hospital_edit_prescriptions_list($hos_id){
		$this->db->select('patient_medicine_list.p_id,patient_medicine_list.create_at')->from('patient_medicine_list');
        $this->db->join('patients_list_1', 'patients_list_1.pid = patient_medicine_list.p_id', 'left');
		$this->db->where("patients_list_1.hos_id", $hos_id);
		$this->db->where("patient_medicine_list.edited", 1);
		$this->db->group_by("patient_medicine_list.b_id");
		return $this->db->get()->result_array();
	}
	/* resource announcement */
	public function get_all_resource_announcement($res_id){
		$this->db->select('*')->from('hospital_announcements');
		$this->db->where('hospital_announcements.res_id',$res_id);
		$this->db->order_by('hospital_announcements.int_id',"DESC");
        return $this->db->get()->result_array();	
	}
	public function get_all_resource_announcement_unread_count($res_id){
		$this->db->select('hospital_announcements.int_id')->from('hospital_announcements');
		$this->db->where('hospital_announcements.res_id',$res_id);
		$this->db->where('hospital_announcements.readcount',1);
        return $this->db->get()->result_array();	
	}
	public function get_resource_announcements_comment($id){
		$this->db->select('hospital_announcements.comment,hospital_announcements.create_at')->from('hospital_announcements');
		$this->db->where('hospital_announcements.int_id',$id);
        return $this->db->get()->row_array();
	}
	public function get_resource_announcement_comment_read($id,$read){
		$this->db->where('int_id', $id);
		return $this->db->update('hospital_announcements', $read);
	}
	public function save_out_source_lab($data){
		$this->db->insert('resource_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_resourse_details($id){
		$this->db->select('resource_list.r_id,resource_list.a_id')->from('resource_list');
		$this->db->where('resource_list.r_id',$id);
        return $this->db->get()->row_array();
	}
	public function update_resourse_details($id,$data){
		$this->db->where('a_id',$id);
    	return $this->db->update("admin",$data);
	}
	public function delete_out_sources($t_id){
		$sql1="DELETE FROM admin WHERE a_id = '".$t_id."'";
		return $this->db->query($sql1);
	}
	public function delete_resourse_details($t_id){
		$sql1="DELETE FROM resource_list WHERE r_id = '".$t_id."'";
		return $this->db->query($sql1);
	}
	public function save_coupon_codes($data){
		$this->db->insert('coupon_codes', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_all_coupon_code_list($id){
		$this->db->select('coupon_codes.*,hospital.hos_bas_name')->from('coupon_codes');
		$this->db->join('hospital', 'hospital.hos_id = coupon_codes.hospital_id', 'left');
		$this->db->where('coupon_codes.create_by',$id);
        return $this->db->get()->result_array();
	}
	public function delete_coupon_code($c_id){
		$sql1="DELETE FROM coupon_codes WHERE id = '".$c_id."'";
		return $this->db->query($sql1);
	}
	public function update_coupon_code_details($id,$data){
		$this->db->where('id',$id);
    	return $this->db->update("coupon_codes",$data);
	}
	public function get_coupon_code_details($code,$hos_id){
		$this->db->select('*')->from('coupon_codes');
		$this->db->where('coupon_codes.coupon_code',$code);
		$this->db->where('coupon_codes.hospital_id',$hos_id);
        return $this->db->get()->row_array();
	}
	public function update_billing_details($pid,$bid,$data){
		$this->db->where('b_id',$bid);
		$this->db->where('p_id',$pid);
    	return $this->db->update("patient_billing",$data);
	}
	
	public function get_get_out_sources_details($r_id){
		$this->db->select('*')->from('resource_list');
		$this->db->where('resource_list.r_id',$r_id);
        return $this->db->get()->row_array();
	}
	public function update_lab_resourse_details($r_id,$data){
		$this->db->where('r_id',$r_id);
    	return $this->db->update("resource_list",$data);
		
	}
	public function get_hosipital_imges($a_id){
		$this->db->select('hospital.hos_bas_logo as img')->from('hospital');
		$this->db->where('hospital.a_id',$a_id);
        return $this->db->get()->row_array();
	}
	public function get_resource_imges($a_id){
		$this->db->select('resource_list.resource_photo as img')->from('resource_list');
		$this->db->where('resource_list.a_id',$a_id);
        return $this->db->get()->row_array();
	}
	public function check_coupon_exits_details($id){
		$this->db->select('*')->from('coupon_codes');
		$this->db->where('coupon_codes.id',$id);
        return $this->db->get()->row_array();
	}public function get_all_sent_notify_details($id){
		$this->db->select('*')->from('notifications');
		$this->db->where('notifications.create_by',$id);
        return $this->db->get()->result_array();
	}
	
	/* out souce lab chating */
	public function get_outsourcelab_message_list($lab_id){
		/*$this->db->select('out_source_lab_chating.*,sentname.resource_name as replayname,sentname.resource_photo as replaypic,admin.a_name as replayedname,admin.a_profile_pic as replayedpic')->from('out_source_lab_chating');
		$this->db->join('resource_list as sentname', 'sentname.a_id = out_source_lab_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = out_source_lab_chating.replay_user_id', 'left');
		$this->db->where('out_source_lab_chating.lab_id',$lab_id);
		$this->db->group_by('out_source_lab_chating.user_id');
		$this->db->order_by('out_source_lab_chating.id',"asc");
		return $this->db->get()->result_array();*/
		
		
		$this->db->select('out_source_lab_chating.*,sentname.resource_name as replayname,sentname.resource_photo as replaypic,admin.a_name as replayedname,admin.a_profile_pic as replayedpic')->from('out_source_lab_chating');
		$this->db->join('resource_list as sentname', 'sentname.a_id = out_source_lab_chating.user_id', 'left');
		$this->db->join('admin', 'admin.a_id = out_source_lab_chating.replay_user_id', 'left');
		$this->db->group_by('out_source_lab_chating.user_id');
		$this->db->order_by('out_source_lab_chating.id',"asc");
		return $this->db->get()->result_array();	
	}
		
	
	/* out souce lab chating */
	
	/* card  numbers purpose*/
	
	public  function get_lastnumbers(){
		$this->db->select('card_number')->from('card_numbers');
		$this->db->order_by('c_id','desc');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	public  function save_cardnumbers($data){
		$this->db->insert('card_numbers',$data);
		return $this->db->insert_id();
	}
	public  function get_card_numbers_list(){
		$this->db->select('*')->from('card_numbers');
		$this->db->where('pdf_name IS NOT NULL');
		$this->db->group_by('card_numbers.pdf_name');
		return $this->db->get()->result_array();
		
	}
	/* card  numbers purpose*/
	/* card  seller purpose*/
	public  function save_sellers($data){
		$this->db->insert('card_sellers',$data);
		return $this->db->insert_id();
	}
	public  function seller_email_exits($email){
		$this->db->select('s_id')->from('card_sellers');
		$this->db->where('email_id',$email);
		$this->db->where('status !=',2);
		return $this->db->get()->row_array();
		
	}
	public  function get_card_Seller_distrubutors_listss($a_id){
		$this->db->select('*')->from('card_sellers');
		$this->db->where('created_by',$a_id);
		$this->db->where('status !=',2);
		return $this->db->get()->result_array();
		
	}
	public  function get_card_active_Seller_distrubutors_lists($a_id){
		$this->db->select('name,s_id')->from('card_sellers');
		$this->db->where('created_by',$a_id);
		$this->db->where('status !=',2);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
		
	}
	public  function update_distrubtor_details($s_id,$data){
		$this->db->where('s_id',$s_id);
		return $this->db->update('card_sellers',$data);
		
	}
	public  function get_card_distrubtor_details($s_id){
		$this->db->select('*')->from('card_sellers');
		$this->db->where('s_id',$s_id);
		return $this->db->get()->row_array();
	}
	public  function get_card_number_list(){
		$this->db->select('c_id,card_number')->from('card_numbers');
		$this->db->where('status',1);
		$this->db->where('assign_seller',0);
		$this->db->order_by('card_numbers.c_id','asc');
		return $this->db->get()->result_array();
	}
	public  function update_card_number_seller($num,$data){
		$this->db->where('c_id',$num);
		return $this->db->update('card_numbers',$data);
	}
	public  function get_seller_card_numbers_list(){
		$this->db->select('card_numbers.c_id,card_numbers.assign_seller,card_numbers.updated_at,card_numbers.card_number,card_sellers.name,card_sellers.mobile,card_sellers.email_id')->from('card_numbers');
		$this->db->join('card_sellers', 'card_sellers.s_id = card_numbers.assign_seller', 'left');
		$this->db->group_by('card_numbers.assign_seller');
		$this->db->where('assign_seller!=',0);
		$return=$this->db->get()->result_array();
		foreach($return as $lis){
			$start_num=$this->get_card_starting_number($lis['assign_seller']);
			$end_num=$this->get_card_ending_number($lis['assign_seller']);
			$data[$lis['c_id']]=$lis;
			$data[$lis['c_id']]['start_nums']=$start_num['card_number'];
			$data[$lis['c_id']]['end_nums']=$end_num['card_number'];
			
		}
		if(!empty($data)){
			return $data;
		}
	}
	public  function get_card_starting_number($s_id){
		$this->db->select('c_id,card_number')->from('card_numbers');
		$this->db->where('assign_seller',$s_id);
		$this->db->order_by('card_numbers.c_id','asc');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	public  function get_card_ending_number($s_id){
		$this->db->select('c_id,card_number')->from('card_numbers');
		$this->db->where('assign_seller',$s_id);
		$this->db->order_by('card_numbers.c_id','desc');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}
	public  function get_seller_card_number_list($s_id){
		$this->db->select('c_id,card_number')->from('card_numbers');
		$this->db->where('status',1);
		$this->db->where('assign_seller',$s_id);
		$this->db->order_by('card_numbers.c_id','asc');
		return $this->db->get()->result_array();
	}
	public  function check_assing_seller_ids($c_id){
		$this->db->select('c_id,assign_seller')->from('card_numbers');
		$this->db->where('c_id',$c_id);
		return $this->db->get()->row_array();
	}
	/* card  seller purpose*/

	/* executive purpose */
	public function executive_details($data){
		$this->db->insert('executive_list', $data);
		return $this->db->insert_id();
	}
	 public  function executive_check_email_exits($email_id){
		$this->db->select('*')->from('executive_list');
		$this->db->where('email_id',$email_id);
		return $this->db->get()->row_array(); 
	 }
	  public function executive_list_data($id){
		$this->db->select('executive_list.*')->from('executive_list');
		$this->db->where('executive_list.added_by',$id);
		$this->db->where('executive_list.status !=',2);
        return $this->db->get()->result_array();
	}
		public function executive_name_list_data($e_id){
		$this->db->select('executive_list.e_id,executive_list.name')->from('executive_list');
		$this->db->where('executive_list.added_by',$e_id);
		$this->db->where('executive_list.added_by',$e_id);
		$this->db->where('executive_list.status',1);
        return $this->db->get()->result_array();
	}	
	public function executive_location_list_data($e_id){
	$this->db->select('executive_list.e_id,executive_list.location')->from('executive_list');
		$this->db->where('executive_list.status',1);
        return $this->db->get()->result_array();
	}	
	public function edit_executive_list_data($e_id){
		$this->db->select('*')->from('executive_list');
		$this->db->where('executive_list.e_id',$e_id);
        return $this->db->get()->row_array();
	}	
		public function update_executive_details($e_id,$data){
		$this->db->where('e_id',$e_id);
		return $this->db->update('executive_list',$data);
	}
	public function delete_details_data($e_id){
	    $this->db->where('e_id',$e_id);
		return $this->db->delete('executive_list');
	}	
	
       public function saver_user($e_id){
	$this->db->select('*')->from('executive_list');
		$this->db->where('e_id',$e_id);
		return $this->db->get()->row_array();
			  
}
  public function saver_user_details($email_id){
		$this->db->select('*')->from('executive_list');
		$this->db->where('executive_list.email_id',$email_id);
		return $this->db->get()->row_array();
			  }
	
	
	/*agent*/
		
	
	
	public function agent_not_recived_patient(){
	$this->db->select('*')->from('appointment_bidding_list');
   $this->db->where('appointment_bidding_list.event_status',2);
	return $this->db->get()->result_array();
	 }
	public function get_recived_patients_accept_list(){
	$this->db->select('count(appointment_bidding_list.patinet_name)as recived')->from('appointment_bidding_list');
	$this->db->where('appointment_bidding_list.event_status',1);
	return $this->db->get()->row_array();
	}
	
	public function delete_executive_details($e_id){
	    $this->db->where('e_id',$e_id);
		return $this->db->delete('executive_list');
	}
	public  function get_assign_card_number_list(){
		$this->db->select('seller_card_assign_munber_list.patient_name,seller_card_assign_munber_list.card_number,seller_card_assign_munber_list.mobile_num,seller_card_assign_munber_list.whatsapp_num,seller_card_assign_munber_list.city,seller_card_assign_munber_list.email_id,seller_card_assign_munber_list.gender,seller_card_assign_munber_list.mobile_verified,seller_card_assign_munber_list.created_at,card_sellers.s_id,card_sellers.name as s_name')->from('seller_card_assign_munber_list');
		$this->db->join('card_sellers', 'card_sellers.s_id = seller_card_assign_munber_list.s_id', 'left');
		 $this->db->where('seller_card_assign_munber_list.mobile_verified',1);
		return $this->db->get()->result_array();
	}	
	
	public function get_total_location_accept_list(){
	$this->db->select('appointment_bidding_list.city')->from('appointment_bidding_list');
	    $this->db->where('appointment_bidding_list.status',1);
		$this->db->group_by('appointment_bidding_list.city');
	    return $this->db->get()->result_array();
	}
	
	public function get_total_patients_accept_list(){
	$this->db->select('count(appointment_bidding_list.patinet_name)as total')->from('appointment_bidding_list');
	$this->db->where('appointment_bidding_list.status',1);
	return $this->db->get()->row_array();
	}
	
	public function get_basic_agent_details_location($e_id){
		$this->db->select('executive_list.e_id,executive_list.location')->from('executive_list');
		$this->db->where('executive_list.status',1);
        return $this->db->get()->row_array();
	}	
	

	public function get_appointment_list_data_patient($location){
	$this->db->select('count(appointment_bidding_list.patinet_name)as total_patient ,appointment_bidding_list.city,appointment_bidding_list.b_id')->from('appointment_bidding_list');
		$this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
		$this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
		$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');
		$this->db->where('appointment_bidding_list.status',1);
		$this->db->group_by('appointment_bidding_list.city',$location);
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			
			$lists=$this->get_hospital_final_appinment($list['city'],$location);
			$los=$this->get_hospital_recived_final_appinment($list['city'],$location);
			//echo '<pre>';print_r($lists);exit;
			$data[$list['b_id']]=$list;
			$data[$list['b_id']]['not_recived_list']=$lists;
			$data[$list['b_id']]['recived_list']=$los;
		}
		
		if(!empty($data)){
			
			return $data;
			
		}
	}
	
	public  function get_hospital_final_appinment($city,$location){
	$this->db->select('appointment_bidding_list.b_id,appointment_bidding_list.city,appointment_bidding_list.hos_id,appointment_bidding_list.department,appointment_bidding_list.specialist,appointment_bidding_list.patinet_name,appointment_bidding_list.mobile,appointment_bidding_list.date,appointment_bidding_list.time,treament.t_name,specialist.specialist_name,appointment_bidding_list.create_by,appointment_bidding_list.reason,appointment_bidding_list.event_status')->from('appointment_bidding_list');
		$this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
		$this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
		$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');
		$this->db->where('appointment_bidding_list.event_status',2);
		$this->db->where('appointment_bidding_list.city',$city);
		$this->db->where('appointment_bidding_list.status',1);
		return $this->db->get()->result_array();
	}
	
	public function get_hospital_recived_final_appinment($city,$location){
	$this->db->select('count(appointment_bidding_list.patinet_name)as recived_patient ')->from('appointment_bidding_list');
		$this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
		$this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
		$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');
		$this->db->where('appointment_bidding_list.event_status',1);
		$this->db->where('appointment_bidding_list.city',$city);
		$this->db->where('appointment_bidding_list.status',1);
		return $this->db->get()->result_array();
	}
/* appointment all*/

public  function get_appointment_list_data_patient_overall(){
		$this->db->select('appointment_bidding_list.city')->from('appointment_bidding_list');
		$this->db->group_by('appointment_bidding_list.city');
		$this->db->where('appointment_bidding_list.status',1);
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			$city_wise_list=$this->get_city_wise_list($list['city']);
			$recived_count=$this->get_recived_count($list['city']);
			$not_recived_count=$this->get_not_recived_count($list['city']);
			$patient_history_list=$this->get_patient_history_list_data($list['city']);
			$data[$list['city']]=$list;
			$data[$list['city']]['city_wise_list']=isset($city_wise_list['cnt'])?$city_wise_list['cnt']:'';
			$data[$list['city']]['recived_count']=isset($recived_count['cnt'])?$recived_count['cnt']:'';
			$data[$list['city']]['not_recived_count']=isset($not_recived_count['cnt'])?$not_recived_count['cnt']:'';
			$data[$list['city']]['patient_history_list']=$patient_history_list;
			//echo '<pre>';print_r($not_recived_count);exit;
			
		}
		if(!empty($data)){
			return $data;
			
		}
		//echo '<pre>';print_r($data);exit;
}

public  function get_city_wise_list($city){
		$this->db->select('count(appointment_bidding_list.b_id) as cnt')->from('appointment_bidding_list');
		$this->db->where('appointment_bidding_list.city',$city);
		$this->db->where('appointment_bidding_list.status',1);
		return $this->db->get()->row_array();
}
public  function get_recived_count($city){
		$this->db->select('count(appointment_bidding_list.b_id) as cnt')->from('appointment_bidding_list');
		$this->db->where('appointment_bidding_list.city',$city);
		$this->db->where('appointment_bidding_list.event_status',1);
		$this->db->where('appointment_bidding_list.status',1);
		return $this->db->get()->row_array();
}
 public  function get_not_recived_count($city){
		$this->db->select('count(appointment_bidding_list.b_id) as cnt')->from('appointment_bidding_list');
		$this->db->where('appointment_bidding_list.city',$city);
		$this->db->where('appointment_bidding_list.status',1);
		$this->db->where('appointment_bidding_list.event_status',2);
		$this->db->or_where('appointment_bidding_list.event_status',0);
		return $this->db->get()->row_array();
}
	
	public function get_patient_history_list_data($city){
$this->db->select('hospital.hos_bas_name,appointment_bidding_list.event_status,appointment_bidding_list.b_id,appointment_bidding_list.city,appointment_bidding_list.hos_id,appointment_bidding_list.department,appointment_bidding_list.specialist,appointment_bidding_list.patinet_name,appointment_bidding_list.mobile,appointment_bidding_list.date,appointment_bidding_list.time,treament.t_name,specialist.specialist_name,hospital.hos_bas_name,appointment_bidding_list.create_by')->from('appointment_bidding_list');
    $this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
    $this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
	$this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');
	$this->db->where('appointment_bidding_list.city',$city);
	$this->db->where('appointment_bidding_list.status',1);
    return $this->db->get()->result_array();
	}
	 public  function get_city_wise_not_recived_count($city){
		$this->db->select('*')->from('appointment_bidding_list');
		$this->db->where('appointment_bidding_list.city',$city);
		$this->db->where('appointment_bidding_list.status',1);
		$this->db->where('appointment_bidding_list.event_status',2);
		$this->db->or_where('appointment_bidding_list.event_status',0);
		return $this->db->get()->result_array();
		
  }
  /* coupon code count*/
  public  function get_coupon_code_count($hos_id){
	$this->db->select('*')->from('coupon_codes');
	$this->db->where('hospital_id',$hos_id);
	$this->db->where('status !=',2);
	return $this->db->get()->result_array(); 
  }
  public  function get_not_reject_patient_list(){
  $this->db->select('appointment_bidding_list.*,treament.t_name,specialist.specialist_name,resource_list.resource_name,hospital.hos_bas_name')->from('appointment_bidding_list');
  $this->db->join('treament', 'treament.t_id = appointment_bidding_list.department', 'left');
  $this->db->join('specialist', 'specialist.s_id = appointment_bidding_list.specialist', 'left');
  $this->db->join('resource_list', 'resource_list.a_id = appointment_bidding_list.doctor_id', 'left');
  $this->db->join('hospital', 'hospital.hos_id = appointment_bidding_list.hos_id', 'left');

  $this->db->where('appointment_bidding_list.status',2);
  $this->db->order_by('appointment_bidding_list.b_id','desc');
  return $this->db->get()->result_array();
 }
 
 /* add admin logos*/
 public  function get_all_logos_list($admin_id){
	 $this->db->select('*')->from('logos_list');
	$this->db->where('created_by',$admin_id);
	$this->db->where('status !=',2);
	return $this->db->get()->result_array(); 
 }
 
 public  function save_logo_images($data){
	 $this->db->insert('logos_list',$data);
	 return $this->db->insert_id();
}
public  function update_logo_details($l_id,$data){
	$this->db->where('l_id',$l_id);
	return $this->db->update('logos_list',$data);
	
}
public function get_logo_details($l_id){
	$this->db->select('*')->from('logos_list');
	$this->db->where('l_id',$l_id);
	return $this->db->get()->row_array(); 
}
/* admin wallet amout list */

public  function get_all_wallet_amt_per_list_list(){
	$this->db->select('wallet_amount_percentage.*,hospital.hos_id,hospital.hos_bas_name')->from('wallet_amount_percentage');
	 $this->db->join('hospital', 'hospital.hos_id = wallet_amount_percentage.hospital_id', 'left');

	$this->db->where('wallet_amount_percentage.status !=',2);
	$this->db->order_by('wallet_amount_percentage.w_id',"desc");
	return $this->db->get()->result_array(); 
	
}
public  function get_all_wallet_amt_list_list($created_by){
	$this->db->select('*')->from('wallet_amount');
	$this->db->where('wallet_amount.created_by',$created_by);
	$this->db->where('wallet_amount.status !=',2);
	$this->db->order_by('wallet_amount.w_a_id',"desc");
	return $this->db->get()->result_array(); 
}
public  function get_current_amount_list($created_by){
	$this->db->select('*')->from('wallet_amount');
	$this->db->where('status',1);
	$this->db->where('created_by',$created_by);
	return $this->db->get()->row_array(); 
}

/* ward  dash*/

public  function get_total_admit_patients_list($hos_id){
	$this->db->select('DATE_FORMAT(admitted_patient_list.date_of_admit,"%Y") as years')->from('admitted_patient_list');
	$this->db->group_by("DATE_FORMAT(admitted_patient_list.date_of_admit,'%Y')");
	//$this->db->group_by('');
	$this->db->where('hos_id',$hos_id);
	$return=$this->db->get()->result_array(); 
	foreach($return as $list){
		$count=$this->get_admitted_patient_count($list['years'],$hos_id);
		$data[$list['years']]=$list;
		$data[$list['years']]['count']=isset($count['cnt'])?$count['cnt']:'';
		
	}
	if(!empty($data)){
		return $data;
	}
}
public  function get_admitted_patient_count($year,$hos_id){
	$this->db->select('COUNT(admitted_patient_list.a_p_id) as cnt')->from('admitted_patient_list');
	$this->db->where("DATE_FORMAT(admitted_patient_list.date_of_admit,'%Y')", $year);
	//$this->db->group_by('');
	$this->db->where('admitted_patient_list.hos_id',$hos_id);
	return $this->db->get()->row_array(); 
}
public  function get_total_discharge_patients_list($hos_id){
	$this->db->select('DATE_FORMAT(admitted_patient_list.date_of_admit,"%Y") as years')->from('admitted_patient_list');
	$this->db->group_by("DATE_FORMAT(admitted_patient_list.date_of_admit,'%Y')");
	//$this->db->group_by('');
	$this->db->where('hos_id',$hos_id);
	$this->db->where('admitted_patient_list.completed',1);
	$return=$this->db->get()->result_array(); 
	foreach($return as $list){
		$count=$this->get_discharge_patient_count($list['years'],$hos_id);
		$data[$list['years']]=$list;
		$data[$list['years']]['count']=isset($count['cnt'])?$count['cnt']:'';
		
	}
	if(!empty($data)){
		return $data;
	}
}
public  function get_discharge_patient_count($year,$hos_id){
	$this->db->select('COUNT(admitted_patient_list.a_p_id) as cnt')->from('admitted_patient_list');
	$this->db->where("DATE_FORMAT(admitted_patient_list.date_of_admit,'%Y')", $year);
	//$this->db->group_by('');
	$this->db->where('admitted_patient_list.hos_id',$hos_id);
	$this->db->where('admitted_patient_list.completed',1);
	return $this->db->get()->row_array(); 
}
	
	
	
	
	
  }