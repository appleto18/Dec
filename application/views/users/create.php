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
            <form method="post" action="<?=base_url()?>Users/edit_user" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo(isset($user['user_id']) && !empty($user['user_id']))?$user['user_id']:'';?>">
             
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Profile Image 
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <img src="<?php echo $user['profile_image'];?>" style="width:50px;height:50px">
                  <input type="file" name="img" value="" class="form-control col-md-7 col-xs-12" >
                  <span style="color: red;" ><?php echo form_error('phone'); ?></span>
                </div>
              </div>
             
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">User Name 
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="name" value="<?php echo(isset($user['user_name']) && !empty($user['user_name']))?$user['user_name']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('name'); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Email 
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="email" value="<?php echo(isset($user['user_email']) && !empty($user['user_email']))?$user['user_email']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('phone'); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone 
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="phone" value="<?php echo(isset($user['phone']) && !empty($user['phone']))?$user['phone']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('phone'); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Latitude
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="latitude" value="<?php echo(isset($user['latitude']) && !empty($user['latitude']))?$user['latitude']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('email'); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Longitude
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="longitude" value="<?php echo(isset($user['longitude']) && !empty($user['longitude']))?$user['longitude']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('email'); ?></span>
                </div>
              </div>
              
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password"> Country
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="country" value="<?php echo(isset($user['country']) && !empty($user['country']))?$user['country']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('password'); ?></span></span>
                </div>
             </div>
              
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password"> City
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="city" value="<?php echo(isset($user['city']) && !empty($user['city']))?$user['city']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('password'); ?></span></span>
                </div>
             </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password"> Password
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="password" value="<?php echo(isset($user['password']) && !empty($user['password']))?$user['password']:'';?>" class="form-control col-md-7 col-xs-12" required>
                  <span style="color: red;" ><?php echo form_error('password'); ?></span></span>
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