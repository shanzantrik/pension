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

<?php
$pcid=0;
foreach ($records as $xx){;
$pcid=$xx['pay_comm_id'];
if($pcid==0){ $pcid=7;}
}
if($pcid<7){
?>


<div class="form-group">
    <fieldset>
        <legend>Pension Calculation</legend>
        <div class="form-group-inside">
            <h4>Before Increment</h4><hr style="margin: 0 0 15px 0;" />
            <?php foreach ($records as $rec): ?>
                <?php 
				
				if($rec['da'] == 'yes'){ ?>
                    <label class="col-sm-3 control-label"><?php echo $rec['name'] ?> <span class="required-field">*</span></label>
                    <select required class="pre_da" name="pre_<?php echo $rec['alias_name'] ?>" id="pre_da">
                        <option value="">Select</option>
                        <?php foreach (getall_DA() as $da) { ?>
                            <option value="<?php echo $da['da'];?>"><?php echo $da['da']; ?></option>
                        <?php } ?>
                    </select>
                    <a href="#addDearness_Allowances" id="addDearness_Allowances" class="btn btn-success" data-toggle="modal">+</a>

                <?php } else { ?>
                        <?php if($rec['alias_name']!='NPA'){
                            ?>
                                    <label class="col-sm-3 control-label"><?php echo $rec['name'] ?> <span class="required-field">*</span></label>
                    				<div class="col-sm-6">
                    		            <input required type="number" autocomplete="off" title="<?php echo $rec['name'] ?>" onblur="calculateRevised()" class="pre_xx" name="pre_<?php echo $rec['alias_name'] ?>" id="<?php echo $rec['alias_name'] ?>" placeholder="<?php echo $rec['name'] ?>" >
                    		        </div>
                            <?php }
                            else{?>
                                        <label class="col-sm-3 control-label"><?php echo $rec['name'] ?> <span class="required-field">*</span></label>
                                    <div class="col-sm-6">
                                        <input required type="number" autocomplete="off" title="<?php echo $rec['name'] ?>" onblur="calculateRevised()" class="pre_yy" name="pre_<?php echo $rec['alias_name'] ?>" id="<?php echo $rec['alias_name'] ?>" placeholder="<?php echo $rec['name'] ?>" >
                                    </div>
                            <?php }?>

                <?php } ?>
			<?php endforeach ?>	
            
            <!-- <label class="col-sm-3 control-label">Non Practising Allowance <span class="required-field">*</span></label>
                     <input autocomplete="off" placeholder="Non Practising Allowance"  type="text" id="npa1" name="npa" value="0"  class="npa" width="10"> --> <!--onblur="calculateRevised()"-->

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
                <h4>After Increment</h4><hr style="margin: 0 0 15px 0;" />
                <?php foreach ($records as $rec): ?>
                    <?php
					
					 if($rec['da'] == 'yes') : ?>
                        <label class="col-sm-3 control-label"><?php echo $rec['name'] ?> <span class="required-field">*</span></label>
                        <select required class="post_da" name="post_<?php echo $rec['alias_name'] ?>" id="post_da">
                            <option value="">Select</option>
                            <?php foreach (getall_DA() as $da) { ?>
                                <option value="<?php echo $da['da'];?>"><?php echo $da['da'];?></option>
                            <?php } ?>
                        </select>
                        <a href="#addDearness_Allowances" id="addDearness_Allowances" class="btn btn-success" data-toggle="modal">+</a>
                    <?php else : ?>
        				<!-- <label class="col-sm-3 control-label"><?php echo $rec['name']?> <span class="required-field">*</span></label>
        				<div class="col-sm-6">
        		            <input required type="number" autocomplete="off" title="<?php echo $rec['name'] ?>" onblur="calculatePreRevised()" class="rev_xx" name="post_<?php echo $rec['alias_name'] ?>" id="<?php echo $rec['alias_name'] ?>" placeholder="<?php echo $rec['name'] ?>" >
        		        </div> -->
                        <?php if($rec['alias_name']!='NPA'){
                            ?>
                                    <label class="col-sm-3 control-label"><?php echo $rec['name'] ?> <span class="required-field">*</span></label>
                                    <div class="col-sm-6">
                                        <input required type="number" autocomplete="off" title="<?php echo $rec['name'] ?>" onblur="calculatePreRevised()" class="rev_xx" name="post_<?php echo $rec['alias_name'] ?>" id="<?php echo $rec['alias_name'] ?>" placeholder="<?php echo $rec['name'] ?>" >
                                    </div>
                            <?php }
                            else{?>
                                        <label class="col-sm-3 control-label"><?php echo $rec['name'] ?> <span class="required-field">*</span></label>
                                    <div class="col-sm-6">
                                        <input required type="number" autocomplete="off" title="<?php echo $rec['name'] ?>" onblur="calculatePreRevised()" class="rev_yy" name="post_<?php echo $rec['alias_name'] ?>" id="<?php echo $rec['alias_name'] ?>" placeholder="<?php echo $rec['name'] ?>" >
                                    </div>
                            <?php }?>
                    <?php endif; ?>
    			<?php endforeach ?>
    			<div class="form-group-inside">
    				<label class="col-sm-3 control-label">Last Increment Date <span class="required-field">*</span></label>
    				<div class="col-sm-6">
    	                <input autocomplete="off" name="last_increament_date" id="last_increament_date" type="text" placeholder="Please Enter Last Increament Date">
    	            </div>
    	        </div>

                 <!-- <label class="col-sm-3 control-label">Non Practising Allowance <span class="required-field">*</span></label>
                     <input autocomplete="off" placeholder="Non Practising Allowance"  type="text" id="npa2" name="npa" value="0"  class="npa" width="10"> --> <!--onblur="calculateRevised()"-->

                <label class="col-sm-3 control-label">Total</label>
                <input autocomplete="off" placeholder="Total Amount" readonly type="text" id="total_rev" name="total_rev">

                <!--<div id="scale_seven" style="margin-left:-540px;"> 
                <label>Pay Level <span class="required-field">*</span></label>
                
                <select name="seven_pol" id="seven_pol">
                    <option value="0">--SELECT--</option>
                    <option value="1">Level-1</option>
                    <option value="2">Level-2</option>
                    <option value="3">Level-3</option>
                    <option value="4">Level-4</option>
                    <option value="5">Level-5</option>
                    <option value="6">Level-6</option>
                    <option value="7">Level-7</option>
                    <option value="8">Level-8</option>
                    <option value="9">Level-9</option>
                    <option value="10">Level-10</option>
                    <option value="11">Level-11</option>
                    <option value="12">Level-12</option>
                    <option value="13">Level-13</option>
                    <option value="13a">Level-13a</option>
                    <option value="14">Level-14</option>
                    <option value="15">Level-15</option>
                    <option value="16">Level-16</option>
                    <option value="17">Level-17</option>
                    <option value="18">Level-18</option>

                </select>
                
                <select name="sc_seven" id="sc_seven">
                    <option value="0">--SELECT--</option>
                    
                </select>

                </div>-->

            </div>
        </fieldset>
    </div>
<?php } ?>

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

    $("#seven_pol").change(function(){
            
            /*var x=$("#seven_pol").val();
            
            $.ajax({
                url:'<?php echo site_url("administrator/service_book/getSevenpay/"); ?>',
                data:'country_id='+x,
                dataType:'html',
                method:'POST',
                success:function(html){
                    $("#sc_seven").html(html);
                    
                }
            });*/

          });

    $("#sc_seven").change(function(){
            
            //$("#total_pre").val($(this).val());
          });  



    function blurBP()
    {
        $('input[name="post_BP"]').blur(function()
        {
            if($('input[name="pre_BP"]').val() == '')
            {
                alert('Please fill up before increment value.');
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

        var npa=$('.pre_yy').val();
        tot=parseInt(tot+(tot/100*npa));
        final_tot = (tot*parseInt(da)/100)+tot;
        


        $("#total_pre").val(Math.round(final_tot));
        delete da;
        delete tot;
        delete final_tot;
    }

    $("#npa1").change(function()
    {
        npa1 = $('#npa1').val() || 0;
        da  = $('#pre_da').val() || 0;
        tot = 0;
        final_tot = 0;
        $.each($('.pre_xx'), function() {
            tot += parseFloat($(this).val()) || 0;
        });
        tot_da = (tot*parseInt(da)/100);
        tot_npa = (tot*parseInt(npa1)/100);
        final_tot = parseInt(tot_da)+parseInt(tot_npa)+parseInt(tot);
        $("#total_pre").val(Math.round(final_tot));
        delete da;
        delete tot;
        delete npa1;
        delete tot_da;
        delete tot_npa;
        delete final_tot;
    });

    
    var calculatePreRevised = function()
    {
        da = $('#post_da').val() || 0;
        tot = 0;
        final_tot = 0;
        $.each($('.rev_xx'), function() {
            tot += parseFloat($(this).val()) || 0;
        });
        //final_tot = (tot*parseInt(da)/100)+tot;
        var npa=$('.rev_yy').val();
        tot=parseInt(tot+(tot/100*npa));
        final_tot = (tot*parseInt(da)/100)+tot;
        $("#total_rev").val(Math.round(final_tot));
        delete da;
        delete tot;
        delete final_tot;
    }

    $("#npa2").change(function()
    {
        npa2 = $('#npa2').val() || 0;
        da  = $('#post_da').val() || 0;
        tot = 0;
        final_tot = 0;
        $.each($('.rev_xx'), function() {
            tot += parseFloat($(this).val()) || 0;
        });
        tot_da = (tot*parseInt(da)/100);
        tot_npa = (tot*parseInt(npa2)/100);
        final_tot = parseInt(tot_da)+parseInt(tot_npa)+parseInt(tot);
        $("#total_rev").val(Math.round(final_tot));
        delete da;
        delete tot;
        delete npa2;
        delete tot_da;
        delete tot_npa;
        delete final_tot;
    });

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