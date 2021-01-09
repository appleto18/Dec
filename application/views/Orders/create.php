<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
     

     
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?=$title?></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="post" action="<?=base_url()?>Machines/Create" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              <input type="hidden" name="machine_id" value="<?php echo(isset($machine['machine_id']) && !empty($machine['machine_id']))?$machine['machine_id']:'';?>">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="machine_name">Machine Name 
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="machine_name" value="<?php echo(isset($machine['machine_name']) && !empty($machine['machine_name']))?$machine['machine_name']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('machine_name'); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ipaddress">IP Address
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="ipaddress" value="<?php echo(isset($machine['ipaddress']) && !empty($machine['ipaddress']))?$machine['ipaddress']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('ipaddress'); ?></span>
                </div>
              </div>
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button name="save" value="Save" type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>