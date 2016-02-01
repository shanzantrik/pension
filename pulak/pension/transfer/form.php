<?php if(isset($_POST['file_no'])):?>
    <div style="float: right; width: 40%; text-align: right;">

<form method="POST" action="<?php echo site_url('administrator/pension/transfer_save'); ?>" accept-charset="UTF-8">   
   
   
    <?php $case_details = (array) $service_details; ?>

    <div class="form-group">
        <label for="to" class="control-label">To </label>
        <select name="revision_type" class="form-control" required>
            <option value="">--Select--</option>
            <option value="ac">A</option>
            <option value="m">M</option>
            <option value="a">A</option>
            <option value="ref">R</option>
        </select>
    </div>
    <div class="form-group">
        <label for="ppo" class="control-label">PPO No PEN/AP/</label>
        <input class="form-control" id="ppo" required="required" autocomplete="off" name="ppo" type="text" placeholder="Type PPO No" value="">
    </div>
    <div class="form-group">
        <label for="name" class="control-label">Shri/Smti</label>
        <input class="form-control" id="name" required="required" autocomplete="off" name="name" type="text" placeholder="Type a Name" value="<?php echo $case_details['name']; ?>">
    </div>
   <div class="form-group">
        <label for="draw" class="control-label">Draw From</label>
        <input  class="form-control" id="draw" required="required" autocomplete="off" name="draw" type="text" placeholder="Draw pension from" value="">
    </div>
    <div class="form-group">
        <label for="paid" class="control-label">Paid Up to</label>
        <input  class="form-control" id="paid" required="required" autocomplete="off" name="paid" type="text" placeholder="Paid Up to" value="">
    </div>
     <div class="form-group">
        <label for="treasury" class="control-label">Treasury/Sub Treasury</label>
        <select name="revision_type" class="form-control" required>
            <option value="">--Select--</option>
            <option value="acp">AC</option>
            <option value="map">MA</option>
            <option value="addt">Add</option>
            <option value="refix">Ref</option>
        </select>
    </div>

   

   <div class="form-group">
        <label for="basic_pension" class="control-label max-height">Basic Pension</label>
        <input  class="form-control" id="basic_pension" required="required" autocomplete="off" name="basic_pension " type="number" step="any" placeholder="Basic pension">    
    </div>
    <div class="form-group">
        <label for="reduced_pension" class="control-label max-height">Reduced Pension</label>
        <input class="form-control" id="reduced_pension" required="required" autocomplete="off" name="reduced_pension " type="number" step="any" placeholder="Reduced pension">    
    </div>
    <div class="form-group">
        <label for="dearness_relief" class="control-label max-height"> Dearness Relief</label>
        <input  class="form-control" id="dearness_relief" required="required" autocomplete="off" name="dearness_relief " type="number" step="any" placeholder="   Dearness Relief">    
    </div>
     <div class="form-group">
        <label for="medical_allowance" class="control-label max-height">Medical Allowance</label>
        <input  class="form-control" id="medical_allowance" required="required" autocomplete="off" name="medical_allowance " type="number" step="any" placeholder="Medical Allowance">    
    </div>
    <div class="form-group">
        <label for="enhance_rate" class="control-label max-height"> Enhance Rate</label>
        <input  class="form-control" id="enhance_rate" required="required" autocomplete="off" name="enhance_rate " type="number" step="any" placeholder="Enhance Rate">    
    </div>
    <div class="form-group">
        <label for="normal_rate" class="control-label max-height"> Normal Rate</label>
        <input  class="form-control" id="normal_rate" required="required" autocomplete="off" name="normal_rate " type="number" step="any" placeholder="Normal Rate">    
    </div>
    <div class="form-group">
        <label for="memo_no" class="control-label max-height"> Meomo No</label>
        <input  class="form-control" id="memo_no" required="required" autocomplete="off" name="memo_no " type="number" step="any" placeholder="Memo No">    
    </div>
    <div class="form-group">
        <label for="treasury" class="control-label">Treasury Officer/Sub-Treasury</label>
        <input  class="form-control" id="treasury" required="required" autocomplete="off" name="treasury" type="text" placeholder="Type a Name" value="">
    </div>

    <div class="form-group">
        <label for="letter_no" class="control-label max-height"> letter No</label>
        <input class="form-control" id="letter_no" required="required" autocomplete="off" name="letter_no " type="number" step="any" placeholder="Letter No">    
    </div>

    <button class="form-control btn btn-success" id="Save" type="submit">Save</button>
</form>
<?php endif; ?>