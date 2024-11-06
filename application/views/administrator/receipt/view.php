<?php 
foreach ($records as $rec) {
    $dfno=$rec->dfno;
    $receipt_date=$rec->receipt_date;
    $subject=$rec->subject;
    $dept_name=$rec->branch_name;
}
?>
<table style="color:#000" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
  <tbody role="alert" aria-live="polite" aria-relevant="all">
    <tr>
      <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Dept Forwarding No.</label></td>
      <td><?php  echo $dfno; ?></td>
      <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Department</label></td>
      <td><?php  echo $dept_name; ?></td>                                        
    </tr>
    <tr>
      <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Subject</label></td>
        <td><?php echo $subject; ?></td>
        <td><label style="width:auto;font-weight:bold" class="col-sm-3 control-label">Receipt Date</label></td>
        <td style="width:30%"><?php echo $receipt_date ?></td>
    </tr>
  </tbody>
</table>

<table style="color:#000" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="dd" width="100%">
  <thead>
    <th>Token No.</th>
    <th>Employee Code</th>
    <th>Claimant Name</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php foreach ($file as $key) {
            $srl=$key->srl_No;
            $key->srl_No=rand();
    ?>
    <tr>
      <td>
        <?php
            $tn = $this->model_receipt->getTokenNo($key->file_No);
            echo $tn[0]->token_no;
        ?>
      </td>
      <td id="ec_<?php echo $key->srl_No ?>"><?php echo $key->emp_code ?></td>
      <td id="f_<?php echo $key->srl_No ?>"><?php echo $key->pensionee_name; ?></td>
      <td><a class="btn btn-info" href='#' id="but_<?php echo $key->srl_No;?>" ><i class="icon-edit icon-white"></i></a></td>
    </tr>
    <script type="text/javascript">
      $("#but_<?php echo $key->srl_No;?>").click(function(e) {
        e.preventDefault();
        $(function() {
          $("#xx_<?php echo $key->srl_No;?>").dialog({
            width:720,
            closeText:"Close this panel",
            modal:true,
            resizable: false,
            autoOpen: true,
            autoResize:true
          });
        });
      });
    </script>
    <div id="xx_<?php echo $key->srl_No;?>" title="Edit" style="display:none;">
      <div style="margin-left:40%">
        <input type="hidden" id="<?php echo $key->srl_No?>_srl" value="<?php echo $srl;?>" />
        <input type="hidden" id="<?php echo $key->srl_No?>_file_no" value="<?php echo $key->file_No;?>">
        <label>Employee Code</label>
        <input class="form-control" type="text" required id="<?php echo $key->srl_No?>_emp_code" value="<?php echo $key->emp_code;?>">
        <label>Name</label>
        <input class="form-control" type="text" required id="<?php echo $key->srl_No?>_name" value="<?php echo $key->pensionee_name;?>">
        <label>Designation</label>
        <select required id="<?php echo $key->srl_No?>_designation" class="form-control">
            <option value="">Select</option>
            <?php foreach(getAllDesignation() as $desg) : ?>
              <?php if($desg['desg_name'] == $key->designation) : ?>
                <option value="<?php echo $desg['desg_name']; ?>" selected><?php echo $desg['desg_name']; ?></option>
              <?php else : ?>
                <option value="<?php echo $desg['desg_name']; ?>"><?php echo $desg['desg_name']; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
        </select> 
        <!-- <input class="form-control" type="text" required id="<?php echo $key->srl_No?>_designation" value="<?php echo $key->designation;?>"> -->

       <!-- ====================-->

       <?php 
       $dfn=$key->dept_forw_no;
       $qry=$this->db->query("Select * from pension_receipt_register_master where dept_forw_no='$dfn'");
       $res=$qry->result();
       foreach ($res as $r) {
         # code...
        $dpt=$r->address_department;
       }
       

       ?>
        <input type="hidden" required id="<?php echo $key->srl_No?>_dept_forw_no" value="<?php echo $dfn;?>" >
        <label>Department Address</label>
        <input class="form-control" type="text" required id="<?php echo $key->srl_No?>_dept_add" value="<?php echo $dpt;?>">

        <!-- ====================-->
        <br/><button type="submit" id="sub_<?php echo $key->srl_No?>" class="btn btn-primary">Update</button>
        <span id="<?php echo $key->srl_No?>_msg"></span>
        
        <script type="text/javascript">
          $("#sub_<?php echo $key->srl_No?>").click(function(){
            var file_no=$("#<?php echo $key->srl_No?>_file_no").val();
            var emp_code=$("#<?php echo $key->srl_No?>_emp_code").val();
            var name=$("#<?php echo $key->srl_No?>_name").val();
            var srl=$("#<?php echo $key->srl_No?>_srl").val();
            var fn1=$("#<?php echo $key->srl_No?>_dept_forw_no").val();
            var d_add=$("#<?php echo $key->srl_No?>_dept_add").val();
            var desig = $("#<?php echo $key->srl_No?>_designation").val();
            //--13-02-2020
            var formData=new FormData();
            formData.append("srl",srl);
            formData.append("file_no",file_no);
            formData.append("emp_code",emp_code);
            formData.append("dept_forw_no",fn1);
            formData.append("address_department",d_add);
            formData.append("name",name);
            formData.append("designation",desig);

            $.ajax({
              url: '<?php echo site_url("administrator/receipt"); ?>/update',
              type: 'POST',
              dataType: 'json',
              data:formData,
              processData: false,
              contentType: false,
              success: function(data) {
                $("#<?php echo $key->srl_No?>_emp_code").val(data.ecode);
                $("#<?php echo $key->srl_No?>_name").val(data.pensionee_name);

                $("#ec_<?php echo $key->srl_No?>").html(data.ecode);
                $("#f_<?php echo $key->srl_No?>").html(data.pensionee_name);
                $("#<?php echo $key->srl_No?>_msg").html('<p>File Updated Successfully</p>');
              }
            });   
            
            //--13-02-2020
			         /*   $.ajax({
              url: '<?php echo site_url("administrator/receipt"); ?>/update?srl='+srl+'&file_no='+file_no+'&emp_code='+emp_code+'&dept_forw_no='+fn1+'&address_department='+d_add+'&name='+name+'&designation='+desig,
              type: 'GET',
              dataType: 'json',
              success: function(data) {
                $("#<?php echo $key->srl_No?>_emp_code").val(data.ecode);
                $("#<?php echo $key->srl_No?>_name").val(data.pensionee_name);

                $("#ec_<?php echo $key->srl_No?>").html(data.ecode);
                $("#f_<?php echo $key->srl_No?>").html(data.pensionee_name);
                $("#<?php echo $key->srl_No?>_msg").html('<p>File Updated Successfully</p>');
              }
            });  */     
          });
        </script>
      </div>
    </div>
    <?php } ?>
  </tbody>
</table>