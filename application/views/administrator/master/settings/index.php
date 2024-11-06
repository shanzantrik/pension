<form method="POST" action="<?php echo site_url('administrator/master/settings'); ?>" accept-charset="UTF-8" style="width: 50%;">
    <div class="form-group">
        <label for="dob" class="control-label"><b>Total number of pension case</b></label>
        <input required <?php if(get_option('total_no_of_pension_case') != '') : ?>readonly<?php endif; ?> class="form-control" id="total_no_of_pension_case" autocomplete="off" name="total_no_of_pension_case" type="number" placeholder="Total no. of pension case" value="<?php echo get_option('total_no_of_pension_case'); ?>" />
    </div>
    <div class="form-group">
        <label for="dob" class="control-label"><b>Total number of GIS case</b></label>
        <input required <?php if(get_option('total_no_of_gis_case') != '') : ?>readonly<?php endif; ?> class="form-control" id="total_no_of_gis_case" autocomplete="off" name="total_no_of_gis_case" type="number" placeholder="Total no. of GIS case" value="<?php echo get_option('total_no_of_gis_case'); ?>" />
    </div>
    <div class="form-group">
        <label for="dob" class="control-label"><b>Total number of IPS case</b></label>
        <input required <?php if(get_option('total_no_of_ips_case') != '') : ?>readonly<?php endif; ?> class="form-control" id="total_no_of_ips_case" autocomplete="off" name="total_no_of_ips_case" type="number" placeholder="Total no. of IPS case" value="<?php echo get_option('total_no_of_ips_case'); ?>" />
    </div>
    <div class="form-group">
        <label for="dob" class="control-label"><b>Last PPO no.</b></label>
        <input required <?php if(get_option('ppo_number') != '') : ?>readonly<?php endif; ?> class="form-control" id="ppo_number" autocomplete="off" name="ppo_number" type="number" placeholder="Last PPO no." value="<?php echo get_option('ppo_number'); ?>" />
    </div>
    <div class="form-group">
        <label for="dob" class="control-label"><b>Last GPO no.</b></label>
        <input required <?php if(get_option('gpo_number') != '') : ?>readonly<?php endif; ?> class="form-control" id="gpo_number" autocomplete="off" name="gpo_number" type="number" placeholder="Last GPO no." value="<?php echo get_option('gpo_number'); ?>" />
    </div>
    <div class="form-group">
        <label for="dob" class="control-label"><b>Last CPO no.</b></label>
        <input required <?php if(get_option('cpo_number') != '') : ?>readonly<?php endif; ?> class="form-control" id="cpo_number" autocomplete="off" name="cpo_number" type="number" placeholder="Last CPO no." value="<?php echo get_option('cpo_number'); ?>" />
    </div>

    <?php if(get_option('total_no_of_pension_case') == '' || get_option('total_no_of_gis_case') == '' || get_option('total_no_of_ips_case') == '' || get_option('ppo_number') == '' || get_option('gpo_number') == '' || get_option('cpo_number') == '') : ?>
        <button class="form-control btn btn-success" id="Save" type="submit">Save</button>
    <?php endif; ?>
</form>