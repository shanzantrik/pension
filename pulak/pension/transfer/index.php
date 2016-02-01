<?php $file_no = (isset($_POST['file_no'])) ? $_POST['file_no'] : ''; ?>

<form method="POST" action="<?php echo site_url('administrator/pension/transfer'); ?>" accept-charset="UTF-8">   
    <div class="form-group" style="float: left; width: 60%">
        <label for="name_of_pensionser" class="control-label">File No</label>
        <input class="form-control" id="file_no" required="required" autocomplete="off" name="file_no" type="text" value="<?php echo $file_no; ?>" placeholder="File No">
        <button class="form-control btn btn-success" id="Search" type="submit">Search</button>
    </div>
</form>
<hr />
<?php if(isset($_POST['file_no'])):?>
    <div style="float: left; width: 40%; text-align: right;">
       <a href="<?php echo site_url('administrator/pension/transfer_add/'.base64_encode($_POST['file_no'])); ?>" class="btn btn-info">Add New Transfer</a>
    </div>
    <?php $case_details = (array) $service_details; ?>
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
        <tr>
            <th width="25%">File No</th>
            <td width="25%"><?php echo $case_details['case_no']; ?></td>
            <th width="25%">Pensioner Name</th>
            <td width="25%"><?php echo $case_details['name']; ?></td>
        </tr>
        
    </table>

    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
        <tr>
            <th width="20%">pay scale</th>
            <th width="15%">Pay commission</th>
            <th width="10%">Created</th>
            <th width="40%">Actions</th>
        </tr>
        <?php foreach ($revision_details as $rd) : ?>
            <?php $pay_scale_details = getPayScale(array('id'=>$rd['revised_scale_pay'])); ?>
            <?php $psd = $pay_scale_details[0]; ?>
            <tr>
                <td><?php echo $psd['grade']."-".$psd['pay_scale']; ?></td>
                <td><?php echo $psd['pay_commission']; ?></td>
                <td><?php echo dateTimeToDate($rd['pr_created_at']); ?></td>
                <td>
                    <a href="" class="btn btn-default btn-rad link" data-id=""><i class="icon-eye-open"></i>View</a><?php echo nbs(3); ?>
                    
                </td>
            </tr>
        <?php endforeach; ?>
       
    </table>
<?php endif; ?>

<style type="text/css">
    form {margin-bottom: 3px;}
    hr {margin: 0px;}
    .form-group {}
    .form-group label {font-weight: bold; float: left; margin-top: 15px;}
    .form-group input {margin-left: 10px;  margin-top: 10px;}
    .btn {padding: 6px;}
    .action-list {width: 150px;  margin: 0px;}
</style>