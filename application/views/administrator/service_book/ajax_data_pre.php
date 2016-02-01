<!-- Make url -->
<?php
	$url="";$id="";
	foreach ($records as $rec) {
		$url=$url.$rec['name'].",";
		$id=$id.$rec['id'].",";
	}
	$url=rtrim($url, ",");
	$id=rtrim($id, ",");
	$hidden=array('url' =>$url,'id'=>$id);
?>
<div id="addDearness_Allowances" class="modal hide fade">
    <div class="modal-header"><h3>Add Dearness Allowances</h3></div>
    <div class="modal-body">
        <label style="float: left;"><b>Enter Dearness Allowance Value</b></label>&nbsp;&nbsp;&nbsp;
        <input type="text" name="modaldearness_allowances" id="modaldearness_allowances" />
        <div id="modalDearness_Message" class="modalDearness_Message"></div>
    </div>
    <div class="modal-footer"><small class="btn btn-danger" data-dismiss="modal">Close</small>&nbsp;<small class="btn btn-primary savedearness_Allowances">Save</small></div>
</div>

<div class="form-group">
    <fieldset>
        <legend>Pension Calculation</legend>
        <div class="form-group-inside">
            <h4>Before Increament</h4><hr style="margin: 0 0 15px 0;" />
            <?php foreach ($records as $rec): ?>
                <?php if($rec['da'] == 'yes') : ?>
                    <label class="col-sm-3 control-label"><?php echo $rec['name'] ?> <span class="required-field">*</span></label>
                    <select required class="pre_da" name="pre_<?php echo $rec['alias_name'] ?>" id="pre_da">
                        <option value="">Select</option>
                        <?php foreach (getall_DA() as $da) { ?>
                            <option value="<?php echo $da['da'];?>"><?php echo $da['da']; ?></option>
                        <?php } ?>
                    </select>
                    <a href="#addDearness_Allowances" id="addDearness_Allowances" class="btn btn-success" data-toggle="modal">+</a>
                <?php else : ?>
    				<label class="col-sm-3 control-label"><?php echo $rec['name'] ?> <span class="required-field">*</span></label>
    				<div class="col-sm-6">
    		            <input required type="number" autocomplete="off" title="<?php echo $rec['name'] ?>" onblur="calculateRevised()" class="pre_xx" name="pre_<?php echo $rec['alias_name'] ?>" id="<?php echo $rec['alias_name'] ?>" placeholder="<?php echo $rec['name'] ?>" >
    		        </div>
                <?php endif; ?>
			<?php endforeach ?>	
			<label class="col-sm-3 control-label">Total</label>
			<input autocomplete="off" placeholder="Total Amont" disabled="true" type="text" id="total_pre" name="total_pre">
        </div>
    </fieldset>
</div>

<?php //if($pay_id != "6") : ?>
    <!-- <div class="form-group" <?php if($pay_id=="6") { ?>style="display:none";<?php } else { ?>style="display:block";<?php } ?>> -->
    <div class="form-group">
        <fieldset>
            <legend>&nbsp;</legend>
            <div class="form-group-inside">
                <h4>After Increament</h4><hr style="margin: 0 0 15px 0;" />
                <?php foreach ($records as $rec): ?>
                    <?php if($rec['da'] == 'yes') : ?>
                        <label class="col-sm-3 control-label"><?php echo $rec['name'] ?> <span class="required-field">*</span></label>
                        <select required class="post_da" name="post_<?php echo $rec['alias_name'] ?>" id="post_da">
                            <option value="">Select</option>
                            <?php foreach (getall_DA() as $da) { ?>
                                <option value="<?php echo $da['da'];?>"><?php echo $da['da'];?></option>
                            <?php } ?>
                        </select>
                        <a href="#addDearness_Allowances" id="addDearness_Allowances" class="btn btn-success" data-toggle="modal">+</a>
                    <?php else : ?>
        				<label class="col-sm-3 control-label"><?php echo $rec['name']?> <span class="required-field">*</span></label>
        				<div class="col-sm-6">
        		            <input required type="number" autocomplete="off" title="<?php echo $rec['name'] ?>" onblur="calculatePreRevised()" class="rev_xx" name="post_<?php echo $rec['alias_name'] ?>" id="<?php echo $rec['alias_name'] ?>" placeholder="<?php echo $rec['name'] ?>" >
        		        </div>
                    <?php endif; ?>
    			<?php endforeach ?>
    			<div class="form-group-inside">
    				<label class="col-sm-3 control-label">Last Increament Date <span class="required-field">*</span></label>
    				<div class="col-sm-6">
    	                <input autocomplete="off" name="last_increament_date" id="last_increament_date" type="text" placeholder="Please Enter Last Increament Date">
    	            </div>
    	        </div>
                <label class="col-sm-3 control-label">Total</label>
                <input autocomplete="off" placeholder="Total Amount" readonly type="text" id="total_rev" name="total_rev">
            </div>
        </fieldset>
    </div>
<?php //endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#pre_da').change(function() {
            calculateRevised()
        });

        $('#post_da').change(function() {
            calculatePreRevised();
        });

        blurBP();
        blurGP();
        blurNPA();

        $('#post_da').on('change', function()
        {
            changeDA();
        });
    });

    function checkInput(inputName)
    {
        if($('input[name="'+inputName+'"]').length > 0)
        {
            return true;
        }
    }

    function blurBP()
    {
        $('input[name="post_BP"]').blur(function()
        {
            if($('input[name="pre_BP"]').val() == '')
            {
                alert('Plase fill up before increment value.');
                $('input[name="post_BP"]').val('');
                $('input[name="pre_BP"]').val('').focus();
                return false;
            }

            if($('input[name="post_BP"]').val() < $('input[name="pre_BP"]').val())
            {
                alert('After increment should be more than or equal to before increment value.');
                $('input[name="post_BP"]').val('').focus();
                return false;
            }
        });
    }

    function blurGP()
    {
        $('input[name="post_GP"]').blur(function()
        {
            if($('input[name="pre_GP"]').val() == '')
            {
                alert('Plase fill up before increment value.');
                $('input[name="post_GP"]').val('');
                $('input[name="pre_GP"]').val('').focus();
                return false;
            }

            if($('input[name="post_GP"]').val() < $('input[name="pre_GP"]').val())
            {
                alert('After increment should be more than or equal to before increment value.');
                $('input[name="post_GP"]').val('').focus();
                return false;
            }
        });
    }

    function blurNPA()
    {
        $('input[name="post_NPA"]').blur(function()
        {
            if($('input[name="pre_NPA"]').val() == '')
            {
                alert('Plase fill up before increment value.');
                $('input[name="post_NPA"]').val('');
                $('input[name="pre_NPA"]').val('').focus();
                return false;
            }

            if($('input[name="post_NPA"]').val() < $('input[name="pre_NPA"]').val())
            {
                alert('After increment should be more than or equal to before increment value');
                $('input[name="post_NPA"]').val('').focus();
                return false;
            }
        });
    }

    function changeDA()
    {
        if($('#pre_da').val() == '')
        {
            alert('Plase select before increment value.');
            $('#post_da').val('');
            $('#pre_da').val('').focus();
            return false;
        }

        var post = parseInt($('#post_da').val()) || 0;
        var pre  = parseInt($('#pre_da').val()) || 0;

        if(post < pre)
        {
            alert('Dearness Allowance percentage not less than before increament percentage.');
            $('#post_da').val('').focus();
            return false;
        }
    }

    var calculateRevised = function()
    {
        da  = $('#pre_da').val() || 0;
        tot = 0;
        final_tot = 0;
        $.each($('.pre_xx'), function() {
            tot += parseFloat($(this).val()) || 0;
        });
        final_tot = (tot*parseInt(da)/100)+tot;
        $("#total_pre").val(Math.round(final_tot));
        delete da;
        delete tot;
        delete final_tot;
    }

    var calculatePreRevised = function()
    {
        da = $('#post_da').val() || 0;
        tot = 0;
        final_tot = 0;
        $.each($('.rev_xx'), function() {
            tot += parseFloat($(this).val()) || 0;
        });
        final_tot = (tot*parseInt(da)/100)+tot;
        $("#total_rev").val(Math.round(final_tot));
        delete da;
        delete tot;
        delete final_tot;
    }

    $(document).ready(function(){
    	$('.rev_xx:eq(0)').change(function(){
    		if($(this).val() > 0) {
    			$('#last_increament_date').removeAttr('readonly').attr('required', 'true');
    		} else {
    			$('#last_increament_date').attr('readonly', 'true').removeAttr('required');
    		}
    	});

    	$("#last_increament_date").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange:'1900:+0'});
    });

    $('.savedearness_Allowances').click(function(){
        if($('#modaldearness_allowances').val()=='') {
            $('#modalDearness_Message').html('DA is required.');
        } else {
            $.post("<?php echo site_url('administrator/service_book/save_DA'); ?>",{DA_value:$('#modaldearness_allowances').val()}, function(data) {
                $('#addDearness_Allowances').modal('hide');
                $('#da_post').append('<option value='+data+' selected>'+$('#modaldearness_allowances').val()+'</option>');
                 $('#modaldearness_allowances').val('');
            });
        }
    });
</script>