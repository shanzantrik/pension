<?php 
/**
* Marking Superendintent Functions
*/
class Model_marking extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('administrator/PNS/model_marking');
		$this->load->model('administrator/model_notification');

	}
	function getMarkingNotifiction(){
        $sql="SELECT * from file_status a,pension_receipt_file_master b where  a.status='Forwarded to Marking Superintendent of Pension' and a.file_no=b.file_No";
        $q=$this->db->query($sql);
        $result=$q->result();
        return $result;
	}
	function marking_confirm($file){
		$today=date('Y-m-d');
		$this->db->where('file_no',$file);
		$q=$this->db->update('file_status',array('notification'=>'ok','member_code'=>$this->session->userdata('member_code'),'allocated_date'=>$today));
		$data=array(
			'file_no'=>$file,
			'branch'=>$this->model_notification->getBranch_forwrd($this->session->userdata('branch_code')),
			'file_status'=>'Received Marking Superintendent of '.$this->model_notification->getBranch_forwrd($this->session->userdata('branch_code')),
			'member_code'=>$this->session->userdata('member_code')
			);
		$this->db->insert('file_tracking_details',$data);
		if($q){
			$array=array('msg'=>'ok');
			return $array;	
		}
		else{
			$array=array('msg'=>'error');
			return $array;	
		}
	}
	function forward_to_Da(){
		$member_code=@$_POST['member_code'];
		$allocated_date=date('Y-m-d');
		$branch_code=$this->session->userdata('branch_code');
		$chk=@$_POST['chk'];
		if(empty($chk)){
			return 'validate';
		}else{
			if(isset($_POST['chk'])==true){
			$chk=$_POST['chk'];
			$this->db->trans_begin();
			foreach($chk as $a => $b){
				$file_tracking=array(
					'file_no'=>$chk[$a],
					'branch'=>$this->model_notification->getBranch_forwrd($branch_code),
					'file_status'=>'Forwarded to Concern Dealing Assistant and Member Code is '.$member_code,
					'member_code'=>$this->session->userdata('member_code')
					);
				$this->db->insert('file_tracking_details',$file_tracking);
				$this->db->where('file_no',$chk[$a]);
				$this->db->update('file_status',array('status'=>'To DA','notification'=>'pending','member_code'=>$member_code,'allocated_date'=>$allocated_date));
				$this->db->insert('concern_da',array('file_no'=>$chk[$a],'da'=>$member_code));				
			}
			
			}
			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    return 'RollBack';
			}
			else
			{
			    $this->db->trans_commit();
			    return 'Success';
			}
		}
		
	}
}
?>