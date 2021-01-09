<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Cms <?=$cms['page_type'];?></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="post" action="<?php echo base_url('Cms/update_cms'); ?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="<?=$cms['id'];?>">
			  <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="description" style="height:250px;" class="form-control col-md-7 col-xs-12" required><?=$cms['description'];?></textarea>
                  <span style="color: red;" ><?php echo form_error('description'); ?></span>
                </div>
              </div>
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="save" value="Add Restaurant" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
