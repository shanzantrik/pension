<?php
    $ppo_no = $data->case_no."/".$data->ppo_no;
    $gpo_no = "Pen/AP/GPO/".$data->gpo_no;
    $cpo_no = "Pen/AP/COM/".$data->cpo_no;
    //print_r($data);
    if($data->sub_to==""){
        $to_no=$data->treasury_officer;
        $to_name=$this->model_pension->getToName($to_no);
    } else {
        $to_name=$data->sub_to;
    }
    $spouse_detail=getNameOfLegalHeir($data->family_info);
    $spouse = explode('-', $spouse_detail);
    $ageatretirement = calculateDateDifference($data->dob, $data->dor);
    $age = explode("-", $ageatretirement);
      
    $dor=$data->dor;
    $dor_m=explode('-',$dor);
    $pay_info=unserialize($data->pay_info);
    $lp = array();
    foreach ($pay_info[0] as $key => $value){
        if($key != 'post_DA') :
            $lp[$key] = $value;
        endif;
    }
    $ip = array();
    foreach ($pay_info[1] as $key => $value) {
        if($key != 'increament_DA') :
            $ip[$key] = $value;
        endif;
    }
    if(isset($data->revision_da) && $data->revision_da != '') :
        if($pay_info[1]['increament_DA'] == '' || $pay_info[1]['increament_DA'] == 0) :
            $da_post = $pay_info[0]['post_DA'];
        else :
            $da_post = $pay_info[1]['increament_DA'];
        endif;
    else :
        $da_post=$pay_info[0]['post_DA'];
        $da_incr=$pay_info[1]['increament_DA'];

        if($pay_info[1]['increament_DA'] == '' || $pay_info[1]['increament_DA'] == 0) :
            $data->revision_da = $pay_info[0]['post_DA'];
        else :
            $data->revision_da = $pay_info[1]['increament_DA'];
        endif;
    endif;

    $increament_date=$pay_info[2]['last_increament_date'];
    $monthsDiff = getDiffInMonth($dor,$increament_date);

    $incr_m=explode('-',$increament_date);
    $lastPay=getPay($lp, $da_post);
    $ae = getAverageEmolument($lp, $ip, $dor, $pay_info[2]['last_increament_date']);
    $pre_amt_pension=getAmountofPension($data->serial_no);
    //$commutation_pension=getCommutationofPension($pre_amt_pension, $age[0], $data->class_of_pension);
    //for rg
    $latestDaAmount = get_pecentage_of_da($lastPay,getLatestDaPercent());
    $year_of_service = year_of_service($data->net_qualifying_service);
    $getDCRG = getDCRG($data->serial_no);
    //$increament_BP=isset($pay_info['1']['increament_BP']) ? $pay_info['1']['increament_BP'] : 0;

    $post_BP=isset($pay_info['0']['post_BP']) ? $pay_info['0']['post_BP'] : 0;
    $post_GP=isset($pay_info['0']['post_GP']) ? $pay_info['0']['post_GP'] : 0;
    $post_NPA=isset($pay_info['0']['post_NPA']) ? $pay_info['0']['post_NPA'] : 0;
    $post_DA=isset($pay_info['0']['post_DA']) ? $pay_info['0']['post_DA'] : 0;

    $increament_BP=isset($pay_info['1']['increament_BP']) ? $pay_info['1']['increament_BP'] : 0;
    $increament_GP=isset($pay_info['1']['increament_GP']) ? $pay_info['1']['increament_GP'] : 0;
    $increament_NPA=isset($pay_info['1']['increament_NPA']) ? $pay_info['1']['increament_NPA'] : 0;
    $increament_DA=isset($pay_info['1']['increament_DA']) ? $pay_info['1']['increament_DA'] : 0;
    print_r($increament_DA);

    $com_applied=$data->com_applied;
    $monthsDiff = getDiffInMonth($dor,$increament_date);
    //print_r($monthsDiff);
    //$ae=getRevisionAE($lp,$da_post,$post_BP,$post_GP,$post_NPA,$increament_date,$dor,$lastPay);
?>
<form method="POST" action="<?php echo site_url('administrator/pension/revision_save'); ?>" accept-charset="UTF-8">   
    <div class="form-group">
        <label for="dob" class="control-label">Revision Type</label>
        <select name="revision_type" class="form-control" required>
            <option value="">--Select--</option>
            <option value="acp">ACP</option>
            <option value="macp">MACP</option>
            <option value="additional_increament">Additional Increament</option>
            <option value="refixation_of_pay">Refixation of pay</option>
            <option value="revised_gratuity">Revised Gratuity</option>
        </select>
    </div>
    <input type="hidden" id="monthsDiff" name="monthsDiff" value="<?php echo $monthsDiff;?>">
    <input type="hidden" id="lastPay" name="lastPay" value="<?php echo $lastPay;?>">
    <input type="hidden" id="doi" name="doi" value="<?php echo $increament_date;?>">
    <input type="hidden" id="dor_m" name="dor_m" value="<?php echo $dor_m[1];?>">
    <input type="hidden" id="incr_m" name="incr_m" value="<?php echo $incr_m[1];?>">
    <input type="hidden" id="dor" name="dor" value="<?php echo $dor;?>">
    <input type="hidden" id="post_BP" name="post_BP" value="<?php echo $post_BP?>">
    <input type="hidden" id="post_GP" name="post_GP" value="<?php echo $post_GP?>">
    <input type="hidden" id="post_NPA" name="post_NPA" value="<?php echo $post_NPA?>">
    <input type="hidden" id="post_DA" name="post_DA" value="<?php echo $post_DA?>">
    <input type="hidden" id="com_applied" name="com_applied" value="<?php echo $com_applied?>">
    <input type="hidden" id="age_at_retirement" name="age_at_retirement" value="<?php echo $age[0]; ?>" />
    <input type="hidden" id="class_of_pension" name="class_of_pension" value="<?php echo $data->class_of_pension; ?>" />

    <input type="hidden" id="increament_BP" name="increament_BP" value="<?php echo $increament_BP?>">
    <input type="hidden" id="increament_GP" name="increament_GP" value="<?php echo $increament_GP?>">

    <div class="form-group">
        <label for="name_of_pensioner" class="control-label">Name Of Pensionser</label>
        <input type="hidden" name="case_no" value="<?php echo $data->case_no; ?>" />
        <input type="hidden" name="serial_no" id="serial_no" value="<?php echo $data->serial_no; ?>" />
        <input readonly class="form-control" id="name_of_pensioner" required="required" autocomplete="off" name="name_of_pensioner" type="text" placeholder="Name Of Pensioner" value="<?php echo $data->name; ?>">
    </div>
    <div class="form-group">
        <label for="dob" class="control-label">Date of Birth</label>
        <input readonly class="form-control" id="dob" required="required" autocomplete="off" name="dob" type="text" placeholder="Date of Birth" value="<?php echo $data->dob; ?>">
    </div>
    <div class="form-group">
        <label for="doe" class="control-label">Date of Entry</label>
        <input readonly class="form-control" id="doe" required="required" autocomplete="off" name="doe" type="text" placeholder="Date of Entry" value="<?php echo $data->doj; ?>">
    </div>
    <div class="form-group">
        <label for="dor" class="control-label">Date of retirement</label>
        <input readonly class="form-control" id="dor" required="required" autocomplete="off" name="dor" type="text" placeholder="Date of retirement" value="<?php echo $data->dor; ?>">
    </div>

    <div class="form-group">
        <label for="dod" class="control-label">Date of death</label>
        <input <?php if($data->dod!="0000-00-00" && $data->dod!='') { ?>readonly<?php } ?> class="form-control" id="dod" autocomplete="off" name="dod" type="text" placeholder="Date of death" value="<?php if($data->dod!="0000-00-00" && $data->dod!=''){echo $data->dod;}?>">
    </div>

    <div class="form-group">
        <label for="aor" class="control-label">Age of retirement</label>
        <?php $aor = calculateDateDifference($data->dob, $data->dor, true); ?>
        <input readonly class="form-control" id="aor" required="required" autocomplete="off" name="aor" type="text" placeholder="Age of retirement" value="<?php echo $aor; ?>">
    </div>
    <div class="form-group">
        <?php list($year, $month, $day) = explode("-", $data->net_qualifying_service); ?>
        <label for="net_qualifying_service" class="control-label">Net Qualifying Service</label>
        <input readonly class="form-control" id="net_qualifying_service" required="required" autocomplete="off" name="net_qualifying_service" type="text" placeholder="Net Qualifying Service" value="<?php echo $year." years ".$month." months ".$day." days"; ?>">
    </div>
    <div class="form-group">
        <label for="smp" class="control-label">Six monthly period (SMP)</label>
        <input readonly class="form-control" id="smp" required="required" autocomplete="off" name="smp" type="text" placeholder="Six monthly period" value="<?php echo $data->smp; ?>">
    </div>
    <div class="form-group">
        <label for="revised_scale_pay" class="control-label">Revised scale of pay w.e.f. 1-1-2006</label>
        <?php $payScale = getPayScale('pay_commission >= '.$data->pay_commission); ?>
        <select class="form-control" id="revised_scale_pay" required="required" name="revised_scale_pay">
            <option value="">--Select--</option>
            <?php foreach($payScale as $ps) : ?>
                <option value="<?php echo $ps['id']; ?>"><?php echo $ps['grade']."-".$ps['pay_scale']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="last_pay" class="control-label">Last pay in Pay Band + Gd. Pay</label>
        <input class="form-control" id="last_pay" required="required" autocomplete="off" name="last_pay" type="number" step="any" placeholder="Last pay in Pay Band" style="width: 23%">+<input class="form-control" id="grade_pay" required="required" autocomplete="off" name="grade_pay" type="number" step="any" placeholder="Grade pay" style="width: 23%"> = <input readonly class="form-control" id="revised_total" required="required" autocomplete="off" name="revised_total" type="text" placeholder="Total" style="width: 33%">
    </div>

    <div class="form-group">
        <label for="last_pay" class="control-label">Dearness Allowance</label>
        <select required class="form-control revision_da" name="revision_da" id="revision_da">
            <option value="">Select</option>
            <?php foreach (getall_DA() as $da) { ?>
                <?php if($da['da'] == $data->revision_da) : ?>
                    <option value="<?php echo $da['da'];?>" selected><?php echo $da['da']; ?></option>
                <?php else : ?>
                    <option value="<?php echo $da['da'];?>"><?php echo $da['da']; ?></option>
                <?php endif; ?>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="average_emolument" class="control-label max-height">Average Emolument</label>
        <input readonly class="form-control" id="average_emolument" required="required" autocomplete="off" name="average_emolument" type="number" step="any" placeholder="Average Emolument">    
    </div>
    <div class="form-group">
        <label for="amount_of_pension_pre_revised" class="control-label max-height">Amount of Pension/family pension Sanctioned in pre-revised scale of pay</label>
        <input readonly class="form-control" id="amount_of_pension_pre_revised" required="required" autocomplete="off" value="<?php echo (isset($data->amountofpension)) ? $data->amountofpension : getAmountofPension($data->serial_no, true); ?>" name="amount_of_pension_pre_revised" type="number" step="any" placeholder="Amount of Pension/family pension Sanctioned in pre-revised scale of pay">
    </div>
    <div class="form-group">
        <label for="fifty_of_ae" class="control-label max-height">50% of AE in Revised Pay</label>
        <input readonly class="form-control" id="fifty_of_ae" required="required" autocomplete="off" name="fifty_of_ae" type="text" placeholder="50% of AE in Revised Pay">
    </div>
    <div class="form-group">
        <label for="fifty_of_last_pay" class="control-label">50% of last pay</label>
        <input readonly class="form-control" id="fifty_of_last_pay" required="required" autocomplete="off" name="fifty_of_last_pay" type="text" placeholder="50% of last pay">
    </div>
    <div class="form-group">
        <label for="fifty_of_pay_band_plus_grade_pay" class="control-label">50% of minimum of pay in pay Band Plus Grade Pay</label>
        <!-- <input readonly class="form-control" id="fifty_of_pay_band_plus_grade_pay" required="required" autocomplete="off" name="fifty_of_pay_band_plus_grade_pay" type="text" placeholder="50% of minimum of pay in pay Band Plus Grade Pay">  -->
        <input class="form-control" id="pay_band_pay" required="required" autocomplete="off" name="pay_band_pay" type="number" step="any" placeholder="Pay in pay band" style="width: 23%">+<input class="form-control" id="pay_band_grade_pay" autocomplete="off" name="pay_band_grade_pay" type="number" step="any" placeholder="Grade pay" style="width: 23%"> = <input readonly class="form-control" id="fifty_of_pay_band_plus_grade_pay" required="required" autocomplete="off" name="fifty_of_pay_band_plus_grade_pay" type="text" placeholder="50% of minimum of pay in pay Band Plus Grade Pay" style="width: 33%"> 
    </div>
    <div class="form-group">
        <label for="revised_amount_of_pension" class="control-label">Amount of pension/family pension Sanctioned<!-- (whichever is highest at 12, 13, 14) --></label>
        <input readonly class="form-control" id="revised_amount_of_pension" required="required" autocomplete="off" name="revised_amount_of_pension" type="text" placeholder="Amount of pension/family pension">
    </div>
   
    <div class="form-group">
        <label for="last_pay" class="control-label">Amount of revised D.C.R.G-Amount of prerevised D.C.R.G</label>
        <input readonly class="form-control" id="revised_dcrg" required="required" autocomplete="off" name="revised_dcrg" type="number" step="any" placeholder="" style="width: 23%"> -
        <input class="form-control" id="prerevised_dcrg" required="required" autocomplete="off" name="prerevised_dcrg" value="<?php echo (isset($data->prerevised_dcrg)) ? $data->prerevised_dcrg : $getDCRG; ?>" type="number" step="any" placeholder="" style="width: 23%"> = 
        <input readonly class="form-control" id="total_payable" required="required" autocomplete="off" name="total_payable" type="text" placeholder="Total" style="width: 33%">
    </div>

    <div class="form-group" id="amount-of-revised-family-pension">
        <label for="revised_enhance_rate" class="control-label">Amount of Revised Family Pension</label>

        <label for="revised_enhance_rate" class="control-label label1">a) Enhanced rate of Family Pension</label>
        <input readonly class="form-control" id="revised_enhance_rate" required="required" autocomplete="off" name="revised_enhance_rate" type="text" placeholder="Enhanced rate">

        <label for="revised_enhance_rate" class="control-label label1">b) Ordinary rate of Family Pension (30% of last pay in PB + Grade Pay)</label>
        <input readonly class="form-control" id="revised_ordinary_rate" required="required" autocomplete="off" name="revised_ordinary_rate" type="text" placeholder="Ordinary rate">
    </div>
     <div class="form-group">
        <label for="revised_cop" class="control-label">Revised Commutation Applied?</label>
        <input type="radio" name="re_com_applied" class="re_com_applied" value="1">Yes
        <input type="radio" name="re_com_applied" class="re_com_applied" value="0">No
    </div>

    <div class="form-group">
        <input readonly class="form-control" id="pre_revised_cop" required="required" autocomplete="off" name="pre_revised_cop" type="hidden" placeholder="Revised Commutation of Pension">
        <label for="revised_cop" class="control-label">Revised Commutation of Pension</label>
        <input readonly class="form-control" id="revised_cop" required="required" autocomplete="off" name="revised_cop" type="text" placeholder="Revised Commutation of Pension">
    </div>
    <div class="form-group">
        <label for="revised_reduced_pension" class="control-label">Reduced pension after commutation</label>
        <input readonly class="form-control" id="revised_reduced_pension" required="required" autocomplete="off" name="revised_reduced_pension" type="text" placeholder="Reduced pension after commutation">
    </div>
    <div class="form-group">
        <label for="name_of_family_pensionser" class="control-label">Name of Family Pensioner</label>
        <input readonly class="form-control" id="name_of_family_pensionser" required="required" autocomplete="off" name="name_of_family_pensionser" value="<?php echo getNameOfLegalHeirWithoutInfo($data->family_info); ?>" type="text" placeholder="Name of Family Pensioner">
    </div>
    <div class="form-group">
        <label for="treasury" class="control-label max-height">Name of Treasury/Sub-Treasury</label>
        <input class="form-control" id="treasury" required="required" autocomplete="off" name="treasury" type="text" value="<?php echo $to_name;?>" placeholder="Name of Treasury/Sub-Treasury">
    </div>
    <div class="form-group">
        <label for="pension_enhanced" class="control-label max-height">Pension be enhanced on attaining the age of 80 years</label>
        <input class="form-control" id="pension_enhanced" required="required" autocomplete="off" name="pension_enhanced" value="60" type="text" placeholder="">
    </div>
    <div class="form-group" style="height: 60px;">&nbsp;</div>

    <div class="form-group" id="recovery">
        <label for="recovery" class="control-label">Recovery :-</label>

        <label for="recovery_ppo_no" class="control-label label1">As per PPO No.</label>
        <input readonly class="form-control" id="recovery_ppo_no" required="required" autocomplete="off" value="<?php echo $ppo_no; ?>" name="recovery_ppo_no" type="text" placeholder="PPO No">
        <label for="recovery_ppo_date" class="control-label label1">Dated</label>
        <input readonly class="form-control date" id="recovery_ppo_date" required="required" autocomplete="off" value="<?php echo dateTimetodate($data->created_at); ?>" name="recovery_ppo_date" type="text" placeholder="Dated">

        <label for="recovery_gpo_no" class="control-label label1">As per GPO No.</label>
        <input readonly class="form-control" id="recovery_gpo_no" required="required" autocomplete="off" value="<?php echo $gpo_no; ?>" name="recovery_gpo_no" type="text" placeholder="GPO No">
        <label for="recovery_gpo_date" class="control-label label1">Dated</label>
        <input readonly class="form-control date" id="recovery_gpo_date" required="required" autocomplete="off" value="<?php echo dateTimetodate($data->created_at); ?>" name="recovery_gpo_date" type="text" placeholder="Dated">

        <label for="recovery_cpo_no" class="control-label label1">As per CPO No.</label>
        <input readonly class="form-control" id="recovery_cpo_no" name="recovery_cpo_no" value="<?php echo $cpo_no; ?>" type="text" placeholder="CPO No">
        <label for="recovery_cpo_date" class="control-label label1">Dated</label>
        <input readonly class="form-control date" id="recovery_cpo_date" value="<?php echo dateTimetodate($data->created_at); ?>" name="recovery_cpo_date" autocomplete="off" type="text" placeholder="Dated">
    </div>

    <button class="form-control btn btn-success" id="Save" type="submit">Save</button>
</form>

<style type="text/css">
    .form-group {width: 33%; float: left;}
    .form-group label {font-weight: bold;}
    .form-control {width: 90%;}
    .btn {width: 100%; padding: 6px;}
    label {padding-right: 10px;}
    #amount-of-revised-family-pension {width: 96%; margin: 20px 0;}
    #amount-of-revised-family-pension .label1 {margin: 12px 0 0 20px; float: left;}
    #amount-of-revised-family-pension input {width: 50%;float: right;margin: 8px 0 0 10px;}

    #recovery {width: 96%; margin: 20px 0;}
    #recovery .label1 {margin: 12px 0 0 20px; float: left; padding-right: 0px!important;}
    #recovery input {width: 50%;float: left;margin: 8px 0 0 10px;}
    #recovery .date{width: 30%;}

    .max-height {height: 36px;}
</style>


<script type="text/javascript">
    $(document).ready(function() {
        $('#last_pay, #grade_pay').keyup(function() {
            revised_total();
            fifty_of_last_pay();
            ordinary_rate();
            if($('#dod').val() == '') {
                ae();
            }
            dcrg();
            totalPayableDcrg();
            enhanced_rate();
            revised_amount_of_pension();
            prerevised_revised_dcrg();
        });

        $('#revised_total').blur(function() {
            enhanced_rate();
        });

        

        $('#revision_da').live('change', function() {
            totalPayableDcrg();
            dcrg();
        });

        $('#prerevised_dcrg').blur(function() {
            totalPayableDcrg();
        });

        $('#pay_band_pay, #pay_band_grade_pay').keyup(function() {
            fifty_of_pay_band_plus_grade_pay();
            revised_amount_of_pension();
        });

       //$('#last_pay, #grade_pay, #average_emolument, #fifty_of_ae, #fifty_of_last_pay, #pay_band_pay, #pay_band_grade_pay, #fifty_of_pay_band_plus_grade_pay').keyup(function() {
        $('#pay_band_pay, #pay_band_grade_pay').keyup(function() {
            reduced_pension();
        });

        $('#last_pay, #grade_pay').keyup(function() {
            var me = $(this);
            if($('#revised_scale_pay').val() == '') {
                me.val('');
                $('#revised_total, #fifty_of_last_pay, #revised_amount_of_pension, #revised_enhance_rate, #revised_ordinary_rate').val('');
                alert('Please select revised scale of pay.');
                $('#revised_scale_pay').focus();
            }
        });
    });

    <?php if($data->dod=="0000-00-00" || $data->dod=='') { ?>
        $('body').on('focus',"#dod", function(){
            $(this).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});
        });
    <?php } ?>

    var revised_total = function() {
        var last_pay = parseFloat($('#last_pay').val()) || 0;
        var grade_pay = parseFloat($('#grade_pay').val()) || 0;
        var sum = last_pay+grade_pay;
        $('#revised_total').val(sum);
    }
     var prerevised_revised_dcrg = function() {
        var prerevised_dcrg = parseFloat($('#prerevised_dcrg').val()) || 0;
        var revised_dcrg = parseFloat($('#revised_dcrg').val()) || 0;
        var sub =revised_dcrg-prerevised_dcrg;
        $('#prerevised_revised_dcrg').val(sub);
    }

    var fifty_of_ae = function() {
        var average_emolument = parseFloat($('#average_emolument').val()) || 0;
        $('#fifty_of_ae').val(average_emolument/2);
    }

    var fifty_of_last_pay = function() {
        var revised_total = parseFloat($('#revised_total').val()) || 0;
        $('#fifty_of_last_pay').val(revised_total/2);
    }

    var fifty_of_pay_band_plus_grade_pay = function() {
        var pay_band_pay = parseFloat($('#pay_band_pay').val()) || 0;
        var pay_band_grade_pay = parseFloat($('#pay_band_grade_pay').val()) || 0;
        var sum = pay_band_pay+pay_band_grade_pay;
        $('#fifty_of_pay_band_plus_grade_pay').val(sum/2);
    }

    //from bikram file
    /*var ae = function() {
        var re_last_pay = parseFloat($('#last_pay').val()) || 0;
        var re_grade_pay = parseFloat($('#grade_pay').val()) || 0;

        var post_BP = parseFloat($('#post_BP').val()) || 0;
        var post_GP = parseFloat($('#post_GP').val()) || 0;
        var dor = $('#dor').val();
        var doi = $('#doi').val();
        
        $.post('<?php echo site_url("administrator/pension/get_revision_average_emolument"); ?>', {re_last_pay: re_last_pay, re_grade_pay: re_grade_pay, post_BP: post_BP, post_GP: post_GP, dor: dor, doi: doi}, function(result) {
            $('#average_emolument').val(result);
            var fifty_of_ae = result/2;
            $('#fifty_of_ae').val(fifty_of_ae);
        });
    }*/

    //from sanjay file
    var ae = function() {
        var re_last_pay = parseFloat($('#last_pay').val()) || 0;
        var re_grade_pay = parseFloat($('#grade_pay').val()) || 0;

        var post_BP = parseFloat($('#post_BP').val()) || 0;
        var post_GP = parseFloat($('#post_GP').val()) || 0;

        var increament_BP = parseFloat($('#increament_BP').val()) || 0;
        var increament_GP = parseFloat($('#increament_GP').val()) || 0;

        
        var dor = $('#dor').val();
        var doi = $('#doi').val();
    
          $.post('<?php echo site_url("administrator/pension/get_revision_average_emolument"); ?>', {re_last_pay: re_last_pay, re_grade_pay: re_grade_pay, post_BP: post_BP, post_GP: post_GP, increament_BP: increament_BP, increament_GP: increament_GP, dor: dor, doi: doi}, function(result) {
            $('#average_emolument').val(result);
            var fifty_of_ae = result/2;
            $('#fifty_of_ae').val(fifty_of_ae);
        });
    }


    var totalPayableDcrg = function() {
        var revised_dcrg = parseInt($('#revised_dcrg').val()) || 0;
        var prerevised_dcrg = parseInt($('#prerevised_dcrg').val()) || 0;
        //alert(revised_dcrg);
        //alert(prerevised_dcrg);
        var total = revised_dcrg - prerevised_dcrg;
        console.log(revised_dcrg +"-"+ prerevised_dcrg +" = "+total);

        $('#total_payable').val(revised_dcrg - prerevised_dcrg);
    }

    var dcrg = function(){
        $.post('<?php echo site_url("administrator/pension/get_revision_dcrg"); ?>', {serial_no: $('#serial_no').val(), basic_pay: $('#last_pay').val() || 0, grade_pay: $('#grade_pay').val() || 0, revision_da: $('#revision_da').val()}, function(result) {
            if(result == 'redirect') {
                window.location = '<?php echo site_url("administrator/pension/revision_index"); ?>';
            } else {
                $('#revised_dcrg').val(result);
                $('#prerevised_dcrg').trigger('blur');
            }
        });
    }

    var enhanced_rate = function(){
        var last_pay = parseFloat($('#revised_total').val()) || 0;
        var enhanced_rate=(last_pay*50)/100;
        $('#revised_enhance_rate').val(enhanced_rate); 
    }
    
    var reduced_pension = function(){
        var com_applied =$('#com_applied').val();
        var revised_amount_of_pension =$('#revised_amount_of_pension').val();
        var amount_of_pension_pre_revised = parseFloat($('#amount_of_pension_pre_revised').val()) || 0;
        
        if(com_applied=="0"){
            var reduced_pension=(revised_amount_of_pension-((40*amount_of_pension_pre_revised)/100));
        } else {
            var reduced_pension=(revised_amount_of_pension-((40*revised_amount_of_pension)/100));
        }
        $('#revised_reduced_pension').val(reduced_pension); 
    }

    var enhanced_rate = function() {
        $.post('<?php echo site_url("administrator/pension/get_enhance_rate"); ?>', {last_pay: $('#revised_total').val() || 0, case_no: '<?php echo $data->case_no; ?>'}, function(result) {
            if(result == 'redirect') {
                window.location = '<?php echo site_url("administrator/pension/revision_index"); ?>';
            } else {
                $('#revised_enhance_rate').val(result);
            }
        });
    }

    /*var get_case_details = function() {
        $.post('<?php echo site_url("administrator/pension/get_case_details"); ?>', {}, function(result) {
            console.log(result);
        })
    }*/

    var ordinary_rate = function() {
        var last_pay = parseFloat($('#last_pay').val()) || 0;
        var grade_pay = parseFloat($('#grade_pay').val()) || 0;
        var rate = ((last_pay+grade_pay)*30)/100;
        $('#revised_ordinary_rate').val(rate);
    }

    $('.re_com_applied').change(function() {
            //alert("heolo");
    var re_com_applied = ($(this).val());
    var revised_amount_of_pension = parseFloat($('#revised_amount_of_pension').val()) || 0;
    var amount_of_pension_pre_revised = parseFloat($('#amount_of_pension_pre_revised').val()) || 0;
    //alert(re_com_applied);
    $.post('<?php echo site_url("administrator/pension/get_revision_commutation_of_pension"); ?>', {amountofPension: revised_amount_of_pension, age_at_retirement: $('#age_at_retirement').val(), class_of_pension: $('#class_of_pension').val()}, function(data) {
    if(re_com_applied==1){
        $('#revised_cop').val(data);
    }else{
        $('#revised_cop').val('N/A');
    }

        });

$.post('<?php echo site_url("administrator/pension/get_revision_commutation_of_pension"); ?>', {amountofPension: amount_of_pension_pre_revised, age_at_retirement: $('#age_at_retirement').val(), class_of_pension: $('#class_of_pension').val()}, function(data) {
        $('#pre_revised_cop').val(data);

        });

    


  })

    var revised_amount_of_pension = function() {
        var fifty_of_ae = parseFloat($('#fifty_of_ae').val()) || 0;
        var fifty_of_last_pay = parseFloat($('#fifty_of_last_pay').val()) || 0;
        var fifty_of_pay_band_plus_grade_pay = parseFloat($('#fifty_of_pay_band_plus_grade_pay').val()) || 0;
        var re_com_applied =parseFloat($('#re_com_applied').val()) || 0;
        //console.log("f : "+fifty_of_pay_band_plus_grade_pay);
        var result = 0;
        if(fifty_of_ae < fifty_of_last_pay) {
            if(fifty_of_last_pay < fifty_of_pay_band_plus_grade_pay) {
                result = fifty_of_pay_band_plus_grade_pay;
            } else {
                result = fifty_of_last_pay;
            }
        } else if(fifty_of_ae < fifty_of_pay_band_plus_grade_pay ) {
            if(fifty_of_pay_band_plus_grade_pay < fifty_of_last_pay) {
                result = fifty_of_last_pay;
            } else {
                result = fifty_of_pay_band_plus_grade_pay;
            }
        } else {
            result = fifty_of_ae;
        }
        $('#revised_amount_of_pension').val(result);

        /*$.post('<?php echo site_url("administrator/pension/get_revision_commutation_of_pension"); ?>', {amountofPension: result, age_at_retirement: $('#age_at_retirement').val(), class_of_pension: $('#class_of_pension').val()}, function(data) {
            <?php if($com_applied=="1") :?>
                 $('#revised_cop').val(data);
        <?php else:?>
                 $('#revised_cop').val('N/A');
        <?php endif;?>

            /*if(re_com_applied=='1'){
                $('#revised_cop').val("data");
            }else if(re_com_applied=='0'){
                $('#revised_cop').val("na");
            }
*/
        //});*/
    }
</script>