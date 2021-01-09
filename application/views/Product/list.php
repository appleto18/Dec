<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Product List</h3>
      </div>
    </div>

    <div class="row">
 

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            
            <h2>Product List</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
         
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Image</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($product as $row) { ?>
                  <tr>
                    <td><?=$i++?></td> 
                    <td><img src="<?=$row->product_image?>" style="width:50px;height:50px"></td>
                    <td><?=$row->product_name?></td>
                    <td><?=$row->product_description?></td>
                  </tr>
                <?php } ?>
             
              </tbody>
            </table>
  
  
          </div>
        </div>
      </div>


    </div>
  </div>
</div>