<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Orders</h3>
      </div>
    </div>

    <div class="row">
 

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Orders List</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
         
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>User Name</th>
                  <th>Order Date</th>
                  <th>Total Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($orders as $row):?>
                  <tr>
                    <td><?=$i++?></td>
                    <td><?=$row->user_name?></td>
                    <td><?=$row->order_date?></td>
                    <td>$<?=$row->total_amount?></td>
                    <td>
                        <center>
                         <a class="btn btn-primary" href="<?=base_url('Orders/details/'.$row->order_id)?>" title="Order Details"><i class="fa fa-info" aria-hidden="true"></i></a>
                        </center>
                    </td>
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