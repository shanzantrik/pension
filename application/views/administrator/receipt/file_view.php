<script type="text/javascript" src="<?php echo base_url('includes/js/fancy-box/jquery.mousewheel-3.0.4.pack.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('includes/js/fancy-box/jquery.fancybox-1.3.4.pack.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('includes/css/fancy-box/jquery.fancybox-1.3.4.css'); ?>" media="screen" />




<h3>Pensioner Document Details
<?php 
$data = $data[0]; 
$file_no =$data['file_No'];
$encode_file = base64_encode($file_no);

?>
 <small>
    <?php if($this->session->userdata('branch_code') != '1002') : ?>
        <a target="_blank" href="<?php echo site_url('administrator/receipt/pensionser_file_upload/'.$encode_file);?>"><i class="icon-upload"></i>Upload More Files</a>
    <?php endif; ?>
</small></h3>
<hr style="margin: 5px 0;"/>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
        	<th>File No</th>
            <th>Employee Code</th>
            <th>Designation</th>
            <th>Branch</th>
            <th>Full Name</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        	<td><?php echo $data['file_No']; ?></td>
            <td><?php echo $data['emp_code']; ?></td>
            <td><?php echo $data['designation']; ?></td>
            <td><?php echo getBranchName($data['branch_code']); ?></td>
            <td><?php echo $data['salutation']." ".$data['pensionee_name']; ?></td>
            <td><?php echo $data['remarks']; ?></td>
        </tr>
        <tr>
            <td colspan="6">
                <?php $old=array();?>
                <?php
                    foreach ($all_files as $file) {
                        $old[$file['doc_no']]=$file['doc_name'];
                    }
                    $new=array();
                    for($i=0;$i<count($files);$i++){
                        array_push($new, $files[$i]['doc_code']);
                    }
                    foreach ($old as $key => $value) {
                        if(in_array($key, $new)){ ?>
                            <input type="checkbox" readonly="readonly" name="chk" checked="checked"/>
                            <?php echo $value;?><br/>
                        <?php } else { ?>
                            <input type="checkbox" readonly="readonly" name="chk1"/><?php echo $value?><br/>
                        <?php } 
                    }
                ?>
           </td>
        </tr>
        <tr>
        	<td colspan="6" style="text-align: right;">
        		<?php
        			$myDoc=array();
                    if(!empty($files)){
                        foreach ($files as $file){
                            echo '<div class="document-block">';
                            if($file['ftype']=='image') { ?>
                                <a class="example2" href="<?php echo base_url($file['files']);?>">
                                <img src="<?php echo base_url($file['files']);?>" /></a><br/>
                            <?php } else { ?>
                                <a href="<?php echo site_url('administrator/receipt/downloads/'.base64_encode($file['files']));?>">
                                <img style="margin: 0px auto; width: 85px; min-height: 55px; border: 3px solid #C5E4EE; border-radius: 3px; -moz-border-radius: 3px;"  src="<?php echo base_url('includes/images/dc.png');?>" /></a><br/>
                            <?php  }
                            echo '<div>'.getDocumentName($file['doc_code']).'</div>';
                            echo '</div>';
							array_push($myDoc,$file['doc_code']);
                        }
						$status=$file['status'];
                        foreach (getDocNotSubmitted($myDoc,$status) as $fileNS) {
                            echo '<div class="document-block">';
                            echo '<img src="'.base_url('includes/images/no-document.jpg').'" /><br/>';
                            echo '<div>'.$fileNS['doc_name'].'</div>';
                            echo '</div>';
                        }
                    }
                    else { ?>
<div style="text-align:left; color:red">
    <?php $file_no = str_replace("/", "-", $data['file_No']);
    //echo $file_no;?>
<strong>No documents have been submitted yet for this Employee.</strong>&nbsp;&middot;&nbsp;
<?php if($this->session->userdata('branch_code') != '1002') : ?>
    <a target="_blank" href="<?php echo site_url('administrator/receipt/pensionser_file_upload/'.$encode_file);?>">Upload Files</a>
<?php endif; ?>

 
</div>
<?php       
  }
 ?>
        </td>
        </tr>
       
    </tbody>
</table>

<style type="text/css">
	.document-block {width:165px; min-height: 120px; margin: 5px; float: left; text-align: center;}
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