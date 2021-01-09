<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Order Details</h3>
      </div>
    </div>

    <div class="row">
 

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Order Details</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
         
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Order ID</th>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Order Date</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Sub Total</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($orders_details as $row):?>
                  <tr>
                    <td><?=$i++?></td>
                    <td><?=$row->order_id?></td>
                    <td><?=$row->product_name?></td>
                    <td><?=$row->product_description?></td>
                    <td><?=$row->order_date?></td>
                    <td><?=$row->price?></td>
                    <td><?=$row->quantity?></td>
                    <td>$<?=$row->sub_total?></td>
                  </tr>
                <?php endforeach; ?>
             
              </tbody>
            </table>
  
  
          </div>
        </div>
      </div>


    </div>
  </div>
</div>