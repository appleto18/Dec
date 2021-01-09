<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
     

     
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Review</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="post" action="<?=base_url()?>Reviews/UpdateReviews" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $Reviews['id']; ?>">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname"> Review By
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text"  value="<?php echo $Reviews['first_name']; ?>" class="form-control col-md-7 col-xs-12" readonly>
                  <span style="color: red;" ><?php echo form_error('firstname'); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rating"> Rating 
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="rating" value="<?php echo $Reviews['rating']; ?>" class="form-control col-md-7 col-xs-12">
                  <span style="color: red;" ><?php echo form_error('rating'); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="review">Review 
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="review" value="<?php echo $Reviews['review']; ?>" class="form-control col-md-7 col-xs-12">
                  <span style="color: red;" ><?php echo form_error('review'); ?></span>
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