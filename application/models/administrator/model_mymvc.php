<?php 
/**
* 
*/
class Model_mymvc extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function create($name){
		$this->create_controller($name);
		$this->create_model($name);
	}
	
	
	// ########################  CONTROLLER  ##########################

	function create_controller($name){
		$my_file = 'application/controllers/administrator/'.$name.'.php';
		$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
		$this->controllers_append($name);
	}

	function controllers_append($name){
		$x="$";
		$str=$x."this->load->model('administrator/model_".$name."');";
		$mycontroller = 'application/controllers/administrator/'.$name.'.php';
		$handle = fopen($mycontroller, 'a') or die('Cannot open file:  '.$mycontroller);
		$data = '<?php '."\n".'class '.$name.' extends CI_Controller';
		fwrite($handle, $data);
		$new_data = "\n".'{';
		fwrite($handle, $new_data);
		$new_data = "\n"."\n"."\t"."function __construct()"."\n"."\t".'{'."\n"."\t"."\t".'parent::__construct();'."\n"."\t"."\t".$str."\n"."\t"."}";
		fwrite($handle, $new_data);
		$new_data = "\n"."\n"."\t"."function index()"."\n"."\t".'{'."\n"."\t"."\t".'echo "Hi There";'."\n"."\t".'}'."\n"."}";
		fwrite($handle, $new_data);
	}

	// ########################  MODEL  ##########################
	function create_model($name){
		$my_file = 'application/models/administrator/model_'.$name.'.php';
		$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
		$this->model_append($name);
	}

	function model_append($name){
		$mymodel = 'application/models/administrator/model_'.$name.'.php';
		$handle = fopen($mymodel, 'a') or die('Cannot open file:  '.$mymodel);
		$data = '<?php '."\n".'class Model_'.$name.' extends CI_Model';
		fwrite($handle, $data);
		$new_data = "\n".'{';
		fwrite($handle, $new_data);
		$new_data = "\n"."\n"."\t"."function __construct()"."\n"."\t".'{'."\n"."\t"."\t".'parent::__construct();'."\n"."\t".'}'."\n"."}";
		fwrite($handle, $new_data);
	}
}
?>