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
    <div style="float: left; width: 40%; text-align: right;">
       <a href="<?php echo site_url('administrator/transfer/inside/'.base64_encode($_POST['file_no'])); ?>" class="btn btn-info">Add New Transfer</a>
    </div>
    <?php $case_details = (array) $service_details; ?>
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
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
        <tr>
            <th width="25%">File No</th>
            <td width="25%"><?php echo $case_details['case_no']; ?></td>
            <th width="25%">Pensioner Name</th>
            <td width="25%"><?php echo $case_details['name']; ?></td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td><?php echo $case_details['dob']; ?></td>
            <th>Date of retirement</th>
            <td><?php echo $case_details['dor']; ?></td>
        </tr>
        <tr>
            <th>Net Qualifying Service</th>
            <td>
                <?php list($year, $month, $day) = explode("-", $case_details['net_qualifying_service']); ?>
                <?php echo $year." years ".$month." month ".$day." days"; ?>
            </td>
            <th>Designation</th>
            <td><?php echo $case_details['designation']; ?></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" width="100%">
        <tr>
            <th width="30%">Transfer to</th>
            <th width="15%">Memo No.</th>
            <th width="15%">Letter No.</th>
            <th width="15%">Letter Date</th>
            <th width="25%">Actions</th>
        </tr>
        <?php if(count($transfer_details) > 0) : ?>
            <?php foreach ($transfer_details as $rd) : ?>
                <tr>
                    <td>
                        <?php
                            /*if($rd['send_to'] == 'inside') :
                                echo str_replace(", ", ",<br />", $treasury[$rd['istti']]);
                            elseif($rd['send_to'] == 'outside') :*/
                                echo str_replace(", ", ",<br />", $ag[$rd['ist']]);
                            //endif;
                        ?>
                    </td>
                    <td><?php echo $rd['memo_no']; ?></td>
                    <td><?php echo $rd['letter_no']; ?></td>
                    <td><?php echo dateTimeToDate($rd['letter_date']); ?></td>
                    <td>
                        <a href="<?php echo site_url('administrator/transfer/report_inside/'.$rd['id']); ?>" class="btn btn-default btn-rad link"><i class="icon-eye-open"></i>View</a><?php echo nbs(3); ?>
                        <a href="<?php echo site_url('administrator/transfer/edit_inside/'.$rd['id']); ?>" class="btn btn-default btn-info"><i class="icon-pencil"></i>Edit</a><?php echo nbs(3); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">No records found.</td>
            </tr>
        <?php endif; ?>
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