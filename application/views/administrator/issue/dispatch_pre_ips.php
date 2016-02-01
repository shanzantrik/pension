<form method="post" action="<?php echo site_url('administrator/issue/save_issue') ?>">
<a href="#forwrd" class="open-dialog btn btn-info btn" data-toggle="modal"><i class=""></i>Final Dispatch</a>
<button href="" class="open-dialog btn btn-success btn" style="float:right" data-toggle="modal" onclick="javascript:history.go(-1);"><i class=""></i>Back</button>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered dataTable">
  <tr>
    <td width="24%"><strong>File No</strong></td>
    <td width="22%"><?php  echo $records['file_No']; ?></td>
    <input type="hidden" name="file_no" value="<?php  echo $records['file_No']; ?>">
    <td width="15%"> <strong>Name</strong></td>
    <td width="39%"><?php  echo $records['salutation'].' '.$records['pensionee_name']; ?></td>
  </tr>
  <tr>
    <td><strong>Registration Number</strong></td>
    <td><?php  echo $records['registration_no']; ?></td>
    <td><strong>Employee Code</strong></td>
    <td><?php  echo $records['emp_code']; ?></td>
  </tr>
  <tr>
    <td><strong>Generated File No</strong></td>
    <td><?php  echo $records['auto_file_no']; ?></td>
    <td><strong>Designation</strong></td>
    <td><?php  echo $records['designation']; ?></td>
  </tr>
  <tr>
    <td><strong>Department Forwading No</strong></td>
    <td><?php  echo $records['dept_forw_no']; ?></td>
    <td><strong>Department</strong></td>
    <td><?php  echo $records['dept_name']; ?></td>
  </tr>
  <tr>
    <td><strong>Receipt Date</strong></td>
    <td><?php  echo $records['receipt_date'];?></td>
    <td><strong>Department Address</strong></td>
    <td><?php  echo $records['address_department'];?></td>    
  </tr>
  <tr>
    <td><strong>Received on Issue</strong></td>
    <td><?php  echo @$records1['dispatch_date'];?></td>
    <td><strong>District</strong></td>
    <td><?php  echo getDistrictById($records['district']); ?></td>
  </tr>
</table>
<div class="alert alert-success"><span style="color:#000000">Physical Files</span></div>




<script type="text/javascript" src="<?php echo base_url('includes/js/fancy-box/jquery.mousewheel-3.0.4.pack.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('includes/js/fancy-box/jquery.fancybox-1.3.4.pack.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('includes/css/fancy-box/jquery.fancybox-1.3.4.css'); ?>" media="screen" />

<h3>Pensioner Details</h3><hr style="margin: 5px 0;"/>
<?php $data = $data[0]; ?>
<table class="table table-striped table-bordered">
    <tbody>
        <tr>
          <td colspan="6" style="text-align: right;">
            <?php 
              $fileArr = unserialize(@$data['files']);
              $myDoc = array();
              if(!empty($fileArr)){
                  foreach ($fileArr as $file) {
                  echo '<div class="document-block">';
                  echo '<a class="example2" href="'.base_url($file['file_path']).'"><img src="'.base_url($file['file_path']).'" /></a><br/>';
                  echo '<div>'.getDocumentName($file['file_desc']).'</div>';
                  echo '</div>';
                  array_push($myDoc,$file['file_desc']);
                  }
                  foreach (getDocNotSubmitted($myDoc) as $fileNS) {
                      echo '<div class="document-block">';
                      echo '<img src="'.base_url('includes/images/no-document.jpg').'" /><br/>';
                      echo '<div>'.$fileNS['doc_name'].'</div>';
                      echo '</div>';
                  }
              }
            
            ?>
          </td>
        </tr>
    </tbody>
</table>

<style type="text/css">
  .document-block {width: 165px; min-height: 120px; margin: 5px; float: left; text-align: center;}
  .document-block img{margin: 0px auto; width: 100px; min-height: 75px; border: 3px solid #C5E4EE; border-radius: 3px; -moz-border-radius: 3px;}
  .doc-name {}
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $(".example2").fancybox({
            'overlayShow'   : false,
            'transitionIn'  : 'elastic',
            'transitionOut' : 'elastic'
        });
    });
</script>

<div id="forwrd" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forward To</h4>
            </div>
            <div class="modal-body">
                <textarea></textarea>
                <input type="checkbox" name="chk[]" value="AG">AG Office<br/>
                <textarea></textarea>
                <input type="checkbox" name="chk[]" value="Treasury"> Treasury<br/>
                <textarea></textarea>
                <input type="checkbox" name="chk[]" value="to_the_department"> Department <br/>
                <textarea></textarea>
                <input type="checkbox" name="chk[]" value="office_copy"> Pensioner Copy<br/>
                <input type="checkbox" name="chk[]" value="office_copy"> Office Copy
                
                
            </div>
            <div class="modal-footer">
               <a class="btn btn-success" data-dismiss="modal">No</a>
               <!-- <a href="#" class="btn btn-danger" id="del">Forward</a> -->
               <input type="submit" class="btn btn-danger">
            </div>
        </div>
    </div>
</div>
</form>