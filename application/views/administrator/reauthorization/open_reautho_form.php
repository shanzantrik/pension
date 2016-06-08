<h2>Reauthorization Form</h2>
    <div class="form-group">
        <label for="inp" class="col-sm-2 control-label"></label>
        <div class="col-sm-offset-2 col-sm-10"><script src='<?php echo base_url()?>includes/vendors/ckeditor/ckeditor.js'></script>
<script src='<?php echo base_url()?>includes/vendors/ckeditor/adapters/jquery.js'></script>


<script type="text/javascript">
    $('body').on('focus',"#dod_pensioner", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });
	    $('body').on('focus',"#dod_pensioner_wife_husband", function(){
        $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
    });

</script>

<small style="font-size:12px; font-weight:bold;color:darkgrey">Use this panel to attach claiment  detail entry for reauthorization</small>                  
<?php
	$val = $values[0];
	//print_r($val);
	//exit();
    $pensioner_dod=$val['dod'];
	

	//$serial_no=$val['serial_no'];
    $family_info=unserialize($val['family_info']);
	//print_r($name);
    //print_r($dob);
	//print_r($serial_no);
	?>
  
	
		<?php foreach ($family_info as $key => $value){  
		   $main_key = $key;
		   $main_key++;
		   //$spouse_name=$value['spouse_name'];
		   //print_r($spouse_name);
		   //print_r($main_key);
		   
		   
		   if(isset($value['child'])){
			$child_info = $value['child'];
			//$a=array();
			$a=array_values($child_info);
			//print_r($a);
			//exit();
			/*print_r($child_info);
			  exit();*/
			///if(!empty($value['child'])){
			$arr=array($name);
			//$arr=array($name);

			$arrdb=array($dob);
			
				foreach ($child_info as $key => $ci){
                	if(in_array($ci['dob'],$arrdb)) 
				{
					$dob=$ci['dob'];
					if(in_array($ci['name'],$arr)) 
					{
					//$name=$ci['name'];
					$name=trim($ci['name']);
                    //$salutation=trim($ci['salutation']);
			
                    }
				}
			}
	  	}
	}
	?>
<form role="form"  action="<?php echo site_url('/administrator/Reauthorization/open_reautho_form/'.$serial_no).'/'.$ci['dob'].'/'.$ci['name'].'/'.$ci['salutation']?>" method="post" autocomplete="off">
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="claiment_name" value="<?php echo $name?>" id="exampleInputEmail1"><?php echo form_error('claiment_name', '<div class="error">', '</div>');?>
  </div>

  
  <div class="form-group">
    <label for="exampleInputPassword1">Date of Birth </label>
    <input type="text" class="form-control" name="child_dob" value="<?php echo $dob?>" id="exampleInputPassword1">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Date of death(pensioner)</label>
    <input type="text" class="form-control" name="dod_pensioner" value="<?php if($pensioner_dod=="0000-00-00"){echo "";}else{echo $pensioner_dod; }?>" id="dod_pensioner"><?php echo form_error('dod_pensioner', '<div class="error">', '</div>'); ?></td>
  </div>
  
    <div class="form-group">
    <label for="exampleInputPassword1">Date of death(pensioner wife/husband)</label>
    <input type="text" class="form-control" name="dod_pensioner_wife_husband" value="" id="dod_pensioner_wife_husband"><?php echo form_error('dod_pensioner_wife_husband', '<div class="error">', '</div>'); ?></td>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>

<div id="pensioner_info"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#file_no').keyup(function(e){
            $.post("<?php echo site_url('administrator/pension/get_pensioner_info'); ?>", {file_no: $('#file_no').val()}, function(data) {
                var obj = jQuery.parseJSON(data);
                if(obj.status == "ok"){
                    $('.error').html('');
                    $('#pensioner_info').html(obj.message);
                    $('#create_worksheet').removeAttr('disabled');
                } else {
                    $('.error').html(obj.message);
                    $('#pensioner_info').html('');
                    $('#create_worksheet').attr('disabled', 'true');
                }
            });
        });
    });
</script>