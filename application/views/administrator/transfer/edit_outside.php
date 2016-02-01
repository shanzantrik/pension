<?php $attr = 'class="form-control" autocomplete="off"'; ?>

<form method="POST" action="<?php echo site_url('administrator/transfer/edit_outside/'.$pensioner->id); ?>" accept-charset="UTF-8">
    <div class="form-group">
        <label for="case_no" class="control-label">File No</label>
        <input <?php echo $attr; ?> id="case_no" required="required" name="case_no" type="text" value="<?php echo $pensioner->case_no; ?>" placeholder="File No" style="width: 63%; float: left;" />
        <input <?php echo $attr; ?> id="case_dated" name="case_dated" type="text" placeholder="dated" value="<?php echo $pensioner->case_dated; ?>" style="width: 21%; float: left;" />
        <input type="hidden" name="type" value="outside" />
    </div>
    <div class="form-group" style="width: 63.5%">
        <label for="orf" class="control-label">Recived from </label>
        <select name="orf" class="form-control" required style="width: 100%;">
            <option value="">--Select--</option>
            <?php foreach (getAllAccountantGeneral() as $ag) { ?>
                <?php if($pensioner->orf == $ag['id']) : ?>
                    <option value="<?php echo $ag['id']; ?>" selected><?php echo $ag['name'];?></option>
                <?php else : ?>
                    <option value="<?php echo $ag['id']; ?>"><?php echo $ag['name'];?></option>
                <?php endif; ?>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <select name="salutation" id="salutation" style="width: 20%;float: left;">
            <option value="Shri" <?php if($pensioner->salutation == 'Shri') : ?>selected<?php endif; ?>>Shri</option>
            <option value="Smti" <?php if($pensioner->salutation == 'Smti') : ?>selected<?php endif; ?>>Smti</option>
        </select>
        <input <?php echo $attr; ?> id="name" required="required" name="name" type="text" placeholder="Type a Name" value="<?php echo $pensioner->name; ?>" style="width: 70%; float: left;" />
    </div>

    <div class="form-group">
        <label for="designation" class="control-label">Designation</label>
        <select name="designation" class="form-control" required>
            <option value="">--Select--</option>
            <?php foreach(getAllDesignation() as $desg) { ?>
                <?php if($pensioner->designation == $desg['desg_name']) : ?>
                    <option value="<?php echo $desg['desg_name']; ?>" selected><?php echo $desg['desg_name']; ?></option>
                <?php else : ?>
                    <option value="<?php echo $desg['desg_name']; ?>"><?php echo $desg['desg_name']; ?></option>
                <?php endif; ?>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="ost" class="control-label">Send to</label>
        <select name="ost" class="form-control" required>
            <option value="">--Select--</option>
            <?php foreach (getAllTreasury() as $treasury) { ?>
                <?php if($pensioner->ost == $treasury['id']) : ?>
                    <option value="<?php echo $treasury['id']; ?>" selected><?php echo $treasury['title']; ?></option>
                <?php else : ?>
                    <option value="<?php echo $treasury['id']; ?>"><?php echo $treasury['title'];?></option>
                <?php endif; ?>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="ppo" class="control-label">PPO No.</label>
        <input <?php echo $attr; ?> id="ppo" required="required" name="ppo" type="text" placeholder="Type PPO No" value="<?php echo $pensioner->ppo; ?>" />
    </div>
    <div class="form-group">
        <label for="ppo" class="control-label">CPO No.</label>
        <input <?php echo $attr; ?> id="cpo" name="cpo" type="text" placeholder="Type CPO No" value="<?php echo $pensioner->cpo; ?>" style="width: 63%; float: left;" />
        <input <?php echo $attr; ?> id="cpo_dated" name="cpo_dated" type="text" placeholder="dated" value="<?php echo $pensioner->cpo_dated; ?>" style="width: 21%; float: left;" />
    </div>
    <div class="form-group">
        <label for="draw_from" class="control-label">Draw From</label>
        <input <?php echo $attr; ?> id="draw_from" name="draw_from" type="text" placeholder="Draw pension from" value="<?php echo $pensioner->draw_from; ?>" />
    </div>
    <div class="form-group">
        <label for="paid_upto" class="control-label">Paid Up to</label>
        <input <?php echo $attr; ?> id="paid_upto" name="paid_upto" type="text" placeholder="Paid Up to" value="<?php echo $pensioner->paid_upto; ?>" />
    </div>
    <div class="form-group">
        <label for="letter_no" class="control-label">Commencements of Pension</label>
        <input <?php echo $attr; ?> id="comm_of_pension" name="comm_of_pension" type="text" placeholder="Commencements of Pension" value="<?php echo $pensioner->comm_of_pension; ?>">    
    </div>
    <div class="form-group">
        <label for="basic_pension" class="control-label">Basic Pension</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->basic_pension; ?>" id="basic_pension" required="required" name="basic_pension" type="number" step="any" placeholder="Basic pension">
    </div>
    <div class="form-group">
        <label for="reduced_pension" class="control-label">Reduced Pension</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->reduced_pension; ?>" id="reduced_pension" required="required" name="reduced_pension" type="number" step="any" placeholder="Reduced pension">
    </div>
    <div class="form-group">
        <label for="dearness_relief" class="control-label">Dearness Relief</label>
        <div style="float: left; margin: 5px 5px 0 0;">@</div>
        <input <?php echo $attr; ?> id="dearness_relief" value="<?php echo $pensioner->dearness_relief; ?>" type="text" name="dearness_relief" placeholder="Dearness Relief" style="width: 85%;">
    </div>
     <div class="form-group">
        <label for="medical_allowance" class="control-label">Medical Allowance</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->medical_allowance; ?>" id="medical_allowance" name="medical_allowance" type="number" step="any" placeholder="Medical Allowance">
    </div>
    <div class="form-group" style="width: 100%;">
        <label for="enhance_rate" class="control-label max-height"><b>Family Pension</b></label>
    </div>
    <div class="form-group" style="width: 50%;">
        <label for="enhance_rate" class="control-label">Enhance Rate</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->enhance_rate; ?>" id="enhance_rate" required="required" name="enhance_rate" type="number" step="any" placeholder="Enhance Rate">
    </div>
    <div class="form-group" style="width: 50%;">
        <label for="ordinary_rate" class="control-label">Normal Rate</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->ordinary_rate; ?>" id="ordinary_rate" required="required" name="ordinary_rate" type="number" step="any" placeholder="Normal Rate">
    </div>
    <div class="form-group">
        <label for="ordinary_rate" class="control-label">Amount of Gratuity</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->amount_of_gratuity; ?>" id="amount_of_gratuity" required="required" name="amount_of_gratuity" type="number" step="any" placeholder="Amount of Gratuity" />
    </div>
    <div class="form-group">
        <label for="ordinary_rate" class="control-label">Commuted value of Pension</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->commuted_value_of_pension; ?>" id="commuted_value_of_pension" required="required" name="commuted_value_of_pension" type="number" step="any" placeholder="Commuted value of Pension" />
    </div>
    <div class="form-group">
        <label for="ordinary_rate" class="control-label">Amount of pension commuted</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->amount_of_pension_commuted; ?>" id="amount_of_pension_commuted" required="required" name="amount_of_pension_commuted" type="number" step="any" placeholder="Amount of pension commuted" />
    </div>
    <div class="form-group">
        <label for="memo_no" class="control-label">Memo No</label>
        <input required <?php echo $attr; ?> value="<?php echo $pensioner->memo_no; ?>" id="memo_no" name="memo_no" type="text" placeholder="Memo No"/>
    </div>
    <div class="form-group">
        <label for="letter_no" class="control-label">Letter No.</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->letter_no; ?>" id="letter_no" name="letter_no" type="text" placeholder="Letter No">    
    </div>
    <div class="form-group">
        <label for="letter_no" class="control-label">Letter Date</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->letter_date; ?>" id="letter_date" name="letter_date" type="text" placeholder="Letter date">    
    </div>
    <div class="form-group">
        <label for="address" class="control-label">Address</label>
        <textarea required minlength="10" id="address" name="address" placeholder="Address" style="width: 90%;"><?php echo $pensioner->address; ?></textarea>
    </div>
    <div class="form-group" style="float: none;">
        <label class="control-label">&nbsp;</label>
        <input type="submit" name="update_transfer" value="Update" class="form-control btn btn-success" id="Save" />
    </div>
</form>

<style type="text/css">
    .form-group { width: 33%; float: left; }
    select, input[type="text"], input[type="number"] {width: 90%}
</style>
<script type="text/javascript">
    $(function() {
        $("#paid_upto, #case_dated, #cpo_dated, #letter_date, #comm_of_pension").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});

        $('#paid_upto, #case_dated, #cpo_dated, #letter_date, #comm_of_pension').bind('paste', function(e) {
            e.preventDefault();
            return false;
        });
    });
</script>