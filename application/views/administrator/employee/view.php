<?php $row = $lists[0]; ?>
<div id="profile">
    <div id="header">
        <div class="img-block">
            <img src="<?php echo base_url('uploads/employee/'.$row['photograph']); ?>" width="150" height="150">
        </div>
        <div class="desc-block">
            <h1><?php echo $row['name']; ?></h1>
            <h2><?php echo $row['designation']; ?></h2>
        </div>
    </div>

    <table align="center" border="1" class="table table-striped table-bordered table-condensed">
        <tbody>
            <tr>
                <td width="20%"><b>Father/Husband Name</b></td>
                <td width="30%"><?php echo $row['fhname']; ?></td>
                <td width="18%"><b>Date of Birth</b></td>
                <td width="32%"><?php echo dateTimeToDate($row['dob']); ?></td>
            </tr>
            <tr>
                <td><b>Date of Joining</b></td>
                <td><?php echo dateTimeToDate($row['doj']); ?></td>
                <td><b>Date of Retirement</b></td>
                <td><?php echo dateTimeToDate($row['dor']); ?></td>
            </tr>
            <tr>
                <td><b>Sex</b></td>
                <td><?php echo $row['sex']; ?></td>
                <td><b>Category</b></td>
                <td><?php echo $row['category']; ?></td>
            </tr>
            <tr>
                <td><b>Appoint as</b></td>
                <td><?php echo $row['appoint_as']; ?></td>
                <td><b>Pay Band</b></td>
                <td><?php echo $row['pay_band']; ?></td>
            </tr>
            <tr>
                <td><b>Grade Pay</b></td>
                <td><?php echo $row['grade_pay']; ?></td>
                <td><b>Increament Amount</b></td>
                <td><?php echo $row['increament_amount']; ?></td>
            </tr>
            <tr>
                <td><b>Total Pay</b></td>
                <td><?php echo $row['total_pay']; ?></td>
                <td><b>SCA</b></td>
                <td><?php echo $row['sca']; ?></td>
            </tr>
            <tr>
                <td><b>Other Allowance</b></td>
                <td><?php echo $row['other_allowance']; ?></td>
                <td><b>DA</b></td>
                <td><?php echo $row['da']; ?></td>
            </tr>
            <tr>
                <td><b>Total Allowance</b></td>
                <td><?php echo $row['total_allowance']; ?></td>
                <td><b>Total Emolument</b></td>
                <td><?php echo $row['total_emolument']; ?></td>
            </tr>

            <tr>
                <td><b>Account No</b></td>
                <td><?php echo $row['account_no']; ?></td>
                <td><b>Bank Name</b></td>
                <td><?php echo $row['bank_name']; ?></td>
            </tr>
            <tr>
                <td><b>Branch</b></td>
                <td><?php echo $row['branch']; ?></td>
                <td><b>DDO Address</b></td>
                <td><?php echo $row['ddo_address']; ?></td>
            </tr>
            <tr>
                <td><b>Remarks</b></td>
                <td colspan="3"><?php echo $row['remarks']; ?></td>
            </tr>
        </tbody>
    </table>
</div>


<style type="text/css">
    @font-face {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: 400;
        src: local('Roboto Regular'), local('Roboto-Regular'), url('<?php echo base_url("includes/fonts/Roboto.woff"); ?>') format('woff');
    }

    #profile {padding: 0 20px;}
    #profile #header .img-block {float: left; width: 18%; margin-bottom: 20px;}
    #profile #header .img-block img{-webkit-border-radius: 5px 5px; -moz-border-radius: 5px / 5px; border-radius: 5px / 5px;}
    #profile #header .desc-block {float: left; width: 70%;}
    #profile #header .desc-block h1, h2{font-family: 'Roboto', sans-serif;font-weight: 400; }
    .table td {padding: 10px;}
</style>


