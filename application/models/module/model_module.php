<?php
class Model_module extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/model_mymvc');
    }

	function getModules($for_assign = false) {
        if($for_assign) {
            $this->db->order_by("alias_name", "asc");
        } else {
            $this->db->order_by("menu_index", "asc");
        }
		$query=$this->db->get('master_module');
        //$query=$this->db->get_where('master_module',array('type'=>0));
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function saveModule(){
        $module_name=$_GET['module_name'];
        $alias_name=$_GET['alias_name'];
        $module_code=$this->getMax();
        $type=$_GET['type'];
        $menu_index=abs($_GET['menu_index']);
        $icon=$_GET['icon'];
        $data=array(
            'module_code'=>$module_code,
            'module_name'=>$module_name,
            'alias_name'=>$alias_name,
            'type'=>$type,
            'menu_index'=>$menu_index,
            'icon'=>$icon
            );
        if(empty($module_name) || empty($alias_name)){
            $data_array=array('message' =>'empty' );
            return $data_array;
        }
        else if($this->check_pk($module_name)==true){
            $q=$this->db->insert('master_module',$data);
            if($q==true){
                        $anchor="<a href='#myDelete' id='mybutton' class='open-dialog btn btn-danger btn-rad' data-toggle='modal' data-id=$module_code><i class='icon-trash'></i>Delete</a>";
                      
                        $data_array=array('module_code'=>$module_code,'module_name'=>$module_name,'alias_name'=>$alias_name,'message'=>'true','anchor'=>$anchor,'type'=>$type,'menu_index'=>$menu_index);
                        //Create Model & Controllers file
                        $this->model_mymvc->create($module_name);
                        return $data_array;
                    }
                    else
                    {
                        $data_array=array('message' =>'false' );
                        return $data_array;
                    }
        }
        else
        {
            $data_array=array('message' =>'PK' );
            return $data_array;
        }
    }

    function saveModule_frm_sub(){
        $module_name=$_POST['module_name_sb'];
        $alias_name=$_POST['alias_name_sb'];
        $module_code=$this->getMax();
        $type=$_POST['type'];
        $icon=$_POST['icon'];
        $menu_index=abs($_POST['menu_index']);
        $data=array(
            'module_code'=>$module_code,
            'module_name'=>$module_name,
            'alias_name'=>$alias_name,
            'type'=>$type,
            'menu_index'=>$menu_index,
            'icon'=>$icon
            );
        if(empty($module_name) || empty($alias_name)){
            $data_array=array('message' =>'empty' );
            return $data_array;
        }
        else if($this->check_pk($module_name)==true){
            $q=$this->db->insert('master_module',$data);
            if($q==true){
                        //Create Model & Controllers file
                        $this->model_mymvc->create($module_name);
                        return 'true';
                    }
                    else
                    {
                        return 'false';
                    }
        }
        else
        {
            return 'PK';
        }
    }

    function update_ajax(){
        $value=$_POST['value'];
        $row_id=$_POST['row_id'];
        $column=$_POST['column'];
        $update_column='';

        switch ($column) {
            case '1':
                $update_column='module_name';
                break;
            case '2':
                $update_column='alias_name';
                break;
            case '3':
                $update_column='type';
                break;
            case '4':
                $update_column='menu_index';
                break;
            default:
                # code...
                break;
        }
        $data = array(    
               $update_column => $value
            );
        $this->db->where('module_code', $row_id);
        $this->db->update('master_module', $data);
        echo $value;
    }

    function delete($id){
        $q=$this->db->delete('master_module',array('module_code'=>$id));
        $qx=$this->db->delete('master_sub_module',array('module_code'=>$id));
        $rx=$this->db->delete('privilege_module',array('module_code'=>$id));
        $tx=$this->db->delete('privilege_sub_module',array('main_module_code'=>$id));
        if($q)
            return true;
        else
            return false;
    }

    function getMax() {
        $this->db->select_max('module_code');
        $result = $this->db->get('master_module');
        $row = $result->result();
        if($row[0]->module_code == '') {
            return "1";
        } else {
            return $row[0]->module_code+1;
        }
    }

    function getMax_sub() {
        $this->db->select_max('sub_module_code');
        $result = $this->db->get('master_sub_module');
        $row = $result->result();
        if($row[0]->sub_module_code == '') {
            return "1";
        } else {
            return $row[0]->sub_module_code+1;
        }
    }

    function check_pk($module_name){
        $q=$this->db->query("Select module_name from master_module where module_name='$module_name'");
        $rec=$q->num_rows();
        if($rec==1){
            return false;
        }
        return true;
    }

    function get_sub_Modules(){
        $query=$this->db->query("Select * from master_module order by module_code asc");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function save_sub_module(){
        $module_id=trim($_POST['module_id']);
        $sub_module=trim($_POST['sub_module']);
        $alias_name=trim($_POST['alias_name']);
        $type=trim($_POST['s_type']);
        $menu=trim($_POST['menu']);
        $parent_module=(isset($_POST['parent_module']))?$_POST['parent_module']:0;
        //if record does not exists then
        if($this->check_sub_module($module_id,$sub_module)==true){
            $data=array(
                    'sub_module_code'=>$this->getMax_sub(),
                    'module_code'=>$module_id,
                    'sub_module_name'=>$sub_module,
                    'alias_name'=>$alias_name,
                    'type'=>$type,
                    'menu'=>$menu,
                    'parent_module'=>$parent_module
                );
                $this->db->insert('master_sub_module',$data);
                return true;
        }
        else
        {
            return false;
        }
    }

    function check_sub_module($module_id,$sub_module){

        $q=$this->db->get_where('master_sub_module',array('module_code'=>$module_id,'sub_module_name'=>$sub_module));
        if(@$q->num_rows()>0){
            return false;
        }
        return true;
    }

    function update_sub_module(){
        $sub_module_code=trim($_POST['edit_module_id']);
        $sub_module_name=trim($_POST['edit_sub_module']);
        $alias_name=trim($_POST['edit_alias_name']);
        $parent_module=trim(@$_POST['parent_module']);
        $type=trim($_POST['edit_type']);
        $menu=trim($_POST['menu']);
        
        $data=array(
            'sub_module_name'=>$sub_module_name,
            'alias_name'=>$alias_name,
            'parent_module'=>$parent_module,
            'type'=>$type,
            'menu'=>$menu,
        );
        $this->db->where('sub_module_code',$sub_module_code);
        $q=$this->db->update('master_sub_module',$data);
        if($q){
            return true;
        }
        else
        {
            return false;
        }
    }
    function delete_sub($smc){
        $q=$this->db->delete('master_sub_module',array('sub_module_code'=>$smc));
        if($q)
            return true;
        else
            return false;
    }
    function get_sub_modules_specific($module_code,$member_type_code){
        
        $sql="SELECT * from master_sub_module where type='foreground' and module_code=$module_code and sub_module_code not in(SELECT module_code from privilege_sub_module WHERE member_type_code=$member_type_code)";

        $query=$this->db->query($sql);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    function get_sub_modules_saved($module_code,$member_type_code){
        $sql="SELECT b.sub_module_code AS sub_module, a.member_type_code AS member_type_code, b.module_code AS module_code,b.alias_name as alias_name
        FROM privilege_sub_module a, master_sub_module b
        WHERE a.module_code = b.sub_module_code AND a.member_type_code=$member_type_code
        AND b.module_code=$module_code AND b.type='foreground'";
        
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        return false;
    }
    function save_auth(){

        $member_type_code=$_POST['member_type_code'];
        $module_code=$_POST['module_code'];
        
       
        //fisrt check if the module is added before or not
        $q=$this->db->get_where('privilege_module',array('member_type_code'=>$member_type_code,'module_code'=>$module_code));
        if($q->num_rows()==0){
            $this->db->insert('privilege_module',array('member_type_code'=>$member_type_code,'module_code'=>$module_code));
        }
        
        $flag=0;
        if(isset($_POST['selected_module'])) {
            $flag=1;
        }
        if($flag==1){
            $this->db->delete('privilege_sub_module',array('member_type_code'=>$member_type_code,'main_module_code'=>$module_code));
            foreach ($_POST['selected_module'] as $submodule){
                $this->check_for_background_module($submodule,$module_code,$member_type_code);
                $data = array(
                   'member_type_code' => $member_type_code ,
                   'module_code' => $submodule ,
                   'main_module_code'=>$module_code
                );
                $this->db->insert('privilege_sub_module', $data);
               

            }
          
  
        }
        else{
            $this->db->delete('privilege_sub_module',array('member_type_code'=>$member_type_code,'main_module_code'=>$module_code));
            $this->db->delete('privilege_module',array('member_type_code'=>$member_type_code,'module_code'=>$module_code));

        }
       
        return false;
    }

    //Check wheather the module contains background modules or not
    function check_for_background_module($submodule,$module_code,$member_type_code){
        $query=$this->db->get_where('master_sub_module',array('parent_module'=>$submodule,'type'=>'background','module_code'=>$module_code));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data=array(
                    'member_type_code'=>$member_type_code,
                    'module_code'=>$row->sub_module_code,
                    'main_module_code'=>$row->module_code
                );
                $this->db->insert('privilege_sub_module',$data);
            }
            
        }
    }

    function get_modules($member_type){
        /*$query=$this->db->get_where("master_sub_module",array('module_code'=>$module_code));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;*/
    }
    //AJAX METHOD FOR SUB-SUB MODULES
    function get_sub_modules_json($module_id){
        $sql="SELECT sub_module_code,alias_name from master_sub_module where module_code=$module_id and type='foreground'";
        $query=$this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    function getIcons(){
        $q=$this->db->get('master_icons');
        $result=$q->result();
        return $result;
    }
}
?>