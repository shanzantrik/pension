<?php
    $attr = 'class="form-control" autocomplete="off"';
?>

<form method="POST" action="<?php echo site_url('administrator/transfer/edit_inside/'.$pensioner->id); ?>" accept-charset="UTF-8">
    <div class="form-group">
        <label for="case_no" class="control-label">File No</label>
        <input <?php echo $attr; ?> readonly id="case_no" required="required" name="case_no" type="text" value="<?php echo $pensioner->case_no; ?>" placeholder="File No">
        <input type="hidden" name="type" value="inside" />
    </div>
    <div class="form-group">
        <label for="irf" class="control-label">Recived from</label>
        <select name="irf" class="form-control" id="irf" required>
            <option value="">--Select--</option>
            <?php foreach (getAllTreasury() as $treasury) { ?>
                <?php if($pensioner->irf == $treasury['id']) : ?>
                    <option value="<?php echo $treasury['id']; ?>" selected><?php echo $treasury['title']; ?></option>
                <?php else : ?>
                    <option value="<?php echo $treasury['id']; ?>"><?php echo $treasury['title']; ?></option>
                <?php endif; ?>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="name" class="control-label">Shri/Smti</label>
        <input <?php echo $attr; ?> readonly id="name" required="required" name="name" type="text" placeholder="Type a Name" value="<?php echo $pensioner->name; ?>">
    </div>
    <div class="form-group" style="width: 66%">
        <label for="ist" class="control-label">Send to <?php echo nbs(4); ?></label>
        <select name="ist" class="form-control" id="ist" required style="width: 95%;">
            <option value="">--Select--</option>
            <?php foreach (getAllAccountantGeneral() as $ag) { ?>
                <?php if($pensioner->ist == $ag['id']) : ?>
                    <option value="<?php echo $ag['id']; ?>" selected><?php echo $ag['name'];?></option>
                <?php else : ?>
                    <option value="<?php echo $ag['id']; ?>"><?php echo $ag['name'];?></option>
                <?php endif; ?>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="ppo" class="control-label">PPO No.</label>
        <input <?php echo $attr; ?> readonly id="ppo" required="required" name="ppo" type="text" placeholder="Type PPO No" value="<?php echo $pensioner->ppo; ?>">
    </div>
    <div class="form-group">
        <label for="draw_from" class="control-label">Draw From</label>
        <input class="form-control" id="draw_from" required="required" autocomplete="off" name="draw_from" type="text" placeholder="Draw pension from" value="<?php echo $pensioner->draw_from; ?>" />
    </div>
    <div class="form-group">
        <label for="paid_upto" class="control-label">Paid Up to</label>
        <input  class="form-control" id="paid_upto" required="required" autocomplete="off" name="paid_upto" type="text" placeholder="Paid Up to" value="<?php echo $pensioner->paid_upto; ?>" />
    </div>
    <div class="form-group">
        <label for="basic_pension" class="control-label max-height">Basic Pension</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->basic_pension; ?>" id="basic_pension" required="required" name="basic_pension" type="number" step="any" placeholder="Basic pension">
    </div>
    <div class="form-group">
        <label for="reduced_pension" class="control-label max-height">Reduced Pension</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->reduced_pension; ?>" id="reduced_pension" required="required" name="reduced_pension" type="number" step="any" placeholder="Reduced pension">
    </div>
    <div class="form-group">
        <label for="dearness_relief" class="control-label max-height">Dearness Relief</label>
        <div style="float: left; margin: 5px 5px 0 0;">@</div>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->dearness_relief; ?>" id="dearness_relief" type="text" required="required" name="dearness_relief" placeholder="Dearness Relief" <?php if($case_type == 'inside') : ?>style="width: 10%;"<?php else : ?>style="width: 85%;"<?php endif; ?>>
        <input <?php echo $attr; ?> readonly id="dr_total" value="<?php echo ($pensioner->basic_pension*$pensioner->dearness_relief/100); ?>" class="form-control" type="number" step="any" style="width: 72%;" />
    </div>
     <div class="form-group">
        <label for="medical_allowance" class="control-label max-height">Medical Allowance</label>
        <input value="<?php echo $pensioner->medical_allowance; ?>" class="form-control" id="medical_allowance" required="required" autocomplete="off" name="medical_allowance" type="number" step="any" placeholder="Medical Allowance">
    </div>
    <div class="form-group" style="width: 100%;">
        <label for="enhance_rate" class="control-label max-height"><b>Family Pension</b></label>
    </div>
    <div class="form-group" style="width: 50%;">
        <label for="enhance_rate" class="control-label max-height">Enhance Rate</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->enhance_rate; ?>" id="enhance_rate" required="required" name="enhance_rate" type="number" step="any" placeholder="Enhance Rate">
    </div>
    <div class="form-group" style="width: 50%;">
        <label for="ordinary_rate" class="control-label max-height">Normal Rate</label>
        <input <?php echo $attr; ?> value="<?php echo $pensioner->ordinary_rate; ?>" id="ordinary_rate" required="required" name="ordinary_rate" type="number" step="any" placeholder="Normal Rate">
    </div>
    <div class="form-group">
        <label for="memo_no" class="control-label max-height">Memo No <input type="checkbox" id="memo_no_change" style="margin: 0px;" />&nbsp;Change</label>
        <input required readonly <?php echo $attr; ?> value="DAP/TRNF/2005/VOL-IV/V" id="memo_no" name="memo_no" type="text" placeholder="Memo No"/>
    </div>
    <div class="form-group">
        <label for="letter_no" class="control-label max-height">Letter No.</label>
        <input <?php echo $attr; ?> id="letter_no" required="required" name="letter_no" type="text" placeholder="Letter No" value="<?php echo $pensioner->letter_no; ?>" />    
    </div>
    <div class="form-group">
        <label for="letter_no" class="control-label max-height">Letter Date</label>
        <input required class="form-control" id="letter_date" autocomplete="off" name="letter_date" type="text" placeholder="Letter date" value="<?php echo $pensioner->letter_date; ?>" />    
    </div>
    <div class="form-group">
        <label for="address" class="control-label">Address</label>
        <textarea required minlength="10" id="address" name="address" placeholder="Address" style="width: 90%; height: 60px;"><?php echo $pensioner->address; ?></textarea>
    </div>
    <div class="form-group" style="float: none;">
        <label class="control-label max-height">&nbsp;</label>
        <input type="submit" name="update_transfer" value="Update" class="form-control btn btn-success" id="Save" />
    </div>
</form>

<style type="text/css">
    .form-group { width: 33%; float: left; }
    select, input[type="text"], input[type="number"] {width: 90%}
</style>
<script type="text/javascript">
    $(function() {
        $("#paid_upto, #letter_date").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1900:+0'});

        $('#send_to').click(function() {
            var me = $(this);
            if(me.is(':checked')) {
                /*$('#ist').attr('name', 'istti');
                me.parent('.control-label').parent('.form-group').css('width', '33%');
                $('#ist').css('width', '90%');
                html = '<option value="">--Select--</option>';
                html += '<?php foreach (getAllTreasury() as $treasury) { ?>';
                html += '<option value="<?php echo $treasury["id"]; ?>"><?php echo $treasury["title"]; ?></option>';
                html += '<?php } ?>';
                $('#ist').html(html);*/
            } else {
                $('#ist').attr('name', 'ist');
                me.parent('.control-label').parent('.form-group').css('width', '66%');
                $('#ist').css('width', '95%');
                html = '<option value="">--Select--</option>';
                html += '<?php foreach (getAllAccountantGeneral() as $ag) { ?>';
                html += '<option value="<?php echo $ag["id"]; ?>"><?php echo $ag["name"];?></option>';
                html += '<?php } ?>';
                $('#ist').html(html);
            }
        });

        $('#dearness_relief, #basic_pension').keyup(function() {
            da_percent = $('#dearness_relief').val();
            basic_pension = parseFloat($('#basic_pension').val()) || 0;
            $('#dr_total').val((basic_pension*da_percent/100));
            delete da_percent;
            delete basic_pension;
        });

        $('#memo_no_change').click(function() {
            var me = $(this);
            if(me.is(':checked')) {
                $('#memo_no').removeAttr('readonly');
            } else {
                $('#memo_no').attr('readonly', 'readonly');
            }
        });

        $('#ist').change(function() {
            if($('#send_to').is(':checked')) {
                if($('#ist').val() == $('#irf').val()) {
                    alert('Send files to the same treasury is not possible. Please choose another one.');
                    $('#ist').val('').focus();
                }
            }
        });

        $('#paid_upto, #letter_date').bind('paste', function(e) {
            e.preventDefault();
            return false;
        });
    });
</script>