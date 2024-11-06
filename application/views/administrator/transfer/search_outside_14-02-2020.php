<?php $file_no = (isset($_POST['file_no'])) ? $_POST['file_no'] : ''; ?>

<form method="POST" action="<?php echo site_url($this->uri->uri_string()); ?>" accept-charset="UTF-8">   
    <div class="form-group" style="float: left; width: 60%">
        <label for="name_of_pensionser" class="control-label">File No</label>
        <input class="form-control" id="file_no" required="required" autocomplete="off" name="file_no" type="text" value="<?php echo $file_no; ?>" placeholder="File No">
        <input type="submit" name="search" value="Search" class="form-control btn btn-success" id="Search" style="margin: 0px;" />
    </div>
</form>
<hr />
<?php if(isset($_POST['file_no'])):?>
    <?php $case_details = (array) $transfer_details; ?>

    <?php if(count($case_details) <= 0) : ?>
        <div style="float: left; width: 40%; text-align: right;">
           <a href="<?php echo site_url('administrator/transfer/outside/'.base64_encode($_POST['file_no'])); ?>" class="btn btn-info">Add New Transfer</a>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
            <tr>
                <td colspan="4">No results found.</td>
            </tr>
        </table>
    <?php else : ?>        
        <?php
            $ag = array();
            $treasury = array();
            foreach(getAllAccountantGeneral() as $value) :
                $ag[$value['id']] = $value['name'];
            endforeach;
            foreach (getAllTreasury() as $value) :
                $treasury[$value['id']] = $value['title'];
            endforeach;
        ?>
        <?php $cd = $case_details[0]; ?>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
            <tr>
                <th width="25%">File No</th>
                <td width="25%"><?php echo $cd['case_no']; ?></td>
                <th width="25%">Pensioner Name</th>
                <td width="25%"><?php echo $cd['name']; ?></td>
            </tr>
            <tr>
                <th>Designation</th>
                <td><?php echo $cd['designation']; ?></td>
                <th>From</th>
                <td><?php echo str_replace(", ", ",<br />", $ag[$cd['orf']]); ?></td>
            </tr>
        </table>
    
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
            <tr>
                <th width="30%">Transfer to</th>
                <th width="15%">Memo No.</th>
                <th width="15%">PPO No.</th>
                <th width="15%">CPO No.</th>
                <th width="25%">Actions</th>
            </tr>
            <?php foreach ($transfer_details as $rd) : ?>
                <tr>
                    <td><?php echo str_replace(", ", ",<br />", $treasury[$rd['ost']]); ?></td>
                    <td><?php echo $rd['memo_no']; ?></td>
                    <td><?php echo $rd['ppo']; ?></td>
                    <td><?php echo $rd['cpo']; ?></td>
                    <td>
                        <a href="<?php echo site_url('administrator/transfer/report_outside/'.$rd['id']); ?>" class="btn btn-default btn-rad link" data-id=""><i class="icon-eye-open"></i>View</a><?php echo nbs(3); ?>
                        <a href="<?php echo site_url('administrator/transfer/edit_outside/'.$rd['id']); ?>" class="btn btn-default btn-info"><i class="icon-pencil"></i>Edit</a><?php echo nbs(3); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
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