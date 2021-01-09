<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
     

     
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Add Product</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="post" action="<?=base_url()?>Product/add_product" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
              <input type="hidden" name="id" value="">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Product Image
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" name="image" value="" class="form-control col-md-7 col-xs-12">
                  <span style="color: red;" ><?php echo form_error('firstname'); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Product Name
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="name" value="" class="form-control col-md-7 col-xs-12">
                  <span style="color: red;" ><?php echo form_error('lastname'); ?></span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company">Product Description 
                  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="description" value="" class="form-control col-md-7 col-xs-12"></textarea>
                  <span style="color: red;" ><?php echo form_error('company'); ?></span>
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